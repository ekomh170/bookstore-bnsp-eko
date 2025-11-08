@extends('layouts.app')

@section('title', 'Katalog Buku')

@section('content')
<!-- Page Header -->
<div class="page-header mb-4">
    <div class="container">
        <h1 class="fw-light">
            <span class="material-icons align-middle me-3" style="font-size: 48px;">library_books</span>
            Katalog Buku
        </h1>
        <p class="lead mb-0 mt-2">Temukan buku favorit Anda</p>
    </div>
</div>

<div class="row">
    <!-- Sidebar Filter -->
    <div class="col-md-3">
        <div class="card mb-4">
            <div class="card-header bg-white">
                <h6 class="mb-0 fw-bold">
                    <span class="material-icons align-middle me-2" style="font-size: 20px;">filter_list</span>
                    Filter & Pencarian
                </h6>
            </div>
            <div class="card-body">
                <form action="{{ route('buku.index') }}" method="GET">
                    <!-- Search -->
                    <div class="mb-4">
                        <label class="form-label fw-500">Cari Buku</label>
                        <input type="text" 
                               name="search" 
                               class="form-control" 
                               placeholder="Judul atau penulis..."
                               value="{{ request('search') }}">
                    </div>

                    <!-- Kategori -->
                    <div class="mb-4">
                        <label class="form-label fw-500">Kategori</label>
                        <select name="kategori" class="form-select">
                            <option value="">Semua Kategori</option>
                            @foreach($kategori as $kat)
                                <option value="{{ $kat->id }}" {{ request('kategori') == $kat->id ? 'selected' : '' }}>
                                    {{ $kat->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Sorting -->
                    <div class="mb-4">
                        <label class="form-label fw-500">Urutkan</label>
                        <select name="sort" class="form-select">
                            <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                            <option value="terlaris" {{ request('sort') == 'terlaris' ? 'selected' : '' }}>Terlaris</option>
                            <option value="termurah" {{ request('sort') == 'termurah' ? 'selected' : '' }}>Termurah</option>
                            <option value="termahal" {{ request('sort') == 'termahal' ? 'selected' : '' }}>Termahal</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <span class="material-icons align-middle me-2" style="font-size: 18px;">search</span>
                        Terapkan Filter
                    </button>

                    @if(request()->hasAny(['search', 'kategori', 'sort']))
                        <a href="{{ route('buku.index') }}" class="btn btn-outline-secondary w-100 mt-2">
                            Reset Filter
                        </a>
                    @endif
                </form>
            </div>
        </div>
    </div>

    <!-- Book List -->
    <div class="col-md-9">
        @if($buku->count() > 0)
            <div class="d-flex justify-content-between align-items-center mb-4">
                <p class="text-muted mb-0">Menampilkan {{ $buku->count() }} dari {{ $buku->total() }} buku</p>
            </div>

            <div class="row g-4">
                @foreach($buku as $b)
                    <div class="col-md-4">
                        @include('components.book-card', ['buku' => $b])
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-5">
                {{ $buku->links() }}
            </div>
        @else
            <div class="card">
                <div class="card-body text-center py-5">
                    <span class="material-icons mb-3" style="font-size: 64px; color: #BDBDBD;">search_off</span>
                    <h5 class="fw-bold mb-2">Buku Tidak Ditemukan</h5>
                    <p class="text-muted mb-4">Maaf, kami tidak menemukan buku yang Anda cari.</p>
                    <a href="{{ route('buku.index') }}" class="btn btn-primary">
                        Lihat Semua Buku
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
