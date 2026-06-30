<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Style Guide — SIPINTER</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css">
    <link rel="stylesheet" href="{{ asset('admin-lte/dist/css/adminlte.min.css') }}">
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
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
            font-family: 'Source Sans 3', sans-serif;
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

        .color-swatch {
            height: 70px;
            border-radius: 8px 8px 0 0;
        }

        .color-card {
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #dee2e6;
            background: #fff;
        }

        .color-body {
            padding: 10px 14px;
        }

        .color-body code {
            font-size: .75rem;
        }

        .sg-preview-wrap {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            overflow: hidden;
            background: #fff;
        }

        .sg-preview-body {
            padding: 20px;
        }

        .sg-inner-card {
            max-width: 600px;
        }

        .sidebar-preview {
            background: #343a40;
            color: #fff;
            width: 240px;
            border-radius: 8px;
            overflow: hidden;
        }

        .sidebar-preview .brand {
            padding: 16px;
            border-bottom: 1px solid rgba(255, 255, 255, .1);
            font-weight: 300;
            font-size: 1.25rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-preview .nav-item {
            padding: 10px 16px;
            color: rgba(255, 255, 255, .7);
            font-size: .9rem;
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 1px solid rgba(255, 255, 255, .05);
        }

        .sidebar-preview .nav-item i {
            width: 20px;
        }

        .sidebar-preview .nav-item:hover {
            background: rgba(255, 255, 255, .1);
            color: #fff;
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

        .preview-sidebar {
            background: #343a40;
            color: #fff;
            border-radius: 8px;
            overflow: hidden;
        }
        .preview-sidebar .brand {
            padding: 16px;
            border-bottom: 1px solid rgba(255,255,255,.1);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .preview-sidebar .nav-item {
            padding: 10px 16px;
            color: rgba(255,255,255,.7);
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: .9rem;
        }
        .preview-sidebar .nav-item:hover { background: rgba(255,255,255,.1); color: #fff; }
    </style>
</head>

<body>

    <header class="sg-header">
        <div class="container">
            <h1>SIPINTER Admin Dashboard Design System</h1>
            <p>Dashboard admin dan guru menggunakan Bootstrap 5, AdminLTE, DataTables.</p>
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
            <p class="text-muted mb-4">Warna yang digunakan di dashboard admin/guru. Didefinisikan di <code>admin.css</code> sebagai CSS custom properties.</p>
            @php
                $adminColors = [
                    ['#095890', 'Primary', 'Tombol utama, tautan, header (--si-primary)'],
                    ['#0A6AAE', 'Primary Hover', 'Hover tombol utama (--si-primary-hover)'],
                    ['#F5F9FC', 'Light Bg', 'Latar halaman (--si-light-bg)'],
                    ['#DDE7EF', 'Border', 'Garis pembatas (--si-border)'],
                    ['#1E293B', 'Text Dark', 'Judul, teks utama (--si-text-dark)'],
                    ['#64748B', 'Muted', 'Teks sekunder (--si-muted)'],
                    ['#17a2b8', 'Info', 'Tombol detail, aksi lihat (btn-info)'],
                    ['#28a745', 'Success', 'Status published, alert sukses'],
                    ['#ffc107', 'Warning', 'Tombol edit, badge peringatan'],
                    ['#dc3545', 'Danger', 'Tombol hapus, status error'],
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
            <p class="text-muted mb-4">Font: <strong>Source Sans 3</strong> via AdminLTE. Digunakan di seluruh dashboard.</p>
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
                    <hr class="my-3">
                    <p class="small mb-0">.small — Teks kecil tambahan</p>
                </div>
            </div>
        </section>

        {{-- 3. BUTTONS --}}
        <section class="sg-section" id="tombol">
            <h2 class="sg-title">Buttons</h2>
            <p class="text-muted mb-4">Semua variasi tombol Bootstrap/AdminLTE yang digunakan di dashboard.</p>

            <div class="sg-preview-wrap">
                <div class="sg-preview-body">
                    <p class="sg-sub">Solid Buttons (btn-sm)</p>
                    <div class="d-flex flex-wrap gap-2 mb-4">
                        <button class="btn btn-primary btn-sm"><i class="bi bi-plus-lg"></i> Tambah</button>
                        <button class="btn btn-info btn-sm"><i class="bi bi-eye"></i> Detail</button>
                        <button class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> Edit</button>
                        <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Hapus</button>
                        <button class="btn btn-success btn-sm"><i class="bi bi-file-earmark-pdf"></i> Export</button>
                        <button class="btn btn-secondary btn-sm"><i class="bi bi-arrow-left"></i> Kembali</button>
                    </div>

                    <p class="sg-sub">AI Feature Buttons</p>
                    <div class="d-flex flex-wrap gap-2 mb-4">
                        <button class="btn btn-info btn-sm"><i class="bi bi-magic"></i> Generate Ringkasan AI</button>
                        <button class="btn btn-info btn-sm"><i class="bi bi-magic"></i> Generate Quiz AI</button>
                        <button class="btn btn-success btn-sm"><i class="bi bi-plus-lg"></i> Tambah Soal</button>
                    </div>

                    <p class="sg-sub">Outline Buttons</p>
                    <div class="d-flex flex-wrap gap-2 mb-4">
                        <button class="btn btn-outline-primary btn-sm"><i class="bi bi-download"></i> Download</button>
                        <button class="btn btn-outline-secondary btn-sm">Batal</button>
                        <button class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i> Hapus</button>
                    </div>

                    <p class="sg-sub">Action Button Group (tabel)</p>
                    <div class="btn-group btn-group-sm mb-4">
                        <a href="#" class="btn btn-info" title="Lihat"><i class="bi bi-eye"></i></a>
                        <a href="#" class="btn btn-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                        <button class="btn btn-danger" title="Hapus"><i class="bi bi-trash"></i></button>
                    </div>

                    <p class="sg-sub">Form Buttons (default size)</p>
                    <div class="d-flex gap-2">
                        <button class="btn btn-primary">Simpan</button>
                        <button class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
                        <a href="#" class="btn btn-secondary">Batal</a>
                    </div>

                    <p class="sg-sub mt-3">Loading State</p>
                    <div class="d-flex gap-2 align-items-center">
                        <button class="btn btn-primary btn-sm" disabled>
                            <span class="spinner-border spinner-border-sm me-1"></span> Memproses...
                        </button>
                        <div class="spinner-border spinner-border-sm text-info" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>

                    <div class="sg-code mt-3"><code>&lt;button class="btn btn-primary btn-sm"&gt;&lt;i class="bi bi-plus-lg"&gt;&lt;/i&gt; Tambah&lt;/button&gt;
&lt;button class="btn btn-info btn-sm"&gt;&lt;i class="bi bi-magic"&gt;&lt;/i&gt; Generate Ringkasan AI&lt;/button&gt;
&lt;div class="btn-group btn-group-sm"&gt;
    &lt;a class="btn btn-info"&gt;&lt;i class="bi bi-eye"&gt;&lt;/i&gt;&lt;/a&gt;
    &lt;a class="btn btn-warning"&gt;&lt;i class="bi bi-pencil"&gt;&lt;/i&gt;&lt;/a&gt;
    &lt;button class="btn btn-danger"&gt;&lt;i class="bi bi-trash"&gt;&lt;/i&gt;&lt;/button&gt;
&lt;/div&gt;</code></div>
                </div>
            </div>
        </section>

        {{-- 4. ALERT & FLASH MESSAGES --}}
        <section class="sg-section" id="alert">
            <h2 class="sg-title">Alerts & Flash Messages</h2>
            <p class="text-muted mb-4">Notifikasi setelah redirect atau submit form.</p>

            <div class="sg-preview-wrap">
                <div class="sg-preview-body">
                    <p class="sg-sub">Session Flash — Success</p>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Materi berhasil dibuat.
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>

                    <p class="sg-sub">Session Flash — Error</p>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Kategori tidak dapat dihapus karena masih memiliki materi.
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>

                    <p class="sg-sub">Validation Errors</p>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <li>Judul harus diisi.</li>
                            <li>File PDF maksimal 20 MB.</li>
                        </ul>
                    </div>

                    <div class="sg-code"><code>@@if (session('success'))
    &lt;div class="alert alert-success alert-dismissible fade show"&gt;
        @{{ session('success') }}
        &lt;button type="button" class="btn-close" data-bs-dismiss="alert"&gt;
    &lt;/div&gt;
@@endif

@@if($errors->any())
    &lt;div class="alert alert-danger"&gt;
        &lt;ul class="mb-0"&gt;
            @@foreach($errors->all() as $error)
                &lt;li&gt;@{{ $error }}&lt;/li&gt;
            @@endforeach
        &lt;/ul&gt;
    &lt;/div&gt;
@@endif</code></div>
                </div>
            </div>
        </section>

        {{-- 5. FORMS --}}
        <section class="sg-section" id="form">
            <h2 class="sg-title">Forms</h2>
            <p class="text-muted mb-4">Form create/edit menggunakan kelas Bootstrap. Semua field mengikuti pola yang sama.</p>

            <div class="card sg-inner-card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Form Input</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Nama <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Masukkan nama">
                        <div class="invalid-feedback">Nama harus diisi.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" placeholder="nama@email.com">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Select <span class="text-danger">*</span></label>
                        <select class="form-select">
                            <option>-- Pilih --</option>
                            <option>SD</option>
                            <option>SMP</option>
                            <option>SMA</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Textarea</label>
                        <textarea class="form-control" rows="3" placeholder="Masukkan deskripsi"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">File Upload</label>
                        <input type="file" class="form-control" accept=".pdf,.docx,.pptx">
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah file.</small>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="hidden" name="is_published" value="0">
                        <input type="checkbox" class="form-check-input" id="published">
                        <label class="form-check-label" for="published">Published</label>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
                        <a href="#" class="btn btn-secondary">Batal</a>
                    </div>
                </div>
            </div>

            <div class="sg-code mt-3"><code>&lt;div class="mb-3"&gt;
    &lt;label class="form-label"&gt;Nama &lt;span class="text-danger"&gt;*&lt;/span&gt;&lt;/label&gt;
    &lt;input type="text" class="form-control @@error('nama') is-invalid @@enderror" value="@{{ old('nama') }}"&gt;
    @@error('nama')
        &lt;div class="invalid-feedback"&gt;@{{ $message }}&lt;/div&gt;
    @@enderror
&lt;/div&gt;</code></div>
        </section>

        {{-- 6. TOAST --}}
        <section class="sg-section" id="toast">
            <h2 class="sg-title">Toast</h2>
            <p class="text-muted mb-4">Digunakan untuk notifikasi AJAX (misal hasil generate AI).</p>

            <div class="sg-preview-wrap">
                <div class="sg-preview-body">
                    <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true" style="max-width:350px">
                        <div class="toast-header text-bg-success">
                            <strong class="me-auto">Berhasil</strong>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
                        </div>
                        <div class="toast-body">Ringkasan berhasil dibuat.</div>
                    </div>
                    <div class="toast show mt-2" role="alert" aria-live="assertive" aria-atomic="true" style="max-width:350px">
                        <div class="toast-header text-bg-danger">
                            <strong class="me-auto">Gagal</strong>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
                        </div>
                        <div class="toast-body">Gagal membuat quiz. Silakan coba lagi.</div>
                    </div>

                    <div class="sg-code mt-3"><code>&lt;div class="toast-container position-fixed bottom-0 end-0 p-3"&gt;
    &lt;div id="aiToast" class="toast" role="alert"&gt;
        &lt;div class="toast-header"&gt;
            &lt;strong class="me-auto"&gt;AI Generate&lt;/strong&gt;
            &lt;button type="button" class="btn-close" data-bs-dismiss="toast"&gt;
        &lt;/div&gt;
        &lt;div class="toast-body"&gt;&lt;/div&gt;
    &lt;/div&gt;
&lt;/div&gt;

&lt;script&gt;
function showToast(type, message) {
    const toast = document.getElementById('aiToast');
    const header = toast.querySelector('.toast-header strong');
    const body = toast.querySelector('.toast-body');
    if (type === 'success') {
        header.textContent = 'Berhasil';
        toast.classList.remove('text-bg-danger');
        toast.classList.add('text-bg-success');
    } else {
        header.textContent = 'Gagal';
        toast.classList.remove('text-bg-success');
        toast.classList.add('text-bg-danger');
    }
    body.textContent = message;
    new bootstrap.Toast(toast).show();
}
&lt;/script&gt;</code></div>
                </div>
            </div>
        </section>

        {{-- 7. MODAL --}}
        <section class="sg-section" id="modal">
            <h2 class="sg-title">Modal</h2>
            <p class="text-muted mb-4">Digunakan untuk prompt quiz AI dan konfirmasi hapus.</p>

            <div class="sg-preview-wrap">
                <div class="sg-preview-body">
                    <p class="sg-sub">Quiz Prompt Modal</p>
                    <div class="modal-dialog modal-lg" style="position:static;display:block;z-index:0;margin-bottom:1rem">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Generate Quiz dengan AI</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <p class="text-muted">Berikan instruksi tambahan kepada AI. Opsional.</p>
                                <div class="mb-3">
                                    <label class="form-label">Instruksi Tambahan</label>
                                    <textarea class="form-control" rows="3" placeholder="Contoh: Buat 10 soal pilihan ganda&#10;Fokus pada Bab 3&#10;Tingkat kesulitan sedang"></textarea>
                                </div>
                                <div class="d-flex flex-wrap gap-1">
                                    <span class="badge border text-secondary px-2 py-1" style="cursor:pointer;background:#f0f0f0;">✓ Buat 20 soal</span>
                                    <span class="badge border text-secondary px-2 py-1" style="cursor:pointer;background:#f0f0f0;">✓ Fokus pada Bab 4</span>
                                    <span class="badge border text-secondary px-2 py-1" style="cursor:pointer;background:#f0f0f0;">✓ Tingkat kesulitan sulit</span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-info"><i class="bi bi-magic"></i> Generate</button>
                            </div>
                        </div>
                    </div>

                    <p class="sg-sub mt-3">Delete Confirmation (inline form)</p>
                    <div class="d-flex gap-2">
                        <form onsubmit="return confirm('Yakin ingin menghapus?')">
                            <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Hapus</button>
                        </form>
                    </div>

                    <div class="sg-code mt-3"><code>&lt;div class="modal fade" id="quizPromptModal" tabindex="-1"&gt;
    &lt;div class="modal-dialog modal-lg"&gt;
        &lt;div class="modal-content"&gt;
            &lt;div class="modal-header"&gt;
                &lt;h5 class="modal-title"&gt;Generate Quiz dengan AI&lt;/h5&gt;
                &lt;button type="button" class="btn-close" data-bs-dismiss="modal"&gt;
            &lt;/div&gt;
            &lt;div class="modal-body"&gt;...&lt;/div&gt;
            &lt;div class="modal-footer"&gt;
                &lt;button type="button" class="btn btn-secondary"&gt;Cancel&lt;/button&gt;
                &lt;button type="button" class="btn btn-info"&gt;&lt;i class="bi bi-magic"&gt;&lt;/i&gt; Generate&lt;/button&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
&lt;/div&gt;</code></div>
                </div>
            </div>
        </section>

        {{-- 8. CARDS --}}
        <section class="sg-section" id="kartu">
            <h2 class="sg-title">Cards</h2>
            <p class="text-muted mb-4">Struktur kartu AdminLTE: <code>.card</code> &gt; <code>.card-header</code> + <code>.card-body</code> + <code>.card-footer</code>.</p>

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
                            <p class="mb-0">Konten di dalam <code>.card-body</code>.</p>
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
                                <thead>
                                    <tr><th>No</th><th>Nama</th><th>Status</th></tr>
                                </thead>
                                <tbody>
                                    <tr><td>1</td><td>Contoh Data</td><td><span class="badge bg-success">Aktif</span></td></tr>
                                    <tr><td>2</td><td>Contoh Lain</td><td><span class="badge bg-secondary">Draft</span></td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <p class="sg-sub">Outline Card (card-outline)</p>
                    <div class="card card-outline card-info sg-inner-card">
                        <div class="card-header">
                            <h5 class="card-title">Quiz Builder</h5>
                        </div>
                        <div class="card-body">
                            <p class="mb-0">Kartu dengan <code>.card-outline.card-info</code>.</p>
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
                <div class="col-md-6">
                    <p class="sg-sub">Card with Footer</p>
                    <div class="card sg-inner-card">
                        <div class="card-header"><h3 class="card-title">Card dengan Footer</h3></div>
                        <div class="card-body"><p>Konten utama</p></div>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <small class="text-muted">Info tambahan</small>
                            <nav>
                                <ul class="pagination pagination-sm mb-0">
                                    <li class="page-item disabled"><a class="page-link" href="#">&laquo;</a></li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                                </ul>
                            </nav>
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

        {{-- 9. TABLES --}}
        <section class="sg-section" id="tabel">
            <h2 class="sg-title">Tables</h2>
            <p class="text-muted mb-4">DataTables dengan AdminLTE styling. Wajib menggunakan <code>DataTable()</code> jQuery plugin.</p>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Data</h3>
                    <div class="card-tools">
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
                                <th>Tingkat</th>
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
                                        <button class="btn btn-danger" title="Hapus"><i class="bi bi-trash"></i></button>
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
                                        <button class="btn btn-danger" title="Hapus"><i class="bi bi-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <small class="text-muted">Menampilkan 1-2 dari 2 entri</small>
                    <ul class="pagination pagination-sm mb-0">
                        <li class="page-item disabled"><a class="page-link" href="#">&laquo;</a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                    </ul>
                </div>
            </div>

            <div class="sg-code mt-3"><code>// Init DataTable
&lt;script&gt;
$(document).ready(function() {
    $('#myTable').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        responsive: true,
        lengthChange: true,
        autoWidth: false,
        pageLength: 10,
        language: { url: '@{{ asset('vendor/datatables/i18n/id.json') }}' },
        columnDefs: [{ orderable: false, targets: -1 }]
    });
});
&lt;/script&gt;</code></div>
        </section>

        {{-- 10. BADGES --}}
        <section class="sg-section" id="badges">
            <h2 class="sg-title">Badges</h2>
            <p class="text-muted mb-4">Status, role, dan label di tabel serta kartu.</p>

            <div class="sg-preview-wrap">
                <div class="sg-preview-body">
                    <p class="sg-sub">Role Badges</p>
                    <div class="d-flex gap-2 flex-wrap mb-4">
                        <span class="badge bg-danger">Admin</span>
                        <span class="badge bg-primary">Guru</span>
                        <span class="badge bg-success">Siswa</span>
                    </div>

                    <p class="sg-sub">Status Badges</p>
                    <div class="d-flex gap-2 flex-wrap mb-4">
                        <span class="badge bg-success">Published</span>
                        <span class="badge bg-secondary">Draft</span>
                        <span class="badge bg-warning text-dark">Pending</span>
                        <span class="badge bg-info">Aktif</span>
                        <span class="badge bg-danger">Nonaktif</span>
                    </div>

                    <p class="sg-sub">Skor Badges</p>
                    <div class="d-flex gap-2 flex-wrap">
                        <span class="badge bg-success">85%</span>
                        <span class="badge bg-warning text-dark">60%</span>
                        <span class="badge bg-danger">40%</span>
                    </div>

                    <div class="sg-code"><code>&lt;span class="badge bg-success"&gt;Published&lt;/span&gt;
&lt;span class="badge bg-secondary"&gt;Draft&lt;/span&gt;</code></div>
                </div>
            </div>
        </section>

        {{-- 11. SIDEBAR --}}
        <section class="sg-section" id="sidebar">
            <h2 class="sg-title">Sidebar</h2>
            <p class="text-muted mb-4">Sidebar AdminLTE untuk role Admin dan Guru. Menggunakan ikon Bootstrap Icons.</p>

            <div class="row g-4">
                <div class="col-md-6">
                    <p class="sg-sub">Admin</p>
                    <div class="sidebar-preview">
                        <div class="brand">
                            <img src="{{ asset('images/sipinter-logo.png') }}" alt="SIPINTER" height="32">
                            SIPINTER
                        </div>
                        <div class="nav-item"><i class="bi bi-speedometer2"></i> Dashboard</div>
                        <div class="nav-item"><i class="bi bi-people"></i> Kelola User</div>
                        <div class="nav-item"><i class="bi bi-layers"></i> Kelola Tingkat Kesulitan</div>
                        <div class="nav-item"><i class="bi bi-tags"></i> Kelola Kategori Materi</div>
                        <div class="nav-item"><i class="bi bi-book"></i> Kelola Materi</div>
                        <div class="nav-item"><i class="bi bi-pencil-square"></i> Kelola Quiz</div>
                        <div class="nav-item"><i class="bi bi-file-text"></i> Laporan</div>
                    </div>
                    <div class="sg-code mt-2"><code>&lt;li class="nav-item"&gt;
    &lt;a href="#" class="nav-link"&gt;
        &lt;i class="nav-icon bi bi-book"&gt;&lt;/i&gt;
        &lt;p&gt;Kelola Materi&lt;/p&gt;
    &lt;/a&gt;
&lt;/li&gt;</code></div>
                </div>
                <div class="col-md-6">
                    <p class="sg-sub">Guru</p>
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
                </div>
            </div>
        </section>

        {{-- 12. QUIZ BUILDER & AI COMPONENTS --}}
        <section class="sg-section" id="ai">
            <h2 class="sg-title">AI Components & Quiz Builder</h2>
            <p class="text-muted mb-4">Komponen AI (Generate Ringkasan & Quiz) dan Quiz Builder interaktif pada halaman create/edit materi.</p>

            <div class="sg-preview-wrap">
                <div class="sg-preview-body">
                    <p class="sg-sub">Generate Ringkasan AI</p>
                    <div class="d-flex align-items-center gap-2 mb-4">
                        <button type="button" class="btn btn-info btn-sm">
                            <i class="bi bi-magic"></i> Generate Ringkasan AI
                        </button>
                        <div class="spinner-border spinner-border-sm text-info d-none" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <small class="text-muted">AI akan membuat ringkasan berdasarkan file PDF.</small>
                    </div>

                    <p class="sg-sub">Generate Quiz AI</p>
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <button type="button" class="btn btn-info btn-sm">
                            <i class="bi bi-magic"></i> Generate Quiz AI
                        </button>
                        <div class="spinner-border spinner-border-sm text-info d-none" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <small class="text-muted">AI akan membuat quiz berdasarkan file PDF.</small>
                    </div>

                    <p class="sg-sub">Quiz Builder Section</p>
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h5 class="card-title">Quiz Builder</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Judul Quiz</label>
                                    <input type="text" class="form-control" placeholder="Quiz Materi">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Durasi (menit)</label>
                                    <input type="number" class="form-control" placeholder="30" min="1">
                                </div>
                            </div>

                            {{-- Soal Item --}}
                            <div class="card card-outline card-secondary mt-2">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h6 class="mb-0">Soal 1</h6>
                                        <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Hapus</button>
                                    </div>
                                    <div class="mb-2">
                                        <textarea class="form-control" rows="2" placeholder="Pertanyaan">Apa ibu kota Indonesia?</textarea>
                                    </div>
                                    <div class="input-group mb-1">
                                        <div class="input-group-text">
                                            <input type="radio" name="jawaban_benar_0" checked>
                                        </div>
                                        <span class="input-group-text">A</span>
                                        <input type="text" class="form-control" value="Jakarta" placeholder="Pilihan A">
                                    </div>
                                    <div class="input-group mb-1">
                                        <div class="input-group-text">
                                            <input type="radio" name="jawaban_benar_0">
                                        </div>
                                        <span class="input-group-text">B</span>
                                        <input type="text" class="form-control" value="Surabaya" placeholder="Pilihan B">
                                    </div>
                                    <div class="input-group mb-1">
                                        <div class="input-group-text">
                                            <input type="radio" name="jawaban_benar_0">
                                        </div>
                                        <span class="input-group-text">C</span>
                                        <input type="text" class="form-control" value="Bandung" placeholder="Pilihan C">
                                    </div>
                                    <div class="input-group mb-1">
                                        <div class="input-group-text">
                                            <input type="radio" name="jawaban_benar_0">
                                        </div>
                                        <span class="input-group-text">D</span>
                                        <input type="text" class="form-control" value="Semarang" placeholder="Pilihan D">
                                    </div>
                                    <div class="mt-2">
                                        <small class="text-muted">Penjelasan:</small>
                                        <input type="text" class="form-control form-control-sm" placeholder="Penjelasan jawaban (opsional)">
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-sm btn-success mt-2">
                                <i class="bi bi-plus-lg"></i> Tambah Soal
                            </button>
                        </div>
                    </div>

                    <div class="sg-code mt-3"><code>&lt;!-- Generate Ringkasan --&gt;
&lt;button type="button" class="btn btn-info btn-sm" onclick="generateRingkasan()"&gt;
    &lt;i class="bi bi-magic"&gt;&lt;/i&gt; Generate Ringkasan AI
&lt;/button&gt;
&lt;div id="loadingRingkasan" class="spinner-border spinner-border-sm text-info d-none"&gt;
    &lt;span class="visually-hidden"&gt;Loading...&lt;/span&gt;
&lt;/div&gt;

&lt;!-- Generate Quiz --&gt;
&lt;div class="card card-outline card-info mt-3" id="quizSection"&gt;
    &lt;div class="card-header"&gt;
        &lt;h5 class="card-title"&gt;Quiz Builder&lt;/h5&gt;
    &lt;/div&gt;
    &lt;div class="card-body"&gt;
        &lt;div id="soalContainer"&gt;
            &lt;!-- Soal items rendered by JS --&gt;
        &lt;/div&gt;
        &lt;button type="button" class="btn btn-sm btn-success" onclick="tambahSoal()"&gt;
            &lt;i class="bi bi-plus-lg"&gt;&lt;/i&gt; Tambah Soal
        &lt;/button&gt;
    &lt;/div&gt;
&lt;/div&gt;</code></div>
                </div>
            </div>
        </section>

        {{-- 13. BREADCRUMB --}}
        <section class="sg-section" id="breadcrumb">
            <h2 class="sg-title">Breadcrumb</h2>
            <p class="text-muted mb-4">Navigasi hirarki halaman. Menggunakan kelas Bootstrap standar.</p>

            <div class="sg-preview-wrap">
                <div class="sg-preview-body">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="#">Materi</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Materi</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </section>

        {{-- 14. NAVBAR --}}
        <section class="sg-section" id="navbar">
            <h2 class="sg-title">Navbar</h2>
            <p class="text-muted mb-4">Top navbar AdminLTE dengan theme toggle dan user dropdown menu.</p>

            <div class="sg-preview-wrap">
                <div class="sg-preview-body">
                    <nav class="navbar navbar-expand bg-body border rounded mb-2">
                        <div class="container-fluid">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="#" role="button">
                                        <i class="bi bi-list"></i>
                                    </a>
                                </li>
                            </ul>
                            <ul class="navbar-nav ms-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        <i class="bi bi-sun-fill"></i>
                                    </a>
                                </li>
                                <li class="nav-item dropdown user-menu">
                                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                        <img src="{{ asset('images/default-user.jpg') }}" class="user-image rounded-circle shadow" style="width:30px;height:30px" alt="Avatar">
                                        <span class="d-none d-md-inline ms-1">Admin User</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </section>

    </main>

    <footer class="bg-white border-top py-4 text-center text-muted small">
        &copy; {{ date('Y') }} SIPINTER — Admin Dashboard Design System
    </footer>

</body>

</html>
