@extends('layouts.app')

@section('content')
<div style="max-width:700px;margin:24px auto;padding:0 16px;">
    <div style="background:#fff;border:1px solid #e5e7eb;border-radius:12px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.08);">
        <div style="display:flex;flex-wrap:wrap;">
            <div style="width:240px;min-height:240px;background:#f3f4f6;flex-shrink:0;">
                @if ($doctor->foto)
                    <img src="{{ asset('storage/' . $doctor->foto) }}" alt="{{ $doctor->nama }}"
                         style="width:100%;height:100%;object-fit:cover;">
                @else
                    <div style="width:100%;height:100%;min-height:240px;display:flex;align-items:center;justify-content:center;color:#6b7280;font-weight:600;">
                        Tidak Ada Foto
                    </div>
                @endif
            </div>

            <div style="padding:24px;flex:1;">
                <span style="display:inline-block;background:#eff6ff;color:#1d4ed8;font-size:12px;font-weight:600;padding:4px 12px;border-radius:999px;margin-bottom:10px;">
                    {{ $doctor->spesialis }}
                </span>
                <h1 style="font-size:22px;font-weight:700;color:#111827;margin:0 0 14px 0;">{{ $doctor->nama }}</h1>

                <p style="font-size:14px;color:#374151;margin:6px 0;"><strong>No. SIP:</strong> {{ $doctor->no_sip }}</p>
                <p style="font-size:14px;color:#374151;margin:6px 0;"><strong>Ruangan Praktik:</strong> {{ $doctor->ruangan }}</p>
                <p style="font-size:14px;color:#374151;margin:6px 0;"><strong>Kontak:</strong> {{ $doctor->kontak }}</p>

                <div style="margin-top:24px;display:flex;gap:10px;">
                    <a href="{{ route('doctors.index') }}"
                       style="background:#e5e7eb;color:#374151;padding:8px 16px;border-radius:8px;font-size:14px;font-weight:600;text-decoration:none;">
                        Kembali
                    </a>
                    @if (strtolower(auth()->user()->role ?? '') === 'admin')
                        <a href="{{ route('doctors.edit', $doctor->id) }}"
                           style="background:#2563eb;color:#fff;padding:8px 16px;border-radius:8px;font-size:14px;font-weight:600;text-decoration:none;">
                            Edit Data
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection