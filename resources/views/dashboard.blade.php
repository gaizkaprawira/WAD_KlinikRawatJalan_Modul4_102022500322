@extends('layouts.app')

@section('title', 'Dashboard - Sistem Informasi Klinik')

@section('content')
<div class="card shadow-sm p-4">
    <h1 class="h3 fw-bold mb-2">Selamat Datang di Sistem Informasi Klinik Rawat Jalan</h1>
    <p class="text-muted mb-4">Anda login sebagai <strong>{{ auth()->user()->username }}</strong> ({{ auth()->user()->role }}). Pilih modul layanan melalui menu navigasi di atas.</p>
    <div class="row g-3">
        <div class="col-md-3">
            <a href="{{ url('/pasiens') }}" class="btn btn-outline-primary w-100 py-3 fw-semibold">Modul A: Pasien</a>
        </div>
        <div class="col-md-3">
            <a href="{{ url('/dokters') }}" class="btn btn-outline-primary w-100 py-3 fw-semibold">Modul B: Dokter</a>
        </div>
        <div class="col-md-3">
            <a href="{{ url('/obats') }}" class="btn btn-outline-primary w-100 py-3 fw-semibold">Modul C: Farmasi</a>
        </div>
        <div class="col-md-3">
            <a href="{{ url('/polikliniks') }}" class="btn btn-outline-primary w-100 py-3 fw-semibold">Modul D: Poliklinik</a>
        </div>
    </div>
</div>
@endsection