<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMateriRequest;
use App\Http\Requests\UpdateMateriRequest;
use App\Models\Materi;
use App\Models\Quiz;
use App\Models\Soal;
use App\Models\PilihanJawaban;
use App\Models\TingkatKesulitan;
use App\Models\KategoriMateri;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $materiList = Materi::with(['guru', 'tingkatKesulitan', 'kategori'])->latest()->get();
        } else {
            $materiList = Materi::with(['guru', 'tingkatKesulitan', 'kategori'])
                ->where('id_guru', $user->id_user)
                ->latest()
                ->get();
        }

        return view('dashboard.materi.index', compact('materiList'));
    }

    public function create()
    {
        $tingkatList = TingkatKesulitan::all();
        $kategoriList = KategoriMateri::all();
        return view('dashboard.materi.create', compact('tingkatList', 'kategoriList'));
    }

    public function store(StoreMateriRequest $request)
    {
        $data = $request->validated();
        $data['id_guru'] = Auth::id();

        if ($request->hasFile('file_materi')) {
            $data['file_materi'] = $request->file('file_materi')->store('materi/files', 'public');
        }

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('materi/thumbnails', 'public');
        }

        $data['is_published'] = $request->boolean('is_published');

        $materi = Materi::create($data);

        $this->saveQuizData($materi, $request->input('quiz_data'));

        return redirect()->route('dashboard.materi.index')
            ->with('success', 'Materi berhasil dibuat.');
    }

    public function show(Materi $materi)
    {
        $this->authorize('view', $materi);
        $materi->load(['guru', 'tingkatKesulitan', 'kategori']);
        return view('dashboard.materi.show', compact('materi'));
    }

    public function edit(Materi $materi)
    {
        $this->authorize('update', $materi);
        $tingkatList = TingkatKesulitan::all();
        $kategoriList = KategoriMateri::all();
        $materi->load('quiz.soal.pilihanJawaban');
        return view('dashboard.materi.edit', compact('materi', 'tingkatList', 'kategoriList'));
    }

    public function update(UpdateMateriRequest $request, Materi $materi)
    {
        $this->authorize('update', $materi);

        $data = $request->validated();

        if ($request->hasFile('file_materi')) {
            if ($materi->file_materi) {
                Storage::disk('public')->delete($materi->file_materi);
            }
            $data['file_materi'] = $request->file('file_materi')->store('materi/files', 'public');
        }

        if ($request->hasFile('thumbnail')) {
            if ($materi->thumbnail) {
                Storage::disk('public')->delete($materi->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('materi/thumbnails', 'public');
        }

        $data['is_published'] = $request->boolean('is_published');

        $materi->update($data);

        $this->saveQuizData($materi, $request->input('quiz_data'));

        return redirect()->route('dashboard.materi.index')
            ->with('success', 'Materi berhasil diperbarui.');
    }

    protected function saveQuizData(Materi $materi, ?string $quizDataJson): void
    {
        if (empty($quizDataJson)) {
            return;
        }

        $quizData = json_decode($quizDataJson, true);

        if (json_last_error() !== JSON_ERROR_NONE || empty($quizData)) {
            return;
        }

        $existingQuiz = $materi->quiz()->first();

        if ($existingQuiz) {
            $existingQuiz->update([
                'judul' => $quizData['judul'] ?? $existingQuiz->judul,
                'deskripsi' => $quizData['deskripsi'] ?? null,
                'durasi_menit' => $quizData['durasi_menit'] ?? null,
            ]);
            $quiz = $existingQuiz;
        } else {
            $quiz = Quiz::create([
                'id_materi' => $materi->id_materi,
                'judul' => $quizData['judul'] ?? 'Quiz ' . $materi->judul,
                'deskripsi' => $quizData['deskripsi'] ?? null,
                'durasi_menit' => $quizData['durasi_menit'] ?? null,
            ]);
        }

        if (isset($quizData['soal']) && is_array($quizData['soal'])) {
            $quiz->soal()->delete();

            foreach ($quizData['soal'] as $soalItem) {
                $soal = Soal::create([
                    'id_quiz' => $quiz->id_quiz,
                    'pertanyaan' => $soalItem['pertanyaan'],
                ]);

                $jawabanBenar = (int) ($soalItem['jawaban_benar'] ?? 0);
                $options = $soalItem['options'] ?? $soalItem['pilihan'] ?? [];

                foreach ($options as $index => $option) {
                    $jawaban = is_array($option) ? ($option['jawaban'] ?? '') : $option;

                    PilihanJawaban::create([
                        'id_soal' => $soal->id_soal,
                        'jawaban' => $jawaban,
                        'is_correct' => $index === $jawabanBenar,
                    ]);
                }
            }
        }
    }

    public function destroy(Materi $materi)
    {
        $this->authorize('delete', $materi);

        if ($materi->file_materi) {
            Storage::disk('public')->delete($materi->file_materi);
        }
        if ($materi->thumbnail) {
            Storage::disk('public')->delete($materi->thumbnail);
        }

        $materi->delete();

        return redirect()->route('dashboard.materi.index')
            ->with('success', 'Materi berhasil dihapus.');
    }
}
