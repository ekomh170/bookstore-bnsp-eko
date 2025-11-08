@extends('layouts.app')

@section('title', 'Detail Pesanan')

@section('content')
<!-- Page Header -->
<div class="page-header mb-4">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="fw-light mb-2">
                    <span class="material-icons align-middle me-3" style="font-size: 48px;">receipt_long</span>
                    Detail Pesanan
                </h1>
                <p class="lead mb-0">{{ $pesanan->nomor_pesanan }}</p>
            </div>
            <a href="{{ route('pesanan.index') }}" class="btn btn-outline-primary">
                <span class="material-icons align-middle me-2" style="font-size: 18px;">arrow_back</span>
                Kembali
            </a>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Info Pesanan & Item -->
    <div class="col-md-8">
        <!-- Status Card -->
        <div class="card mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="fw-bold mb-2">Status Pesanan</h5>
                        <p class="text-muted mb-0">Terakhir diupdate: {{ $pesanan->updated_at->format('d M Y, H:i') }}</p>
                    </div>
                    <div>
                        @if($pesanan->status === 'menunggu_pembayaran')
                            <span class="badge bg-warning text-dark px-4 py-3 fs-6">
                                <span class="material-icons align-middle me-2" style="font-size: 20px;">schedule</span>
                                Menunggu Pembayaran
                            </span>
                        @elseif($pesanan->status === 'dibayar')
                            <span class="badge bg-info text-dark px-4 py-3 fs-6">
                                <span class="material-icons align-middle me-2" style="font-size: 20px;">payment</span>
                                Dibayar
                            </span>
                        @elseif($pesanan->status === 'diproses')
                            <span class="badge bg-primary px-4 py-3 fs-6">
                                <span class="material-icons align-middle me-2" style="font-size: 20px;">inventory</span>
                                Diproses
                            </span>
                        @elseif($pesanan->status === 'dikirim')
                            <span class="badge bg-info px-4 py-3 fs-6">
                                <span class="material-icons align-middle me-2" style="font-size: 20px;">local_shipping</span>
                                Dikirim
                            </span>
                        @elseif($pesanan->status === 'selesai')
                            <span class="badge bg-success px-4 py-3 fs-6">
                                <span class="material-icons align-middle me-2" style="font-size: 20px;">check_circle</span>
                                Selesai
                            </span>
                        @elseif($pesanan->status === 'dibatalkan')
                            <span class="badge bg-danger px-4 py-3 fs-6">
                                <span class="material-icons align-middle me-2" style="font-size: 20px;">cancel</span>
                                Dibatalkan
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Progress Timeline -->
                <div class="mt-4">
                    <div class="d-flex justify-content-between position-relative">
                        @php
                            $statuses = [
                                'menunggu_pembayaran' => 'Menunggu Pembayaran',
                                'dibayar' => 'Dibayar',
                                'diproses' => 'Diproses',
                                'dikirim' => 'Dikirim',
                                'selesai' => 'Selesai'
                            ];
                            $currentIndex = array_search($pesanan->status, array_keys($statuses));
                        @endphp

                        @foreach($statuses as $key => $label)
                            @php
                                $index = array_search($key, array_keys($statuses));
                                $isActive = $pesanan->status === 'dibatalkan' ? false : ($index <= $currentIndex);
                            @endphp
                            <div class="text-center" style="flex: 1; z-index: 2;">
                                <div class="mb-2">
                                    <span class="rounded-circle d-inline-flex align-items-center justify-content-center {{ $isActive ? 'bg-primary text-white' : 'bg-light text-muted' }}"
                                          style="width: 40px; height: 40px;">
                                        @if($isActive)
                                            <span class="material-icons">check</span>
                                        @else
                                            <span class="material-icons">radio_button_unchecked</span>
                                        @endif
                                    </span>
                                </div>
                                <small class="fw-500 {{ $isActive ? 'text-primary' : 'text-muted' }}">{{ $label }}</small>
                            </div>
                        @endforeach

                        <!-- Progress Line -->
                        <div class="position-absolute top-0 start-0 w-100" style="height: 40px; z-index: 1;">
                            <div class="bg-light" style="height: 2px; margin-top: 19px;"></div>
                            <div class="bg-primary" style="height: 2px; margin-top: -2px; width: {{ $pesanan->status === 'dibatalkan' ? 0 : (($currentIndex + 1) / count($statuses) * 100) }}%; transition: width 0.3s;"></div>
                        </div>
                    </div>
                </div>

                @if($pesanan->status === 'dibatalkan')
                    <div class="alert alert-danger mt-3">
                        <span class="material-icons align-middle me-2">info</span>
                        Pesanan ini telah dibatalkan
                    </div>
                @endif
            </div>
        </div>

        <!-- Daftar Item -->
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0 fw-bold">Item Pesanan</h5>
            </div>
            <div class="card-body p-0">
                @foreach($pesanan->detailPesanan as $detail)
                    <div class="p-4 border-bottom">
                        <div class="row align-items-center">
                            <div class="col-md-2 text-center">
                                @if($detail->buku->gambar_cover)
                                    <img src="{{ Storage::url($detail->buku->gambar_cover) }}"
                                         alt="{{ $detail->buku->judul }}"
                                         class="img-fluid rounded"
                                         style="max-height: 100px; object-fit: cover;">
                                @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 100px;">
                                        <span class="material-icons" style="font-size: 48px; color: #BDBDBD;">menu_book</span>
                                    </div>
                                @endif
                            </div>

                            <div class="col-md-5">
                                <h6 class="fw-bold mb-2">{{ $detail->buku->judul }}</h6>
                                <p class="text-muted small mb-2">{{ $detail->buku->penulis }}</p>
                                <span class="badge bg-primary">{{ $detail->buku->kategori->nama_kategori }}</span>
                            </div>

                            <div class="col-md-2 text-center">
                                <p class="text-muted small mb-1">Harga Satuan</p>
                                <p class="fw-500 mb-0">Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</p>
                            </div>

                            <div class="col-md-1 text-center">
                                <p class="text-muted small mb-1">Jumlah</p>
                                <p class="fw-bold mb-0">x{{ $detail->jumlah }}</p>
                            </div>

                            <div class="col-md-2 text-center">
                                <p class="text-muted small mb-1">Subtotal</p>
                                <h6 class="fw-bold text-primary mb-0">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</h6>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Sidebar Info -->
    <div class="col-md-4">
        <!-- Ringkasan Pembayaran -->
        <div class="card mb-4">
            <div class="card-header bg-white">
                <h5 class="mb-0 fw-bold">Ringkasan Pembayaran</h5>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <span class="text-muted">Subtotal</span>
                    <span class="fw-bold">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
                </div>

                <div class="d-flex justify-content-between mb-3 pb-3 border-bottom">
                    <span class="text-muted">Ongkos Kirim</span>
                    <span class="fw-bold text-success">Gratis</span>
                </div>

                <div class="d-flex justify-content-between mb-3">
                    <h5 class="fw-bold mb-0">Total</h5>
                    <h5 class="fw-bold mb-0 text-primary">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</h5>
                </div>

                <div class="d-flex justify-content-between text-muted small">
                    <span>Metode Pembayaran</span>
                    <span class="fw-500">{{ strtoupper(str_replace('_', ' ', $pesanan->metode_pembayaran)) }}</span>
                </div>
            </div>
        </div>

        <!-- Info Pengiriman -->
        <div class="card mb-4">
            <div class="card-header bg-white">
                <h5 class="mb-0 fw-bold">
                    <span class="material-icons align-middle me-2">local_shipping</span>
                    Info Pengiriman
                </h5>
            </div>
            <div class="card-body">
                <p class="mb-2 fw-bold">{{ $pesanan->nama_penerima }}</p>
                <p class="mb-2 text-muted">
                    <span class="material-icons align-middle" style="font-size: 14px;">phone</span>
                    {{ $pesanan->telepon_penerima }}
                </p>
                <p class="mb-0 text-muted">
                    <span class="material-icons align-middle" style="font-size: 14px;">location_on</span>
                    {{ $pesanan->alamat_pengiriman }}
                </p>

                @if($pesanan->catatan)
                    <div class="mt-3 p-2 bg-light rounded">
                        <small class="text-muted d-block mb-1">Catatan:</small>
                        <small>{{ $pesanan->catatan }}</small>
                    </div>
                @endif
            </div>
        </div>

        <!-- Upload Bukti Pembayaran -->
        @if($pesanan->status === 'menunggu_pembayaran')
            <div class="card mb-4 border-warning">
                <div class="card-header bg-warning text-dark">
                    <h6 class="mb-0 fw-bold">
                        <span class="material-icons align-middle me-2">upload</span>
                        Upload Bukti Pembayaran
                    </h6>
                </div>
                <div class="card-body">
                    <p class="small mb-3">Silakan transfer ke rekening:</p>
                    <div class="bg-light p-3 rounded mb-3">
                        <p class="mb-1 fw-bold">Bank BCA</p>
                        <p class="mb-1">No. Rek: 1234567890</p>
                        <p class="mb-0">A.n. Bookstore Eko Haryono</p>
                    </div>

                    <form action="{{ route('pesanan.upload-bukti', $pesanan) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label small">Upload Bukti Transfer</label>
                            <input type="file"
                                   name="bukti_pembayaran"
                                   class="form-control @error('bukti_pembayaran') is-invalid @enderror"
                                   accept="image/*"
                                   required>
                            @error('bukti_pembayaran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-warning w-100">
                            <span class="material-icons align-middle me-2" style="font-size: 18px;">cloud_upload</span>
                            Upload Bukti
                        </button>
                    </form>
                </div>
            </div>
        @endif

        <!-- Bukti Pembayaran (jika sudah upload) -->
        @if($pesanan->bukti_pembayaran)
            <div class="card mb-4">
                <div class="card-header bg-white">
                    <h6 class="mb-0 fw-bold">Bukti Pembayaran</h6>
                </div>
                <div class="card-body text-center">
                    <img src="{{ Storage::url($pesanan->bukti_pembayaran) }}"
                         alt="Bukti Pembayaran"
                         class="img-fluid rounded">
                    @if($pesanan->tanggal_pembayaran)
                        <p class="small text-muted mt-2 mb-0">
                            Diupload: {{ $pesanan->tanggal_pembayaran->format('d M Y, H:i') }}
                        </p>
                    @endif
                </div>
            </div>
        @endif

        <!-- Tombol Batal -->
        @if($pesanan->bisDibatalkan())
            <form action="{{ route('pesanan.cancel', $pesanan) }}" method="POST">
                @csrf
                <button type="submit"
                        class="btn btn-outline-danger w-100"
                        onclick="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')">
                    <span class="material-icons align-middle me-2" style="font-size: 18px;">cancel</span>
                    Batalkan Pesanan
                </button>
            </form>
        @endif
    </div>
</div>
@endsection
