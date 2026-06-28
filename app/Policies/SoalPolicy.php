<?php

namespace App\Policies;

use App\Models\Soal;
use App\Models\User;

class SoalPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Soal $soal): bool
    {
        if ($user->role === 'admin') return true;
        if ($user->role === 'guru') return $soal->quiz->materi->id_guru === $user->id_user;
        return false;
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'guru']);
    }

    public function update(User $user, Soal $soal): bool
    {
        if ($user->role === 'admin') return true;
        return $user->role === 'guru' && $soal->quiz->materi->id_guru === $user->id_user;
    }

    public function delete(User $user, Soal $soal): bool
    {
        if ($user->role === 'admin') return true;
        return $user->role === 'guru' && $soal->quiz->materi->id_guru === $user->id_user;
    }
}
