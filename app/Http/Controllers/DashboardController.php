<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Bagian;
use App\Models\StatusBarang;
use App\Models\JenisBarang;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBarang = Barang::count();
        $totalBagian = Bagian::count();
        $totalJenis = JenisBarang::count();
        
        // Statistik berdasarkan status
        $statusStats = StatusBarang::withCount('barang')->get();
        
        // Statistik berdasarkan bagian
        $bagianStats = Bagian::withCount('barang')->get();
        
        // Barang terbaru
        $barangTerbaru = Barang::with(['bagian', 'jenisBarang', 'tipeBarang', 'statusBarang'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        
        return view('dashboard', compact(
            'totalBarang', 
            'totalBagian', 
            'totalJenis', 
            'statusStats', 
            'bagianStats', 
            'barangTerbaru'
        ));
    }
}
