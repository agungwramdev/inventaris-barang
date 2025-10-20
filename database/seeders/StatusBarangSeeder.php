<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StatusBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            [
                'nama_status' => 'Tersedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_status' => 'Rusak',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_status' => 'Dipinjam',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_status' => 'Dihapuskan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_status' => 'Dalam Perbaikan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        \App\Models\StatusBarang::insert($status);
    }
}
