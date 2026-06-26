<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Style Guide Admin — SIPINTER</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('admin-lte/dist/css/adminlte.css') }}">
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
        body { font-family: 'Source Sans 3', sans-serif; background: #f4f6f9; color: #1E293B; }
        .sg-header { background: linear-gradient(135deg, var(--si-primary), var(--si-primary-hover)); color: #fff; padding: 40px 0 28px; }
        .sg-header h1 { font-size: 2rem; font-weight: 800; }
        .sg-header p { opacity: .85; font-size: 1rem; }
        .sg-section { padding: 32px 0; }
        .sg-section:nth-child(even) { background: #fff; }
        .sg-title { font-size: 1.3rem; font-weight: 700; color: var(--si-primary); margin-bottom: 1.25rem; padding-bottom: .35rem; border-bottom: 3px solid var(--si-primary); }
        .sg-sub { font-size: .9rem; font-weight: 600; color: var(--si-text-dark); margin-bottom: .75rem; }
        .sg-code { background: #1e293b; color: #e2e8f0; border-radius: 8px; padding: 16px; font-size: .78rem; overflow-x: auto; margin-top: 12px; }
        .sg-code code { white-space: pre; }
        .color-swatch { height: 70px; border-radius: 8px 8px 0 0; }
        .color-card { border-radius: 8px; overflow: hidden; border: 1px solid #dee2e6; background: #fff; }
        .color-body { padding: 10px 14px; }
        .color-body code { font-size: .75rem; }
        .sg-preview-wrap { border: 1px solid #dee2e6; border-radius: 8px; overflow: hidden; background: #fff; }
        .sg-preview-body { padding: 20px; }
        .sg-inner-card { max-width: 600px; }
        .sidebar-preview { background: #343a40; color: #fff; width: 240px; border-radius: 8px; overflow: hidden; }
        .sidebar-preview .brand { padding: 16px; border-bottom: 1px solid rgba(255,255,255,.1); font-weight: 300; font-size: 1.25rem; display: flex; align-items: center; gap: 10px; }
        .sidebar-preview .nav-item { padding: 10px 16px; color: rgba(255,255,255,.7); font-size: .9rem; display: flex; align-items: center; gap: 10px; border-bottom: 1px solid rgba(255,255,255,.05); }
        .sidebar-preview .nav-item i { width: 20px; }
        .sidebar-preview .nav-item:hover { background: rgba(255,255,255,.1); color: #fff; }
    </style>
</head>
<body>

    <header class="sg-header">
        <div class="container">
            <h1>Style Guide Admin</h1>
            <p>Panduan desain Dashboard Admin dan Guru SIPINTER</p>
            <div class="mt-3 d-flex gap-2 flex-wrap">
                <a href="{{ route('styleguide.student') }}" class="btn btn-outline-light btn-sm fw-semibold">Style Guide Siswa</a>
                <a href="{{ route('styleguide.admin') }}" class="btn btn-light btn-sm fw-semibold">Style Guide Admin</a>
            </div>
        </div>
    </header>

    <main class="container py-4">

        <!-- ============================================================ -->
        <!-- 1. PALET WARNA -->
        <!-- ============================================================ -->
        <section class="sg-section" id="warna">
            <h2 class="sg-title">1. Palet Warna</h2>
            <p class="text-muted mb-4">Warna utama AdminLTE yang digunakan di dashboard.</p>
            @php
                $adminColors = [
                    ['#007bff', 'Primary', 'Tombol utama, tautan, header tabel'],
                    ['#17a2b8', 'Info', 'Tombol detail, aksen informasi'],
                    ['#28a745', 'Success', 'Status aktif/published, tombol export'],
                    ['#ffc107', 'Warning', 'Tombol edit, badge peringatan'],
                    ['#dc3545', 'Danger', 'Tombol hapus, badge berbahaya'],
                    ['#6c757d', 'Secondary', 'Tombol batal, teks sekunder'],
                ];
            @endphp
            <div class="row g-3">
                @foreach ($adminColors as $c)
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="color-card">
                            <div class="color-swatch" style="background:{{ $c[0] }}"></div>
                            <div class="color-body">
                                <code>{{ $c[0] }}</code>
                                <div class="fw-semibold small mt-1">{{ $c[1] }}</div>
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
            <p class="text-muted mb-4">Font: <strong>Source Sans 3</strong>. Contoh teks dari halaman dashboard.</p>
            <div class="sg-preview-wrap">
                <div class="sg-preview-body">
                    <h3 class="mb-0 fw-bold" style="color:var(--si-text-dark)">Dashboard — h3.mb-0 (judul halaman)</h3>
                    <hr class="my-3">
                    <h5 class="card-title mb-0">Judul Card — h5.card-title</h5>
                    <hr class="my-3">
                    <p class="text-muted mb-1">Jumlah Materi — teks label statistik</p>
                    <hr class="my-3">
                    <table class="table table-bordered mb-0" style="max-width:500px">
                        <thead><tr><th>Nama Kolom — table th</th></tr></thead>
                        <tbody><tr><td>Isi tabel — table td</td></tr></tbody>
                    </table>
                    <hr class="my-3">
                    <label class="form-label">Nama Label — form-label</label>
                    <input type="text" class="form-control" placeholder="Placeholder text" style="max-width:300px">
                </div>
            </div>
        </section>

        <!-- ============================================================ -->
        <!-- 3. TOMBOL -->
        <!-- ============================================================ -->
        <section class="sg-section" id="tombol">
            <h2 class="sg-title">3. Tombol</h2>
            <p class="text-muted mb-4">Tombol yang digunakan di halaman dashboard index dan form.</p>
            <div class="sg-preview-wrap">
                <div class="sg-preview-body">
                    <p class="sg-sub">Tombol Aksi (btn-sm dengan ikon)</p>
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <a href="#" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg"></i> Tambah</a>
                        <a href="#" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> Edit</a>
                        <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Hapus</button>
                        <a href="#" class="btn btn-info btn-sm"><i class="bi bi-eye"></i> Detail</a>
                        <a href="#" class="btn btn-success btn-sm"><i class="bi bi-file-earmark-pdf"></i> Export PDF</a>
                        <a href="#" class="btn btn-secondary btn-sm"><i class="bi bi-arrow-left"></i> Kembali</a>
                    </div>

                    <p class="sg-sub">Tombol Group (aksi tabel)</p>
                    <div class="btn-group btn-group-sm">
                        <a href="#" class="btn btn-info" title="Lihat"><i class="bi bi-eye"></i></a>
                        <a href="#" class="btn btn-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                        <button class="btn btn-danger" title="Hapus"><i class="bi bi-trash"></i></button>
                    </div>

                    <p class="sg-sub mt-3">Tombol Form (Simpan &amp; Batal)</p>
                    <div class="d-flex gap-2">
                        <button class="btn btn-primary">Simpan</button>
                        <a href="#" class="btn btn-secondary">Batal</a>
                    </div>

                    <div class="sg-code mt-3"><code>&lt;a href="#" class="btn btn-primary btn-sm"&gt;&lt;i class="bi bi-plus-lg"&gt;&lt;/i&gt; Tambah&lt;/a&gt;
        &lt;div class="btn-group btn-group-sm"&gt; ... &lt;/div&gt;</code></div>
                </div>
            </div>
        </section>

        <!-- ============================================================ -->
        <!-- 4. KARTU ADMINLTE -->
        <!-- ============================================================ -->
        <section class="sg-section" id="kartu">
            <h2 class="sg-title">4. Kartu AdminLTE</h2>
            <p class="text-muted mb-4">Struktur kartu AdminLTE yang digunakan di seluruh dashboard.</p>

            <div class="row g-4">
                <div class="col-md-6">
                    <p class="sg-sub">Kartu Standar (header + body + footer)</p>
                    <div class="card sg-inner-card">
                        <div class="card-header">
                            <h3 class="card-title">Judul Kartu</h3>
                            <div class="card-tools">
                                <a href="#" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg"></i> Tombol</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="mb-0">Konten kartu di dalam <code>.card-body</code>.</p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">Footer kartu</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <p class="sg-sub">Kartu Statistik (icon + angka)</p>
                    <div class="card sg-inner-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="text-muted mb-1">Jumlah Materi</p>
                                    <h3 class="mb-0 fw-bold">12</h3>
                                </div>
                                <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                                    <i class="bi bi-book fs-4 text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sg-code mt-2"><code>&lt;div class="card"&gt;&lt;div class="card-body"&gt;&lt;div class="d-flex justify-content-between align-items-start"&gt;...&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;</code></div>
                </div>
            </div>

            <div class="row g-4 mt-2">
                <div class="col-md-6">
                    <p class="sg-sub">Kartu dengan Tabel (card-body p-0)</p>
                    <div class="card sg-inner-card">
                        <div class="card-header"><h3 class="card-title">Daftar Data</h3></div>
                        <div class="card-body p-0">
                            <table class="table table-bordered table-hover mb-0">
                                <thead><tr><th>No</th><th>Nama</th><th>Status</th></tr></thead>
                                <tbody>
                                    <tr><td>1</td><td>Contoh Data</td><td><span class="badge bg-success">Aktif</span></td></tr>
                                    <tr><td>2</td><td>Contoh Lain</td><td><span class="badge bg-secondary">Draft</span></td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <p class="sg-sub">Kartu Profile (card-primary card-outline)</p>
                    <div class="card card-primary card-outline sg-inner-card">
                        <div class="card-body box-profile text-center">
                            <i class="bi bi-person-circle" style="font-size:4rem;color:#6c757d"></i>
                            <h3 class="profile-username">Nama User</h3>
                            <p><span class="badge bg-primary text-capitalize">admin</span></p>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item"><b>Email</b><span class="float-end">user@mail.com</span></li>
                                <li class="list-group-item"><b>Bergabung</b><span class="float-end">26 Jun 2026</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================================ -->
        <!-- 5. TABEL -->
        <!-- ============================================================ -->
        <section class="sg-section" id="tabel">
            <h2 class="sg-title">5. Tabel</h2>
            <p class="text-muted mb-4">Tabel DataTables yang digunakan di halaman index dashboard.</p>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Materi</h3>
                    <div class="card-tools">
                        <a href="#" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg"></i> Tambah</a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-bordered table-hover mb-0 align-middle">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Guru</th>
                                <th>Jenjang</th>
                                <th>Kategori</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Matematika Dasar</td>
                                <td>Budi Santoso</td>
                                <td>SD</td>
                                <td>Matematika</td>
                                <td><span class="badge bg-success">Published</span></td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="#" class="btn btn-info"><i class="bi bi-eye"></i></a>
                                        <a href="#" class="btn btn-warning"><i class="bi bi-pencil"></i></a>
                                        <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Tata Surya</td>
                                <td>Siti Aisyah</td>
                                <td>SMP</td>
                                <td>IPA</td>
                                <td><span class="badge bg-secondary">Draft</span></td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="#" class="btn btn-info"><i class="bi bi-eye"></i></a>
                                        <a href="#" class="btn btn-warning"><i class="bi bi-pencil"></i></a>
                                        <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <small class="text-muted">Menampilkan 1-2 dari 2 entri</small>
                    <nav>
                        <ul class="pagination pagination-sm mb-0">
                            <li class="page-item disabled"><a class="page-link" href="#">&laquo;</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item disabled"><a class="page-link" href="#">&raquo;</a></li>
                        </ul>
                    </nav>
                </div>
            </div>

            <div class="sg-code mt-3"><code>&lt;div class="card"&gt;&lt;div class="card-header"&gt;&lt;h3 class="card-title"&gt;Daftar Materi&lt;/h3&gt;&lt;div class="card-tools"&gt;&lt;a href="#" class="btn btn-primary btn-sm"&gt;&lt;i class="bi bi-plus-lg"&gt;&lt;/i&gt; Tambah&lt;/a&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class="card-body p-0"&gt;&lt;table class="table table-bordered table-hover mb-0"&gt;...&lt;/table&gt;&lt;/div&gt;&lt;/div&gt;</code></div>

            <p class="sg-sub mt-4">Role Badge pada Tabel User</p>
            <div class="d-flex gap-2 flex-wrap">
                <span class="badge bg-danger">Admin</span>
                <span class="badge bg-primary">Guru</span>
                <span class="badge bg-success">Siswa</span>
                <span class="badge bg-warning text-dark">Pending</span>
                <span class="badge bg-secondary">Draft</span>
                <span class="badge bg-info">Aktif</span>
            </div>
        </section>

        <!-- ============================================================ -->
        <!-- 6. SIDEBAR -->
        <!-- ============================================================ -->
        <section class="sg-section" id="sidebar">
            <h2 class="sg-title">6. Sidebar</h2>
            <p class="text-muted mb-4">Sidebar navigasi AdminLTE untuk role Admin dan Guru.</p>

            <p class="sg-sub">Sidebar Admin</p>
            <div class="sidebar-preview mb-3">
                <div class="brand">
                    <img src="{{ asset('images/sipinter-logo.png') }}" alt="SIPINTER" height="32">
                    SIPINTER
                </div>
                <div class="nav-item"><i class="bi bi-speedometer2"></i> Dashboard</div>
                <div class="nav-item"><i class="bi bi-people"></i> Kelola User</div>
                <div class="nav-item"><i class="bi bi-layers"></i> Kelola Jenjang</div>
                <div class="nav-item"><i class="bi bi-tags"></i> Kelola Kategori</div>
                <div class="nav-item"><i class="bi bi-book"></i> Kelola Materi</div>
                <div class="nav-item"><i class="bi bi-pencil-square"></i> Kelola Quiz</div>
                <div class="nav-item"><i class="bi bi-file-text"></i> Laporan</div>
            </div>

            <p class="sg-sub">Sidebar Guru</p>
            <div class="sidebar-preview">
                <div class="brand">
                    <img src="{{ asset('images/sipinter-logo.png') }}" alt="SIPINTER" height="32">
                    SIPINTER
                </div>
                <div class="nav-item"><i class="bi bi-speedometer2"></i> Dashboard</div>
                <div class="nav-item"><i class="bi bi-book"></i> Kelola Materi</div>
                <div class="nav-item"><i class="bi bi-pencil-square"></i> Kelola Quiz</div>
                <div class="nav-item"><i class="bi bi-bar-chart"></i> Hasil Siswa</div>
            </div>
        </section>

        <!-- ============================================================ -->
        <!-- 7. FORM -->
        <!-- ============================================================ -->
        <section class="sg-section" id="form">
            <h2 class="sg-title">7. Form</h2>
            <p class="text-muted mb-4">Form create/edit yang digunakan di halaman dashboard.</p>

            <p class="sg-sub">Form Materi</p>
            <div class="card sg-inner-card mb-4">
                <div class="card-header"><h5 class="card-title mb-0">Tambah Materi Baru</h5></div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Judul <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Masukkan judul materi">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenjang <span class="text-danger">*</span></label>
                        <select class="form-select">
                            <option>-- Pilih Jenjang --</option>
                            <option>SD</option>
                            <option>SMP</option>
                            <option>SMA</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select class="form-select">
                            <option>-- Pilih Kategori --</option>
                            <option>Matematika</option>
                            <option>IPA</option>
                            <option>IPS</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" rows="3"></textarea>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="pub">
                        <label class="form-check-label" for="pub">Published</label>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-primary">Simpan</button>
                        <a href="#" class="btn btn-secondary">Batal</a>
                    </div>
                </div>
            </div>

            <p class="sg-sub">Form Quiz</p>
            <div class="card sg-inner-card mb-4">
                <div class="card-header"><h5 class="card-title mb-0">Tambah Quiz Baru</h5></div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Materi</label>
                        <select class="form-select">
                            <option>-- Pilih Materi --</option>
                            <option>Matematika Dasar</option>
                            <option>Tata Surya</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Judul</label>
                        <input type="text" class="form-control" placeholder="Masukkan judul quiz">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Durasi (menit)</label>
                        <input type="number" class="form-control" min="1" max="999">
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-primary">Simpan</button>
                        <a href="#" class="btn btn-secondary">Batal</a>
                    </div>
                </div>
            </div>

            <p class="sg-sub">Form User</p>
            <div class="card sg-inner-card">
                <div class="card-header"><h5 class="card-title mb-0">Tambah User Baru</h5></div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" placeholder="Masukkan nama">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" placeholder="nama@email.com">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select class="form-select">
                            <option>-- Pilih Role --</option>
                            <option>Admin</option>
                            <option>Guru</option>
                            <option>Siswa</option>
                        </select>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-primary">Simpan</button>
                        <a href="#" class="btn btn-secondary">Batal</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================================ -->
        <!-- 8. INSPIRASI -->
        <!-- ============================================================ -->
        <section class="sg-section" id="inspirasi">
            <h2 class="sg-title">8. Inspirasi</h2>
            <p class="text-muted mb-4">Dashboard Admin dan Guru SIPINTER menggunakan template AdminLTE 3.</p>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body d-flex align-items-start gap-3 p-4">
                            <div class="bg-primary bg-opacity-10 rounded-3 p-3 flex-shrink-0">
                                <i class="bi bi-grid-1x2 fs-3 text-primary"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-2">AdminLTE 3</h5>
                                <p class="text-muted mb-0" style="font-size:.9rem">
                                    Dashboard SIPINTER dibangun di atas <strong>AdminLTE 3</strong> dengan Bootstrap 5. Struktur sidebar, kartu, header, dan komponen dashboard lainnya mengikuti pola AdminLTE. Warna primary disesuaikan dengan brand SIPINTER (<code>--si-primary: #095890</code>).
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body d-flex align-items-start gap-3 p-4">
                            <div class="bg-success bg-opacity-10 rounded-3 p-3 flex-shrink-0">
                                <i class="bi bi-table fs-3 text-success"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-2">DataTables</h5>
                                <p class="text-muted mb-0" style="font-size:.9rem">
                                    Semua tabel index menggunakan <strong>DataTables</strong> dengan fitur pencarian, pengurutan, pagination, dan responsive. Bahasa Indonesia diaktifkan melalui CDN <code>id.json</code>. Tombol aksi menggunakan <code>btn-group btn-group-sm</code>.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <footer class="bg-white border-top py-4 text-center text-muted small">
        &copy; {{ date('Y') }} SIPINTER — Style Guide Admin
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"></script>
</body>
</html>
