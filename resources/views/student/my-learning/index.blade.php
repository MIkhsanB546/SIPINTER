@extends('layouts.student')

@section('title', 'My Learning')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-extrabold text-gray-900">My Learning</h1>
    <p class="text-gray-500 mt-1 text-lg">Materi yang sudah kamu simpan</p>
</div>

@php
$kategoriColors = [
    'Matematika' => 'from-indigo-400 to-purple-500',
    'Bahasa Indonesia' => 'from-emerald-400 to-teal-500',
    'IPA' => 'from-amber-400 to-orange-500',
    'IPS' => 'from-red-400 to-orange-500',
    'Bahasa Inggris' => 'from-cyan-400 to-blue-500',
];
@endphp

@if ($materiList->count())
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($materiList as $materi)
            @php
                $kategoriNama = $materi->kategori->nama_kategori ?? 'Umum';
                $gradient = $kategoriColors[$kategoriNama] ?? 'from-indigo-400 to-purple-500';
                $firstQuiz = $materi->quiz->first();
                $status = $materi->pivot->status;
                $progress = $materi->pivot->progress;
            @endphp
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300 hover:-translate-y-1 group">
                <a href="{{ route('siswa.browse.show', $materi) }}">
                    <div class="h-36 bg-gradient-to-br {{ $gradient }} flex items-center justify-center relative overflow-hidden">
                        @if ($materi->thumbnail)
                        <img src="{{ asset('storage/' . $materi->thumbnail) }}" alt="{{ $materi->judul }}" class="w-full h-full object-cover">
                        @else
                        <i class="bi bi-journal-bookmark-fill text-4xl text-white/70"></i>
                        @endif
                        @if ($status === 'completed')
                        <div class="absolute top-2 right-2 bg-emerald-500 text-white rounded-full px-2 py-1 text-xs font-semibold">
                            <i class="bi bi-check-circle-fill"></i> Selesai
                        </div>
                        @endif
                    </div>
                </a>
                <div class="p-5">
                    <a href="{{ route('siswa.browse.show', $materi) }}">
                        <h3 class="font-bold text-gray-900 mb-1 group-hover:text-indigo-600 transition-colors">{{ $materi->judul }}</h3>
                    </a>
                    <p class="text-xs text-gray-500 mb-1">
                        <i class="bi bi-person me-1"></i>{{ $materi->guru->name ?? '-' }}
                    </p>
                    <p class="text-xs text-gray-500 mb-1">
                        <i class="bi bi-bar-chart me-1"></i>{{ $materi->tingkatKesulitan->nama_tingkat ?? '-' }}
                    </p>
                    <p class="text-xs text-gray-500 mb-2">
                        <i class="bi bi-tag me-1"></i>{{ $materi->kategori->nama_kategori ?? '-' }}
                    </p>

                    @if ($status !== 'saved')
                    <div class="mb-3">
                        <div class="flex items-center justify-between text-xs text-gray-500 mb-1">
                            <span>Progress</span>
                            <span class="font-semibold {{ $progress >= 100 ? 'text-emerald-600' : 'text-indigo-600' }}">{{ $progress }}%</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2">
                            <div class="bg-indigo-500 h-2 rounded-full transition-all duration-500" style="width: {{ $progress }}%"></div>
                        </div>
                    </div>
                    @else
                    <div class="mb-3">
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-indigo-50 text-indigo-700">
                            <i class="bi bi-bookmark-fill me-1"></i> Tersimpan
                        </span>
                    </div>
                    @endif

                    <div class="flex gap-2">
                        @if ($status === 'saved')
                            @if ($firstQuiz)
                            <a href="{{ route('siswa.quiz.start', $firstQuiz) }}"
                                class="flex-1 inline-flex items-center justify-center px-4 py-2.5 bg-emerald-600 text-white rounded-xl text-sm font-semibold hover:bg-emerald-700 transition-colors shadow-sm">
                                <i class="bi bi-play-circle me-1"></i> Mulai
                            </a>
                            @endif
                        @elseif ($status === 'learning')
                            @if ($firstQuiz)
                            <a href="{{ route('siswa.quiz.start', $firstQuiz) }}"
                                class="flex-1 inline-flex items-center justify-center px-4 py-2.5 bg-emerald-600 text-white rounded-xl text-sm font-semibold hover:bg-emerald-700 transition-colors shadow-sm">
                                <i class="bi bi-arrow-right-circle me-1"></i> Lanjutkan
                            </a>
                            @endif
                        @elseif ($status === 'completed')
                            @if ($firstQuiz)
                            <a href="{{ route('siswa.quiz.start', $firstQuiz) }}"
                                class="flex-1 inline-flex items-center justify-center px-4 py-2.5 bg-indigo-50 text-indigo-700 rounded-xl text-sm font-semibold hover:bg-indigo-100 transition-colors">
                                <i class="bi bi-arrow-counterclockwise me-1"></i> Ulangi
                            </a>
                            @endif
                        @endif
                        <a href="{{ route('siswa.browse.show', $materi) }}"
                            class="inline-flex items-center justify-center px-4 py-2.5 bg-gray-100 text-gray-700 rounded-xl text-sm font-semibold hover:bg-gray-200 transition-colors">
                            <i class="bi bi-eye"></i>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $materiList->links() }}
    </div>
@else
    <div class="text-center py-16">
        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="bi bi-bookmark text-3xl text-gray-400"></i>
        </div>
        <h3 class="text-lg font-semibold text-gray-900 mb-1">Belum ada materi tersimpan</h3>
        <p class="text-gray-500 text-sm">Jelajahi materi dan simpan untuk mulai belajar!</p>
        <a href="{{ route('siswa.browse.index') }}"
            class="inline-flex items-center mt-4 px-6 py-2.5 bg-indigo-600 text-white rounded-xl text-sm font-semibold hover:bg-indigo-700 transition-colors shadow-sm">
            <i class="bi bi-compass me-2"></i> Jelajahi Materi
        </a>
    </div>
@endif
@endsection
