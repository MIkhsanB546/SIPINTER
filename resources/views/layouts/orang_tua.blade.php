{{-- Layout Halaman Orang Tua --}}
<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'SIPINTER') - Orang Tua</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/sipinter-icon.ico') }}">
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

        .text-si-primary {
            color: var(--si-primary) !important;
        }

        .bg-si-primary {
            background-color: var(--si-primary) !important;
        }

        .border-si-primary {
            border-color: var(--si-primary) !important;
        }

        .hover\:text-si-primary:hover {
            color: var(--si-primary) !important;
        }

        .hover\:bg-si-light:hover {
            background-color: #E8F0F6 !important;
        }

        .text-indigo-600,
        .hover\:text-indigo-800:hover,
        .hover\:text-indigo-600:hover,
        .group:hover .group-hover\:text-indigo-600 {
            color: var(--si-primary) !important;
        }

        .bg-indigo-600 {
            background-color: var(--si-primary) !important;
        }

        .hover\:bg-indigo-700:hover {
            background-color: var(--si-primary-hover) !important;
        }

        .bg-indigo-50 {
            background-color: #E8F0F6 !important;
        }

        .hover\:bg-indigo-100:hover {
            background-color: #D0E2ED !important;
        }

        .text-indigo-700 {
            color: var(--si-primary) !important;
        }

        .hover\:border-indigo-200:hover,
        .border-indigo-300 {
            border-color: #B8D4E4 !important;
        }

        .focus\:ring-indigo-500 {
            --tw-ring-color: var(--si-primary) !important;
        }

        .ring-indigo-500 {
            --tw-ring-color: var(--si-primary) !important;
        }

        .from-indigo-400 {
            --tw-gradient-from: #095890 !important;
        }

        .to-purple-500 {
            --tw-gradient-to: #0A6AAE !important;
        }

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

        .nav-link-inactive:hover {
            background-color: #F1F5F9 !important;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
    @stack('styles')
</head>

<body class="bg-gray-50 min-h-screen">
    @include('orang_tua.components.navbar')

    @if (session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-green-50 border-l-4 border-green-500 text-green-800 rounded-xl p-4 flex items-center gap-3 shadow-sm"
                role="alert">
                <i class="bi bi-check-circle-fill text-green-500 text-lg"></i>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-red-50 border-l-4 border-red-500 text-red-800 rounded-xl p-4 flex items-center gap-3 shadow-sm"
                role="alert">
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
            &copy; {{ date('Y') }} SIPINTER. Monitoring Orang Tua.
        </div>
    </footer>

    @stack('scripts')
</body>

</html>
