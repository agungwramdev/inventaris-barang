<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBarang extends Model
{
    use HasFactory;

    protected $table = 'jenis_barang';
    protected $primaryKey = 'id_jenis';
    protected $fillable = [
        'kode_jenis',
        'nama_jenis'
    ];

    // Relasi dengan TipeBarang
    public function tipeBarang()
    {
        return $this->hasMany(TipeBarang::class, 'id_jenis', 'id_jenis');
    }

    // Relasi dengan Barang
    public function barang()
    {
        return $this->hasMany(Barang::class, 'id_jenis', 'id_jenis');
    }
}
