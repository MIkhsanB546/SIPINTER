@extends('layouts.student')

@section('title', 'Dashboard')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-extrabold text-gray-900">Halo, {{ auth()->user()->name }}! 👋</h1>
    <p class="text-gray-500 mt-1 text-lg">Lanjutkan perjalanan belajarmu hari ini!</p>
</div>

{{-- Progress Summary --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition-all duration-300 hover:-translate-y-1">
        <div class="flex items-center justify-between mb-3">
            <div class="text-3xl font-black text-indigo-600">{{ $overallProgress }}%</div>
            <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center">
                <i class="bi bi-graph-up text-indigo-500 text-lg"></i>
            </div>
        </div>
        <div class="w-full bg-gray-100 rounded-full h-2.5">
            <div class="bg-indigo-500 h-2.5 rounded-full transition-all duration-500" style="width: {{ $overallProgress }}%"></div>
        </div>
        <p class="text-xs text-gray-500 mt-2 font-medium">Progress Keseluruhan</p>
        <p class="text-xs text-gray-400 mt-0.5">{{ $totalCompleted }} dari {{ $totalSaved }} Materi Selesai</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition-all duration-300 hover:-translate-y-1">
        <div class="flex items-center justify-between mb-3">
            <div class="text-3xl font-black text-emerald-600">{{ $totalCompleted }}</div>
            <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center">
                <i class="bi bi-check-circle text-emerald-500 text-lg"></i>
            </div>
        </div>
        <p class="text-xs text-gray-500 font-medium mt-1">Materi Selesai</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition-all duration-300 hover:-translate-y-1">
        <div class="flex items-center justify-between mb-3">
            <div class="text-3xl font-black text-amber-500">{{ $totalLearning }}</div>
            <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center">
                <i class="bi bi-book text-amber-500 text-lg"></i>
            </div>
        </div>
        <p class="text-xs text-gray-500 font-medium mt-1">Sedang Dipelajari</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition-all duration-300 hover:-translate-y-1">
        <div class="flex items-center justify-between mb-3">
            <div class="text-3xl font-black text-sky-500">{{ $totalSaved }}</div>
            <div class="w-10 h-10 rounded-xl bg-sky-50 flex items-center justify-center">
                <i class="bi bi-bookmark text-sky-500 text-lg"></i>
            </div>
        </div>
        <p class="text-xs text-gray-500 font-medium mt-1">Materi Tersimpan</p>
    </div>
</div>

{{-- Continue Learning --}}
@if ($continueLearning->isNotEmpty())
<div class="mb-8">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-bold text-gray-900">Lanjutkan Belajar</h2>
        <a href="{{ route('siswa.my-learning') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800 transition-colors">
            Lihat Semua <i class="bi bi-arrow-right"></i>
        </a>
    </div>
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($continueLearning as $materi)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300 hover:-translate-y-1 group">
            <div class="h-36 {{ $colors[$loop->index % count($colors)] ?? 'bg-gradient-to-br from-indigo-400 to-purple-500' }} flex items-center justify-center">
                @if ($materi->thumbnail)
                <img src="{{ asset('storage/' . $materi->thumbnail) }}" alt="{{ $materi->judul }}" class="w-full h-full object-cover">
                @else
                <i class="bi bi-journal-bookmark-fill text-4xl text-white/70"></i>
                @endif
            </div>
            <div class="p-5">
                <h3 class="font-bold text-gray-900 mb-1 group-hover:text-indigo-600 transition-colors">{{ $materi->judul }}</h3>
                <p class="text-xs text-gray-500 mb-2">
                    <i class="bi bi-person me-1"></i>{{ $materi->guru->name ?? '-' }}
                    <span class="mx-1">·</span>
                    <i class="bi bi-bar-chart me-1"></i>{{ $materi->tingkatKesulitan->nama_tingkat ?? '-' }}
                </p>
                <div class="mb-3">
                    <div class="flex items-center justify-between text-xs text-gray-500 mb-1">
                        <span>Progress</span>
                        <span class="font-semibold text-indigo-600">{{ $materi->pivot->progress }}%</span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-2">
                        <div class="bg-indigo-500 h-2 rounded-full" style="width: {{ $materi->pivot->progress }}%"></div>
                    </div>
                </div>
                <a href="{{ route('siswa.browse.show', $materi) }}"
                    class="inline-flex items-center justify-center w-full px-4 py-2.5 bg-indigo-600 text-white rounded-xl text-sm font-semibold hover:bg-indigo-700 transition-colors shadow-sm">
                    Lanjutkan <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

{{-- Recently Saved --}}
@if ($recentlySaved->isNotEmpty())
<div class="mb-8">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-bold text-gray-900">Baru Disimpan</h2>
        <a href="{{ route('siswa.my-learning') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800 transition-colors">
            Lihat Semua <i class="bi bi-arrow-right"></i>
        </a>
    </div>
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4">
        @foreach ($recentlySaved as $materi)
        <a href="{{ route('siswa.browse.show', $materi) }}"
            class="block bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300 hover:-translate-y-1 group">
            <div class="h-24 {{ $colors[$loop->index % count($colors)] ?? 'bg-gradient-to-br from-indigo-400 to-purple-500' }} flex items-center justify-center">
                @if ($materi->thumbnail)
                <img src="{{ asset('storage/' . $materi->thumbnail) }}" alt="{{ $materi->judul }}" class="w-full h-full object-cover">
                @else
                <i class="bi bi-bookmark text-2xl text-white/70"></i>
                @endif
            </div>
            <div class="p-4">
                <h3 class="font-bold text-gray-900 text-sm mb-1 group-hover:text-indigo-600 transition-colors">{{ $materi->judul }}</h3>
                <p class="text-xs text-gray-500">{{ $materi->guru->name ?? '-' }}</p>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endif

{{-- Recommended Materials --}}
@if ($recommended->isNotEmpty())
<div class="mb-8">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-bold text-gray-900">Rekomendasi Materi</h2>
        <a href="{{ route('siswa.browse.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800 transition-colors">
            Jelajahi Semua <i class="bi bi-arrow-right"></i>
        </a>
    </div>
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4">
        @foreach ($recommended as $materi)
        <a href="{{ route('siswa.browse.show', $materi) }}"
            class="block bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300 hover:-translate-y-1 group">
            <div class="h-24 {{ $colors[$loop->index % count($colors)] ?? 'bg-gradient-to-br from-indigo-400 to-purple-500' }} flex items-center justify-center">
                @if ($materi->thumbnail)
                <img src="{{ asset('storage/' . $materi->thumbnail) }}" alt="{{ $materi->judul }}" class="w-full h-full object-cover">
                @else
                <i class="bi bi-journal text-2xl text-white/70"></i>
                @endif
            </div>
            <div class="p-4">
                <h3 class="font-bold text-gray-900 text-sm mb-1 group-hover:text-indigo-600 transition-colors">{{ $materi->judul }}</h3>
                <p class="text-xs text-gray-500 mb-1">{{ $materi->guru->name ?? '-' }}</p>
                <p class="text-xs text-gray-400">{{ $materi->tingkatKesulitan->nama_tingkat ?? '-' }} · {{ $materi->kategori->nama_kategori ?? '-' }}</p>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endif

{{-- Browse Categories --}}
@if ($categories->isNotEmpty())
<div class="mb-8">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-bold text-gray-900">Jelajahi Kategori</h2>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-3">
        @foreach ($categories as $category)
        <a href="{{ route('siswa.browse.by-category', $category) }}"
            class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 hover:shadow-md transition-all duration-300 hover:-translate-y-1 text-center group">
            <p class="font-semibold text-gray-900 text-sm group-hover:text-indigo-600 transition-colors">{{ $category->nama_kategori }}</p>
            <p class="text-xs text-gray-400 mt-1">{{ $category->materi_count }} materi</p>
        </a>
        @endforeach
    </div>
</div>
@endif

{{-- Browse Teachers --}}
@if ($teachers->isNotEmpty())
<div class="mb-8">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-bold text-gray-900">Jelajahi Guru</h2>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
        @foreach ($teachers as $teacher)
        <a href="{{ route('siswa.browse.teacher-profile', $teacher) }}"
            class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 hover:shadow-md transition-all duration-300 hover:-translate-y-1 flex items-center gap-3 group">
            @if ($teacher->avatar)
            <img src="{{ $teacher->avatar }}" class="w-10 h-10 rounded-full object-cover">
            @else
            <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center">
                <i class="bi bi-person text-gray-400"></i>
            </div>
            @endif
            <div class="text-left">
                <p class="font-semibold text-gray-900 text-sm group-hover:text-indigo-600 transition-colors">{{ $teacher->name }}</p>
                <p class="text-xs text-gray-400">{{ $teacher->materi_count }} materi</p>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endif

{{-- Recent Quiz Results --}}
@if ($recentAttempts->isNotEmpty())
<div class="mb-8">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-bold text-gray-900">Hasil Quiz Terbaru</h2>
        <a href="{{ route('siswa.quiz.history') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800 transition-colors">
            Lihat Semua <i class="bi bi-arrow-right"></i>
        </a>
    </div>
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
                    @foreach ($recentAttempts as $attempt)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-5 py-3 text-sm font-medium text-gray-900">{{ $attempt->quiz->judul ?? '-' }}</td>
                        <td class="px-5 py-3 text-sm text-gray-500">{{ $attempt->quiz->materi->judul ?? '-' }}</td>
                        <td class="px-5 py-3">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold {{ $attempt->skor_persen >= 80 ? 'bg-emerald-50 text-emerald-700' : ($attempt->skor_persen >= 60 ? 'bg-amber-50 text-amber-700' : 'bg-red-50 text-red-700') }}">
                                {{ $attempt->skor_persen }}%
                            </span>
                        </td>
                        <td class="px-5 py-3">
                            <div class="flex gap-0.5">
                                @for ($i = 1; $i <= 3; $i++)
                                    <i class="bi bi-star{{ $i <= $attempt->bintang ? '-fill text-amber-400' : ' text-gray-200' }} text-sm"></i>
                                @endfor
                            </div>
                        </td>
                        <td class="px-5 py-3 text-sm text-gray-500">
                            {{ \Carbon\Carbon::parse($attempt->tanggal_pengerjaan)->translatedFormat('d M Y') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif

{{-- Latest Published Materials --}}
@if ($latestPublished->isNotEmpty())
<div class="mb-8">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-bold text-gray-900">Materi Terbaru</h2>
        <a href="{{ route('siswa.browse.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800 transition-colors">
            Jelajahi Semua <i class="bi bi-arrow-right"></i>
        </a>
    </div>
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4">
        @foreach ($latestPublished as $materi)
        <a href="{{ route('siswa.browse.show', $materi) }}"
            class="block bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300 hover:-translate-y-1 group">
            <div class="h-24 {{ $colors[$loop->index % count($colors)] ?? 'bg-gradient-to-br from-indigo-400 to-purple-500' }} flex items-center justify-center">
                @if ($materi->thumbnail)
                <img src="{{ asset('storage/' . $materi->thumbnail) }}" alt="{{ $materi->judul }}" class="w-full h-full object-cover">
                @else
                <i class="bi bi-journal text-2xl text-white/70"></i>
                @endif
            </div>
            <div class="p-4">
                <h3 class="font-bold text-gray-900 text-sm mb-1 group-hover:text-indigo-600 transition-colors">{{ $materi->judul }}</h3>
                <p class="text-xs text-gray-500 mb-1">{{ $materi->guru->name ?? '-' }}</p>
                <p class="text-xs text-gray-400">{{ $materi->tingkatKesulitan->nama_tingkat ?? '-' }} · {{ $materi->kategori->nama_kategori ?? '-' }}</p>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endif
@endsection

@push('styles')
<style>
    .bg-gradient-mtk { background: linear-gradient(135deg, #6366f1, #8b5cf6); }
    .bg-gradient-bind { background: linear-gradient(135deg, #10b981, #34d399); }
    .bg-gradient-ipa { background: linear-gradient(135deg, #f59e0b, #f97316); }
    .bg-gradient-ips { background: linear-gradient(135deg, #ef4444, #f97316); }
    .bg-gradient-bing { background: linear-gradient(135deg, #06b6d4, #3b82f6); }
    .bg-gradient-default { background: linear-gradient(135deg, #6366f1, #a855f7); }
</style>
@endpush
