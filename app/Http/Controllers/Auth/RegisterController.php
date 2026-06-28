<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

/**
 * Controller untuk registrasi pengguna baru.
 */
class RegisterController extends Controller
{
    /**
     * Menampilkan form registrasi.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Memproses registrasi dan login otomatis setelahnya.
     */
    public function store(RegisterRequest $request)
    {
        $data = $request->validated();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role' => $data['role'],
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        return match ($user->role) {
            'guru' => redirect()->intended('/dashboard'),
            'siswa' => redirect()->intended('/siswa'),
            'orang_tua' => redirect()->intended('/orang-tua'),
            default => redirect()->intended('/dashboard'),
        };
    }
}
