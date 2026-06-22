<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Jenjang;
use Illuminate\Http\Request;

class JenjangController extends Controller
{
    public function index()
    {
        $jenjangList = Jenjang::withCount('materi')->latest()->get();
        return view('dashboard.jenjang.index', compact('jenjangList'));
    }

    public function create()
    {
        return view('dashboard.jenjang.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_jenjang' => ['required', 'string', 'max:50', 'unique:jenjang,nama_jenjang'],
        ], [
            'nama_jenjang.required' => 'Nama jenjang wajib diisi.',
            'nama_jenjang.unique' => 'Nama jenjang sudah ada.',
        ]);

        Jenjang::create($data);

        return redirect()->route('dashboard.jenjang.index')
            ->with('success', 'Jenjang berhasil ditambahkan.');
    }

    public function edit(Jenjang $jenjang)
    {
        return view('dashboard.jenjang.edit', compact('jenjang'));
    }

    public function update(Request $request, Jenjang $jenjang)
    {
        $data = $request->validate([
            'nama_jenjang' => ['required', 'string', 'max:50', 'unique:jenjang,nama_jenjang,' . $jenjang->id_jenjang . ',id_jenjang'],
        ], [
            'nama_jenjang.required' => 'Nama jenjang wajib diisi.',
            'nama_jenjang.unique' => 'Nama jenjang sudah ada.',
        ]);

        $jenjang->update($data);

        return redirect()->route('dashboard.jenjang.index')
            ->with('success', 'Jenjang berhasil diperbarui.');
    }

    public function destroy(Jenjang $jenjang)
    {
        if ($jenjang->materi()->count() > 0) {
            return back()->with('error', 'Jenjang tidak dapat dihapus karena masih memiliki materi.');
        }

        $jenjang->delete();

        return redirect()->route('dashboard.jenjang.index')
            ->with('success', 'Jenjang berhasil dihapus.');
    }
}
