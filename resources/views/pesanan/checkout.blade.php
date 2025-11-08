@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<!-- Page Header -->
<div class="page-header mb-4">
    <div class="container">
        <h1 class="fw-light">
            <span class="material-icons align-middle me-3" style="font-size: 48px;">shopping_bag</span>
            Checkout
        </h1>
        <p class="lead mb-0 mt-2">Lengkapi data pengiriman dan pembayaran Anda</p>
    </div>
</div>

<form action="{{ route('checkout.store') }}" method="POST">
    @csrf

    <div class="row g-4">
        <!-- Form Pengiriman -->
        <div class="col-md-8">
            <!-- Data Penerima -->
            <div class="card mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0 fw-bold">
                        <span class="material-icons align-middle me-2">person</span>
                        Data Penerima
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nama_penerima" class="form-label fw-500">Nama Penerima <span class="text-danger">*</span></label>
                            <input type="text"
                                   class="form-control @error('nama_penerima') is-invalid @enderror"
                                   id="nama_penerima"
                                   name="nama_penerima"
                                   value="{{ old('nama_penerima', auth()->user()->name) }}"
                                   required>
                            @error('nama_penerima')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="telepon_penerima" class="form-label fw-500">No. Telepon <span class="text-danger">*</span></label>
                            <input type="text"
                                   class="form-control @error('telepon_penerima') is-invalid @enderror"
                                   id="telepon_penerima"
                                   name="telepon_penerima"
                                   value="{{ old('telepon_penerima', auth()->user()->telepon) }}"
                                   placeholder="08xxxxxxxxxx"
                                   required>
                            @error('telepon_penerima')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="alamat_pengiriman" class="form-label fw-500">Alamat Lengkap <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('alamat_pengiriman') is-invalid @enderror"
                                      id="alamat_pengiriman"
                                      name="alamat_pengiriman"
                                      rows="4"
                                      placeholder="Masukkan alamat lengkap termasuk nama jalan, nomor rumah, RT/RW, kelurahan, kecamatan, kota/kabupaten, provinsi, dan kode pos"
                                      required>{{ old('alamat_pengiriman', auth()->user()->alamat) }}</textarea>
                            @error('alamat_pengiriman')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="catatan" class="form-label fw-500">Catatan (Opsional)</label>
                            <textarea class="form-control"
                                      id="catatan"
                                      name="catatan"
                                      rows="2"
                                      placeholder="Catatan tambahan untuk kurir atau penjual">{{ old('catatan') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Metode Pembayaran -->
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0 fw-bold">
                        <span class="material-icons align-middle me-2">payment</span>
                        Metode Pembayaran
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <input type="radio"
                                   class="btn-check"
                                   name="metode_pembayaran"
                                   id="transfer_bank"
                                   value="transfer_bank"
                                   {{ old('metode_pembayaran', 'transfer_bank') === 'transfer_bank' ? 'checked' : '' }}
                                   required>
                            <label class="btn btn-outline-primary w-100 p-3" for="transfer_bank">
                                <span class="material-icons d-block mb-2" style="font-size: 36px;">account_balance</span>
                                <strong>Transfer Bank</strong>
                                <small class="d-block text-muted">BCA, BNI, Mandiri</small>
                            </label>
                        </div>

                        <div class="col-md-4">
                            <input type="radio"
                                   class="btn-check"
                                   name="metode_pembayaran"
                                   id="e_wallet"
                                   value="e_wallet"
                                   {{ old('metode_pembayaran') === 'e_wallet' ? 'checked' : '' }}>
                            <label class="btn btn-outline-primary w-100 p-3" for="e_wallet">
                                <span class="material-icons d-block mb-2" style="font-size: 36px;">account_balance_wallet</span>
                                <strong>E-Wallet</strong>
                                <small class="d-block text-muted">GoPay, OVO, Dana</small>
                            </label>
                        </div>

                        <div class="col-md-4">
                            <input type="radio"
                                   class="btn-check"
                                   name="metode_pembayaran"
                                   id="cod"
                                   value="cod"
                                   {{ old('metode_pembayaran') === 'cod' ? 'checked' : '' }}>
                            <label class="btn btn-outline-primary w-100 p-3" for="cod">
                                <span class="material-icons d-block mb-2" style="font-size: 36px;">local_shipping</span>
                                <strong>COD</strong>
                                <small class="d-block text-muted">Bayar di Tempat</small>
                            </label>
                        </div>
                    </div>
                    @error('metode_pembayaran')
                        <div class="text-danger small mt-2">{{ $message }}</div>
                    @enderror

                    <div class="alert alert-info mt-3">
                        <span class="material-icons align-middle me-2">info</span>
                        <small>Setelah checkout, Anda akan mendapat instruksi pembayaran sesuai metode yang dipilih.</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ringkasan Pesanan -->
        <div class="col-md-4">
            <div class="card position-sticky" style="top: 20px;">
                <div class="card-header bg-white">
                    <h5 class="mb-0 fw-bold">Ringkasan Pesanan</h5>
                </div>
                <div class="card-body">
                    <!-- Item List -->
                    <div class="mb-3 pb-3 border-bottom">
                        <h6 class="fw-bold mb-3">Item ({{ $keranjang->count() }})</h6>
                        <div style="max-height: 200px; overflow-y: auto;">
                            @foreach($keranjang as $item)
                                <div class="d-flex align-items-center mb-3">
                                    @if($item->buku->gambar_cover)
                                        <img src="{{ Storage::url($item->buku->gambar_cover) }}"
                                             alt="{{ $item->buku->judul }}"
                                             class="rounded me-2"
                                             style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <span class="material-icons me-2" style="font-size: 50px; color: #BDBDBD;">menu_book</span>
                                    @endif
                                    <div style="flex: 1;">
                                        <p class="mb-1 small fw-500">{{ Str::limit($item->buku->judul, 30) }}</p>
                                        <small class="text-muted">{{ $item->jumlah }} x Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</small>
                                    </div>
                                    <p class="mb-0 fw-bold small">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Total -->
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Subtotal</span>
                        <span class="fw-bold">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <div class="d-flex justify-content-between mb-3 pb-3 border-bottom">
                        <span class="text-muted">Ongkos Kirim</span>
                        <span class="fw-bold text-success">Gratis</span>
                    </div>

                    <div class="d-flex justify-content-between mb-4">
                        <h5 class="fw-bold mb-0">Total Pembayaran</h5>
                        <h5 class="fw-bold mb-0 text-primary">Rp {{ number_format($total, 0, ',', '.') }}</h5>
                    </div>

                    <!-- Button Checkout -->
                    <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">
                        <span class="material-icons align-middle me-2" style="font-size: 18px;">check_circle</span>
                        Buat Pesanan
                    </button>

                    <div class="text-center">
                        <small class="text-muted">
                            <span class="material-icons align-middle" style="font-size: 14px;">lock</span>
                            Transaksi Aman & Terpercaya
                        </small>
                    </div>
                </div>
            </div>

            <!-- Info Pengiriman -->
            <div class="card mt-3">
                <div class="card-body p-3">
                    <div class="d-flex align-items-start mb-2">
                        <span class="material-icons text-primary me-2">local_shipping</span>
                        <div>
                            <p class="mb-1 small fw-500">Gratis Ongkir</p>
                            <small class="text-muted">Untuk pembelian minimal Rp 100.000</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-start">
                        <span class="material-icons text-primary me-2">verified</span>
                        <div>
                            <p class="mb-1 small fw-500">100% Original</p>
                            <small class="text-muted">Semua buku dijamin keasliannya</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@push('styles')
<style>
    .btn-check:checked + .btn-outline-primary {
        background-color: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }

    .btn-outline-primary:hover {
        background-color: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }
</style>
@endpush
@endsection
