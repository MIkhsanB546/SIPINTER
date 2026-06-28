<?php

namespace App\Providers;

use App\Models\Materi;
use App\Models\Quiz;
use App\Models\Soal;
use App\Policies\MateriPolicy;
use App\Policies\QuizPolicy;
use App\Policies\SoalPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::policy(Materi::class, MateriPolicy::class);
        Gate::policy(Quiz::class, QuizPolicy::class);
        Gate::policy(Soal::class, SoalPolicy::class);

        Gate::define('admin', fn($user) => $user->role === 'admin');
        Gate::define('guru', fn($user) => $user->role === 'guru');
        Gate::define('siswa', fn($user) => $user->role === 'siswa');
        Gate::define('orang_tua', fn($user) => $user->role === 'orang_tua');
    }
}
