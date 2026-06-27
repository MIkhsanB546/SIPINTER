<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMateriRequest;
use App\Http\Requests\UpdateMateriRequest;
use App\Models\Materi;
use App\Models\Jenjang;
use App\Models\KategoriMateri;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

/**
 * Controller untuk mengelola data materi.
 */
class MateriController extends Controller
{
    /**
     * Menampilkan daftar materi sesuai role pengguna.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $materiList = Materi::with(['guru', 'jenjang', 'kategori'])->latest()->get();
        } else {
            $materiList = Materi::with(['guru', 'jenjang', 'kategori'])
                ->where('id_guru', $user->id_user)
                ->latest()
                ->get();
        }

        return view('dashboard.materi.index', compact('materiList'));
    }

    /**
     * Menampilkan form tambah materi.
     */
    public function create()
    {
        $jenjangList = Jenjang::all();
        $kategoriList = KategoriMateri::all();
        return view('dashboard.materi.create', compact('jenjangList', 'kategoriList'));
    }

    /**
     * Menyimpan materi baru beserta file dan thumbnail.
     */
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

        Materi::create($data);

        return redirect()->route('dashboard.materi.index')
            ->with('success', 'Materi berhasil dibuat.');
    }

    /**
     * Menampilkan detail materi.
     */
    public function show(Materi $materi)
    {
        $this->authorize('view', $materi);
        $materi->load(['guru', 'jenjang', 'kategori']);
        return view('dashboard.materi.show', compact('materi'));
    }

    /**
     * Menampilkan form edit materi.
     */
    public function edit(Materi $materi)
    {
        $this->authorize('update', $materi);
        $jenjangList = Jenjang::all();
        $kategoriList = KategoriMateri::all();
        return view('dashboard.materi.edit', compact('materi', 'jenjangList', 'kategoriList'));
    }

    /**
     * Memperbarui data materi termasuk file dan thumbnail.
     */
    public function update(UpdateMateriRequest $request, Materi $materi)
    {
        $this->authorize('update', $materi);

        $data = $request->validated();

        // Hapus file lama jika diganti
        if ($request->hasFile('file_materi')) {
            if ($materi->file_materi) {
                Storage::disk('public')->delete($materi->file_materi);
            }
            $data['file_materi'] = $request->file('file_materi')->store('materi/files', 'public');
        }

        // Hapus thumbnail lama jika diganti
        if ($request->hasFile('thumbnail')) {
            if ($materi->thumbnail) {
                Storage::disk('public')->delete($materi->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('materi/thumbnails', 'public');
        }

        $data['is_published'] = $request->boolean('is_published');

        $materi->update($data);

        return redirect()->route('dashboard.materi.index')
            ->with('success', 'Materi berhasil diperbarui.');
    }

    /**
     * Menghapus materi beserta file dan thumbnail.
     */
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
