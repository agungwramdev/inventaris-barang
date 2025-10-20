@extends('layouts.app')

@section('title', 'Master Data - Jenis Barang')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-dark mb-0">
                <i class="fas fa-tags text-primary me-2"></i>
                Master Data - Jenis Barang
            </h2>
            <a href="{{ route('jenis-barang.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>
                Tambah Jenis
            </a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="fas fa-list me-2"></i>
            Daftar Jenis Barang ({{ $jenis->total() }} item)
        </h5>
    </div>
    <div class="card-body">
        @if($jenis->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Jenis</th>
                            <th>Nama Jenis</th>
                            <th>Jumlah Barang</th>
                            <th>Jumlah Tipe</th>
                            <th>Dibuat</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jenis as $item)
                            <tr>
                                <td>{{ $loop->iteration + ($jenis->currentPage() - 1) * $jenis->perPage() }}</td>
                                <td>
                                    <span class="badge bg-primary fs-6">{{ $item->kode_jenis }}</span>
                                </td>
                                <td class="fw-medium">{{ $item->nama_jenis }}</td>
                                <td>
                                    <span class="badge bg-info">{{ $item->barang_count }} barang</span>
                                </td>
                                <td>
                                    <span class="badge bg-success">{{ $item->tipe_barang_count }} tipe</span>
                                </td>
                                <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('jenis-barang.show', $item->id_jenis) }}" 
                                           class="btn btn-sm btn-outline-primary" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('jenis-barang.edit', $item->id_jenis) }}" 
                                           class="btn btn-sm btn-outline-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('jenis-barang.destroy', $item->id_jenis) }}" 
                                              method="POST" class="d-inline" 
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus jenis ini?')">
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
                {{ $jenis->links() }}
            </div>
        @else
            <div class="text-center text-muted py-5">
                <i class="fas fa-tags fs-1 mb-3"></i>
                <h5>Belum ada jenis barang</h5>
                <p>Mulai dengan menambahkan jenis pertama Anda</p>
                <a href="{{ route('jenis-barang.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>
                    Tambah Jenis
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
