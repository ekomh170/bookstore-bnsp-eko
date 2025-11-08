@extends('layouts.admin')

@section('title', 'Detail Buku')
@section('page-title', 'Detail Buku')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <a href="{{ route('admin.buku.index') }}" class="btn btn-outline-secondary">
        <span class="material-icons align-middle me-2" style="font-size: 18px;">arrow_back</span>
        Kembali
    </a>
    <div>
        <a href="{{ route('admin.buku.edit', $buku) }}" class="btn btn-primary">
            <span class="material-icons align-middle me-2" style="font-size: 18px;">edit</span>
            Edit Buku
        </a>
    </div>
</div>

<div class="row g-4">
    <!-- Info Buku -->
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header bg-white">
                <h5 class="mb-0 fw-bold">Informasi Buku</h5>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th width="30%">Judul</th>
                        <td>{{ $buku->judul }}</td>
                    </tr>
                    <tr>
                        <th>Penulis</th>
                        <td>{{ $buku->penulis }}</td>
                    </tr>
                    <tr>
                        <th>Penerbit</th>
                        <td>{{ $buku->penerbit }}</td>
                    </tr>
                    <tr>
                        <th>ISBN</th>
                        <td><code>{{ $buku->isbn }}</code></td>
                    </tr>
                    <tr>
                        <th>Tahun Terbit</th>
                        <td>{{ $buku->tahun_terbit }}</td>
                    </tr>
                    <tr>
                        <th>Jumlah Halaman</th>
                        <td>{{ $buku->jumlah_halaman }} halaman</td>
                    </tr>
                    <tr>
                        <th>Bahasa</th>
                        <td>{{ $buku->bahasa }}</td>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <td><span class="badge bg-primary">{{ $buku->kategori->nama_kategori }}</span></td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td>{{ $buku->deskripsi }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="col-md-4">
        <!-- Cover -->
        <div class="card mb-4">
            <div class="card-header bg-white">
                <h6 class="mb-0 fw-bold">Cover Buku</h6>
            </div>
            <div class="card-body text-center">
                @if($buku->gambar)
                    <img src="{{ asset('storage/' . $buku->gambar) }}" alt="{{ $buku->judul }}" class="img-fluid rounded">
                @else
                    <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 300px;">
                        <span class="material-icons" style="font-size: 96px; color: #BDBDBD;">menu_book</span>
                    </div>
                @endif
            </div>
        </div>

        <!-- Harga & Stok -->
        <div class="card mb-4">
            <div class="card-header bg-white">
                <h6 class="mb-0 fw-bold">Harga & Stok</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <small class="text-muted">Harga</small>
                    <h4 class="fw-bold text-primary mb-0">Rp {{ number_format($buku->harga, 0, ',', '.') }}</h4>
                </div>
                <div class="mb-3">
                    <small class="text-muted">Stok</small>
                    <h4 class="fw-bold mb-0">{{ $buku->stok }}</h4>
                </div>
                <div class="mb-3">
                    <small class="text-muted">Berat</small>
                    <h4 class="fw-bold mb-0">{{ $buku->berat }} gram</h4>
                </div>
                <div class="mb-3">
                    <small class="text-muted">Terjual</small>
                    <h4 class="fw-bold mb-0">{{ $buku->terjual }}</h4>
                </div>
                <div>
                    <small class="text-muted">Status</small>
                    <div class="mt-1">
                        @if($buku->is_active)
                            <span class="badge bg-success px-3 py-2">Aktif</span>
                        @else
                            <span class="badge bg-secondary px-3 py-2">Tidak Aktif</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
