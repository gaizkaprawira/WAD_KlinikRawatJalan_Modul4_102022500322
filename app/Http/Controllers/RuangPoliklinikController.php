<?php

namespace App\Http\Controllers;

use App\Models\RuangPoliklinik;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RuangPoliklinikController extends Controller
{
    private function rules(?int $id = null): array
    {
        return [
            'kode_ruang'      => ['required', 'string', 'max:50', Rule::unique('ruang_poliklinik', 'kode_ruang')->ignore($id)],
            'nama_poli'       => 'required|string|max:255',
            'blok_gedung'     => 'required|in:Gedung A,Gedung B,Gedung C',
            'lantai'          => 'required|integer|min:1',
            'nomor_ruang'     => 'required|numeric',
            'status_poli'     => 'required|in:Aktif,Non-Aktif,Pemeliharaan',
            'inventaris_alat' => 'required|string',
        ];
    }

    public function index()
    {
        $ruang = RuangPoliklinik::latest()->get();
        return view('poliklinik.index', compact('ruang'));
    }

    public function store(Request $request)
    {
        RuangPoliklinik::create($request->validate($this->rules()));

        return redirect()->route('polikliniks.index')
            ->with('success', 'Data ruang poliklinik berhasil disimpan!');
    }

    public function edit(RuangPoliklinik $ruang)
    {
        return view('poliklinik.edit', compact('ruang'));
    }

    public function update(Request $request, RuangPoliklinik $ruang)
    {
        $ruang->update($request->validate($this->rules($ruang->id)));

        return redirect()->route('polikliniks.index')
            ->with('success', 'Data ruang poliklinik berhasil diperbarui!');
    }

    public function destroy(RuangPoliklinik $ruang)
    {
        $ruang->delete();

        return redirect()->route('polikliniks.index')
            ->with('success', 'Data ruang poliklinik berhasil dihapus!');
    }
}