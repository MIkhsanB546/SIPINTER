<?php

namespace App\Policies;

use App\Models\Materi;
use App\Models\User;

class MateriPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Materi $materi): bool
    {
        if ($user->role === 'admin') return true;
        if ($user->role === 'guru') return $materi->id_guru === $user->id_user;
        return $materi->is_published;
    }

    public function create(User $user): bool
    {
        return $user->role === 'admin' || $user->role === 'guru';
    }

    public function update(User $user, Materi $materi): bool
    {
        if ($user->role === 'admin') return true;
        return $user->role === 'guru' && $materi->id_guru === $user->id_user;
    }

    public function delete(User $user, Materi $materi): bool
    {
        if ($user->role === 'admin') return true;
        return $user->role === 'guru' && $materi->id_guru === $user->id_user;
    }
}
