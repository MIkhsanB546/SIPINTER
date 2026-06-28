@extends('layouts.app')

@section('title', 'Tambah Materi')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Tambah Materi Baru</h5>
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
            <form action="{{ route('dashboard.materi.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul <span class="text-danger">*</span></label>
                    <input type="text" name="judul" id="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}">
                    @error('judul')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="id_tingkat" class="form-label">Tingkat Kesulitan <span class="text-danger">*</span></label>
                    <select name="id_tingkat" id="id_tingkat" class="form-select @error('id_tingkat') is-invalid @enderror">
                        <option value="">-- Pilih Tingkat --</option>
                        @foreach ($tingkatList as $tingkat)
                        <option value="{{ $tingkat->id_tingkat }}" {{ old('id_tingkat') == $tingkat->id_tingkat ? 'selected' : '' }}>
                            {{ $tingkat->nama_tingkat }}
                        </option>
                        @endforeach
                    </select>
                    @error('id_tingkat')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="id_kategori_materi" class="form-label">Kategori <span class="text-danger">*</span></label>
                    <select name="id_kategori_materi" id="id_kategori_materi" class="form-select @error('id_kategori_materi') is-invalid @enderror">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategoriList as $kategori)
                        <option value="{{ $kategori->id_kategori_materi }}" {{ old('id_kategori_materi') == $kategori->id_kategori_materi ? 'selected' : '' }}>
                            {{ $kategori->nama_kategori }}
                        </option>
                        @endforeach
                    </select>
                    @error('id_kategori_materi')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="file_materi" class="form-label">File Materi</label>
                    <input type="file" name="file_materi" id="file_materi" class="form-control @error('file_materi') is-invalid @enderror" accept=".pdf,.docx,.pptx">
                    @error('file_materi')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="thumbnail" class="form-label">Thumbnail</label>
                    <input type="file" name="thumbnail" id="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror" accept="image/*">
                    @error('thumbnail')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 form-check">
                    <input type="hidden" name="is_published" value="0">
                    <input type="checkbox" name="is_published" id="is_published" class="form-check-input @error('is_published') is-invalid @enderror" value="1" {{ old('is_published') ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_published">Published</label>
                    @error('is_published')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('dashboard.materi.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
