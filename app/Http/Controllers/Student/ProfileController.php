<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Controller untuk pengelolaan profil siswa.
 */
class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil siswa.
     */
    public function index()
    {
        return view('student.profile.index', ['user' => Auth::user()]);
    }

    /**
     * Memperbarui data profil siswa.
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

        return redirect()->route('siswa.profile')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}
