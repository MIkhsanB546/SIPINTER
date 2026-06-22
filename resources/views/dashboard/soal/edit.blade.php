@extends('layouts.app')

@section('title', 'Edit Soal')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Edit Soal - {{ $quiz->judul }}</h5>
            <a href="{{ route('dashboard.quiz.soal.index', $quiz) }}" class="btn btn-secondary btn-sm">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('dashboard.quiz.soal.update', [$quiz, $soal]) }}" method="post">
                @csrf
                @method('put')

                <div class="mb-3">
                    <label for="pertanyaan" class="form-label">Pertanyaan</label>
                    <textarea name="pertanyaan" id="pertanyaan" rows="3"
                        class="form-control @error('pertanyaan') is-invalid @enderror">{{ old('pertanyaan', $soal->pertanyaan) }}</textarea>
                    @error('pertanyaan')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Pilihan Jawaban</label>
                    <div id="pilihanContainer">
                        @foreach ($soal->pilihanJawabans as $pilihan)
                        <div class="input-group mb-2">
                            <div class="input-group-text">
                                <input type="radio" name="jawaban_benar" value="{{ $loop->index }}"
                                    class="form-check-input mt-0"
                                    @checked(old('jawaban_benar', $pilihan->is_correct ? $loop->index : null) == $loop->index)>
                            </div>
                            <input type="text"
                                name="pilihan_jawaban[{{ $loop->index }}][jawaban]"
                                class="form-control @error('pilihan_jawaban.' . $loop->index . '.jawaban') is-invalid @enderror"
                                placeholder="Pilihan {{ chr(65 + $loop->index) }}"
                                value="{{ old('pilihan_jawaban.' . $loop->index . '.jawaban', $pilihan->jawaban) }}">
                        </div>
                        @endforeach
                    </div>
                    <div class="form-text">Pilih radio untuk menandai jawaban yang benar.</div>
                    @error('jawaban_benar')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                    @error('pilihan_jawaban')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ route('dashboard.quiz.soal.index', $quiz) }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
