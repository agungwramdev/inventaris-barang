<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TipeBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipe = [
            // Monitor
            [
                'nama_tipe' => 'LED 24 Inch',
                'id_jenis' => 2, // Monitor
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tipe' => 'LED 22 Inch',
                'id_jenis' => 2, // Monitor
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tipe' => 'LED 19 Inch',
                'id_jenis' => 2, // Monitor
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Printer
            [
                'nama_tipe' => 'LaserJet 1020',
                'id_jenis' => 3, // Printer
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tipe' => 'Inkjet Canon',
                'id_jenis' => 3, // Printer
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tipe' => 'Multifunction HP',
                'id_jenis' => 3, // Printer
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Laptop
            [
                'nama_tipe' => 'Dell Latitude',
                'id_jenis' => 4, // Laptop
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tipe' => 'HP ProBook',
                'id_jenis' => 4, // Laptop
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tipe' => 'Lenovo ThinkPad',
                'id_jenis' => 4, // Laptop
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Meja
            [
                'nama_tipe' => 'Meja Kerja Kayu',
                'id_jenis' => 5, // Meja
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tipe' => 'Meja Kerja Metal',
                'id_jenis' => 5, // Meja
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Kursi
            [
                'nama_tipe' => 'Kursi Kantor Ergonomic',
                'id_jenis' => 6, // Kursi
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tipe' => 'Kursi Kantor Standard',
                'id_jenis' => 6, // Kursi
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        \App\Models\TipeBarang::insert($tipe);
    }
}
