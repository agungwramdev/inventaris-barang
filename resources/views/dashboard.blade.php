@extends('layouts.app')

@section('title', 'Dashboard - Inventaris Barang')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-dark mb-0">
                <i class="fas fa-tachometer-alt text-primary me-2"></i>
                Dashboard Inventaris
            </h2>
            <div class="text-muted">
                <i class="fas fa-calendar me-1"></i>
                {{ date('d F Y') }}
            </div>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="card stats-card h-100">
            <div class="card-body text-center">
                <div class="d-flex align-items-center justify-content-center mb-3">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                        <i class="fas fa-boxes text-primary fs-4"></i>
                    </div>
                </div>
                <h3 class="text-primary mb-1">{{ number_format($totalBarang) }}</h3>
                <p class="text-muted mb-0">Total Barang</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-3">
        <div class="card stats-card h-100">
            <div class="card-body text-center">
                <div class="d-flex align-items-center justify-content-center mb-3">
                    <div class="bg-success bg-opacity-10 rounded-circle p-3">
                        <i class="fas fa-building text-success fs-4"></i>
                    </div>
                </div>
                <h3 class="text-success mb-1">{{ number_format($totalBagian) }}</h3>
                <p class="text-muted mb-0">Bagian</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-3">
        <div class="card stats-card h-100">
            <div class="card-body text-center">
                <div class="d-flex align-items-center justify-content-center mb-3">
                    <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                        <i class="fas fa-tags text-warning fs-4"></i>
                    </div>
                </div>
                <h3 class="text-warning mb-1">{{ number_format($totalJenis) }}</h3>
                <p class="text-muted mb-0">Jenis Barang</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-3">
        <div class="card stats-card h-100">
            <div class="card-body text-center">
                <div class="d-flex align-items-center justify-content-center mb-3">
                    <div class="bg-info bg-opacity-10 rounded-circle p-3">
                        <i class="fas fa-chart-pie text-info fs-4"></i>
                    </div>
                </div>
                <h3 class="text-info mb-1">{{ $statusStats->sum('barang_count') }}</h3>
                <p class="text-muted mb-0">Total Status</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Status Statistics -->
    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-chart-bar me-2"></i>
                    Statistik Berdasarkan Status
                </h5>
            </div>
            <div class="card-body">
                @if($statusStats->count() > 0)
                    @foreach($statusStats as $status)
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                    <i class="fas fa-circle text-primary"></i>
                                </div>
                                <span class="fw-medium">{{ $status->nama_status }}</span>
                            </div>
                            <span class="badge bg-primary">{{ $status->barang_count }}</span>
                        </div>
                    @endforeach
                @else
                    <div class="text-center text-muted py-4">
                        <i class="fas fa-inbox fs-1 mb-3"></i>
                        <p>Belum ada data status</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Bagian Statistics -->
    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-building me-2"></i>
                    Statistik Berdasarkan Bagian
                </h5>
            </div>
            <div class="card-body">
                @if($bagianStats->count() > 0)
                    @foreach($bagianStats as $bagian)
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                                    <i class="fas fa-building text-success"></i>
                                </div>
                                <div>
                                    <div class="fw-medium">{{ $bagian->kode_bagian }}</div>
                                    <small class="text-muted">{{ $bagian->nama_bagian }}</small>
                                </div>
                            </div>
                            <span class="badge bg-success">{{ $bagian->barang_count }}</span>
                        </div>
                    @endforeach
                @else
                    <div class="text-center text-muted py-4">
                        <i class="fas fa-inbox fs-1 mb-3"></i>
                        <p>Belum ada data bagian</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Recent Items -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-clock me-2"></i>
                    Barang Terbaru
                </h5>
                <a href="{{ route('barang.index') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-eye me-1"></i>
                    Lihat Semua
                </a>
            </div>
            <div class="card-body">
                @if($barangTerbaru->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Bagian</th>
                                    <th>Jenis</th>
                                    <th>Status</th>
                                    <th>Tanggal Masuk</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($barangTerbaru as $barang)
                                    <tr>
                                        <td>
                                            <span class="badge bg-primary">{{ $barang->kode_barang }}</span>
                                        </td>
                                        <td class="fw-medium">{{ $barang->nama_barang }}</td>
                                        <td>
                                            <span class="badge bg-secondary">{{ $barang->bagian->kode_bagian }}</span>
                                        </td>
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
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center text-muted py-5">
                        <i class="fas fa-box-open fs-1 mb-3"></i>
                        <h5>Belum ada barang</h5>
                        <p>Mulai dengan menambahkan barang pertama Anda</p>
                        <a href="{{ route('barang.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i>
                            Tambah Barang
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
