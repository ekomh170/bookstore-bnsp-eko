@extends('layouts.admin')

@section('title', 'Edit Kategori')
@section('page-title', 'Edit Kategori Buku')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.kategori.index') }}" class="btn btn-outline-secondary">
        <span class="material-icons align-middle me-2" style="font-size: 18px;">arrow_back</span>
        Kembali
    </a>
</div>

<div class="card">
    <div class="card-header bg-white">
        <h5 class="mb-0 fw-bold">Form Edit Kategori</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.kategori.update', $kategori) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nama_kategori" class="form-label fw-500">Nama Kategori <span class="text-danger">*</span></label>
                <input type="text"
                       class="form-control @error('nama_kategori') is-invalid @enderror"
                       id="nama_kategori"
                       name="nama_kategori"
                       value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                       required
                       autofocus>
                @error('nama_kategori')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="deskripsi" class="form-label fw-500">Deskripsi</label>
                <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                          id="deskripsi"
                          name="deskripsi"
                          rows="4">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.kategori.index') }}" class="btn btn-outline-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">
                    <span class="material-icons align-middle me-2" style="font-size: 18px;">save</span>
                    Update Kategori
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
