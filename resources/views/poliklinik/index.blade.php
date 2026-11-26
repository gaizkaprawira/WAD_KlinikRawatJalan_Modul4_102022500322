@extends('layouts.app')

@section('title', 'Manajemen Ruang Poliklinik')

@section('content')
    @if (auth()->user()->role === 'admin')
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white fw-bold">Form Tambah Ruang Poliklinik</div>
        <div class="card-body">
            <form action="{{ route('polikliniks.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Kode Ruang</label>
                        <input type="text" name="kode_ruang" value="{{ old('kode_ruang') }}"
                               class="form-control @error('kode_ruang') is-invalid @enderror" placeholder="POL-001">
                        @error('kode_ruang') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nama Poli</label>
                        <input type="text" name="nama_poli" value="{{ old('nama_poli') }}"
                               class="form-control @error('nama_poli') is-invalid @enderror" placeholder="Poli Gigi">
                        @error('nama_poli') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Blok Gedung</label>
                        <select name="blok_gedung" class="form-select @error('blok_gedung') is-invalid @enderror">
                            <option value="">-- Pilih Gedung --</option>
                            @foreach (['Gedung A', 'Gedung B', 'Gedung C'] as $g)
                                <option value="{{ $g }}" @selected(old('blok_gedung') == $g)>{{ $g }}</option>
                            @endforeach
                        </select>
                        @error('blok_gedung') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Lantai</label>
                        <input type="number" name="lantai" value="{{ old('lantai') }}"
                               class="form-control @error('lantai') is-invalid @enderror">
                        @error('lantai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Nomor Ruangan</label>
                        <input type="text" name="nomor_ruang" value="{{ old('nomor_ruang') }}"
                               class="form-control @error('nomor_ruang') is-invalid @enderror">
                        @error('nomor_ruang') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label">Status Operasional</label>
                        <select name="status_poli" class="form-select @error('status_poli') is-invalid @enderror">
                            <option value="">-- Pilih Status --</option>
                            @foreach (['Aktif', 'Non-Aktif', 'Pemeliharaan'] as $s)
                                <option value="{{ $s }}" @selected(old('status_poli') == $s)>{{ $s }}</option>
                            @endforeach
                        </select>
                        @error('status_poli') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label">Inventaris Alat Medis</label>
                        <textarea name="inventaris_alat" rows="3"
                                  class="form-control @error('inventaris_alat') is-invalid @enderror">{{ old('inventaris_alat') }}</textarea>
                        @error('inventaris_alat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <button class="btn btn-primary w-100 mt-3">Simpan Data Ruangan</button>
            </form>
        </div>
    </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-white fw-bold">Daftar Ruang Poliklinik</div>
        <div class="table-responsive">
            <table class="table table-striped align-middle mb-0">
                <thead class="table-dark">
                <tr>
                    <th>No</th><th>Kode</th><th>Nama Poli</th><th>Gedung</th><th>Lantai</th>
                    <th>No. Ruang</th><th>Status</th><th>Inventaris</th>
                    @if (auth()->user()->role === 'admin')
                        <th class="text-center">Aksi</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @forelse ($ruang as $r)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="fw-bold">{{ $r->kode_ruang }}</td>
                        <td>{{ $r->nama_poli }}</td>
                        <td>{{ $r->blok_gedung }}</td>
                        <td>{{ $r->lantai }}</td>
                        <td>{{ $r->nomor_ruang }}</td>
                        <td>
                            <span class="badge {{ match($r->status_poli) {
                                'Aktif' => 'bg-success',
                                'Pemeliharaan' => 'bg-warning text-dark',
                                default => 'bg-danger' } }}">{{ $r->status_poli }}</span>
                        </td>
                        <td>{{ $r->inventaris_alat }}</td>
                        @if (auth()->user()->role === 'admin')
                            <td class="text-center text-nowrap">
                                <a href="{{ route('polikliniks.edit', $r) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('polikliniks.destroy', $r) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ auth()->user()->role === 'admin' ? 9 : 8 }}" class="text-center text-muted py-3">
                            Belum ada data ruangan.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection