<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipeBarang;
use App\Models\JenisBarang;

class TipeBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipe = TipeBarang::with(['jenisBarang'])->withCount('barang')->orderBy('nama_tipe')->paginate(10);
        return view('tipe-barang.index', compact('tipe'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenis = JenisBarang::orderBy('nama_jenis')->get();
        return view('tipe-barang.create', compact('jenis'));
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
            'nama_tipe' => 'required|string|max:100',
            'id_jenis' => 'required|exists:jenis_barang,id_jenis',
        ]);

        TipeBarang::create($request->all());

        return redirect()->route('tipe-barang.index')->with('success', 'Tipe barang berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipe = TipeBarang::with(['jenisBarang', 'barang.bagian', 'barang.statusBarang'])->findOrFail($id);
        return view('tipe-barang.show', compact('tipe'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipe = TipeBarang::findOrFail($id);
        $jenis = JenisBarang::orderBy('nama_jenis')->get();
        return view('tipe-barang.edit', compact('tipe', 'jenis'));
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
            'nama_tipe' => 'required|string|max:100',
            'id_jenis' => 'required|exists:jenis_barang,id_jenis',
        ]);

        $tipe = TipeBarang::findOrFail($id);
        $tipe->update($request->all());

        return redirect()->route('tipe-barang.index')->with('success', 'Tipe barang berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipe = TipeBarang::findOrFail($id);
        
        // Cek apakah ada barang yang menggunakan tipe ini
        if ($tipe->barang()->count() > 0) {
            return redirect()->route('tipe-barang.index')->with('error', 'Tidak dapat menghapus tipe yang masih memiliki barang');
        }
        
        $tipe->delete();

        return redirect()->route('tipe-barang.index')->with('success', 'Tipe barang berhasil dihapus');
    }
}
