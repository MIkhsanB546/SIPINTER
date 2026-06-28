<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use App\Models\TingkatKesulitan;
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

        if ($tingkat = request('tingkat')) {
            $query->where('id_tingkat', $tingkat);
        }

        if ($kategori = request('kategori')) {
            $query->where('id_kategori_materi', $kategori);
        }

        $materiList = $query
            ->with(['guru', 'tingkatKesulitan', 'kategori', 'quiz'])
            ->where('is_published', true)
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $tingkatList = TingkatKesulitan::orderBy('nama_tingkat')->get();
        $kategoriList = KategoriMateri::orderBy('nama_kategori')->get();

        return view('student.materi.index', compact('materiList', 'tingkatList', 'kategoriList'));
    }

    public function show(Materi $materi)
    {
        abort_if(!$materi->is_published, 404);

        $materi->load(['guru', 'tingkatKesulitan', 'kategori', 'quiz']);

        return view('student.materi.show', compact('materi'));
    }
}
