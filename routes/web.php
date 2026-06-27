<?php

use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\QRLoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\MateriController as DashboardMateriController;
use App\Http\Controllers\Dashboard\QuizController as DashboardQuizController;
use App\Http\Controllers\Dashboard\SoalController as DashboardSoalController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\JenjangController;
use App\Http\Controllers\Dashboard\KategoriMateriController;
use App\Http\Controllers\Dashboard\HasilSiswaController;
use App\Http\Controllers\Dashboard\LaporanController;
use App\Http\Controllers\Dashboard\ProfileController as DashboardProfileController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\MateriController as StudentMateriController;
use App\Http\Controllers\Student\QuizController as StudentQuizController;
use App\Http\Controllers\Student\ProfileController as StudentProfileController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\StyleGuideController;
use Illuminate\Support\Facades\Route;

Route::get('/styleguide', [StyleGuideController::class, 'index'])->name('styleguide');
Route::get('/styleguide/student', [StyleGuideController::class, 'student'])->name('styleguide.student');
Route::get('/styleguide/admin', [StyleGuideController::class, 'admin'])->name('styleguide.admin');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);

    Route::get('/auth/google', [GoogleAuthController::class, 'redirect'])->name('google-auth');
    Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback']);

    Route::get('/login/qr', [QRLoginController::class, 'show'])->name('login.qr');
    Route::get('/login/qr/{token}', [QRLoginController::class, 'login'])->name('login.qr.process');
});

Route::get('/', [LandingController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LogoutController::class, 'destroy'])->name('logout');

    // ============================================================
    // Admin & Guru Dashboard
    // ============================================================
    Route::middleware('admin-guru')->prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');

        Route::get('/profile', [DashboardProfileController::class, 'index'])->name('profile');
        Route::put('/profile', [DashboardProfileController::class, 'update'])->name('profile.update');

        Route::resource('materi', DashboardMateriController::class)->parameters([
            'materi' => 'materi'
        ]);

        Route::resource('quiz', DashboardQuizController::class)->parameters([
            'quiz' => 'quiz'
        ]);

        Route::prefix('quiz/{quiz}/soal')->name('quiz.soal.')->group(function () {
            Route::get('/', [DashboardSoalController::class, 'index'])->name('index');
            Route::get('/create', [DashboardSoalController::class, 'create'])->name('create');
            Route::post('/', [DashboardSoalController::class, 'store'])->name('store');
            Route::get('/{soal}/edit', [DashboardSoalController::class, 'edit'])->name('edit');
            Route::put('/{soal}', [DashboardSoalController::class, 'update'])->name('update');
            Route::delete('/{soal}', [DashboardSoalController::class, 'destroy'])->name('destroy');
        });

        Route::get('/hasil-siswa', [HasilSiswaController::class, 'index'])->name('hasil-siswa');

        // Admin-only routes
        Route::middleware('admin')->group(function () {
            Route::resource('users', UserController::class)->parameters([
                'user' => 'user'
            ]);
            Route::resource('jenjang', JenjangController::class)->parameters([
                'jenjang' => 'jenjang'
            ]);
            Route::resource('kategori', KategoriMateriController::class)->parameters([
                'kategori' => 'kategori'
            ]);
            Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
            Route::get('/laporan/export-pengguna', [LaporanController::class, 'exportPenggunaPdf'])->name('laporan.export-pengguna');
            Route::get('/laporan/export-materi', [LaporanController::class, 'exportMateriPdf'])->name('laporan.export-materi');
            Route::get('/laporan/export-progress', [LaporanController::class, 'exportProgressPdf'])->name('laporan.export-progress');
        });
    });

    // ============================================================
    // Siswa Dashboard
    // ============================================================
    Route::middleware('siswa')->prefix('siswa')->name('siswa.')->group(function () {
        Route::get('/', [StudentDashboardController::class, 'index'])->name('dashboard');

        Route::get('/materi', [StudentMateriController::class, 'index'])->name('materi.index');
        Route::get('/materi/{materi}', [StudentMateriController::class, 'show'])->name('materi.show');

        Route::get('/quiz', [StudentQuizController::class, 'index'])->name('quiz.index');
        Route::get('/quiz/{quiz}/start', [StudentQuizController::class, 'start'])->name('quiz.start');
        Route::post('/quiz/{quiz}/submit/{attempt}', [StudentQuizController::class, 'submit'])->name('quiz.submit');
        Route::get('/quiz/{quiz}/result/{attempt}', [StudentQuizController::class, 'result'])->name('quiz.result');
        Route::get('/quiz-history', [StudentQuizController::class, 'history'])->name('quiz.history');

        Route::get('/profile', [StudentProfileController::class, 'index'])->name('profile');
        Route::put('/profile', [StudentProfileController::class, 'update'])->name('profile.update');
    });
});
