@extends('layouts.student')

@section('title', 'Profil: ' . $guru->name)

@section('content')
<div class="mb-8">
    <a href="{{ route('siswa.browse.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-gray-900 transition-colors mb-2">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-8">
    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 h-32"></div>
    <div class="px-6 pb-6 -mt-12">
        <div class="flex items-end gap-4">
            @if ($guru->avatar)
            <img src="{{ $guru->avatar }}" class="w-20 h-20 rounded-full border-4 border-white shadow-sm object-cover">
            @else
            <div class="w-20 h-20 rounded-full border-4 border-white shadow-sm bg-gray-200 flex items-center justify-center">
                <i class="bi bi-person text-3xl text-gray-400"></i>
            </div>
            @endif
            <div class="pb-1">
                <h1 class="text-2xl font-extrabold text-gray-900">{{ $guru->name }}</h1>
                <p class="text-sm text-gray-500">
                    <i class="bi bi-book me-1"></i>{{ $totalMateri }} materi dipublikasikan
                </p>
            </div>
        </div>
    </div>
</div>

@if ($materiList->count())
<div class="mb-6">
    <h2 class="text-xl font-bold text-gray-900 mb-4">Materi Terbaru</h2>
</div>
@include('student.browse._materi_grid', ['materiList' => $materiList])
@else
<div class="text-center py-16">
    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
        <i class="bi bi-book text-3xl text-gray-400"></i>
    </div>
    <h3 class="text-lg font-semibold text-gray-900 mb-1">Belum ada materi</h3>
    <p class="text-gray-500 text-sm">Guru ini belum mempublikasikan materi apapun.</p>
</div>
@endif

@if ($totalMateri > 6)
<div class="text-center mt-6">
    <a href="{{ route('siswa.browse.by-teacher', $guru) }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white rounded-xl text-sm font-semibold hover:bg-indigo-700 transition-colors shadow-sm">
        Lihat Semua Materi ({{ $totalMateri }})
    </a>
</div>
@endif
@endsection
