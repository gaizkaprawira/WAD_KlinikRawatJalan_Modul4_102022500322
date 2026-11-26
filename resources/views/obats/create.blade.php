@extends('layouts.app')

@section('title', 'Tambah Obat - Katalog Farmasi')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm p-4">
            <h2 class="h4 fw-bold mb-3 border-bottom pb-2">Formulir Tambah Data Obat</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('obats.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama_obat" class="form-label fw-semibold">Nama Obat</label>
                    <input type="text" class="form-control" id="nama_obat" name="nama_obat" value="{{ old('nama_obat') }}" placeholder="Contoh: Paracetamol 500mg" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="kategori" class="form-label fw-semibold">Kategori</label>
                        <select class="form-select" id="kategori" name="kategori" required>
                            <option value="" disabled selected>-- Pilih Kategori --</option>
                            @foreach (['Obat Bebas', 'Obat Bebas Terbatas', 'Obat Keras', 'Herbal'] as $kat)
                                <option value="{{ $kat }}" @selected(old('kategori') === $kat)>{{ $kat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="sediaan" class="form-label fw-semibold">Sediaan</label>
                        <select class="form-select" id="sediaan" name="sediaan" required>
                            <option value="" disabled selected>-- Pilih Sediaan --</option>
                            @foreach (['Tablet', 'Kapsul', 'Sirup', 'Salep', 'Injeksi'] as $sed)
                                <option value="{{ $sed }}" @selected(old('sediaan') === $sed)>{{ $sed }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="pabrikan" class="form-label fw-semibold">Pabrikan</label>
                    <input type="text" class="form-control" id="pabrikan" name="pabrikan" value="{{ old('pabrikan') }}" placeholder="Contoh: PT Kimia Farma" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="harga" class="form-label fw-semibold">Harga (Rp)</label>
                        <input type="number" class="form-control" id="harga" name="harga" value="{{ old('harga') }}" min="0" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="stok" class="form-label fw-semibold">Stok</label>
                        <input type="number" class="form-control" id="stok" name="stok" value="{{ old('stok') }}" min="0" required>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4">Simpan Obat</button>
                    <a href="{{ route('obats.index') }}" class="btn btn-secondary px-4">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection