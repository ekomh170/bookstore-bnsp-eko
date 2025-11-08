@extends('layouts.admin')

@section('title', 'Detail User')
@section('page-title', 'Detail User')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.user.index') }}" class="btn btn-outline-secondary">
        <span class="material-icons align-middle me-2" style="font-size: 18px;">arrow_back</span>
        Kembali
    </a>
</div>

<div class="row g-4">
    <!-- Info User -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0 fw-bold">Informasi User</h5>
            </div>
            <div class="card-body">
                <div class="text-center mb-4">
                    <span class="material-icons" style="font-size: 96px; color: var(--primary-color);">account_circle</span>
                </div>
                <table class="table table-borderless">
                    <tr>
                        <th>Nama</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>Telepon</th>
                        <td>{{ $user->telepon ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $user->alamat ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Terdaftar</th>
                        <td>{{ $user->created_at->format('d M Y, H:i') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- Riwayat Pesanan -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0 fw-bold">Riwayat Pesanan (10 Terbaru)</h5>
            </div>
            <div class="card-body">
                @if($user->pesanan->isEmpty())
                    <div class="text-center py-5">
                        <span class="material-icons mb-3" style="font-size: 64px; color: #BDBDBD;">receipt_long</span>
                        <p class="text-muted">Belum ada pesanan</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No. Pesanan</th>
                                    <th>Tanggal</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user->pesanan as $pesanan)
                                    <tr>
                                        <td class="fw-500">{{ $pesanan->nomor_pesanan }}</td>
                                        <td>{{ $pesanan->created_at->format('d M Y') }}</td>
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
</div>
@endsection
