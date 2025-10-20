<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $primaryKey = 'id_barang';
    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'deskripsi',
        'id_bagian',
        'id_jenis',
        'id_tipe',
        'id_status',
        'tanggal_masuk',
        'harga',
        'lokasi',
        'keterangan'
    ];

    protected $casts = [
        'tanggal_masuk' => 'date',
        'harga' => 'integer'
    ];

    // Relasi dengan Bagian
    public function bagian()
    {
        return $this->belongsTo(Bagian::class, 'id_bagian', 'id_bagian');
    }

    // Relasi dengan JenisBarang
    public function jenisBarang()
    {
        return $this->belongsTo(JenisBarang::class, 'id_jenis', 'id_jenis');
    }

    // Relasi dengan TipeBarang
    public function tipeBarang()
    {
        return $this->belongsTo(TipeBarang::class, 'id_tipe', 'id_tipe');
    }

    // Relasi dengan StatusBarang
    public function statusBarang()
    {
        return $this->belongsTo(StatusBarang::class, 'id_status', 'id_status');
    }

    // Method untuk generate kode barang otomatis
    public static function generateKodeBarang($idBagian, $idJenis)
    {
        $bagian = Bagian::find($idBagian);
        $jenis = JenisBarang::find($idJenis);
        
        if (!$bagian || !$jenis) {
            throw new \Exception('Bagian atau Jenis Barang tidak ditemukan');
        }

        $kodeBagian = $bagian->kode_bagian;
        $kodeJenis = $jenis->kode_jenis;
        $tanggal = Carbon::now()->format('dmy');
        
        // Cari nomor urut terakhir untuk kombinasi ini
        $lastBarang = self::where('kode_barang', 'like', $kodeBagian . $kodeJenis . $tanggal . '%')
            ->orderBy('kode_barang', 'desc')
            ->first();
        
        if ($lastBarang) {
            $lastNumber = (int) substr($lastBarang->kode_barang, -3);
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }
        
        return $kodeBagian . $kodeJenis . $tanggal . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
    }

    // Accessor untuk format harga Rupiah
    public function getHargaRupiahAttribute()
    {
        if ($this->harga) {
            return 'Rp ' . number_format($this->harga, 0, ',', '.');
        }
        return '-';
    }
}
