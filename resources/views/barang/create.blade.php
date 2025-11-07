@extends('layouts.app')

@section('title', 'Tambah Barang - Inventaris')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-dark mb-0">
                <i class="fas fa-plus text-primary me-2"></i>
                Tambah Barang Baru
            </h2>
            <a href="{{ route('barang.index') }}" class="btn btn-secondary">
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
                    Form Tambah Barang
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('barang.store') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nama_barang" class="form-label">Nama Barang <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" 
                                   id="nama_barang" name="nama_barang" value="{{ old('nama_barang') }}" required>
                            @error('nama_barang')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="id_bagian" class="form-label">Bagian <span class="text-danger">*</span></label>
                            <select class="form-select @error('id_bagian') is-invalid @enderror" 
                                    id="id_bagian" name="id_bagian" required>
                                <option value="">Pilih Bagian</option>
                                @foreach($bagian as $b)
                                    <option value="{{ $b->id_bagian }}" {{ old('id_bagian') == $b->id_bagian ? 'selected' : '' }}>
                                        {{ $b->kode_bagian }} - {{ $b->nama_bagian }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_bagian')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="id_jenis" class="form-label">Jenis Barang <span class="text-danger">*</span></label>
                            <select class="form-select @error('id_jenis') is-invalid @enderror" 
                                    id="id_jenis" name="id_jenis" required>
                                <option value="">Pilih Jenis Barang</option>
                                @foreach($jenis as $j)
                                    <option value="{{ $j->id_jenis }}" {{ old('id_jenis') == $j->id_jenis ? 'selected' : '' }}>
                                        {{ $j->kode_jenis }} - {{ $j->nama_jenis }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_jenis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="id_tipe" class="form-label">Tipe Barang <span class="text-danger">*</span></label>
                            <select class="form-select @error('id_tipe') is-invalid @enderror" 
                                    id="id_tipe" name="id_tipe" required>
                                <option value="">Pilih Tipe Barang</option>
                                @foreach($tipe as $t)
                                    <option value="{{ $t->id_tipe }}" {{ old('id_tipe') == $t->id_tipe ? 'selected' : '' }}>
                                        {{ $t->nama_tipe }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_tipe')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="id_status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select @error('id_status') is-invalid @enderror" 
                                    id="id_status" name="id_status" required>
                                <option value="">Pilih Status</option>
                                @foreach($status as $s)
                                    <option value="{{ $s->id_status }}" {{ old('id_status') == $s->id_status ? 'selected' : '' }}>
                                        {{ $s->nama_status }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="tanggal_masuk" class="form-label">Tanggal Masuk <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('tanggal_masuk') is-invalid @enderror" 
                                   id="tanggal_masuk" name="tanggal_masuk" value="{{ old('tanggal_masuk', date('Y-m-d')) }}" required>
                            @error('tanggal_masuk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="harga" class="form-label">Harga (Rp)</label>
                            <input type="text" class="form-control @error('harga') is-invalid @enderror"
                                   id="harga" name="harga" value="{{ old('harga') }}"
                                   placeholder="Masukkan harga">
                            <small class="text-muted">Format otomatis dengan pemisah ribuan (Contoh: 2.500.000)</small>
                            @error('harga')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="lokasi" class="form-label">Lokasi</label>
                            <input type="text" class="form-control @error('lokasi') is-invalid @enderror" 
                                   id="lokasi" name="lokasi" value="{{ old('lokasi') }}">
                            @error('lokasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                  id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                                  id="keterangan" name="keterangan" rows="2">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('barang.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i>
                            Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>
                            Simpan Barang
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
                    <strong>Kode Barang Otomatis</strong><br>
                    Kode barang akan dibuat otomatis berdasarkan:
                    <ul class="mb-0 mt-2">
                        <li>Kode Bagian (1 digit)</li>
                        <li>Kode Jenis (2 digit)</li>
                        <li>Tanggal (6 digit: DDMMYY)</li>
                        <li>Nomor Urut (3 digit)</li>
                    </ul>
                    <small class="text-muted">Contoh: B020251020001</small>
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
                
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Perhatian</strong><br>
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
        
        tipeSelect.html('<option value="">Loading...</option>');
        
        if (idJenis) {
            $.get('{{ route("barang.tipe", ":id") }}'.replace(':id', idJenis), function(data) {
                tipeSelect.html('<option value="">Pilih Tipe Barang</option>');
                $.each(data, function(key, value) {
                    tipeSelect.append('<option value="' + value.id_tipe + '">' + value.nama_tipe + '</option>');
                });
            });
        } else {
            tipeSelect.html('<option value="">Pilih Tipe Barang</option>');
        }
    });
    
    // Format harga input dengan pemisah ribuan
    $('#harga').on('input', function(e) {
        var value = $(this).val();

        // Hapus semua karakter non-numeric
        value = value.replace(/[^0-9]/g, '');

        // Format dengan pemisah ribuan (titik)
        if (value) {
            value = parseInt(value, 10).toLocaleString('id-ID');
        }

        $(this).val(value);
    });

    // Hapus format sebelum submit agar tersimpan sebagai angka murni
    $('form').on('submit', function() {
        var hargaInput = $('#harga');
        var value = hargaInput.val();
        // Hapus titik pemisah ribuan
        value = value.replace(/\./g, '');
        hargaInput.val(value);
    });
});
</script>
@endsection
