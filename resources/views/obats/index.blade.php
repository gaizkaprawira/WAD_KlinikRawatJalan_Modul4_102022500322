@extends('layouts.app')

@section('title', 'Daftar Master Obat - Katalog Farmasi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 fw-bold mb-1">Daftar Master Obat</h1>
        <p class="text-muted mb-0">Rekapitulasi persediaan obat, kategori, sediaan, dan pabrikan pada Klinik Rawat Jalan.</p>
    </div>
    @if (auth()->user()->isAdmin())
        <a href="{{ route('obats.create') }}" class="btn btn-primary px-4">+ Tambah Data Obat</a>
    @endif
</div>

<div class="table-responsive bg-white p-3 border rounded shadow-sm">
    <table class="table table-bordered table-striped align-middle mb-0">
        <thead class="table-light">
            <tr>
                <th class="text-center" style="width: 5%;">No</th>
                <th>Nama Obat</th>
                <th>Kategori</th>
                <th>Sediaan</th>
                <th>Pabrikan</th>
                <th class="text-end">Harga</th>
                <th class="text-center">Stok</th>
                <th class="text-center" style="width: 22%;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($obats as $index => $obat)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="fw-bold text-primary">{{ $obat->nama_obat }}</td>
                    <td>{{ $obat->kategori }}</td>
                    <td>{{ $obat->sediaan }}</td>
                    <td>{{ $obat->pabrikan }}</td>
                    <td class="text-end">Rp {{ number_format($obat->harga, 0, ',', '.') }}</td>
                    <td class="text-center">
                        @if ($obat->stok > 10)
                            <span class="badge bg-success">{{ $obat->stok }}</span>
                        @else
                            <span class="badge bg-danger">{{ $obat->stok }} (Minim)</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('obats.show', $obat) }}" class="btn btn-sm btn-info text-white me-1">Detail</a>
                        @if (auth()->user()->isAdmin())
                            <a href="{{ route('obats.edit', $obat) }}" class="btn btn-sm btn-warning me-1">Edit</a>
                            <form action="{{ route('obats.destroy', $obat) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus obat ini dari katalog?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">Belum ada data obat di katalog.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection