@extends('layouts.student')

@section('title', 'Edit Profil')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-gray-900">Edit Profil</h1>
        <p class="text-gray-500 mt-1 text-lg">Perbarui informasi akun kamu</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 sm:p-8">
            <form action="{{ route('siswa.profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-5">
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-1.5">
                        <i class="bi bi-person me-1 text-[#095890]"></i> Nama Lengkap
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-[#095890] focus:ring-2 focus:ring-[#095890]/20 focus:outline-none transition @error('name') border-red-400 @enderror"
                        placeholder="Masukkan nama lengkap">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">
                        <i class="bi bi-envelope me-1 text-[#095890]"></i> Email
                    </label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-[#095890] focus:ring-2 focus:ring-[#095890]/20 focus:outline-none transition @error('email') border-red-400 @enderror"
                        placeholder="Masukkan email">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <hr class="my-6 border-gray-200">

                <p class="text-sm text-gray-500 mb-4">
                    <i class="bi bi-info-circle me-1 text-[#095890]"></i>
                    Kosongkan password jika tidak ingin mengubahnya.
                </p>

                <div class="mb-5">
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">
                        <i class="bi bi-lock me-1 text-[#095890]"></i> Password Baru
                    </label>
                    <input type="password" name="password" id="password"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-[#095890] focus:ring-2 focus:ring-[#095890]/20 focus:outline-none transition @error('password') border-red-400 @enderror"
                        placeholder="Minimal 8 karakter">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1.5">
                        <i class="bi bi-lock-fill me-1 text-[#095890]"></i> Konfirmasi Password Baru
                    </label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-[#095890] focus:ring-2 focus:ring-[#095890]/20 focus:outline-none transition"
                        placeholder="Ulangi password baru">
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-6 py-2.5 text-sm font-semibold text-white rounded-lg transition hover:brightness-110"
                        style="background-color: #095890;">
                        <i class="bi bi-check-lg"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('siswa.dashboard') }}"
                        class="inline-flex items-center gap-2 px-6 py-2.5 text-sm font-semibold text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                        <i class="bi bi-x-lg"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
