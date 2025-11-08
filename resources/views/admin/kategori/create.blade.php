@extends('layouts.admin')

@section('title', 'Tambah Kategori')
@section('page-title', 'Tambah Kategori Buku')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.kategori.index') }}" class="btn btn-outline-secondary">
        <span class="material-icons align-middle me-2" style="font-size: 18px;">arrow_back</span>
        Kembali
    </a>
</div>

<div class="card">
    <div class="card-header bg-white">
        <h5 class="mb-0 fw-bold">Form Tambah Kategori</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.kategori.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="nama_kategori" class="form-label fw-500">Nama Kategori <span class="text-danger">*</span></label>
                <input type="text" 
                       class="form-control @error('nama_kategori') is-invalid @enderror" 
                       id="nama_kategori" 
                       name="nama_kategori" 
                       value="{{ old('nama_kategori') }}"
                       required
                       autofocus>
                @error('nama_kategori')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Slug akan dibuat otomatis dari nama kategori</small>
            </div>

            <div class="mb-4">
                <label for="deskripsi" class="form-label fw-500">Deskripsi</label>
                <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                          id="deskripsi" 
                          name="deskripsi" 
                          rows="4">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.kategori.index') }}" class="btn btn-outline-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">
                    <span class="material-icons align-middle me-2" style="font-size: 18px;">save</span>
                    Simpan Kategori
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
