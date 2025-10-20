<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BagianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bagian = [
            [
                'kode_bagian' => 'A',
                'nama_bagian' => 'Bagian A - Administrasi Umum',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_bagian' => 'B',
                'nama_bagian' => 'Bagian B - Pengadaan Barang dan Jasa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_bagian' => 'C',
                'nama_bagian' => 'Bagian C - Keuangan dan Aset',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        \App\Models\Bagian::insert($bagian);
    }
}
