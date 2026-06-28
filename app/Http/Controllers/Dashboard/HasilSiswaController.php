<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\QuizAttempt;
use App\Models\Materi;
use App\Models\Quiz;
use Illuminate\Support\Facades\Auth;

class HasilSiswaController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $quizIds = Quiz::pluck('id_quiz');
        } else {
            $idGuru = $user->id_user;
            $materiIds = Materi::where('id_guru', $idGuru)->pluck('id_materi');
            $quizIds = Quiz::whereIn('id_materi', $materiIds)->pluck('id_quiz');
        }

        if ($quizIds->isEmpty()) {
            $grouped = collect();
            $attempts = collect();
            return view('dashboard.hasil-siswa.index', compact('grouped', 'attempts'));
        }

        // Best attempt per student per quiz, using correlated subquery
        $attempts = QuizAttempt::selectRaw('qa.*')
            ->from('quiz_attempts as qa')
            ->whereIn('qa.id_quiz', $quizIds)
            ->whereRaw('qa.id_quiz_attempt = (
                SELECT qa2.id_quiz_attempt
                FROM quiz_attempts qa2
                WHERE qa2.id_siswa = qa.id_siswa
                  AND qa2.id_quiz = qa.id_quiz
                ORDER BY qa2.skor_persen DESC, qa2.tanggal_pengerjaan DESC
                LIMIT 1
            )')
            ->with(['siswa', 'quiz.materi'])
            ->latest('qa.tanggal_pengerjaan')
            ->get();

        $grouped = $attempts->groupBy(fn($a) => $a->quiz->materi->judul ?? 'Tanpa Materi');

        return view('dashboard.hasil-siswa.index', compact('grouped', 'attempts'));
    }
}
