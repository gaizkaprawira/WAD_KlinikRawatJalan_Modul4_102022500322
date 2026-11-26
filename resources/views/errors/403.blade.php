@extends('layouts.app')

@section('title', '403 - Akses Ditolak')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 text-center">
        <div class="card shadow-sm p-5">
            <h1 class="display-4 fw-bold text-danger">403</h1>
            <h2 class="h4 fw-bold mb-3">Akses Dibatasi</h2>
            <p class="text-muted mb-4">
                {{ $exception->getMessage() ?: 'Anda tidak memiliki hak akses untuk membuka halaman ini.' }}
            </p>
            <div>
                <a href="{{ route('dashboard') }}" class="btn btn-primary px-4">Kembali ke Dashboard</a>
            </div>
        </div>
    </div>
</div>
@endsection