<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeBarang extends Model
{
    use HasFactory;

    protected $table = 'tipe_barang';
    protected $primaryKey = 'id_tipe';
    protected $fillable = [
        'nama_tipe',
        'id_jenis'
    ];

    // Relasi dengan JenisBarang
    public function jenisBarang()
    {
        return $this->belongsTo(JenisBarang::class, 'id_jenis', 'id_jenis');
    }

    // Relasi dengan Barang
    public function barang()
    {
        return $this->hasMany(Barang::class, 'id_tipe', 'id_tipe');
    }
}
