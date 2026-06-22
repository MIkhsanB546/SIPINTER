<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\QuizAttempt;
use App\Models\Materi;
use App\Models\Quiz;

class HasilSiswaController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            $attempts = QuizAttempt::with(['siswa', 'quiz.materi'])
                ->latest('tanggal_pengerjaan')
                ->get();
        } else {
            $idGuru = $user->id_user;
            $materiIds = Materi::where('id_guru', $idGuru)->pluck('id_materi');
            $quizIds = Quiz::whereIn('id_materi', $materiIds)->pluck('id_quiz');

            $attempts = QuizAttempt::with(['siswa', 'quiz.materi'])
                ->whereIn('id_quiz', $quizIds)
                ->latest('tanggal_pengerjaan')
                ->get();
        }

        $grouped = $attempts->groupBy(fn($a) => $a->quiz->materi->judul ?? 'Tanpa Materi');

        return view('dashboard.hasil-siswa.index', compact('grouped', 'attempts'));
    }
}
