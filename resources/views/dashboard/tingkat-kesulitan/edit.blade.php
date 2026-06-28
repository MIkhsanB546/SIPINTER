@extends('layouts.app')

@section('title', 'Edit Tingkat Kesulitan')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Edit Tingkat Kesulitan</h5>
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
                    <form action="{{ route('dashboard.tingkat-kesulitan.update', $tingkatKesulitan->id_tingkat) }}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nama_tingkat" class="form-label">Nama Tingkat Kesulitan <span class="text-danger">*</span></label>
                            <input type="text" name="nama_tingkat" id="nama_tingkat" class="form-control @error('nama_tingkat') is-invalid @enderror" value="{{ old('nama_tingkat', $tingkatKesulitan->nama_tingkat) }}" maxlength="50" required>
                            @error('nama_tingkat')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Simpan
                            </button>
                            <a href="{{ route('dashboard.tingkat-kesulitan.index') }}" class="btn btn-outline-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
