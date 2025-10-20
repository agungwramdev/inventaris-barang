@extends('layouts.app')

@section('title', 'Detail Barang - Inventaris')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-dark mb-0">
                <i class="fas fa-eye text-primary me-2"></i>
                Detail Barang
            </h2>
            <div class="btn-group">
                <a href="{{ route('barang.edit', $barang->id_barang) }}" class="btn btn-warning">
                    <i class="fas fa-edit me-1"></i>
                    Edit
                </a>
                <a href="{{ route('barang.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>
                    Kembali
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-info-circle me-2"></i>
                    Informasi Barang
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Kode Barang</label>
                        <div>
                            <span class="badge bg-primary fs-6">{{ $barang->kode_barang }}</span>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Nama Barang</label>
                        <div class="fs-5">{{ $barang->nama_barang }}</div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Bagian</label>
                        <div>
                            <span class="badge bg-secondary me-2">{{ $barang->bagian->kode_bagian }}</span>
                            {{ $barang->bagian->nama_bagian }}
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Jenis Barang</label>
                        <div>
                            <span class="badge bg-info me-2">{{ $barang->jenisBarang->kode_jenis }}</span>
                            {{ $barang->jenisBarang->nama_jenis }}
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Tipe Barang</label>
                        <div>{{ $barang->tipeBarang->nama_tipe }}</div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Status</label>
                        <div>
                            @php
                                $statusColors = [
                                    'Tersedia' => 'success',
                                    'Rusak' => 'danger',
                                    'Dipinjam' => 'warning',
                                    'Dihapuskan' => 'secondary',
                                    'Dalam Perbaikan' => 'info'
                                ];
                                $color = $statusColors[$barang->statusBarang->nama_status] ?? 'secondary';
                            @endphp
                            <span class="badge bg-{{ $color }} fs-6">{{ $barang->statusBarang->nama_status }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Tanggal Masuk</label>
                        <div>
                            <i class="fas fa-calendar me-2 text-muted"></i>
                            {{ $barang->tanggal_masuk->format('d F Y') }}
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Harga</label>
                        <div>
                            @if($barang->harga)
                                <i class="fas fa-money-bill-wave me-2 text-muted"></i>
                                Rp {{ number_format($barang->harga, 0, ',', '.') }}
                            @else
                                <span class="text-muted">Tidak ada harga</span>
                            @endif
                        </div>
                    </div>
                </div>
                
                @if($barang->lokasi)
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Lokasi</label>
                        <div>
                            <i class="fas fa-map-marker-alt me-2 text-muted"></i>
                            {{ $barang->lokasi }}
                        </div>
                    </div>
                </div>
                @endif
                
                @if($barang->deskripsi)
                <div class="mb-3">
                    <label class="form-label fw-bold">Deskripsi</label>
                    <div class="border rounded p-3 bg-light">
                        {{ $barang->deskripsi }}
                    </div>
                </div>
                @endif
                
                @if($barang->keterangan)
                <div class="mb-3">
                    <label class="form-label fw-bold">Keterangan</label>
                    <div class="border rounded p-3 bg-light">
                        {{ $barang->keterangan }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-history me-2"></i>
                    Informasi Sistem
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">Dibuat</label>
                    <div class="text-muted">
                        <i class="fas fa-clock me-2"></i>
                        {{ $barang->created_at->format('d F Y H:i') }}
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Terakhir Diupdate</label>
                    <div class="text-muted">
                        <i class="fas fa-edit me-2"></i>
                        {{ $barang->updated_at->format('d F Y H:i') }}
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">ID Barang</label>
                    <div class="text-muted">
                        <i class="fas fa-hashtag me-2"></i>
                        {{ $barang->id_barang }}
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-cogs me-2"></i>
                    Aksi
                </h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('barang.edit', $barang->id_barang) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-2"></i>
                        Edit Barang
                    </a>
                    
                    <form action="{{ route('barang.destroy', $barang->id_barang) }}" method="POST" 
                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="fas fa-trash me-2"></i>
                            Hapus Barang
                        </button>
                    </form>
                    
                    <a href="{{ route('barang.index') }}" class="btn btn-secondary">
                        <i class="fas fa-list me-2"></i>
                        Lihat Semua Barang
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
