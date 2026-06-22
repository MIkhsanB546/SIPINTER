<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuizRequest;
use App\Http\Requests\UpdateQuizRequest;
use App\Models\Quiz;
use App\Models\Materi;

class QuizController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            $quizList = Quiz::with('materi.guru')->latest()->get();
        } else {
            $quizList = Quiz::with('materi.guru')
                ->whereIn('id_materi', Materi::where('id_guru', $user->id_user)->select('id_materi'))
                ->latest()
                ->get();
        }

        return view('dashboard.quiz.index', compact('quizList'));
    }

    public function create()
    {
        $user = auth()->user();
        if ($user->role === 'admin') {
            $materiList = Materi::all();
        } else {
            $materiList = Materi::where('id_guru', $user->id_user)->get();
        }
        return view('dashboard.quiz.create', compact('materiList'));
    }

    public function store(StoreQuizRequest $request)
    {
        $data = $request->validated();
        Quiz::create($data);

        return redirect()->route('dashboard.quiz.index')
            ->with('success', 'Quiz berhasil dibuat.');
    }

    public function show(Quiz $quiz)
    {
        $this->authorize('view', $quiz);
        $quiz->load('materi.guru', 'soal.pilihanJawaban');
        return view('dashboard.quiz.show', compact('quiz'));
    }

    public function edit(Quiz $quiz)
    {
        $this->authorize('update', $quiz);
        $user = auth()->user();
        if ($user->role === 'admin') {
            $materiList = Materi::all();
        } else {
            $materiList = Materi::where('id_guru', $user->id_user)->get();
        }
        return view('dashboard.quiz.edit', compact('quiz', 'materiList'));
    }

    public function update(UpdateQuizRequest $request, Quiz $quiz)
    {
        $this->authorize('update', $quiz);
        $quiz->update($request->validated());

        return redirect()->route('dashboard.quiz.index')
            ->with('success', 'Quiz berhasil diperbarui.');
    }

    public function destroy(Quiz $quiz)
    {
        $this->authorize('delete', $quiz);
        $quiz->delete();

        return redirect()->route('dashboard.quiz.index')
            ->with('success', 'Quiz berhasil dihapus.');
    }
}
