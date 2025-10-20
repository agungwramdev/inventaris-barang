@extends('layouts.app')

@section('title', 'Master Data - Bagian')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-dark mb-0">
                <i class="fas fa-building text-primary me-2"></i>
                Master Data - Bagian
            </h2>
            <a href="{{ route('bagian.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>
                Tambah Bagian
            </a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="fas fa-list me-2"></i>
            Daftar Bagian ({{ $bagian->total() }} item)
        </h5>
    </div>
    <div class="card-body">
        @if($bagian->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Bagian</th>
                            <th>Nama Bagian</th>
                            <th>Jumlah Barang</th>
                            <th>Dibuat</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bagian as $item)
                            <tr>
                                <td>{{ $loop->iteration + ($bagian->currentPage() - 1) * $bagian->perPage() }}</td>
                                <td>
                                    <span class="badge bg-primary fs-6">{{ $item->kode_bagian }}</span>
                                </td>
                                <td class="fw-medium">{{ $item->nama_bagian }}</td>
                                <td>
                                    <span class="badge bg-info">{{ $item->barang_count }} barang</span>
                                </td>
                                <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('bagian.show', $item->id_bagian) }}" 
                                           class="btn btn-sm btn-outline-primary" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('bagian.edit', $item->id_bagian) }}" 
                                           class="btn btn-sm btn-outline-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('bagian.destroy', $item->id_bagian) }}" 
                                              method="POST" class="d-inline" 
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus bagian ini?')">
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
                Menampilkan {{ $bagian->firstItem() ?? 0 }} sampai {{ $bagian->lastItem() ?? 0 }} dari {{ $bagian->total() }} hasil
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-3">
                {{ $bagian->links('pagination::bootstrap-4') }}
            </div>
        @else
            <div class="text-center text-muted py-5">
                <i class="fas fa-building fs-1 mb-3"></i>
                <h5>Belum ada bagian</h5>
                <p>Mulai dengan menambahkan bagian pertama Anda</p>
                <a href="{{ route('bagian.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>
                    Tambah Bagian
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
