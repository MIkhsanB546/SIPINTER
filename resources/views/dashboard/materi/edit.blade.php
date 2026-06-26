@extends('layouts.app')

@section('title', 'Edit Materi')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Edit Materi</h5>
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
            <form action="{{ route('dashboard.materi.update', $materi) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul <span class="text-danger">*</span></label>
                    <input type="text" name="judul" id="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul', $materi->judul) }}">
                    @error('judul')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="id_jenjang" class="form-label">Jenjang <span class="text-danger">*</span></label>
                    <select name="id_jenjang" id="id_jenjang" class="form-select @error('id_jenjang') is-invalid @enderror">
                        <option value="">-- Pilih Jenjang --</option>
                        @foreach ($jenjangList as $jenjang)
                        <option value="{{ $jenjang->id_jenjang }}" {{ old('id_jenjang', $materi->id_jenjang) == $jenjang->id_jenjang ? 'selected' : '' }}>
                            {{ $jenjang->nama_jenjang }}
                        </option>
                        @endforeach
                    </select>
                    @error('id_jenjang')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="id_kategori_materi" class="form-label">Kategori <span class="text-danger">*</span></label>
                    <select name="id_kategori_materi" id="id_kategori_materi" class="form-select @error('id_kategori_materi') is-invalid @enderror">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategoriList as $kategori)
                        <option value="{{ $kategori->id_kategori_materi }}" {{ old('id_kategori_materi', $materi->id_kategori_materi) == $kategori->id_kategori_materi ? 'selected' : '' }}>
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
                    <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $materi->deskripsi) }}</textarea>
                    @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="file_materi" class="form-label">File Materi</label>
                    @if ($materi->file_materi)
                    <div class="mb-2">
                        <small class="text-muted">File saat ini: {{ basename($materi->file_materi) }}</small>
                    </div>
                    @endif
                    <input type="file" name="file_materi" id="file_materi" class="form-control @error('file_materi') is-invalid @enderror" accept=".pdf,.docx,.pptx">
                    <small class="text-muted">Kosongkan jika tidak ingin mengubah file.</small>
                    @error('file_materi')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="thumbnail" class="form-label">Thumbnail</label>
                    @if ($materi->thumbnail)
                    <div class="mb-2">
                        <small class="text-muted">Thumbnail saat ini: {{ basename($materi->thumbnail) }}</small>
                    </div>
                    @endif
                    <input type="file" name="thumbnail" id="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror" accept="image/*">
                    <small class="text-muted">Kosongkan jika tidak ingin mengubah thumbnail.</small>
                    @error('thumbnail')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 form-check">
                    <input type="hidden" name="is_published" value="0">
                    <input type="checkbox" name="is_published" id="is_published" class="form-check-input @error('is_published') is-invalid @enderror" value="1" {{ old('is_published', $materi->is_published) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_published">Published</label>
                    @error('is_published')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('dashboard.materi.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
