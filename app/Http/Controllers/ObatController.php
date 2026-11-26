<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function index()
    {
        $obats = Obat::latest()->get();
        return view('obats.index', compact('obats'));
    }

    public function create()
    {
        return view('obats.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kategori'  => 'required|string',
            'sediaan'   => 'required|string',
            'pabrikan'  => 'required|string|max:255',
            'harga'     => 'required|numeric|min:0',
            'stok'      => 'required|integer|min:0',
        ]);

        Obat::create($request->only([
            'nama_obat', 'kategori', 'sediaan', 'pabrikan', 'harga', 'stok'
        ]));

        return redirect()->route('obats.index')
            ->with('success', 'Data obat berhasil ditambahkan ke katalog!');
    }

    public function show(Obat $obat)
    {
        return view('obats.show', compact('obat'));
    }

    public function edit(Obat $obat)
    {
        return view('obats.edit', compact('obat'));
    }

    public function update(Request $request, Obat $obat)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kategori'  => 'required|string',
            'sediaan'   => 'required|string',
            'pabrikan'  => 'required|string|max:255',
            'harga'     => 'required|numeric|min:0',
            'stok'      => 'required|integer|min:0',
        ]);

        $obat->update($request->only([
            'nama_obat', 'kategori', 'sediaan', 'pabrikan', 'harga', 'stok'
        ]));

        return redirect()->route('obats.index')
            ->with('success', 'Data obat berhasil diperbarui!');
    }

    public function destroy(Obat $obat)
    {
        $obat->delete();

        return redirect()->route('obats.index')
            ->with('success', 'Data obat berhasil dihapus dari katalog!');
    }
}