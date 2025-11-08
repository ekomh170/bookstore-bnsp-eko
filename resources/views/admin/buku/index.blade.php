@extends('layouts.admin')

@section('title', 'Data Buku')
@section('page-title', 'Data Buku')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Kelola Data Buku</h4>
    <a href="{{ route('admin.buku.create') }}" class="btn btn-primary">
        <span class="material-icons align-middle me-2" style="font-size: 18px;">add</span>
        Tambah Buku
    </a>
</div>

<!-- Filter & Search -->
<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('admin.buku.index') }}" method="GET">
            <div class="row g-3">
                <div class="col-md-4">
                    <input type="text"
                           name="search"
                           class="form-control"
                           placeholder="Cari judul atau penulis..."
                           value="{{ request('search') }}">
                </div>
                <div class="col-md-4">
                    <select name="kategori_id" class="form-select">
                        <option value="">Semua Kategori</option>
                        @foreach($kategori as $kat)
                            <option value="{{ $kat->id }}" {{ request('kategori_id') == $kat->id ? 'selected' : '' }}>
                                {{ $kat->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <span class="material-icons align-middle" style="font-size: 18px;">search</span>
                        </button>
                        <a href="{{ route('admin.buku.index') }}" class="btn btn-outline-secondary">Reset</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Table Buku -->
<div class="card">
    <div class="card-body">
        @if($buku->isEmpty())
            <div class="text-center py-5">
                <span class="material-icons mb-3" style="font-size: 96px; color: #BDBDBD;">menu_book</span>
                <h5 class="fw-bold mb-2">Belum Ada Buku</h5>
                <p class="text-muted mb-4">Silakan tambahkan buku terlebih dahulu</p>
                <a href="{{ route('admin.buku.create') }}" class="btn btn-primary">
                    <span class="material-icons align-middle me-2" style="font-size: 18px;">add</span>
                    Tambah Buku
                </a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>Cover</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Penulis</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($buku as $index => $b)
                            <tr>
                                <td>{{ $buku->firstItem() + $index }}</td>
                                <td>
                                    @if($b->gambar)
                                        <img src="{{ asset('storage/' . $b->gambar) }}"
                                             alt="{{ $b->judul }}"
                                             class="rounded"
                                             style="width: 50px; height: 70px; object-fit: cover;">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                             style="width: 50px; height: 70px;">
                                            <span class="material-icons" style="color: #BDBDBD;">menu_book</span>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div class="fw-bold">{{ Str::limit($b->judul, 40) }}</div>
                                    <small class="text-muted">ISBN: {{ $b->isbn }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-primary">{{ $b->kategori->nama_kategori }}</span>
                                </td>
                                <td>{{ $b->penulis }}</td>
                                <td class="fw-bold">Rp {{ number_format($b->harga, 0, ',', '.') }}</td>
                                <td>
                                    <span class="badge {{ $b->stok > 10 ? 'bg-success' : ($b->stok > 0 ? 'bg-warning' : 'bg-danger') }}">
                                        {{ $b->stok }}
                                    </span>
                                </td>
                                <td>
                                    @if($b->is_active)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.buku.show', $b) }}"
                                           class="btn btn-sm btn-outline-info"
                                           title="Detail">
                                            <span class="material-icons" style="font-size: 16px;">visibility</span>
                                        </a>
                                        <a href="{{ route('admin.buku.edit', $b) }}"
                                           class="btn btn-sm btn-outline-primary"
                                           title="Edit">
                                            <span class="material-icons" style="font-size: 16px;">edit</span>
                                        </a>
                                        <form action="{{ route('admin.buku.destroy', $b) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger"
                                                    title="Hapus">
                                                <span class="material-icons" style="font-size: 16px;">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-3">
                {{ $buku->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
