<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ruang_poliklinik', function (Blueprint $table) {
            $table->id();
            $table->string('kode_ruang')->unique();
            $table->string('nama_poli');
            $table->string('blok_gedung');
            $table->unsignedInteger('lantai');
            $table->string('nomor_ruang');
            $table->string('status_poli')->default('Aktif');
            $table->text('inventaris_alat');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ruang_poliklinik');
    }
};