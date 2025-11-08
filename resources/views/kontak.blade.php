@extends('layouts.app')

@section('title', 'Hubungi Kami')

@section('content')
<!-- Page Header -->
<div class="page-header mb-5">
    <div class="container">
        <h1 class="fw-light">
            <span class="material-icons align-middle me-3" style="font-size: 48px;">contact_mail</span>
            Hubungi Kami
        </h1>
        <p class="lead mb-0 mt-2">Punya pertanyaan? Kirim pesan kepada kami</p>
    </div>
</div>

<div class="row g-5">
    <!-- Form Kontak -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0 fw-bold">
                    <span class="material-icons align-middle me-2">mail</span>
                    Kirim Pesan
                </h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('kontak.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="nama" class="form-label fw-500">Nama Lengkap</label>
                        <input type="text"
                               class="form-control @error('nama') is-invalid @enderror"
                               id="nama"
                               name="nama"
                               value="{{ old('nama', auth()->user()->name ?? '') }}"
                               required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="form-label fw-500">Email</label>
                        <input type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               id="email"
                               name="email"
                               value="{{ old('email', auth()->user()->email ?? '') }}"
                               required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="subjek" class="form-label fw-500">Subjek</label>
                        <input type="text"
                               class="form-control @error('subjek') is-invalid @enderror"
                               id="subjek"
                               name="subjek"
                               value="{{ old('subjek') }}"
                               placeholder="Contoh: Pertanyaan tentang pesanan"
                               required>
                        @error('subjek')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="pesan" class="form-label fw-500">Pesan</label>
                        <textarea class="form-control @error('pesan') is-invalid @enderror"
                                  id="pesan"
                                  name="pesan"
                                  rows="6"
                                  placeholder="Tulis pesan Anda di sini..."
                                  required>{{ old('pesan') }}</textarea>
                        @error('pesan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-100">
                        <span class="material-icons align-middle me-2" style="font-size: 18px;">send</span>
                        Kirim Pesan
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Info Kontak -->
    <div class="col-md-4">
        <div class="card mb-4 border-0" style="background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));">
            <div class="card-body p-4 text-white">
                <h5 class="fw-bold mb-4">
                    <span class="material-icons align-middle me-2">info</span>
                    Informasi Kontak
                </h5>

                <div class="mb-4 d-flex">
                    <span class="material-icons me-3">email</span>
                    <div>
                        <h6 class="fw-bold mb-1">Email</h6>
                        <p class="mb-0 small">ekomh13@gmail.com</p>
                    </div>
                </div>

                <div class="mb-4 d-flex">
                    <span class="material-icons me-3">phone</span>
                    <div>
                        <h6 class="fw-bold mb-1">Telepon</h6>
                        <p class="mb-0 small">+62 822-4610-5463</p>
                    </div>
                </div>

                <div class="mb-4 d-flex">
                    <span class="material-icons me-3">location_on</span>
                    <div>
                        <h6 class="fw-bold mb-1">Alamat</h6>
                        <p class="mb-0 small">Bogor, Indonesia</p>
                    </div>
                </div>

                <div class="d-flex">
                    <span class="material-icons me-3">schedule</span>
                    <div>
                        <h6 class="fw-bold mb-1">Jam Operasional</h6>
                        <p class="mb-0 small">Senin - Jumat: 09:00 - 17:00<br>Sabtu: 09:00 - 13:00</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body p-4 text-center">
                <span class="material-icons mb-3" style="font-size: 48px; color: var(--primary-color);">support_agent</span>
                <h5 class="fw-bold mb-3">Butuh Bantuan?</h5>
                <p class="text-muted mb-3">Tim customer service kami siap membantu Anda</p>
                <div class="d-grid gap-2">
                    <a href="https://wa.me/6282246105463" target="_blank" class="btn btn-success">
                        <span class="material-icons align-middle me-2" style="font-size: 18px;">chat</span>
                        Chat WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- FAQ Section -->
<div class="mt-5">
    <h3 class="fw-bold mb-4 text-center">
        <span class="material-icons align-middle me-2" style="color: var(--primary-color);">help_outline</span>
        Pertanyaan Umum (FAQ)
    </h3>

    <div class="accordion" id="faqAccordion">
        <div class="accordion-item">
            <h2 class="accordion-header" id="faq1">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1">
                    Bagaimana cara memesan buku?
                </button>
            </h2>
            <div id="collapse1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Anda dapat menelusuri katalog buku kami, menambahkan buku ke keranjang, dan melanjutkan ke checkout untuk menyelesaikan pemesanan.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="faq2">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2">
                    Metode pembayaran apa yang tersedia?
                </button>
            </h2>
            <div id="collapse2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Kami menerima pembayaran melalui Transfer Bank, E-Wallet, dan COD (Cash on Delivery).
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="faq3">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3">
                    Berapa lama waktu pengiriman?
                </button>
            </h2>
            <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Waktu pengiriman bervariasi tergantung lokasi. Umumnya 2-5 hari kerja untuk Jawa dan 5-7 hari kerja untuk luar Jawa.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="faq4">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4">
                    Apakah bisa retur atau tukar buku?
                </button>
            </h2>
            <div id="collapse4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Ya, kami menerima retur dalam waktu 7 hari jika buku rusak atau tidak sesuai pesanan. Silakan hubungi customer service kami.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
