<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bagian;

class BagianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bagian = Bagian::withCount('barang')->orderBy('kode_bagian')->paginate(10);
        return view('bagian.index', compact('bagian'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bagian.create');
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
            'kode_bagian' => 'required|string|max:1|unique:bagian,kode_bagian',
            'nama_bagian' => 'required|string|max:100',
        ]);

        Bagian::create($request->all());

        return redirect()->route('bagian.index')->with('success', 'Bagian berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bagian = Bagian::with('barang.jenisBarang', 'barang.statusBarang')->findOrFail($id);
        return view('bagian.show', compact('bagian'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bagian = Bagian::findOrFail($id);
        return view('bagian.edit', compact('bagian'));
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
            'kode_bagian' => 'required|string|max:1|unique:bagian,kode_bagian,' . $id . ',id_bagian',
            'nama_bagian' => 'required|string|max:100',
        ]);

        $bagian = Bagian::findOrFail($id);
        $bagian->update($request->all());

        return redirect()->route('bagian.index')->with('success', 'Bagian berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bagian = Bagian::findOrFail($id);
        
        // Cek apakah ada barang yang menggunakan bagian ini
        if ($bagian->barang()->count() > 0) {
            return redirect()->route('bagian.index')->with('error', 'Tidak dapat menghapus bagian yang masih memiliki barang');
        }
        
        $bagian->delete();

        return redirect()->route('bagian.index')->with('success', 'Bagian berhasil dihapus');
    }
}
