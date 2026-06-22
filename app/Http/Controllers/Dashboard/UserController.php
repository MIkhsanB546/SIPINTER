<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        return view('dashboard.users.index', compact('users'));
    }

    public function create()
    {
        return view('dashboard.users.create');
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        User::create($data);

        return redirect()->route('dashboard.users.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('dashboard.users.edit', compact('user'));
    }

    public function update(StoreUserRequest $request, User $user)
    {
        $data = $request->validated();

        if ($data['password']) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('dashboard.users.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if ($user->id_user === auth()->id()) {
            return back()->with('error', 'Tidak dapat menghapus akun sendiri.');
        }

        $user->delete();

        return redirect()->route('dashboard.users.index')
            ->with('success', 'User berhasil dihapus.');
    }
}
