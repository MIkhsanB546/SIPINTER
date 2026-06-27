@extends('layouts.app')

@section('title', 'Profil')

@section('content')
<div class="container-fluid">
    {{-- Success notification --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
            <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        {{-- Left Card: Profil --}}
        <div class="col-lg-5 col-xl-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body text-center p-4">
                    {{-- Avatar --}}
                    <div class="mb-3">
                        @if($user->avatar)
                        <img src="{{ $user->avatar }}"
                             class="rounded-circle border"
                             width="100" height="100"
                             style="object-fit: cover; border-color: #DDE7EF !important;"
                             alt="Avatar">
                        @else
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle"
                             style="width: 100px; height: 100px; background-color: #E8F0F6;">
                            <i class="bi bi-person-circle fs-1" style="color: #095890;"></i>
                        </div>
                        @endif
                    </div>

                    {{-- Nama --}}
                    <h5 class="fw-bold mb-1" style="color: #1E293B;">{{ $user->name }}</h5>

                    {{-- Email --}}
                    <p class="mb-2" style="color: #64748B; font-size: 0.9rem;">
                        <i class="bi bi-envelope me-1"></i>{{ $user->email }}
                    </p>

                    {{-- Role Badge --}}
                    <div class="mb-3">
                        @php
                            $badgeClass = match ($user->role) {
                                'admin' => 'bg-danger',
                                'guru' => 'bg-primary',
                                default => 'bg-secondary',
                            };
                            $roleLabel = match ($user->role) {
                                'admin' => 'Admin',
                                'guru' => 'Guru',
                                'siswa' => 'Siswa',
                                default => $user->role,
                            };
                        @endphp
                        <span class="badge {{ $badgeClass }} rounded-pill px-3 py-1">{{ $roleLabel }}</span>
                    </div>

                    <hr style="border-color: #DDE7EF;">

                    {{-- Google Login Status --}}
                    <div class="text-start mb-3">
                        <small class="fw-semibold d-block mb-1" style="color: #64748B;">Login Google</small>
                        @if($user->google_id)
                        <span class="badge bg-success rounded-pill px-3 py-1">
                            <i class="bi bi-check-circle me-1"></i> Terhubung dengan Google
                        </span>
                        @else
                        <span class="badge bg-secondary rounded-pill px-3 py-1">
                            <i class="bi bi-x-circle me-1"></i> Tidak terhubung
                        </span>
                        @endif
                    </div>

                    {{-- QR Login --}}
                    @if($user->qr_token)
                    <div class="text-start">
                        <small class="fw-semibold d-block mb-2" style="color: #64748B;">QR Login</small>
                        <div class="text-center mb-2">
                            <img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl={{ $user->qr_token }}&choe=UTF-8"
                                 width="120" height="120"
                                 alt="QR Code"
                                 style="border-radius: 8px; border: 1px solid #DDE7EF;">
                        </div>
                        <a href="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl={{ $user->qr_token }}&choe=UTF-8"
                           class="btn btn-outline-secondary btn-sm w-100 rounded-pill"
                           download="qr-{{ $user->qr_token }}.png"
                           style="border-color: #DDE7EF;">
                            <i class="bi bi-download me-1"></i> Unduh QR
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Right Card: Pengaturan Profil --}}
        <div class="col-lg-7 col-xl-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4" style="color: #1E293B;">
                        <i class="bi bi-gear me-2" style="color: #095890;"></i>Pengaturan Profil
                    </h5>

                    {{-- Error validation --}}
                    @if($errors->any())
                    <div class="alert alert-danger rounded-3">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('dashboard.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Nama --}}
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold" style="color: #1E293B;">
                                <i class="bi bi-person me-1" style="color: #095890;"></i> Nama
                            </label>
                            <input type="text" name="name" id="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $user->name) }}"
                                   style="border-color: #DDE7EF; border-radius: 10px;">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold" style="color: #1E293B;">
                                <i class="bi bi-envelope me-1" style="color: #095890;"></i> Email
                            </label>
                            <input type="email" name="email" id="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email', $user->email) }}"
                                   style="border-color: #DDE7EF; border-radius: 10px;">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr style="border-color: #DDE7EF;">

                        <p class="small mb-3" style="color: #64748B;">
                            <i class="bi bi-info-circle me-1" style="color: #095890;"></i>
                            Kosongkan password jika tidak ingin mengubahnya.
                        </p>

                        {{-- Password Baru --}}
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold" style="color: #1E293B;">
                                <i class="bi bi-lock me-1" style="color: #095890;"></i> Password Baru
                            </label>
                            <input type="password" name="password" id="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   placeholder="Minimal 8 karakter"
                                   style="border-color: #DDE7EF; border-radius: 10px;">
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Konfirmasi Password --}}
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label fw-semibold" style="color: #1E293B;">
                                <i class="bi bi-lock-fill me-1" style="color: #095890;"></i> Konfirmasi Password
                            </label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                   class="form-control"
                                   placeholder="Ulangi password baru"
                                   style="border-color: #DDE7EF; border-radius: 10px;">
                        </div>

                        {{-- Buttons --}}
                        <div class="d-flex gap-2">
                            <button type="submit"
                                    class="btn px-4 py-2 fw-semibold text-white rounded-pill border-0"
                                    style="background-color: #095890;">
                                <i class="bi bi-check-lg me-1"></i> Simpan Perubahan
                            </button>
                            <a href="{{ route('dashboard.profile') }}"
                               class="btn px-4 py-2 fw-semibold rounded-pill"
                               style="background-color: #F1F5F9; color: #64748B; border-color: #DDE7EF;">
                                <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
