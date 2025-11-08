<a href="{{ route('buku.show', $buku->slug) }}" class="text-decoration-none">
    <div class="card h-100">
        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 250px;">
            @if($buku->gambar)
                <img src="{{ asset('storage/' . $buku->gambar) }}"
                     alt="{{ $buku->judul }}"
                     class="img-fluid"
                     style="max-height: 100%; object-fit: contain;">
            @else
                <span class="material-icons" style="font-size: 96px; color: #BDBDBD;">menu_book</span>
            @endif
        </div>
        <div class="card-body d-flex flex-column">
            <span class="badge bg-primary mb-2 align-self-start">{{ $buku->kategori->nama_kategori }}</span>
            <h6 class="fw-bold mb-2" style="min-height: 48px;">{{ Str::limit($buku->judul, 50) }}</h6>
            <p class="text-muted small mb-2">{{ $buku->penulis }}</p>
            <div class="mt-auto">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5 class="fw-bold mb-0" style="color: var(--primary-color);">Rp {{ number_format($buku->harga, 0, ',', '.') }}</h5>
                    @if($buku->stok > 0)
                        <span class="badge bg-success">Tersedia</span>
                    @else
                        <span class="badge bg-danger">Habis</span>
                    @endif
                </div>
                @if($buku->terjual > 0)
                    <small class="text-muted">
                        <span class="material-icons align-middle" style="font-size: 14px;">shopping_cart</span>
                        Terjual {{ $buku->terjual }}
                    </small>
                @endif
            </div>
        </div>
        @auth
            @if(!auth()->user()->isAdmin() && $buku->isTersedia())
            <div class="card-footer bg-white border-top-0">
                <form action="{{ route('keranjang.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="buku_id" value="{{ $buku->id }}">
                    <input type="hidden" name="jumlah" value="1">
                    <button type="submit" class="btn btn-primary w-100">
                        <span class="material-icons align-middle" style="font-size: 18px;">add_shopping_cart</span>
                        Tambah ke Keranjang
                    </button>
                </form>
            </div>
            @endif
        @endauth
    </div>
</a>
