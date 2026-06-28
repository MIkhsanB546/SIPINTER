@extends('layouts.orang_tua')

@section('title', 'Dashboard Orang Tua')

@push('styles')
<style>
    .text-si-primary { color: var(--si-primary) !important; }
    .bg-si-primary { background-color: var(--si-primary) !important; }
    .hover\:bg-si-light:hover { background-color: #E8F0F6 !important; }
</style>
@endpush

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-extrabold text-gray-900">Dashboard Orang Tua</h1>
    <p class="text-gray-500 mt-1 text-lg">Pantau perkembangan belajar anak-anak Anda</p>
</div>

@if ($anak->isEmpty())
<div class="text-center py-16">
    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
        <i class="bi bi-people text-3xl text-gray-400"></i>
    </div>
    <h3 class="text-lg font-semibold text-gray-900 mb-1">Belum ada anak terdaftar</h3>
    <p class="text-gray-500 text-sm">Hubungi admin untuk mendaftarkan anak Anda.</p>
</div>
@else
    @foreach ($anak as $item)
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6">
        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-6 py-4">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                    <i class="bi bi-person text-2xl text-white"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-white">{{ $item->siswa->name }}</h2>
                    <p class="text-sm text-white/80">{{ $item->siswa->email }}</p>
                </div>
            </div>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <div class="bg-indigo-50 rounded-xl p-4">
                    <p class="text-2xl font-black text-indigo-600">{{ $item->progress }}%</p>
                    <p class="text-xs text-gray-500 mt-1">Progress Belajar</p>
                </div>
                <div class="bg-emerald-50 rounded-xl p-4">
                    <p class="text-2xl font-black text-emerald-600">{{ $item->totalCompleted }}</p>
                    <p class="text-xs text-gray-500 mt-1">Materi Selesai</p>
                </div>
                <div class="bg-amber-50 rounded-xl p-4">
                    <p class="text-2xl font-black text-amber-600">{{ $item->totalLearning }}</p>
                    <p class="text-xs text-gray-500 mt-1">Sedang Dipelajari</p>
                </div>
                <div class="bg-sky-50 rounded-xl p-4">
                    <p class="text-2xl font-black text-sky-600">{{ $item->totalStars }}</p>
                    <p class="text-xs text-gray-500 mt-1">Bintang ⭐</p>
                </div>
            </div>

            <div class="grid lg:grid-cols-2 gap-6">
                <div>
                    <h3 class="font-bold text-gray-900 mb-3">Materi Tersimpan</h3>
                    <div class="space-y-2">
                        @forelse ($item->siswa->materiSiswa->take(5) as $m)
                        <div class="flex items-center justify-between bg-gray-50 rounded-lg px-4 py-3">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">{{ $m->judul }}</p>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="text-xs {{ $m->pivot->status === 'completed' ? 'text-emerald-600' : ($m->pivot->status === 'learning' ? 'text-amber-600' : 'text-indigo-600') }}">
                                        {{ ucfirst($m->pivot->status) }}
                                    </span>
                                    @if ($m->pivot->status !== 'saved')
                                    <span class="text-xs text-gray-400">·</span>
                                    <span class="text-xs text-gray-500">{{ $m->pivot->progress }}%</span>
                                    @endif
                                </div>
                            </div>
                            @if ($m->pivot->status === 'completed')
                            <i class="bi bi-check-circle-fill text-emerald-500"></i>
                            @endif
                        </div>
                        @empty
                        <p class="text-sm text-gray-400">Belum ada materi tersimpan</p>
                        @endforelse
                    </div>

                    <h3 class="font-bold text-gray-900 mt-6 mb-3">Nilai Rata-rata</h3>
                    <div class="bg-gray-50 rounded-xl p-4">
                        <p class="text-3xl font-black {{ $item->averageScore >= 80 ? 'text-emerald-600' : ($item->averageScore >= 60 ? 'text-amber-600' : 'text-red-600') }}">
                            {{ $item->averageScore }}
                        </p>
                        <p class="text-xs text-gray-500 mt-1">Rata-rata skor quiz</p>
                    </div>
                </div>

                <div>
                    <h3 class="font-bold text-gray-900 mb-3">Riwayat Quiz Terbaru</h3>
                    @if ($item->quizAttempts->isNotEmpty())
                    <div class="space-y-2">
                        @foreach ($item->quizAttempts as $attempt)
                        <div class="flex items-center justify-between bg-gray-50 rounded-lg px-4 py-3">
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $attempt->quiz->judul ?? '-' }}</p>
                                <p class="text-xs text-gray-500">{{ $attempt->quiz->materi->judul ?? '-' }}</p>
                            </div>
                            <div class="text-right">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold {{ $attempt->skor_persen >= 80 ? 'bg-emerald-50 text-emerald-700' : ($attempt->skor_persen >= 60 ? 'bg-amber-50 text-amber-700' : 'bg-red-50 text-red-700') }}">
                                    {{ $attempt->skor_persen }}%
                                </span>
                                <div class="flex gap-0.5 mt-1">
                                    @for ($i = 1; $i <= 3; $i++)
                                        <i class="bi bi-star{{ $i <= $attempt->bintang ? '-fill text-amber-400' : ' text-gray-200' }}" style="font-size: 0.6rem;"></i>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-8 bg-gray-50 rounded-xl">
                        <i class="bi bi-journal text-2xl text-gray-300"></i>
                        <p class="text-sm text-gray-400 mt-2">Belum ada riwayat quiz</p>
                    </div>
                    @endif

                    <h3 class="font-bold text-gray-900 mt-6 mb-3">Aktivitas Terbaru</h3>
                    @if ($item->quizAttempts->isNotEmpty())
                    <div class="space-y-2">
                        @foreach ($item->quizAttempts->take(5) as $attempt)
                        <div class="flex items-center gap-3 text-sm">
                            <i class="bi bi-dot text-indigo-500"></i>
                            <span class="text-gray-600">Mengerjakan <strong>{{ $attempt->quiz->judul ?? 'quiz' }}</strong></span>
                            <span class="text-xs text-gray-400 ml-auto">{{ \Carbon\Carbon::parse($attempt->tanggal_pengerjaan)->diffForHumans() }}</span>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p class="text-sm text-gray-400">Belum ada aktivitas</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endif
@endsection
