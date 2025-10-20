<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bagian extends Model
{
    use HasFactory;

    protected $table = 'bagian';
    protected $primaryKey = 'id_bagian';
    protected $fillable = [
        'kode_bagian',
        'nama_bagian'
    ];

    // Relasi dengan Barang
    public function barang()
    {
        return $this->hasMany(Barang::class, 'id_bagian', 'id_bagian');
    }
}
