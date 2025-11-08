@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')

@section('content')
<!-- Stats Cards -->
<div class="row g-4 mb-4">
    <!-- Total User -->
    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="stat-label">Total User</p>
                    <h2 class="stat-value">{{ number_format($stats['total_user']) }}</h2>
                </div>
                <div class="stat-icon">
                    <span class="material-icons">people</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Buku -->
    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="stat-label">Total Buku</p>
                    <h2 class="stat-value">{{ number_format($stats['total_buku']) }}</h2>
                </div>
                <div class="stat-icon">
                    <span class="material-icons">menu_book</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Pesanan -->
    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="stat-label">Total Pesanan</p>
                    <h2 class="stat-value">{{ number_format($stats['total_pesanan']) }}</h2>
                </div>
                <div class="stat-icon">
                    <span class="material-icons">receipt_long</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Pendapatan -->
    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p class="stat-label">Total Pendapatan</p>
                    <h2 class="stat-value">Rp {{ number_format($stats['total_pendapatan'], 0, ',', '.') }}</h2>
                </div>
                <div class="stat-icon">
                    <span class="material-icons">payments</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Alert Info -->
<div class="row g-4 mb-4">
    @if($stats['pesanan_baru'] > 0)
        <div class="col-md-6">
            <div class="alert alert-warning d-flex align-items-center">
                <span class="material-icons me-3" style="font-size: 36px;">notifications_active</span>
                <div>
                    <h6 class="fw-bold mb-1">Pesanan Baru</h6>
                    <p class="mb-0">Ada <strong>{{ $stats['pesanan_baru'] }}</strong> pesanan menunggu pembayaran</p>
                </div>
                <a href="{{ route('admin.pesanan.index', ['status' => 'menunggu_pembayaran']) }}" class="btn btn-warning ms-auto">
                    Lihat Pesanan
                </a>
            </div>
        </div>
    @endif

    @if($stats['pesan_belum_dibaca'] > 0)
        <div class="col-md-6">
            <div class="alert alert-info d-flex align-items-center">
                <span class="material-icons me-3" style="font-size: 36px;">mail</span>
                <div>
                    <h6 class="fw-bold mb-1">Pesan Kontak Baru</h6>
                    <p class="mb-0">Ada <strong>{{ $stats['pesan_belum_dibaca'] }}</strong> pesan belum dibaca</p>
                </div>
                <a href="{{ route('admin.pesan.index') }}" class="btn btn-info ms-auto">
                    Lihat Pesan
                </a>
            </div>
        </div>
    @endif
</div>

<div class="row g-4">
    <!-- Pesanan Terbaru -->
    <div class="col-md-7">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0">
                    <span class="material-icons align-middle me-2">receipt_long</span>
                    Pesanan Terbaru
                </h5>
                <a href="{{ route('admin.pesanan.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                @if($pesanan_terbaru->isEmpty())
                    <div class="text-center py-5">
                        <span class="material-icons mb-2" style="font-size: 64px; color: #BDBDBD;">receipt_long</span>
                        <p class="text-muted">Belum ada pesanan</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>No. Pesanan</th>
                                    <th>Customer</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pesanan_terbaru as $pesanan)
                                    <tr>
                                        <td class="fw-500">{{ $pesanan->nomor_pesanan }}</td>
                                        <td>{{ $pesanan->user->name }}</td>
                                        <td class="fw-bold">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                                        <td>
                                            @if($pesanan->status === 'menunggu_pembayaran')
                                                <span class="badge bg-warning text-dark">Menunggu Pembayaran</span>
                                            @elseif($pesanan->status === 'dibayar')
                                                <span class="badge bg-info">Dibayar</span>
                                            @elseif($pesanan->status === 'diproses')
                                                <span class="badge bg-primary">Diproses</span>
                                            @elseif($pesanan->status === 'dikirim')
                                                <span class="badge bg-info">Dikirim</span>
                                            @elseif($pesanan->status === 'selesai')
                                                <span class="badge bg-success">Selesai</span>
                                            @elseif($pesanan->status === 'dibatalkan')
                                                <span class="badge bg-danger">Dibatalkan</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.pesanan.show', $pesanan) }}" class="btn btn-sm btn-outline-primary">
                                                <span class="material-icons" style="font-size: 16px;">visibility</span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Buku Terlaris -->
    <div class="col-md-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0">
                    <span class="material-icons align-middle me-2">trending_up</span>
                    Buku Terlaris
                </h5>
                <a href="{{ route('admin.buku.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
            </div>
            <div class="card-body">
                @if($buku_terlaris->isEmpty())
                    <div class="text-center py-4">
                        <span class="material-icons mb-2" style="font-size: 64px; color: #BDBDBD;">menu_book</span>
                        <p class="text-muted">Belum ada data</p>
                    </div>
                @else
                    @foreach($buku_terlaris as $buku)
                        <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
                            @if($buku->gambar_cover)
                                <img src="{{ asset('storage/' . $buku->gambar_cover) }}"
                                     alt="{{ $buku->judul }}"
                                     class="rounded me-3"
                                     style="width: 60px; height: 80px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center"
                                     style="width: 60px; height: 80px;">
                                    <span class="material-icons" style="color: #BDBDBD;">menu_book</span>
                                </div>
                            @endif
                            <div style="flex: 1;">
                                <h6 class="fw-bold mb-1">{{ Str::limit($buku->judul, 40) }}</h6>
                                <p class="text-muted small mb-1">{{ $buku->penulis }}</p>
                                <span class="badge bg-primary">Terjual: {{ $buku->terjual }}</span>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
