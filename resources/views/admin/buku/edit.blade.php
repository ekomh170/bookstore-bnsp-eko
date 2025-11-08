@extends('layouts.admin')

@section('title', 'Edit Buku')
@section('page-title', 'Edit Buku')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.buku.index') }}" class="btn btn-outline-secondary">
        <span class="material-icons align-middle me-2" style="font-size: 18px;">arrow_back</span>
        Kembali
    </a>
</div>

<form action="{{ route('admin.buku.update', $buku) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row g-4">
        <!-- Form Input -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0 fw-bold">Informasi Buku</h5>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <label for="judul" class="form-label fw-500">Judul Buku <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul', $buku->judul) }}" required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="penulis" class="form-label fw-500">Penulis <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('penulis') is-invalid @enderror" id="penulis" name="penulis" value="{{ old('penulis', $buku->penulis) }}" required>
                            @error('penulis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="penerbit" class="form-label fw-500">Penerbit <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('penerbit') is-invalid @enderror" id="penerbit" name="penerbit" value="{{ old('penerbit', $buku->penerbit) }}" required>
                            @error('penerbit')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label for="isbn" class="form-label fw-500">ISBN <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('isbn') is-invalid @enderror" id="isbn" name="isbn" value="{{ old('isbn', $buku->isbn) }}" required>
                            @error('isbn')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="tahun_terbit" class="form-label fw-500">Tahun Terbit <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('tahun_terbit') is-invalid @enderror" id="tahun_terbit" name="tahun_terbit" value="{{ old('tahun_terbit', $buku->tahun_terbit) }}" min="1900" max="{{ date('Y') + 1 }}" required>
                            @error('tahun_terbit')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="jumlah_halaman" class="form-label fw-500">Jumlah Halaman <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('jumlah_halaman') is-invalid @enderror" id="jumlah_halaman" name="jumlah_halaman" value="{{ old('jumlah_halaman', $buku->jumlah_halaman) }}" min="1" required>
                            @error('jumlah_halaman')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="bahasa" class="form-label fw-500">Bahasa <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('bahasa') is-invalid @enderror" id="bahasa" name="bahasa" value="{{ old('bahasa', $buku->bahasa) }}" required>
                        @error('bahasa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="deskripsi" class="form-label fw-500">Deskripsi <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="6" required>{{ old('deskripsi', $buku->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-md-4">
            <!-- Gambar Cover -->
            <div class="card mb-4">
                <div class="card-header bg-white">
                    <h6 class="mb-0 fw-bold">Gambar Cover</h6>
                </div>
                <div class="card-body">
                    @if($buku->gambar_cover)
                        <div class="mb-3 text-center">
                            <img src="{{ Storage::url($buku->gambar_cover) }}" alt="{{ $buku->judul }}" class="img-fluid rounded" style="max-height: 300px;">
                        </div>
                    @endif
                    <div class="mb-3">
                        <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar" accept="image/*">
                        @error('gambar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Max 2MB (JPG, PNG) - Kosongkan jika tidak ingin mengubah</small>
                    </div>
                    <div id="preview" class="text-center d-none">
                        <img id="preview-img" src="" class="img-fluid rounded" style="max-height: 300px;">
                    </div>
                </div>
            </div>

            <!-- Kategori -->
            <div class="card mb-4">
                <div class="card-header bg-white">
                    <h6 class="mb-0 fw-bold">Kategori</h6>
                </div>
                <div class="card-body">
                    <select class="form-select @error('kategori_id') is-invalid @enderror" id="kategori_id" name="kategori_id" required>
                        <option value="">Pilih Kategori</option>
                        @foreach($kategori as $kat)
                            <option value="{{ $kat->id }}" {{ old('kategori_id', $buku->kategori_id) == $kat->id ? 'selected' : '' }}>{{ $kat->nama_kategori }}</option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Harga & Stok -->
            <div class="card mb-4">
                <div class="card-header bg-white">
                    <h6 class="mb-0 fw-bold">Harga & Stok</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="harga" class="form-label fw-500">Harga (Rp) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ old('harga', $buku->harga) }}" min="0" step="1000" required>
                        @error('harga')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="stok" class="form-label fw-500">Stok <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('stok') is-invalid @enderror" id="stok" name="stok" value="{{ old('stok', $buku->stok) }}" min="0" required>
                        @error('stok')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="berat" class="form-label fw-500">Berat (gram) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('berat') is-invalid @enderror" id="berat" name="berat" value="{{ old('berat', $buku->berat) }}" min="0" required>
                        @error('berat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Status -->
            <div class="card mb-4">
                <div class="card-header bg-white">
                    <h6 class="mb-0 fw-bold">Status</h6>
                </div>
                <div class="card-body">
                    <select class="form-select @error('is_active') is-invalid @enderror" id="is_active" name="is_active" required>
                        <option value="1" {{ old('is_active', $buku->is_active) == 1 ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ old('is_active', $buku->is_active) == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                    @error('is_active')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Tombol Submit -->
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-lg">
                    <span class="material-icons align-middle me-2" style="font-size: 18px;">save</span>
                    Update Buku
                </button>
                <a href="{{ route('admin.buku.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
document.getElementById('gambar').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview').classList.remove('d-none');
            document.getElementById('preview-img').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
});
</script>
@endpush
@endsection
