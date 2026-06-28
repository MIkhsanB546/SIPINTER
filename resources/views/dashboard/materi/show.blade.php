@extends('layouts.app')

@section('title', $materi->judul)

@section('content')
{{-- Detail materi --}}
<div class="container-fluid">
    <div class="card">
        {{-- Header dengan tombol kembali --}}
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="card-title mb-0">Detail Materi</h5>
            <a href="{{ route('dashboard.materi.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <div class="row">
                {{-- Informasi detail materi --}}
                <div class="col-md-8">
                    <table class="table table-borderless">
                        <tr>
                            <th style="width: 150px;">Judul</th>
                            <td>{{ $materi->judul }}</td>
                        </tr>
                        <tr>
                            <th>Deskripsi</th>
                            <td>{{ $materi->deskripsi ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Guru</th>
                            <td>{{ $materi->guru->name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Tingkat</th>
                            <td>{{ $materi->tingkatKesulitan->nama_tingkat ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Kategori</th>
                            <td>{{ $materi->kategori->nama_kategori ?? '-' }}</td>
                        </tr>
                        {{-- Status publish/draft --}}
                        <tr>
                            <th>Status</th>
                            <td>
                                @if ($materi->is_published)
                                <span class="badge bg-success">Published</span>
                                @else
                                <span class="badge bg-secondary">Draft</span>
                                @endif
                            </td>
                        </tr>
                        {{-- Tombol download file materi --}}
                        @if ($materi->file_materi)
                        <tr>
                            <th>File Materi</th>
                            <td>
                                <a href="{{ Storage::url($materi->file_materi) }}" class="btn btn-sm btn-outline-primary" target="_blank">
                                    <i class="bi bi-download"></i> Download
                                </a>
                            </td>
                        </tr>
                        @endif
                    </table>
                </div>
                {{-- Thumbnail materi --}}
                <div class="col-md-4">
                    @if ($materi->thumbnail)
                    <div class="text-center">
                        <img src="{{ Storage::url($materi->thumbnail) }}" alt="Thumbnail" class="img-fluid rounded shadow-sm">
                    </div>
                    @endif
                </div>
            </div>

            {{-- Quiz terkait --}}
            @php $firstQuiz = $materi->quiz->first(); @endphp
            @if ($firstQuiz)
            <div class="mt-4">
                <div class="card bg-light">
                    <div class="card-body">
                        <h6 class="fw-bold">Quiz Terkait</h6>
                        <p class="mb-1">Judul: {{ $firstQuiz->judul }}</p>
                        @if ($firstQuiz->durasi_menit)
                        <p class="mb-0">Durasi: {{ $firstQuiz->durasi_menit }} menit</p>
                        @endif
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
