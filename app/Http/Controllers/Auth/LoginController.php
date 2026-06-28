<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Controller untuk menampilkan form login dan memproses login.
 */
class LoginController extends Controller
{
    /**
     * Menampilkan form login.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Memproses login dan mengarahkan sesuai role.
     */
    public function store(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            return match ($user->role) {
                'admin', 'guru' => redirect()->intended('/dashboard'),
                'siswa' => redirect()->intended('/siswa'),
                'orang_tua' => redirect()->intended('/orang-tua'),
                default => redirect()->intended('/dashboard'),
            };
        }

        return back()->withErrors([
            'email' => trans('auth.failed'),
        ])->onlyInput('email');
    }
}
