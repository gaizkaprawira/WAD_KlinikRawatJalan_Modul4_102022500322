<?php

namespace Database\Seeders;

use App\Models\Obat;
use Illuminate\Database\Seeder;

class ObatSeeder extends Seeder
{
    public function run(): void
    {
        if (Obat::query()->exists()) {
            return;
        }

        $data = [
            [
                'nama_obat' => 'Paracetamol 500mg',
                'kategori'  => 'Obat Bebas',
                'sediaan'   => 'Tablet',
                'pabrikan'  => 'PT Kimia Farma',
                'harga'     => 5000,
                'stok'      => 100,
            ],
            [
                'nama_obat' => 'Amoxicillin 500mg',
                'kategori'  => 'Obat Keras',
                'sediaan'   => 'Kapsul',
                'pabrikan'  => 'PT Kalbe Farma',
                'harga'     => 12000,
                'stok'      => 50,
            ],
            [
                'nama_obat' => 'OBH Combi Batuk',
                'kategori'  => 'Obat Bebas Terbatas',
                'sediaan'   => 'Sirup',
                'pabrikan'  => 'PT Combiphar',
                'harga'     => 18000,
                'stok'      => 8,
            ],
        ];

        foreach ($data as $item) {
            Obat::create($item);
        }
    }
}