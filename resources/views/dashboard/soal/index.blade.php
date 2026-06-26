@extends('layouts.app')

@section('title', 'Soal - ' . $quiz->judul)

@section('content')
<div class="container-fluid">
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Daftar Soal - {{ $quiz->judul }}</h5>
            <div class="d-flex gap-2">
                <a href="{{ route('dashboard.quiz.soal.create', $quiz) }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i> Tambah Soal
                </a>
                <a href="{{ route('dashboard.quiz.show', $quiz) }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            @forelse ($quiz->soal as $soal)
            <div class="border-bottom p-3">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <h6 class="mb-0">Soal {{ $loop->iteration }}</h6>
                    <div class="d-flex gap-1">
                        <a href="{{ route('dashboard.quiz.soal.edit', [$quiz, $soal]) }}"
                            class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('dashboard.quiz.soal.destroy', [$quiz, $soal]) }}"
                            method="post" class="d-inline"
                            onsubmit="return confirm('Yakin ingin menghapus soal ini?')">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <p class="mb-2">{{ $soal->pertanyaan }}</p>
                <div class="ms-3">
                    @foreach ($soal->pilihanJawaban as $pilihan)
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <span class="badge bg-{{ $pilihan->is_correct ? 'success' : 'secondary' }}">
                            {{ chr(65 + $loop->index) }}
                        </span>
                        <span class="{{ $pilihan->is_correct ? 'fw-bold text-success' : '' }}">
                            {{ $pilihan->jawaban }}
                        </span>
                        @if ($pilihan->is_correct)
                        <i class="bi bi-check-circle-fill text-success"></i>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
            @empty
            <div class="text-center text-muted py-4">Belum ada soal</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
