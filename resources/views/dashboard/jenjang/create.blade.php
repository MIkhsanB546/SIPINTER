@extends('layouts.app')

@section('title', 'Tambah Jenjang')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Tambah Jenjang</h5>
                </div>
                <div class="card-body">
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{ route('dashboard.jenjang.store') }}" method="post">
                        @csrf

                        <div class="mb-3">
                            <label for="nama_jenjang" class="form-label">Nama Jenjang <span class="text-danger">*</span></label>
                            <input type="text" name="nama_jenjang" id="nama_jenjang" class="form-control @error('nama_jenjang') is-invalid @enderror" value="{{ old('nama_jenjang') }}" maxlength="50" required>
                            @error('nama_jenjang')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Simpan
                            </button>
                            <a href="{{ route('dashboard.jenjang.index') }}" class="btn btn-outline-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
