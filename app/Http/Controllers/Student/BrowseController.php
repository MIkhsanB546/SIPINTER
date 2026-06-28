<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use App\Models\MateriSiswa;
use App\Models\TingkatKesulitan;
use App\Models\KategoriMateri;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BrowseController extends Controller
{
    public function index()
    {
        $query = Materi::where('is_published', true);

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

        if ($guru = request('guru')) {
            $query->where('id_guru', $guru);
        }

        $sort = request('sort', 'terbaru');

        $query->with(['guru', 'tingkatKesulitan', 'kategori', 'quiz']);

        $query->when($sort === 'terbaru', fn($q) => $q->latest());
        $query->when($sort === 'a-z', fn($q) => $q->orderBy('judul'));

        $materiList = $query->paginate(12)->withQueryString();

        $tingkatList = TingkatKesulitan::orderBy('nama_tingkat')->get();
        $kategoriList = KategoriMateri::orderBy('nama_kategori')->get();
        $guruList = User::guru()->orderBy('name')->get();

        // Get saved material IDs for the current student
        $savedIds = [];
        if (Auth::check() && Auth::user()->role === 'siswa') {
            $savedIds = MateriSiswa::where('id_siswa', Auth::id())
                ->pluck('id_materi')
                ->toArray();
        }

        return view('student.browse.index', compact(
            'materiList',
            'tingkatList',
            'kategoriList',
            'guruList',
            'savedIds'
        ));
    }

    public function show(Materi $materi)
    {
        abort_if(!$materi->is_published, 404);

        $materi->load(['guru', 'tingkatKesulitan', 'kategori', 'quiz.soal']);

        $siswaId = Auth::id();
        $saved = null;
        if (Auth::check() && Auth::user()->role === 'siswa') {
            $saved = MateriSiswa::where('id_siswa', $siswaId)
                ->where('id_materi', $materi->id_materi)
                ->first();
        }

        $totalQuizzes = $materi->quiz->sum(fn($q) => $q->soal->count());

        return view('student.browse.show', compact('materi', 'saved', 'totalQuizzes'));
    }

    public function save(Materi $materi)
    {
        abort_if(!$materi->is_published, 404);

        $siswaId = Auth::id();

        $existing = MateriSiswa::where('id_siswa', $siswaId)
            ->where('id_materi', $materi->id_materi)
            ->first();

        if (!$existing) {
            MateriSiswa::create([
                'id_siswa' => $siswaId,
                'id_materi' => $materi->id_materi,
                'status' => 'saved',
                'progress' => 0,
            ]);
        }

        return redirect()->route('siswa.browse.show', $materi)
            ->with('success', 'Materi berhasil disimpan ke My Learning!');
    }

    public function byCategory(KategoriMateri $kategori)
    {
        $materiList = Materi::where('is_published', true)
            ->where('id_kategori_materi', $kategori->id_kategori_materi)
            ->with(['guru', 'tingkatKesulitan', 'kategori', 'quiz'])
            ->latest()
            ->paginate(12);

        return view('student.browse.by-category', compact('materiList', 'kategori'));
    }

    public function byTeacher(User $guru)
    {
        $materiList = Materi::where('is_published', true)
            ->where('id_guru', $guru->id_user)
            ->with(['guru', 'tingkatKesulitan', 'kategori', 'quiz'])
            ->latest()
            ->paginate(12);

        $materialCount = Materi::where('id_guru', $guru->id_user)->where('is_published', true)->count();

        return view('student.browse.by-teacher', compact('materiList', 'guru', 'materialCount'));
    }

    public function byDifficulty(TingkatKesulitan $tingkat)
    {
        $materiList = Materi::where('is_published', true)
            ->where('id_tingkat', $tingkat->id_tingkat)
            ->with(['guru', 'tingkatKesulitan', 'kategori', 'quiz'])
            ->latest()
            ->paginate(12);

        return view('student.browse.by-difficulty', compact('materiList', 'tingkat'));
    }

    public function teacherProfile(User $guru)
    {
        $materiList = Materi::where('is_published', true)
            ->where('id_guru', $guru->id_user)
            ->with(['tingkatKesulitan', 'kategori'])
            ->latest()
            ->take(6)
            ->get();

        $totalMateri = Materi::where('id_guru', $guru->id_user)->where('is_published', true)->count();

        return view('student.browse.teacher-profile', compact('guru', 'materiList', 'totalMateri'));
    }
}
