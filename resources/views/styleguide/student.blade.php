<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Frontend Style Guide — SIPINTER</title>
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

        .tab-pill {
            display: inline-flex;
            border-radius: 8px;
            padding: 8px 18px;
            font-size: .9rem;
            font-weight: 600;
            transition: all .2s;
        }

        .tab-pill-active {
            background: #fff;
            color: var(--si-primary);
        }

        .tab-pill-inactive {
            color: rgba(255, 255, 255, .8);
        }

        .tab-pill-inactive:hover {
            background: rgba(255, 255, 255, .15);
            color: #fff;
        }
    </style>
</head>

<body>

    <header class="sg-header">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1>SIPINTER Frontend Design System</h1>
            <p class="mt-1">Frontend siswa menggunakan TailwindCSS dengan gaya pembelajaran interaktif yang
                terinspirasi oleh Duolingo dan Codecademy.</p>
            <div class="mt-3 flex flex-wrap gap-2">
                <span class="tab-pill tab-pill-active">Frontend</span>
                <a href="{{ route('styleguide.admin') }}" class="tab-pill tab-pill-inactive">Admin</a>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">

        {{-- 1. COLOR PALETTE --}}
        <section class="sg-section" id="warna">
            <h2 class="sg-title">Color Palette</h2>
            <p class="text-gray-500 mb-4">Warna utama frontend siswa. Didefinisikan sebagai variabel CSS di
                <code>:root</code> pada <code>layouts/student.blade.php</code>.
            </p>
            @php
                $colors = [
                    ['#095890', 'Primary', 'Warna utama brand, tombol, tautan'],
                    ['#0A6AAE', 'Primary Hover', 'Hover untuk elemen utama'],
                    ['#F5F9FC', 'Background', 'Latar belakang halaman'],
                    ['#DDE7EF', 'Border', 'Batas kartu, input, pembatas'],
                    ['#1E293B', 'Text Dark', 'Judul, teks utama (gray-900)'],
                    ['#64748B', 'Muted', 'Teks sekunder, caption, placeholder'],
                ];
            @endphp
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                @foreach ($colors as $c)
                    <div class="color-card">
                        <div class="color-swatch" style="background:{{ $c[0] }}"></div>
                        <div class="color-body">
                            <code>{{ $c[0] }}</code>
                            <div class="font-semibold text-sm mt-1">{{ $c[1] }}</div>
                            <p class="text-gray-500 text-xs mt-1">{{ $c[2] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- 2. TYPOGRAPHY --}}
        <section class="sg-section" id="tipografi">
            <h2 class="sg-title">Typography</h2>
            <p class="text-gray-500 mb-4">Font utama: <strong>Inter</strong> via Tailwind. Semua utility kelas Tailwind
                yang digunakan di frontend siswa.</p>
            <div class="sg-preview-wrap">
                <div class="sg-preview-body space-y-4">
                    <div>
                        <p class="text-4xl font-bold text-gray-900">Heading XL — text-4xl font-bold</p>
                        <p class="text-xs text-gray-400 mt-1">Digunakan untuk judul halaman utama</p>
                    </div>
                    <div>
                        <p class="text-3xl font-bold text-gray-900">Heading LG — text-3xl font-bold</p>
                        <p class="text-xs text-gray-400 mt-1">Digunakan untuk sambutan dashboard</p>
                    </div>
                    <div>
                        <p class="text-2xl font-semibold text-gray-900">Heading MD — text-2xl font-semibold</p>
                        <p class="text-xs text-gray-400 mt-1">Digunakan untuk judul sub-halaman</p>
                    </div>
                    <div>
                        <p class="text-base text-gray-900">Body — text-base</p>
                        <p class="text-xs text-gray-400 mt-1">Paragraf, konten utama</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Small — text-sm text-gray-500</p>
                        <p class="text-xs text-gray-400 mt-1">Label form, caption, metadata</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- 3. BUTTONS --}}
        <section class="sg-section" id="tombol">
            <h2 class="sg-title">Buttons</h2>
            <p class="text-gray-500 mb-4">Semua variasi tombol yang digunakan di frontend siswa.</p>

            <p class="sg-sub">Primary</p>
            <div class="sg-preview-wrap mb-4">
                <div class="sg-preview-body flex flex-wrap items-center gap-3">
                    <button
                        class="inline-flex items-center gap-2 px-6 py-2.5 text-sm font-semibold text-white rounded-xl transition duration-150 hover:brightness-110"
                        style="background-color: #095890;">
                        <i class="bi bi-check-lg"></i> Simpan Perubahan
                    </button>
                    <button
                        class="inline-flex items-center gap-2 px-6 py-2.5 text-sm font-semibold text-white rounded-xl transition duration-150 hover:brightness-110"
                        style="background-color: #095890;">
                        <i class="bi bi-arrow-right"></i> Selanjutnya
                    </button>
                    <div class="sg-code mt-2 w-full"><code>&lt;button
                            class="inline-flex items-center gap-2 px-6 py-2.5 text-sm font-semibold text-white rounded-xl"
                            style="background-color: #095890;"&gt;Simpan Perubahan&lt;/button&gt;</code></div>
                </div>
            </div>

            <p class="sg-sub">Secondary</p>
            <div class="sg-preview-wrap mb-4">
                <div class="sg-preview-body flex flex-wrap items-center gap-3">
                    <button
                        class="inline-flex items-center gap-2 px-6 py-2.5 text-sm font-semibold rounded-xl transition duration-150"
                        style="background-color: #F1F5F9; color: #64748B; border: 1px solid #DDE7EF;">
                        <i class="bi bi-arrow-counterclockwise"></i> Reset
                    </button>
                    <button
                        class="inline-flex items-center gap-2 px-6 py-2.5 text-sm font-semibold rounded-xl transition duration-150"
                        style="background-color: #F1F5F9; color: #64748B; border: 1px solid #DDE7EF;">
                        <i class="bi bi-x-lg"></i> Batal
                    </button>
                    <div class="sg-code mt-2 w-full"><code>&lt;button
                            class="inline-flex items-center gap-2 px-6 py-2.5 text-sm font-semibold rounded-xl"
                            style="background-color: #F1F5F9; color: #64748B; border: 1px solid #DDE7EF;"&gt;Batal&lt;/button&gt;</code>
                    </div>
                </div>
            </div>

            <p class="sg-sub">Outline / Ghost</p>
            <div class="sg-preview-wrap">
                <div class="sg-preview-body flex flex-wrap items-center gap-3">
                    <a href="#"
                        class="inline-flex items-center justify-center px-5 py-2.5 bg-indigo-50 text-indigo-700 rounded-xl text-sm font-semibold hover:bg-indigo-100 transition-colors">
                        <i class="bi bi-pencil-square me-2"></i> Kerjakan Quiz
                    </a>
                    <a href="#"
                        class="inline-flex items-center justify-center px-5 py-2.5 bg-indigo-50 text-indigo-700 rounded-xl text-sm font-semibold hover:bg-indigo-100 transition-colors">
                        <i class="bi bi-download me-2"></i> Unduh Materi
                    </a>
                    <div class="sg-code mt-2 w-full"><code>&lt;a href="#"
                            class="inline-flex items-center justify-center px-5 py-2.5 bg-indigo-50 text-indigo-700 rounded-xl text-sm font-semibold hover:bg-indigo-100 transition-colors"&gt;Kerjakan
                            Quiz&lt;/a&gt;</code></div>
                </div>
            </div>
        </section>

        {{-- 4. INPUTS --}}
        <section class="sg-section" id="input">
            <h2 class="sg-title">Inputs</h2>
            <p class="text-gray-500 mb-4">Gaya input form yang konsisten di seluruh halaman siswa.</p>
            <div class="sg-preview-wrap">
                <div class="sg-preview-body space-y-4 max-w-lg">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Lengkap</label>
                        <input type="text" value="John Doe"
                            class="w-full px-4 py-2.5 rounded-xl border text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            style="border-color: #DDE7EF;">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email</label>
                        <input type="email" value="john@example.com"
                            class="w-full px-4 py-2.5 rounded-xl border text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            style="border-color: #DDE7EF;">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Password</label>
                        <input type="password" placeholder="Minimal 8 karakter"
                            class="w-full px-4 py-2.5 rounded-xl border text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            style="border-color: #DDE7EF;">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Select / Filter</label>
                        <select
                            class="w-full px-4 py-2.5 rounded-xl border text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            style="border-color: #DDE7EF;">
                            <option>Semua Jenjang</option>
                            <option>SD</option>
                            <option>SMP</option>
                            <option>SMA</option>
                        </select>
                    </div>
                    <div class="sg-code"><code>&lt;input type="text"
                            class="w-full px-4 py-2.5 rounded-xl border text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            style="border-color: #DDE7EF;"&gt;</code></div>
                </div>
            </div>
        </section>

        {{-- 5. CARDS --}}
        <section class="sg-section" id="kartu">
            <h2 class="sg-title">Cards</h2>
            <p class="text-gray-500 mb-4">Kartu digunakan untuk statistik, materi, quiz, dan konten dashboard.</p>

            <p class="sg-sub">Statistic Card</p>
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
                        </div>
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                            <div class="flex items-center justify-between mb-3">
                                <div class="text-3xl font-black text-emerald-600">85</div>
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
                    <div class="sg-code mt-4"><code>&lt;div
                            class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5"&gt;...&lt;/div&gt;</code>
                    </div>
                </div>
            </div>

            <p class="sg-sub">Content Card (Materi / Quiz)</p>
            <div class="sg-preview-wrap">
                <div class="sg-preview-body">
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4" style="max-width: 700px;">
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                            <div
                                class="h-36 bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center">
                                <i class="bi bi-journal-bookmark-fill text-4xl text-white/70"></i>
                            </div>
                            <div class="p-5">
                                <h3 class="font-bold text-gray-900 mb-1">Matematika Dasar</h3>
                                <p class="text-xs text-gray-500 mb-1"><i class="bi bi-person me-1"></i>Budi Santoso
                                </p>
                                <p class="text-xs text-gray-500 mb-3"><i class="bi bi-bar-chart me-1"></i>SD</p>
                                <a href="#"
                                    class="inline-flex items-center justify-center w-full px-4 py-2.5 bg-indigo-600 text-white rounded-xl text-sm font-semibold hover:bg-indigo-700 transition-colors shadow-sm">Pelajari</a>
                            </div>
                        </div>
                    </div>
                    <div class="sg-code mt-4"><code>&lt;div
                            class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden"&gt;...&lt;/div&gt;</code>
                    </div>
                </div>
            </div>
        </section>

        {{-- 6. BADGES --}}
        <section class="sg-section" id="badges">
            <h2 class="sg-title">Badges</h2>
            <p class="text-gray-500 mb-4">Badge digunakan untuk status, peran, pencapaian, dan label.</p>
            <div class="sg-preview-wrap">
                <div class="sg-preview-body space-y-4">
                    <div class="flex flex-wrap gap-2">
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-indigo-50 text-indigo-700">Progress</span>
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700">Achievement</span>
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-50 text-green-700"><i
                                class="bi bi-check-circle me-1"></i>Completed</span>
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-500"><i
                                class="bi bi-lock me-1"></i>Locked</span>
                    </div>
                    <div>
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-50 text-red-700">Admin</span>
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-700">Guru</span>
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-600">Siswa</span>
                    </div>
                    <div class="sg-code"><code>&lt;span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-indigo-50 text-indigo-700"&gt;Progress&lt;/span&gt;</code>
                    </div>
                </div>
            </div>
        </section>

        {{-- 7. AVATAR --}}
        <section class="sg-section" id="avatar">
            <h2 class="sg-title">Avatar</h2>
            <p class="text-gray-500 mb-4">Avatar pengguna untuk navbar dan halaman profil.</p>
            <div class="sg-preview-wrap">
                <div class="sg-preview-body flex flex-wrap items-center gap-4">
                    <div class="flex flex-col items-center gap-1">
                        <img src="https://ui-avatars.com/api/?name=John+Doe&background=095890&color=fff&size=96"
                            class="w-12 h-12 rounded-full border object-cover" style="border-color: #DDE7EF;"
                            alt="Avatar">
                        <span class="text-xs text-gray-500">w-12 h-12 (navbar)</span>
                    </div>
                    <div class="flex flex-col items-center gap-1">
                        <img src="https://ui-avatars.com/api/?name=John+Doe&background=095890&color=fff&size=128"
                            class="w-28 h-28 rounded-full border object-cover" style="border-color: #DDE7EF;"
                            alt="Avatar">
                        <span class="text-xs text-gray-500">w-28 h-28 (profil)</span>
                    </div>
                    <div class="flex flex-col items-center gap-1">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center"
                            style="background-color: #E8F0F6;">
                            <i class="bi bi-person-circle text-2xl" style="color: #095890;"></i>
                        </div>
                        <span class="text-xs text-gray-500">Fallback (no avatar)</span>
                    </div>
                    <div class="sg-code w-full mt-2"><code>
                            @if (isset(auth()->user()->avatar))
                                &lt;img src="..." class="w-12 h-12 rounded-full border object-cover"&gt;
                            @else
                                &lt;i class="bi bi-person-circle text-2xl"&gt;
                            @endif
                        </code></div>
                </div>
            </div>
        </section>

        {{-- 8. NAVBAR --}}
        <section class="sg-section" id="navbar">
            <h2 class="sg-title">Navbar</h2>
            <p class="text-gray-500 mb-4">Navbar siswa menggunakan TailwindCSS + AlpineJS. Responsif untuk desktop dan
                mobile.</p>

            <p class="sg-sub">Desktop Preview (&gt;=1024px)</p>
            <div class="sg-preview-wrap mb-4">
                <div class="max-w-full overflow-hidden rounded-xl border" style="border-color: #DDE7EF;">
                    <nav class="bg-white" style="border-bottom: 1px solid #DDE7EF; min-height: 64px;">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                            <div class="flex items-center justify-between h-16">
                                <a class="flex items-center gap-2 shrink-0">
                                    <img src="{{ asset('images/sipinter-logo.png') }}" alt="SIPINTER"
                                        class="h-10 w-auto">
                                    <div>
                                        <span class="font-bold block text-base leading-tight"
                                            style="color: #095890;">SIPINTER</span>
                                        <span class="hidden lg:block text-[0.6rem] leading-tight"
                                            style="color: #64748B;">Belajar Interaktif dan Menyenangkan</span>
                                    </div>
                                </a>
                                <div class="hidden lg:flex items-center gap-1 absolute left-1/2 -translate-x-1/2">
                                    <span class="px-3 py-2 rounded-lg text-sm font-medium nav-link-active"><i
                                            class="bi bi-grid-fill me-1"></i>Dashboard</span>
                                    <span class="px-3 py-2 rounded-lg text-sm font-medium text-gray-700"><i
                                            class="bi bi-book me-1"></i>Materi Saya</span>
                                    <span class="px-3 py-2 rounded-lg text-sm font-medium text-gray-700"><i
                                            class="bi bi-pencil-square me-1"></i>Quiz Saya</span>
                                    <span class="px-3 py-2 rounded-lg text-sm font-medium text-gray-700"><i
                                            class="bi bi-clock-history me-1"></i>Riwayat Quiz</span>
                                </div>
                                <div class="hidden lg:flex items-center gap-2">
                                    <img src="https://ui-avatars.com/api/?name=John+Doe&background=095890&color=fff&size=64"
                                        class="w-9 h-9 rounded-full border object-cover"
                                        style="border-color: #DDE7EF;" alt="Avatar">
                                    <span class="text-sm font-medium text-gray-700">John Doe</span>
                                </div>
                                <button class="lg:hidden p-2" style="color: #095890;">
                                    <i class="bi bi-list text-2xl"></i>
                                </button>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>

            <p class="sg-sub">Mobile Preview (&lt;1024px)</p>
            <div class="sg-preview-wrap">
                <div class="max-w-sm mx-auto overflow-hidden rounded-xl border" style="border-color: #DDE7EF;">
                    <nav class="bg-white" style="border-bottom: 1px solid #DDE7EF;">
                        <div class="px-4">
                            <div class="flex items-center justify-between h-16">
                                <a class="flex items-center gap-2 shrink-0">
                                    <img src="{{ asset('images/sipinter-logo.png') }}" alt="SIPINTER"
                                        class="h-10 w-auto">
                                    <span class="font-bold text-base leading-tight"
                                        style="color: #095890;">SIPINTER</span>
                                </a>
                                <button class="p-2" style="color: #095890;">
                                    <i class="bi bi-list text-2xl"></i>
                                </button>
                            </div>
                            <div class="border-t py-3 space-y-1" style="border-color: #DDE7EF;">
                                <span
                                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium nav-link-active"><i
                                        class="bi bi-grid-fill"></i>Dashboard</span>
                                <span
                                    class="flex items-center gap-3 px-3 py.5 rounded-lg text-sm font-medium text-gray-700"><i
                                        class="bi bi-book"></i>Materi Saya</span>
                                <span
                                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-700"><i
                                        class="bi bi-pencil-square"></i>Quiz Saya</span>
                                <span
                                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-700"><i
                                        class="bi bi-clock-history"></i>Riwayat Quiz</span>
                                <hr style="border-color: #DDE7EF;">
                                <div class="flex items-center gap-3 px-3 py-2.5">
                                    <img src="https://ui-avatars.com/api/?name=John+Doe&background=095890&color=fff&size=64"
                                        class="w-8 h-8 rounded-full border object-cover"
                                        style="border-color: #DDE7EF;" alt="Avatar">
                                    <span class="text-sm font-medium text-gray-900">John Doe</span>
                                </div>
                                <span
                                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-700"><i
                                        class="bi bi-person" style="color: #095890;"></i>Profil</span>
                                <span
                                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-700"><i
                                        class="bi bi-box-arrow-right" style="color: #dc2626;"></i>Keluar</span>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>

            @auth
                <div class="mt-6">
                    <p class="sg-sub">Live Preview</p>
                    <div class="sg-preview-wrap">
                        <div class="sg-preview-body p-0">
                            @include('student.components.navbar')
                        </div>
                    </div>
                </div>
            @endauth
        </section>

        {{-- 9. PROFILE PAGE --}}
        <section class="sg-section" id="profile">
            <h2 class="sg-title">Profile Page</h2>
            <p class="text-gray-500 mb-4">Halaman profil siswa dengan layout dua kolom. Desktop: grid 3 kolom (kiri 1,
                kanan 2). Mobile: vertikal.</p>

            <div class="sg-preview-wrap">
                <div class="sg-preview-body">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        {{-- Left card --}}
                        <div class="lg:col-span-1">
                            <div
                                class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col items-center">
                                <div class="mb-4">
                                    <div class="w-28 h-28 rounded-full flex items-center justify-center"
                                        style="background-color: #E8F0F6;">
                                        <i class="bi bi-person-circle text-5xl" style="color: #095890;"></i>
                                    </div>
                                </div>
                                <h5 class="text-lg font-bold text-center mb-1" style="color: #1E293B;">John Doe</h5>
                                <p class="text-sm text-center mb-3" style="color: #64748B;"><i
                                        class="bi bi-envelope me-1"></i>john@example.com</p>
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold text-white bg-gray-500">Siswa</span>
                                <hr class="w-full my-5" style="border-color: #DDE7EF;">
                                <div class="w-full mb-4">
                                    <p class="text-xs font-semibold mb-1.5" style="color: #64748B;">Login Google</p>
                                    <span
                                        class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-green-50 text-green-700">
                                        <i class="bi bi-check-circle"></i> Terhubung dengan Google
                                    </span>
                                </div>
                                <div class="w-full">
                                    <p class="text-xs font-semibold mb-2" style="color: #64748B;">QR Login</p>
                                    <div class="flex justify-center mb-2">
                                        <img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=sipinter-qr-demo&choe=UTF-8"
                                            class="w-28 h-28" style="border-radius: 8px; border: 1px solid #DDE7EF;"
                                            alt="QR">
                                    </div>
                                    <span
                                        class="flex items-center justify-center gap-1 w-full px-3 py-1.5 text-xs font-medium rounded-full"
                                        style="border: 1px solid #DDE7EF; color: #64748B;">
                                        <i class="bi bi-download"></i> Unduh QR
                                    </span>
                                </div>
                            </div>
                        </div>
                        {{-- Right card --}}
                        <div class="lg:col-span-2">
                            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                                <h5 class="text-lg font-bold mb-6" style="color: #1E293B;">
                                    <i class="bi bi-gear me-2" style="color: #095890;"></i>Pengaturan Profil
                                </h5>
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-semibold mb-1.5" style="color: #1E293B;"><i
                                                class="bi bi-person me-1" style="color: #095890;"></i> Nama</label>
                                        <input type="text" value="John Doe"
                                            class="w-full px-4 py-2.5 rounded-xl border text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                            style="border-color: #DDE7EF;">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold mb-1.5" style="color: #1E293B;"><i
                                                class="bi bi-envelope me-1" style="color: #095890;"></i> Email</label>
                                        <input type="email" value="john@example.com"
                                            class="w-full px-4 py-2.5 rounded-xl border text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                            style="border-color: #DDE7EF;">
                                    </div>
                                    <hr style="border-color: #DDE7EF;">
                                    <div>
                                        <label class="block text-sm font-semibold mb-1.5" style="color: #1E293B;"><i
                                                class="bi bi-lock me-1" style="color: #095890;"></i> Password
                                            Baru</label>
                                        <input type="password" placeholder="Minimal 8 karakter"
                                            class="w-full px-4 py-2.5 rounded-xl border text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                            style="border-color: #DDE7EF;">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold mb-1.5" style="color: #1E293B;"><i
                                                class="bi bi-lock-fill me-1" style="color: #095890;"></i> Konfirmasi
                                            Password</label>
                                        <input type="password" placeholder="Ulangi password baru"
                                            class="w-full px-4 py-2.5 rounded-xl border text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                            style="border-color: #DDE7EF;">
                                    </div>
                                    <div class="flex items-center gap-3 pt-2">
                                        <button
                                            class="inline-flex items-center gap-2 px-6 py-2.5 text-sm font-semibold text-white rounded-xl transition duration-150 hover:brightness-110"
                                            style="background-color: #095890;">
                                            <i class="bi bi-check-lg"></i> Simpan Perubahan
                                        </button>
                                        <button
                                            class="inline-flex items-center gap-2 px-6 py-2.5 text-sm font-semibold rounded-xl transition duration-150"
                                            style="background-color: #F1F5F9; color: #64748B; border: 1px solid #DDE7EF;">
                                            <i class="bi bi-arrow-counterclockwise"></i> Reset
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sg-code mt-4"><code>&lt;div class="grid grid-cols-1 lg:grid-cols-3 gap-6"&gt;
                            &lt;div class="lg:col-span-1"&gt;...profil card...&lt;/div&gt;
                            &lt;div class="lg:col-span-2"&gt;...form edit...&lt;/div&gt;
                            &lt;/div&gt;</code></div>
                </div>
            </div>
        </section>

        {{-- 10. ICONS --}}
        <section class="sg-section" id="ikon">
            <h2 class="sg-title">Icons</h2>
            <p class="text-gray-500 mb-4">Bootstrap Icons yang digunakan di frontend siswa.</p>
            @php
                $icons = [
                    ['bi-grid-fill', 'Dashboard', 'Navigasi utama'],
                    ['bi-book', 'Materi', 'Navigasi / konten'],
                    ['bi-person-circle', 'Profil', 'Avatar fallback'],
                    ['bi-pencil-square', 'Quiz', 'Navigasi / kartu'],
                    ['bi-clock-history', 'Riwayat', 'Navigasi riwayat'],
                    ['bi-star-fill', 'Bintang', 'Rating / skor'],
                    ['bi-trophy', 'Skor', 'Pencapaian'],
                    ['bi-check-circle', 'Selesai', 'Status completed'],
                    ['bi-graph-up', 'Progress', 'Grafik progress'],
                    ['bi-search', 'Cari', 'Pencarian filter'],
                    ['bi-download', 'Unduh', 'Unduh materi / QR'],
                    ['bi-arrow-right', 'Lanjut', 'Aksi tombol'],
                    ['bi-arrow-left', 'Kembali', 'Tombol kembali'],
                    ['bi-box-arrow-right', 'Keluar', 'Logout'],
                    ['bi-person', 'User', 'Ikon form profil'],
                    ['bi-envelope', 'Email', 'Ikon email'],
                    ['bi-lock-fill', 'Password', 'Ikon password'],
                    ['bi-gear', 'Pengaturan', 'Ikon settings'],
                    ['bi-check-lg', 'Simpan', 'Tombol simpan'],
                    ['bi-arrow-counterclockwise', 'Reset', 'Tombol reset'],
                ];
            @endphp
            <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3">
                @foreach ($icons as $ic)
                    <div class="border rounded-xl p-3 bg-white text-center" style="border-color: #DDE7EF;">
                        <i class="{{ $ic[0] }} text-2xl" style="color: var(--si-primary)"></i>
                        <div class="mt-1"><code class="text-xs">{{ $ic[0] }}</code></div>
                        <span class="text-xs text-gray-500">{{ $ic[1] }}</span>
                    </div>
                @endforeach
            </div>
        </section>

    </main>

    <footer class="bg-white border-t py-4 text-center text-gray-500 text-sm" style="border-color: #DDE7EF;">
        &copy; {{ date('Y') }} SIPINTER — Frontend Design System
    </footer>

</body>

</html>
