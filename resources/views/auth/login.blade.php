@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="row justify-content-center py-5">
    <div class="col-md-5">
        <div class="card">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <span class="material-icons" style="font-size: 64px; color: var(--primary-color);">account_circle</span>
                    <h3 class="mt-3 fw-bold">Login</h3>
                    <p class="text-muted">Masuk ke akun BookStore Anda</p>
                </div>

                <form method="POST" action="{{ route('login.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="form-label fw-500">Email</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0">
                                <span class="material-icons">email</span>
                            </span>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   required 
                                   autofocus
                                   placeholder="nama@email.com">
                        </div>
                        @error('email')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label fw-500">Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0">
                                <span class="material-icons">lock</span>
                            </span>
                            <input type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   id="password" 
                                   name="password" 
                                   required
                                   placeholder="Masukkan password">
                        </div>
                        @error('password')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">
                            Ingat saya
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-3 fw-bold">
                        <span class="material-icons align-middle me-2" style="font-size: 20px;">login</span>
                        Masuk
                    </button>
                </form>

                <hr class="my-4">

                <p class="text-center text-muted mb-0">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="text-decoration-none fw-bold" style="color: var(--primary-color);">
                        Daftar Sekarang
                    </a>
                </p>

                <div class="mt-4 p-3 bg-light rounded">
                    <p class="mb-1 small fw-bold">Demo Account:</p>
                    <p class="mb-1 small"><strong>Admin:</strong> admin@bookstore.com / admin123</p>
                    <p class="mb-0 small"><strong>User:</strong> eko@gmail.com / user123</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
