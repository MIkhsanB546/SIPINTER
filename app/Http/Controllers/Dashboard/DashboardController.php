<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use App\Models\Quiz;
use App\Models\User;
use App\Models\QuizAttempt;
use Illuminate\Support\Facades\Auth;

/**
 * Controller untuk dashboard admin dan guru.
 */
class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard dengan statistik sesuai role.
     * Guru melihat data materinya sendiri, admin melihat seluruh data.
     */
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

            $latestMateri = Materi::with(['guru', 'jenjang', 'kategori'])
                ->where('id_guru', $idGuru)
                ->latest()
                ->take(5)
                ->get();

            $latestQuiz = Quiz::with('materi')
                ->whereIn('id_materi', Materi::where('id_guru', $idGuru)->select('id_materi'))
                ->latest()
                ->take(5)
                ->get();

            return view('dashboard.index', compact(
                'jumlahMateri',
                'jumlahQuiz',
                'jumlahSiswa',
                'rataNilai',
                'latestMateri',
                'latestQuiz',
                'isGuru',
                'isAdmin'
            ));
        }

        // Data untuk admin
        $jumlahMateri = Materi::count();
        $jumlahQuiz = Quiz::count();
        $jumlahSiswa = User::siswa()->count();
        $jumlahGuru = User::guru()->count();

        $latestMateri = Materi::with(['guru', 'jenjang', 'kategori'])
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
