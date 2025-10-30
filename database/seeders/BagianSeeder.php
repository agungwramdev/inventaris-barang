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
                'nama_bagian' => 'Bagian A - Bagian Pengelolaan Pengadaan Barang dan Jasa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_bagian' => 'B',
                'nama_bagian' => 'Bagian B - Bagian Pengelolaan Layanan Pengadaan Secara Elektronik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_bagian' => 'C',
                'nama_bagian' => 'Bagian C - Bagian Pembinaan dan Advokasi Pengadaan Barang dan Jasa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        \App\Models\Bagian::insert($bagian);
    }
}
