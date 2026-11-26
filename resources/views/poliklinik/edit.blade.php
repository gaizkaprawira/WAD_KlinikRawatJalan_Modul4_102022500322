@extends('layouts.app')

@section('title', 'Edit Ruang Poliklinik')

@section('content')
    <div class="col-lg-6 mx-auto">
        <div class="card shadow-sm p-4">
            <h3 class="fw-bold mb-3 border-bottom pb-2">Edit Data Ruang Poliklinik</h3>
            <form action="{{ route('polikliniks.update', $ruang) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Kode Ruang</label>
                    <input type="text" name="kode_ruang" value="{{ old('kode_ruang', $ruang->kode_ruang) }}"
                           class="form-control @error('kode_ruang') is-invalid @enderror">
                    @error('kode_ruang') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Poli</label>
                    <input type="text" name="nama_poli" value="{{ old('nama_poli', $ruang->nama_poli) }}"
                           class="form-control @error('nama_poli') is-invalid @enderror">
                    @error('nama_poli') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Blok Gedung</label>
                    <select name="blok_gedung" class="form-select @error('blok_gedung') is-invalid @enderror">
                        @foreach (['Gedung A', 'Gedung B', 'Gedung C'] as $g)
                            <option value="{{ $g }}" @selected(old('blok_gedung', $ruang->blok_gedung) == $g)>{{ $g }}</option>
                        @endforeach
                    </select>
                    @error('blok_gedung') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Lantai</label>
                        <input type="number" name="lantai" value="{{ old('lantai', $ruang->lantai) }}"
                               class="form-control @error('lantai') is-invalid @enderror">
                        @error('lantai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nomor Ruangan</label>
                        <input type="text" name="nomor_ruang" value="{{ old('nomor_ruang', $ruang->nomor_ruang) }}"
                               class="form-control @error('nomor_ruang') is-invalid @enderror">
                        @error('nomor_ruang') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Status Operasional</label>
                    <select name="status_poli" class="form-select @error('status_poli') is-invalid @enderror">
                        @foreach (['Aktif', 'Non-Aktif', 'Pemeliharaan'] as $s)
                            <option value="{{ $s }}" @selected(old('status_poli', $ruang->status_poli) == $s)>{{ $s }}</option>
                        @endforeach
                    </select>
                    @error('status_poli') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Inventaris Alat Medis</label>
                    <textarea name="inventaris_alat" rows="3"
                              class="form-control @error('inventaris_alat') is-invalid @enderror">{{ old('inventaris_alat', $ruang->inventaris_alat) }}</textarea>
                    @error('inventaris_alat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('polikliniks.index') }}" class="btn btn-secondary">Batal</a>
                    <button class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
@endsection