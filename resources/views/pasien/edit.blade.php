<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Pasien - Klinik Rawat Jalan</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body style="background: linear-gradient(135deg, #f0f4f8 0%, #d9e2ec 100%); min-height: 100vh; margin: 0; padding: 20px 0;">
    <div class="container" style="max-width: 650px; margin: 20px auto; font-family: Arial, sans-serif;">
        <div style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 8px 24px rgba(16,42,67,0.1);">
            
            <!-- Header Navy Elegan -->
            <div style="background-color: #102a43; color: white; padding: 22px 25px;">
                <h2 style="margin: 0; font-size: 20px; font-weight: bold;">Edit Data Pasien</h2>
                <p style="margin: 5px 0 0 0; font-size: 13px; opacity: 0.85;">Perbarui informasi data pasien di bawah ini.</p>
            </div>

            <!-- Bagian Form -->
            <div style="padding: 25px;">
                <form action="{{ route('pasiens.update', $pasien->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div style="margin-bottom: 18px;">
                        <label style="display: block; font-weight: 600; margin-bottom: 6px; color: #444; font-size: 14px;">Profil Pasien / Nama Lengkap:</label>
                        <input type="text" name="profil_pasien" value="{{ old('profil_pasien', $pasien->profil_pasien) }}" required style="width: 100%; padding: 10px 12px; border: 1px solid #ced4da; border-radius: 6px; box-sizing: border-box; font-size: 14px;">
                    </div>

                    <div style="margin-bottom: 18px;">
                        <label style="display: block; font-weight: 600; margin-bottom: 6px; color: #444; font-size: 14px;">Nomor Rekam Medis:</label>
                        <input type="text" name="nomor_rekam_medis" value="{{ old('nomor_rekam_medis', $pasien->nomor_rekam_medis) }}" required style="width: 100%; padding: 10px 12px; border: 1px solid #ced4da; border-radius: 6px; box-sizing: border-box; font-size: 14px;">
                    </div>

                    <div style="margin-bottom: 18px;">
                        <label style="display: block; font-weight: 600; margin-bottom: 6px; color: #444; font-size: 14px;">Domisili / Alamat:</label>
                        <textarea name="domisili" rows="3" required style="width: 100%; padding: 10px 12px; border: 1px solid #ced4da; border-radius: 6px; box-sizing: border-box; font-size: 14px; resize: vertical;">{{ old('domisili', $pasien->domisili) }}</textarea>
                    </div>

                    <div style="margin-bottom: 25px;">
                        <label style="display: block; font-weight: 600; margin-bottom: 6px; color: #444; font-size: 14px;">Kontak Darurat (No HP/Telp):</label>
                        <input type="text" name="kontak_darurat" value="{{ old('kontak_darurat', $pasien->kontak_darurat) }}" required style="width: 100%; padding: 10px 12px; border: 1px solid #ced4da; border-radius: 6px; box-sizing: border-box; font-size: 14px;">
                    </div>

                    <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #eee; padding-top: 20px;">
                        <a href="{{ route('pasiens.index') }}" style="color: #6c757d; text-decoration: none; font-weight: 600; font-size: 14px;">← Kembali</a>
                        <button type="submit" style="background-color: #102a43; color: white; padding: 10px 22px; border: none; border-radius: 6px; font-weight: bold; cursor: pointer; font-size: 14px; box-shadow: 0 4px 10px rgba(16,42,67,0.2);">Simpan Perubahan</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</body>
</html>