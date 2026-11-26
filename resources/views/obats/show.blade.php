@extends('layouts.app')

@section('title', 'Detail Obat - Katalog Farmasi')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm p-4">
            <h2 class="h4 fw-bold mb-3 border-bottom pb-2">Detail Data Obat</h2>

            <table class="table table-bordered">
                <tr>
                    <th style="width: 30%;" class="table-light">Nama Obat</th>
                    <td class="fw-bold text-primary">{{ $obat->nama_obat }}</td>
                </tr>
                <tr>
                    <th class="table-light">Kategori</th>
                    <td>{{ $obat->kategori }}</td>
                </tr>
                <tr>
                    <th class="table-light">Sediaan</th>
                    <td>{{ $obat->sediaan }}</td>
                </tr>
                <tr>
                    <th class="table-light">Pabrikan</th>
                    <td>{{ $obat->pabrikan }}</td>
                </tr>
                <tr>
                    <th class="table-light">Harga</th>
                    <td>Rp {{ number_format($obat->harga, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th class="table-light">Stok</th>
                    <td>{{ $obat->stok }}</td>
                </tr>
            </table>

            <div class="d-flex gap-2 mt-3">
                <a href="{{ route('obats.index') }}" class="btn btn-secondary px-4">Kembali ke Katalog</a>
                @if (auth()->user()->isAdmin())
                    <a href="{{ route('obats.edit', $obat) }}" class="btn btn-warning px-4">Edit Obat</a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection