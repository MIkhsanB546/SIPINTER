@extends('layouts.app')

@section('title', 'Tambah Quiz')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Tambah Quiz Baru</h5>
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
            <form action="{{ route('dashboard.quiz.store') }}" method="post">
                @csrf

                <div class="mb-3">
                    <label for="id_materi" class="form-label">Materi</label>
                    <select name="id_materi" id="id_materi"
                        class="form-select @error('id_materi') is-invalid @enderror">
                        <option value="">-- Pilih Materi --</option>
                        @foreach ($materiList as $materi)
                        <option value="{{ $materi->id_materi }}" @selected(old('id_materi')==$materi->id_materi)>
                            {{ $materi->judul }}
                        </option>
                        @endforeach
                    </select>
                    @error('id_materi')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" name="judul" id="judul"
                        class="form-control @error('judul') is-invalid @enderror"
                        value="{{ old('judul') }}">
                    @error('judul')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" rows="3"
                        class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="durasi_menit" class="form-label">Durasi (menit)</label>
                    <input type="number" name="durasi_menit" id="durasi_menit"
                        class="form-control @error('durasi_menit') is-invalid @enderror"
                        value="{{ old('durasi_menit') }}" min="1" max="999">
                    @error('durasi_menit')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('dashboard.quiz.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
