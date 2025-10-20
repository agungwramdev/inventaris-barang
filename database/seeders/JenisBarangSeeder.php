<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class JenisBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jenis = [
            [
                'kode_jenis' => '01',
                'nama_jenis' => 'Komputer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_jenis' => '02',
                'nama_jenis' => 'Monitor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_jenis' => '03',
                'nama_jenis' => 'Printer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_jenis' => '04',
                'nama_jenis' => 'Laptop',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_jenis' => '05',
                'nama_jenis' => 'Meja',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_jenis' => '06',
                'nama_jenis' => 'Kursi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_jenis' => '07',
                'nama_jenis' => 'Lemari',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_jenis' => '08',
                'nama_jenis' => 'AC',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        \App\Models\JenisBarang::insert($jenis);
    }
}
