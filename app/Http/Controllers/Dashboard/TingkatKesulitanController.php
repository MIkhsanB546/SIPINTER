<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTingkatKesulitanRequest;
use App\Http\Requests\UpdateTingkatKesulitanRequest;
use App\Models\TingkatKesulitan;

class TingkatKesulitanController extends Controller
{
    public function index()
    {
        $tingkatList = TingkatKesulitan::withCount('materi')->latest()->get();
        return view('dashboard.tingkat-kesulitan.index', compact('tingkatList'));
    }

    public function create()
    {
        return view('dashboard.tingkat-kesulitan.create');
    }

    public function store(StoreTingkatKesulitanRequest $request)
    {
        TingkatKesulitan::create($request->validated());

        return redirect()->route('dashboard.tingkat-kesulitan.index')
            ->with('success', 'Tingkat kesulitan berhasil ditambahkan.');
    }

    public function edit(TingkatKesulitan $tingkatKesulitan)
    {
        return view('dashboard.tingkat-kesulitan.edit', compact('tingkatKesulitan'));
    }

    public function update(UpdateTingkatKesulitanRequest $request, TingkatKesulitan $tingkatKesulitan)
    {
        $tingkatKesulitan->update($request->validated());

        return redirect()->route('dashboard.tingkat-kesulitan.index')
            ->with('success', 'Tingkat kesulitan berhasil diperbarui.');
    }

    public function destroy(TingkatKesulitan $tingkatKesulitan)
    {
        if ($tingkatKesulitan->materi()->count() > 0) {
            return back()->with('error', 'Tingkat kesulitan tidak dapat dihapus karena masih memiliki materi.');
        }

        $tingkatKesulitan->delete();

        return redirect()->route('dashboard.tingkat-kesulitan.index')
            ->with('success', 'Tingkat kesulitan berhasil dihapus.');
    }
}
