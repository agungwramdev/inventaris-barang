@extends('layouts.app')

@section('title', 'Edit Tipe Barang - Master Data')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-dark mb-0">
                <i class="fas fa-edit text-primary me-2"></i>
                Edit Tipe Barang
            </h2>
            <div class="btn-group">
                <a href="{{ route('tipe-barang.show', $tipe->id_tipe) }}" class="btn btn-info">
                    <i class="fas fa-eye me-1"></i>
                    Lihat Detail
                </a>
                <a href="{{ route('tipe-barang.index') }}" class="btn btn-secondary">
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
                    Form Edit Tipe Barang
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('tipe-barang.update', $tipe->id_tipe) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="id_jenis" class="form-label">Jenis Barang <span class="text-danger">*</span></label>
                            <select class="form-select @error('id_jenis') is-invalid @enderror" 
                                    id="id_jenis" name="id_jenis" required>
                                <option value="">Pilih Jenis Barang</option>
                                @foreach($jenis as $item)
                                    <option value="{{ $item->id_jenis }}" 
                                            {{ old('id_jenis', $tipe->id_jenis) == $item->id_jenis ? 'selected' : '' }}>
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
                                   id="nama_tipe" name="nama_tipe" value="{{ old('nama_tipe', $tipe->nama_tipe) }}" 
                                   maxlength="100" required placeholder="Contoh: LED 24 Inch, LaserJet 1020">
                            @error('nama_tipe')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('tipe-barang.show', $tipe->id_tipe) }}" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i>
                            Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>
                            Update Tipe
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
                    Informasi Tipe
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">ID Tipe</label>
                    <div class="text-muted">{{ $tipe->id_tipe }}</div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Jenis Barang Saat Ini</label>
                    <div>
                        <span class="badge bg-primary">{{ $tipe->jenisBarang->nama_jenis }} ({{ $tipe->jenisBarang->kode_jenis }})</span>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Jumlah Barang</label>
                    <div>
                        <span class="badge bg-info">{{ $tipe->barang()->count() }} barang</span>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Dibuat</label>
                    <div class="text-muted">
                        <i class="fas fa-clock me-2"></i>
                        {{ $tipe->created_at->format('d F Y H:i') }}
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Terakhir Diupdate</label>
                    <div class="text-muted">
                        <i class="fas fa-edit me-2"></i>
                        {{ $tipe->updated_at->format('d F Y H:i') }}
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
                    <strong>Perubahan Jenis</strong><br>
                    Perubahan jenis barang akan mempengaruhi relasi dengan barang yang sudah ada.
                </div>
                
                <div class="alert alert-info">
                    <i class="fas fa-lightbulb me-2"></i>
                    <strong>Tip</strong><br>
                    Pastikan jenis barang yang dipilih sudah ada.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
