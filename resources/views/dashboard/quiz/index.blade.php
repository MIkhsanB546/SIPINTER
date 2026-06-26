@extends('layouts.app')

@section('title', 'Kelola Quiz')

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
            <h5 class="card-title mb-0">Daftar Quiz</h5>
            <a href="{{ route('dashboard.quiz.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Tambah Quiz
            </a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                        <table id="quizTable" class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Materi</th>
                            <th>Durasi</th>
                            <th>Soal Count</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($quizList as $quiz)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $quiz->judul }}</td>
                            <td>{{ $quiz->materi->judul ?? '-' }}</td>
                            <td>{{ $quiz->durasi_menit ? $quiz->durasi_menit . ' menit' : '-' }}</td>
                            <td>{{ $quiz->soal_count ?? $quiz->soal->count() }}</td>
                            <td>
                                <a href="{{ route('dashboard.quiz.show', $quiz) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('dashboard.quiz.edit', $quiz) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('dashboard.quiz.destroy', $quiz) }}" method="post" class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus quiz ini?')">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Belum ada quiz</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
$(document).ready(function() {
    $('#quizTable').DataTable({
        responsive: true,
        pageLength: 10,
        language: { url: '//cdn.datatables.net/plug-ins/1.13.11/i18n/id.json' },
        columnDefs: [{ orderable: false, targets: 5 }]
    });
});
</script>
@endpush
@endsection
