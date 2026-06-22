@extends('layouts.app')

@section('title', 'Kelola Materi')

@section('content')
<div class="container-fluid">
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="card-title mb-0">Daftar Materi</h5>
            <a href="{{ route('dashboard.materi.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Tambah Materi
            </a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Guru</th>
                            <th>Jenjang</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($materiList as $materi)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $materi->judul }}</td>
                            <td>{{ $materi->guru->name ?? '-' }}</td>
                            <td>{{ $materi->jenjang->nama_jenjang ?? '-' }}</td>
                            <td>{{ $materi->kategori->nama_kategori ?? '-' }}</td>
                            <td>
                                @if ($materi->is_published)
                                <span class="badge bg-success">Published</span>
                                @else
                                <span class="badge bg-secondary">Draft</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('dashboard.materi.show', $materi) }}" class="btn btn-sm btn-info" title="Lihat">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('dashboard.materi.edit', $materi) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('dashboard.materi.destroy', $materi) }}" method="post" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus materi ini?')">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-3">Belum ada materi</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
