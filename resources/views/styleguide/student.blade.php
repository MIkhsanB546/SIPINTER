<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Frontend Style Guide — SIPINTER</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --si-primary: #095890;
            --si-primary-hover: #0A6AAE;
            --si-light-bg: #F5F9FC;
            --si-border: #DDE7EF;
            --si-text-dark: #1E293B;
            --si-muted: #64748B;
        }

        * { scroll-margin-top: 80px; }

        body {
            font-family: 'Instrument Sans', 'Inter', 'Source Sans 3', sans-serif;
            background: #f4f6f9;
            color: #1E293B;
        }

        .sg-header {
            background: linear-gradient(135deg, var(--si-primary), var(--si-primary-hover));
            color: #fff;
            padding: 40px 0 28px;
        }
        .sg-header h1 { font-size: 2rem; font-weight: 800; }
        .sg-header p { opacity: .85; font-size: 1rem; }

        .sg-section { padding: 32px 0; }
        .sg-section:nth-child(even) { background: #fff; }

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
            border-radius: 12px;
            padding: 16px;
            font-size: .78rem;
            overflow-x: auto;
            margin-top: 12px;
        }
        .sg-code code { white-space: pre; }

        .color-card {
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid var(--si-border);
            background: #fff;
        }
        .color-swatch { height: 70px; }
        .color-body { padding: 10px 14px; }
        .color-body code { font-size: .75rem; }

        .sg-preview-wrap {
            border: 1px solid var(--si-border);
            border-radius: 12px;
            overflow: hidden;
            background: #fff;
        }
        .sg-preview-body { padding: 20px; }

        .tab-pill {
            display: inline-flex;
            border-radius: 8px;
            padding: 8px 18px;
            font-size: .9rem;
            font-weight: 600;
            transition: all .2s;
        }
        .tab-pill-active { background: #fff; color: var(--si-primary); }
        .tab-pill-inactive { color: rgba(255, 255, 255, .8); }
        .tab-pill-inactive:hover { background: rgba(255, 255, 255, .15); color: #fff; }

        /* ====================================
           Actual CSS overrides from layouts/student.blade.php
           These ARE applied in the app via custom CSS
           ==================================== */
        .text-indigo-600,
        .hover\:text-indigo-800:hover,
        .hover\:text-indigo-600:hover,
        .group:hover .group-hover\:text-indigo-600 { color: var(--si-primary) !important; }
        .bg-indigo-600 { background-color: var(--si-primary) !important; }
        .hover\:bg-indigo-700:hover { background-color: var(--si-primary-hover) !important; }
        .bg-indigo-50 { background-color: #E8F0F6 !important; }
        .hover\:bg-indigo-100:hover { background-color: #D0E2ED !important; }
        .text-indigo-700 { color: var(--si-primary) !important; }
        .focus\:ring-indigo-500 { --tw-ring-color: var(--si-primary) !important; }
        .from-indigo-400 { --tw-gradient-from: #095890 !important; }
        .to-purple-500 { --tw-gradient-to: #0A6AAE !important; }
        .bg-gradient-to-br.from-indigo-400.to-purple-500 {
            background-image: linear-gradient(135deg, #095890, #0A6AAE) !important;
        }

        .nav-link-active {
            color: var(--si-primary) !important;
            background-color: #E8F0F6 !important;
        }
        .nav-link-active:hover {
            color: var(--si-primary) !important;
            background-color: #D0E2ED !important;
        }
        .nav-link-inactive:hover { background-color: #F1F5F9 !important; }

        .text-si-primary { color: var(--si-primary) !important; }
        .bg-si-primary { background-color: var(--si-primary) !important; }
        .border-si-primary { border-color: var(--si-primary) !important; }

        /* Custom gradients from dashboard */
        .bg-gradient-mtk { background: linear-gradient(135deg, #6366f1, #8b5cf6); }
        .bg-gradient-bind { background: linear-gradient(135deg, #10b981, #34d399); }
        .bg-gradient-ipa { background: linear-gradient(135deg, #f59e0b, #f97316); }
        .bg-gradient-ips { background: linear-gradient(135deg, #ef4444, #f97316); }
        .bg-gradient-bing { background: linear-gradient(135deg, #06b6d4, #3b82f6); }
        .bg-gradient-default { background: linear-gradient(135deg, #6366f1, #a855f7); }

        .preview-navbar {
            border-bottom: 1px solid var(--si-border);
            min-height: 64px;
        }
    </style>
</head>

<body>

    <header class="sg-header">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1>SIPINTER Frontend Design System</h1>
            <p class="mt-1">Frontend siswa menggunakan Tailwind CSS v4 dengan Alpine.js. Warna <code>indigo</code> di Tailwind dioverride ke <code>--si-primary: #095890</code>.</p>
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
            <p class="text-gray-500 mb-4">Warna utama frontend siswa. Didefinisikan sebagai CSS variables di <code>layouts/student.blade.php</code>.</p>
            @php
                $colors = [
                    ['#095890', 'Primary', 'Warna utama brand, tombol, tautan (--si-primary)'],
                    ['#0A6AAE', 'Primary Hover', 'Hover tombol utama (--si-primary-hover)'],
                    ['#F5F9FC', 'Background', 'Latar halaman (--si-light-bg)'],
                    ['#DDE7EF', 'Border', 'Batas kartu, input (--si-border)'],
                    ['#1E293B', 'Text Dark', 'Judul, teks utama (--si-text-dark)'],
                    ['#64748B', 'Muted', 'Teks sekunder (--si-muted)'],
                    ['#E8F0F6', 'Indigo 50', 'Override bg-indigo-50'],
                    ['#D0E2ED', 'Indigo 100', 'Override hover:bg-indigo-100'],
                ];
            @endphp
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
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

            <div class="sg-code mt-4"><code>/* Student CSS overrides */
:root {
    --si-primary: #095890;
    --si-primary-hover: #0A6AAE;
    --si-light-bg: #F5F9FC;
    --si-border: #DDE7EF;
    --si-text-dark: #1E293B;
    --si-muted: #64748B;
}

/* Tailwind indigo override ke si-primary */
.bg-indigo-600 { background-color: var(--si-primary) !important; }
.text-indigo-600 { color: var(--si-primary) !important; }
.bg-indigo-50 { background-color: #E8F0F6 !important; }
.text-indigo-700 { color: var(--si-primary) !important; }</code></div>
        </section>

        {{-- 2. TYPOGRAPHY --}}
        <section class="sg-section" id="tipografi">
            <h2 class="sg-title">Typography</h2>
            <p class="text-gray-500 mb-4">Font: <strong>Instrument Sans</strong> via Tailwind. Semua utility kelas Tailwind yang digunakan di frontend siswa.</p>
            <div class="sg-preview-wrap">
                <div class="sg-preview-body space-y-4">
                    <div>
                        <p class="text-3xl font-extrabold text-gray-900">Heading XL — text-3xl font-extrabold</p>
                        <p class="text-xs text-gray-400 mt-1">Judul halaman utama (dashboard, browse)</p>
                    </div>
                    <div>
                        <p class="text-xl font-bold text-gray-900">Heading LG — text-xl font-bold</p>
                        <p class="text-xs text-gray-400 mt-1">Judul seksi (Lanjutkan Belajar, Rekomendasi)</p>
                    </div>
                    <div>
                        <p class="text-lg font-bold text-gray-900">Heading MD — text-lg font-bold</p>
                        <p class="text-xs text-gray-400 mt-1">Card title, konten detail</p>
                    </div>
                    <div>
                        <p class="text-base text-gray-900">Body — text-base</p>
                        <p class="text-xs text-gray-400 mt-1">Paragraf, konten utama</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Small — text-sm text-gray-500</p>
                        <p class="text-xs text-gray-400 mt-1">Label form, caption, metadata (guru, tingkat)</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">Extra Small — text-xs text-gray-400</p>
                        <p class="text-xs text-gray-400 mt-1">Info tambahan, count</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- 3. BUTTONS --}}
        <section class="sg-section" id="tombol">
            <h2 class="sg-title">Buttons</h2>
            <p class="text-gray-500 mb-4">Semua variasi tombol. Warna <code>indigo</code> dioverride ke <code>#095890</code> oleh CSS kustom.</p>

            <p class="sg-sub">Primary (bg-indigo-600) — CTA utama</p>
            <div class="sg-preview-wrap mb-4">
                <div class="sg-preview-body flex flex-wrap items-center gap-3">
                    <button class="inline-flex items-center gap-2 px-6 py-2.5 text-sm font-semibold text-white rounded-xl transition duration-150 hover:bg-indigo-700 bg-indigo-600 shadow-sm">
                        <i class="bi bi-check-lg"></i> Simpan Perubahan
                    </button>
                    <button class="inline-flex items-center gap-2 px-6 py-2.5 text-sm font-semibold text-white rounded-xl transition duration-150 hover:bg-indigo-700 bg-indigo-600 shadow-sm">
                        <i class="bi bi-arrow-right"></i> Selanjutnya
                    </button>
                    <a href="#" class="inline-flex items-center justify-center px-4 py-2.5 bg-indigo-600 text-white rounded-xl text-sm font-semibold hover:bg-indigo-700 transition-colors shadow-sm">
                        <i class="bi bi-search me-1"></i> Cari
                    </a>
                    <a href="#" class="inline-flex items-center justify-center w-full px-4 py-2.5 bg-indigo-600 text-white rounded-xl text-sm font-semibold hover:bg-indigo-700 transition-colors shadow-sm" style="max-width:200px">
                        Pelajari
                    </a>
                    <div class="sg-code mt-2 w-full"><code>&lt;button class="inline-flex items-center gap-2 px-6 py-2.5 text-sm font-semibold text-white rounded-xl bg-indigo-600 hover:bg-indigo-700 shadow-sm"&gt;Simpan&lt;/button&gt;

&lt;a href="#" class="inline-flex items-center justify-center px-4 py-2.5 bg-indigo-600 text-white rounded-xl text-sm font-semibold hover:bg-indigo-700 transition-colors shadow-sm"&gt;Lihat Detail&lt;/a&gt;</code></div>
                </div>
            </div>

            <p class="sg-sub">Secondary / Ghost — aksi sekunder</p>
            <div class="sg-preview-wrap mb-4">
                <div class="sg-preview-body flex flex-wrap items-center gap-3">
                    <a href="#" class="inline-flex items-center justify-center px-5 py-2.5 bg-indigo-50 text-indigo-700 rounded-xl text-sm font-semibold hover:bg-indigo-100 transition-colors">
                        <i class="bi bi-pencil-square me-2"></i> Kerjakan Quiz
                    </a>
                    <a href="#" class="inline-flex items-center justify-center px-5 py-2.5 bg-indigo-50 text-indigo-700 rounded-xl text-sm font-semibold hover:bg-indigo-100 transition-colors">
                        <i class="bi bi-download me-2"></i> Unduh Materi
                    </a>
                    <a href="#" class="flex-1 px-4 py-2.5 bg-gray-100 text-gray-700 rounded-xl text-sm font-semibold hover:bg-gray-200 transition-colors text-center">
                        Reset
                    </a>
                    <div class="sg-code mt-2 w-full"><code>&lt;a href="#"
    class="inline-flex items-center justify-center px-5 py-2.5 bg-indigo-50 text-indigo-700 rounded-xl text-sm font-semibold hover:bg-indigo-100 transition-colors"&gt;
    &lt;i class="bi bi-pencil-square me-2"&gt;&lt;/i&gt; Kerjakan Quiz
&lt;/a&gt;</code></div>
                </div>
            </div>

            <p class="sg-sub">Emerald CTA — untuk tombol quiz / aksi positif</p>
            <div class="sg-preview-wrap mb-4">
                <div class="sg-preview-body flex flex-wrap items-center gap-3">
                    <button class="inline-flex items-center gap-2 px-6 py-2.5 text-sm font-semibold text-white rounded-xl transition duration-150 hover:brightness-110" style="background-color: #059669;">
                        <i class="bi bi-check-lg"></i> Kumpulkan Jawaban
                    </button>
                    <a href="#" class="inline-flex items-center justify-center px-4 py-2.5 bg-emerald-50 text-emerald-700 rounded-xl text-sm font-semibold hover:bg-emerald-100 transition-colors">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    <div class="sg-code mt-2 w-full"><code>&lt;button class="... bg-emerald-..."&gt;Kumpulkan Jawaban&lt;/button&gt;</code></div>
                </div>
            </div>

            <p class="sg-sub">Loading State</p>
            <div class="sg-preview-wrap">
                <div class="sg-preview-body flex flex-wrap items-center gap-3">
                    <button class="inline-flex items-center gap-2 px-6 py-2.5 text-sm font-semibold text-white rounded-xl bg-indigo-600 opacity-75 cursor-not-allowed" disabled>
                        <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                        </svg>
                        Memproses...
                    </button>
                    <div class="sg-code mt-2 w-full"><code>&lt;button disabled class="... opacity-75 cursor-not-allowed"&gt;
    &lt;svg class="animate-spin h-4 w-4"&gt;...&lt;/svg&gt;
    Memproses...
&lt;/button&gt;</code></div>
                </div>
            </div>
        </section>

        {{-- 4. ALERT & FLASH MESSAGES --}}
        <section class="sg-section" id="alert">
            <h2 class="sg-title">Alert & Flash Messages</h2>
            <p class="text-gray-500 mb-4">Notifikasi setelah redirect atau submit form. Didefinisikan di layout student.</p>

            <div class="sg-preview-wrap">
                <div class="sg-preview-body space-y-4">
                    <div class="bg-green-50 border-l-4 border-green-500 text-green-800 rounded-xl p-4 flex items-center gap-3 shadow-sm">
                        <i class="bi bi-check-circle-fill text-green-500 text-lg"></i>
                        <span>Materi berhasil disimpan!</span>
                    </div>
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-800 rounded-xl p-4 flex items-center gap-3 shadow-sm">
                        <i class="bi bi-exclamation-circle-fill text-red-500 text-lg"></i>
                        <span>Terjadi kesalahan. Silakan coba lagi.</span>
                    </div>
                    <div class="sg-code"><code>@@if (session('success'))
    &lt;div class="bg-green-50 border-l-4 border-green-500 text-green-800 rounded-xl p-4 flex items-center gap-3 shadow-sm"&gt;
        &lt;i class="bi bi-check-circle-fill text-green-500 text-lg"&gt;&lt;/i&gt;
        &lt;span&gt;@{{ session('success') }}&lt;/span&gt;
    &lt;/div&gt;
@@endif</code></div>
                </div>
            </div>
        </section>

        {{-- 5. INPUTS & FILTER BAR --}}
        <section class="sg-section" id="input">
            <h2 class="sg-title">Inputs & Filter Bar</h2>
            <p class="text-gray-500 mb-4">Gaya input form konsisten di seluruh halaman siswa.</p>

            <p class="sg-sub">Single Input</p>
            <div class="sg-preview-wrap mb-4">
                <div class="sg-preview-body space-y-4 max-w-lg">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" value="John Doe"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input type="password" placeholder="Minimal 8 karakter"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Select / Filter</label>
                        <select
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <option>Semua Jenjang</option>
                            <option>SD</option>
                            <option>SMP</option>
                            <option>SMA</option>
                        </select>
                    </div>
                </div>
            </div>

            <p class="sg-sub">Filter Bar (multi-column)</p>
            <div class="sg-preview-wrap mb-4">
                <div class="sg-preview-body">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                        <div class="grid md:grid-cols-5 gap-4 items-end">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Cari</label>
                                <input type="text" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Cari judul...">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tingkat</label>
                                <select class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    <option>Semua Tingkat</option>
                                    <option>SD</option>
                                    <option>SMP</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                                <select class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    <option>Semua Kategori</option>
                                    <option>Matematika</option>
                                    <option>IPA</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Guru</label>
                                <select class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    <option>Semua Guru</option>
                                </select>
                            </div>
                            <div class="flex gap-2">
                                <button class="flex-1 px-4 py-2.5 bg-indigo-600 text-white rounded-xl text-sm font-semibold hover:bg-indigo-700 transition-colors shadow-sm">
                                    <i class="bi bi-search me-1"></i> Cari
                                </button>
                                <a href="#" class="flex-1 px-4 py-2.5 bg-gray-100 text-gray-700 rounded-xl text-sm font-semibold hover:bg-gray-200 transition-colors text-center">
                                    Reset
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="sg-code mt-4"><code>&lt;div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5"&gt;
    &lt;div class="grid md:grid-cols-5 gap-4 items-end"&gt;
        &lt;div&gt;
            &lt;label class="block text-sm font-medium text-gray-700 mb-1"&gt;Cari&lt;/label&gt;
            &lt;input type="text" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"&gt;
        &lt;/div&gt;
        ...
        &lt;div class="flex gap-2"&gt;
            &lt;button class="flex-1 px-4 py-2.5 bg-indigo-600 text-white rounded-xl text-sm font-semibold"&gt;
                &lt;i class="bi bi-search me-1"&gt;&lt;/i&gt; Cari
            &lt;/button&gt;
        &lt;/div&gt;
    &lt;/div&gt;
&lt;/div&gt;</code></div>
                </div>
            </div>
        </section>

        {{-- 6. CARDS --}}
        <section class="sg-section" id="kartu">
            <h2 class="sg-title">Cards</h2>
            <p class="text-gray-500 mb-4">Tiga jenis kartu utama: Statistik, Konten (Materi/Quiz), dan Info.</p>

            <p class="sg-sub">Statistic Card</p>
            <div class="sg-preview-wrap mb-4">
                <div class="sg-preview-body">
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition-all duration-300 hover:-translate-y-1">
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
                            <p class="text-xs text-gray-400 mt-0.5">5 dari 8 Materi Selesai</p>
                        </div>
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition-all duration-300 hover:-translate-y-1">
                            <div class="flex items-center justify-between mb-3">
                                <div class="text-3xl font-black text-emerald-600">5</div>
                                <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center">
                                    <i class="bi bi-check-circle text-emerald-500 text-lg"></i>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 font-medium mt-1">Materi Selesai</p>
                        </div>
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition-all duration-300 hover:-translate-y-1">
                            <div class="flex items-center justify-between mb-3">
                                <div class="text-3xl font-black text-amber-500">3</div>
                                <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center">
                                    <i class="bi bi-book text-amber-500 text-lg"></i>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 font-medium mt-1">Sedang Dipelajari</p>
                        </div>
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition-all duration-300 hover:-translate-y-1">
                            <div class="flex items-center justify-between mb-3">
                                <div class="text-3xl font-black text-sky-500">12</div>
                                <div class="w-10 h-10 rounded-xl bg-sky-50 flex items-center justify-center">
                                    <i class="bi bi-bookmark text-sky-500 text-lg"></i>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 font-medium mt-1">Materi Tersimpan</p>
                        </div>
                    </div>
                    <div class="sg-code mt-4"><code>&lt;div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition-all duration-300 hover:-translate-y-1"&gt;
    &lt;div class="flex items-center justify-between mb-3"&gt;
        &lt;div class="text-3xl font-black text-indigo-600"&gt;65%&lt;/div&gt;
        &lt;div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center"&gt;
            &lt;i class="bi bi-graph-up text-indigo-500 text-lg"&gt;&lt;/i&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;div class="w-full bg-gray-100 rounded-full h-2.5"&gt;
        &lt;div class="bg-indigo-500 h-2.5 rounded-full" style="width:65%"&gt;&lt;/div&gt;
    &lt;/div&gt;
    &lt;p class="text-xs text-gray-500 mt-2 font-medium"&gt;Progress Keseluruhan&lt;/p&gt;
&lt;/div&gt;</code></div>
                </div>
            </div>

            <p class="sg-sub">Materi Card (Browse / My Learning)</p>
            <div class="sg-preview-wrap mb-4">
                <div class="sg-preview-body">
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4" style="max-width: 700px;">
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300 hover:-translate-y-1 group">
                            <a href="#">
                                <div class="h-36 bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center relative overflow-hidden">
                                    <i class="bi bi-journal-bookmark-fill text-4xl text-white/70"></i>
                                    <div class="absolute top-2 right-2 bg-white/90 backdrop-blur-sm rounded-full px-2 py-1 text-xs font-semibold text-emerald-600 flex items-center gap-1">
                                        <i class="bi bi-pencil-square text-xs"></i> Quiz
                                    </div>
                                </div>
                            </a>
                            <div class="p-5">
                                <a href="#">
                                    <h3 class="font-bold text-gray-900 mb-1 group-hover:text-indigo-600 transition-colors">Matematika Dasar</h3>
                                </a>
                                <p class="text-xs text-gray-500 mb-1">
                                    <i class="bi bi-person me-1"></i>
                                    <a href="#" class="hover:text-indigo-600 transition-colors">Budi Santoso</a>
                                </p>
                                <p class="text-xs text-gray-500 mb-1"><i class="bi bi-bar-chart me-1"></i>SD</p>
                                <p class="text-xs text-gray-500 mb-3"><i class="bi bi-tag me-1"></i>Matematika</p>
                                <div class="flex gap-2">
                                    <a href="#" class="flex-1 inline-flex items-center justify-center px-4 py-2.5 bg-indigo-600 text-white rounded-xl text-sm font-semibold hover:bg-indigo-700 transition-colors shadow-sm">
                                        Lihat Detail
                                    </a>
                                    <a href="#" class="inline-flex items-center justify-center px-4 py-2.5 bg-emerald-50 text-emerald-700 rounded-xl text-sm font-semibold hover:bg-emerald-100 transition-colors">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sg-code mt-4"><code>&lt;div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300 hover:-translate-y-1 group"&gt;
    &lt;a href="#"&gt;
        &lt;div class="h-36 bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center relative overflow-hidden"&gt;
            &lt;i class="bi bi-journal-bookmark-fill text-4xl text-white/70"&gt;&lt;/i&gt;
            &lt;!-- Quiz badge --&gt;
            &lt;div class="absolute top-2 right-2 bg-white/90 backdrop-blur-sm rounded-full px-2 py-1 text-xs font-semibold text-emerald-600"&gt;
                &lt;i class="bi bi-pencil-square text-xs"&gt;&lt;/i&gt; Quiz
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/a&gt;
    &lt;div class="p-5"&gt;
        &lt;h3 class="font-bold text-gray-900 group-hover:text-indigo-600"&gt;Judul&lt;/h3&gt;
        &lt;p class="text-xs text-gray-500"&gt;&lt;i class="bi bi-person"&gt;&lt;/i&gt; Guru&lt;/p&gt;
        &lt;div class="flex gap-2"&gt;
            &lt;a href="#" class="flex-1 bg-indigo-600 text-white rounded-xl px-4 py-2.5 text-sm font-semibold"&gt;Lihat Detail&lt;/a&gt;
        &lt;/div&gt;
    &lt;/div&gt;
&lt;/div&gt;</code></div>
                </div>
            </div>

            <p class="sg-sub">Continue Learning Card (with Progress Bar)</p>
            <div class="sg-preview-wrap">
                <div class="sg-preview-body">
                    <div class="grid md:grid-cols-2 gap-4" style="max-width: 500px;">
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300 hover:-translate-y-1 group">
                            <div class="h-36 bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center">
                                <i class="bi bi-journal-bookmark-fill text-4xl text-white/70"></i>
                            </div>
                            <div class="p-5">
                                <h3 class="font-bold text-gray-900 mb-1 group-hover:text-indigo-600 transition-colors">Matematika Dasar</h3>
                                <p class="text-xs text-gray-500 mb-2">
                                    <i class="bi bi-person me-1"></i>Budi Santoso
                                    <span class="mx-1">·</span>
                                    <i class="bi bi-bar-chart me-1"></i>SD
                                </p>
                                <div class="mb-3">
                                    <div class="flex items-center justify-between text-xs text-gray-500 mb-1">
                                        <span>Progress</span>
                                        <span class="font-semibold text-indigo-600">60%</span>
                                    </div>
                                    <div class="w-full bg-gray-100 rounded-full h-2">
                                        <div class="bg-indigo-500 h-2 rounded-full" style="width:60%"></div>
                                    </div>
                                </div>
                                <a href="#" class="inline-flex items-center justify-center w-full px-4 py-2.5 bg-indigo-600 text-white rounded-xl text-sm font-semibold hover:bg-indigo-700 transition-colors shadow-sm">
                                    Lanjutkan <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- 7. BADGES --}}
        <section class="sg-section" id="badges">
            <h2 class="sg-title">Badges</h2>
            <p class="text-gray-500 mb-4">Badge untuk status, peran, skor quiz di frontend siswa.</p>
            <div class="sg-preview-wrap">
                <div class="sg-preview-body space-y-4">
                    <p class="sg-sub">Status / Skor</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700">85%</span>
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700">60%</span>
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-red-50 text-red-700">40%</span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-50 text-green-700"><i class="bi bi-check-circle me-1"></i>Completed</span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-500"><i class="bi bi-lock me-1"></i>Locked</span>
                    </div>
                    <p class="sg-sub">Role</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-50 text-red-700">Admin</span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-700">Guru</span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold text-white bg-gray-500">Siswa</span>
                    </div>
                    <p class="sg-sub">Feature Badge (on cards)</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="inline-flex items-center gap-1 bg-white/90 backdrop-blur-sm rounded-full px-2 py-1 text-xs font-semibold text-emerald-600">
                            <i class="bi bi-pencil-square text-xs"></i> Quiz
                        </span>
                        <span class="bg-indigo-600 text-white rounded-full px-2 py-1 text-xs font-semibold">
                            <i class="bi bi-bookmark-fill"></i> Tersimpan
                        </span>
                        <span class="bg-gray-500 text-white rounded-full px-2 py-1 text-xs font-semibold">
                            <i class="bi bi-check-circle"></i> Selesai
                        </span>
                    </div>
                    <div class="sg-code"><code>&lt;span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700"&gt;85%&lt;/span&gt;
&lt;span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-500"&gt;Locked&lt;/span&gt;
&lt;span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold text-white bg-gray-500"&gt;Siswa&lt;/span&gt;</code></div>
                </div>
            </div>
        </section>

        {{-- 8. TABLE --}}
        <section class="sg-section" id="tabel">
            <h2 class="sg-title">Tables</h2>
            <p class="text-gray-500 mb-4">Tabel untuk quiz history dan data terbaru. Tanpa DataTables, pakai Tailwind styling.</p>
            <div class="sg-preview-wrap">
                <div class="sg-preview-body">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="bg-gray-50 border-b border-gray-100">
                                        <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Quiz</th>
                                        <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Materi</th>
                                        <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Skor</th>
                                        <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Bintang</th>
                                        <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-5 py-3 text-sm font-medium text-gray-900">Quiz Matematika</td>
                                        <td class="px-5 py-3 text-sm text-gray-500">Matematika Dasar</td>
                                        <td class="px-5 py-3">
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700">85%</span>
                                        </td>
                                        <td class="px-5 py-3">
                                            <div class="flex gap-0.5">
                                                <i class="bi bi-star-fill text-amber-400 text-sm"></i>
                                                <i class="bi bi-star-fill text-amber-400 text-sm"></i>
                                                <i class="bi bi-star text-gray-200 text-sm"></i>
                                            </div>
                                        </td>
                                        <td class="px-5 py-3 text-sm text-gray-500">15 Jun 2026</td>
                                    </tr>
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-5 py-3 text-sm font-medium text-gray-900">Quiz IPA</td>
                                        <td class="px-5 py-3 text-sm text-gray-500">Tata Surya</td>
                                        <td class="px-5 py-3">
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-red-50 text-red-700">40%</span>
                                        </td>
                                        <td class="px-5 py-3">
                                            <div class="flex gap-0.5">
                                                <i class="bi bi-star text-gray-200 text-sm"></i>
                                                <i class="bi bi-star text-gray-200 text-sm"></i>
                                                <i class="bi bi-star text-gray-200 text-sm"></i>
                                            </div>
                                        </td>
                                        <td class="px-5 py-3 text-sm text-gray-500">10 Jun 2026</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="sg-code mt-4"><code>&lt;div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden"&gt;
    &lt;div class="overflow-x-auto"&gt;
        &lt;table class="w-full"&gt;
            &lt;thead&gt;
                &lt;tr class="bg-gray-50 border-b border-gray-100"&gt;
                    &lt;th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider"&gt;Nama&lt;/th&gt;
                &lt;/tr&gt;
            &lt;/thead&gt;
            &lt;tbody class="divide-y divide-gray-100"&gt;
                &lt;tr class="hover:bg-gray-50 transition-colors"&gt;
                    &lt;td class="px-5 py-3 text-sm"&gt;Data&lt;/td&gt;
                &lt;/tr&gt;
            &lt;/tbody&gt;
        &lt;/table&gt;
    &lt;/div&gt;
&lt;/div&gt;</code></div>
                </div>
            </div>
        </section>

        {{-- 9. EMPTY STATE --}}
        <section class="sg-section" id="empty">
            <h2 class="sg-title">Empty State</h2>
            <p class="text-gray-500 mb-4">Tampilan ketika tidak ada data (hasil filter, quiz history kosong).</p>
            <div class="sg-preview-wrap">
                <div class="sg-preview-body">
                    <div class="text-center py-12">
                        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="bi bi-book text-3xl text-gray-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-1">Materi tidak ditemukan</h3>
                        <p class="text-gray-500 text-sm">Coba ubah kata kunci atau filter pencarian.</p>
                        <a href="#" class="inline-flex items-center mt-4 px-6 py-2.5 bg-indigo-600 text-white rounded-xl text-sm font-semibold hover:bg-indigo-700 transition-colors shadow-sm">
                            <i class="bi bi-arrow-counterclockwise me-2"></i> Reset Filter
                        </a>
                    </div>
                    <div class="sg-code"><code>&lt;div class="text-center py-16"&gt;
    &lt;div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4"&gt;
        &lt;i class="bi bi-book text-3xl text-gray-400"&gt;&lt;/i&gt;
    &lt;/div&gt;
    &lt;h3 class="text-lg font-semibold text-gray-900 mb-1"&gt;Materi tidak ditemukan&lt;/h3&gt;
    &lt;p class="text-gray-500 text-sm"&gt;Coba ubah kata kunci...&lt;/p&gt;
    &lt;a href="#" class="inline-flex items-center mt-4 px-6 py-2.5 bg-indigo-600 text-white rounded-xl text-sm font-semibold"&gt;Reset&lt;/a&gt;
&lt;/div&gt;</code></div>
                </div>
            </div>
        </section>

        {{-- 10. PAGINATION --}}
        <section class="sg-section" id="pagination">
            <h2 class="sg-title">Pagination</h2>
            <p class="text-gray-500 mb-4">Pagination Laravel default dengan Tailwind styling (dari <code>tailwindcss</code> pagination view).</p>
            <div class="sg-preview-wrap">
                <div class="sg-preview-body">
                    <div class="flex items-center justify-between">
                        <p class="text-sm text-gray-500">Menampilkan 1-6 dari 12 materi</p>
                        <nav class="inline-flex items-center gap-1">
                            <a href="#" class="px-3 py-1.5 rounded-lg text-sm font-medium text-gray-500 hover:bg-gray-100 transition-colors">&laquo;</a>
                            <a href="#" class="px-3 py-1.5 rounded-lg text-sm font-medium bg-indigo-600 text-white shadow-sm">1</a>
                            <a href="#" class="px-3 py-1.5 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 transition-colors">2</a>
                            <a href="#" class="px-3 py-1.5 rounded-lg text-sm font-medium text-gray-500 hover:bg-gray-100 transition-colors">&raquo;</a>
                        </nav>
                    </div>
                    <div class="sg-code mt-3"><code>@{{ $materiList->links() }}
&lt;!-- Laravel akan render pagination Tailwind secara otomatis --&gt;</code></div>
                </div>
            </div>
        </section>

        {{-- 11. PROGRESS BAR --}}
        <section class="sg-section" id="progress">
            <h2 class="sg-title">Progress Bar</h2>
            <p class="text-gray-500 mb-4">Progress bar untuk tracking belajar siswa.</p>
            <div class="sg-preview-wrap">
                <div class="sg-preview-body space-y-4 max-w-md">
                    <div>
                        <div class="flex items-center justify-between text-xs text-gray-500 mb-1">
                            <span>Progress</span>
                            <span class="font-semibold text-indigo-600">60%</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2">
                            <div class="bg-indigo-500 h-2 rounded-full" style="width:60%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center justify-between text-xs text-gray-500 mb-1">
                            <span>Progress Keseluruhan</span>
                            <span class="font-semibold text-indigo-600">65%</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2.5">
                            <div class="bg-indigo-500 h-2.5 rounded-full" style="width:65%"></div>
                        </div>
                    </div>
                    <div class="sg-code"><code>&lt;div class="w-full bg-gray-100 rounded-full h-2"&gt;
    &lt;div class="bg-indigo-500 h-2 rounded-full" style="width:60%"&gt;&lt;/div&gt;
&lt;/div&gt;</code></div>
                </div>
            </div>
        </section>

        {{-- 12. AVATAR --}}
        <section class="sg-section" id="avatar">
            <h2 class="sg-title">Avatar</h2>
            <p class="text-gray-500 mb-4">Avatar pengguna di navbar dan halaman profil.</p>
            <div class="sg-preview-wrap">
                <div class="sg-preview-body flex flex-wrap items-center gap-6">
                    <div class="flex flex-col items-center gap-1">
                        <img src="https://ui-avatars.com/api/?name=John+Doe&background=095890&color=fff&size=96"
                            class="w-9 h-9 rounded-full border object-cover" style="border-color: #DDE7EF;" alt="Avatar">
                        <span class="text-xs text-gray-500">w-9 h-9 (navbar)</span>
                    </div>
                    <div class="flex flex-col items-center gap-1">
                        <img src="https://ui-avatars.com/api/?name=John+Doe&background=095890&color=fff&size=128"
                            class="w-28 h-28 rounded-full border object-cover" style="border-color: #DDE7EF;" alt="Avatar">
                        <span class="text-xs text-gray-500">w-28 h-28 (profil)</span>
                    </div>
                    <div class="flex flex-col items-center gap-1">
                        <div class="w-9 h-9 rounded-full flex items-center justify-center bg-gray-200">
                            <i class="bi bi-person-circle text-2xl text-gray-400"></i>
                        </div>
                        <span class="text-xs text-gray-500">Fallback (no avatar)</span>
                    </div>
                    <div class="sg-code w-full mt-2"><code>@@if (auth()->user()->avatar)
    &lt;img src="@{{ auth()->user()->avatar }}"
         class="w-9 h-9 rounded-full border object-cover"&gt;
@@else
    &lt;i class="bi bi-person-circle text-2xl text-gray-400"&gt;
@@endif</code></div>
                </div>
            </div>
        </section>

        {{-- 13. NAVBAR --}}
        <section class="sg-section" id="navbar">
            <h2 class="sg-title">Navbar</h2>
            <p class="text-gray-500 mb-4">Navbar siswa dengan Alpine.js. Nav item aktif menggunakan class <code>nav-link-active</code>.</p>

            <p class="sg-sub">Desktop Preview</p>
            <div class="sg-preview-wrap mb-4">
                <div class="max-w-full overflow-hidden rounded-xl border" style="border-color: #DDE7EF;">
                    <nav class="bg-white" style="border-bottom: 1px solid #DDE7EF; min-height: 64px;">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                            <div class="flex items-center justify-between h-16">
                                <a class="flex items-center gap-2 shrink-0">
                                    <img src="{{ asset('images/sipinter-logo.png') }}" alt="SIPINTER" class="h-10 w-auto">
                                    <div>
                                        <span class="font-bold block text-base leading-tight" style="color: #095890;">SIPINTER</span>
                                        <span class="hidden lg:block text-[0.6rem] leading-tight" style="color: #64748B;">Belajar Interaktif dan Menyenangkan</span>
                                    </div>
                                </a>
                                <div class="hidden lg:flex items-center gap-1 absolute left-1/2 -translate-x-1/2">
                                    <span class="px-3 py-2 rounded-lg text-sm font-medium nav-link-active"><i class="bi bi-grid-fill me-1"></i>Dashboard</span>
                                    <span class="px-3 py-2 rounded-lg text-sm font-medium text-gray-700 nav-link-inactive"><i class="bi bi-compass me-1"></i>Jelajahi</span>
                                    <span class="px-3 py-2 rounded-lg text-sm font-medium text-gray-700 nav-link-inactive"><i class="bi bi-book me-1"></i>My Learning</span>
                                    <span class="px-3 py-2 rounded-lg text-sm font-medium text-gray-700 nav-link-inactive"><i class="bi bi-clock-history me-1"></i>Riwayat Quiz</span>
                                    <span class="px-3 py-2 rounded-lg text-sm font-medium text-gray-700 nav-link-inactive">
                                        <i class="bi bi-people me-1"></i>Permintaan
                                        <span class="inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white rounded-full" style="background-color:#DC2626;">2</span>
                                    </span>
                                </div>
                                <div class="hidden lg:flex items-center">
                                    <div class="flex items-center gap-2 px-3 py-2 rounded-lg nav-link-inactive">
                                        <img src="https://ui-avatars.com/api/?name=John+Doe&background=095890&color=fff&size=64"
                                            class="w-9 h-9 rounded-full border object-cover" style="border-color: #DDE7EF;" alt="Avatar">
                                        <span class="text-sm font-medium text-gray-700">John Doe</span>
                                        <i class="bi bi-chevron-down text-xs" style="color: #64748B;"></i>
                                    </div>
                                </div>
                                <button class="lg:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors" style="color: #095890;">
                                    <i class="bi bi-list text-2xl"></i>
                                </button>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>

            <div class="sg-code"><code>&lt;a href="@{{ route('siswa.dashboard') }}"
    class="px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-150
    @{{ request()->routeIs('siswa.dashboard') ? 'nav-link-active' : 'text-gray-700 nav-link-inactive' }}"&gt;
    &lt;i class="bi bi-grid-fill me-1"&gt;&lt;/i&gt;Dashboard
&lt;/a&gt;

&lt;!-- Pending badge --&gt;
@@if ($pendingCount &gt; 0)
    &lt;span class="inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white rounded-full"
          style="background-color: #DC2626;"&gt;@{{ $pendingCount }}&lt;/span&gt;
@@endif

&lt;!-- User dropdown with Alpine.js --&gt;
&lt;div x-data="{ userOpen: false }" @click.away="userOpen = false"&gt;
    &lt;button @click="userOpen = !userOpen"&gt;
        &lt;img src="..." class="w-9 h-9 rounded-full"&gt;
        &lt;span&gt;@{{ auth()->user()->name }}&lt;/span&gt;
    &lt;/button&gt;
    &lt;div x-show="userOpen" x-transition ...&gt;
        &lt;a href="@{{ route('siswa.profile') }}"&gt;Profil&lt;/a&gt;
        &lt;form action="@{{ route('logout') }}" method="post"&gt;
            @@csrf
            &lt;button type="submit"&gt;Keluar&lt;/button&gt;
        &lt;/form&gt;
    &lt;/div&gt;
&lt;/div&gt;</code></div>
        </section>

        {{-- 14. QUIZ CARD --}}
        <section class="sg-section" id="quiz-card">
            <h2 class="sg-title">Quiz Card</h2>
            <p class="text-gray-500 mb-4">Kartu daftar quiz pada halaman Quiz Saya (<code>student/quiz/index.blade.php</code>).</p>
            <div class="sg-preview-wrap">
                <div class="sg-preview-body space-y-4">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition-all duration-300">
                        <div class="flex items-start justify-between">
                            <div>
                                <h3 class="font-bold text-gray-900 text-lg">Quiz Matematika Dasar</h3>
                                <p class="text-sm text-gray-500 mt-1">Materi: Matematika Dasar</p>
                                <div class="flex items-center gap-4 mt-2 text-xs text-gray-500">
                                    <span><i class="bi bi-clock me-1"></i>30 menit</span>
                                    <span><i class="bi bi-question-circle me-1"></i>10 soal</span>
                                    <span><i class="bi bi-bar-chart me-1"></i>3 attempts</span>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-black text-indigo-600">85%</div>
                                <div class="flex gap-0.5 mt-1 justify-end">
                                    <i class="bi bi-star-fill text-amber-400 text-sm"></i>
                                    <i class="bi bi-star-fill text-amber-400 text-sm"></i>
                                    <i class="bi bi-star text-gray-200 text-sm"></i>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="#" class="inline-flex items-center gap-2 px-5 py-2 bg-indigo-600 text-white rounded-xl text-sm font-semibold hover:bg-indigo-700 transition-colors shadow-sm">
                                <i class="bi bi-arrow-right"></i> Mulai Quiz
                            </a>
                        </div>
                    </div>
                    <div class="sg-code"><code>&lt;div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition-all"&gt;
    &lt;div class="flex items-start justify-between"&gt;
        &lt;div&gt;
            &lt;h3 class="font-bold text-gray-900 text-lg"&gt;Judul Quiz&lt;/h3&gt;
            &lt;p class="text-sm text-gray-500"&gt;Materi: ...&lt;/p&gt;
            &lt;div class="flex items-center gap-4 mt-2 text-xs text-gray-500"&gt;
                &lt;span&gt;&lt;i class="bi bi-clock"&gt;&lt;/i&gt;30 menit&lt;/span&gt;
                &lt;span&gt;&lt;i class="bi bi-question-circle"&gt;&lt;/i&gt;10 soal&lt;/span&gt;
            &lt;/div&gt;
        &lt;/div&gt;
        &lt;div class="text-right"&gt;
            &lt;div class="text-2xl font-black text-indigo-600"&gt;85%&lt;/div&gt;
            &lt;div class="flex gap-0.5"&gt;...bintang...&lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;a href="#" class="inline-flex items-center gap-2 px-5 py-2 bg-indigo-600 text-white rounded-xl text-sm font-semibold shadow-sm"&gt;Mulai Quiz&lt;/a&gt;
&lt;/div&gt;</code></div>
                </div>
            </div>
        </section>

        {{-- 15. ICONS --}}
        <section class="sg-section" id="ikon">
            <h2 class="sg-title">Icons</h2>
            <p class="text-gray-500 mb-4">Bootstrap Icons <code>bi-*</code> yang digunakan di frontend siswa.</p>
            @php
                $icons = [
                    ['bi-grid-fill', 'Dashboard', 'Navigasi utama'],
                    ['bi-compass', 'Jelajahi', 'Navigasi browse'],
                    ['bi-book', 'Materi', 'Navigasi / konten'],
                    ['bi-person-circle', 'Profil', 'Avatar fallback'],
                    ['bi-pencil-square', 'Quiz', 'Navigasi / kartu'],
                    ['bi-clock-history', 'Riwayat', 'Navigasi riwayat'],
                    ['bi-people', 'Permintaan', 'Navigasi orang tua'],
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
                    ['bi-bookmark', 'Tersimpan', 'Ikon bookmark'],
                    ['bi-journal-bookmark-fill', 'Materi Card', 'Thumbnail default'],
                    ['bi-magic', 'AI', 'Generate AI'],
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
