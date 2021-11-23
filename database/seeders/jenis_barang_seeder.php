<?php

namespace Database\Seeders;

use App\Models\JenisBarang;
use Illuminate\Database\Seeder;

class jenis_barang_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JenisBarang::create([
            'nama_jenis_barang' => 'Celana Panjang'
        ]);
        JenisBarang::create([
            'nama_jenis_barang' => 'Kemeja'
        ]);
        JenisBarang::create([
            'nama_jenis_barang' => 'Tuxedo'
        ]);
    }
}
