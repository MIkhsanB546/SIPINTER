@extends('layouts.app')

@section('title', 'Profil')

@section('content')
<div class="container-fluid">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-4">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <i class="bi bi-person-circle" style="font-size: 5rem; color: #6c757d;"></i>
                    </div>

                    <h3 class="profile-username text-center">{{ $user->name }}</h3>

                    <p class="text-center">
                        @php
                            $badgeClass = match ($user->role) {
                                'admin' => 'bg-danger',
                                'guru' => 'bg-primary',
                                default => 'bg-secondary',
                            };
                        @endphp
                        <span class="badge {{ $badgeClass }} text-capitalize">{{ $user->role }}</span>
                    </p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <i class="bi bi-envelope me-2"></i>
                            <b>Email</b>
                            <span class="float-end">{{ $user->email }}</span>
                        </li>
                        <li class="list-group-item">
                            <i class="bi bi-calendar me-2"></i>
                            <b>Bergabung</b>
                            <span class="float-end">{{ $user->created_at->translatedFormat('d F Y') }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link active" href="#profil" data-bs-toggle="tab">
                                <i class="bi bi-person me-1"></i> Profil
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#pengaturan" data-bs-toggle="tab">
                                <i class="bi bi-gear me-1"></i> Pengaturan
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="profil">
                            <table class="table table-borderless mb-0">
                                <tr>
                                    <th style="width: 150px;">Nama</th>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th>Role</th>
                                    <td>
                                        @php
                                            $badgeClass = match ($user->role) {
                                                'admin' => 'bg-danger',
                                                'guru' => 'bg-primary',
                                                default => 'bg-secondary',
                                            };
                                        @endphp
                                        <span class="badge {{ $badgeClass }} text-capitalize">{{ $user->role }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tanggal Bergabung</th>
                                    <td>{{ $user->created_at->translatedFormat('d F Y') }}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="tab-pane" id="pengaturan">
                            <form action="{{ route('dashboard.profile.update') }}" method="post">
                                @csrf
                                @method('put')

                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" name="name" id="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', $user->name) }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" id="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email', $user->email) }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <hr>

                                <div class="form-group mb-3">
                                    <label for="password" class="form-label">Password Baru <span class="text-muted">(opsional)</span></label>
                                    <input type="password" name="password" id="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Kosongkan jika tidak ingin mengubah password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        class="form-control"
                                        placeholder="Ulangi password baru">
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-lg me-1"></i> Simpan Perubahan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
