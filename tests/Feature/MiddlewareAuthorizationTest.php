<?php

namespace Tests\Feature;

use App\Models\Pengaduan;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class MiddlewareAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    private Pengaduan $pengaduan;

    protected function setUp(): void
    {
        parent::setUp();

        // Tabel pengaduan belum punya migration (dibuat lewat db_desahub.sql)
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('email', 50);
            $table->string('kategori');
            $table->string('deskripsi', 200);
            $table->string('status')->default('Pending');
            $table->timestamp('created_at')->nullable();
        });

        $this->pengaduan = Pengaduan::create([
            'nama' => 'Budi',
            'email' => 'budi@example.com',
            'kategori' => 'Jalan Rusak',
            'deskripsi' => 'Jalan berlubang',
            'status' => 'Pending',
        ]);
    }

    private function user(string $role): User
    {
        return User::create(['username' => $role, 'password' => 'secret123', 'role' => $role]);
    }

    public function test_tamu_diarahkan_ke_login_saat_akses_halaman_edit(): void
    {
        $this->get(route('pengaduan.edit', $this->pengaduan))->assertRedirect(route('login'));
        $this->delete(route('pengaduan.destroy', $this->pengaduan))->assertRedirect(route('login'));
    }

    public function test_user_yang_sudah_login_tidak_bisa_membuka_halaman_login(): void
    {
        $this->actingAs($this->user('admin'))
            ->get(route('login'))
            ->assertRedirect(route('pengaduan.daftar'));
    }

    public function test_admin_boleh_edit_semua_field_dan_hapus(): void
    {
        $admin = $this->user('admin');

        $this->actingAs($admin)->get(route('pengaduan.edit', $this->pengaduan))->assertOk();

        $this->actingAs($admin)->put(route('pengaduan.update', $this->pengaduan), [
            'nama' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'kategori' => 'Kebersihan',
            'status' => 'Diproses',
            'deskripsi' => 'Sampah menumpuk',
        ])->assertRedirect(route('pengaduan.daftar'));

        $this->assertDatabaseHas('pengaduan', ['nama' => 'Budi Santoso', 'status' => 'Diproses']);

        $this->actingAs($admin)->delete(route('pengaduan.destroy', $this->pengaduan))
            ->assertRedirect(route('pengaduan.daftar'));

        $this->assertDatabaseCount('pengaduan', 0);
    }

    public function test_petugas_hanya_boleh_mengubah_status(): void
    {
        $petugas = $this->user('petugas');

        $this->actingAs($petugas)->get(route('pengaduan.edit', $this->pengaduan))->assertOk();

        $this->actingAs($petugas)->put(route('pengaduan.update', $this->pengaduan), [
            'nama' => 'Nama Diganti',
            'status' => 'Selesai',
        ])->assertRedirect(route('pengaduan.daftar'));

        $this->assertDatabaseHas('pengaduan', ['nama' => 'Budi', 'status' => 'Selesai']);
    }

    public function test_petugas_tidak_boleh_menghapus(): void
    {
        $this->actingAs($this->user('petugas'))
            ->delete(route('pengaduan.destroy', $this->pengaduan))
            ->assertForbidden();

        $this->assertDatabaseCount('pengaduan', 1);
    }

    public function test_role_lain_ditolak_oleh_middleware_role(): void
    {
        $this->actingAs($this->user('warga'))
            ->get(route('pengaduan.edit', $this->pengaduan))
            ->assertForbidden();
    }

    public function test_tombol_aksi_sesuai_hak_akses(): void
    {
        $this->actingAs($this->user('petugas'))
            ->get(route('pengaduan.daftar'))
            ->assertSee('Edit')
            ->assertDontSee('Hapus');

        $this->actingAs($this->user('admin'))
            ->get(route('pengaduan.daftar'))
            ->assertSee('Edit')
            ->assertSee('Hapus');
    }
}
