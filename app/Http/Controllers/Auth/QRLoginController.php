<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QRLoginController extends Controller
{
    public function show()
    {
        return view('auth.qr-login');
    }

    public function login($token)
    {
        $user = User::where('qr_token', $token)->first();

        if (!$user) {
            return redirect()->route('login')->withErrors(['qr' => 'QR Code tidak valid.']);
        }

        Auth::login($user);

        return match ($user->role) {
            'admin', 'guru' => redirect()->route('dashboard.index'),
            default => redirect()->route('siswa.dashboard'),
        };
    }
}
