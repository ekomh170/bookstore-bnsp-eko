@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<!-- Hero Section -->
<div class="mb-5">
    <div class="card border-0" style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);">
        <div class="card-body text-white text-center py-5">
            <h1 class="display-4 fw-bold mb-3">Selamat Datang di Bookstore Eko Haryono</h1>
            <p class="lead mb-4">Toko Buku Online Terlengkap & Terpercaya di Indonesia</p>
            <a href="{{ route('buku.index') }}" class="btn btn-light btn-lg px-5">
                <span class="material-icons align-middle me-2">library_books</span>
                Jelajahi Buku
            </a>
        </div>
    </div>
</div>

<!-- Kategori Populer -->
@if($kategori->count() > 0)
<div class="mb-5">
    <h3 class="fw-bold mb-4">
        <span class="material-icons align-middle me-2" style="color: var(--primary-color);">category</span>
        Kategori Populer
    </h3>
    <div class="row g-3">
        @foreach($kategori as $kat)
        <div class="col-md-4">
            <a href="{{ route('buku.index', ['kategori' => $kat->id]) }}" class="text-decoration-none">
                <div class="card h-100 hover-card">
                    <div class="card-body text-center">
                        <span class="material-icons mb-3" style="font-size: 48px; color: var(--primary-color);">menu_book</span>
                        <h5 class="fw-bold mb-2">{{ $kat->nama_kategori }}</h5>
                        <p class="text-muted small mb-2">{{ $kat->deskripsi }}</p>
                        <span class="badge bg-primary">{{ $kat->buku_count }} Buku</span>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endif

<!-- Buku Terbaru -->
@if($buku_terbaru->count() > 0)
<div class="mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">
            <span class="material-icons align-middle me-2" style="color: var(--primary-color);">new_releases</span>
            Buku Terbaru
        </h3>
        <a href="{{ route('buku.index') }}" class="btn btn-outline-primary">
            Lihat Semua
            <span class="material-icons align-middle" style="font-size: 18px;">arrow_forward</span>
        </a>
    </div>
    <div class="row g-4">
        @foreach($buku_terbaru as $buku)
        <div class="col-md-3">
            @include('components.book-card', ['buku' => $buku])
        </div>
        @endforeach
    </div>
</div>
@endif

<!-- Buku Terlaris -->
@if($buku_terlaris->count() > 0)
<div class="mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">
            <span class="material-icons align-middle me-2" style="color: var(--primary-color);">trending_up</span>
            Buku Terlaris
        </h3>
        <a href="{{ route('buku.index', ['sort' => 'terlaris']) }}" class="btn btn-outline-primary">
            Lihat Semua
            <span class="material-icons align-middle" style="font-size: 18px;">arrow_forward</span>
        </a>
    </div>
    <div class="row g-4">
        @foreach($buku_terlaris as $buku)
        <div class="col-md-3">
            @include('components.book-card', ['buku' => $buku])
        </div>
        @endforeach
    </div>
</div>
@endif

<!-- CTA Section -->
<div class="card bg-light border-0">
    <div class="card-body text-center py-5">
        <span class="material-icons mb-3" style="font-size: 64px; color: var(--primary-color);">local_shipping</span>
        <h3 class="fw-bold mb-3">Pengiriman ke Seluruh Indonesia</h3>
        <p class="text-muted mb-4">Kami melayani pengiriman ke seluruh wilayah Indonesia dengan aman dan cepat</p>
        <a href="{{ route('about') }}" class="btn btn-primary btn-lg">
            Pelajari Lebih Lanjut
        </a>
    </div>
</div>

@push('styles')
<style>
    .hover-card {
        transition: all 0.3s ease;
    }
    .hover-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-4) !important;
    }
</style>
@endpush
@endsection
