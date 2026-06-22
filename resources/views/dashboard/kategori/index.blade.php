@extends('layouts.app')

@section('title', 'Kelola Kategori Materi')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0">Daftar Kategori Materi</h5>
                    <a href="{{ route('dashboard.kategori.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-lg"></i> Tambah Kategori
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kategori</th>
                                    <th>Deskripsi</th>
                                    <th>Jumlah Materi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($kategoriList as $kategori)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $kategori->nama_kategori }}</td>
                                    <td>{{ $kategori->deskripsi ?? '-' }}</td>
                                    <td>{{ $kategori->materi_count ?? $kategori->materi->count() }}</td>
                                    <td class="text-nowrap">
                                        <a href="{{ route('dashboard.kategori.edit', $kategori->id_kategori_materi) }}" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <form action="{{ route('dashboard.kategori.destroy', $kategori->id_kategori_materi) }}" method="post" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-3">Belum ada kategori</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
