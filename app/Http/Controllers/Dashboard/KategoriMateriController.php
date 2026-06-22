<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\KategoriMateri;
use Illuminate\Http\Request;

class KategoriMateriController extends Controller
{
    public function index()
    {
        $kategoriList = KategoriMateri::withCount('materi')->latest()->get();
        return view('dashboard.kategori.index', compact('kategoriList'));
    }

    public function create()
    {
        return view('dashboard.kategori.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_kategori' => ['required', 'string', 'max:100', 'unique:kategori_materi,nama_kategori'],
            'deskripsi' => ['nullable', 'string'],
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.unique' => 'Nama kategori sudah ada.',
        ]);

        KategoriMateri::create($data);

        return redirect()->route('dashboard.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(KategoriMateri $kategori)
    {
        return view('dashboard.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, KategoriMateri $kategori)
    {
        $data = $request->validate([
            'nama_kategori' => ['required', 'string', 'max:100', 'unique:kategori_materi,nama_kategori,' . $kategori->id_kategori_materi . ',id_kategori_materi'],
            'deskripsi' => ['nullable', 'string'],
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.unique' => 'Nama kategori sudah ada.',
        ]);

        $kategori->update($data);

        return redirect()->route('dashboard.kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(KategoriMateri $kategori)
    {
        if ($kategori->materi()->count() > 0) {
            return back()->with('error', 'Kategori tidak dapat dihapus karena masih memiliki materi.');
        }

        $kategori->delete();

        return redirect()->route('dashboard.kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
