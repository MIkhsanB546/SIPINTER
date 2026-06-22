@extends('layouts.student')

@section('title', 'Quiz Saya')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-extrabold text-gray-900">Quiz Saya</h1>
    <p class="text-gray-500 mt-1 text-lg">Kerjakan quiz dan kumpulkan bintang sebanyak-banyaknya!</p>
</div>

@forelse ($quizList as $item)
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-all duration-300 mb-4 group">
    <div class="p-6 flex items-center justify-between">
        <div class="flex-1">
            <h3 class="font-bold text-gray-900 text-lg group-hover:text-indigo-600 transition-colors">{{ $item->quiz->judul }}</h3>
            <p class="text-sm text-gray-500 mt-1">{{ $item->quiz->materi->judul ?? '-' }}</p>
            <div class="flex items-center gap-4 mt-3">
                <span class="inline-flex items-center text-xs text-gray-500">
                    <i class="bi bi-clock me-1"></i> {{ $item->quiz->durasi_menit ?? 'Tidak terbatas' }} menit
                </span>
                <span class="inline-flex items-center text-xs text-gray-500">
                    <i class="bi bi-question-circle me-1"></i> {{ $item->quiz->soals->count() }} soal
                </span>
                @if ($item->has_completed)
                <span class="inline-flex items-center text-xs text-emerald-600">
                    <i class="bi bi-check-circle me-1"></i> {{ $item->attempt_count }}x dikerjakan
                </span>
                @endif
            </div>
        </div>
        <div class="flex items-center gap-4">
            @if ($item->has_completed)
            <div class="text-right">
                <div class="flex gap-0.5 mb-1">
                    @for ($i = 1; $i <= 3; $i++)
                        <i class="bi bi-star{{ $i <= $item->best_bintang ? '-fill text-amber-400' : ' text-gray-200' }} text-sm"></i>
                    @endfor
                </div>
                <span class="text-xs font-semibold {{ $item->best_skor >= 80 ? 'text-emerald-600' : ($item->best_skor >= 60 ? 'text-amber-600' : 'text-red-600') }}">
                    {{ $item->best_skor }}%
                </span>
            </div>
            @endif
            <a href="{{ route('siswa.quiz.start', $item->quiz) }}"
                class="inline-flex items-center px-5 py-2.5 {{ $item->has_completed ? 'bg-indigo-50 text-indigo-700 hover:bg-indigo-100' : 'bg-indigo-600 text-white hover:bg-indigo-700' }} rounded-xl text-sm font-semibold transition-colors shadow-sm">
                {{ $item->has_completed ? 'Kerjakan Lagi' : 'Mulai Quiz' }}
                <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
</div>
@empty
<div class="text-center py-16">
    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
        <i class="bi bi-pencil-square text-3xl text-gray-400"></i>
    </div>
    <h3 class="text-lg font-semibold text-gray-900 mb-1">Belum ada quiz tersedia</h3>
    <p class="text-gray-500 text-sm">Quiz akan muncul ketika guru menambahkan ke materi yang dipublikasikan.</p>
</div>
@endforelse
@endsection
