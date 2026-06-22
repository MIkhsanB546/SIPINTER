<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Materi;

class MateriController extends Controller
{
    public function index()
    {
        $materiList = Materi::with(['guru', 'jenjang', 'kategori', 'quizzes'])
            ->where('is_published', true)
            ->latest()
            ->get();

        return view('student.materi.index', compact('materiList'));
    }

    public function show(Materi $materi)
    {
        abort_if(!$materi->is_published, 404);

        $materi->load(['guru', 'jenjang', 'kategori', 'quizzes']);

        return view('student.materi.show', compact('materi'));
    }
}
