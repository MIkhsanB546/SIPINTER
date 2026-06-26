<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIPINTER — Sistem Informasi Pendidikan Interaktif</title>
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

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            color: var(--si-text-dark);
        }

        .text-si-primary {
            color: var(--si-primary) !important;
        }
        .bg-si-primary {
            background-color: var(--si-primary) !important;
        }
        .border-si-primary {
            border-color: var(--si-primary) !important;
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
        .btn-si-outline {
            color: var(--si-primary);
            border-color: var(--si-primary);
            background-color: transparent;
        }
        .btn-si-outline:hover {
            color: #fff;
            background-color: var(--si-primary);
            border-color: var(--si-primary);
        }

        .navbar-landing {
            background-color: rgba(255, 255, 255, 0.97);
            backdrop-filter: blur(8px);
            border-bottom: 1px solid var(--si-border);
            min-height: 64px;
        }
        .navbar-landing .nav-link {
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: background-color 0.2s, color 0.2s;
        }
        .navbar-landing .nav-link:hover {
            background-color: #E8F0F6;
            color: var(--si-primary) !important;
        }
        .navbar-landing .nav-link.active {
            color: var(--si-primary) !important;
        }

        .hero-section {
            padding: 6rem 0 4rem;
            background: linear-gradient(135deg, #F5F9FC 0%, #E8F0F6 100%);
            min-height: 90vh;
            display: flex;
            align-items: center;
        }

        .feature-card {
            border: 1px solid var(--si-border);
            border-radius: 16px;
            padding: 2rem 1.5rem;
            transition: transform 0.2s, box-shadow 0.2s;
            background: #fff;
            height: 100%;
        }
        .feature-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(9, 88, 144, 0.08);
        }
        .feature-icon {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #fff;
            background-color: var(--si-primary);
            margin-bottom: 1rem;
        }

        .step-card {
            border: none;
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 4px 12px rgba(9, 88, 144, 0.06);
            padding: 1.5rem;
            position: relative;
            height: 100%;
        }
        .step-number {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--si-primary);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.1rem;
            flex-shrink: 0;
        }
        .step-connector {
            display: none;
        }
        @media (min-width: 768px) {
            .step-connector {
                display: block;
                position: absolute;
                bottom: -24px;
                left: 50%;
                transform: translateX(-50%);
                color: var(--si-primary);
                font-size: 1.5rem;
            }
            .step-card-wrapper:last-child .step-connector {
                display: none;
            }
        }

        .stat-card {
            border: none;
            border-radius: 16px;
            padding: 2rem 1rem;
            background: #fff;
            box-shadow: 0 4px 12px rgba(9, 88, 144, 0.06);
            text-align: center;
            height: 100%;
        }
        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--si-primary);
            line-height: 1.2;
        }
        .stat-label {
            color: var(--si-muted);
            font-weight: 500;
            margin-top: 0.25rem;
        }

        .testimonial-card {
            border: 1px solid var(--si-border);
            border-radius: 16px;
            padding: 1.5rem;
            background: #fff;
            height: 100%;
        }
        .testimonial-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background-color: #E8F0F6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: var(--si-primary);
            flex-shrink: 0;
        }

        .footer-landing {
            background-color: #0D1B2A;
            color: rgba(255, 255, 255, 0.7);
        }
        .footer-landing h5 {
            color: #fff;
        }
        .footer-landing a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
        }
        .footer-landing a:hover {
            color: #fff;
        }

        .section-title {
            font-weight: 800;
            color: var(--si-text-dark);
            margin-bottom: 0.5rem;
        }
        .section-subtitle {
            color: var(--si-muted);
            max-width: 600px;
            margin: 0 auto 3rem;
        }

        @media (max-width: 991.98px) {
            .hero-section {
                padding: 5rem 0 3rem;
                min-height: auto;
                text-align: center;
            }
            .hero-section .btn-group {
                justify-content: center;
            }
            .stat-number {
                font-size: 2rem;
            }
        }
    </style>
    @stack('styles')
</head>

