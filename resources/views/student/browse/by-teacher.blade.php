@extends('layouts.student')

@section('title', 'Guru: ' . $guru->name)

@section('content')
<div class="mb-8">
    <a href="{{ route('siswa.browse.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-gray-900 transition-colors mb-2">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
    <h1 class="text-3xl font-extrabold text-gray-900">{{ $guru->name }}</h1>
    <p class="text-gray-500 mt-1 text-lg">{{ $materialCount }} materi dipublikasikan</p>
</div>

@include('student.browse._materi_grid', ['materiList' => $materiList])
@endsection
