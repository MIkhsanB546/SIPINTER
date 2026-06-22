@extends('layouts.student')

@section('title', 'Hasil Quiz')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="text-center mb-8">
        <h1 class="text-3xl font-extrabold text-gray-900">{{ $quiz->judul }}</h1>
        <p class="text-gray-500 mt-1">Attempt ke-{{ $attempt->attempt_ke }}</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6">
        <div class="p-8 text-center">
            <div class="w-24 h-24 rounded-full mx-auto mb-4 flex items-center justify-center
                {{ $attempt->skor_persen >= 80 ? 'bg-emerald-50' : ($attempt->skor_persen >= 60 ? 'bg-amber-50' : ($attempt->skor_persen >= 40 ? 'bg-orange-50' : 'bg-red-50')) }}">
                <span class="text-4xl font-black
                    {{ $attempt->skor_persen >= 80 ? 'text-emerald-600' : ($attempt->skor_persen >= 60 ? 'text-amber-600' : ($attempt->skor_persen >= 40 ? 'text-orange-600' : 'text-red-600')) }}">
                    {{ $attempt->skor_persen }}%
                </span>
            </div>

            <h2 class="text-2xl font-extrabold text-gray-900 mb-2">
                @if ($attempt->skor_persen >= 80)
                🎉 Luar Biasa!
                @elseif ($attempt->skor_persen >= 60)
                👍 Bagus!
                @elseif ($attempt->skor_persen >= 40)
                💪 Terus Berusaha!
                @else
                📚 Ayo Belajar Lagi!
                @endif
            </h2>

            <div class="flex items-center justify-center gap-1 mb-4">
                @for ($i = 1; $i <= 3; $i++)
                    <i class="bi bi-star{{ $i <= $attempt->bintang ? '-fill text-amber-400' : ' text-gray-200' }} text-2xl"></i>
                @endfor
            </div>

            <div class="flex justify-center gap-8 text-sm">
                <div>
                    <span class="text-gray-500">Benar</span>
                    <p class="font-bold text-emerald-600 text-lg">{{ $attempt->jawabanSiswa->where('is_correct', true)->count() }}/{{ $attempt->jawabanSiswa->count() }}</p>
                </div>
                <div>
                    <span class="text-gray-500">Salah</span>
                    <p class="font-bold text-red-600 text-lg">{{ $attempt->jawabanSiswa->where('is_correct', false)->count() }}/{{ $attempt->jawabanSiswa->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="space-y-4 mb-8">
        <h3 class="font-bold text-gray-900 text-lg">Detail Jawaban</h3>

        @foreach ($attempt->jawabanSiswa as $index => $jawaban)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-5">
                <div class="flex items-start gap-3 mb-3">
                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-xl {{ $jawaban->is_correct ? 'bg-emerald-50 text-emerald-600' : 'bg-red-50 text-red-600' }} text-sm font-bold shrink-0">
                        <i class="bi {{ $jawaban->is_correct ? 'bi-check-lg' : 'bi-x-lg' }}"></i>
                    </span>
                    <p class="font-semibold text-gray-900 pt-1">{{ $jawaban->soal->pertanyaan }}</p>
                </div>
                <div class="ml-11 space-y-1">
                    @foreach ($jawaban->soal->pilihanJawabans as $pilihan)
                    <div class="flex items-center gap-2 p-2 rounded-lg text-sm
                        {{ $pilihan->is_correct ? 'bg-emerald-50 text-emerald-700 font-semibold' : '' }}
                        {{ $pilihan->id_pilihan_jawaban === $jawaban->id_pilihan_jawaban && !$pilihan->is_correct ? 'bg-red-50 text-red-700' : '' }}">
                        @if ($pilihan->is_correct)
                        <i class="bi bi-check-circle-fill text-emerald-500"></i>
                        @elseif ($pilihan->id_pilihan_jawaban === $jawaban->id_pilihan_jawaban)
                        <i class="bi bi-x-circle-fill text-red-500"></i>
                        @else
                        <i class="bi bi-circle text-gray-300"></i>
                        @endif
                        <span>{{ $pilihan->jawaban }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="flex justify-center gap-4">
        <a href="{{ route('siswa.quiz.start', $quiz) }}"
            class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white rounded-xl text-sm font-bold hover:bg-indigo-700 transition-colors shadow-sm">
            <i class="bi bi-arrow-repeat me-2"></i> Kerjakan Lagi
        </a>
        <a href="{{ route('siswa.quiz.history') }}"
            class="inline-flex items-center px-6 py-3 bg-gray-100 text-gray-700 rounded-xl text-sm font-bold hover:bg-gray-200 transition-colors">
            <i class="bi bi-clock-history me-2"></i> Riwayat Quiz
        </a>
    </div>
</div>
@endsection
