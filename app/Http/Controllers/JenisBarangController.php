<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisBarang;

class JenisBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenis = JenisBarang::withCount(['barang', 'tipeBarang'])->orderBy('kode_jenis')->paginate(10);
        return view('jenis-barang.index', compact('jenis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jenis-barang.create');
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
            'kode_jenis' => 'required|string|max:2|unique:jenis_barang,kode_jenis',
            'nama_jenis' => 'required|string|max:100',
        ]);

        JenisBarang::create($request->all());

        return redirect()->route('jenis-barang.index')->with('success', 'Jenis barang berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jenis = JenisBarang::with(['barang.bagian', 'barang.statusBarang', 'tipeBarang'])->findOrFail($id);
        return view('jenis-barang.show', compact('jenis'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jenis = JenisBarang::findOrFail($id);
        return view('jenis-barang.edit', compact('jenis'));
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
            'kode_jenis' => 'required|string|max:2|unique:jenis_barang,kode_jenis,' . $id . ',id_jenis',
            'nama_jenis' => 'required|string|max:100',
        ]);

        $jenis = JenisBarang::findOrFail($id);
        $jenis->update($request->all());

        return redirect()->route('jenis-barang.index')->with('success', 'Jenis barang berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jenis = JenisBarang::findOrFail($id);
        
        // Cek apakah ada barang yang menggunakan jenis ini
        if ($jenis->barang()->count() > 0) {
            return redirect()->route('jenis-barang.index')->with('error', 'Tidak dapat menghapus jenis yang masih memiliki barang');
        }
        
        // Cek apakah ada tipe yang menggunakan jenis ini
        if ($jenis->tipeBarang()->count() > 0) {
            return redirect()->route('jenis-barang.index')->with('error', 'Tidak dapat menghapus jenis yang masih memiliki tipe barang');
        }
        
        $jenis->delete();

        return redirect()->route('jenis-barang.index')->with('success', 'Jenis barang berhasil dihapus');
    }
}
