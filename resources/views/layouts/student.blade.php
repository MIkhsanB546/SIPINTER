<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'SIPINTER') - Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous">
    @stack('styles')
</head>
<body class="bg-gray-50 min-h-screen">
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-8">
                    <a href="{{ route('siswa.dashboard') }}" class="text-2xl font-extrabold text-indigo-600 tracking-tight">
                        SIPINTER
                        <span class="block text-xs font-normal text-gray-400 tracking-normal">Belajar Interaktif dan Menyenangkan</span>
                    </a>
                    <div class="hidden md:flex items-center gap-1">
                        <a href="{{ route('siswa.dashboard') }}"
                            class="px-4 py-2 rounded-xl text-sm font-medium {{ request()->routeIs('siswa.dashboard') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }} transition-all duration-200">
                            <i class="bi bi-grid-fill me-1"></i> Dashboard
                        </a>
                        <a href="{{ route('siswa.materi.index') }}"
                            class="px-4 py-2 rounded-xl text-sm font-medium {{ request()->routeIs('siswa.materi.*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }} transition-all duration-200">
                            <i class="bi bi-book me-1"></i> Materi Saya
                        </a>
                        <a href="{{ route('siswa.quiz.index') }}"
                            class="px-4 py-2 rounded-xl text-sm font-medium {{ request()->routeIs('siswa.quiz.*') && !request()->routeIs('siswa.quiz.history') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }} transition-all duration-200">
                            <i class="bi bi-pencil-square me-1"></i> Quiz Saya
                        </a>
                        <a href="{{ route('siswa.quiz.history') }}"
                            class="px-4 py-2 rounded-xl text-sm font-medium {{ request()->routeIs('siswa.quiz.history') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }} transition-all duration-200">
                            <i class="bi bi-clock-history me-1"></i> Riwayat Quiz
                        </a>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('siswa.profile') }}"
                        class="px-4 py-2 rounded-xl text-sm font-medium {{ request()->routeIs('siswa.profile') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }} transition-all duration-200">
                        <i class="bi bi-person me-1"></i>
                        <span class="hidden sm:inline">{{ auth()->user()->name }}</span>
                    </a>
                    <form action="{{ route('logout') }}" method="post" class="m-0">
                        @csrf
                        <button type="submit" class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-medium text-red-600 hover:bg-red-50 transition-all duration-200">
                            <i class="bi bi-box-arrow-right me-1"></i>
                            <span class="hidden sm:inline">Keluar</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    @if (session('success'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <div class="bg-green-50 border-l-4 border-green-500 text-green-800 rounded-xl p-4 flex items-center gap-3 shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill text-green-500 text-lg"></i>
            <span>{{ session('success') }}</span>
        </div>
    </div>
    @endif

    @if (session('error'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <div class="bg-red-50 border-l-4 border-red-500 text-red-800 rounded-xl p-4 flex items-center gap-3 shadow-sm" role="alert">
            <i class="bi bi-exclamation-circle-fill text-red-500 text-lg"></i>
            <span>{{ session('error') }}</span>
        </div>
    </div>
    @endif

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        @yield('content')
    </main>

    <footer class="bg-white border-t border-gray-200 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 text-center text-sm text-gray-400">
            &copy; {{ date('Y') }} SIPINTER. Semua Hak Dilindungi.
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