<body>

    <!-- ============================================================ -->
    <!-- Navbar -->
    <!-- ============================================================ -->
    <nav class="navbar navbar-expand-lg navbar-landing fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4 d-flex align-items-center gap-2" href="#"
                style="color: var(--si-primary);">
                <img src="{{ asset('images/sipinter-logo.png') }}" alt="SIPINTER" height="36"
                    style="width: auto;">
                SIPINTER
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#landingNav" aria-controls="landingNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="landingNav">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-1">
                    <li class="nav-item">
                        <a class="nav-link active" href="#hero">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#fitur">Fitur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#cara-kerja">Cara Kerja</a>
                    </li>
                    <li class="nav-item ms-lg-2">
                        <a href="{{ route('login') }}" class="btn btn-si-primary rounded-pill px-4 py-2">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- ============================================================ -->
    <!-- Hero -->
    <!-- ============================================================ -->
    <section class="hero-section" id="hero">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-6">
                    <h1 class="display-3 fw-bold mb-3" style="color: var(--si-primary);">
                        SIPINTER
                    </h1>
                    <p class="lead mb-4" style="color: var(--si-muted); font-size: 1.2rem;">
                        Sistem Informasi Pendidikan Interaktif Berbasis Web untuk Mendukung
                        Pendidikan Berkualitas.
                    </p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="{{ route('register') }}" class="btn btn-si-primary btn-lg rounded-pill px-4">
                            <i class="bi bi-play-fill me-1"></i> Mulai Belajar
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-si-outline btn-lg rounded-pill px-4">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="{{ asset('images/sipinter-logo.png') }}" alt="SIPINTER"
                        class="img-fluid" style="max-height: 320px; opacity: 0.9;">
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================================ -->
    <!-- Fitur -->
    <!-- ============================================================ -->
    <section class="py-5" id="fitur" style="background-color: #fff;">
        <div class="container py-4">
            <div class="text-center">
                <h2 class="section-title display-6">Fitur Unggulan</h2>
                <p class="section-subtitle">
                    Berbagai fitur dirancang untuk mendukung pengalaman belajar yang interaktif dan menyenangkan.
                </p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-journal-text"></i>
                        </div>
                        <h5 class="fw-bold">Materi Interaktif</h5>
                        <p class="mb-0" style="color: var(--si-muted);">
                            Materi pembelajaran yang dikemas secara interaktif dan mudah dipahami.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-pencil-square"></i>
                        </div>
                        <h5 class="fw-bold">Quiz Interaktif</h5>
                        <p class="mb-0" style="color: var(--si-muted);">
                            Uji pemahaman melalui quiz interaktif dengan berbagai tingkat kesulitan.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                        <h5 class="fw-bold">Progress Belajar</h5>
                        <p class="mb-0" style="color: var(--si-muted);">
                            Pantau perkembangan belajar secara real-time dan terstruktur.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <h5 class="fw-bold">Sistem Bintang</h5>
                        <p class="mb-0" style="color: var(--si-muted);">
                            Dapatkan bintang sebagai bentuk apresiasi atas hasil belajar.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-folder-plus"></i>
                        </div>
                        <h5 class="fw-bold">Kelola Materi</h5>
                        <p class="mb-0" style="color: var(--si-muted);">
                            Guru dapat dengan mudah menambahkan dan mengelola materi pembelajaran.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-file-earmark-text"></i>
                        </div>
                        <h5 class="fw-bold">Laporan Pembelajaran</h5>
                        <p class="mb-0" style="color: var(--si-muted);">
                            Hasil belajar tersaji dalam laporan yang informatif dan mudah dipahami.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================================ -->
    <!-- Cara Kerja -->
    <!-- ============================================================ -->
    <section class="py-5" id="cara-kerja" style="background-color: var(--si-light-bg);">
        <div class="container py-4">
            <div class="text-center">
                <h2 class="section-title display-6">Cara Kerja</h2>
                <p class="section-subtitle">
                    Mulai perjalanan belajarmu hanya dalam beberapa langkah mudah.
                </p>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-2 step-card-wrapper">
                    <div class="step-card d-flex flex-column align-items-center text-center">
                        <div class="step-number mb-3">1</div>
                        <i class="bi bi-box-arrow-in-right fs-2 mb-2" style="color: var(--si-primary);"></i>
                        <h6 class="fw-bold mb-0">Login</h6>
                        <p class="small text-muted mb-0">Masuk ke akun</p>
                        <div class="step-connector">
                            <i class="bi bi-chevron-down"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-2 step-card-wrapper">
                    <div class="step-card d-flex flex-column align-items-center text-center">
                        <div class="step-number mb-3">2</div>
                        <i class="bi bi-book fs-2 mb-2" style="color: var(--si-primary);"></i>
                        <h6 class="fw-bold mb-0">Pilih Materi</h6>
                        <p class="small text-muted mb-0">Pilih topik belajar</p>
                        <div class="step-connector">
                            <i class="bi bi-chevron-down"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-2 step-card-wrapper">
                    <div class="step-card d-flex flex-column align-items-center text-center">
                        <div class="step-number mb-3">3</div>
                        <i class="bi bi-eye fs-2 mb-2" style="color: var(--si-primary);"></i>
                        <h6 class="fw-bold mb-0">Pelajari Materi</h6>
                        <p class="small text-muted mb-0">Baca dan pahami</p>
                        <div class="step-connector">
                            <i class="bi bi-chevron-down"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-2 step-card-wrapper">
                    <div class="step-card d-flex flex-column align-items-center text-center">
                        <div class="step-number mb-3">4</div>
                        <i class="bi bi-pencil-square fs-2 mb-2" style="color: var(--si-primary);"></i>
                        <h6 class="fw-bold mb-0">Kerjakan Quiz</h6>
                        <p class="small text-muted mb-0">Uji pemahaman</p>
                        <div class="step-connector">
                            <i class="bi bi-chevron-down"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-2 step-card-wrapper">
                    <div class="step-card d-flex flex-column align-items-center text-center">
                        <div class="step-number mb-3">5</div>
                        <i class="bi bi-graph-up-arrow fs-2 mb-2" style="color: var(--si-primary);"></i>
                        <h6 class="fw-bold mb-0">Lihat Progress</h6>
                        <p class="small text-muted mb-0">Pantau hasil</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================================ -->
    <!-- Statistik -->
    <!-- ============================================================ -->
    <section class="py-5" id="statistik" style="background: linear-gradient(135deg, var(--si-primary) 0%, #0A6AAE 100%);">
        <div class="container py-4">
            <div class="text-center mb-5">
                <h2 class="display-6 fw-bold text-white">Statistik SIPINTER</h2>
                <p class="text-white-50">Platform pendidikan yang terus berkembang</p>
            </div>
            <div class="row g-4">
                <div class="col-6 col-lg-3">
                    <div class="stat-card">
                        <div class="stat-number">{{ $jumlahMateri }}</div>
                        <div class="stat-label">Total Materi</div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="stat-card">
                        <div class="stat-number">{{ $jumlahQuiz }}</div>
                        <div class="stat-label">Total Quiz</div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="stat-card">
                        <div class="stat-number">{{ $jumlahGuru }}</div>
                        <div class="stat-label">Pengajar</div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="stat-card">
                        <div class="stat-number">{{ $jumlahSiswa }}</div>
                        <div class="stat-label">Siswa</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================================ -->
    <!-- Testimonial -->
    <!-- ============================================================ -->
    <section class="py-5" style="background-color: #fff;">
        <div class="container py-4">
            <div class="text-center">
                <h2 class="section-title display-6">Apa Kata Mereka</h2>
                <p class="section-subtitle">
                    Pengalaman pengguna yang telah menggunakan SIPINTER dalam proses belajar mengajar.
                </p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="testimonial-card">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="testimonial-avatar">AN</div>
                            <div>
                                <h6 class="fw-bold mb-0">Aulia Nur</h6>
                                <small class="text-muted">Siswa SMA</small>
                            </div>
                        </div>
                        <p class="mb-0" style="color: var(--si-muted);">
                            <i class="bi bi-quote me-1" style="color: var(--si-primary);"></i>
                            Belajar jadi lebih menyenangkan dengan materi interaktif dan quiz yang seru. Sistem
                            bintangnya bikin semangat terus!
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="testimonial-card">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="testimonial-avatar">BP</div>
                            <div>
                                <h6 class="fw-bold mb-0">Budi Pratama</h6>
                                <small class="text-muted">Guru Matematika</small>
                            </div>
                        </div>
                        <p class="mb-0" style="color: var(--si-muted);">
                            <i class="bi bi-quote me-1" style="color: var(--si-primary);"></i>
                            SIPINTER sangat membantu dalam mengelola materi dan quiz. Fitur laporan
                            pembelajarannya memudahkan saya memantau perkembangan siswa.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="testimonial-card">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="testimonial-avatar">CR</div>
                            <div>
                                <h6 class="fw-bold mb-0">Citra Rahmadani</h6>
                                <small class="text-muted">Siswa SMP</small>
                            </div>
                        </div>
                        <p class="mb-0" style="color: var(--si-muted);">
                            <i class="bi bi-quote me-1" style="color: var(--si-primary);"></i>
                            Aku bisa belajar kapan aja dan di mana aja. Progress belajarnya bisa dilihat langsung,
                            jadi tahu bagian mana yang harus dipelajari lagi.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================================ -->
    <!-- CTA -->
    <!-- ============================================================ -->
    <section class="py-5" style="background-color: var(--si-light-bg);">
        <div class="container py-4 text-center">
            <h2 class="display-6 fw-bold mb-3" style="color: var(--si-text-dark);">
                Siap Memulai Perjalanan Belajar?
            </h2>
            <p class="mb-4" style="color: var(--si-muted); max-width: 500px; margin-left: auto; margin-right: auto;">
                Daftar sekarang dan nikmati pengalaman belajar interaktif bersama SIPINTER.
            </p>
            <a href="{{ route('register') }}" class="btn btn-si-primary btn-lg rounded-pill px-5">
                <i class="bi bi-person-plus me-1"></i> Daftar Gratis
            </a>
        </div>
    </section>

    <!-- ============================================================ -->
    <!-- Footer -->
    <!-- ============================================================ -->
    <footer class="footer-landing py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <img src="{{ asset('images/sipinter-logo.png') }}" alt="SIPINTER" height="36"
                            style="width: auto;">
                        <span class="fw-bold fs-5 text-white">SIPINTER</span>
                    </div>
                    <p style="font-size: 0.9rem;">
                        Sistem Informasi Pendidikan Interaktif Berbasis Web untuk Mendukung
                        Pendidikan Berkualitas.
                    </p>
                </div>
                <div class="col-lg-4 offset-lg-4">
                    <h5>Tentang</h5>
                    <p style="font-size: 0.9rem;">
                        SIPINTER dikembangkan oleh Kelompok 10 IT Bootcamp sebagai platform
                        pembelajaran interaktif untuk mendukung pendidikan yang berkualitas.
                    </p>
                    <p class="mb-0" style="font-size: 0.9rem;">
                        <i class="bi bi-people-fill me-1"></i> Kelompok 10 IT Bootcamp
                    </p>
                </div>
            </div>
            <hr class="my-4" style="border-color: rgba(255,255,255,0.15);">
            <div class="text-center">
                <p class="mb-0 small">
                    &copy; {{ date('Y') }} <strong>SIPINTER</strong>. Kelompok 10 IT Bootcamp.
                </p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous">
    </script>

    <script>
        (function() {
            var nav = document.getElementById('landingNav');
            var links = nav.querySelectorAll('.nav-link:not([data-bs-toggle])');
            for (var i = 0; i < links.length; i++) {
                links[i].addEventListener('click', function() {
                    var bsCollapse = bootstrap.Collapse.getInstance(nav);
                    if (bsCollapse) {
                        bsCollapse.hide();
                    }
                });
            }

            var sections = document.querySelectorAll('section[id]');
            var navLinks = document.querySelectorAll('.navbar-landing .nav-link');

            function setActiveLink() {
                var scrollY = window.scrollY + 100;

                for (var i = sections.length - 1; i >= 0; i--) {
                    var section = sections[i];
                    if (scrollY >= section.offsetTop) {
                        for (var j = 0; j < navLinks.length; j++) {
                            navLinks[j].classList.remove('active');
                        }
                        var activeLink = document.querySelector(
                            '.navbar-landing .nav-link[href="#' + section.id + '"]'
                        );
                        if (activeLink) {
                            activeLink.classList.add('active');
                        }
                        break;
                    }
                }
            }

            window.addEventListener('scroll', setActiveLink);
            setActiveLink();
        })();
    </script>
    @stack('scripts')
</body>

</html>
