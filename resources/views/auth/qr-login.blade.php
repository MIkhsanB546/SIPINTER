{{-- Halaman Scan QR Code SIPINTER --}}
<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Scan QR — SIPINTER</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous">
    <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js" crossorigin="anonymous">
    </script>
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
        #qr-reader {
            border: none !important;
            border-radius: 12px;
            overflow: hidden;
        }
        #qr-reader video {
            border-radius: 12px;
        }
        #qr-reader__scan_region {
            min-height: 280px;
        }
        #qr-reader__dashboard_section_csr span {
            margin: 0 auto;
        }
        #qr-reader__dashboard_section_csr button {
            background-color: var(--si-primary) !important;
            border-color: var(--si-primary) !important;
            border-radius: 999px !important;
            padding: 6px 20px !important;
            color: #fff !important;
            font-size: 0.875rem !important;
        }
        #qr-reader__dashboard_section_csr button:hover {
            background-color: var(--si-primary-hover) !important;
        }
        #qr-reader__status_span {
            font-size: 0.8rem;
            color: var(--si-muted);
        }
        #qr-reader__dashboard_section {
            padding: 0;
        }
        #qr-reader__dashboard_section_csr {
            text-align: center;
            padding: 8px 0;
        }
        #qr-reader__file_selection_input {
            display: none;
        }
        #qr-reader__dashboard_section_csr span:first-child {
            display: none;
        }
        #qr-reader__dashboard_section_csr a {
            display: none !important;
        }
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
                    <p class="mb-0" style="color: #64748B;">Scan QR Code untuk Masuk</p>
                </div>

                <div class="card border-0 shadow rounded-4" style="background-color: #FFFFFF;">
                    <div class="card-body p-4 text-center">

                        <div id="qr-scanner-error" class="alert alert-danger d-none">
                            <i class="bi bi-exclamation-triangle me-1"></i>
                            <span id="qr-scanner-error-text"></span>
                        </div>

                        <div id="qr-reader"></div>

                        <div id="qr-scanner-loading" class="py-4">
                            <div class="spinner-border" style="color: #095890;" role="status">
                                <span class="visually-hidden">Memuat kamera...</span>
                            </div>
                            <p class="mt-2 mb-0" style="color: #64748B;">Mengakses kamera...</p>
                        </div>

                        <hr style="border-color: #DDE7EF;">

                        <a href="{{ route('login') }}" class="btn btn-outline-secondary rounded-pill py-2 w-100" style="border-color: #DDE7EF;">
                            <i class="bi bi-arrow-left me-1"></i> Kembali ke Login
                        </a>

                    </div>
                </div>

                <p class="text-center small mt-4" style="color: #64748B;">&copy; 2026 SIPINTER</p>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const readerEl = document.getElementById('qr-reader');
            const errorEl = document.getElementById('qr-scanner-error');
            const errorText = document.getElementById('qr-scanner-error-text');
            const loadingEl = document.getElementById('qr-scanner-loading');

            function showError(msg) {
                errorText.textContent = msg;
                errorEl.classList.remove('d-none');
                loadingEl.classList.add('d-none');
            }

            function onScanSuccess(decodedText) {
                window.location.href = decodedText;
            }

            const html5QrCode = new Html5Qrcode('qr-reader');

            const config = {
                fps: 10,
                qrbox: { width: 250, height: 250 },
            };

            function isMobile() {
                return /Android|iPhone|iPad|iPod|webOS|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
            }

            const facingMode = isMobile() ? 'environment' : 'user';

            html5QrCode.start(
                { facingMode },
                config,
                onScanSuccess
            ).then(() => {
                loadingEl.classList.add('d-none');
            }).catch((err) => {
                if (isMobile() && facingMode === 'environment') {
                    html5QrCode.start(
                        { facingMode: 'user' },
                        config,
                        onScanSuccess
                    ).then(() => {
                        loadingEl.classList.add('d-none');
                    }).catch(() => {
                        showError(
                            'Kamera tidak dapat diakses. Pastikan Anda telah mengizinkan akses kamera.');
                    });
                } else {
                    showError(
                        'Kamera tidak dapat diakses. Pastikan Anda telah mengizinkan akses kamera.');
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    @stack('scripts')
</body>

</html>
