<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

/**
 * Controller untuk halaman landing (beranda publik).
 */
class LandingController extends Controller
{
    /**
     * Menampilkan halaman beranda dengan statistik umum.
     * Jika sudah login, redirect ke dashboard sesuai role.
     */
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            return match ($user->role) {
                'siswa' => redirect()->route('siswa.dashboard'),
                default => redirect()->route('dashboard.index'),
            };
        }

        $jumlahMateri = Materi::count();
        $jumlahQuiz = Quiz::count();
        $jumlahGuru = User::guru()->count();
        $jumlahSiswa = User::siswa()->count();

        return view('landing.index', compact(
            'jumlahMateri', 'jumlahQuiz', 'jumlahGuru', 'jumlahSiswa'
        ));
    }
}
