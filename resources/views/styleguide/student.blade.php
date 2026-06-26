<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Style Guide Siswa — SIPINTER</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        :root {
            --si-primary: #095890;
            --si-primary-hover: #0A6AAE;
            --si-light-bg: #F5F9FC;
            --si-border: #DDE7EF;
            --si-text-dark: #1E293B;
            --si-muted: #64748B;
        }

        * {
            scroll-margin-top: 80px;
        }

        body {
            font-family: 'Inter', 'Source Sans 3', sans-serif;
            background: #f4f6f9;
            color: #1E293B;
        }

        .sg-header {
            background: linear-gradient(135deg, var(--si-primary), var(--si-primary-hover));
            color: #fff;
            padding: 40px 0 28px;
        }

        .sg-header h1 {
            font-size: 2rem;
            font-weight: 800;
        }

        .sg-header p {
            opacity: .85;
            font-size: 1rem;
        }

        .sg-section {
            padding: 32px 0;
        }

        .sg-section:nth-child(even) {
            background: #fff;
        }

        .sg-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--si-primary);
            margin-bottom: 1.25rem;
            padding-bottom: .35rem;
            border-bottom: 3px solid var(--si-primary);
        }

        .sg-sub {
            font-size: .9rem;
            font-weight: 600;
            color: var(--si-text-dark);
            margin-bottom: .75rem;
        }

        .sg-code {
            background: #1e293b;
            color: #e2e8f0;
            border-radius: 8px;
            padding: 16px;
            font-size: .78rem;
            overflow-x: auto;
            margin-top: 12px;
        }

        .sg-code code {
            white-space: pre;
        }

        .color-card {
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid var(--si-border);
            background: #fff;
        }

        .color-swatch {
            height: 70px;
        }

        .color-body {
            padding: 10px 14px;
        }

        .color-body code {
            font-size: .75rem;
        }

        .sg-preview-wrap {
            border: 1px solid var(--si-border);
            border-radius: 12px;
            overflow: hidden;
            background: #fff;
        }

        .sg-preview-body {
            padding: 20px;
        }

        .nav-pills-sg .nav-link {
            border-radius: 8px;
            padding: 8px 18px;
            font-size: .9rem;
            font-weight: 600;
            transition: all .2s;
        }

        .nav-pills-sg .nav-link.active {
            background: var(--si-primary);
            color: #fff;
        }

        .nav-pills-sg .nav-link:not(.active) {
            color: var(--si-muted);
        }

        .nav-pills-sg .nav-link:not(.active):hover {
            background: #E8F0F6;
            color: var(--si-primary);
        }

        .btn-si-primary {
            background: var(--si-primary);
            color: #fff;
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <header class="sg-header">
        <div class="container">
            <h1>Style Guide Siswa</h1>
            <p>Panduan desain Frontend Siswa SIPINTER</p>
            <div class="mt-3 d-flex gap-2 flex-wrap">
                <a href="{{ route('styleguide.student') }}" class="btn btn-light btn-sm fw-semibold">Style Guide
                    Siswa</a>
                <a href="{{ route('styleguide.admin') }}" class="btn btn-outline-light btn-sm fw-semibold">Style Guide
                    Admin</a>
            </div>
        </div>
    </header>

    <main class="container py-4">

        <!-- ============================================================ -->
        <!-- 1. PALET WARNA -->
        <!-- ============================================================ -->
        <section class="sg-section" id="warna">
            <h2 class="sg-title">1. Palet Warna</h2>
            <p class="text-muted mb-4">Variabel CSS yang didefinisikan di <code>:root</code> pada
                <code>layouts/student.blade.php</code>.
            </p>
            @php
                $studentColors = [
                    ['#095890', '--si-primary', 'Warna utama brand, tombol, tautan, status aktif'],
                    ['#0A6AAE', '--si-primary-hover', 'Warna hover untuk elemen utama'],
                    ['#F5F9FC', '--si-light-bg', 'Latar belakang halaman, kartu'],
                    ['#DDE7EF', '--si-border', 'Batas kartu, batas input, pembatas'],
                    ['#1E293B', '--si-text-dark', 'Judul, teks utama (Tailwind gray-900)'],
                    ['#64748B', '--si-muted', 'Teks sekunder, caption, placeholder'],
                ];
            @endphp
            <div class="row g-3">
                @foreach ($studentColors as $c)
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="color-card">
                            <div class="color-swatch" style="background:{{ $c[0] }}"></div>
                            <div class="color-body">
                                <code>{{ $c[1] }}</code>
                                <div class="fw-semibold small">{{ $c[0] }}</div>
                                <p class="text-muted small mb-0 mt-1">{{ $c[2] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- ============================================================ -->
        <!-- 2. TIPOGRAFI -->
        <!-- ============================================================ -->
        <section class="sg-section" id="tipografi">
            <h2 class="sg-title">2. Tipografi</h2>
            <p class="text-muted mb-4">Font utama: <strong>Inter</strong> via Tailwind. Contoh teks diambil dari halaman
                siswa.</p>
            <div class="sg-preview-wrap">
                <div class="sg-preview-body">
                    <p class="text-3xl font-extrabold text-gray-900">Halo, Ikhsan! 👋</p>
                    <p class="text-gray-500 mt-1 text-lg">Lanjutkan perjalanan belajarmu hari ini!</p>
                    <hr class="my-3">
                    <h2 class="text-xl font-bold text-gray-900">Lanjutkan Belajar</h2>
                    <p class="text-sm text-gray-500 mt-1">Progress Keseluruhan — teks kecil pada kartu statistik</p>
                    <p class="text-xs text-gray-500 font-medium mt-2">4 dari 8 Quiz Selesai — label / caption</p>
                    <hr class="my-3">
                    <p class="text-lg font-semibold text-gray-900">Edit Profil</p>
                    <p class="text-sm font-semibold text-gray-700 mb-1.5">Nama Lengkap — label form</p>
                    <p class="text-xs text-gray-500"><i class="bi bi-info-circle me-1 text-[#095890]"></i> Kosongkan
                        password jika tidak ingin mengubahnya.</p>
                </div>
            </div>
        </section>

        <!-- ============================================================ -->
        <!-- 3. TOMBOL -->
        <!-- ============================================================ -->
        <section class="sg-section" id="tombol">
            <h2 class="sg-title">3. Tombol</h2>
            <p class="text-muted mb-4">Tombol yang benar-benar digunakan di halaman siswa.</p>

            <p class="sg-sub">Tombol Primary (dashboard CTA)</p>
            <div class="sg-preview-wrap mb-4">
                <div class="sg-preview-body">
                    <a href="#"
                        class="inline-flex items-center px-6 py-2.5 bg-indigo-600 text-white rounded-xl text-sm font-semibold hover:bg-indigo-700 transition-colors shadow-sm">
                        Lihat Quiz Tersedia
                    </a>
                    <div class="sg-code mt-3"><code>&lt;a href="#"
                            class="inline-flex items-center px-6 py-2.5 bg-indigo-600 text-white rounded-xl text-sm font-semibold hover:bg-indigo-700 transition-colors shadow-sm"&gt;Lihat
                            Quiz Tersedia&lt;/a&gt;</code></div>
                </div>
            </div>

            <p class="sg-sub">Tombol Outline (kartu quiz / materi)</p>
            <div class="sg-preview-wrap mb-4">
                <div class="sg-preview-body">
                    <a href="#"
                        class="inline-flex items-center justify-center w-full px-4 py-2.5 bg-indigo-50 text-indigo-700 rounded-xl text-sm font-semibold hover:bg-indigo-100 transition-colors"
                        style="max-width:250px">
                        Kerjakan Quiz <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                    <div class="sg-code mt-3"><code>&lt;a href="#"
                            class="inline-flex items-center justify-center w-full px-4 py-2.5 bg-indigo-50 text-indigo-700 rounded-xl text-sm font-semibold hover:bg-indigo-100 transition-colors"&gt;Kerjakan
                            Quiz &lt;i class="bi bi-arrow-right ms-1"&gt;&lt;/i&gt;&lt;/a&gt;</code></div>
                </div>
            </div>

            <p class="sg-sub">Tombol Simpan &amp; Batal (form profil)</p>
            <div class="sg-preview-wrap mb-4">
                <div class="sg-preview-body">
                    <div class="d-flex gap-3">
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-6 py-2.5 text-sm font-semibold text-white rounded-lg transition hover:brightness-110"
                            style="background-color: #095890;">
                            <i class="bi bi-check-lg"></i> Simpan Perubahan
                        </button>
                        <a href="#"
                            class="inline-flex items-center gap-2 px-6 py-2.5 text-sm font-semibold text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                            <i class="bi bi-x-lg"></i> Batal
                        </a>
                    </div>
                    <div class="sg-code mt-3"><code>&lt;button type="submit"
                            class="inline-flex items-center gap-2 px-6 py-2.5 text-sm font-semibold text-white rounded-lg transition hover:brightness-110"
                            style="background-color: #095890;"&gt;&lt;i class="bi bi-check-lg"&gt;&lt;/i&gt; Simpan
                            Perubahan&lt;/button&gt;</code></div>
                </div>
            </div>

            <p class="sg-sub">Tombol Masuk (login — rounded-pill)</p>
            <div class="sg-preview-wrap">
                <div class="sg-preview-body">
                    <button class="btn-si-primary btn w-100 rounded-pill py-2 fw-semibold border-0"
                        style="max-width:200px">Masuk</button>
                    <div class="sg-code mt-3"><code>&lt;button
                            class="btn-si-primary btn w-100 rounded-pill py-2 fw-semibold border-0"&gt;Masuk&lt;/button&gt;</code>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================================ -->
        <!-- 4. KARTU -->
        <!-- ============================================================ -->
        <section class="sg-section" id="kartu">
            <h2 class="sg-title">4. Kartu</h2>
            <p class="text-muted mb-4">Kartu yang diambil langsung dari halaman dashboard siswa.</p>

            <p class="sg-sub">Kartu Statistik (grid 4 kolom)</p>
            <div class="sg-preview-wrap mb-4">
                <div class="sg-preview-body">
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                            <div class="flex items-center justify-between mb-3">
                                <div class="text-3xl font-black text-indigo-600">65%</div>
                                <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center">
                                    <i class="bi bi-graph-up text-indigo-500 text-lg"></i>
                                </div>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-2.5">
                                <div class="bg-indigo-500 h-2.5 rounded-full" style="width:65%"></div>
                            </div>
                            <p class="text-xs text-gray-500 mt-2 font-medium">Progress Keseluruhan</p>
                            <p class="text-xs text-gray-400 mt-0.5">5 dari 8 Quiz Selesai</p>
                        </div>
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                            <div class="flex items-center justify-between mb-3">
                                <div class="text-3xl font-black text-emerald-600">85.5</div>
                                <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center">
                                    <i class="bi bi-trophy text-emerald-500 text-lg"></i>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 font-medium">Rata-rata Skor</p>
                        </div>
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                            <div class="flex items-center justify-between mb-3">
                                <div class="text-3xl font-black text-amber-500">5</div>
                                <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center">
                                    <i class="bi bi-check-circle text-amber-500 text-lg"></i>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 font-medium">Quiz Diselesaikan</p>
                        </div>
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                            <div class="flex items-center justify-between mb-3">
                                <div class="text-3xl font-black text-sky-500">12</div>
                                <div class="w-10 h-10 rounded-xl bg-sky-50 flex items-center justify-center">
                                    <i class="bi bi-star-fill text-sky-500 text-lg"></i>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 font-medium">Bintang Terkumpul</p>
                        </div>
                    </div>
                </div>
            </div>

            <p class="sg-sub">Kartu Quiz / Materi</p>
            <div class="sg-preview-wrap">
                <div class="sg-preview-body">
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4" style="max-width:700px">
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                            <div
                                class="h-36 bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center">
                                <i class="bi bi-pencil-square text-4xl text-white/70"></i>
                            </div>
                            <div class="p-5">
                                <h3 class="font-bold text-gray-900 mb-1">Matematika Dasar</h3>
                                <p class="text-xs text-gray-500 mb-4"><i class="bi bi-tag me-1"></i>Matematika</p>
                                <a href="#"
                                    class="inline-flex items-center justify-center w-full px-4 py-2.5 bg-indigo-50 text-indigo-700 rounded-xl text-sm font-semibold hover:bg-indigo-100 transition-colors">
                                    Kerjakan Quiz <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================================ -->
        <!-- 5. NAVIGASI -->
        <!-- ============================================================ -->
        <section class="sg-section" id="navigasi">
            <h2 class="sg-title">5. Navigasi</h2>
            <p class="text-muted mb-3">Navbar siswa yang di-render langsung dari
                <code>student.components.navbar</code>.
            </p>
            <div class="sg-preview-wrap">
                <div class="sg-preview-body p-0">
                    @auth
                        @include('student.components.navbar')
                    @else
                        <div class="p-4 text-center text-muted">
                            <i class="bi bi-box-arrow-in-right fs-3 mb-2 d-block"></i>
                            <span>Silakan login untuk melihat navbar secara langsung.</span>
                        </div>
                    @endauth
                </div>
            </div>
        </section>

        <!-- ============================================================ -->
        <!-- 6. FORM -->
        <!-- ============================================================ -->
        <section class="sg-section" id="form">
            <h2 class="sg-title">6. Form</h2>
            <p class="text-muted mb-4">Form login, register, dan edit profil yang diambil dari halaman asli.</p>

            <p class="sg-sub">Form Login</p>
            <div class="sg-preview-wrap mb-4">
                <div class="sg-preview-body">
                    <div class="card border-0 shadow rounded-4" style="max-width:400px">
                        <div class="card-body p-4">
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-white border-end-0 rounded-start-4"
                                    style="border-color:#DDE7EF"><i class="bi bi-envelope"
                                        style="color:#095890"></i></span>
                                <div class="form-floating flex-grow-1">
                                    <input type="email" class="form-control border-start-0 rounded-end-4"
                                        placeholder="name@example.com" style="border-color:#DDE7EF">
                                    <label>Email</label>
                                </div>
                            </div>
                            <div class="input-group mb-4">
                                <span class="input-group-text bg-white border-end-0 rounded-start-4"
                                    style="border-color:#DDE7EF"><i class="bi bi-lock-fill"
                                        style="color:#095890"></i></span>
                                <div class="form-floating flex-grow-1">
                                    <input type="password" class="form-control border-start-0 rounded-end-4"
                                        placeholder="Password" style="border-color:#DDE7EF">
                                    <label>Password</label>
                                </div>
                            </div>
                            <button
                                class="btn-si-primary btn w-100 rounded-pill py-2 fw-semibold border-0">Masuk</button>
                        </div>
                    </div>
                </div>
            </div>

            <p class="sg-sub">Form Register</p>
            <div class="sg-preview-wrap mb-4">
                <div class="sg-preview-body">
                    <div class="card border-0 shadow rounded-4" style="max-width:400px">
                        <div class="card-body p-4">
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-white border-end-0 rounded-start-4"
                                    style="border-color:#DDE7EF"><i class="bi bi-person"
                                        style="color:#095890"></i></span>
                                <div class="form-floating flex-grow-1">
                                    <input type="text" class="form-control border-start-0 rounded-end-4"
                                        placeholder="Nama Lengkap" style="border-color:#DDE7EF">
                                    <label>Nama</label>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-white border-end-0 rounded-start-4"
                                    style="border-color:#DDE7EF"><i class="bi bi-envelope"
                                        style="color:#095890"></i></span>
                                <div class="form-floating flex-grow-1">
                                    <input type="email" class="form-control border-start-0 rounded-end-4"
                                        placeholder="name@example.com" style="border-color:#DDE7EF">
                                    <label>Email</label>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-white border-end-0 rounded-start-4"
                                    style="border-color:#DDE7EF"><i class="bi bi-lock-fill"
                                        style="color:#095890"></i></span>
                                <div class="form-floating flex-grow-1">
                                    <input type="password" class="form-control border-start-0 rounded-end-4"
                                        placeholder="Password" style="border-color:#DDE7EF">
                                    <label>Password</label>
                                </div>
                            </div>
                            <div class="input-group mb-4">
                                <span class="input-group-text bg-white border-end-0 rounded-start-4"
                                    style="border-color:#DDE7EF"><i class="bi bi-person-badge"
                                        style="color:#095890"></i></span>
                                <div class="form-floating flex-grow-1">
                                    <select class="form-select border-start-0 rounded-end-4"
                                        style="border-color:#DDE7EF">
                                        <option>Guru</option>
                                        <option selected>Siswa</option>
                                    </select>
                                    <label>Daftar sebagai</label>
                                </div>
                            </div>
                            <button
                                class="btn-si-primary btn w-100 rounded-pill py-2 fw-semibold border-0">Daftar</button>
                        </div>
                    </div>
                </div>
            </div>

            <p class="sg-sub">Form Edit Profil Siswa</p>
            <div class="sg-preview-wrap">
                <div class="sg-preview-body">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden"
                        style="max-width:500px">
                        <div class="p-6 sm:p-8">
                            <div class="mb-5">
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5"><i
                                        class="bi bi-person me-1" style="color:#095890"></i> Nama Lengkap</label>
                                <input type="text"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-[#095890] focus:ring-2 focus:ring-[#095890]/20 focus:outline-none transition"
                                    placeholder="Masukkan nama lengkap">
                            </div>
                            <div class="mb-5">
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5"><i
                                        class="bi bi-envelope me-1" style="color:#095890"></i> Email</label>
                                <input type="email"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-[#095890] focus:ring-2 focus:ring-[#095890]/20 focus:outline-none transition"
                                    placeholder="Masukkan email">
                            </div>
                            <hr class="my-6 border-gray-200">
                            <p class="text-sm text-gray-500 mb-4"><i class="bi bi-info-circle me-1"
                                    style="color:#095890"></i>Kosongkan password jika tidak ingin mengubahnya.</p>
                            <div class="mb-5">
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5"><i
                                        class="bi bi-lock me-1" style="color:#095890"></i> Password Baru</label>
                                <input type="password"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-[#095890] focus:ring-2 focus:ring-[#095890]/20 focus:outline-none transition"
                                    placeholder="Minimal 8 karakter">
                            </div>
                            <div class="mb-6">
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5"><i
                                        class="bi bi-lock-fill me-1" style="color:#095890"></i> Konfirmasi Password
                                    Baru</label>
                                <input type="password"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-[#095890] focus:ring-2 focus:ring-[#095890]/20 focus:outline-none transition"
                                    placeholder="Ulangi password baru">
                            </div>
                            <div class="flex items-center gap-3">
                                <button type="submit"
                                    class="inline-flex items-center gap-2 px-6 py-2.5 text-sm font-semibold text-white rounded-lg transition hover:brightness-110"
                                    style="background-color: #095890;"><i class="bi bi-check-lg"></i> Simpan
                                    Perubahan</button>
                                <a href="#"
                                    class="inline-flex items-center gap-2 px-6 py-2.5 text-sm font-semibold text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition"><i
                                        class="bi bi-x-lg"></i> Batal</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================================ -->
        <!-- 7. IKON -->
        <!-- ============================================================ -->
        <section class="sg-section" id="ikon">
            <h2 class="sg-title">7. Ikon</h2>
            <p class="text-muted mb-4">Ikon Bootstrap Icons yang digunakan di halaman siswa.</p>
            @php
                $studentIcons = [
                    ['bi-grid-fill', 'Dashboard', 'Navigasi utama'],
                    ['bi-book', 'Materi', 'Navigasi / konten'],
                    ['bi-person-circle', 'Profil', 'Dropdown user'],
                    ['bi-pencil-square', 'Quiz', 'Navigasi / kartu'],
                    ['bi-clock-history', 'Riwayat', 'Navigasi riwayat quiz'],
                    ['bi-star-fill', 'Bintang', 'Rating / skor'],
                    ['bi-trophy', 'Skor', 'Pencapaian'],
                    ['bi-check-circle', 'Selesai', 'Status selesai'],
                    ['bi-graph-up', 'Progress', 'Grafik progress'],
                    ['bi-arrow-right', 'Lanjut', 'Aksi tombol'],
                    ['bi-search', 'Cari', 'Pencarian'],
                    ['bi-arrow-left', 'Kembali', 'Tombol kembali'],
                    ['bi-box-arrow-right', 'Keluar', 'Logout'],
                    ['bi-tag', 'Kategori', 'Label kategori'],
                    ['bi-person', 'User', 'Ikon profil form'],
                    ['bi-envelope', 'Email', 'Ikon email form'],
                    ['bi-lock-fill', 'Password', 'Ikon password form'],
                    ['bi-person-badge', 'Role', 'Pilihan role'],
                    ['bi-info-circle', 'Info', 'Informasi tambahan'],
                    ['bi-check-lg', 'Simpan', 'Tombol simpan'],
                    ['bi-x-lg', 'Batal', 'Tombol batal'],
                ];
            @endphp
            <div class="row g-3">
                @foreach ($studentIcons as $ic)
                    <div class="col-4 col-md-3 col-lg-2 text-center">
                        <div class="border rounded p-3 bg-white h-100">
                            <i class="{{ $ic[0] }} fs-3" style="color:var(--si-primary)"></i>
                            <div class="mt-1"><code class="small">{{ $ic[0] }}</code></div>
                            <small class="text-muted">{{ $ic[1] }}</small>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- ============================================================ -->
        <!-- 8. INSPIRASI DESAIN -->
        <!-- ============================================================ -->
        <section class="sg-section" id="inspirasi">
            <h2 class="sg-title">8. Inspirasi Desain</h2>
            <p class="text-muted mb-4">Frontend siswa SIPINTER terinspirasi dari platform pembelajaran modern.</p>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 h-100">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center"
                                style="width:48px;height:48px">
                                <i class="bi bi-book fs-3 text-emerald-500"></i>
                            </div>
                            <h3 class="fw-bold text-gray-900 mb-0" style="font-size:1.1rem">Duolingo</h3>
                        </div>
                        <p class="text-gray-600" style="font-size:.9rem">Pendekatan gamifikasi dengan progress bar,
                            skor, bintang, dan streak. Kartu statistik dan tombol outline dengan ikon panah mengadopsi
                            gaya Duolingo yang playful dan memotivasi.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 h-100">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="w-12 h-12 rounded-xl bg-indigo-50 flex items-center justify-center"
                                style="width:48px;height:48px">
                                <i class="bi bi-laptop fs-3 text-indigo-500"></i>
                            </div>
                            <h3 class="fw-bold text-gray-900 mb-0" style="font-size:1.1rem">Codecademy</h3>
                        </div>
                        <p class="text-gray-600" style="font-size:.9rem">Tampilan dashboard yang bersih dengan grid
                            kartu materi, progress tracking, dan tipografi tegas. Penggunaan warna indigo sebagai aksen
                            utama dan shadow halus pada kartu terinspirasi dari Codecademy.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================================ -->
        <!-- 9. RESPONSIVE -->
        <!-- ============================================================ -->
        <section class="sg-section" id="responsive">
            <h2 class="sg-title">9. Responsive</h2>
            <p class="text-muted mb-4">Breakpoint yang digunakan di SIPINTER (Bootstrap 5 + Tailwind).</p>
            @php
                $breakpoints = [
                    ['xs', '0px — 575px', '<576px', 'Ponsel kecil', 'col-*, grid-cols-1'],
                    ['sm', '576px — 767px', '≥576px', 'Ponsel besar', 'col-sm-*, sm:grid-cols-2'],
                    ['md', '768px — 991px', '≥768px', 'Tablet', 'col-md-*, md:grid-cols-2'],
                    [
                        'lg',
                        '992px — 1199px',
                        '≥992px',
                        'Desktop kecil / navbar breakpoint',
                        'col-lg-*, lg:grid-cols-3, navbar-expand-lg',
                    ],
                    ['xl', '1200px — 1399px', '≥1200px', 'Desktop', 'col-xl-*, lg:grid-cols-4'],
                    ['xxl', '≥1400px', '≥1400px', 'Desktop besar', 'container max-width 1320px'],
                ];
            @endphp
            <div class="table-responsive">
                <table class="table table-bordered table-hover bg-white align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Breakpoint</th>
                            <th>Ukuran</th>
                            <th>Min Width</th>
                            <th>Perangkat</th>
                            <th>Kelas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($breakpoints as $bp)
                            <tr>
                                <td><code>{{ $bp[0] }}</code></td>
                                <td>{{ $bp[1] }}</td>
                                <td>{{ $bp[2] }}</td>
                                <td>{{ $bp[3] }}</td>
                                <td><code>{{ $bp[4] }}</code></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

    </main>

    <footer class="bg-white border-top py-4 text-center text-muted small">
        &copy; {{ date('Y') }} SIPINTER — Style Guide Siswa
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
