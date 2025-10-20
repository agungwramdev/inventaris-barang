<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StatusBarang;

class StatusBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = StatusBarang::withCount('barang')->orderBy('nama_status')->paginate(10);
        return view('status-barang.index', compact('status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('status-barang.create');
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
            'nama_status' => 'required|string|max:50|unique:status_barang,nama_status',
        ]);

        StatusBarang::create($request->all());

        return redirect()->route('status-barang.index')->with('success', 'Status barang berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $status = StatusBarang::with('barang.jenisBarang', 'barang.bagian')->findOrFail($id);
        return view('status-barang.show', compact('status'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $status = StatusBarang::findOrFail($id);
        return view('status-barang.edit', compact('status'));
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
            'nama_status' => 'required|string|max:50|unique:status_barang,nama_status,' . $id . ',id_status',
        ]);

        $status = StatusBarang::findOrFail($id);
        $status->update($request->all());

        return redirect()->route('status-barang.index')->with('success', 'Status barang berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = StatusBarang::findOrFail($id);
        
        // Cek apakah ada barang yang menggunakan status ini
        if ($status->barang()->count() > 0) {
            return redirect()->route('status-barang.index')->with('error', 'Tidak dapat menghapus status yang masih memiliki barang');
        }
        
        $status->delete();

        return redirect()->route('status-barang.index')->with('success', 'Status barang berhasil dihapus');
    }
}
