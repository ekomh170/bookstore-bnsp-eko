@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="row justify-content-center py-5">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <span class="material-icons" style="font-size: 64px; color: var(--primary-color);">person_add</span>
                    <h3 class="mt-3 fw-bold">Daftar Akun Baru</h3>
                    <p class="text-muted">Buat akun BookStore Anda</p>
                </div>

                <form method="POST" action="{{ route('register.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label fw-500">Nama Lengkap</label>
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               id="name" 
                               name="name" 
                               value="{{ old('name') }}" 
                               required 
                               autofocus
                               placeholder="Masukkan nama lengkap">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-500">Email</label>
                        <input type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               id="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required
                               placeholder="nama@email.com">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="telepon" class="form-label fw-500">Nomor Telepon (Opsional)</label>
                        <input type="text" 
                               class="form-control @error('telepon') is-invalid @enderror" 
                               id="telepon" 
                               name="telepon" 
                               value="{{ old('telepon') }}"
                               placeholder="08123456789">
                        @error('telepon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label fw-500">Alamat (Opsional)</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" 
                                  id="alamat" 
                                  name="alamat" 
                                  rows="2"
                                  placeholder="Alamat lengkap">{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-500">Password</label>
                        <input type="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               id="password" 
                               name="password" 
                               required
                               placeholder="Minimal 8 karakter">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label fw-500">Konfirmasi Password</label>
                        <input type="password" 
                               class="form-control" 
                               id="password_confirmation" 
                               name="password_confirmation" 
                               required
                               placeholder="Ketik ulang password">
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-3 fw-bold">
                        <span class="material-icons align-middle me-2" style="font-size: 20px;">person_add</span>
                        Daftar Sekarang
                    </button>
                </form>

                <hr class="my-4">

                <p class="text-center text-muted mb-0">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" class="text-decoration-none fw-bold" style="color: var(--primary-color);">
                        Login di sini
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
