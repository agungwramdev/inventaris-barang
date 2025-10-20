<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Bagian;
use App\Models\StatusBarang;
use App\Models\JenisBarang;
use App\Models\TipeBarang;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Barang::with(['bagian', 'jenisBarang', 'tipeBarang', 'statusBarang']);
        
        // Filter berdasarkan pencarian
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('nama_barang', 'like', '%' . $request->search . '%')
                  ->orWhere('kode_barang', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
            });
        }
        
        // Filter berdasarkan bagian
        if ($request->has('bagian') && $request->bagian) {
            $query->where('id_bagian', $request->bagian);
        }
        
        // Filter berdasarkan status
        if ($request->has('status') && $request->status) {
            $query->where('id_status', $request->status);
        }
        
        $barang = $query->orderBy('created_at', 'desc')->paginate(15);
        
        $bagian = Bagian::all();
        $status = StatusBarang::all();
        
        return view('barang.index', compact('barang', 'bagian', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bagian = Bagian::all();
        $status = StatusBarang::all();
        $jenis = JenisBarang::all();
        $tipe = TipeBarang::all();
        
        return view('barang.create', compact('bagian', 'status', 'jenis', 'tipe'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:200',
            'id_bagian' => 'required|exists:bagian,id_bagian',
            'id_jenis' => 'required|exists:jenis_barang,id_jenis',
            'id_tipe' => 'required|exists:tipe_barang,id_tipe',
            'id_status' => 'required|exists:status_barang,id_status',
            'tanggal_masuk' => 'required|date',
            'harga' => 'nullable|numeric|min:0',
            'lokasi' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string',
            'keterangan' => 'nullable|string',
        ]);

        try {
            // Generate kode barang otomatis
            $kodeBarang = Barang::generateKodeBarang($request->id_bagian, $request->id_jenis);
            
            $barang = Barang::create([
                'kode_barang' => $kodeBarang,
                'nama_barang' => $request->nama_barang,
                'deskripsi' => $request->deskripsi,
                'id_bagian' => $request->id_bagian,
                'id_jenis' => $request->id_jenis,
                'id_tipe' => $request->id_tipe,
                'id_status' => $request->id_status,
                'tanggal_masuk' => $request->tanggal_masuk,
                'harga' => $request->harga,
                'lokasi' => $request->lokasi,
                'keterangan' => $request->keterangan,
            ]);

            return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan dengan kode: ' . $kodeBarang);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan barang: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $barang = Barang::with(['bagian', 'jenisBarang', 'tipeBarang', 'statusBarang'])->findOrFail($id);
        return view('barang.show', compact('barang'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $bagian = Bagian::all();
        $status = StatusBarang::all();
        $jenis = JenisBarang::all();
        $tipe = TipeBarang::where('id_jenis', $barang->id_jenis)->get();
        
        return view('barang.edit', compact('barang', 'bagian', 'status', 'jenis', 'tipe'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:200',
            'id_bagian' => 'required|exists:bagian,id_bagian',
            'id_jenis' => 'required|exists:jenis_barang,id_jenis',
            'id_tipe' => 'required|exists:tipe_barang,id_tipe',
            'id_status' => 'required|exists:status_barang,id_status',
            'tanggal_masuk' => 'required|date',
            'harga' => 'nullable|numeric|min:0',
            'lokasi' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string',
            'keterangan' => 'nullable|string',
        ]);

        $barang = Barang::findOrFail($id);
        
        $barang->update([
            'nama_barang' => $request->nama_barang,
            'deskripsi' => $request->deskripsi,
            'id_bagian' => $request->id_bagian,
            'id_jenis' => $request->id_jenis,
            'id_tipe' => $request->id_tipe,
            'id_status' => $request->id_status,
            'tanggal_masuk' => $request->tanggal_masuk,
            'harga' => $request->harga,
            'lokasi' => $request->lokasi,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus');
    }

    /**
     * Get tipe barang berdasarkan jenis
     */
    public function getTipeByJenis($idJenis)
    {
        $tipe = TipeBarang::where('id_jenis', $idJenis)->get();
        return response()->json($tipe);
    }
}
