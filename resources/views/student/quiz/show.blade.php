@extends('layouts.student')

@section('title', $quiz->judul)

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-extrabold text-gray-900">{{ $quiz->judul }}</h1>
    <p class="text-gray-500 mt-1">Attempt ke-{{ $attempt->attempt_ke }}</p>
</div>

<form action="{{ route('siswa.quiz.submit', [$quiz, $attempt]) }}" method="post">
    @csrf

    <div class="space-y-6">
        @foreach ($quiz->soal as $index => $soal)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-all duration-300"
            x-data="{ selected: null }">
            <div class="flex items-start gap-3 mb-4">
                <span class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-indigo-50 text-indigo-700 text-sm font-bold shrink-0">
                    {{ $index + 1 }}
                </span>
                <p class="font-semibold text-gray-900 pt-1">{{ $soal->pertanyaan }}</p>
            </div>

            <div class="space-y-2 ml-11">
                @foreach ($soal->pilihanJawaban as $pilihan)
                <label class="flex items-center gap-3 p-3 rounded-xl border border-gray-200 cursor-pointer transition-all duration-200 hover:bg-indigo-50 hover:border-indigo-200"
                    :class="{ 'bg-indigo-50 border-indigo-300': selected == {{ $pilihan->id_pilihan_jawaban }} }">
                    <input type="radio"
                        name="jawaban[{{ $soal->id_soal }}]"
                        value="{{ $pilihan->id_pilihan_jawaban }}"
                        x-model="selected"
                        class="w-4 h-4 text-indigo-600 focus:ring-indigo-500"
                        required>
                    <span class="text-sm text-gray-700" x-text="'{{ $pilihan->jawaban }}'">></span>
                </label>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-8 flex items-center justify-between bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
        <p class="text-sm text-gray-500">
            <i class="bi bi-info-circle me-1"></i>
            Pastikan semua jawaban sudah terisi sebelum mengirim.
        </p>
        <button type="submit"
            class="inline-flex items-center px-6 py-3 bg-emerald-600 text-white rounded-xl text-sm font-bold hover:bg-emerald-700 transition-colors shadow-sm">
            <i class="bi bi-check2 me-2"></i> Kumpulkan Jawaban
        </button>
    </div>
</form>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endpush
