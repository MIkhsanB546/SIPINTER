<nav x-data="{ mobileOpen: false, userOpen: false }" class="bg-white shadow-sm sticky top-0 z-50"
    style="border-bottom: 1px solid #DDE7EF; min-height: 64px;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            <a href="{{ route('dashboard.index') }}" class="flex items-center gap-2 shrink-0">
                <img src="{{ asset('images/sipinter-logo.png') }}" alt="SIPINTER" class="h-10 w-auto">
                <div>
                    <span class="font-bold block text-base leading-tight" style="color: #095890;">SIPINTER</span>
                    <span class="hidden lg:block text-[0.6rem] leading-tight" style="color: #64748B;">Dashboard Guru</span>
                </div>
            </a>

            <div class="hidden lg:flex items-center gap-1 absolute left-1/2 -translate-x-1/2">
                <a href="{{ route('dashboard.index') }}"
                    class="px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-150
                   {{ request()->routeIs('dashboard.index') ? 'nav-link-active' : 'text-gray-700 nav-link-inactive' }}">
                    <i class="bi bi-grid-fill me-1"></i>Dashboard
                </a>
            </div>

            <div class="hidden lg:flex items-center">
                <div class="relative" @click.away="userOpen = false">
                    <button @click="userOpen = !userOpen"
                        class="flex items-center gap-2 px-3 py-2 rounded-lg transition-colors duration-150 nav-link-inactive">
                        @if (auth()->user()->avatar)
                            <img src="{{ auth()->user()->avatar }}" class="w-9 h-9 rounded-full border object-cover"
                                style="border-color: #DDE7EF;" alt="Avatar">
                        @else
                            <i class="bi bi-person-circle text-2xl" style="color: #64748B;"></i>
                        @endif
                        <span class="text-sm font-medium text-gray-700">{{ auth()->user()->name }}</span>
                        <i class="bi bi-chevron-down text-xs" style="color: #64748B;"
                            :class="{ 'rotate-180': userOpen }"></i>
                    </button>

                    <div x-show="userOpen" x-cloak x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border z-50 py-1"
                        style="border-color: #DDE7EF;">
                        <a href="{{ route('guru.profile') }}"
                            class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                            <i class="bi bi-person" style="color: #095890;"></i>
                            Profil Saya
                        </a>
                        <hr style="border-color: #DDE7EF;">
                        <form action="{{ route('logout') }}" method="post" class="m-0">
                            @csrf
                            <button type="submit"
                                class="flex items-center gap-3 w-full text-left px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                <i class="bi bi-box-arrow-right" style="color: #dc2626;"></i>
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <button @click="mobileOpen = !mobileOpen"
                class="lg:hidden p-2 rounded-lg transition-colors duration-150 hover:bg-gray-100"
                aria-label="Toggle navigation">
                <i class="bi text-2xl" style="color: #095890;"
                    :class="{ 'bi-x': mobileOpen, 'bi-list': !mobileOpen }"></i>
            </button>
        </div>

        <div x-show="mobileOpen" x-cloak x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2" class="lg:hidden border-t py-3 space-y-1"
            style="border-color: #DDE7EF;">
            <a href="{{ route('dashboard.index') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors duration-150
               {{ request()->routeIs('dashboard.index') ? 'nav-link-active' : 'text-gray-700 nav-link-inactive' }}">
                <i class="bi bi-grid-fill"></i>Dashboard
            </a>

            <hr style="border-color: #DDE7EF;">

            <div class="flex items-center gap-3 px-3 py-2.5">
                @if (auth()->user()->avatar)
                    <img src="{{ auth()->user()->avatar }}" class="w-8 h-8 rounded-full border object-cover"
                        style="border-color: #DDE7EF;" alt="Avatar">
                @else
                    <i class="bi bi-person-circle text-xl" style="color: #64748B;"></i>
                @endif
                <span class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</span>
            </div>

            <a href="{{ route('guru.profile') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-700 nav-link-inactive transition-colors duration-150">
                <i class="bi bi-person" style="color: #095890;"></i>Profil Saya
            </a>

            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit"
                    class="flex items-center gap-3 w-full text-left px-3 py-2.5 rounded-lg text-sm font-medium text-gray-700 nav-link-inactive transition-colors duration-150">
                    <i class="bi bi-box-arrow-right" style="color: #dc2626;"></i>Keluar
                </button>
            </form>
        </div>
    </div>
</nav>
