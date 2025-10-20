@extends('layouts.app')

@section('title', 'Edit Bagian - Master Data')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-dark mb-0">
                <i class="fas fa-edit text-primary me-2"></i>
                Edit Bagian
            </h2>
            <div class="btn-group">
                <a href="{{ route('bagian.show', $bagian->id_bagian) }}" class="btn btn-info">
                    <i class="fas fa-eye me-1"></i>
                    Lihat Detail
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
                    <i class="fas fa-edit me-2"></i>
                    Form Edit Bagian
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('bagian.update', $bagian->id_bagian) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="kode_bagian" class="form-label">Kode Bagian <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('kode_bagian') is-invalid @enderror" 
                                   id="kode_bagian" name="kode_bagian" value="{{ old('kode_bagian', $bagian->kode_bagian) }}" 
                                   maxlength="1" required>
                            <small class="text-muted">Masukkan 1 karakter, contoh: A, B, C</small>
                            @error('kode_bagian')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="nama_bagian" class="form-label">Nama Bagian <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_bagian') is-invalid @enderror" 
                                   id="nama_bagian" name="nama_bagian" value="{{ old('nama_bagian', $bagian->nama_bagian) }}" 
                                   maxlength="100" required>
                            @error('nama_bagian')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('bagian.show', $bagian->id_bagian) }}" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i>
                            Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>
                            Update Bagian
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
                    Informasi Bagian
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">ID Bagian</label>
                    <div class="text-muted">{{ $bagian->id_bagian }}</div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Jumlah Barang</label>
                    <div>
                        <span class="badge bg-info">{{ $bagian->barang()->count() }} barang</span>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Dibuat</label>
                    <div class="text-muted">
                        <i class="fas fa-clock me-2"></i>
                        {{ $bagian->created_at->format('d F Y H:i') }}
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Terakhir Diupdate</label>
                    <div class="text-muted">
                        <i class="fas fa-edit me-2"></i>
                        {{ $bagian->updated_at->format('d F Y H:i') }}
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
                    <strong>Kode Bagian</strong><br>
                    Perubahan kode bagian akan mempengaruhi kode barang yang sudah ada.
                </div>
                
                <div class="alert alert-info">
                    <i class="fas fa-lightbulb me-2"></i>
                    <strong>Tip</strong><br>
                    Pastikan kode bagian tidak duplikat dengan yang sudah ada.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Format kode bagian ke uppercase
    $('#kode_bagian').on('input', function() {
        $(this).val($(this).val().toUpperCase());
    });
});
</script>
@endsection
