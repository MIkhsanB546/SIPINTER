<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMateriRequest;
use App\Http\Requests\UpdateMateriRequest;
use App\Models\Materi;
use App\Models\TingkatKesulitan;
use App\Models\KategoriMateri;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $materiList = Materi::with(['guru', 'tingkatKesulitan', 'kategori'])->latest()->get();
        } else {
            $materiList = Materi::with(['guru', 'tingkatKesulitan', 'kategori'])
                ->where('id_guru', $user->id_user)
                ->latest()
                ->get();
        }

        return view('dashboard.materi.index', compact('materiList'));
    }

    public function create()
    {
        $tingkatList = TingkatKesulitan::all();
        $kategoriList = KategoriMateri::all();
        return view('dashboard.materi.create', compact('tingkatList', 'kategoriList'));
    }

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

    public function show(Materi $materi)
    {
        $this->authorize('view', $materi);
        $materi->load(['guru', 'tingkatKesulitan', 'kategori']);
        return view('dashboard.materi.show', compact('materi'));
    }

    public function edit(Materi $materi)
    {
        $this->authorize('update', $materi);
        $tingkatList = TingkatKesulitan::all();
        $kategoriList = KategoriMateri::all();
        return view('dashboard.materi.edit', compact('materi', 'tingkatList', 'kategoriList'));
    }

    public function update(UpdateMateriRequest $request, Materi $materi)
    {
        $this->authorize('update', $materi);

        $data = $request->validated();

        if ($request->hasFile('file_materi')) {
            if ($materi->file_materi) {
                Storage::disk('public')->delete($materi->file_materi);
            }
            $data['file_materi'] = $request->file('file_materi')->store('materi/files', 'public');
        }

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
