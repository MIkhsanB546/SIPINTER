@extends('layouts.app')

@section('title', 'Kelola Jenjang')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Daftar Jenjang</h5>
                    <div class="card-tools">
                        <a href="{{ route('dashboard.jenjang.create') }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-plus-lg"></i> Tambah Jenjang
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="jenjangTable" class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Jenjang</th>
                                    <th>Jumlah Materi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($jenjangList as $jenjang)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $jenjang->nama_jenjang }}</td>
                                    <td>{{ $jenjang->materi_count ?? $jenjang->materi->count() }}</td>
                                    <td class="text-nowrap">
                                        <a href="{{ route('dashboard.jenjang.edit', $jenjang->id_jenjang) }}" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <form action="{{ route('dashboard.jenjang.destroy', $jenjang->id_jenjang) }}" method="post" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus jenjang ini?')">
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
                                    <td colspan="4" class="text-center text-muted py-3">Belum ada jenjang</td>
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
@push('scripts')
<script>
$(document).ready(function() {
    $('#jenjangTable').DataTable({
        responsive: true,
        pageLength: 10,
        language: { url: '//cdn.datatables.net/plug-ins/1.13.11/i18n/id.json' },
        columnDefs: [{ orderable: false, targets: 3 }]
    });
});
</script>
@endpush
@endsection
