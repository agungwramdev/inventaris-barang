@extends('layouts.app')

@section('title', 'Detail Status Barang - Master Data')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-dark mb-0">
                <i class="fas fa-eye text-primary me-2"></i>
                Detail Status Barang
            </h2>
            <div class="btn-group">
                <a href="{{ route('status-barang.edit', $status->id_status) }}" class="btn btn-warning">
                    <i class="fas fa-edit me-1"></i>
                    Edit
                </a>
                <a href="{{ route('status-barang.index') }}" class="btn btn-secondary">
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
                    Informasi Status Barang
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">ID Status</label>
                        <div class="text-muted">{{ $status->id_status }}</div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Nama Status</label>
                        <div>
                            @php
                                $statusColors = [
                                    'Tersedia' => 'success',
                                    'Rusak' => 'danger',
                                    'Dipinjam' => 'warning',
                                    'Dihapuskan' => 'secondary',
                                    'Dalam Perbaikan' => 'info'
                                ];
                                $color = $statusColors[$status->nama_status] ?? 'primary';
                            @endphp
                            <span class="badge bg-{{ $color }} fs-5">{{ $status->nama_status }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Dibuat</label>
                        <div class="text-muted">
                            <i class="fas fa-clock me-2"></i>
                            {{ $status->created_at->format('d F Y H:i') }}
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Terakhir Diupdate</label>
                        <div class="text-muted">
                            <i class="fas fa-edit me-2"></i>
                            {{ $status->updated_at->format('d F Y H:i') }}
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
                    Barang dengan Status Ini ({{ $status->barang->count() }} item)
                </h5>
                <a href="{{ route('barang.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus me-1"></i>
                    Tambah Barang
                </a>
            </div>
            <div class="card-body">
                @if($status->barang->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Bagian</th>
                                    <th>Jenis</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($status->barang as $barang)
                                    <tr>
                                        <td>
                                            <span class="badge bg-primary">{{ $barang->kode_barang }}</span>
                                        </td>
                                        <td>{{ $barang->nama_barang }}</td>
                                        <td>
                                            <span class="badge bg-secondary">{{ $barang->bagian->kode_bagian }}</span>
                                        </td>
                                        <td>{{ $barang->jenisBarang->nama_jenis }}</td>
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
                        <h6>Belum ada barang dengan status ini</h6>
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
                        <span class="badge bg-primary fs-6">{{ $status->barang->count() }} barang</span>
                    </div>
                </div>
                
                @if($status->barang->count() > 0)
                    <div class="mb-3">
                        <label class="form-label fw-bold">Distribusi per Bagian</label>
                        <div>
                            @php
                                $bagianCounts = $status->barang->groupBy('id_bagian')->map(function($items) {
                                    return $items->count();
                                });
                            @endphp
                            @foreach($bagianCounts as $bagianId => $count)
                                @php
                                    $bagian = $status->barang->firstWhere('id_bagian', $bagianId)->bagian;
                                @endphp
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge bg-secondary">{{ $bagian->kode_bagian }}</span>
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
                    <a href="{{ route('status-barang.edit', $status->id_status) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-2"></i>
                        Edit Status
                    </a>
                    
                    @if($status->barang->count() == 0)
                        <form action="{{ route('status-barang.destroy', $status->id_status) }}" method="POST" 
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus status ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="fas fa-trash me-2"></i>
                                Hapus Status
                            </button>
                        </form>
                    @else
                        <button class="btn btn-danger" disabled title="Tidak dapat menghapus status yang masih memiliki barang">
                            <i class="fas fa-trash me-2"></i>
                            Hapus Status
                        </button>
                    @endif
                    
                    <a href="{{ route('status-barang.index') }}" class="btn btn-secondary">
                        <i class="fas fa-list me-2"></i>
                        Lihat Semua Status
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
