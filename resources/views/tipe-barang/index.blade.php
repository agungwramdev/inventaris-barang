@extends('layouts.app')

@section('title', 'Master Data - Tipe Barang')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-dark mb-0">
                <i class="fas fa-tags text-primary me-2"></i>
                Master Data - Tipe Barang
            </h2>
            <a href="{{ route('tipe-barang.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>
                Tambah Tipe
            </a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="fas fa-list me-2"></i>
            Daftar Tipe Barang ({{ $tipe->total() }} item)
        </h5>
    </div>
    <div class="card-body">
        @if($tipe->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Tipe</th>
                            <th>Jenis Barang</th>
                            <th>Jumlah Barang</th>
                            <th>Dibuat</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tipe as $item)
                            <tr>
                                <td>{{ $loop->iteration + ($tipe->currentPage() - 1) * $tipe->perPage() }}</td>
                                <td class="fw-medium">{{ $item->nama_tipe }}</td>
                                <td>
                                    <span class="badge bg-primary">{{ $item->jenisBarang->nama_jenis }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $item->barang_count }} barang</span>
                                </td>
                                <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('tipe-barang.show', $item->id_tipe) }}" 
                                           class="btn btn-sm btn-outline-primary" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('tipe-barang.edit', $item->id_tipe) }}" 
                                           class="btn btn-sm btn-outline-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('tipe-barang.destroy', $item->id_tipe) }}" 
                                              method="POST" class="d-inline" 
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus tipe ini?')">
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
            
            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $tipe->links() }}
            </div>
        @else
            <div class="text-center text-muted py-5">
                <i class="fas fa-tags fs-1 mb-3"></i>
                <h5>Belum ada tipe barang</h5>
                <p>Mulai dengan menambahkan tipe pertama Anda</p>
                <a href="{{ route('tipe-barang.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>
                    Tambah Tipe
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
