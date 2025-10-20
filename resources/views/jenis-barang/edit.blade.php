@extends('layouts.app')

@section('title', 'Edit Jenis Barang - Master Data')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-dark mb-0">
                <i class="fas fa-edit text-primary me-2"></i>
                Edit Jenis Barang
            </h2>
            <div class="btn-group">
                <a href="{{ route('jenis-barang.show', $jenis->id_jenis) }}" class="btn btn-info">
                    <i class="fas fa-eye me-1"></i>
                    Lihat Detail
                </a>
                <a href="{{ route('jenis-barang.index') }}" class="btn btn-secondary">
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
                    Form Edit Jenis Barang
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('jenis-barang.update', $jenis->id_jenis) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="kode_jenis" class="form-label">Kode Jenis <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('kode_jenis') is-invalid @enderror" 
                                   id="kode_jenis" name="kode_jenis" value="{{ old('kode_jenis', $jenis->kode_jenis) }}" 
                                   maxlength="2" required placeholder="Contoh: 01, 02, 03">
                            <small class="text-muted">Masukkan 2 digit kode, contoh: 01, 02, 03</small>
                            @error('kode_jenis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="nama_jenis" class="form-label">Nama Jenis <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_jenis') is-invalid @enderror" 
                                   id="nama_jenis" name="nama_jenis" value="{{ old('nama_jenis', $jenis->nama_jenis) }}" 
                                   maxlength="100" required placeholder="Contoh: Komputer, Monitor, Printer">
                            @error('nama_jenis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('jenis-barang.show', $jenis->id_jenis) }}" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i>
                            Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>
                            Update Jenis
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
                    Informasi Jenis
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">ID Jenis</label>
                    <div class="text-muted">{{ $jenis->id_jenis }}</div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Kode Saat Ini</label>
                    <div>
                        <span class="badge bg-primary fs-6">{{ $jenis->kode_jenis }}</span>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Jumlah Barang</label>
                    <div>
                        <span class="badge bg-info">{{ $jenis->barang()->count() }} barang</span>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Jumlah Tipe</label>
                    <div>
                        <span class="badge bg-success">{{ $jenis->tipeBarang()->count() }} tipe</span>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Dibuat</label>
                    <div class="text-muted">
                        <i class="fas fa-clock me-2"></i>
                        {{ $jenis->created_at->format('d F Y H:i') }}
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Terakhir Diupdate</label>
                    <div class="text-muted">
                        <i class="fas fa-edit me-2"></i>
                        {{ $jenis->updated_at->format('d F Y H:i') }}
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
                    <strong>Perubahan Kode</strong><br>
                    Perubahan kode jenis akan mempengaruhi kode barang yang sudah ada.
                </div>
                
                <div class="alert alert-info">
                    <i class="fas fa-lightbulb me-2"></i>
                    <strong>Tip</strong><br>
                    Pastikan kode jenis tidak duplikat dengan yang sudah ada.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Format kode jenis ke uppercase
    $('#kode_jenis').on('input', function() {
        $(this).val($(this).val().toUpperCase());
    });
});
</script>
@endsection
