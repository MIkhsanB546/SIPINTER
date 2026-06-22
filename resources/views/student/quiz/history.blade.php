@extends('layouts.student')

@section('title', 'Riwayat Quiz')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-extrabold text-gray-900">Riwayat Quiz</h1>
    <p class="text-gray-500 mt-1 text-lg">Lihat kembali hasil quiz yang sudah kamu kerjakan</p>
</div>

@forelse ($attempts->groupBy(fn($a) => $a->quiz->judul) as $quizJudul => $group)
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6">
    <div class="px-6 py-4 bg-gray-50 border-b border-gray-100">
        <h3 class="font-bold text-gray-900">{{ $quizJudul }}</h3>
        <p class="text-xs text-gray-500">{{ $group->first()->quiz->materi->judul ?? '-' }}</p>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Attempt</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Skor</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Bintang</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach ($group->sortByDesc('tanggal_pengerjaan') as $attempt)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-5 py-3 text-sm font-medium text-gray-900">Attempt #{{ $attempt->attempt_ke }}</td>
                    <td class="px-5 py-3 text-sm text-gray-500">
                        {{ \Carbon\Carbon::parse($attempt->tanggal_pengerjaan)->translatedFormat('d M Y H:i') }}
                    </td>
                    <td class="px-5 py-3">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                            {{ $attempt->skor_persen >= 80 ? 'bg-emerald-50 text-emerald-700' : ($attempt->skor_persen >= 60 ? 'bg-amber-50 text-amber-700' : ($attempt->skor_persen >= 40 ? 'bg-orange-50 text-orange-700' : 'bg-red-50 text-red-700')) }}">
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
                    <td class="px-5 py-3">
                        <a href="{{ route('siswa.quiz.result', [$attempt->quiz, $attempt]) }}"
                            class="inline-flex items-center px-3 py-1.5 text-xs font-semibold text-indigo-600 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition-colors">
                            Detail
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@empty
<div class="text-center py-16">
    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
        <i class="bi bi-clock-history text-3xl text-gray-400"></i>
    </div>
    <h3 class="text-lg font-semibold text-gray-900 mb-1">Belum ada riwayat quiz</h3>
    <p class="text-gray-500 text-sm">Mulai kerjakan quiz untuk melihat riwayatmu!</p>
    <a href="{{ route('siswa.quiz.index') }}" class="inline-flex items-center mt-4 px-6 py-2.5 bg-indigo-600 text-white rounded-xl text-sm font-semibold hover:bg-indigo-700 transition-colors shadow-sm">
        Lihat Quiz Tersedia
    </a>
</div>
@endforelse
@endsection
