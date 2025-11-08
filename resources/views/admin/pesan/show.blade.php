@extends('layouts.admin')

@section('title', 'Detail Pesan')
@section('page-title', 'Detail Pesan Kontak')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <a href="{{ route('admin.pesan.index') }}" class="btn btn-outline-secondary">
        <span class="material-icons align-middle me-2" style="font-size: 18px;">arrow_back</span>
        Kembali
    </a>
    <form action="{{ route('admin.pesan.destroy', $pesan) }}" 
          method="POST" 
          class="d-inline"
          onsubmit="return confirm('Yakin ingin menghapus pesan ini?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">
            <span class="material-icons align-middle me-2" style="font-size: 18px;">delete</span>
            Hapus Pesan
        </button>
    </form>
</div>

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">
                        <span class="material-icons align-middle me-2">mail</span>
                        Pesan Kontak
                    </h5>
                    @if($pesan->sudah_dibaca)
                        <span class="badge bg-success">Sudah Dibaca</span>
                    @else
                        <span class="badge bg-warning text-dark">Baru</span>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <!-- Info Pengirim -->
                <div class="mb-4 pb-4 border-bottom">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="text-muted small mb-1">Dari:</p>
                            <p class="fw-bold mb-0">{{ $pesan->nama }}</p>
                            <p class="text-muted small mb-0">{{ $pesan->email }}</p>
                            @if($pesan->user)
                                <a href="{{ route('admin.user.show', $pesan->user) }}" class="btn btn-sm btn-outline-primary mt-2">
                                    Lihat Profil User
                                </a>
                            @else
                                <small class="text-muted">(Bukan user terdaftar)</small>
                            @endif
                        </div>
                        <div class="col-md-6 text-md-end">
                            <p class="text-muted small mb-1">Diterima:</p>
                            <p class="mb-0">{{ $pesan->created_at->format('d F Y') }}</p>
                            <p class="text-muted small mb-0">{{ $pesan->created_at->format('H:i') }} WIB</p>
                        </div>
                    </div>
                </div>

                <!-- Subjek -->
                <div class="mb-4">
                    <p class="text-muted small mb-2">Subjek:</p>
                    <h5 class="fw-bold">{{ $pesan->subjek }}</h5>
                </div>

                <!-- Isi Pesan -->
                <div class="mb-4">
                    <p class="text-muted small mb-2">Pesan:</p>
                    <div class="bg-light p-4 rounded">
                        <p class="mb-0" style="white-space: pre-wrap;">{{ $pesan->pesan }}</p>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="d-flex gap-2">
                    <a href="mailto:{{ $pesan->email }}?subject=Re: {{ $pesan->subjek }}" 
                       class="btn btn-primary">
                        <span class="material-icons align-middle me-2" style="font-size: 18px;">reply</span>
                        Balas via Email
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
