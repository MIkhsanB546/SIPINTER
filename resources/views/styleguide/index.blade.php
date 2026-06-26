<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPINTER Design System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --si-primary: #095890;
            --si-primary-hover: #0A6AAE;
            --si-secondary-text: #64748B;
            --si-bg: #F5F9FC;
            --si-border: #DDE7EF;
            --si-success: #22C55E;
            --si-warning: #F59E0B;
            --si-danger: #EF4444;
        }

        * { scroll-margin-top: 80px; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--si-bg);
            color: #1E293B;
        }

        .styleguide-header {
            background: linear-gradient(135deg, var(--si-primary) 0%, #0A6AAE 100%);
            color: #fff;
            padding: 60px 0 40px;
        }
        .styleguide-header h1 { font-size: 2.5rem; font-weight: 800; }
        .styleguide-header p { font-size: 1.1rem; opacity: .85; }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--si-primary);
            margin-bottom: 1.5rem;
            padding-bottom: .5rem;
            border-bottom: 3px solid var(--si-primary);
        }

        .section { padding: 40px 0; }
        .section:nth-child(even) { background: #fff; }

        .color-card {
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid var(--si-border);
            background: #fff;
            transition: transform .2s;
        }
        .color-card:hover { transform: translateY(-4px); }
        .color-swatch { height: 100px; }
        .color-body { padding: 12px 16px; }
        .color-body code { font-size: .8rem; }

        .typo-example { padding: 12px 0; border-bottom: 1px solid var(--si-border); }
        .typo-example:last-child { border-bottom: none; }

        .btn-demo { margin: 4px; }

        .student-card {
            border-radius: 16px;
            border: none;
            box-shadow: 0 4px 20px rgba(0,0,0,.08);
            overflow: hidden;
        }
        .student-card .card-header {
            background: linear-gradient(135deg, var(--si-primary), var(--si-primary-hover));
            color: #fff;
            font-weight: 600;
            border: none;
            padding: 16px 20px;
        }
        .student-card .progress { height: 8px; border-radius: 4px; }

        .admin-card {
            border-radius: .25rem;
            border: 1px solid var(--si-border);
        }
        .admin-card .card-header {
            background: #fff;
            border-bottom: 1px solid var(--si-border);
            padding: 12px 20px;
        }
        .admin-card .card-footer {
            background: #fff;
            border-top: 1px solid var(--si-border);
            padding: 12px 20px;
        }

        .nav-preview {
            background: #fff;
            border-bottom: 1px solid var(--si-border);
            padding: 12px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .nav-preview .logo { font-weight: 800; color: var(--si-primary); font-size: 1.2rem; }
        .nav-preview .menu { display: flex; gap: 24px; }
        .nav-preview .menu a { color: var(--si-secondary-text); text-decoration: none; font-size: .9rem; font-weight: 500; }
        .nav-preview .menu a:hover { color: var(--si-primary); }

        .sidebar-preview {
            background: #343a40;
            color: #fff;
            width: 200px;
            border-radius: 8px;
            overflow: hidden;
        }
        .sidebar-preview .brand {
            padding: 16px;
            font-weight: 700;
            font-size: 1.1rem;
            border-bottom: 1px solid rgba(255,255,255,.1);
        }
        .sidebar-preview .menu-item {
            padding: 10px 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: .85rem;
            color: rgba(255,255,255,.7);
            border-bottom: 1px solid rgba(255,255,255,.05);
        }
        .sidebar-preview .menu-item i { width: 18px; }
        .sidebar-preview .menu-item:hover { background: rgba(255,255,255,.08); color: #fff; }

        .table-demo .pagination { margin-bottom: 0; }

        .floating-nav {
            position: fixed;
            right: 24px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 1000;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,.1);
            padding: 12px 0;
            width: 44px;
        }
        .floating-nav a {
            display: block;
            text-align: center;
            padding: 6px 0;
            color: var(--si-secondary-text);
            font-size: .65rem;
            text-decoration: none;
            transition: color .2s;
            writing-mode: vertical-rl;
            text-orientation: mixed;
            letter-spacing: 1px;
        }
        .floating-nav a:hover { color: var(--si-primary); }

        .form-demo .form-control,
        .form-demo .form-select { max-width: 400px; }

        .table thead th { background: #f8f9fa; border-bottom: 2px solid var(--si-border); font-weight: 600; }

        .inspire-card {
            border-radius: 16px;
            border: 1px solid var(--si-border);
            padding: 24px;
            text-align: center;
            background: #fff;
        }
        .inspire-card i { font-size: 2.5rem; color: var(--si-primary); margin-bottom: 12px; }
        .inspire-card h5 { font-weight: 700; }

        .btn-group-demo .btn { margin: 2px; }

        @media (max-width: 1400px) {
            .floating-nav { display: none; }
        }
    </style>
</head>
<body>

    <!-- ============================================================ -->
    <!-- HEADER -->
    <!-- ============================================================ -->
    <header class="styleguide-header">
        <div class="container">
            <h1>SIPINTER Design System</h1>
            <p>Frontend Student &amp; Admin Dashboard UI Guidelines</p>
            <span class="badge bg-white text-dark mt-2">v1.0</span>
        </div>
    </header>

    <div class="d-flex">
        <main class="flex-grow-1" style="min-width:0">

            <!-- ============================================================ -->
            <!-- SECTION 1 — COLOR PALETTE -->
            <!-- ============================================================ -->
            <section class="section" id="colors">
                <div class="container">
                    <h2 class="section-title">1. Color Palette</h2>
                    <div class="row g-3">
                        @php
                            $colors = [
                                ['#095890', 'Primary', 'Primary buttons, links, headings'],
                                ['#0A6AAE', 'Primary Hover', 'Hover states for primary elements'],
                                ['#64748B', 'Secondary Text', 'Body text, captions, muted text'],
                                ['#F5F9FC', 'Background', 'Page background, card backgrounds'],
                                ['#DDE7EF', 'Border', 'Card borders, dividers, inputs'],
                                ['#22C55E', 'Success', 'Success states, correct answers'],
                                ['#F59E0B', 'Warning', 'Warning states, medium scores'],
                                ['#EF4444', 'Danger', 'Error states, delete actions'],
                            ];
                        @endphp
                        @foreach ($colors as $c)
                            <div class="col-6 col-md-4 col-lg-3">
                                <div class="color-card">
                                    <div class="color-swatch" style="background:{{ $c[0] }}"></div>
                                    <div class="color-body">
                                        <strong>{{ $c[1] }}</strong><br>
                                        <code>{{ $c[0] }}</code>
                                        <p class="text-muted small mb-0 mt-1">{{ $c[2] }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <!-- ============================================================ -->
            <!-- SECTION 2 — TYPOGRAPHY -->
            <!-- ============================================================ -->
            <section class="section" id="typography">
                <div class="container">
                    <h2 class="section-title">2. Typography</h2>
                    <p class="text-muted mb-4">Using <strong>Inter</strong> font family across all interfaces.</p>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="typo-example">
                                <h1 style="font-size:36px;font-weight:800">Heading 1 — 36px Bold</h1>
                                <span class="text-muted small">Font-size: 36px &middot; Weight: 800 &middot; Line-height: 1.2</span>
                            </div>
                            <div class="typo-example">
                                <h2 style="font-size:28px;font-weight:600">Heading 2 — 28px SemiBold</h2>
                                <span class="text-muted small">Font-size: 28px &middot; Weight: 600 &middot; Line-height: 1.3</span>
                            </div>
                            <div class="typo-example">
                                <h3 style="font-size:20px;font-weight:600">Heading 3 — 20px SemiBold</h3>
                                <span class="text-muted small">Font-size: 20px &middot; Weight: 600 &middot; Line-height: 1.4</span>
                            </div>
                            <div class="typo-example">
                                <p style="font-size:16px">Body text — 16px Regular</p>
                                <span class="text-muted small">Font-size: 16px &middot; Weight: 400 &middot; Line-height: 1.5</span>
                            </div>
                            <div class="typo-example">
                                <p style="font-size:14px;color:var(--si-secondary-text)">Caption — 14px</p>
                                <span class="text-muted small">Font-size: 14px &middot; Color: #64748B</span>
                            </div>
                            <div class="typo-example">
                                <p style="font-size:12px;color:var(--si-secondary-text)">Small text — 12px</p>
                                <span class="text-muted small">Font-size: 12px &middot; Color: #64748B</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ============================================================ -->
            <!-- SECTION 3 — BUTTONS -->
            <!-- ============================================================ -->
            <section class="section" id="buttons">
                <div class="container">
                    <h2 class="section-title">3. Buttons</h2>

                    <h5 class="fw-bold mb-3">Student Frontend</h5>
                    <div class="btn-group-demo mb-4">
                        <button class="btn btn-demo" style="background:var(--si-primary);color:#fff;border:none;border-radius:12px;padding:10px 24px;font-weight:600">Primary</button>
                        <button class="btn btn-demo" style="background:#f1f5f9;color:var(--si-secondary-text);border:none;border-radius:12px;padding:10px 24px;font-weight:600">Secondary</button>
                        <button class="btn btn-demo" style="background:transparent;color:var(--si-primary);border:2px solid var(--si-primary);border-radius:12px;padding:8px 22px;font-weight:600">Outline</button>
                        <button class="btn btn-demo" style="background:var(--si-success);color:#fff;border:none;border-radius:12px;padding:10px 24px;font-weight:600">Success</button>
                        <button class="btn btn-demo" style="background:var(--si-danger);color:#fff;border:none;border-radius:12px;padding:10px 24px;font-weight:600">Danger</button>
                    </div>

                    <h5 class="fw-bold mb-3">Admin Dashboard</h5>
                    <div class="btn-group-demo">
                        <button class="btn btn-primary btn-sm btn-demo">btn-primary</button>
                        <button class="btn btn-warning btn-sm btn-demo">btn-warning</button>
                        <button class="btn btn-danger btn-sm btn-demo">btn-danger</button>
                        <button class="btn btn-info btn-sm btn-demo">btn-info</button>
                        <button class="btn btn-secondary btn-sm btn-demo">btn-secondary</button>
                    </div>
                </div>
            </section>

            <!-- ============================================================ -->
            <!-- SECTION 4 — FORMS -->
            <!-- ============================================================ -->
            <section class="section" id="forms">
                <div class="container">
                    <h2 class="section-title">4. Forms</h2>
                    <div class="row g-4">
                        <div class="col-md-6 form-demo">
                            <div class="mb-3">
                                <label class="form-label">Text Input</label>
                                <input type="text" class="form-control" placeholder="Placeholder text">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password Input</label>
                                <input type="password" class="form-control" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Select</label>
                                <select class="form-select">
                                    <option>Option 1</option>
                                    <option>Option 2</option>
                                    <option>Option 3</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Textarea</label>
                                <textarea class="form-control" rows="3" placeholder="Enter text..."></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 form-demo">
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="chk1" checked>
                                    <label class="form-check-label" for="chk1">Checkbox</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="chk2">
                                    <label class="form-check-label" for="chk2">Unchecked</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="radio" id="rad1" checked>
                                    <label class="form-check-label" for="rad1">Radio 1</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="radio" id="rad2">
                                    <label class="form-check-label" for="rad2">Radio 2</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Validation State</label>
                                <input type="text" class="form-control is-valid" value="Valid input">
                                <input type="text" class="form-control is-invalid mt-2" value="Invalid input">
                                <div class="invalid-feedback d-block">Error message here.</div>
                            </div>
                            <div>
                                <label class="form-label">Disabled State</label>
                                <input type="text" class="form-control" value="Disabled input" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ============================================================ -->
            <!-- SECTION 5 — CARDS -->
            <!-- ============================================================ -->
            <section class="section" id="cards">
                <div class="container">
                    <h2 class="section-title">5. Cards</h2>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <h5 class="fw-bold mb-3">Student Card</h5>
                            <div class="student-card card">
                                <div class="card-header">Materi Pembelajaran</div>
                                <div class="card-body">
                                    <h6 class="fw-bold">Matematika Dasar</h6>
                                    <p class="text-muted small">Progress pembelajaran</p>
                                    <div class="progress mb-2">
                                        <div class="progress-bar bg-success" style="width:65%"></div>
                                    </div>
                                    <p class="small text-muted mb-0">65% selesai</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5 class="fw-bold mb-3">AdminLTE Card</h5>
                            <div class="admin-card card">
                                <div class="card-header"><strong>Card Header</strong></div>
                                <div class="card-body">
                                    <p>This is the card body with main content.</p>
                                </div>
                                <div class="card-footer text-muted small">Card Footer</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ============================================================ -->
            <!-- SECTION 6 — TABLES -->
            <!-- ============================================================ -->
            <section class="section" id="tables">
                <div class="container">
                    <h2 class="section-title">6. Tables</h2>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <h5 class="fw-bold mb-3">Student Table</h5>
                            <div class="student-card card">
                                <div class="p-3">
                                    <table class="table table-borderless mb-0 align-middle">
                                        <thead>
                                            <tr>
                                                <th>Materi</th>
                                                <th>Progress</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr><td>Matematika</td><td><span class="badge bg-success">80%</span></td></tr>
                                            <tr><td>Bahasa Indonesia</td><td><span class="badge bg-warning">60%</span></td></tr>
                                            <tr><td>IPA</td><td><span class="badge bg-danger">30%</span></td></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5 class="fw-bold mb-3">Admin DataTable Style</h5>
                            <div class="admin-card card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <strong>Daftar User</strong>
                                    <div class="card-tools">
                                        <div class="input-group input-group-sm" style="width:200px">
                                            <input type="text" class="form-control" placeholder="Search...">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <table class="table table-bordered table-hover mb-0 align-middle">
                                        <thead>
                                            <tr>
                                                <th>No <i class="bi bi-arrow-up-short text-muted"></i></th>
                                                <th>Nama <i class="bi bi-arrow-down-short text-muted"></i></th>
                                                <th>Role</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Ikhsan</td>
                                                <td><span class="badge bg-primary">Admin</span></td>
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <button class="btn btn-warning"><i class="bi bi-pencil"></i></button>
                                                        <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Budi</td>
                                                <td><span class="badge bg-success">Guru</span></td>
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <button class="btn btn-warning"><i class="bi bi-pencil"></i></button>
                                                        <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Siti</td>
                                                <td><span class="badge bg-info">Siswa</span></td>
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <button class="btn btn-warning"><i class="bi bi-pencil"></i></button>
                                                        <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer d-flex justify-content-between align-items-center">
                                    <small class="text-muted">Showing 1-3 of 3</small>
                                    <nav>
                                        <ul class="pagination pagination-sm mb-0">
                                            <li class="page-item disabled"><a class="page-link" href="#">&laquo;</a></li>
                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item disabled"><a class="page-link" href="#">&raquo;</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ============================================================ -->
            <!-- SECTION 7 — NAVIGATION -->
            <!-- ============================================================ -->
            <section class="section" id="navigation">
                <div class="container">
                    <h2 class="section-title">7. Navigation</h2>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <h5 class="fw-bold mb-3">Student Navbar</h5>
                            <div class="nav-preview rounded-top">
                                <div class="logo">
                                    <i class="bi bi-grid-fill me-1"></i>SIPINTER
                                </div>
                                <div class="menu">
                                    <a href="#">Materi</a>
                                    <a href="#">Quiz</a>
                                    <a href="#">Riwayat</a>
                                </div>
                                <div>
                                    <i class="bi bi-person-circle fs-4" style="color:var(--si-secondary-text)"></i>
                                </div>
                            </div>
                            <div class="bg-white p-3 rounded-bottom border-start border-end border-bottom small text-muted">
                                <i class="bi bi-search me-1"></i> Search bar appears here
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5 class="fw-bold mb-3">Admin Sidebar</h5>
                            <div class="sidebar-preview">
                                <div class="brand">SIPINTER</div>
                                <div class="menu-item"><i class="bi bi-speedometer2"></i> Dashboard</div>
                                <div class="menu-item"><i class="bi bi-people"></i> Users</div>
                                <div class="menu-item"><i class="bi bi-layers"></i> Jenjang</div>
                                <div class="menu-item"><i class="bi bi-tags"></i> Kategori</div>
                                <div class="menu-item"><i class="bi bi-book"></i> Materi</div>
                                <div class="menu-item"><i class="bi bi-pencil-square"></i> Quiz</div>
                                <div class="menu-item"><i class="bi bi-file-text"></i> Laporan</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ============================================================ -->
            <!-- SECTION 8 — ICONS -->
            <!-- ============================================================ -->
            <section class="section" id="icons">
                <div class="container">
                    <h2 class="section-title">8. Icons</h2>
                    <p class="text-muted mb-4">All icons use <strong>Bootstrap Icons</strong> library.</p>
                    <div class="row g-3">
                        @php
                            $icons = [
                                ['bi-grid-fill', 'Dashboard / Home'],
                                ['bi-book', 'Materi / Learning'],
                                ['bi-pencil-square', 'Quiz / Test'],
                                ['bi-clock-history', 'Riwayat / History'],
                                ['bi-person-circle', 'Profile / User'],
                                ['bi-star-fill', 'Star / Rating'],
                                ['bi-trophy', 'Achievement'],
                                ['bi-search', 'Search / Filter'],
                                ['bi-gear', 'Settings'],
                                ['bi-box-arrow-right', 'Logout'],
                            ];
                        @endphp
                        @foreach ($icons as $ic)
                            <div class="col-6 col-md-4 col-lg text-center">
                                <div class="border rounded p-3 bg-white">
                                    <i class="{{ $ic[0] }} fs-2" style="color:var(--si-primary)"></i>
                                    <div class="mt-2"><code>{{ $ic[0] }}</code></div>
                                    <small class="text-muted">{{ $ic[1] }}</small>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <!-- ============================================================ -->
            <!-- SECTION 9 — RESPONSIVE BREAKPOINTS -->
            <!-- ============================================================ -->
            <section class="section" id="responsive">
                <div class="container">
                    <h2 class="section-title">9. Responsive Breakpoints</h2>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Breakpoint</th>
                                    <th>Class</th>
                                    <th>Dimensions</th>
                                    <th>Device</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td>xs</td><td><code>.col-</code></td><td>&lt;576px</td><td>Portrait phones</td></tr>
                                <tr><td>sm</td><td><code>.col-sm-</code></td><td>&ge;576px</td><td>Landscape phones</td></tr>
                                <tr><td>md</td><td><code>.col-md-</code></td><td>&ge;768px</td><td>Tablets</td></tr>
                                <tr><td>lg</td><td><code>.col-lg-</code></td><td>&ge;992px</td><td>Desktops</td></tr>
                                <tr><td>xl</td><td><code>.col-xl-</code></td><td>&ge;1200px</td><td>Large desktops</td></tr>
                                <tr><td>xxl</td><td><code>.col-xxl-</code></td><td>&ge;1400px</td><td>Extra large desktops</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <!-- ============================================================ -->
            <!-- SECTION 10 — APPLICATION INSPIRATIONS -->
            <!-- ============================================================ -->
            <section class="section" id="inspirations">
                <div class="container">
                    <h2 class="section-title">10. Application Inspirations</h2>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="inspire-card">
                                <i class="bi bi-emoji-smile"></i>
                                <h5>Student Frontend</h5>
                                <p class="text-muted small mb-0">Inspired by Duolingo &amp; Codecademy</p>
                                <div class="mt-2">
                                    <span class="badge bg-primary me-1">Duolingo</span>
                                    <span class="badge bg-success">Codecademy</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="inspire-card">
                                <i class="bi bi-layout-sidebar"></i>
                                <h5>Admin Dashboard</h5>
                                <p class="text-muted small mb-0">Inspired by AdminLTE 3</p>
                                <span class="badge bg-secondary mt-2">AdminLTE 3</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <footer class="bg-white border-top py-4 text-center text-muted small">
                &copy; {{ date('Y') }} SIPINTER Design System
            </footer>

        </main>
    </div>

    <!-- Floating Sidebar Navigation -->
    <nav class="floating-nav">
        <a href="#colors" title="Colors">Colors</a>
        <a href="#typography" title="Typography">Typography</a>
        <a href="#buttons" title="Buttons">Buttons</a>
        <a href="#forms" title="Forms">Forms</a>
        <a href="#cards" title="Cards">Cards</a>
        <a href="#tables" title="Tables">Tables</a>
        <a href="#navigation" title="Navigation">Navigation</a>
        <a href="#icons" title="Icons">Icons</a>
        <a href="#responsive" title="Responsive">Responsive</a>
        <a href="#inspirations" title="Inspirations">Inspire</a>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
