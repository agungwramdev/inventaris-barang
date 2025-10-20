@extends('layouts.app')

@section('title', 'Tambah Jenis Barang - Master Data')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-dark mb-0">
                <i class="fas fa-plus text-primary me-2"></i>
                Tambah Jenis Barang Baru
            </h2>
            <a href="{{ route('jenis-barang.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>
                Kembali
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-edit me-2"></i>
                    Form Tambah Jenis Barang
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('jenis-barang.store') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="kode_jenis" class="form-label">Kode Jenis <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('kode_jenis') is-invalid @enderror" 
                                   id="kode_jenis" name="kode_jenis" value="{{ old('kode_jenis') }}" 
                                   maxlength="2" required placeholder="Contoh: 01, 02, 03">
                            <small class="text-muted">Masukkan 2 digit kode, contoh: 01, 02, 03</small>
                            @error('kode_jenis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="nama_jenis" class="form-label">Nama Jenis <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_jenis') is-invalid @enderror" 
                                   id="nama_jenis" name="nama_jenis" value="{{ old('nama_jenis') }}" 
                                   maxlength="100" required placeholder="Contoh: Komputer, Monitor, Printer">
                            @error('nama_jenis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('jenis-barang.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i>
                            Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>
                            Simpan Jenis
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
                    Informasi
                </h5>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <i class="fas fa-lightbulb me-2"></i>
                    <strong>Jenis Barang</strong><br>
                    Jenis barang adalah kategori utama dari barang.
                    <ul class="mb-0 mt-2">
                        <li>Kode: 2 digit, contoh: 01, 02, 03</li>
                        <li>Digunakan untuk kode barang otomatis</li>
                        <li>Dapat memiliki banyak tipe barang</li>
                    </ul>
                </div>
                
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Perhatian</strong><br>
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
