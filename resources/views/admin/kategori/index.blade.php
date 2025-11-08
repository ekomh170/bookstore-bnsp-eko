@extends('layouts.admin')

@section('title', 'Kategori Buku')
@section('page-title', 'Kategori Buku')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Kelola Kategori Buku</h4>
    <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary">
        <span class="material-icons align-middle me-2" style="font-size: 18px;">add</span>
        Tambah Kategori
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if($kategori->isEmpty())
            <div class="text-center py-5">
                <span class="material-icons mb-3" style="font-size: 96px; color: #BDBDBD;">category</span>
                <h5 class="fw-bold mb-2">Belum Ada Kategori</h5>
                <p class="text-muted mb-4">Silakan tambahkan kategori buku terlebih dahulu</p>
                <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary">
                    <span class="material-icons align-middle me-2" style="font-size: 18px;">add</span>
                    Tambah Kategori
                </a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>Nama Kategori</th>
                            <th>Slug</th>
                            <th>Deskripsi</th>
                            <th width="10%" class="text-center">Jumlah Buku</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kategori as $index => $kat)
                            <tr>
                                <td>{{ $kategori->firstItem() + $index }}</td>
                                <td class="fw-bold">{{ $kat->nama_kategori }}</td>
                                <td><code>{{ $kat->slug }}</code></td>
                                <td>{{ Str::limit($kat->deskripsi, 60) }}</td>
                                <td class="text-center">
                                    <span class="badge bg-primary">{{ $kat->buku_count }}</span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.kategori.edit', $kat) }}"
                                           class="btn btn-sm btn-outline-primary"
                                           title="Edit">
                                            <span class="material-icons" style="font-size: 16px;">edit</span>
                                        </a>
                                        <form action="{{ route('admin.kategori.destroy', $kat) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger"
                                                    title="Hapus"
                                                    {{ $kat->buku_count > 0 ? 'disabled' : '' }}>
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
                {{ $kategori->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
