@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
<!-- Page Header -->
<div class="page-header mb-4">
    <div class="container">
        <h1 class="fw-light">
            <span class="material-icons align-middle me-3" style="font-size: 48px;">shopping_cart</span>
            Keranjang Belanja
        </h1>
        <p class="lead mb-0 mt-2">Review dan kelola pesanan Anda</p>
    </div>
</div>

@if($keranjang->isEmpty())
    <!-- Keranjang Kosong -->
    <div class="card">
        <div class="card-body text-center py-5">
            <span class="material-icons mb-3" style="font-size: 96px; color: #BDBDBD;">shopping_cart</span>
            <h3 class="fw-bold mb-2">Keranjang Belanja Kosong</h3>
            <p class="text-muted mb-4">Anda belum menambahkan buku ke keranjang belanja</p>
            <a href="{{ route('buku.index') }}" class="btn btn-primary btn-lg">
                <span class="material-icons align-middle me-2" style="font-size: 18px;">library_books</span>
                Mulai Belanja
            </a>
        </div>
    </div>
@else
    <div class="row g-4">
        <!-- Daftar Item Keranjang -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0 fw-bold">
                        Item di Keranjang ({{ $keranjang->count() }})
                    </h5>
                </div>
                <div class="card-body p-0">
                    @foreach($keranjang as $item)
                        <div class="p-4 border-bottom">
                            <div class="row align-items-center">
                                <!-- Gambar Buku -->
                                <div class="col-md-2 text-center">
                                    @if($item->buku->gambar_cover)
                                        <img src="{{ Storage::url($item->buku->gambar_cover) }}"
                                             alt="{{ $item->buku->judul }}"
                                             class="img-fluid rounded"
                                             style="max-height: 100px; object-fit: cover;">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 100px;">
                                            <span class="material-icons" style="font-size: 48px; color: #BDBDBD;">menu_book</span>
                                        </div>
                                    @endif
                                </div>

                                <!-- Info Buku -->
                                <div class="col-md-4">
                                    <h6 class="fw-bold mb-2">
                                        <a href="{{ route('buku.show', $item->buku->slug) }}" class="text-decoration-none text-dark">
                                            {{ $item->buku->judul }}
                                        </a>
                                    </h6>
                                    <p class="text-muted small mb-2">{{ $item->buku->penulis }}</p>
                                    <span class="badge bg-primary">{{ $item->buku->kategori->nama_kategori }}</span>
                                    @if($item->buku->stok < $item->jumlah)
                                        <span class="badge bg-danger ms-1">Stok Tidak Cukup</span>
                                    @endif
                                </div>

                                <!-- Harga Satuan -->
                                <div class="col-md-2 text-center">
                                    <p class="text-muted small mb-1">Harga Satuan</p>
                                    <h6 class="fw-bold mb-0">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</h6>
                                </div>

                                <!-- Jumlah -->
                                <div class="col-md-2">
                                    <form action="{{ route('keranjang.update', $item) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <label class="form-label small text-muted">Jumlah</label>
                                        <div class="input-group input-group-sm">
                                            <input type="number"
                                                   name="jumlah"
                                                   class="form-control text-center"
                                                   value="{{ $item->jumlah }}"
                                                   min="1"
                                                   max="{{ $item->buku->stok }}"
                                                   onchange="this.form.submit()">
                                            <button type="submit" class="btn btn-outline-primary" style="display: none;">
                                                <span class="material-icons" style="font-size: 14px;">check</span>
                                            </button>
                                        </div>
                                        <small class="text-muted">Stok: {{ $item->buku->stok }}</small>
                                    </form>
                                </div>

                                <!-- Subtotal & Hapus -->
                                <div class="col-md-2 text-center">
                                    <p class="text-muted small mb-1">Subtotal</p>
                                    <h6 class="fw-bold text-primary mb-2">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</h6>
                                    <form action="{{ route('keranjang.destroy', $item) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus item ini dari keranjang?')">
                                            <span class="material-icons align-middle" style="font-size: 16px;">delete</span>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Tombol Lanjut Belanja -->
            <div class="mt-3">
                <a href="{{ route('buku.index') }}" class="btn btn-outline-primary">
                    <span class="material-icons align-middle me-2" style="font-size: 18px;">arrow_back</span>
                    Lanjut Belanja
                </a>
            </div>
        </div>

        <!-- Ringkasan Pesanan -->
        <div class="col-md-4">
            <div class="card position-sticky" style="top: 20px;">
                <div class="card-header bg-white">
                    <h5 class="mb-0 fw-bold">Ringkasan Pesanan</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">Total Item</span>
                        <span class="fw-bold">{{ $keranjang->sum('jumlah') }} Buku</span>
                    </div>

                    <div class="d-flex justify-content-between mb-3 pb-3 border-bottom">
                        <span class="text-muted">Subtotal</span>
                        <span class="fw-bold">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <div class="d-flex justify-content-between mb-4">
                        <h5 class="fw-bold mb-0">Total</h5>
                        <h5 class="fw-bold mb-0 text-primary">Rp {{ number_format($total, 0, ',', '.') }}</h5>
                    </div>

                    @php
                        $hasInvalidStock = $keranjang->filter(function($item) {
                            return $item->buku->stok < $item->jumlah;
                        })->isNotEmpty();
                    @endphp

                    @if($hasInvalidStock)
                        <div class="alert alert-warning">
                            <small>
                                <span class="material-icons align-middle" style="font-size: 16px;">warning</span>
                                Ada item dengan stok tidak mencukupi. Silakan perbarui jumlah.
                            </small>
                        </div>
                    @endif

                    <a href="{{ route('checkout') }}"
                       class="btn btn-primary btn-lg w-100 {{ $hasInvalidStock ? 'disabled' : '' }}"
                       {{ $hasInvalidStock ? 'aria-disabled=true' : '' }}>
                        <span class="material-icons align-middle me-2" style="font-size: 18px;">shopping_bag</span>
                        Lanjut ke Checkout
                    </a>

                    <div class="mt-3 text-center">
                        <small class="text-muted">
                            <span class="material-icons align-middle" style="font-size: 14px;">verified</span>
                            Belanja Aman & Terpercaya
                        </small>
                    </div>
                </div>
            </div>

            <!-- Info Pengiriman -->
            <div class="card mt-3">
                <div class="card-body p-3 text-center">
                    <span class="material-icons mb-2" style="font-size: 36px; color: var(--primary-color);">local_shipping</span>
                    <p class="small mb-0 fw-500">Gratis Ongkir</p>
                    <small class="text-muted">Untuk pembelian di atas Rp 100.000</small>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection
