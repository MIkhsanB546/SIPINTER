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
                    <div class="d-flex gap-2 mb-2">
                        <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi') }}</textarea>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <button type="button" id="btnGenerateRingkasan" class="btn btn-info btn-sm" onclick="generateRingkasan()">
                            <i class="bi bi-magic"></i> Generate Ringkasan AI
                        </button>
                        <div id="loadingRingkasan" class="spinner-border spinner-border-sm text-info d-none" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <small class="text-muted">AI akan membuat ringkasan berdasarkan file PDF.</small>
                    </div>
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

                <div class="mb-3">
                    <div class="d-flex align-items-center gap-2">
                        <button type="button" id="btnGenerateQuiz" class="btn btn-info btn-sm" onclick="openQuizModal()">
                            <i class="bi bi-magic"></i> Generate Quiz AI
                        </button>
                        <div id="loadingQuiz" class="spinner-border spinner-border-sm text-info d-none" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <small class="text-muted">AI akan membuat quiz berdasarkan file PDF.</small>
                    </div>
                </div>

                <input type="hidden" name="quiz_data" id="quiz_data" value="{{ old('quiz_data', '') }}">

                <div id="quizSection" class="card card-outline card-info mt-3" style="display:none;">
                    <div class="card-header">
                        <h5 class="card-title">Quiz Builder</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Judul Quiz</label>
                                <input type="text" id="quiz_judul" class="form-control" placeholder="Judul Quiz" onchange="updateQuizData()">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Durasi (menit)</label>
                                <input type="number" id="quiz_durasi" class="form-control" placeholder="30" min="1" onchange="updateQuizData()">
                            </div>
                        </div>

                        <div id="soalContainer"></div>

                        <button type="button" class="btn btn-sm btn-success mt-2" onclick="tambahSoal()">
                            <i class="bi bi-plus-lg"></i> Tambah Soal
                        </button>
                    </div>
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

<div class="modal fade" id="quizPromptModal" tabindex="-1" aria-labelledby="quizPromptModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="quizPromptModalLabel">Generate Quiz dengan AI</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-muted">Berikan instruksi tambahan kepada AI agar soal yang dihasilkan lebih sesuai dengan kebutuhan pembelajaran. Kolom ini bersifat opsional.</p>
                <div class="mb-3">
                    <label for="user_prompt" class="form-label">Instruksi Tambahan (Opsional)</label>
                    <textarea id="user_prompt" class="form-control" rows="4" placeholder="Contoh:&#10;Buat 10 soal pilihan ganda&#10;Fokus pada Bab 3&#10;Tingkat kesulitan sedang&#10;Jangan membuat soal definisi&#10;Sertakan soal studi kasus&#10;Prioritaskan materi jaringan komputer&#10;Buat soal HOTS&#10;Hindari soal yang terlalu mudah"></textarea>
                </div>
                <div class="d-flex flex-wrap gap-1">
                    <span class="badge border text-secondary px-2 py-1" style="cursor:pointer;background:#f0f0f0;" onclick="insertExample(this)">✓ Buat 20 soal</span>
                    <span class="badge border text-secondary px-2 py-1" style="cursor:pointer;background:#f0f0f0;" onclick="insertExample(this)">✓ Fokus pada Bab 4</span>
                    <span class="badge border text-secondary px-2 py-1" style="cursor:pointer;background:#f0f0f0;" onclick="insertExample(this)">✓ Tingkat kesulitan mudah</span>
                    <span class="badge border text-secondary px-2 py-1" style="cursor:pointer;background:#f0f0f0;" onclick="insertExample(this)">✓ Tingkat kesulitan sulit</span>
                    <span class="badge border text-secondary px-2 py-1" style="cursor:pointer;background:#f0f0f0;" onclick="insertExample(this)">✓ Jangan membuat soal definisi</span>
                    <span class="badge border text-secondary px-2 py-1" style="cursor:pointer;background:#f0f0f0;" onclick="insertExample(this)">✓ Sertakan soal analisis</span>
                    <span class="badge border text-secondary px-2 py-1" style="cursor:pointer;background:#f0f0f0;" onclick="insertExample(this)">✓ Buat soal berdasarkan studi kasus</span>
                    <span class="badge border text-secondary px-2 py-1" style="cursor:pointer;background:#f0f0f0;" onclick="insertExample(this)">✓ Fokus pada materi VLAN</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-info" onclick="submitGenerateQuiz()">
                    <i class="bi bi-magic"></i> Generate
                </button>
            </div>
        </div>
    </div>
</div>

<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="aiToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">AI Generate</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body"></div>
    </div>
</div>
@endsection

@push('scripts')
<script>
let soalCounter = 0;

function getPdfFormData() {
    const formData = new FormData();
    const fileInput = document.getElementById('file_materi');
    if (fileInput.files.length > 0) {
        formData.append('file', fileInput.files[0]);
    } else {
        showToast('error', 'Silakan upload file PDF terlebih dahulu.');
        return null;
    }
    return formData;
}

async function generateRingkasan() {
    const formData = getPdfFormData();
    if (!formData) return;

    const btn = document.getElementById('btnGenerateRingkasan');
    const loading = document.getElementById('loadingRingkasan');
    btn.disabled = true;
    loading.classList.remove('d-none');

    try {
        const response = await fetch('{{ route("dashboard.materi.ai.summarize") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
            body: formData,
        });

        const result = await response.json();

        if (result.success) {
            document.getElementById('deskripsi').value = result.data;
            showToast('success', 'Ringkasan berhasil dibuat.');
        } else {
            showToast('error', result.message || 'Gagal membuat ringkasan.');
        }
    } catch (error) {
        showToast('error', 'Terjadi kesalahan jaringan. Silakan coba lagi.');
    } finally {
        btn.disabled = false;
        loading.classList.add('d-none');
    }
}

function openQuizModal() {
    const formData = getPdfFormData();
    if (!formData) return;

    document.getElementById('user_prompt').value = '';
    const modal = new bootstrap.Modal(document.getElementById('quizPromptModal'));
    modal.show();
}

async function submitGenerateQuiz() {
    const formData = getPdfFormData();
    if (!formData) return;

    const userPrompt = document.getElementById('user_prompt').value.trim();
    if (userPrompt) {
        formData.append('user_prompt', userPrompt);
    }

    const modalEl = document.getElementById('quizPromptModal');
    const modal = bootstrap.Modal.getInstance(modalEl);
    if (modal) modal.hide();

    const btn = document.getElementById('btnGenerateQuiz');
    const loading = document.getElementById('loadingQuiz');
    btn.disabled = true;
    loading.classList.remove('d-none');

    try {
        const response = await fetch('{{ route("dashboard.materi.ai.generate-quiz") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
            body: formData,
        });

        const result = await response.json();

        if (result.success) {
            const soalList = result.data.map((item, index) => ({
                pertanyaan: item.question,
                options: item.options,
                jawaban_benar: item.correct_answer,
                penjelasan: item.explanation || '',
            }));

            const quizData = {
                judul: 'Quiz ' + (document.getElementById('judul').value || 'Materi'),
                durasi_menit: 30,
                deskripsi: '',
                soal: soalList,
            };

            document.getElementById('quiz_data').value = JSON.stringify(quizData);
            renderQuiz(quizData);
            document.getElementById('quizSection').style.display = 'block';
            showToast('success', 'Quiz berhasil dibuat. Silakan edit jika diperlukan.');
        } else {
            showToast('error', result.message || 'Gagal membuat quiz.');
        }
    } catch (error) {
        showToast('error', 'Terjadi kesalahan jaringan. Silakan coba lagi.');
    } finally {
        btn.disabled = false;
        loading.classList.add('d-none');
    }
}

function insertExample(el) {
    const text = el.textContent.replace(/^✓\s*/, '').trim();
    const textarea = document.getElementById('user_prompt');
    textarea.value = textarea.value ? textarea.value + '\n' + text : text;
}

function renderQuiz(quizData) {
    if (quizData.judul) document.getElementById('quiz_judul').value = quizData.judul;
    if (quizData.durasi_menit) document.getElementById('quiz_durasi').value = quizData.durasi_menit;

    const container = document.getElementById('soalContainer');
    container.innerHTML = '';
    soalCounter = 0;

    if (quizData.soal && quizData.soal.length > 0) {
        quizData.soal.forEach((soal, index) => {
            tambahSoal(soal);
        });
    }
}

function tambahSoal(data) {
    const index = soalCounter++;
    const container = document.getElementById('soalContainer');

    const soalDiv = document.createElement('div');
    soalDiv.className = 'card card-outline card-secondary mt-2 soal-item';
    soalDiv.dataset.index = index;

    const pertanyaan = data ? data.pertanyaan : '';
    const options = data ? data.options : ['', '', '', ''];
    const jawabanBenar = data ? data.jawaban_benar : 0;
    const penjelasan = data ? data.penjelasan : '';

    let pilihanHtml = '';
    const labels = ['A', 'B', 'C', 'D'];
    options.forEach((opt, optIdx) => {
        pilihanHtml += `
            <div class="input-group mb-1">
                <div class="input-group-text">
                    <input type="radio" name="jawaban_benar_${index}" value="${optIdx}" ${optIdx === jawabanBenar ? 'checked' : ''} onchange="updateQuizData()">
                </div>
                <span class="input-group-text">${labels[optIdx]}</span>
                <input type="text" class="form-control soal-pilihan" value="${escapeHtml(opt)}" placeholder="Pilihan ${labels[optIdx]}" onchange="updateQuizData()">
            </div>`;
    });

    soalDiv.innerHTML = `
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h6 class="mb-0">Soal ${index + 1}</h6>
                <button type="button" class="btn btn-sm btn-danger" onclick="hapusSoal(this)">
                    <i class="bi bi-trash"></i> Hapus
                </button>
            </div>
            <div class="mb-2">
                <textarea class="form-control soal-pertanyaan" rows="2" placeholder="Pertanyaan" onchange="updateQuizData()">${escapeHtml(pertanyaan)}</textarea>
            </div>
            ${pilihanHtml}
            <div class="mt-2">
                <small class="text-muted">Penjelasan:</small>
                <input type="text" class="form-control form-control-sm soal-penjelasan" value="${escapeHtml(penjelasan)}" placeholder="Penjelasan jawaban (opsional)" onchange="updateQuizData()">
            </div>
        </div>`;

    container.appendChild(soalDiv);
    updateQuizData();
}

function hapusSoal(btn) {
    const soalItem = btn.closest('.soal-item');
    soalItem.remove();
    updateQuizData();
    renumberSoal();
}

function renumberSoal() {
    const items = document.querySelectorAll('.soal-item');
    items.forEach((item, idx) => {
        item.querySelector('h6').textContent = 'Soal ' + (idx + 1);
    });
}

function updateQuizData() {
    const quizData = {
        judul: document.getElementById('quiz_judul').value,
        durasi_menit: parseInt(document.getElementById('quiz_durasi').value) || null,
        deskripsi: '',
        soal: [],
    };

    document.querySelectorAll('.soal-item').forEach((item) => {
        const pertanyaan = item.querySelector('.soal-pertanyaan').value;
        const jawabanBenar = item.querySelector('input[type="radio"]:checked');
        const pilihanInputs = item.querySelectorAll('.soal-pilihan');
        const penjelasan = item.querySelector('.soal-penjelasan').value;

        const options = [];
        pilihanInputs.forEach((input) => {
            options.push(input.value);
        });

        quizData.soal.push({
            pertanyaan: pertanyaan,
            options: options,
            jawaban_benar: jawabanBenar ? parseInt(jawabanBenar.value) : 0,
            penjelasan: penjelasan,
        });
    });

    document.getElementById('quiz_data').value = JSON.stringify(quizData);
}

function escapeHtml(text) {
    if (!text) return '';
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

function showToast(type, message) {
    const toast = document.getElementById('aiToast');
    const header = toast.querySelector('.toast-header strong');
    const body = toast.querySelector('.toast-body');

    if (type === 'success') {
        header.textContent = 'Berhasil';
        toast.classList.remove('text-bg-danger');
        toast.classList.add('text-bg-success');
    } else {
        header.textContent = 'Gagal';
        toast.classList.remove('text-bg-success');
        toast.classList.add('text-bg-danger');
    }

    body.textContent = message;
    const bsToast = new bootstrap.Toast(toast);
    bsToast.show();
}

document.addEventListener('DOMContentLoaded', function () {
    const oldData = document.getElementById('quiz_data').value;
    if (oldData) {
        try {
            const parsed = JSON.parse(oldData);
            if (parsed.soal && parsed.soal.length > 0) {
                renderQuiz(parsed);
                document.getElementById('quizSection').style.display = 'block';
            }
        } catch (e) {}
    }
});
</script>
@endpush
