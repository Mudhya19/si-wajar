@extends('backend.v1.templates.index')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Menampilkan Akses Pengguna</h4>
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <a href="{{ route('user.create') }}" class="btn btn-primary mb-2">
                    <i class="fas fa-plus"></i> Tambah Pengguna
                </a>
                <div class="d-flex flex-wrap gap-2">
                    <!-- Form Pencarian -->
                    <form action="{{ route('user.index') }}" method="GET" class="form-inline">
                        <input type="hidden" name="status" value="{{ request('status') }}">
                        <input type="hidden" name="per_page" value="{{ request('per_page') }}">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari Nama user..."
                                value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary" type="submit">
                                    <i class="fas fa-search">Pencarian</i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <!-- Tabs Filter -->
            <ul class="nav nav-tabs mb-4">
                <li class="nav-item">
                    <a class="nav-link {{ !request('status') ? 'active' : '' }}"
                        href="{{ route('user.index', request()->except('status')) }}">
                        Semua
                    </a>
                </li>
            </ul>
            <div class="table-responsive p-3">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Rule Akses</th>
                            <th>Username</th>
                            <th>password</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                                <td>{{ $user->rule }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->password }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit">Edit</i>
                                        </a>
                                        <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                <i class="fas fa-trash">Hapus</i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted">
                    Menampilkan {{ $users->firstItem() }} sampai {{ $users->lastItem() }} dari {{ $users->total() }}
                    entri
                </div>
                <nav>
                    {{ $users->appends(request()->query())->links('pagination::bootstrap-5') }}
                </nav>
            </div>
        </div>
    </div>
@endsection
