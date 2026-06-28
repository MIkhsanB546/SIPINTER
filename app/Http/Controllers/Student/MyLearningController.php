<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use App\Models\TingkatKesulitan;
use App\Models\KategoriMateri;
use Illuminate\Support\Facades\Auth;

class MyLearningController extends Controller
{
    public function index()
    {
        $siswaId = Auth::id();

        $materiList = Auth::user()->materiSiswa()
            ->with(['guru', 'tingkatKesulitan', 'kategori', 'quiz'])
            ->withPivot(['status', 'progress', 'started_at', 'completed_at'])
            ->latest()
            ->paginate(12);

        $categories = KategoriMateri::orderBy('nama_kategori')->get();
        $difficulties = TingkatKesulitan::orderBy('nama_tingkat')->get();

        return view('student.my-learning.index', compact('materiList', 'categories', 'difficulties'));
    }
}
