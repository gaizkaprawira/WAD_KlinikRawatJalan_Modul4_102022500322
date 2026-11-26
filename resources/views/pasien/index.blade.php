<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pasien - Klinik Rawat Jalan</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body style="background: linear-gradient(135deg, #f0f4f8 0%, #d9e2ec 100%); min-height: 100vh; margin: 0; font-family: Arial, sans-serif;">
    
    <!-- Navbar Atas Dashboard -->
    <nav style="background-color: #102a43; color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
        <div style="display: flex; align-items: center; gap: 12px;">
            <div style="background-color: #243b53; padding: 8px 12px; border-radius: 6px; font-weight: bold; font-size: 14px;">Klinik Rawat Jalan</div>
            <span style="font-size: 14px; opacity: 0.8;">Dashboard Pasien</span>
        </div>
        
        <!-- Tombol Logout -->
        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
            @csrf
            <button type="submit" style="background-color: #dc3545; color: white; padding: 8px 16px; border-radius: 6px; border: none; cursor: pointer; font-weight: bold; font-size: 13px;">
                Logout
            </button>
        </form>
    </nav>

    <!-- Konten Utama -->
    <div class="container" style="max-width: 1000px; margin: 30px auto; padding: 0 15px;">
        
        <!-- Header Halaman Pasien & Tombol Tambah -->
        <div style="background: white; border-radius: 12px; padding: 20px 25px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 8px 24px rgba(16,42,67,0.08); margin-bottom: 20px;">
            <div>
                <h2 style="margin: 0; font-size: 20px; font-weight: bold; color: #102a43;">Daftar Pasien Terdaftar</h2>
                <p style="margin: 5px 0 0 0; font-size: 13px; color: #627d98;">Kelola data pasien klinik dengan mudah dan cepat di sini.</p>
            </div>
            <a href="{{ route('pasiens.create') }}" style="background-color: #28a745; color: white; padding: 10px 18px; text-decoration: none; border-radius: 6px; font-weight: bold; font-size: 14px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">+ Tambah Pasien Baru</a>
        </div>

        <!-- Tabel Data Pasien -->
        <div style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 8px 24px rgba(16,42,67,0.08);">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="background-color: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                        <th style="padding: 15px; text-align: center; width: 8%; color: #555; font-size: 13px;">No</th>
                        <th style="padding: 15px; width: 22%; color: #555; font-size: 13px;">Profil Pasien</th>
                        <th style="padding: 15px; width: 18%; color: #555; font-size: 13px;">No. Rekam Medis</th>
                        <th style="padding: 15px; width: 27%; color: #555; font-size: 13px;">Domisili</th>
                        <th style="padding: 15px; width: 15%; color: #555; font-size: 13px;">Kontak Darurat</th>
                        <th style="padding: 15px; text-align: center; width: 10%; color: #555; font-size: 13px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pasiens as $index => $row)
                    <tr style="border-bottom: 1px solid #eee; transition: background 0.2s;">
                        <td style="padding: 15px; text-align: center; font-size: 14px; color: #555;">{{ $index + 1 }}</td>
                        <td style="padding: 15px; font-weight: 600; color: #333; font-size: 14px;">{{ $row->profil_pasien }}</td>
                        <td style="padding: 15px; color: #555; font-size: 14px;">{{ $row->nomor_rekam_medis }}</td>
                        <td style="padding: 15px; color: #555; font-size: 14px;">{{ $row->domisili }}</td>
                        <td style="padding: 15px; color: #555; font-size: 14px;">{{ $row->kontak_darurat }}</td>
                        <td style="padding: 15px; text-align: center;">
                            <div style="display: flex; flex-direction: column; gap: 6px; align-items: center;">
                                <a href="{{ route('pasiens.edit', $row->id) }}" style="background-color: #ffc107; color: #000; padding: 6px 12px; font-size: 11px; width: 65px; text-align: center; border-radius: 4px; text-decoration: none; font-weight: bold;">Edit</a>
                                <form action="{{ route('pasiens.destroy', $row->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data pasien ini?')" style="margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background-color: #dc3545; color: white; padding: 6px 12px; font-size: 11px; width: 65px; text-align: center; border-radius: 4px; border: none; cursor: pointer; font-weight: bold;">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="padding: 40px; text-align: center; color: #6c757d; font-size: 14px;">Belum ada data pasien yang terdaftar.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>