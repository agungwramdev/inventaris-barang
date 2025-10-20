<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusBarang extends Model
{
    use HasFactory;

    protected $table = 'status_barang';
    protected $primaryKey = 'id_status';
    protected $fillable = [
        'nama_status'
    ];

    // Relasi dengan Barang
    public function barang()
    {
        return $this->hasMany(Barang::class, 'id_status', 'id_status');
    }
}
