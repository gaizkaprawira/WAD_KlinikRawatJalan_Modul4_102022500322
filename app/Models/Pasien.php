<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
   protected $fillable = [
    'profil_pasien', 
    'nomor_rekam_medis', 
    'domisili', 
    'kontak_darurat'
];
}
