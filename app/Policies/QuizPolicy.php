<?php

namespace App\Policies;

use App\Models\Quiz;
use App\Models\User;

class QuizPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Quiz $quiz): bool
    {
        if ($user->role === 'admin') return true;
        if ($user->role === 'guru') return $quiz->materi->id_guru === $user->id_user;
        return true;
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'guru']);
    }

    public function update(User $user, Quiz $quiz): bool
    {
        if ($user->role === 'admin') return true;
        return $user->role === 'guru' && $quiz->materi->id_guru === $user->id_user;
    }

    public function delete(User $user, Quiz $quiz): bool
    {
        if ($user->role === 'admin') return true;
        return $user->role === 'guru' && $quiz->materi->id_guru === $user->id_user;
    }
}
