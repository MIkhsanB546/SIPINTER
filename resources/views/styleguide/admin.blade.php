<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Style Guide — SIPINTER</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('admin-lte/dist/css/adminlte.css') }}">
    <style>
        :root { --si-primary: #095890; --si-primary-hover: #0A6AAE; --si-border: #DDE7EF; --si-text-dark: #1E293B; --si-muted: #64748B; }
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
        .tab-pill { display: inline-flex; border-radius: 8px; padding: 8px 18px; font-size: .9rem; font-weight: 600; transition: all .2s; }
        .tab-pill-active { background: #fff; color: var(--si-primary); }
        .tab-pill-inactive { color: rgba(255,255,255,.8); }
        .tab-pill-inactive:hover { background: rgba(255,255,255,.15); color: #fff; }
    </style>
</head>
<body>

<header class="sg-header">
    <div class="container">
        <h1>SIPINTER Admin Dashboard Design System</h1>
        <p>Dashboard admin dan guru menggunakan Bootstrap 5 dan AdminLTE.</p>
        <div class="mt-3 d-flex gap-2 flex-wrap">
            <a href="{{ route('styleguide.student') }}" class="tab-pill tab-pill-inactive">Frontend</a>
            <span class="tab-pill tab-pill-active">Admin</span>
        </div>
    </div>
</header>

<main class="container py-4">

    {{-- 1. COLORS --}}
    <section class="sg-section" id="warna">
        <h2 class="sg-title">Colors</h2>
        <p class="text-muted mb-4">Warna Bootstrap yang digunakan di dashboard admin/guru.</p>
        @php
            $adminColors = [
                ['#095890', 'Primary', 'Tombol utama, tautan, header (custom SIPINTER)'],
                ['#17a2b8', 'Info', 'Tombol detail, aksi lihat'],
                ['#28a745', 'Success', 'Status aktif/published, tombol export'],
                ['#ffc107', 'Warning', 'Tombol edit, badge peringatan'],
                ['#dc3545', 'Danger', 'Tombol hapus, status berbahaya'],
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

    {{-- 2. TYPOGRAPHY --}}
    <section class="sg-section" id="tipografi">
        <h2 class="sg-title">Typography</h2>
        <p class="text-muted mb-4">Font: <strong>Source Sans 3</strong>. Contoh dari halaman dashboard.</p>
        <div class="sg-preview-wrap">
            <div class="sg-preview-body">
                <h1 class="fw-bold" style="color:var(--si-text-dark)">h1 — Judul Halaman</h1>
                <hr class="my-3">
                <h2 class="fw-bold" style="color:var(--si-text-dark)">h2 — Sub Judul</h2>
                <hr class="my-3">
                <h3 class="card-title">h3.card-title — Judul Kartu</h3>
                <hr class="my-3">
                <label class="form-label">form-label — Label Input</label>
                <input type="text" class="form-control" placeholder="Placeholder" style="max-width:300px">
                <hr class="my-3">
                <p class="text-muted mb-0">text-muted — Teks sekunder / keterangan</p>
            </div>
        </div>
    </section>

    {{-- 3. BUTTONS --}}
    <section class="sg-section" id="tombol">
        <h2 class="sg-title">Buttons</h2>
        <p class="text-muted mb-4">Semua variasi tombol Bootstrap yang digunakan di dashboard.</p>

        <div class="sg-preview-wrap">
            <div class="sg-preview-body">
                <p class="sg-sub">Individual Buttons</p>
                <div class="d-flex flex-wrap gap-2 mb-4">
                    <a href="#" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg"></i> Tambah</a>
                    <a href="#" class="btn btn-info btn-sm"><i class="bi bi-eye"></i> Detail</a>
                    <a href="#" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> Edit</a>
                    <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Hapus</button>
                    <a href="#" class="btn btn-success btn-sm"><i class="bi bi-file-earmark-pdf"></i> Export PDF</a>
                    <a href="#" class="btn btn-secondary btn-sm"><i class="bi bi-arrow-left"></i> Kembali</a>
                </div>

                <p class="sg-sub">Action Button Group (tabel)</p>
                <div class="btn-group btn-group-sm mb-4">
                    <a href="#" class="btn btn-info" title="Lihat"><i class="bi bi-eye"></i></a>
                    <a href="#" class="btn btn-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                    <form class="m-0 p-0">
                        <button class="btn btn-danger" title="Hapus"><i class="bi bi-trash"></i></button>
                    </form>
                </div>

                <p class="sg-sub">Form Buttons</p>
                <div class="d-flex gap-2">
                    <button class="btn btn-primary">Simpan</button>
                    <a href="#" class="btn btn-secondary">Batal</a>
                </div>

                <div class="sg-code mt-3"><code>&lt;div class="btn-group btn-group-sm"&gt;
    &lt;a class="btn btn-info"&gt;&lt;i class="bi bi-eye"&gt;&lt;/i&gt;&lt;/a&gt;
    &lt;a class="btn btn-warning"&gt;&lt;i class="bi bi-pencil"&gt;&lt;/i&gt;&lt;/a&gt;
    &lt;button class="btn btn-danger"&gt;&lt;i class="bi bi-trash"&gt;&lt;/i&gt;&lt;/button&gt;
&lt;/div&gt;</code></div>
            </div>
        </div>
    </section>

    {{-- 4. TABLES --}}
    <section class="sg-section" id="tabel">
        <h2 class="sg-title">Tables</h2>
        <p class="text-muted mb-4">DataTables dengan AdminLTE styling. Search input di card-tools, action button group di kolom aksi.</p>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Data</h3>
                <div class="card-tools">
                    <div class="input-group input-group-sm me-2" style="width: 200px;">
                        <input type="text" class="form-control" placeholder="Cari...">
                        <button class="btn btn-outline-secondary" type="button"><i class="bi bi-search"></i></button>
                    </div>
                    <a href="#" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg"></i> Tambah</a>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Guru</th>
                            <th>Jenjang</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
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
                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <a href="#" class="btn btn-info" title="Lihat"><i class="bi bi-eye"></i></a>
                                    <a href="#" class="btn btn-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                                    <form class="m-0 p-0">
                                        <button class="btn btn-danger" title="Hapus"><i class="bi bi-trash"></i></button>
                                    </form>
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
                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <a href="#" class="btn btn-info" title="Lihat"><i class="bi bi-eye"></i></a>
                                    <a href="#" class="btn btn-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                                    <form class="m-0 p-0">
                                        <button class="btn btn-danger" title="Hapus"><i class="bi bi-trash"></i></button>
                                    </form>
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
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="sg-code mt-3"><code>&lt;div class="card"&gt;
    &lt;div class="card-header"&gt;
        &lt;h3 class="card-title"&gt;Daftar Data&lt;/h3&gt;
        &lt;div class="card-tools"&gt;
            &lt;div class="input-group input-group-sm" style="width:200px"&gt;
                &lt;input type="text" class="form-control" placeholder="Cari..."&gt;
                &lt;button class="btn btn-outline-secondary"&gt;&lt;i class="bi bi-search"&gt;&lt;/i&gt;&lt;/button&gt;
            &lt;/div&gt;
            &lt;a href="#" class="btn btn-primary btn-sm"&gt;&lt;i class="bi bi-plus-lg"&gt;&lt;/i&gt; Tambah&lt;/a&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;div class="card-body p-0"&gt;
        &lt;table class="table table-striped table-hover align-middle mb-0"&gt;
            &lt;thead&gt;&lt;tr&gt;&lt;th&gt;No&lt;/th&gt;&lt;th&gt;Nama&lt;/th&gt;&lt;th class="text-center"&gt;Aksi&lt;/th&gt;&lt;/tr&gt;&lt;/thead&gt;
            &lt;tbody&gt;...&lt;/tbody&gt;
        &lt;/table&gt;
    &lt;/div&gt;
    &lt;div class="card-footer"&gt;
        &lt;nav&gt;
            &lt;ul class="pagination pagination-sm mb-0"&gt;
                &lt;li class="page-item disabled"&gt;&lt;a class="page-link" href="#"&gt;&amp;laquo;&lt;/a&gt;&lt;/li&gt;
                &lt;li class="page-item active"&gt;&lt;a class="page-link" href="#"&gt;1&lt;/a&gt;&lt;/li&gt;
                &lt;li class="page-item"&gt;&lt;a class="page-link" href="#"&gt;&amp;raquo;&lt;/a&gt;&lt;/li&gt;
            &lt;/ul&gt;
        &lt;/nav&gt;
    &lt;/div&gt;
&lt;/div&gt;</code></div>

        <p class="sg-sub mt-4">Badges (Role / Status)</p>
        <div class="d-flex gap-2 flex-wrap">
            <span class="badge bg-danger">Admin</span>
            <span class="badge bg-primary">Guru</span>
            <span class="badge bg-success">Siswa</span>
            <span class="badge bg-warning text-dark">Pending</span>
            <span class="badge bg-secondary">Draft</span>
            <span class="badge bg-info">Aktif</span>
        </div>
    </section>

    {{-- 5. FORMS --}}
    <section class="sg-section" id="form">
        <h2 class="sg-title">Forms</h2>
        <p class="text-muted mb-4">Form create/edit menggunakan kelas Bootstrap <code>form-control</code>, <code>form-select</code>, dan <code>form-check</code>.</p>

        <div class="card sg-inner-card">
            <div class="card-header"><h5 class="card-title mb-0">Form Input</h5></div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Nama <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" placeholder="Masukkan nama">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" placeholder="nama@email.com">
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
                    <label class="form-label">Deskripsi</label>
                    <textarea class="form-control" rows="3" placeholder="Masukkan deskripsi"></textarea>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="published">
                    <label class="form-check-label" for="published">Published</label>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-primary">Simpan</button>
                    <a href="#" class="btn btn-secondary">Batal</a>
                </div>
            </div>
        </div>
    </section>

    {{-- 6. CARDS --}}
    <section class="sg-section" id="kartu">
        <h2 class="sg-title">Cards</h2>
        <p class="text-muted mb-4">Struktur kartu AdminLTE: <code>card</code> &gt; <code>card-header</code> + <code>card-body</code> + <code>card-footer</code>.</p>

        <div class="row g-4">
            <div class="col-md-6">
                <p class="sg-sub">Card with Header Tools</p>
                <div class="card sg-inner-card">
                    <div class="card-header">
                        <h3 class="card-title">Judul Kartu</h3>
                        <div class="card-tools">
                            <a href="#" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg"></i> Tambah</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="mb-0">Konten di dalam <code>.card-body</code>. Tools di <code>.card-tools</code> di dalam <code>.card-header</code>.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <p class="sg-sub">Statistic Card</p>
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
            </div>
            <div class="col-md-6">
                <p class="sg-sub">Card with Table (p-0)</p>
                <div class="card sg-inner-card">
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
                <p class="sg-sub">Profile Card</p>
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

        <div class="sg-code mt-3"><code>&lt;div class="card"&gt;
    &lt;div class="card-header"&gt;
        &lt;h3 class="card-title"&gt;Judul Kartu&lt;/h3&gt;
        &lt;div class="card-tools"&gt;
            &lt;a href="#" class="btn btn-primary btn-sm"&gt;Tambah&lt;/a&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;div class="card-body"&gt;...&lt;/div&gt;
&lt;/div&gt;</code></div>
    </section>

    {{-- 7. SIDEBAR --}}
    <section class="sg-section" id="sidebar">
        <h2 class="sg-title">Sidebar</h2>
        <p class="text-muted mb-4">Sidebar AdminLTE untuk role Admin dan Guru.</p>

        <div class="row g-4">
            <div class="col-md-6">
                <p class="sg-sub">Admin</p>
                <div class="sidebar-preview">
                    <div class="brand">
                        <img src="{{ asset('images/sipinter-logo.png') }}" alt="SIPINTER" height="32"> SIPINTER
                    </div>
                    <div class="nav-item"><i class="bi bi-speedometer2"></i> Dashboard</div>
                    <div class="nav-item"><i class="bi bi-people"></i> Kelola User</div>
                    <div class="nav-item"><i class="bi bi-layers"></i> Kelola Jenjang</div>
                    <div class="nav-item"><i class="bi bi-tags"></i> Kelola Kategori</div>
                    <div class="nav-item"><i class="bi bi-book"></i> Kelola Materi</div>
                    <div class="nav-item"><i class="bi bi-pencil-square"></i> Kelola Quiz</div>
                    <div class="nav-item"><i class="bi bi-file-text"></i> Laporan</div>
                </div>
            </div>
            <div class="col-md-6">
                <p class="sg-sub">Guru</p>
                <div class="sidebar-preview">
                    <div class="brand">
                        <img src="{{ asset('images/sipinter-logo.png') }}" alt="SIPINTER" height="32"> SIPINTER
                    </div>
                    <div class="nav-item"><i class="bi bi-speedometer2"></i> Dashboard</div>
                    <div class="nav-item"><i class="bi bi-book"></i> Kelola Materi</div>
                    <div class="nav-item"><i class="bi bi-pencil-square"></i> Kelola Quiz</div>
                    <div class="nav-item"><i class="bi bi-bar-chart"></i> Hasil Siswa</div>
                </div>
            </div>
        </div>
    </section>

</main>

<footer class="bg-white border-top py-4 text-center text-muted small">
    &copy; {{ date('Y') }} SIPINTER — Admin Dashboard Design System
</footer>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"></script>
</body>
</html>
