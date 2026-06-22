<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\JawabanSiswa;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $siswaId = auth()->id();

        $quizList = Quiz::with('materi')
            ->whereHas('materi', fn($q) => $q->where('is_published', true))
            ->get()
            ->map(function ($quiz) use ($siswaId) {
                $attempts = QuizAttempt::where('id_siswa', $siswaId)
                    ->where('id_quiz', $quiz->id_quiz)
                    ->orderByDesc('attempt_ke')
                    ->get();

                $bestAttempt = $attempts->sortByDesc('skor_persen')->first();

                return (object) [
                    'quiz' => $quiz,
                    'attempts' => $attempts,
                    'best_skor' => $bestAttempt?->skor_persen,
                    'best_bintang' => $bestAttempt?->bintang,
                    'attempt_count' => $attempts->count(),
                    'has_completed' => $attempts->isNotEmpty(),
                ];
            });

        return view('student.quiz.index', compact('quizList'));
    }

    public function start(Quiz $quiz)
    {
        $siswaId = auth()->id();

        $latestAttempt = QuizAttempt::where('id_siswa', $siswaId)
            ->where('id_quiz', $quiz->id_quiz)
            ->orderByDesc('attempt_ke')
            ->first();

        $attemptKe = $latestAttempt ? $latestAttempt->attempt_ke + 1 : 1;

        $attempt = QuizAttempt::create([
            'id_siswa' => $siswaId,
            'id_quiz' => $quiz->id_quiz,
            'skor_persen' => 0,
            'bintang' => 0,
            'tanggal_pengerjaan' => now(),
            'attempt_ke' => $attemptKe,
        ]);

        $quiz->load('soals.pilihanJawabans');

        return view('student.quiz.show', compact('quiz', 'attempt'));
    }

    public function submit(Request $request, Quiz $quiz, QuizAttempt $attempt)
    {
        $request->validate([
            'jawaban' => ['required', 'array'],
            'jawaban.*' => ['required', 'exists:pilihan_jawaban,id_pilihan_jawaban'],
        ]);

        $jawaban = $request->input('jawaban');
        $quiz->load('soals.pilihanJawabans');

        $jumlahBenar = 0;
        $jumlahSoal = $quiz->soals->count();

        foreach ($quiz->soals as $soal) {
            $pilihanId = $jawaban[$soal->id_soal] ?? null;

            if (!$pilihanId) continue;

            $isCorrect = $soal->pilihanJawabans()
                ->where('id_pilihan_jawaban', $pilihanId)
                ->value('is_correct');

            JawabanSiswa::create([
                'id_quiz_attempt' => $attempt->id_quiz_attempt,
                'id_soal' => $soal->id_soal,
                'id_pilihan_jawaban' => $pilihanId,
                'is_correct' => $isCorrect,
            ]);

            if ($isCorrect) {
                $jumlahBenar++;
            }
        }

        $skorPersen = $jumlahSoal > 0 ? round(($jumlahBenar / $jumlahSoal) * 100, 2) : 0;

        $bintang = match (true) {
            $skorPersen >= 80 => 3,
            $skorPersen >= 60 => 2,
            $skorPersen >= 40 => 1,
            default => 0,
        };

        $attempt->update([
            'skor_persen' => $skorPersen,
            'bintang' => $bintang,
        ]);

        $attempt->load('quiz.materi');

        return redirect()->route('siswa.quiz.result', [$quiz, $attempt])
            ->with('success', 'Quiz selesai dikerjakan!');
    }

    public function result(Quiz $quiz, QuizAttempt $attempt)
    {
        $attempt->load(['jawabanSiswa.soal.pilihanJawabans', 'quiz.materi']);
        return view('student.quiz.result', compact('quiz', 'attempt'));
    }

    public function history()
    {
        $siswaId = auth()->id();
        $attempts = QuizAttempt::where('id_siswa', $siswaId)
            ->with('quiz.materi')
            ->latest('tanggal_pengerjaan')
            ->get();

        return view('student.quiz.history', compact('attempts'));
    }
}
