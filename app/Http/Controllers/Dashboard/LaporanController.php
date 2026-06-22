<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Materi;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        $totalGuru = User::guru()->count();
        $totalSiswa = User::siswa()->count();
        $totalMateri = Materi::count();
        $totalQuiz = Quiz::count();
        $totalAttempts = QuizAttempt::count();
        $rataNilai = round(QuizAttempt::avg('skor_persen') ?? 0, 1);

        // $topMateri = Materi::select('materi.*', DB::raw('COUNT(quiz_attempts.id_quiz_attempt) as attempt_count'))
        //     ->leftJoin('quiz', 'quiz.id_materi', '=', 'materi.id_materi')
        //     ->leftJoin('quiz_attempts', 'quiz_attempts.id_quiz', '=', 'quiz.id_quiz')
        //     ->groupBy('materi.id_materi')
        //     ->orderByDesc('attempt_count')
        //     ->take(5)
        //     ->get();

        $topMateri = Materi::with('guru')
            ->select('materi.*')
            ->selectSub(function ($query) {
                $query->from('quiz as q')
                    ->join('quiz_attempts as qa', 'qa.id_quiz', '=', 'q.id_quiz')
                    ->selectRaw('COUNT(*)')
                    ->whereColumn('q.id_materi', 'materi.id_materi');
            }, 'attempt_count')
            ->orderByDesc('attempt_count')
            ->limit(5)
            ->get();
        // dd($topMateri->first());

        return view('dashboard.laporan.index', compact(
            'totalGuru',
            'totalSiswa',
            'totalMateri',
            'totalQuiz',
            'totalAttempts',
            'rataNilai',
            'topMateri'
        ));
    }
}
