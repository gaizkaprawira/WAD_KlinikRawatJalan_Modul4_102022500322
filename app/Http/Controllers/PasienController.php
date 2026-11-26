<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index()
    {
        $pasiens = Pasien::orderBy('id', 'desc')->get();
        return view('pasien.index', compact('pasiens'));
    }

    public function create()
    {
        return view('pasien.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'profil_pasien' => 'required|string|max:150',
            'nomor_rekam_medis' => 'required|string|max:50',
            'domisili' => 'required|string',
            'kontak_darurat' => 'required|string|max:20',
        ]);

        Pasien::create($request->only([
            'profil_pasien',
            'nomor_rekam_medis',
            'domisili',
            'kontak_darurat',
        ]));

        return redirect()->route('pasiens.index');
    }

    public function edit(string $id)
    {
        $pasien = Pasien::findOrFail($id);
        return view('pasien.edit', compact('pasien'));
    }

    public function update(Request $request, string $id)
    {
        $pasien = Pasien::findOrFail($id);

        $request->validate([
            'profil_pasien' => 'required|string|max:150',
            'nomor_rekam_medis' => 'required|string|max:50',
            'domisili' => 'required|string',
            'kontak_darurat' => 'required|string|max:20',
        ]);

        $pasien->update($request->only([
            'profil_pasien',
            'nomor_rekam_medis',
            'domisili',
            'kontak_darurat',
        ]));

        return redirect()->route('pasiens.index');
    }

    public function destroy(string $id)
    {
        $pasien = Pasien::findOrFail($id);
        $pasien->delete();

        return redirect()->route('pasiens.index');
    }
}