<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use App\Models\Jenjang;
use App\Models\KategoriMateri;

class MateriController extends Controller
{
    public function index()
    {
        $query = Materi::query();

        if ($q = request('q')) {
            $query->where(function ($qry) use ($q) {
                $qry->where('judul', 'like', "%{$q}%")
                    ->orWhere('deskripsi', 'like', "%{$q}%");
            });
        }

        if ($jenjang = request('jenjang')) {
            $query->where('id_jenjang', $jenjang);
        }

        if ($kategori = request('kategori')) {
            $query->where('id_kategori_materi', $kategori);
        }

        $materiList = $query
            ->with(['guru', 'jenjang', 'kategori', 'quizzes'])
            ->where('is_published', true)
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $jenjangList = Jenjang::orderBy('nama_jenjang')->get();
        $kategoriList = KategoriMateri::orderBy('nama_kategori')->get();

        return view('student.materi.index', compact('materiList', 'jenjangList', 'kategoriList'));
    }

    public function show(Materi $materi)
    {
        abort_if(!$materi->is_published, 404);

        $materi->load(['guru', 'jenjang', 'kategori', 'quizzes']);

        return view('student.materi.show', compact('materi'));
    }
}
