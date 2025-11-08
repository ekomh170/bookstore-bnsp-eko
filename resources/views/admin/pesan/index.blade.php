@extends('layouts.admin')

@section('title', 'Pesan Kontak')
@section('page-title', 'Pesan Kontak')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Pesan Kontak dari Customer</h4>
    @if($belum_dibaca > 0)
        <span class="badge bg-danger px-3 py-2">{{ $belum_dibaca }} Belum Dibaca</span>
    @endif
</div>

<!-- Filter -->
<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('admin.pesan.index') }}" method="GET">
            <div class="row g-3">
                <div class="col-md-10">
                    <select name="sudah_dibaca" class="form-select">
                        <option value="">Semua Pesan</option>
                        <option value="0" {{ request('sudah_dibaca') === '0' ? 'selected' : '' }}>Belum Dibaca</option>
                        <option value="1" {{ request('sudah_dibaca') === '1' ? 'selected' : '' }}>Sudah Dibaca</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100">Filter</button>
                        <a href="{{ route('admin.pesan.index') }}" class="btn btn-outline-secondary">Reset</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Table Pesan -->
<div class="card">
    <div class="card-body">
        @if($pesan->isEmpty())
            <div class="text-center py-5">
                <span class="material-icons mb-3" style="font-size: 96px; color: #BDBDBD;">mail</span>
                <h5 class="fw-bold mb-2">Belum Ada Pesan</h5>
                <p class="text-muted">Belum ada pesan kontak yang masuk</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="3%"></th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Subjek</th>
                            <th>Pesan</th>
                            <th>Tanggal</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pesan as $index => $p)
                            <tr class="{{ !$p->sudah_dibaca ? 'table-warning' : '' }}">
                                <td>{{ $pesan->firstItem() + $index }}</td>
                                <td>
                                    @if(!$p->sudah_dibaca)
                                        <span class="material-icons text-warning" style="font-size: 18px;">fiber_manual_record</span>
                                    @endif
                                </td>
                                <td class="fw-bold">{{ $p->nama }}</td>
                                <td>{{ $p->email }}</td>
                                <td>{{ $p->subjek }}</td>
                                <td>{{ Str::limit($p->pesan, 50) }}</td>
                                <td>{{ $p->created_at->format('d M Y, H:i') }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.pesan.show', $p) }}"
                                           class="btn btn-sm btn-outline-primary"
                                           title="Baca">
                                            <span class="material-icons" style="font-size: 16px;">visibility</span>
                                        </a>
                                        <form action="{{ route('admin.pesan.destroy', $p) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus pesan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger"
                                                    title="Hapus">
                                                <span class="material-icons" style="font-size: 16px;">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-3">
                {{ $pesan->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
