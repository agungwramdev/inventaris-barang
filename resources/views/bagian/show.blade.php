@extends('layouts.app')

@section('title', 'Detail Bagian - Master Data')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-dark mb-0">
                <i class="fas fa-eye text-primary me-2"></i>
                Detail Bagian
            </h2>
            <div class="btn-group">
                <a href="{{ route('bagian.edit', $bagian->id_bagian) }}" class="btn btn-warning">
                    <i class="fas fa-edit me-1"></i>
                    Edit
                </a>
                <a href="{{ route('bagian.index') }}" class="btn btn-secondary">
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
                    Informasi Bagian
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">ID Bagian</label>
                        <div class="text-muted">{{ $bagian->id_bagian }}</div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Kode Bagian</label>
                        <div>
                            <span class="badge bg-primary fs-6">{{ $bagian->kode_bagian }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-bold">Nama Bagian</label>
                        <div class="fs-5">{{ $bagian->nama_bagian }}</div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Dibuat</label>
                        <div class="text-muted">
                            <i class="fas fa-clock me-2"></i>
                            {{ $bagian->created_at->format('d F Y H:i') }}
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Terakhir Diupdate</label>
                        <div class="text-muted">
                            <i class="fas fa-edit me-2"></i>
                            {{ $bagian->updated_at->format('d F Y H:i') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Daftar Barang -->
        <div class="card mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-boxes me-2"></i>
                    Barang di Bagian Ini ({{ $bagian->barang->count() }} item)
                </h5>
                <a href="{{ route('barang.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus me-1"></i>
                    Tambah Barang
                </a>
            </div>
            <div class="card-body">
                @if($bagian->barang->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Jenis</th>
                                    <th>Status</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bagian->barang as $barang)
                                    <tr>
                                        <td>
                                            <span class="badge bg-primary">{{ $barang->kode_barang }}</span>
                                        </td>
                                        <td>{{ $barang->nama_barang }}</td>
                                        <td>{{ $barang->jenisBarang->nama_jenis }}</td>
                                        <td>
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
                                            <span class="badge bg-{{ $color }}">{{ $barang->statusBarang->nama_status }}</span>
                                        </td>
                                        <td>{{ $barang->tanggal_masuk->format('d/m/Y') }}</td>
                                        <td>
                                            <a href="{{ route('barang.show', $barang->id_barang) }}" 
                                               class="btn btn-sm btn-outline-primary" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center text-muted py-4">
                        <i class="fas fa-box-open fs-1 mb-3"></i>
                        <h6>Belum ada barang di bagian ini</h6>
                        <a href="{{ route('barang.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus me-1"></i>
                            Tambah Barang Pertama
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-chart-pie me-2"></i>
                    Statistik
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">Total Barang</label>
                    <div>
                        <span class="badge bg-primary fs-6">{{ $bagian->barang->count() }} barang</span>
                    </div>
                </div>
                
                @if($bagian->barang->count() > 0)
                    <div class="mb-3">
                        <label class="form-label fw-bold">Status Barang</label>
                        <div>
                            @php
                                $statusCounts = $bagian->barang->groupBy('id_status')->map(function($items) {
                                    return $items->count();
                                });
                            @endphp
                            @foreach($statusCounts as $statusId => $count)
                                @php
                                    $status = $bagian->barang->firstWhere('id_status', $statusId)->statusBarang;
                                    $statusColors = [
                                        'Tersedia' => 'success',
                                        'Rusak' => 'danger',
                                        'Dipinjam' => 'warning',
                                        'Dihapuskan' => 'secondary',
                                        'Dalam Perbaikan' => 'info'
                                    ];
                                    $color = $statusColors[$status->nama_status] ?? 'secondary';
                                @endphp
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge bg-{{ $color }}">{{ $status->nama_status }}</span>
                                    <span class="fw-medium">{{ $count }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
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
                    <a href="{{ route('bagian.edit', $bagian->id_bagian) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-2"></i>
                        Edit Bagian
                    </a>
                    
                    @if($bagian->barang->count() == 0)
                        <form action="{{ route('bagian.destroy', $bagian->id_bagian) }}" method="POST" 
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus bagian ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="fas fa-trash me-2"></i>
                                Hapus Bagian
                            </button>
                        </form>
                    @else
                        <button class="btn btn-danger" disabled title="Tidak dapat menghapus bagian yang masih memiliki barang">
                            <i class="fas fa-trash me-2"></i>
                            Hapus Bagian
                        </button>
                    @endif
                    
                    <a href="{{ route('bagian.index') }}" class="btn btn-secondary">
                        <i class="fas fa-list me-2"></i>
                        Lihat Semua Bagian
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
