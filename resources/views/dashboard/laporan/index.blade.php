@extends('layouts.app')

@section('title', 'Laporan')

@section('content')
    <div class="container-fluid">
        <div class="row g-3 mb-4">
            <div class="col-lg-2 col-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h3 class="fw-bold text-primary mb-0">{{ $totalGuru }}</h3>
                        <small class="text-muted">Guru</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h3 class="fw-bold text-success mb-0">{{ $totalSiswa }}</h3>
                        <small class="text-muted">Siswa</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h3 class="fw-bold text-info mb-0">{{ $totalMateri }}</h3>
                        <small class="text-muted">Materi</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h3 class="fw-bold text-warning mb-0">{{ $totalQuiz }}</h3>
                        <small class="text-muted">Quiz</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h3 class="fw-bold text-danger mb-0">{{ $totalAttempts }}</h3>
                        <small class="text-muted">Pengerjaan</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h3 class="fw-bold text-secondary mb-0">{{ $rataNilai }}</h3>
                        <small class="text-muted">Rata Nilai</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Materi Paling Banyak Dikerjakan</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Materi</th>
                                <th>Guru</th>
                                <th>Jumlah Pengerjaan Quiz</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($topMateri as $materi)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $materi->judul }}</td>
                                    <td>{{ $materi->guru->name ?? '-' }}</td>
                                    <td>{{ $materi->attempt_count ?? 0 }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-3">Belum ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
