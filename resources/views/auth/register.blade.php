{{-- Halaman Registrasi SIPINTER --}}
<!doctype html>
<html lang="id">
<head>
    {{-- Meta --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar — SIPINTER</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous">
    <style>
        :root {
            --si-primary: #095890;
            --si-primary-hover: #0A6AAE;
            --si-light-bg: #F5F9FC;
            --si-border: #DDE7EF;
            --si-text-dark: #1E293B;
            --si-muted: #64748B;
        }
        .btn-si-primary {
            color: #fff;
            background-color: var(--si-primary);
            border-color: var(--si-primary);
        }
        .btn-si-primary:hover {
            color: #fff;
            background-color: var(--si-primary-hover);
            border-color: var(--si-primary-hover);
        }
    </style>
    @stack('styles')
</head>
<body class="d-flex align-items-center min-vh-100" style="background-color: #F5F9FC;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-11 col-sm-10 col-md-6 col-lg-4">

                {{-- Header: Logo, Nama Aplikasi, dan Tagline --}}
                <div class="text-center mb-4">
                    <img src="{{ asset('images/sipinter-logo.png') }}" alt="SIPINTER" height="100">
                    <h1 class="mt-3 fw-bold" style="color: #095890;">SIPINTER</h1>
                    <p class="mb-0" style="color: #64748B;">Belajar Interaktif dan Menyenangkan</p>
                </div>

                <div class="card border-0 shadow rounded-4" style="background-color: #FFFFFF;">
                    <div class="card-body p-4">

                        {{-- Notifikasi error validasi --}}
                        @if ($errors->any())
                            <div class="alert alert-danger rounded-3 py-2 ps-3 pe-2 mb-3" role="alert">
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Form Registrasi --}}
                        <form action="{{ route('register') }}" method="post">
                            @csrf

                            {{-- Field Nama Lengkap --}}
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-white border-end-0 rounded-start-4" style="border-color: #DDE7EF;">
                                    <i class="bi bi-person" style="color: #095890;"></i>
                                </span>
                                <div class="form-floating flex-grow-1">
                                    <input id="regName" name="name" type="text"
                                        class="form-control border-start-0 rounded-end-4 @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}" placeholder="Nama Lengkap" style="border-color: #DDE7EF;">
                                    <label for="regName">Nama</label>
                                </div>
                                @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Field Email --}}
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-white border-end-0 rounded-start-4" style="border-color: #DDE7EF;">
                                    <i class="bi bi-envelope" style="color: #095890;"></i>
                                </span>
                                <div class="form-floating flex-grow-1">
                                    <input id="regEmail" name="email" type="email"
                                        class="form-control border-start-0 rounded-end-4 @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}" placeholder="name@example.com" style="border-color: #DDE7EF;">
                                    <label for="regEmail">Email</label>
                                </div>
                                @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Field Password --}}
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-white border-end-0 rounded-start-4" style="border-color: #DDE7EF;">
                                    <i class="bi bi-lock-fill" style="color: #095890;"></i>
                                </span>
                                <div class="form-floating flex-grow-1">
                                    <input id="regPassword" name="password" type="password"
                                        class="form-control border-start-0 rounded-end-4 @error('password') is-invalid @enderror"
                                        placeholder="Password" style="border-color: #DDE7EF;">
                                    <label for="regPassword">Password</label>
                                </div>
                                @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Field Konfirmasi Password --}}
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-white border-end-0 rounded-start-4" style="border-color: #DDE7EF;">
                                    <i class="bi bi-lock" style="color: #095890;"></i>
                                </span>
                                <div class="form-floating flex-grow-1">
                                    <input id="regPasswordConfirm" name="password_confirmation" type="password"
                                        class="form-control border-start-0 rounded-end-4 @error('password') is-invalid @enderror"
                                        placeholder="Konfirmasi Password" style="border-color: #DDE7EF;">
                                    <label for="regPasswordConfirm">Konfirmasi Password</label>
                                </div>
                            </div>

                            {{-- Field Pilih Role (Guru/Siswa) --}}
                            <div class="input-group mb-4">
                                <span class="input-group-text bg-white border-end-0 rounded-start-4" style="border-color: #DDE7EF;">
                                    <i class="bi bi-person-badge" style="color: #095890;"></i>
                                </span>
                                <div class="form-floating flex-grow-1">
                                    <select id="regRole" name="role"
                                        class="form-select border-start-0 rounded-end-4 @error('role') is-invalid @enderror"
                                        style="border-color: #DDE7EF;">
                                        <option value="guru" {{ old('role') === 'guru' ? 'selected' : '' }}>Guru</option>
                                        <option value="siswa" {{ old('role') === 'siswa' ? 'selected' : '' }}>Siswa</option>
                                        <option value="orang_tua" {{ old('role') === 'orang_tua' ? 'selected' : '' }}>Orang Tua</option>
                                    </select>
                                    <label for="regRole">Daftar sebagai</label>
                                </div>
                                @error('role')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Tombol Submit --}}
                            <button type="submit" class="btn-si-primary btn w-100 rounded-pill py-2 fw-semibold border-0">
                                Daftar
                            </button>
                        </form>

                        {{-- Link ke halaman Login --}}
                        <p class="text-center mt-4 mb-0" style="color: #64748B;">
                            Sudah punya akun?
                            <a href="{{ route('login') }}" class="fw-semibold text-decoration-none" style="color: #095890;">Masuk</a>
                        </p>

                    </div>
                </div>

                {{-- Footer --}}
                <p class="text-center small mt-4" style="color: #64748B;">&copy; 2026 SIPINTER</p>

            </div>
        </div>
    </div>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    @stack('scripts')
</body>
</html>
