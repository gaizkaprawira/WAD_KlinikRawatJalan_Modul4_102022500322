@extends('layouts.app')

@section('content')
<div style="max-width:640px;margin:24px auto;padding:0 16px;">
    <div style="background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:24px;box-shadow:0 1px 3px rgba(0,0,0,0.08);">
        <h1 style="font-size:22px;font-weight:700;color:#111827;margin:0 0 20px 0;">Input Dokter Baru</h1>

        @if ($errors->any())
            <div style="background:#fee2e2;border:1px solid #fca5a5;color:#991b1b;padding:12px 16px;border-radius:8px;margin-bottom:16px;font-size:14px;">
                <ul style="margin:0;padding-left:18px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('doctors.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div style="margin-bottom:14px;">
                <label style="display:block;font-size:14px;font-weight:600;color:#374151;margin-bottom:6px;">Nama Dokter</label>
                <input type="text" name="nama" value="{{ old('nama') }}" required
                       style="width:100%;padding:10px 12px;border:1px solid #d1d5db;border-radius:8px;font-size:14px;box-sizing:border-box;">
            </div>

            <div style="margin-bottom:14px;">
                <label style="display:block;font-size:14px;font-weight:600;color:#374151;margin-bottom:6px;">No. SIP</label>
                <input type="text" name="no_sip" value="{{ old('no_sip') }}" required
                       style="width:100%;padding:10px 12px;border:1px solid #d1d5db;border-radius:8px;font-size:14px;box-sizing:border-box;">
            </div>

            <div style="margin-bottom:14px;">
                <label style="display:block;font-size:14px;font-weight:600;color:#374151;margin-bottom:6px;">Spesialis</label>
                <input type="text" name="spesialis" value="{{ old('spesialis') }}" placeholder="Contoh: Spesialis Anak" required
                       style="width:100%;padding:10px 12px;border:1px solid #d1d5db;border-radius:8px;font-size:14px;box-sizing:border-box;">
            </div>

            <div style="margin-bottom:14px;">
                <label style="display:block;font-size:14px;font-weight:600;color:#374151;margin-bottom:6px;">Ruangan</label>
                <input type="text" name="ruangan" value="{{ old('ruangan') }}" placeholder="Contoh: Poli 01" required
                       style="width:100%;padding:10px 12px;border:1px solid #d1d5db;border-radius:8px;font-size:14px;box-sizing:border-box;">
            </div>

            <div style="margin-bottom:14px;">
                <label style="display:block;font-size:14px;font-weight:600;color:#374151;margin-bottom:6px;">Kontak</label>
                <input type="text" name="kontak" value="{{ old('kontak') }}" required
                       style="width:100%;padding:10px 12px;border:1px solid #d1d5db;border-radius:8px;font-size:14px;box-sizing:border-box;">
            </div>

            <div style="margin-bottom:20px;">
                <label style="display:block;font-size:14px;font-weight:600;color:#374151;margin-bottom:6px;">Foto Dokter (Opsional)</label>
                <input type="file" name="foto" accept="image/*"
                       style="width:100%;padding:8px;border:1px solid #d1d5db;border-radius:8px;font-size:14px;background:#f9fafb;box-sizing:border-box;">
            </div>

            <div style="display:flex;justify-content:flex-end;gap:10px;">
                <a href="{{ route('doctors.index') }}"
                   style="background:#e5e7eb;color:#374151;padding:10px 18px;border-radius:8px;font-size:14px;font-weight:600;text-decoration:none;">
                    Kembali
                </a>
                <button type="submit"
                        style="background:#2563eb;color:#ffffff;padding:10px 20px;border-radius:8px;font-size:14px;font-weight:600;border:none;cursor:pointer;">
                    Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection