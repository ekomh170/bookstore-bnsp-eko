@extends('layouts.app')

@section('title', 'Daftar Pesanan')

@section('content')
<!-- Page Header -->
<div class="page-header mb-4">
    <div class="container">
        <h1 class="fw-light">
            <span class="material-icons align-middle me-3" style="font-size: 48px;">receipt_long</span>
            Pesanan Saya
        </h1>
        <p class="lead mb-0 mt-2">Lacak dan kelola pesanan Anda</p>
    </div>
</div>

@if($pesanan->isEmpty())
    <!-- Belum Ada Pesanan -->
    <div class="card">
        <div class="card-body text-center py-5">
            <span class="material-icons mb-3" style="font-size: 96px; color: #BDBDBD;">receipt_long</span>
            <h3 class="fw-bold mb-2">Belum Ada Pesanan</h3>
            <p class="text-muted mb-4">Anda belum memiliki riwayat pesanan</p>
            <a href="{{ route('buku.index') }}" class="btn btn-primary btn-lg">
                <span class="material-icons align-middle me-2" style="font-size: 18px;">shopping_cart</span>
                Mulai Belanja
            </a>
        </div>
    </div>
@else
    <!-- Daftar Pesanan -->
    <div class="row g-4">
        @foreach($pesanan as $p)
            <div class="col-12">
                <div class="card hover-card">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <!-- Info Pesanan -->
                            <div class="col-md-3">
                                <p class="text-muted small mb-1">No. Pesanan</p>
                                <h6 class="fw-bold mb-2">{{ $p->nomor_pesanan }}</h6>
                                <p class="text-muted small mb-0">
                                    <span class="material-icons align-middle" style="font-size: 14px;">calendar_today</span>
                                    {{ $p->created_at->format('d M Y, H:i') }}
                                </p>
                            </div>

                            <!-- Item Pesanan -->
                            <div class="col-md-4">
                                <p class="text-muted small mb-2">Item Pesanan</p>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach($p->detailPesanan->take(3) as $detail)
                                        <div class="d-flex align-items-center bg-light rounded p-2">
                                            @if($detail->buku->gambar_cover)
                                                <img src="{{ Storage::url($detail->buku->gambar_cover) }}"
                                                     alt="{{ $detail->buku->judul }}"
                                                     class="rounded me-2"
                                                     style="width: 40px; height: 40px; object-fit: cover;">
                                            @else
                                                <span class="material-icons me-2" style="font-size: 40px; color: #BDBDBD;">menu_book</span>
                                            @endif
                                            <div>
                                                <small class="fw-500">{{ Str::limit($detail->buku->judul, 20) }}</small>
                                                <br>
                                                <small class="text-muted">x{{ $detail->jumlah }}</small>
                                            </div>
                                        </div>
                                    @endforeach
                                    @if($p->detailPesanan->count() > 3)
                                        <span class="badge bg-secondary align-self-center">+{{ $p->detailPesanan->count() - 3 }} lainnya</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Total Harga -->
                            <div class="col-md-2 text-center">
                                <p class="text-muted small mb-1">Total Harga</p>
                                <h5 class="fw-bold text-primary mb-0">Rp {{ number_format($p->total_harga, 0, ',', '.') }}</h5>
                            </div>

                            <!-- Status -->
                            <div class="col-md-2 text-center">
                                <p class="text-muted small mb-1">Status</p>
                                @if($p->status === 'menunggu_pembayaran')
                                    <span class="badge bg-warning text-dark px-3 py-2">
                                        <span class="material-icons align-middle" style="font-size: 14px;">schedule</span>
                                        Menunggu Pembayaran
                                    </span>
                                @elseif($p->status === 'dibayar')
                                    <span class="badge bg-info text-dark px-3 py-2">
                                        <span class="material-icons align-middle" style="font-size: 14px;">payment</span>
                                        Dibayar
                                    </span>
                                @elseif($p->status === 'diproses')
                                    <span class="badge bg-primary px-3 py-2">
                                        <span class="material-icons align-middle" style="font-size: 14px;">inventory</span>
                                        Diproses
                                    </span>
                                @elseif($p->status === 'dikirim')
                                    <span class="badge bg-info px-3 py-2">
                                        <span class="material-icons align-middle" style="font-size: 14px;">local_shipping</span>
                                        Dikirim
                                    </span>
                                @elseif($p->status === 'selesai')
                                    <span class="badge bg-success px-3 py-2">
                                        <span class="material-icons align-middle" style="font-size: 14px;">check_circle</span>
                                        Selesai
                                    </span>
                                @elseif($p->status === 'dibatalkan')
                                    <span class="badge bg-danger px-3 py-2">
                                        <span class="material-icons align-middle" style="font-size: 14px;">cancel</span>
                                        Dibatalkan
                                    </span>
                                @endif
                            </div>

                            <!-- Aksi -->
                            <div class="col-md-1 text-center">
                                <a href="{{ route('pesanan.show', $p) }}" class="btn btn-outline-primary btn-sm">
                                    <span class="material-icons" style="font-size: 18px;">visibility</span>
                                </a>
                            </div>
                        </div>

                        <!-- Progress Bar untuk Status -->
                        <div class="mt-3">
                            <div class="progress" style="height: 5px;">
                                @php
                                    $progress = match($p->status) {
                                        'menunggu_pembayaran' => 20,
                                        'dibayar' => 40,
                                        'diproses' => 60,
                                        'dikirim' => 80,
                                        'selesai' => 100,
                                        'dibatalkan' => 0,
                                        default => 0,
                                    };
                                @endphp
                                <div class="progress-bar {{ $p->status === 'dibatalkan' ? 'bg-danger' : 'bg-primary' }}"
                                     role="progressbar"
                                     style="width: {{ $progress }}%"
                                     aria-valuenow="{{ $progress }}"
                                     aria-valuemin="0"
                                     aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $pesanan->links() }}
    </div>
@endif

@push('styles')
<style>
    .hover-card {
        transition: all 0.3s ease;
    }
    .hover-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-3) !important;
    }
</style>
@endpush
@endsection
