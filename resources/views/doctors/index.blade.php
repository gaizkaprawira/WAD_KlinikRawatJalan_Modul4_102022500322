@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6">
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Rekapitulasi Data Dokter</h1>
            <p class="text-sm text-gray-500">Daftar tenaga medis dan jadwal poliklinik rawat jalan</p>
        </div>

        @if (strtolower(auth()->user()->role ?? '') === 'admin')
            <a href="{{ route('doctors.create') }}"
               style="background-color:#2563eb;color:#fff;padding:10px 18px;border-radius:8px;font-weight:600;text-decoration:none;display:inline-block;">
                + Tambah Dokter
            </a>
        @endif
    </div>

    @if (session('success'))
        <div style="background-color:#dcfce7;border:1px solid #86efac;color:#166534;padding:12px 16px;border-radius:8px;margin-bottom:20px;">
            {{ session('success') }}
        </div>
    @endif

    @if ($doctors->isEmpty())
        <div style="background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:40px;text-align:center;color:#6b7280;">
            Belum ada data dokter terdaftar.
        </div>
    @else
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:20px;">
            @foreach ($doctors as $doctor)
                <div style="background:#fff;border:1px solid #e5e7eb;border-radius:12px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,0.08);display:flex;flex-direction:column;">
                    @if ($doctor->foto)
                        <img src="{{ asset('storage/' . $doctor->foto) }}"
                             alt="{{ $doctor->nama }}"
                             style="width:100%;height:200px;object-fit:cover;background:#f3f4f6;">
                    @else
                        <div style="width:100%;height:200px;background:#e0e7ff;color:#3730a3;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:18px;">
                            Foto Tidak Tersedia
                        </div>
                    @endif

                    <div style="padding:18px;flex:1;">
                        <span style="display:inline-block;background:#eff6ff;color:#1d4ed8;font-size:12px;font-weight:600;padding:3px 10px;border-radius:999px;margin-bottom:8px;">
                            {{ $doctor->spesialis }}
                        </span>
                        <h2 style="font-size:18px;font-weight:700;color:#111827;margin:0 0 8px 0;">{{ $doctor->nama }}</h2>
                        <p style="font-size:13px;color:#4b5563;margin:4px 0;"><strong>SIP:</strong> {{ $doctor->no_sip }}</p>
                        <p style="font-size:13px;color:#4b5563;margin:4px 0;"><strong>Ruangan:</strong> {{ $doctor->ruangan }}</p>
                        <p style="font-size:13px;color:#4b5563;margin:4px 0;"><strong>Kontak:</strong> {{ $doctor->kontak }}</p>
                    </div>

                    <div style="padding:12px 18px;background:#f9fafb;border-top:1px solid #e5e7eb;display:flex;align-items:center;gap:8px;">
                        <a href="{{ route('doctors.show', $doctor->id) }}"
                           style="background:#e0f2fe;color:#0369a1;padding:6px 12px;border-radius:6px;font-size:13px;font-weight:600;text-decoration:none;">
                            Detail
                        </a>

                        @if (strtolower(auth()->user()->role ?? '') === 'admin')
                            <a href="{{ route('doctors.edit', $doctor->id) }}"
                               style="background:#fef3c7;color:#b45309;padding:6px 12px;border-radius:6px;font-size:13px;font-weight:600;text-decoration:none;">
                                Edit
                            </a>

                            <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus data dokter ini?');"
                                  style="margin-left:auto;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        style="background:#fee2e2;color:#b91c1c;padding:6px 12px;border-radius:6px;font-size:13px;font-weight:600;border:none;cursor:pointer;">
                                    Hapus
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection