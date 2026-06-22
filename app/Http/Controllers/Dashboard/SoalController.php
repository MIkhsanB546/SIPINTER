<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSoalRequest;
use App\Models\Soal;
use App\Models\Quiz;
use App\Models\PilihanJawaban;

class SoalController extends Controller
{
    public function index(Quiz $quiz)
    {
        $this->authorize('view', $quiz);
        $quiz->load('soals.pilihanJawabans');
        return view('dashboard.soal.index', compact('quiz'));
    }

    public function create(Quiz $quiz)
    {
        $this->authorize('update', $quiz);
        return view('dashboard.soal.create', compact('quiz'));
    }

    public function store(StoreSoalRequest $request, Quiz $quiz)
    {
        $this->authorize('update', $quiz);

        $data = $request->validated();

        $soal = Soal::create([
            'id_quiz' => $quiz->id_quiz,
            'pertanyaan' => $data['pertanyaan'],
        ]);

        $jawabanBenarIndex = (int) $data['jawaban_benar'];

        foreach ($data['pilihan_jawaban'] as $index => $pilihan) {
            PilihanJawaban::create([
                'id_soal' => $soal->id_soal,
                'jawaban' => $pilihan['jawaban'],
                'is_correct' => $index === $jawabanBenarIndex,
            ]);
        }

        return redirect()->route('dashboard.quiz.soal.index', $quiz)
            ->with('success', 'Soal berhasil ditambahkan.');
    }

    public function edit(Quiz $quiz, Soal $soal)
    {
        $this->authorize('update', $quiz);
        $soal->load('pilihanJawabans');
        return view('dashboard.soal.edit', compact('quiz', 'soal'));
    }

    public function update(StoreSoalRequest $request, Quiz $quiz, Soal $soal)
    {
        $this->authorize('update', $quiz);

        $data = $request->validated();

        $soal->update([
            'pertanyaan' => $data['pertanyaan'],
        ]);

        $soal->pilihanJawabans()->delete();

        $jawabanBenarIndex = (int) $data['jawaban_benar'];

        foreach ($data['pilihan_jawaban'] as $index => $pilihan) {
            PilihanJawaban::create([
                'id_soal' => $soal->id_soal,
                'jawaban' => $pilihan['jawaban'],
                'is_correct' => $index === $jawabanBenarIndex,
            ]);
        }

        return redirect()->route('dashboard.quiz.soal.index', $quiz)
            ->with('success', 'Soal berhasil diperbarui.');
    }

    public function destroy(Quiz $quiz, Soal $soal)
    {
        $this->authorize('update', $quiz);
        $soal->delete();

        return redirect()->route('dashboard.quiz.soal.index', $quiz)
            ->with('success', 'Soal berhasil dihapus.');
    }
}
