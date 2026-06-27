@extends('layouts.student')

@section('title', 'Profil Saya')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Left Card: Profil --}}
    <div class="lg:col-span-1">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 h-full">
            <div class="p-6 flex flex-col items-center">

                {{-- Avatar --}}
                <div class="mb-4">
                    @if($user->avatar)
                    <img src="{{ $user->avatar }}"
                         class="w-28 h-28 rounded-full object-cover border"
                         style="border-color: #DDE7EF;"
                         alt="Avatar">
                    @else
                    <div class="w-28 h-28 rounded-full flex items-center justify-center"
                         style="background-color: #E8F0F6;">
                        <i class="bi bi-person-circle text-5xl" style="color: #095890;"></i>
                    </div>
                    @endif
                </div>

                {{-- Nama --}}
                <h5 class="text-lg font-bold text-center mb-1" style="color: #1E293B;">{{ $user->name }}</h5>

                {{-- Email --}}
                <p class="text-sm text-center mb-3" style="color: #64748B;">
                    <i class="bi bi-envelope me-1"></i>{{ $user->email }}
                </p>

                {{-- Role Badge --}}
                @php
                    $badgeClass = match ($user->role) {
                        'admin' => 'bg-red-500',
                        'guru' => 'bg-blue-500',
                        default => 'bg-gray-500',
                    };
                    $roleLabel = match ($user->role) {
                        'admin' => 'Admin',
                        'guru' => 'Guru',
                        'siswa' => 'Siswa',
                        default => $user->role,
                    };
                @endphp
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold text-white {{ $badgeClass }}">
                    {{ $roleLabel }}
                </span>

                <hr class="w-full my-5" style="border-color: #DDE7EF;">

                {{-- Google Login Status --}}
                <div class="w-full mb-4">
                    <p class="text-xs font-semibold mb-1.5" style="color: #64748B;">Login Google</p>
                    @if($user->google_id)
                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-green-50 text-green-700">
                        <i class="bi bi-check-circle"></i> Terhubung dengan Google
                    </span>
                    @else
                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-600">
                        <i class="bi bi-x-circle"></i> Tidak terhubung
                    </span>
                    @endif
                </div>

                {{-- QR Login --}}
                @if($user->qr_token)
                <div class="w-full">
                    <p class="text-xs font-semibold mb-2" style="color: #64748B;">QR Login</p>
                    <div class="flex justify-center mb-2">
                        <img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl={{ $user->qr_token }}&choe=UTF-8"
                             class="w-28 h-28"
                             style="border-radius: 8px; border: 1px solid #DDE7EF;"
                             alt="QR Code">
                    </div>
                    <a href="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl={{ $user->qr_token }}&choe=UTF-8"
                       class="flex items-center justify-center gap-1 w-full px-3 py-1.5 text-xs font-medium rounded-full transition-colors"
                       style="border: 1px solid #DDE7EF; color: #64748B;"
                       download="qr-{{ $user->qr_token }}.png">
                        <i class="bi bi-download"></i> Unduh QR
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Right Card: Pengaturan Profil --}}
    <div class="lg:col-span-2">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
            <div class="p-6">
                <h5 class="text-lg font-bold mb-6" style="color: #1E293B;">
                    <i class="bi bi-gear me-2" style="color: #095890;"></i>Pengaturan Profil
                </h5>

                {{-- Error validation --}}
                @if($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 text-red-800 rounded-xl p-4 mb-6">
                    <ul class="list-disc list-inside text-sm space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('siswa.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Nama --}}
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-semibold mb-1.5" style="color: #1E293B;">
                            <i class="bi bi-person me-1" style="color: #095890;"></i> Nama
                        </label>
                        <input type="text" name="name" id="name"
                               value="{{ old('name', $user->name) }}"
                               class="w-full px-4 py-2.5 rounded-xl border text-sm transition duration-150 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('name') border-red-400 @enderror"
                               style="border-color: #DDE7EF;">
                        @error('name')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-semibold mb-1.5" style="color: #1E293B;">
                            <i class="bi bi-envelope me-1" style="color: #095890;"></i> Email
                        </label>
                        <input type="email" name="email" id="email"
                               value="{{ old('email', $user->email) }}"
                               class="w-full px-4 py-2.5 rounded-xl border text-sm transition duration-150 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('email') border-red-400 @enderror"
                               style="border-color: #DDE7EF;">
                        @error('email')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <hr class="my-5" style="border-color: #DDE7EF;">

                    <p class="text-xs mb-4" style="color: #64748B;">
                        <i class="bi bi-info-circle me-1" style="color: #095890;"></i>
                        Kosongkan password jika tidak ingin mengubahnya.
                    </p>

                    {{-- Password Baru --}}
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-semibold mb-1.5" style="color: #1E293B;">
                            <i class="bi bi-lock me-1" style="color: #095890;"></i> Password Baru
                        </label>
                        <input type="password" name="password" id="password"
                               placeholder="Minimal 8 karakter"
                               class="w-full px-4 py-2.5 rounded-xl border text-sm transition duration-150 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('password') border-red-400 @enderror"
                               style="border-color: #DDE7EF;">
                        @error('password')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div class="mb-6">
                        <label for="password_confirmation" class="block text-sm font-semibold mb-1.5" style="color: #1E293B;">
                            <i class="bi bi-lock-fill me-1" style="color: #095890;"></i> Konfirmasi Password
                        </label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                               placeholder="Ulangi password baru"
                               class="w-full px-4 py-2.5 rounded-xl border text-sm transition duration-150 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                               style="border-color: #DDE7EF;">
                    </div>

                    {{-- Buttons --}}
                    <div class="flex items-center gap-3">
                        <button type="submit"
                                class="inline-flex items-center gap-2 px-6 py-2.5 text-sm font-semibold text-white rounded-xl transition-colors duration-150 hover:brightness-110"
                                style="background-color: #095890;">
                            <i class="bi bi-check-lg"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('siswa.profile') }}"
                           class="inline-flex items-center gap-2 px-6 py-2.5 text-sm font-semibold rounded-xl transition-colors duration-150"
                           style="background-color: #F1F5F9; color: #64748B; border: 1px solid #DDE7EF;">
                            <i class="bi bi-arrow-counterclockwise"></i> Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
