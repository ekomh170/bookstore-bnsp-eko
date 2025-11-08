@extends('layouts.admin')

@section('title', 'Data User')
@section('page-title', 'Data User')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Kelola Data User</h4>
</div>

<!-- Search -->
<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('admin.user.index') }}" method="GET">
            <div class="row g-3">
                <div class="col-md-10">
                    <input type="text" 
                           name="search" 
                           class="form-control" 
                           placeholder="Cari nama, email, atau telepon..."
                           value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <span class="material-icons align-middle" style="font-size: 18px;">search</span>
                        </button>
                        <a href="{{ route('admin.user.index') }}" class="btn btn-outline-secondary">Reset</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Table User -->
<div class="card">
    <div class="card-body">
        @if($users->isEmpty())
            <div class="text-center py-5">
                <span class="material-icons mb-3" style="font-size: 96px; color: #BDBDBD;">people</span>
                <h5 class="fw-bold mb-2">Belum Ada User</h5>
                <p class="text-muted">Belum ada user yang terdaftar</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th class="text-center">Total Pesanan</th>
                            <th>Terdaftar</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $index => $user)
                            <tr>
                                <td>{{ $users->firstItem() + $index }}</td>
                                <td class="fw-bold">{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->telepon ?? '-' }}</td>
                                <td>{{ Str::limit($user->alamat ?? '-', 40) }}</td>
                                <td class="text-center">
                                    <span class="badge bg-primary">{{ $user->pesanan_count }}</span>
                                </td>
                                <td>{{ $user->created_at->format('d M Y') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.user.show', $user) }}" 
                                       class="btn btn-sm btn-outline-primary"
                                       title="Detail">
                                        <span class="material-icons" style="font-size: 16px;">visibility</span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-3">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
