<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKategoriMateriRequest;
use App\Http\Requests\UpdateKategoriMateriRequest;
use App\Models\KategoriMateri;

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

    public function store(StoreKategoriMateriRequest $request)
    {
        KategoriMateri::create($request->validated());

        return redirect()->route('dashboard.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(KategoriMateri $kategori)
    {
        return view('dashboard.kategori.edit', compact('kategori'));
    }

    public function update(UpdateKategoriMateriRequest $request, KategoriMateri $kategori)
    {
        $kategori->update($request->validated());

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
