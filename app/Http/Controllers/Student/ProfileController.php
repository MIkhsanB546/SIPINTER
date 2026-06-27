<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\QuizAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

    /**
     * Menghapus akun siswa beserta seluruh data terkait.
     */
    public function destroy(Request $request)
    {
        $user = Auth::user();

        if ($user->role !== 'siswa') {
            abort(403);
        }

        DB::transaction(function () use ($user) {
            QuizAttempt::where('id_siswa', $user->id_user)->delete();

            $user->delete();
        });

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Akun berhasil dihapus.');
    }
}
