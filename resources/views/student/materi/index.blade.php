@extends('layouts.student')

@section('title', 'Materi Pembelajaran')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-extrabold text-gray-900">Materi Pembelajaran</h1>
    <p class="text-gray-500 mt-1 text-lg">Pilih materi yang ingin kamu pelajari</p>
</div>

@php
$grouped = $materiList->groupBy(fn ($m) => $m->kategori->nama_kategori ?? 'Umum');
$kategoriColors = [
    'Matematika' => 'from-indigo-400 to-purple-500',
    'Bahasa Indonesia' => 'from-emerald-400 to-teal-500',
    'IPA' => 'from-amber-400 to-orange-500',
    'IPS' => 'from-red-400 to-orange-500',
    'Bahasa Inggris' => 'from-cyan-400 to-blue-500',
];
@endphp

@forelse ($grouped as $kategori => $materiGroup)
<div class="mb-8">
    <h2 class="text-xl font-bold text-gray-900 mb-4">{{ $kategori }}</h2>
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($materiGroup as $materi)
        @php
        $gradient = $kategoriColors[$kategori] ?? 'from-indigo-400 to-purple-500';
        @endphp
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300 hover:-translate-y-1 group">
            <div class="h-36 bg-gradient-to-br {{ $gradient }} flex items-center justify-center relative overflow-hidden">
                @if ($materi->thumbnail)
                <img src="{{ asset('storage/' . $materi->thumbnail) }}" alt="{{ $materi->judul }}" class="w-full h-full object-cover">
                @else
                <i class="bi bi-journal-bookmark-fill text-4xl text-white/70"></i>
                @endif
                @php $firstQuiz = $materi->quizzes->first(); @endphp
                @if ($firstQuiz)
                <div class="absolute top-2 right-2 bg-white/90 backdrop-blur-sm rounded-full px-2 py-1 text-xs font-semibold text-emerald-600 flex items-center gap-1">
                    <i class="bi bi-pencil-square text-xs"></i> Quiz
                </div>
                @endif
            </div>
            <div class="p-5">
                <h3 class="font-bold text-gray-900 mb-1 group-hover:text-indigo-600 transition-colors">{{ $materi->judul }}</h3>
                <p class="text-xs text-gray-500 mb-1">
                    <i class="bi bi-person me-1"></i>{{ $materi->guru->name ?? '-' }}
                </p>
                <p class="text-xs text-gray-500 mb-3">
                    <i class="bi bi-bar-chart me-1"></i>{{ $materi->jenjang->nama_jenjang ?? '-' }}
                </p>
                <div class="flex gap-2">
                    <a href="{{ route('siswa.materi.show', $materi) }}"
                        class="flex-1 inline-flex items-center justify-center px-4 py-2.5 bg-indigo-600 text-white rounded-xl text-sm font-semibold hover:bg-indigo-700 transition-colors shadow-sm">
                        Pelajari
                    </a>
                    @if ($firstQuiz)
                    <a href="{{ route('siswa.quiz.start', $firstQuiz) }}"
                        class="inline-flex items-center justify-center px-4 py-2.5 bg-emerald-50 text-emerald-700 rounded-xl text-sm font-semibold hover:bg-emerald-100 transition-colors">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@empty
<div class="text-center py-16">
    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
        <i class="bi bi-book text-3xl text-gray-400"></i>
    </div>
    <h3 class="text-lg font-semibold text-gray-900 mb-1">Belum ada materi tersedia</h3>
    <p class="text-gray-500 text-sm">Materi akan muncul ketika guru sudah mempublikasikannya.</p>
</div>
@endforelse
@endsection
