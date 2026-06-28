@extends('layouts.app')

@section('title', 'Kelola Materi')

@push('styles')
<style>
.dataTables_filter input { width: 220px; }
</style>
@endpush

@section('content')
{{-- Konten daftar materi --}}
<div class="container-fluid">
    {{-- Notifikasi sukses --}}
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    {{-- Kartu daftar materi --}}
    <div class="card">
        {{-- Header kartu dengan tombol tambah --}}
        <div class="card-header">
            <h3 class="card-title">Daftar Materi</h3>
            <div class="card-tools">
                <a href="{{ route('dashboard.materi.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-lg"></i> Tambah Materi
                </a>
            </div>
        </div>
        <div class="card-body">
            {{-- Tabel daftar materi --}}
            <table id="materiTable" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Guru</th>
                        <th>Tingkat</th>
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
                        <td>{{ $materi->tingkatKesulitan->nama_tingkat ?? '-' }}</td>
                        <td>{{ $materi->kategori->nama_kategori ?? '-' }}</td>
                        {{-- Status publish/draft --}}
                        <td>
                            @if ($materi->is_published)
                            <span class="badge bg-success">Published</span>
                            @else
                            <span class="badge bg-secondary">Draft</span>
                            @endif
                        </td>
                        {{-- Tombol aksi lihat, edit, dan hapus --}}
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('dashboard.materi.show', $materi) }}" class="btn btn-info" title="Lihat">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('dashboard.materi.edit', $materi) }}" class="btn btn-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('dashboard.materi.destroy', $materi) }}" method="post" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus materi ini?')">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    {{-- State kosong --}}
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
{{-- Inisialisasi DataTable --}}
@push('scripts')
<script>
$(document).ready(function() {
    $('#materiTable').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        responsive: true,
        lengthChange: true,
        autoWidth: false,
        pageLength: 10,
        language: { url: '//cdn.datatables.net/plug-ins/1.13.11/i18n/id.json' },
        columnDefs: [{ orderable: false, targets: 6 }]
    });
});
</script>
@endpush
@endsection
