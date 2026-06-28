@extends('layouts.student')

{{-- Judul halaman dinamis dari materi --}}
@section('title', $materi->judul)

@php
$kategoriColors = [
    'Matematika' => 'from-indigo-400 to-purple-500',
    'Bahasa Indonesia' => 'from-emerald-400 to-teal-500',
    'IPA' => 'from-amber-400 to-orange-500',
    'IPS' => 'from-red-400 to-orange-500',
    'Bahasa Inggris' => 'from-cyan-400 to-blue-500',
];
$gradient = $kategoriColors[$materi->kategori->nama_kategori ?? ''] ?? 'from-indigo-400 to-purple-500';
@endphp

@section('content')
{{-- Tombol kembali ke daftar materi --}}
<a href="{{ route('siswa.materi.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-gray-900 transition-colors mb-4">
    <i class="bi bi-arrow-left me-1"></i> Kembali ke Materi
</a>

{{-- Konten utama dan sidebar informasi materi --}}
<div class="grid lg:grid-cols-3 gap-6">
    {{-- Kolom konten utama --}}
    <div class="lg:col-span-2">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            {{-- Header dengan thumbnail/gradient --}}
            <div class="h-48 bg-gradient-to-br {{ $gradient }} flex items-center justify-center">
                @if ($materi->thumbnail)
                <img src="{{ asset('storage/' . $materi->thumbnail) }}" alt="{{ $materi->judul }}" class="w-full h-full object-cover">
                @else
                <i class="bi bi-journal-bookmark-fill text-5xl text-white/70"></i>
                @endif
            </div>
            <div class="p-6">
                {{-- Badge kategori dan tingkat --}}
                <div class="flex flex-wrap gap-2 mb-4">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-indigo-50 text-indigo-700">
                        {{ $materi->kategori->nama_kategori ?? 'Umum' }}
                    </span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700">
                        {{ $materi->tingkatKesulitan->nama_tingkat ?? '-' }}
                    </span>
                </div>

                <h1 class="text-2xl font-extrabold text-gray-900 mb-2">{{ $materi->judul }}</h1>

                <p class="text-sm text-gray-500 mb-4">
                    <i class="bi bi-person me-1"></i>{{ $materi->guru->name ?? '-' }}
                </p>

                {{-- Deskripsi materi --}}
                @if ($materi->deskripsi)
                <div class="prose prose-sm max-w-none text-gray-600 mb-6">
                    {{ $materi->deskripsi }}
                </div>
                @endif

                {{-- Tombol aksi: unduh materi dan kerjakan quiz --}}
                <div class="flex flex-wrap gap-3">
                    @if ($materi->file_materi)
                    {{-- Tombol unduh file materi --}}
                    <a href="{{ asset('storage/' . $materi->file_materi) }}"
                        class="inline-flex items-center px-5 py-2.5 bg-indigo-50 text-indigo-700 rounded-xl text-sm font-semibold hover:bg-indigo-100 transition-colors" target="_blank">
                        <i class="bi bi-download me-2"></i> Unduh Materi
                    </a>
                    @endif

                    @php $firstQuiz = $materi->quiz->first(); @endphp
                    @if ($firstQuiz)
                    {{-- Tombol kerjakan quiz --}}
                    <a href="{{ route('siswa.quiz.start', $firstQuiz) }}"
                        class="inline-flex items-center px-5 py-2.5 bg-emerald-600 text-white rounded-xl text-sm font-semibold hover:bg-emerald-700 transition-colors shadow-sm">
                        <i class="bi bi-pencil-square me-2"></i> Kerjakan Quiz
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Sidebar informasi materi --}}
    <div class="lg:col-span-1">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h3 class="font-bold text-gray-900 mb-4">Informasi Materi</h3>
            <div class="space-y-3 text-sm">
                <div>
                    <p class="text-gray-500 text-xs">Kategori</p>
                    <p class="font-medium text-gray-900">{{ $materi->kategori->nama_kategori ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-500 text-xs">Tingkat Kesulitan</p>
                    <p class="font-medium text-gray-900">{{ $materi->tingkatKesulitan->nama_tingkat ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-500 text-xs">Guru</p>
                    <p class="font-medium text-gray-900">{{ $materi->guru->name ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-500 text-xs">Quiz</p>
                    @if ($firstQuiz)
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700">
                        {{ $firstQuiz->judul }}
                    </span>
                    @else
                    <p class="text-gray-400">Tidak ada</p>
                    @endif
                </div>
                <div>
                    <p class="text-gray-500 text-xs">Dipublikasikan</p>
                    <p class="font-medium text-gray-900">{{ $materi->created_at->translatedFormat('d F Y') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
