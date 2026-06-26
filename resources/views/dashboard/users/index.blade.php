@extends('layouts.app')

@section('title', 'Kelola User')

@section('content')
<div class="container-fluid">
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Daftar User</h5>
            <div class="card-tools">
                <a href="{{ route('dashboard.users.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-lg"></i> Tambah User
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                        <table id="usersTable" class="table table-hover mb-0">
                    <thead class="table-light">
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
                            <td>
                                @php
                                $badgeClass = match ($user->role) {
                                'admin' => 'bg-danger',
                                'guru' => 'bg-primary',
                                'siswa' => 'bg-success',
                                default => 'bg-secondary',
                                };
                                @endphp
                                <span class="badge {{ $badgeClass }}">{{ ucfirst($user->role) }}</span>
                            </td>
                            <td>
                                <a href="{{ route('dashboard.users.edit', $user) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('dashboard.users.destroy', $user) }}" method="post"
                                    class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus user ini?')">
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
                            <td colspan="5" class="text-center text-muted py-4">Belum ada user</td>
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
    $('#usersTable').DataTable({
        responsive: true,
        pageLength: 10,
        language: { url: '//cdn.datatables.net/plug-ins/1.13.11/i18n/id.json' },
        columnDefs: [{ orderable: false, targets: 4 }]
    });
});
</script>
@endpush
@endsection
