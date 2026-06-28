<?php

namespace App\Http\Controllers\OrangTua;

use App\Http\Controllers\Controller;
use App\Models\MateriSiswa;
use App\Models\QuizAttempt;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $orangTuaId = Auth::id();

        $anak = Auth::user()->anak()
            ->with(['materiSiswa' => function ($q) {
                $q->withPivot(['status', 'progress', 'completed_at']);
            }])
            ->get()
            ->map(function ($siswa) {
                $totalSaved = $siswa->materiSiswa->count();
                $totalCompleted = $siswa->materiSiswa->filter(fn($m) => $m->pivot->status === 'completed')->count();
                $totalLearning = $siswa->materiSiswa->filter(fn($m) => $m->pivot->status === 'learning')->count();
                $progress = $totalSaved > 0 ? round(($totalCompleted / $totalSaved) * 100) : 0;

                $quizAttempts = QuizAttempt::where('id_siswa', $siswa->id_user)
                    ->with('quiz.materi')
                    ->latest('tanggal_pengerjaan')
                    ->take(10)
                    ->get();

                $totalStars = (int) QuizAttempt::where('id_siswa', $siswa->id_user)->sum('bintang');
                $averageScore = round(QuizAttempt::where('id_siswa', $siswa->id_user)->avg('skor_persen') ?? 0, 1);

                return (object) [
                    'siswa' => $siswa,
                    'totalSaved' => $totalSaved,
                    'totalCompleted' => $totalCompleted,
                    'totalLearning' => $totalLearning,
                    'progress' => $progress,
                    'quizAttempts' => $quizAttempts,
                    'totalStars' => $totalStars,
                    'averageScore' => $averageScore,
                ];
            });

        return view('orang_tua.dashboard.index', compact('anak'));
    }
}
