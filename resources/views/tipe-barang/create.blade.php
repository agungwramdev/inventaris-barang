@extends('layouts.app')

@section('title', 'Tambah Tipe Barang - Master Data')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-dark mb-0">
                <i class="fas fa-plus text-primary me-2"></i>
                Tambah Tipe Barang Baru
            </h2>
            <a href="{{ route('tipe-barang.index') }}" class="btn btn-secondary">
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
                    Form Tambah Tipe Barang
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('tipe-barang.store') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="id_jenis" class="form-label">Jenis Barang <span class="text-danger">*</span></label>
                            <select class="form-select @error('id_jenis') is-invalid @enderror" 
                                    id="id_jenis" name="id_jenis" required>
                                <option value="">Pilih Jenis Barang</option>
                                @foreach($jenis as $item)
                                    <option value="{{ $item->id_jenis }}" {{ old('id_jenis') == $item->id_jenis ? 'selected' : '' }}>
                                        {{ $item->nama_jenis }} ({{ $item->kode_jenis }})
                                    </option>
                                @endforeach
                            </select>
                            @error('id_jenis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="nama_tipe" class="form-label">Nama Tipe <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_tipe') is-invalid @enderror" 
                                   id="nama_tipe" name="nama_tipe" value="{{ old('nama_tipe') }}" 
                                   maxlength="100" required placeholder="Contoh: LED 24 Inch, LaserJet 1020">
                            @error('nama_tipe')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('tipe-barang.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i>
                            Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>
                            Simpan Tipe
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
                    <strong>Tipe Barang</strong><br>
                    Tipe barang adalah spesifikasi detail dari jenis barang.
                    <ul class="mb-0 mt-2">
                        <li>Contoh: LED 24 Inch, LaserJet 1020</li>
                        <li>Maksimal 100 karakter</li>
                        <li>Harus memilih jenis barang</li>
                    </ul>
                </div>
                
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Perhatian</strong><br>
                    Pastikan jenis barang sudah ada sebelum menambahkan tipe.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
