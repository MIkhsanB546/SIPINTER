<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Quiz;
use App\Models\User;

class LandingController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            $role = auth()->user()->role;
            return match ($role) {
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
