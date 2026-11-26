<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RuangPoliklinik extends Model
{
    protected $table = 'ruang_poliklinik';

    protected $fillable = [
        'kode_ruang',
        'nama_poli',
        'blok_gedung',
        'lantai',
        'nomor_ruang',
        'status_poli',
        'inventaris_alat',
    ];
}