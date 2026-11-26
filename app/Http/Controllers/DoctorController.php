<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::latest()->get();
        return view('doctors.index', compact('doctors'));
    }

    public function create()
    {
        return view('doctors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'no_sip'    => 'required|string|max:100',
            'spesialis' => 'required|string',
            'ruangan'   => 'required|string',
            'kontak'    => 'required|string',
            'foto'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->only('nama', 'no_sip', 'spesialis', 'ruangan', 'kontak');

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('doctors', 'public');
        }

        Doctor::create($data);

        return redirect()->route('doctors.index')->with('success', 'Data dokter berhasil ditambahkan!');
    }

    public function show(Doctor $doctor)
    {
        return view('doctors.show', compact('doctor'));
    }

    public function edit(Doctor $doctor)
    {
        return view('doctors.edit', compact('doctor'));
    }

    public function update(Request $request, Doctor $doctor)
    {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'no_sip'    => 'required|string|max:100',
            'spesialis' => 'required|string',
            'ruangan'   => 'required|string',
            'kontak'    => 'required|string',
            'foto'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->only('nama', 'no_sip', 'spesialis', 'ruangan', 'kontak');

        if ($request->hasFile('foto')) {
            if ($doctor->foto) {
                Storage::disk('public')->delete($doctor->foto);
            }
            $data['foto'] = $request->file('foto')->store('doctors', 'public');
        }

        $doctor->update($data);

        return redirect()->route('doctors.index')->with('success', 'Data dokter berhasil diperbarui!');
    }

    public function destroy(Doctor $doctor)
    {
        if ($doctor->foto) {
            Storage::disk('public')->delete($doctor->foto);
        }
        $doctor->delete();

        return redirect()->route('doctors.index')->with('success', 'Data dokter berhasil dihapus!');
    }
}