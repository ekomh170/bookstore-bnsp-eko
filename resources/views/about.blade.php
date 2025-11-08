@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')
<!-- Page Header -->
<div class="page-header mb-5">
    <div class="container">
        <h1 class="fw-light">
            <span class="material-icons align-middle me-3" style="font-size: 48px;">info</span>
            Tentang Kami
        </h1>
        <p class="lead mb-0 mt-2">Mengenal Bookstore Eko Haryono lebih dekat</p>
    </div>
</div>

<div class="row g-5">
    <!-- Profile -->
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-body p-4">
                <h3 class="fw-bold mb-4">Sejarah Bookstore Eko Haryono</h3>
                <p class="text-muted" style="text-align: justify;">
                    Bookstore Eko Haryono adalah platform e-commerce toko buku online yang didirikan dengan misi untuk menyediakan akses mudah ke berbagai koleksi buku berkualitas bagi masyarakat Indonesia. Dengan koleksi lengkap dari berbagai kategori, kami berkomitmen untuk menjadi partner terpercaya dalam memenuhi kebutuhan literasi Anda.
                </p>
                <p class="text-muted" style="text-align: justify;">
                    Aplikasi ini dikembangkan sebagai bagian dari proyek sertifikasi BNSP (Badan Nasional Sertifikasi Profesi) bidang Full Stack Web Development, menerapkan best practices dalam pengembangan aplikasi web modern menggunakan Laravel Framework dengan prinsip Material Design dari Google.
                </p>
            </div>
        </div>

        <div class="card">
            <div class="card-body p-4">
                <h3 class="fw-bold mb-4">Visi & Misi</h3>

                <h5 class="fw-bold text-primary mb-3">Visi</h5>
                <p class="text-muted mb-4">
                    Menjadi toko buku online terdepan di Indonesia yang memberikan pengalaman berbelanja buku terbaik dengan koleksi lengkap dan harga terjangkau.
                </p>

                <h5 class="fw-bold text-primary mb-3">Misi</h5>
                <ul class="text-muted">
                    <li class="mb-2">Menyediakan koleksi buku berkualitas dari berbagai kategori</li>
                    <li class="mb-2">Memberikan kemudahan akses ke buku dengan platform digital yang user-friendly</li>
                    <li class="mb-2">Menghadirkan pengalaman berbelanja yang aman, nyaman, dan terpercaya</li>
                    <li class="mb-2">Mendukung budaya literasi dan membaca di Indonesia</li>
                    <li class="mb-2">Memberikan pelayanan pelanggan terbaik dengan sistem payment at delivery</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Features -->
    <div class="col-md-4">
        <div class="card mb-4 border-0" style="background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));">
            <div class="card-body p-4 text-white">
                <h5 class="fw-bold mb-4">Kenapa Memilih Kami?</h5>

                <div class="mb-3 d-flex">
                    <span class="material-icons me-3">verified</span>
                    <div>
                        <h6 class="fw-bold mb-1">Produk Original</h6>
                        <small>Semua buku dijamin 100% original</small>
                    </div>
                </div>

                <div class="mb-3 d-flex">
                    <span class="material-icons me-3">local_shipping</span>
                    <div>
                        <h6 class="fw-bold mb-1">Pengiriman Cepat</h6>
                        <small>Pengiriman ke seluruh Indonesia</small>
                    </div>
                </div>

                <div class="mb-3 d-flex">
                    <span class="material-icons me-3">payments</span>
                    <div>
                        <h6 class="fw-bold mb-1">Payment at Delivery</h6>
                        <small>Bayar setelah barang diterima</small>
                    </div>
                </div>

                <div class="d-flex">
                    <span class="material-icons me-3">support_agent</span>
                    <div>
                        <h6 class="fw-bold mb-1">Customer Support</h6>
                        <small>Tim support siap membantu Anda</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body p-4 text-center">
                <span class="material-icons mb-3" style="font-size: 48px; color: var(--primary-color);">contact_mail</span>
                <h5 class="fw-bold mb-3">Hubungi Kami</h5>
                <p class="text-muted mb-3">Ada pertanyaan? Jangan ragu untuk menghubungi kami</p>
                <a href="{{ route('kontak') }}" class="btn btn-primary w-100">
                    <span class="material-icons align-middle me-2" style="font-size: 18px;">send</span>
                    Kirim Pesan
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Stats -->
<div class="row g-4 my-5">
    <div class="col-md-3">
        <div class="card border-0 bg-light text-center">
            <div class="card-body p-4">
                <span class="material-icons mb-2" style="font-size: 48px; color: var(--primary-color);">menu_book</span>
                <h3 class="fw-bold mb-0">1000+</h3>
                <p class="text-muted mb-0">Koleksi Buku</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 bg-light text-center">
            <div class="card-body p-4">
                <span class="material-icons mb-2" style="font-size: 48px; color: var(--primary-color);">people</span>
                <h3 class="fw-bold mb-0">5000+</h3>
                <p class="text-muted mb-0">Pelanggan</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 bg-light text-center">
            <div class="card-body p-4">
                <span class="material-icons mb-2" style="font-size: 48px; color: var(--primary-color);">local_shipping</span>
                <h3 class="fw-bold mb-0">10000+</h3>
                <p class="text-muted mb-0">Pesanan Terkirim</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 bg-light text-center">
            <div class="card-body p-4">
                <span class="material-icons mb-2" style="font-size: 48px; color: var(--primary-color);">star</span>
                <h3 class="fw-bold mb-0">4.8/5</h3>
                <p class="text-muted mb-0">Rating Pelanggan</p>
            </div>
        </div>
    </div>
</div>
@endsection
