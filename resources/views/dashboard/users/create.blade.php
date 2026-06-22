@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Tambah User Baru</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('dashboard.users.store') }}" method="post">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" name="name" id="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}">
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password"
                        class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select name="role" id="role"
                        class="form-select @error('role') is-invalid @enderror">
                        <option value="">-- Pilih Role --</option>
                        <option value="admin" @selected(old('role')=='admin')>Admin</option>
                        <option value="guru" @selected(old('role')=='guru')>Guru</option>
                        <option value="siswa" @selected(old('role')=='siswa')>Siswa</option>
                    </select>
                    @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('dashboard.users.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
