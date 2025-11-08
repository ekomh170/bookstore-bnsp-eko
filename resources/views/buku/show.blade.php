@extends('layouts.app')

@section('title', $buku->judul)

@section('content')
<div class="row">
    <!-- Book Image & Actions -->
    <div class="col-md-4">
        <div class="card sticky-top" style="top: 100px;">
            <div class="card-body p-0">
                <div class="bg-light d-flex align-items-center justify-content-center" style="height: 450px;">
                    @if($buku->gambar)
                        <img src="{{ asset('storage/' . $buku->gambar) }}"
                             alt="{{ $buku->judul }}"
                             class="img-fluid"
                             style="max-height: 100%; max-width: 100%; object-fit: contain;">
                    @else
                        <span class="material-icons" style="font-size: 128px; color: #BDBDBD;">menu_book</span>
                    @endif
                </div>

                <div class="p-4">
                    <div class="mb-3">
                        <h3 class="fw-bold mb-0" style="color: var(--primary-color);">
                            Rp {{ number_format($buku->harga, 0, ',', '.') }}
                        </h3>
                    </div>

                    @if($buku->stok > 0)
                        <div class="alert alert-success mb-3">
                            <span class="material-icons align-middle me-2" style="font-size: 18px;">check_circle</span>
                            <strong>Stok Tersedia:</strong> {{ $buku->stok }} unit
                        </div>

                        @auth
                            @if(!auth()->user()->isAdmin())
                                <form action="{{ route('keranjang.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="buku_id" value="{{ $buku->id }}">

                                    <div class="mb-3">
                                        <label class="form-label fw-500">Jumlah</label>
                                        <input type="number"
                                               name="jumlah"
                                               class="form-control"
                                               value="1"
                                               min="1"
                                               max="{{ $buku->stok }}"
                                               required>
                                    </div>

                                    <button type="submit" class="btn btn-primary w-100 py-3">
                                        <span class="material-icons align-middle me-2" style="font-size: 20px;">add_shopping_cart</span>
                                        Tambah ke Keranjang
                                    </button>
                                </form>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary w-100 py-3">
                                <span class="material-icons align-middle me-2" style="font-size: 20px;">login</span>
                                Login untuk Membeli
                            </a>
                        @endauth
                    @else
                        <div class="alert alert-danger">
                            <span class="material-icons align-middle me-2" style="font-size: 18px;">error</span>
                            <strong>Stok Habis</strong>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Book Details -->
    <div class="col-md-8">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('buku.index') }}">Buku</a></li>
                <li class="breadcrumb-item active">{{ $buku->judul }}</li>
            </ol>
        </nav>

        <div class="card mb-4">
            <div class="card-body p-4">
                <span class="badge bg-primary mb-3">{{ $buku->kategori->nama_kategori }}</span>

                <h2 class="fw-bold mb-3">{{ $buku->judul }}</h2>

                <div class="mb-4">
                    @if($buku->terjual > 0)
                        <span class="text-muted me-3">
                            <span class="material-icons align-middle" style="font-size: 18px;">shopping_cart</span>
                            Terjual {{ $buku->terjual }}
                        </span>
                    @endif
                    <span class="text-muted">
                        <span class="material-icons align-middle" style="font-size: 18px;">star</span>
                        4.5/5 ({{ rand(10, 100) }} ulasan)
                    </span>
                </div>

                <hr>

                <h5 class="fw-bold mb-3">Detail Buku</h5>
                <table class="table table-borderless">
                    <tr>
                        <td class="text-muted" style="width: 150px;">Penulis</td>
                        <td class="fw-500">{{ $buku->penulis }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Penerbit</td>
                        <td class="fw-500">{{ $buku->penerbit }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Tahun Terbit</td>
                        <td class="fw-500">{{ $buku->tahun_terbit }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">ISBN</td>
                        <td class="fw-500">{{ $buku->isbn }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Jumlah Halaman</td>
                        <td class="fw-500">{{ $buku->jumlah_halaman }} halaman</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Bahasa</td>
                        <td class="fw-500">{{ $buku->bahasa }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Berat</td>
                        <td class="fw-500">{{ $buku->berat }} gram</td>
                    </tr>
                </table>

                <hr>

                <h5 class="fw-bold mb-3">Deskripsi</h5>
                <p class="text-muted" style="text-align: justify;">{{ $buku->deskripsi }}</p>
            </div>
        </div>

        <!-- Buku Terkait -->
        @if($buku_terkait->count() > 0)
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0 fw-bold">Buku Terkait</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        @foreach($buku_terkait as $related)
                            <div class="col-md-6">
                                <div class="d-flex">
                                    <div class="bg-light d-flex align-items-center justify-content-center" style="width: 80px; height: 120px; flex-shrink: 0;">
                                        @if($related->gambar)
                                            <img src="{{ asset('storage/' . $related->gambar) }}"
                                                 alt="{{ $related->judul }}"
                                                 class="img-fluid"
                                                 style="max-height: 100%; object-fit: contain;">
                                        @else
                                            <span class="material-icons" style="font-size: 48px; color: #BDBDBD;">menu_book</span>
                                        @endif
                                    </div>
                                    <div class="ms-3" style="flex: 1;">
                                        <a href="{{ route('buku.show', $related->slug) }}" class="text-decoration-none">
                                            <h6 class="fw-bold mb-1">{{ Str::limit($related->judul, 40) }}</h6>
                                        </a>
                                        <p class="text-muted small mb-2">{{ $related->penulis }}</p>
                                        <p class="fw-bold mb-0" style="color: var(--primary-color);">
                                            Rp {{ number_format($related->harga, 0, ',', '.') }}</p>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
