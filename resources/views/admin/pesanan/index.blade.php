@extends('layouts.admin')

@section('title', 'Data Pesanan')
@section('page-title', 'Data Pesanan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Kelola Pesanan</h4>
</div>

<!-- Filter & Search -->
<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('admin.pesanan.index') }}" method="GET">
            <div class="row g-3">
                <div class="col-md-5">
                    <input type="text"
                           name="search"
                           class="form-control"
                           placeholder="Cari nomor pesanan atau nama customer..."
                           value="{{ request('search') }}">
                </div>
                <div class="col-md-5">
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="menunggu_pembayaran" {{ request('status') === 'menunggu_pembayaran' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                        <option value="dibayar" {{ request('status') === 'dibayar' ? 'selected' : '' }}>Dibayar</option>
                        <option value="diproses" {{ request('status') === 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="dikirim" {{ request('status') === 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                        <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="dibatalkan" {{ request('status') === 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <span class="material-icons align-middle" style="font-size: 18px;">search</span>
                        </button>
                        <a href="{{ route('admin.pesanan.index') }}" class="btn btn-outline-secondary">Reset</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Table Pesanan -->
<div class="card">
    <div class="card-body">
        @if($pesanan->isEmpty())
            <div class="text-center py-5">
                <span class="material-icons mb-3" style="font-size: 96px; color: #BDBDBD;">receipt_long</span>
                <h5 class="fw-bold mb-2">Belum Ada Pesanan</h5>
                <p class="text-muted">Belum ada pesanan yang masuk</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>No. Pesanan</th>
                            <th>Customer</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pesanan as $index => $p)
                            <tr>
                                <td>{{ $pesanan->firstItem() + $index }}</td>
                                <td class="fw-500">{{ $p->nomor_pesanan }}</td>
                                <td>{{ $p->user->name }}</td>
                                <td>{{ $p->created_at->format('d M Y, H:i') }}</td>
                                <td class="fw-bold">Rp {{ number_format($p->total_harga, 0, ',', '.') }}</td>
                                <td>
                                    @if($p->status === 'menunggu_pembayaran')
                                        <span class="badge bg-warning text-dark">Menunggu Pembayaran</span>
                                    @elseif($p->status === 'dibayar')
                                        <span class="badge bg-info">Dibayar</span>
                                    @elseif($p->status === 'diproses')
                                        <span class="badge bg-primary">Diproses</span>
                                    @elseif($p->status === 'dikirim')
                                        <span class="badge bg-info">Dikirim</span>
                                    @elseif($p->status === 'selesai')
                                        <span class="badge bg-success">Selesai</span>
                                    @elseif($p->status === 'dibatalkan')
                                        <span class="badge bg-danger">Dibatalkan</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.pesanan.show', $p) }}"
                                       class="btn btn-sm btn-outline-primary"
                                       title="Detail">
                                        <span class="material-icons" style="font-size: 16px;">visibility</span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-3">
                {{ $pesanan->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
