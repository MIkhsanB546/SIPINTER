@extends('layouts.app')

@section('title', 'Kelola User')

@push('styles')
<style>
.dataTables_filter input { width: 220px; }
</style>
@endpush

@section('content')
{{-- Konten daftar user --}}
<div class="container-fluid">
    {{-- Notifikasi sukses --}}
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    {{-- Notifikasi error --}}
    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    {{-- Kartu daftar user --}}
    <div class="card">
        {{-- Header kartu dengan tombol tambah --}}
        <div class="card-header">
            <h3 class="card-title">Daftar User</h3>
            <div class="card-tools">
                <a href="{{ route('dashboard.users.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-lg"></i> Tambah User
                </a>
            </div>
        </div>
        <div class="card-body">
            {{-- Tabel daftar user --}}
            <table id="usersTable" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        {{-- Badge role dengan warna sesuai role --}}
                        <td>
                            @php
                            $badgeClass = match ($user->role) {
                            'admin' => 'bg-danger',
                            'guru' => 'bg-primary',
                            'siswa' => 'bg-success',
                            'orang_tua' => 'bg-info',
                            default => 'bg-secondary',
                            };
                            @endphp
                            <span class="badge {{ $badgeClass }}">{{ ucfirst($user->role) }}</span>
                        </td>
                        {{-- Tombol aksi edit dan hapus --}}
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('dashboard.users.edit', $user) }}" class="btn btn-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('dashboard.users.destroy', $user) }}" method="post"
                                    class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus user ini?')">
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
                        <td colspan="5" class="text-center text-muted py-4">Belum ada user</td>
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
    $('#usersTable').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        responsive: true,
        lengthChange: true,
        autoWidth: false,
        pageLength: 10,
        language: { url: '//cdn.datatables.net/plug-ins/1.13.11/i18n/id.json' },
        columnDefs: [{ orderable: false, targets: 4 }]
    });
});
</script>
@endpush
@endsection
