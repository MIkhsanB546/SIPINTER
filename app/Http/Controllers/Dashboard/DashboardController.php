<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use App\Models\MateriSiswa;
use App\Models\Quiz;
use App\Models\User;
use App\Models\QuizAttempt;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $isGuru = $user->role === 'guru';
        $isAdmin = $user->role === 'admin';

        if ($isGuru) {
            $idGuru = $user->id_user;
            $jumlahMateri = Materi::where('id_guru', $idGuru)->count();
            $jumlahQuiz = Quiz::whereIn('id_materi', Materi::where('id_guru', $idGuru)->select('id_materi'))->count();
            $jumlahSiswa = QuizAttempt::whereIn('id_quiz', Quiz::whereIn('id_materi', Materi::where('id_guru', $idGuru)->select('id_materi'))->select('id_quiz'))->distinct('id_siswa')->count('id_siswa');
            $rataNilai = round(QuizAttempt::whereIn('id_quiz', Quiz::whereIn('id_materi', Materi::where('id_guru', $idGuru)->select('id_materi'))->select('id_quiz'))->avg('skor_persen') ?? 0, 1);

            // Total students learning their materials (via materi_siswa)
            $totalSiswaBelajar = MateriSiswa::whereIn('id_materi', Materi::where('id_guru', $idGuru)->select('id_materi'))
                ->distinct('id_siswa')
                ->count('id_siswa');

            $latestMateri = Materi::with(['guru', 'tingkatKesulitan', 'kategori'])
                ->where('id_guru', $idGuru)
                ->latest()
                ->take(5)
                ->get();

            $latestQuiz = Quiz::with('materi')
                ->whereIn('id_materi', Materi::where('id_guru', $idGuru)->select('id_materi'))
                ->latest()
                ->take(5)
                ->get();

            $recentAttempts = QuizAttempt::whereIn('id_quiz', Quiz::whereIn('id_materi', Materi::where('id_guru', $idGuru)->select('id_materi'))->select('id_quiz'))
                ->with(['siswa', 'quiz.materi'])
                ->latest('tanggal_pengerjaan')
                ->take(10)
                ->get();

            $siswaSekarangBelajar = MateriSiswa::whereIn('id_materi', Materi::where('id_guru', $idGuru)->select('id_materi'))
                ->where('status', 'learning')
                ->distinct('id_siswa')
                ->count('id_siswa');

            return view('dashboard.index', compact(
                'jumlahMateri',
                'jumlahQuiz',
                'jumlahSiswa',
                'rataNilai',
                'totalSiswaBelajar',
                'latestMateri',
                'latestQuiz',
                'recentAttempts',
                'siswaSekarangBelajar',
                'isGuru',
                'isAdmin'
            ));
        }

        $jumlahMateri = Materi::count();
        $jumlahQuiz = Quiz::count();
        $jumlahSiswa = User::siswa()->count();
        $jumlahGuru = User::guru()->count();

        $latestMateri = Materi::with(['guru', 'tingkatKesulitan', 'kategori'])
            ->latest()
            ->take(5)
            ->get();

        $latestQuiz = Quiz::with('materi')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'jumlahMateri',
            'jumlahQuiz',
            'jumlahSiswa',
            'jumlahGuru',
            'latestMateri',
            'latestQuiz',
            'isAdmin'
        ));
    }
}
