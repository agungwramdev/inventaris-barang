@extends('layouts.app')

@section('title', 'Edit Barang - Inventaris')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-dark mb-0">
                <i class="fas fa-edit text-primary me-2"></i>
                Edit Barang
            </h2>
            <div class="btn-group">
                <a href="{{ route('barang.show', $barang->id_barang) }}" class="btn btn-info">
                    <i class="fas fa-eye me-1"></i>
                    Lihat Detail
                </a>
                <a href="{{ route('barang.index') }}" class="btn btn-secondary">
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
                    Form Edit Barang
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('barang.update', $barang->id_barang) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="kode_barang" class="form-label">Kode Barang</label>
                            <input type="text" class="form-control" value="{{ $barang->kode_barang }}" readonly>
                            <small class="text-muted">Kode barang tidak dapat diubah</small>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="nama_barang" class="form-label">Nama Barang <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" 
                                   id="nama_barang" name="nama_barang" value="{{ old('nama_barang', $barang->nama_barang) }}" required>
                            @error('nama_barang')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="id_bagian" class="form-label">Bagian <span class="text-danger">*</span></label>
                            <select class="form-select @error('id_bagian') is-invalid @enderror" 
                                    id="id_bagian" name="id_bagian" required>
                                <option value="">Pilih Bagian</option>
                                @foreach($bagian as $b)
                                    <option value="{{ $b->id_bagian }}" {{ old('id_bagian', $barang->id_bagian) == $b->id_bagian ? 'selected' : '' }}>
                                        {{ $b->kode_bagian }} - {{ $b->nama_bagian }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_bagian')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="id_jenis" class="form-label">Jenis Barang <span class="text-danger">*</span></label>
                            <select class="form-select @error('id_jenis') is-invalid @enderror" 
                                    id="id_jenis" name="id_jenis" required>
                                <option value="">Pilih Jenis Barang</option>
                                @foreach($jenis as $j)
                                    <option value="{{ $j->id_jenis }}" {{ old('id_jenis', $barang->id_jenis) == $j->id_jenis ? 'selected' : '' }}>
                                        {{ $j->kode_jenis }} - {{ $j->nama_jenis }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_jenis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="id_tipe" class="form-label">Tipe Barang <span class="text-danger">*</span></label>
                            <select class="form-select @error('id_tipe') is-invalid @enderror" 
                                    id="id_tipe" name="id_tipe" required>
                                <option value="">Pilih Tipe Barang</option>
                                @foreach($tipe as $t)
                                    <option value="{{ $t->id_tipe }}" {{ old('id_tipe', $barang->id_tipe) == $t->id_tipe ? 'selected' : '' }}>
                                        {{ $t->nama_tipe }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_tipe')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="id_status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select @error('id_status') is-invalid @enderror" 
                                    id="id_status" name="id_status" required>
                                <option value="">Pilih Status</option>
                                @foreach($status as $s)
                                    <option value="{{ $s->id_status }}" {{ old('id_status', $barang->id_status) == $s->id_status ? 'selected' : '' }}>
                                        {{ $s->nama_status }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tanggal_masuk" class="form-label">Tanggal Masuk <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('tanggal_masuk') is-invalid @enderror" 
                                   id="tanggal_masuk" name="tanggal_masuk" value="{{ old('tanggal_masuk', $barang->tanggal_masuk->format('Y-m-d')) }}" required>
                            @error('tanggal_masuk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="harga" class="form-label">Harga (Rp)</label>
                            <input type="text" class="form-control @error('harga') is-invalid @enderror" 
                                   id="harga" name="harga" value="{{ old('harga', $barang->harga) }}" 
                                   placeholder="Contoh: 2500000 atau 2.500.000">
                            <small class="text-muted">Masukkan angka tanpa Rp, contoh: 2500000</small>
                            @error('harga')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="lokasi" class="form-label">Lokasi</label>
                            <input type="text" class="form-control @error('lokasi') is-invalid @enderror" 
                                   id="lokasi" name="lokasi" value="{{ old('lokasi', $barang->lokasi) }}">
                            @error('lokasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                  id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $barang->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                                  id="keterangan" name="keterangan" rows="2">{{ old('keterangan', $barang->keterangan) }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('barang.show', $barang->id_barang) }}" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i>
                            Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>
                            Update Barang
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
                    Informasi Barang
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">Kode Barang</label>
                    <div>
                        <span class="badge bg-primary fs-6">{{ $barang->kode_barang }}</span>
                    </div>
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
                            $color = $statusColors[$barang->statusBarang->nama_status] ?? 'secondary';
                        @endphp
                        <span class="badge bg-{{ $color }} fs-6">{{ $barang->statusBarang->nama_status }}</span>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Dibuat</label>
                    <div class="text-muted">
                        <i class="fas fa-clock me-2"></i>
                        {{ $barang->created_at->format('d F Y H:i') }}
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Terakhir Diupdate</label>
                    <div class="text-muted">
                        <i class="fas fa-edit me-2"></i>
                        {{ $barang->updated_at->format('d F Y H:i') }}
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
                    <strong>Kode Barang</strong><br>
                    Kode barang tidak dapat diubah setelah dibuat.
                </div>
                
                <div class="alert alert-success">
                    <i class="fas fa-money-bill-wave me-2"></i>
                    <strong>Format Harga</strong><br>
                    Harga akan disimpan sebagai integer dalam Rupiah.
                    <ul class="mb-0 mt-2">
                        <li>Input: 2500000 → Disimpan: 2500000</li>
                        <li>Input: 2.500.000 → Disimpan: 2500000</li>
                        <li>Input: 2,5 → Disimpan: 2</li>
                    </ul>
                    <small class="text-muted">Tampilan: Rp 2.500.000</small>
                </div>
                
                <div class="alert alert-info">
                    <i class="fas fa-lightbulb me-2"></i>
                    <strong>Tip</strong><br>
                    Pastikan semua field yang bertanda (*) diisi dengan benar.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Update tipe barang berdasarkan jenis yang dipilih
    $('#id_jenis').change(function() {
        var idJenis = $(this).val();
        var tipeSelect = $('#id_tipe');
        var currentTipeId = '{{ $barang->id_tipe }}';
        
        tipeSelect.html('<option value="">Loading...</option>');
        
        if (idJenis) {
            $.get('{{ route("barang.tipe", ":id") }}'.replace(':id', idJenis), function(data) {
                tipeSelect.html('<option value="">Pilih Tipe Barang</option>');
                $.each(data, function(key, value) {
                    var selected = (value.id_tipe == currentTipeId) ? 'selected' : '';
                    tipeSelect.append('<option value="' + value.id_tipe + '" ' + selected + '>' + value.nama_tipe + '</option>');
                });
            });
        } else {
            tipeSelect.html('<option value="">Pilih Tipe Barang</option>');
        }
    });
    
    // Format harga input
    $('#harga').on('input', function() {
        var value = $(this).val();
        // Hapus semua karakter non-numeric kecuali titik dan koma
        value = value.replace(/[^0-9.,]/g, '');
        
        // Jika ada koma, ganti dengan titik untuk decimal
        if (value.indexOf(',') !== -1) {
            value = value.replace(',', '.');
        }
        
        $(this).val(value);
    });
});
</script>
@endsection
