<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\QuizAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    private function getLayoutAndPrefix(): array
    {
        $role = Auth::user()->role;

        $layout = match ($role) {
            'siswa' => 'layouts.student',
            'orang_tua' => 'layouts.orang_tua',
            'guru' => 'layouts.guru',
            default => 'layouts.app',
        };

        $routePrefix = match ($role) {
            'siswa' => 'siswa.',
            'orang_tua' => 'orang-tua.',
            'guru' => 'guru.',
            default => 'dashboard.',
        };

        return [$layout, $routePrefix];
    }

    public function index()
    {
        $user = Auth::user();
        [$layout, $routePrefix] = $this->getLayoutAndPrefix();

        return view('profile.index', compact('user', 'layout', 'routePrefix'));
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = Auth::user();
        [$layout, $routePrefix] = $this->getLayoutAndPrefix();

        $validated = $request->validated();

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if ($validated['password']) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route($routePrefix . 'profile')
            ->with('success', 'Profil berhasil diperbarui.');
    }

    public function destroy(Request $request)
    {
        $user = Auth::user();

        DB::transaction(function () use ($user) {
            if ($user->role === 'siswa') {
                QuizAttempt::where('id_siswa', $user->id_user)->delete();
            }

            $user->delete();
        });

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Akun berhasil dihapus.');
    }
}
