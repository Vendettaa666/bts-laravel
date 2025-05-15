<?php

namespace App\Http\Controllers;

use App\Models\Tahun;
use App\Models\Kategori; // Tambahkan ini
use Illuminate\Http\Request;

class TahunController extends Controller
{
    public function index()
    {
        $tahuns = Tahun::withCount('bukus')->get();
        return view('tahuns.index', compact('tahuns'));
    }

    public function create()
    {
        $kategoris = Kategori::all(); // Ambil semua kategori
        return view('tahuns.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required|unique:tahuns',
            'kategori_id' => 'nullable|exists:kategoris,id' // Validasi kategori
        ]);

        Tahun::create([
            'tahun' => $request->tahun,
            'kategori_id' => $request->kategori_id // Simpan kategori jika ada
        ]);

        return redirect()->route('tahuns.index')
            ->with('success', 'Tahun berhasil ditambahkan');
    }

    public function show(Tahun $tahun)
{
    $tahun->load(['bukus' => function($query) {
        $query->with('kategori');
    }]);

    return view('tahuns.show', compact('tahun'));
}

    public function edit(Tahun $tahun)
    {
        $kategoris = Kategori::all(); // Ambil semua kategori
        return view('tahuns.edit', compact('tahun', 'kategoris'));
    }

    public function update(Request $request, Tahun $tahun)
    {
        $request->validate([
            'tahun' => 'required|unique:tahuns,tahun,'.$tahun->id,
            'kategori_id' => 'nullable|exists:kategoris,id' // Validasi kategori
        ]);

        $tahun->update([
            'tahun' => $request->tahun,
            'kategori_id' => $request->kategori_id // Update kategori
        ]);

        return redirect()->route('tahuns.index')
            ->with('success', 'Tahun berhasil diperbarui');
    }

    public function destroy(Tahun $tahun)
    {
        $tahun->delete();
        return redirect()->route('tahuns.index')
            ->with('success', 'Tahun berhasil dihapus');
    }
}
