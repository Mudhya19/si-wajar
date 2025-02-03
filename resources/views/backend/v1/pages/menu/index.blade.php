@extends('backend.v1.templates.index')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Menampilkan Menu</h4>
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <a href="{{ route('menu.create') }}" class="btn btn-primary mb-2">
                    <i class="fas fa-plus"></i> Tambah Menu
                </a>
                <div class="d-flex flex-wrap gap-2">
                    <!-- Form Pencarian -->
                    <form action="{{ route('menu.index') }}" method="GET" class="form-inline">
                        <input type="hidden" name="status" value="{{ request('status') }}">
                        <input type="hidden" name="per_page" value="{{ request('per_page') }}">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari Nama Menu..."
                                value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary" type="submit">
                                    <i class="fas fa-search">Pencarian</i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <!-- Entries Per Page -->
                    <form method="GET" action="{{ route('menu.index') }}" class="form-inline">
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        <input type="hidden" name="status" value="{{ request('status') }}">
                        <select name="per_page" class="form-control" onchange="this.form.submit()">
                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 Entries</option>
                            <option value="25" {{ request('per_page', 10) == 25 ? 'selected' : '' }}>25 Entries</option>
                            <option value="50" {{ request('per_page', 10) == 50 ? 'selected' : '' }}>50 Entries
                            </option>
                            <option value="50" {{ request('per_page', 10) == 100 ? 'selected' : '' }}>100 Entries
                            </option>
                        </select>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <!-- Tabs Filter -->
            <ul class="nav nav-tabs mb-4">
                <li class="nav-item">
                    <a class="nav-link {{ !request('status') ? 'active' : '' }}"
                        href="{{ route('menu.index', request()->except('status')) }}">
                        Semua
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request('status') == 'active' ? 'active' : '' }}"
                        href="{{ route('menu.index', array_merge(request()->except('status'), ['status' => 'active'])) }}">
                        Active
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request('status') == 'inactive' ? 'active' : '' }}"
                        href="{{ route('menu.index', array_merge(request()->except('status'), ['status' => 'inactive'])) }}">
                        Inactive
                    </a>
                </li>
            </ul>
            <div class="table-responsive p-3">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Menu</th>
                            <th>Jenis Menu</th>
                            <th>Satuan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($menus as $menu)
                            <tr>
                                <td>{{ $loop->iteration + ($menus->currentPage() - 1) * $menus->perPage() }}</td>
                                <td>{{ $menu->nama_menu }}</td>
                                <td>{{ $menu->jenis_menu }}</td>
                                <td>{{ $menu->satuan }}</td>
                                <td>
                                    {{-- <span class="badge badge-{{ $menu->status == 'active' ? 'success' : 'danger' }}"> --}}
                                    {{ $menu->status }}
                                    {{-- </span> --}}
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('menu.edit', $menu->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit">Edit</i>
                                        </a>
                                        <form action="{{ route('menu.destroy', $menu->id) }}" method="POST">
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
                    Menampilkan {{ $menus->firstItem() }} sampai {{ $menus->lastItem() }} dari {{ $menus->total() }}
                    entri
                </div>
                <nav>
                    {{ $menus->appends(request()->query())->links('pagination::bootstrap-5') }}
                </nav>
            </div>
        </div>
    </div>
@endsection
