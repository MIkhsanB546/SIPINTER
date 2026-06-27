<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Controller untuk pengelolaan profil admin/guru.
 */
class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil.
     */
    public function index()
    {
        return view('dashboard.profile.index', ['user' => Auth::user()]);
    }

    /**
     * Memperbarui data profil pengguna.
     */
    public function update(UpdateProfileRequest $request)
    {
        $user = Auth::user();

        $validated = $request->validated();

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if ($validated['password']) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('dashboard.profile')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}
