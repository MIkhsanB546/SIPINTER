@extends('layouts.app')

@section('title', 'Kelola Tingkat Kesulitan')

@push('styles')
<style>
.dataTables_filter input { width: 220px; }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Tingkat Kesulitan</h3>
                    <div class="card-tools">
                        <a href="{{ route('dashboard.tingkat-kesulitan.create') }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-plus-lg"></i> Tambah Tingkat Kesulitan
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="tingkatTable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Tingkat</th>
                                <th>Jumlah Materi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tingkatList as $tingkat)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $tingkat->nama_tingkat }}</td>
                                <td>{{ $tingkat->materi_count ?? $tingkat->materi->count() }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('dashboard.tingkat-kesulitan.edit', $tingkat->id_tingkat) }}" class="btn btn-warning" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('dashboard.tingkat-kesulitan.destroy', $tingkat->id_tingkat) }}" method="post" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus tingkat kesulitan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-3">Belum ada tingkat kesulitan</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
$(document).ready(function() {
    $('#tingkatTable').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        responsive: true,
        lengthChange: true,
        autoWidth: false,
        pageLength: 10,
        language: { url: '//cdn.datatables.net/plug-ins/1.13.11/i18n/id.json' },
        columnDefs: [{ orderable: false, targets: 3 }]
    });
});
</script>
@endpush
@endsection
