@extends('layouts.app')

@section('title', $quiz->judul)

@section('content')
<div class="container-fluid">
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Detail Quiz</h5>
            <div class="d-flex gap-2">
                <a href="{{ route('dashboard.quiz.edit', $quiz) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <a href="{{ route('dashboard.quiz.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th style="width: 200px">Judul</th>
                    <td>{{ $quiz->judul }}</td>
                </tr>
                <tr>
                    <th>Materi</th>
                    <td>{{ $quiz->materi->judul ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td>{{ $quiz->deskripsi ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Durasi</th>
                    <td>{{ $quiz->durasi_menit ? $quiz->durasi_menit . ' menit' : '-' }}</td>
                </tr>
                <tr>
                    <th>Jumlah Soal</th>
                    <td>{{ $quiz->soals->count() }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Daftar Soal</h5>
            <a href="{{ route('dashboard.quiz.soal.create', $quiz) }}" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Tambah Soal
            </a>
        </div>
        <div class="card-body p-0">
            @forelse ($quiz->soals as $soal)
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
                    @foreach ($soal->pilihanJawabans as $pilihan)
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
