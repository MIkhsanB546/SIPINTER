<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk — SIPINTER</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous">
    <style>
        :root {
            --si-primary: #095890;
            --si-primary-hover: #0A6AAE;
            --si-light-bg: #F5F9FC;
            --si-border: #DDE7EF;
            --si-text-dark: #1E293B;
            --si-muted: #64748B;
        }
        .text-si-primary { color: var(--si-primary) !important; }
        .bg-si-primary { background-color: var(--si-primary) !important; }
        .border-si-primary { border-color: var(--si-primary) !important; }
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
        a.text-si-primary:hover { color: var(--si-primary-hover) !important; }
    </style>
    @stack('styles')
</head>

<body class="d-flex align-items-center min-vh-100" style="background-color: #F5F9FC;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-11 col-sm-10 col-md-6 col-lg-4">

                <div class="text-center mb-4">
                    <img src="{{ asset('images/sipinter-logo.png') }}" alt="SIPINTER" height="100">
                    <h1 class="mt-3 fw-bold" style="color: #095890;">SIPINTER</h1>
                    <p class="mb-0" style="color: #64748B;">Belajar Interaktif dan Menyenangkan</p>
                </div>

                <div class="card border-0 shadow rounded-4" style="background-color: #FFFFFF;">
                    <div class="card-body p-4">

                        @error('email')
                            <div class="alert alert-danger d-flex align-items-center gap-2 py-2 ps-3 pe-2 rounded-3 mb-3"
                                role="alert">
                                <i class="bi bi-exclamation-circle"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror

                        <form action="{{ route('login') }}" method="post">
                            @csrf

                            <div class="input-group mb-3">
                                <span class="input-group-text bg-white border-end-0 rounded-start-4" style="border-color: #DDE7EF;">
                                    <i class="bi bi-envelope" style="color: #095890;"></i>
                                </span>
                                <div class="form-floating flex-grow-1">
                                    <input id="loginEmail" name="email" type="email"
                                        class="form-control border-start-0 rounded-end-4 @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}" placeholder="name@example.com" style="border-color: #DDE7EF;">
                                    <label for="loginEmail">Email</label>
                                </div>
                            </div>

                            <div class="input-group mb-4">
                                <span class="input-group-text bg-white border-end-0 rounded-start-4" style="border-color: #DDE7EF;">
                                    <i class="bi bi-lock-fill" style="color: #095890;"></i>
                                </span>
                                <div class="form-floating flex-grow-1">
                                    <input id="loginPassword" name="password" type="password"
                                        class="form-control border-start-0 rounded-end-4" placeholder="Password" style="border-color: #DDE7EF;">
                                    <label for="loginPassword">Password</label>
                                </div>
                            </div>

                            <button type="submit" class="btn-si-primary btn w-100 rounded-pill py-2 fw-semibold border-0">
                                Masuk
                            </button>
                        </form>

                        <p class="text-center mt-4 mb-0" style="color: #64748B;">
                            Belum punya akun?
                            <a href="{{ route('register') }}"
                                class="fw-semibold text-decoration-none" style="color: #095890;">Daftar</a>
                        </p>

                    </div>
                </div>

                <p class="text-center small mt-4" style="color: #64748B;">&copy; 2026 SIPINTER</p>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    @stack('scripts')
</body>

</html>
