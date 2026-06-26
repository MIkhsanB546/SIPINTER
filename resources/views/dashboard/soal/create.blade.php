@extends('layouts.app')

@section('title', 'Tambah Soal')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Tambah Soal - {{ $quiz->judul }}</h5>
            <a href="{{ route('dashboard.quiz.soal.index', $quiz) }}" class="btn btn-secondary btn-sm">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
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
            <form action="{{ route('dashboard.quiz.soal.store', $quiz) }}" method="post">
                @csrf

                <div class="mb-3">
                    <label for="pertanyaan" class="form-label">Pertanyaan</label>
                    <textarea name="pertanyaan" id="pertanyaan" rows="3"
                        class="form-control @error('pertanyaan') is-invalid @enderror">{{ old('pertanyaan') }}</textarea>
                    @error('pertanyaan')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Pilihan Jawaban</label>
                    <div id="pilihanContainer">
                        @for ($i = 0; $i < 4; $i++)
                        <div class="input-group mb-2">
                            <div class="input-group-text">
                                <input type="radio" name="jawaban_benar" value="{{ $i }}"
                                    class="form-check-input mt-0"
                                    @checked(old('jawaban_benar') == $i || ($i === 0 && !old('jawaban_benar')))>
                            </div>
                            <input type="text" name="pilihan_jawaban[{{ $i }}][jawaban]"
                                class="form-control @error('pilihan_jawaban.' . $i . '.jawaban') is-invalid @enderror"
                                placeholder="Pilihan {{ chr(65 + $i) }}"
                                value="{{ old('pilihan_jawaban.' . $i . '.jawaban') }}">
                        </div>
                        @endfor
                    </div>
                    <div class="form-text">Pilih radio untuk menandai jawaban yang benar.</div>
                    @error('jawaban_benar')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                    @error('pilihan_jawaban')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('dashboard.quiz.soal.index', $quiz) }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
