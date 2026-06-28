<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>@yield('title', 'SIPINTER')</title>

    <!--begin::Accessibility Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <!--end::Accessibility Meta Tags-->

    <!--begin::Primary Meta Tags-->
    {{-- <meta name="title" content="AdminLTE v4 | Dashboard" />
    <meta name="author" content="ColorlibHQ" />
    <meta name="description"
        content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS. Fully accessible with WCAG 2.1 AA compliance." />
    <meta name="keywords"
        content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard, accessible admin panel, WCAG compliant" /> --}}
    <!--end::Primary Meta Tags-->

    <!--begin::Accessibility Features-->
    <!-- Skip links will be dynamically added by accessibility.js -->
    <meta name="supported-color-schemes" content="light dark" />
    {{-- <link rel="preload" href="{{ asset('admin-lte/dist/css/adminlte.min.css') }}" as="style" /> --}}
    <!--end::Accessibility Features-->

    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" media="print"
        onload="this.media = 'all'" />
    <!--end::Fonts-->

    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
        crossorigin="anonymous" />
    <!--end::Third Party Plugin(OverlayScrollbars)-->

    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous" />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="{{ asset('admin-lte/dist/css/adminlte.min.css') }}" />
    <!--end::Required Plugin(AdminLTE)-->

    <style>
        :root {
            --si-primary: #095890;
            --si-primary-hover: #0A6AAE;
            --si-light-bg: #F5F9FC;
            --si-border: #DDE7EF;
            --si-text-dark: #1E293B;
            --si-muted: #64748B;
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

        .btn-outline-si-primary {
            color: var(--si-primary);
            border-color: var(--si-primary);
        }

        .btn-outline-si-primary:hover {
            color: #fff;
            background-color: var(--si-primary);
            border-color: var(--si-primary);
        }

        a.text-si-primary:hover {
            color: var(--si-primary-hover) !important;
        }

        .sidebar-brand-logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
    </style>

    <!--begin::Third Party Plugin(DataTables)-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.11/css/dataTables.bootstrap5.min.css"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css"
        crossorigin="anonymous" />
    <!--end::Third Party Plugin(DataTables)-->

    @stack('styles')
</head>
<!--end::Head-->
<!--begin::Body-->

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
        <!--begin::Header-->
        <nav class="app-header navbar navbar-expand bg-body">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Start Navbar Links-->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                            <i class="bi bi-list"></i>
                        </a>
                    </li>
                </ul>
                <!--end::Start Navbar Links-->

                <!--begin::End Navbar Links-->
                <ul class="navbar-nav ms-auto">

                    <!--begin::Color Mode Toggle (#6010)-->
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="bd-theme" aria-label="Toggle color scheme"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-sun-fill" data-lte-theme-icon="light"></i>
                            <i class="bi bi-moon-fill d-none" data-lte-theme-icon="dark"></i>
                            <i class="bi bi-circle-half d-none" data-lte-theme-icon="auto"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="bd-theme"
                            style="--bs-dropdown-min-width: 8rem">
                            <li>
                                <button type="button" class="dropdown-item d-flex align-items-center"
                                    data-bs-theme-value="light" aria-pressed="false">
                                    <i class="bi bi-sun-fill me-2"></i>
                                    Light
                                    <i class="bi bi-check-lg ms-auto d-none"></i>
                                </button>
                            </li>
                            <li>
                                <button type="button" class="dropdown-item d-flex align-items-center"
                                    data-bs-theme-value="dark" aria-pressed="false">
                                    <i class="bi bi-moon-fill me-2"></i>
                                    Dark
                                    <i class="bi bi-check-lg ms-auto d-none"></i>
                                </button>
                            </li>
                            <li>
                                <button type="button" class="dropdown-item d-flex align-items-center active"
                                    data-bs-theme-value="auto" aria-pressed="true">
                                    <i class="bi bi-circle-half me-2"></i>
                                    Auto
                                    <i class="bi bi-check-lg ms-auto d-none"></i>
                                </button>
                            </li>
                        </ul>
                    </li>
                    <!--end::Color Mode Toggle-->

                    <!--begin::User Menu Dropdown-->
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            @if (Auth::user()->avatar)
                                <img src="{{ Auth::user()->avatar }}" class="user-image rounded-circle shadow"
                                    alt="Avatar" />
                            @else
                                <img src="{{ asset('images/default-user.jpg') }}" class="user-image rounded-circle shadow"
                                    alt="Default Avatar" />
                            @endif
                            <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <!--begin::User Image-->
                            <li class="user-header text-bg-primary">
                                @if (Auth::user()->avatar)
                                    <img src="{{ Auth::user()->avatar }}" class="rounded-circle shadow"
                                        alt="Avatar" />
                                @else
                                    <img src="{{ asset('images/default-user.jpg') }}" class="rounded-circle shadow"
                                        alt="Default Avatar" />
                                @endif
                                <p>
                                    {{ Auth::user()->name }}
                                    <small>{{ Auth::user()->role }}</small>
                                </p>
                            </li>
                            <!--end::User Image-->
                            <!--begin::Menu Footer-->
                            <li class="user-footer">
                                <a href="{{ route('dashboard.profile') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-person me-1"></i> Profil
                                </a>
                            </li>
                            <li class="user-footer border-top" style="border-color: #DDE7EF !important;">
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger w-100">
                                        <i class="bi bi-box-arrow-right me-1"></i> Keluar
                                    </button>
                                </form>
                            </li>
                            <!--end::Menu Footer-->
                        </ul>
                    </li>
                    <!--end::User Menu Dropdown-->
                </ul>
                <!--end::End Navbar Links-->
            </div>
            <!--end::Container-->
        </nav>
        <!--end::Header-->
        <!--begin::Sidebar-->
        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
            <!--begin::Sidebar Brand-->
            <div class="sidebar-brand">
                <!--begin::Brand Link-->
                <a href="{{ route('dashboard.index') }}" class="brand-link sidebar-brand-logo">
                    <img src="{{ asset('images/sipinter-logo.png') }}" alt="SIPINTER" height="40">
                    <span class="brand-text fw-light">SIPINTER</span>
                </a>
                <!--end::Brand Link-->
            </div>
            <!--end::Sidebar Brand-->
            <!--begin::Sidebar Wrapper-->
            <div class="sidebar-wrapper">
                <nav class="mt-2">

                    <!--begin::Sidebar Menu-->
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation"
                        aria-label="Main navigation" data-accordion="false" id="navigation">
                        @php
                            $role = auth()->user()->role;
                        @endphp

                        @if ($role === 'admin')
                            <li class="nav-item">
                                <a href="{{ route('dashboard.index') }}" class="nav-link">
                                    <i class="nav-icon bi bi-speedometer2"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('dashboard.users.index') }}" class="nav-link">
                                    <i class="nav-icon bi bi-people"></i>
                                    <p>Kelola User</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('dashboard.tingkat-kesulitan.index') }}" class="nav-link">
                                    <i class="nav-icon bi bi-layers"></i>
                                    <p>Kelola Tingkat Kesulitan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('dashboard.kategori.index') }}" class="nav-link">
                                    <i class="nav-icon bi bi-tags"></i>
                                    <p>Kelola Kategori Materi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('dashboard.materi.index') }}" class="nav-link">
                                    <i class="nav-icon bi bi-book"></i>
                                    <p>Kelola Materi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('dashboard.quiz.index') }}" class="nav-link">
                                    <i class="nav-icon bi bi-pencil-square"></i>
                                    <p>Kelola Quiz</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('dashboard.laporan') }}" class="nav-link">
                                    <i class="nav-icon bi bi-file-text"></i>
                                    <p>Laporan</p>
                                </a>
                            </li>
                        @elseif ($role === 'guru')
                            <li class="nav-item">
                                <a href="{{ route('dashboard.index') }}" class="nav-link">
                                    <i class="nav-icon bi bi-speedometer2"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('dashboard.materi.index') }}" class="nav-link">
                                    <i class="nav-icon bi bi-book"></i>
                                    <p>Kelola Materi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('dashboard.quiz.index') }}" class="nav-link">
                                    <i class="nav-icon bi bi-pencil-square"></i>
                                    <p>Kelola Quiz</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('dashboard.hasil-siswa') }}" class="nav-link">
                                    <i class="nav-icon bi bi-bar-chart"></i>
                                    <p>Hasil Siswa</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                    <!--end::Sidebar Menu-->
                </nav>
            </div>
            <!--end::Sidebar Wrapper-->
        </aside>
        <!--end::Sidebar-->
        <!--begin::App Main-->
        <main class="app-main">
            <!--begin::App Content Header-->
            <div class="app-content-header">
                <!--begin::Container-->
                <div class="container-fluid">
                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">@yield('title', 'EduGrow')</h3>
                        </div>
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::App Content Header-->
            <!--begin::App Content-->
            <div class="app-content">
                {{-- Content yield --}}
                @yield('content')
                {{-- end::Content yield --}}
            </div>
            <!--end::App Content-->
        </main>
        <!--end::App Main-->
        <!--begin::Footer-->
        <footer class="app-footer">
            <!--begin::To the end-->
            <div class="float-end d-none d-sm-inline">Anything you want</div>
            <!--end::To the end-->
            <!--begin::Copyright-->
            &copy; 2026 SIPINTER
            <!--end::Copyright-->
        </footer>
        <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
        crossorigin="anonymous"></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous">
    </script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="{{ asset('admin-lte/dist/js/adminlte.min.js') }}"></script>
    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script>
        const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
        const Default = {
            scrollbarTheme: 'os-theme-light',
            scrollbarAutoHide: 'leave',
            scrollbarClickScroll: true,
        };
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);

            // Disable OverlayScrollbars on mobile devices to prevent touch interference
            const isMobile = window.innerWidth <= 992;

            if (
                sidebarWrapper &&
                OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined &&
                !isMobile
            ) {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
        });
    </script>
    <!--end::OverlayScrollbars Configure--><!--begin::Color Mode Toggle (#6010)-->
    <script>
        (() => {
            'use strict';

            const STORAGE_KEY = 'lte-theme';

            const getStoredTheme = () => localStorage.getItem(STORAGE_KEY);
            const setStoredTheme = (theme) => localStorage.setItem(STORAGE_KEY, theme);

            const prefersDark = () => globalThis.matchMedia('(prefers-color-scheme: dark)').matches;

            const getPreferredTheme = () => {
                const stored = getStoredTheme();
                if (stored) return stored;
                return prefersDark() ? 'dark' : 'light';
            };

            const setTheme = (theme) => {
                const resolved = theme === 'auto' ? (prefersDark() ? 'dark' : 'light') : theme;
                document.documentElement.setAttribute('data-bs-theme', resolved);
            };

            setTheme(getPreferredTheme());

            const showActiveTheme = (theme) => {
                // Highlight the active dropdown option
                document.querySelectorAll('[data-bs-theme-value]').forEach((el) => {
                    el.classList.remove('active');
                    el.setAttribute('aria-pressed', 'false');
                    const check = el.querySelector('.bi-check-lg');
                    if (check) check.classList.add('d-none');
                });
                const active = document.querySelector(`[data-bs-theme-value="${theme}"]`);
                if (active) {
                    active.classList.add('active');
                    active.setAttribute('aria-pressed', 'true');
                    const check = active.querySelector('.bi-check-lg');
                    if (check) check.classList.remove('d-none');
                }
                // Sync the topbar trigger icon
                document.querySelectorAll('[data-lte-theme-icon]').forEach((icon) => {
                    icon.classList.toggle('d-none', icon.dataset.lteThemeIcon !== theme);
                });
            };

            globalThis.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
                const stored = getStoredTheme();
                if (!stored || stored === 'auto') setTheme(getPreferredTheme());
            });

            document.addEventListener('DOMContentLoaded', () => {
                showActiveTheme(getPreferredTheme());
                document.querySelectorAll('[data-bs-theme-value]').forEach((toggle) => {
                    toggle.addEventListener('click', () => {
                        const theme = toggle.getAttribute('data-bs-theme-value');
                        setStoredTheme(theme);
                        setTheme(theme);
                        showActiveTheme(theme);
                    });
                });
            });
        })();
    </script>
    <!--end::Color Mode Toggle-->

    <!-- OPTIONAL SCRIPTS -->

    <!--begin::Third Party Plugin(DataTables)-->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.11/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.11/js/dataTables.bootstrap5.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js" crossorigin="anonymous">
    </script>
    <!--end::Third Party Plugin(DataTables)-->

    <!--end::Script-->

    @stack('scripts')
</body>
<!--end::Body-->

</html>
