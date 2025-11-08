@extends('layouts.admin')

@section('title', 'Detail Pesanan')
@section('page-title', 'Detail Pesanan')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.pesanan.index') }}" class="btn btn-outline-secondary">
        <span class="material-icons align-middle me-2" style="font-size: 18px;">arrow_back</span>
        Kembali
    </a>
</div>

<div class="row g-4">
    <!-- Info Pesanan -->
    <div class="col-md-8">
        <!-- Status & Update -->
        <div class="card mb-4">
            <div class="card-header bg-white">
                <h5 class="mb-0 fw-bold">Status Pesanan</h5>
            </div>
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="text-muted mb-1">Status Saat Ini:</p>
                        @if($pesanan->status === 'menunggu_pembayaran')
                            <h5><span class="badge bg-warning text-dark px-3 py-2">Menunggu Pembayaran</span></h5>
                        @elseif($pesanan->status === 'dibayar')
                            <h5><span class="badge bg-info px-3 py-2">Dibayar</span></h5>
                        @elseif($pesanan->status === 'diproses')
                            <h5><span class="badge bg-primary px-3 py-2">Diproses</span></h5>
                        @elseif($pesanan->status === 'dikirim')
                            <h5><span class="badge bg-info px-3 py-2">Dikirim</span></h5>
                        @elseif($pesanan->status === 'selesai')
                            <h5><span class="badge bg-success px-3 py-2">Selesai</span></h5>
                        @elseif($pesanan->status === 'dibatalkan')
                            <h5><span class="badge bg-danger px-3 py-2">Dibatalkan</span></h5>
                        @endif
                    </div>
                    <div class="col-md-6">
                        @if($pesanan->status !== 'selesai' && $pesanan->status !== 'dibatalkan')
                            <form action="{{ route('admin.pesanan.update-status', $pesanan) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="d-flex gap-2">
                                    <select name="status" class="form-select" required>
                                        @if($pesanan->status === 'menunggu_pembayaran')
                                            <option value="dibayar">Ubah ke Dibayar</option>
                                            <option value="dibatalkan">Batalkan</option>
                                        @elseif($pesanan->status === 'dibayar')
                                            <option value="diproses">Proses Pesanan</option>
                                            <option value="dibatalkan">Batalkan</option>
                                        @elseif($pesanan->status === 'diproses')
                                            <option value="dikirim">Kirim Pesanan</option>
                                            <option value="dibatalkan">Batalkan</option>
                                        @elseif($pesanan->status === 'dikirim')
                                            <option value="selesai">Selesaikan</option>
                                        @endif
                                    </select>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>

                @if($pesanan->status === 'dibayar' && $pesanan->bukti_pembayaran)
                    <div class="mt-3">
                        <form action="{{ route('admin.pesanan.konfirmasi', $pesanan) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success">
                                <span class="material-icons align-middle me-2" style="font-size: 18px;">check_circle</span>
                                Konfirmasi Pembayaran & Proses
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>

        <!-- Item Pesanan -->
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0 fw-bold">Item Pesanan</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>Buku</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pesanan->detailPesanan as $detail)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($detail->buku->gambar_cover)
                                                <img src="{{ Storage::url($detail->buku->gambar_cover) }}"
                                                     alt="{{ $detail->buku->judul }}"
                                                     class="rounded me-2"
                                                     style="width: 50px; height: 70px; object-fit: cover;">
                                            @else
                                                <div class="bg-light rounded me-2" style="width: 50px; height: 70px;"></div>
                                            @endif
                                            <div>
                                                <div class="fw-bold">{{ $detail->buku->judul }}</div>
                                                <small class="text-muted">{{ $detail->buku->penulis }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                                    <td>x{{ $detail->jumlah }}</td>
                                    <td class="fw-bold">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="col-md-4">
        <!-- Info Customer -->
        <div class="card mb-4">
            <div class="card-header bg-white">
                <h6 class="mb-0 fw-bold">Informasi Customer</h6>
            </div>
            <div class="card-body">
                <p class="mb-2"><strong>{{ $pesanan->user->name }}</strong></p>
                <p class="text-muted mb-0 small">{{ $pesanan->user->email }}</p>
            </div>
        </div>

        <!-- Info Pengiriman -->
        <div class="card mb-4">
            <div class="card-header bg-white">
                <h6 class="mb-0 fw-bold">Info Pengiriman</h6>
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

        <!-- Ringkasan Pembayaran -->
        <div class="card mb-4">
            <div class="card-header bg-white">
                <h6 class="mb-0 fw-bold">Ringkasan Pembayaran</h6>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <span>Subtotal</span>
                    <span class="fw-bold">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
                </div>
                <div class="d-flex justify-content-between mb-3 pb-3 border-bottom">
                    <span>Ongkir</span>
                    <span class="text-success fw-bold">Gratis</span>
                </div>
                <div class="d-flex justify-content-between">
                    <h6 class="fw-bold mb-0">Total</h6>
                    <h6 class="fw-bold mb-0 text-primary">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</h6>
                </div>
                <div class="mt-2">
                    <small class="text-muted">Metode: {{ strtoupper(str_replace('_', ' ', $pesanan->metode_pembayaran)) }}</small>
                </div>
            </div>
        </div>

        <!-- Bukti Pembayaran -->
        @if($pesanan->bukti_pembayaran)
            <div class="card">
                <div class="card-header bg-white">
                    <h6 class="mb-0 fw-bold">Bukti Pembayaran</h6>
                </div>
                <div class="card-body text-center">
                    <img src="{{ Storage::url($pesanan->bukti_pembayaran) }}"
                         alt="Bukti Pembayaran"
                         class="img-fluid rounded">
                    @if($pesanan->tanggal_pembayaran)
                        <p class="small text-muted mt-2 mb-0">
                            Upload: {{ $pesanan->tanggal_pembayaran->format('d M Y, H:i') }}
                        </p>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
