@extends('layouts.app')

@section('title', 'Daftar Barang - Inventaris')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-dark mb-0">
                <i class="fas fa-boxes text-primary me-2"></i>
                Daftar Barang
            </h2>
            <a href="{{ route('barang.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>
                Tambah Barang
            </a>
        </div>
    </div>
</div>

<!-- Filter Section -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('barang.index') }}" class="row g-3">
            <div class="col-md-4">
                <label for="search" class="form-label">Pencarian</label>
                <input type="text" class="form-control" id="search" name="search" 
                       value="{{ request('search') }}" placeholder="Cari nama barang, kode, atau deskripsi...">
            </div>
            <div class="col-md-3">
                <label for="bagian" class="form-label">Bagian</label>
                <select class="form-select" id="bagian" name="bagian">
                    <option value="">Semua Bagian</option>
                    @foreach($bagian as $b)
                        <option value="{{ $b->id_bagian }}" {{ request('bagian') == $b->id_bagian ? 'selected' : '' }}>
                            {{ $b->kode_bagian }} - {{ $b->nama_bagian }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status">
                    <option value="">Semua Status</option>
                    @foreach($status as $s)
                        <option value="{{ $s->id_status }}" {{ request('status') == $s->id_status ? 'selected' : '' }}>
                            {{ $s->nama_status }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">&nbsp;</label>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search me-1"></i>
                        Filter
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Barang Table -->
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="fas fa-list me-2"></i>
            Data Barang ({{ $barang->total() }} item)
        </h5>
    </div>
    <div class="card-body">
        @if($barang->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Bagian</th>
                            <th>Jenis</th>
                            <th>Tipe</th>
                            <th>Status</th>
                            <th>Tanggal Masuk</th>
                            <th>Harga</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($barang as $item)
                            <tr>
                                <td>
                                    <span class="badge bg-primary">{{ $item->kode_barang }}</span>
                                </td>
                                <td>
                                    <div class="fw-medium">{{ $item->nama_barang }}</div>
                                    @if($item->deskripsi)
                                        <small class="text-muted">{{ Str::limit($item->deskripsi, 50) }}</small>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-secondary">{{ $item->bagian->kode_bagian }}</span>
                                    <div class="small text-muted">{{ $item->bagian->nama_bagian }}</div>
                                </td>
                                <td>{{ $item->jenisBarang->nama_jenis }}</td>
                                <td>{{ $item->tipeBarang->nama_tipe }}</td>
                                <td>
                                    @php
                                        $statusColors = [
                                            'Tersedia' => 'success',
                                            'Rusak' => 'danger',
                                            'Dipinjam' => 'warning',
                                            'Dihapuskan' => 'secondary',
                                            'Dalam Perbaikan' => 'info'
                                        ];
                                        $color = $statusColors[$item->statusBarang->nama_status] ?? 'secondary';
                                    @endphp
                                    <span class="badge bg-{{ $color }}">{{ $item->statusBarang->nama_status }}</span>
                                </td>
                                <td>{{ $item->tanggal_masuk->format('d/m/Y') }}</td>
                                <td>
                                    {{ $item->harga_rupiah }}
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('barang.show', $item->id_barang) }}" 
                                           class="btn btn-sm btn-outline-primary" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('barang.edit', $item->id_barang) }}" 
                                           class="btn btn-sm btn-outline-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('barang.destroy', $item->id_barang) }}" 
                                              method="POST" class="d-inline" 
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination Info -->
            <div class="pagination-info">
                Menampilkan {{ $barang->firstItem() ?? 0 }} sampai {{ $barang->lastItem() ?? 0 }} dari {{ $barang->total() }} hasil
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-3">
                {{ $barang->appends(request()->query())->links('pagination::bootstrap-4') }}
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
@endsection
