<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use Illuminate\Support\Facades\Auth;

/**
 * Controller untuk dashboard siswa.
 */
class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard siswa dengan statistik belajar.
     */
    public function index()
    {
        $siswaId = Auth::user()->id_user;

        // Total quiz yang tersedia untuk siswa
        $totalQuiz = Quiz::whereHas('materi', fn($q) => $q->where('is_published', true))->count();

        // Semua percobaan quiz oleh siswa
        $attempts = QuizAttempt::where('id_siswa', $siswaId)->get();

        // Jumlah quiz unik yang telah dikerjakan
        $completedQuiz = QuizAttempt::where('id_siswa', $siswaId)
            ->distinct()
            ->count('id_quiz');

        $averageScore = round($attempts->avg('skor_persen') ?? 0, 1);
        $totalStars = (int) $attempts->sum('bintang');

        // Progress keseluruhan dalam persen
        $overallProgress = $totalQuiz > 0
            ? round(($completedQuiz / $totalQuiz) * 100)
            : 0;

        $overallProgress = min($overallProgress, 100);

        // Quiz yang belum pernah dikerjakan
        $unfinishedQuiz = Quiz::whereDoesntHave('quizAttempts', function ($q) use ($siswaId) {
            $q->where('id_siswa', $siswaId);
        })
            ->with([
                'materi',
                'materi.kategori'
            ])
            ->take(3)
            ->get();

        // Riwayat pengerjaan terbaru
        $recentAttempts = QuizAttempt::where('id_siswa', $siswaId)
            ->with(['quiz.materi'])
            ->latest('tanggal_pengerjaan')
            ->take(5)
            ->get();

        $colors = [
            'bg-gradient-mtk',
            'bg-gradient-bind',
            'bg-gradient-ipa',
            'bg-gradient-ips',
            'bg-gradient-bing',
            'bg-gradient-default',
        ];

        return view('student.dashboard.index', compact(
            'overallProgress',
            'averageScore',
            'completedQuiz',
            'totalQuiz',
            'totalStars',
            'unfinishedQuiz',
            'recentAttempts',
            'colors',
        ));
    }
}
