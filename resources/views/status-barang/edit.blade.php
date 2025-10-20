@extends('layouts.app')

@section('title', 'Edit Status Barang - Master Data')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-dark mb-0">
                <i class="fas fa-edit text-primary me-2"></i>
                Edit Status Barang
            </h2>
            <div class="btn-group">
                <a href="{{ route('status-barang.show', $status->id_status) }}" class="btn btn-info">
                    <i class="fas fa-eye me-1"></i>
                    Lihat Detail
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
                    <i class="fas fa-edit me-2"></i>
                    Form Edit Status Barang
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('status-barang.update', $status->id_status) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="nama_status" class="form-label">Nama Status <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_status') is-invalid @enderror" 
                                   id="nama_status" name="nama_status" value="{{ old('nama_status', $status->nama_status) }}" 
                                   maxlength="50" required placeholder="Contoh: Tersedia, Rusak, Dipinjam">
                            @error('nama_status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('status-barang.show', $status->id_status) }}" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i>
                            Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>
                            Update Status
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-info-circle me-2"></i>
                    Informasi Status
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">ID Status</label>
                    <div class="text-muted">{{ $status->id_status }}</div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Status Saat Ini</label>
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
                        <span class="badge bg-{{ $color }} fs-6">{{ $status->nama_status }}</span>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Jumlah Barang</label>
                    <div>
                        <span class="badge bg-info">{{ $status->barang()->count() }} barang</span>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Dibuat</label>
                    <div class="text-muted">
                        <i class="fas fa-clock me-2"></i>
                        {{ $status->created_at->format('d F Y H:i') }}
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Terakhir Diupdate</label>
                    <div class="text-muted">
                        <i class="fas fa-edit me-2"></i>
                        {{ $status->updated_at->format('d F Y H:i') }}
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Perhatian
                </h5>
            </div>
            <div class="card-body">
                <div class="alert alert-warning">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Perubahan Status</strong><br>
                    Perubahan nama status akan mempengaruhi tampilan di semua barang yang menggunakan status ini.
                </div>
                
                <div class="alert alert-info">
                    <i class="fas fa-lightbulb me-2"></i>
                    <strong>Tip</strong><br>
                    Pastikan nama status tidak duplikat dengan yang sudah ada.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
