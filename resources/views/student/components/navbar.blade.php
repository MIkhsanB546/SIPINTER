<nav class="navbar navbar-expand-lg bg-white shadow-sm" style="border-bottom: 1px solid #DDE7EF; min-height: 64px;">
    <div class="container-fluid px-4">
        <a class="navbar-brand d-flex align-items-center gap-2 py-0" href="{{ route('siswa.dashboard') }}">
            <img src="{{ asset('images/sipinter-logo.png') }}" alt="SIPINTER" style="height:40px; width:auto;">
            <div>
                <span class="fw-bold d-block" style="color:#095890; font-size:1rem; line-height:1.2;">SIPINTER</span>
                <span class="d-none d-lg-block" style="color:#64748B; font-size:0.6rem; line-height:1.1;">Belajar
                    Interaktif dan Menyenangkan</span>
            </div>
        </a>

        <button class="navbar-toggler border-0" type="button" id="navbarToggler" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-menu" id="navbarMenu">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-1">
                <li class="nav-item">
                    <a class="nav-link rounded-2 px-3 {{ request()->routeIs('siswa.dashboard') ? 'active-si' : '' }}"
                        href="{{ route('siswa.dashboard') }}">
                        <i class="bi bi-grid-fill me-1"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rounded-2 px-3 {{ request()->routeIs('siswa.materi.*') ? 'active-si' : '' }}"
                        href="{{ route('siswa.materi.index') }}">
                        <i class="bi bi-book me-1"></i> Materi Saya
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rounded-2 px-3 {{ request()->routeIs('siswa.quiz.*') && !request()->routeIs('siswa.quiz.history') ? 'active-si' : '' }}"
                        href="{{ route('siswa.quiz.index') }}">
                        <i class="bi bi-pencil-square me-1"></i> Quiz Saya
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rounded-2 px-3 {{ request()->routeIs('siswa.quiz.history') ? 'active-si' : '' }}"
                        href="{{ route('siswa.quiz.history') }}">
                        <i class="bi bi-clock-history me-1"></i> Riwayat Quiz
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center gap-1 px-3 rounded-2" href="#"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle fs-5"></i>
                        <span class="d-none d-lg-inline">{{ auth()->user()->name }}</span>
                        <span class="d-lg-none">{{ auth()->user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow rounded-3 border-0 mt-2"
                        style="border:1px solid #DDE7EF !important;">
                        <li>
                            <a class="dropdown-item rounded-2 py-2" href="{{ route('siswa.profile') }}">
                                <i class="bi bi-person me-2"></i> Lihat Profil
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider" style="border-color:#DDE7EF;">
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="post" class="m-0">
                                @csrf
                                <button class="dropdown-item rounded-2 py-2" type="submit">
                                    <i class="bi bi-box-arrow-right me-2"></i> Keluar
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
    (function() {
        var toggler = document.getElementById('navbarToggler');
        var menu = document.getElementById('navbarMenu');
        if (toggler && menu) {
            toggler.addEventListener('click', function() {
                menu.classList.toggle('show');
            });
            var navLinks = menu.querySelectorAll('.nav-link');

            for (var i = 0; i < navLinks.length; i++) {

                navLinks[i].addEventListener('click', function() {

                    if (this.classList.contains('dropdown-toggle')) {
                        return;
                    }

                    if (window.innerWidth < 992) {
                        menu.classList.remove('show');
                    }

                });

            }
        }
    })();
</script>
