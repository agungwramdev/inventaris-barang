@extends('layouts.app')

@section('title', 'Tambah Status Barang - Master Data')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-dark mb-0">
                <i class="fas fa-plus text-primary me-2"></i>
                Tambah Status Barang Baru
            </h2>
            <a href="{{ route('status-barang.index') }}" class="btn btn-secondary">
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
                    Form Tambah Status Barang
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('status-barang.store') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="nama_status" class="form-label">Nama Status <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_status') is-invalid @enderror" 
                                   id="nama_status" name="nama_status" value="{{ old('nama_status') }}" 
                                   maxlength="50" required placeholder="Contoh: Tersedia, Rusak, Dipinjam">
                            @error('nama_status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('status-barang.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i>
                            Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>
                            Simpan Status
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
                    <strong>Status Barang</strong><br>
                    Status digunakan untuk menunjukkan kondisi barang.
                    <ul class="mb-0 mt-2">
                        <li>Contoh: Tersedia, Rusak, Dipinjam</li>
                        <li>Maksimal 50 karakter</li>
                        <li>Nama status harus unik</li>
                    </ul>
                </div>
                
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Perhatian</strong><br>
                    Pastikan nama status tidak duplikat dengan yang sudah ada.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
