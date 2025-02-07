@extends('backend.v1.templates.index')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Menampilkan Harga Masakan</h4>
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <a href="{{ route('masakan.create') }}" class="btn btn-primary mb-2">
                    <i class="fas fa-plus"></i> Tambah Harga Masakan
                </a>
                <div class="d-flex flex-wrap gap-2">
                    <!-- Form Pencarian -->
                    <form action="{{ route('masakan.index') }}" method="GET" class="form-inline">
                        <input type="hidden" name="status" value="{{ request('status') }}">
                        <input type="hidden" name="per_page" value="{{ request('per_page') }}">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control"
                                placeholder="Cari Nama Harga Masakan..." value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary" type="submit">
                                    <i class="fas fa-search">Pencarian</i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <!-- Entries Per Page -->
                    <form method="GET" action="{{ route('masakan.index') }}" class="form-inline">
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
                        href="{{ route('masakan.index', request()->except('status')) }}">
                        Semua
                    </a>
                </li>
            </ul>
            <div class="table-responsive p-3">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama masakan</th>
                            <th>Jenis masakan</th>
                            <th>Satuan Harga</th>
                            <th>Jumlah Satuan</th>
                            <th>Total Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($masakans as $masakan)
                            <tr>
                                <td>{{ $loop->iteration + ($masakans->currentPage() - 1) * $masakans->perPage() }}</td>
                                <td>{{ $masakan->menu->nama_masakan }}</td>
                                <td>{{ $masakan->menu->jenis_masakan . '-' . $masakan->menu->satuan }}</td>
                                <td>{{ $masakan->satuan_harga }}</td>
                                <td>{{ $masakan->jumlah_satuan }}</td>
                                <td>{{ $masakan->total_harga }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('masakan.edit', $masakan->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit">Edit</i>
                                        </a>
                                        <form action="{{ route('masakan.destroy', $masakan->id) }}" method="POST">
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
                    Menampilkan {{ $masakans->firstItem() }} sampai {{ $masakans->lastItem() }} dari {{ $masakans->total() }}
                    entri
                </div>
                <nav>
                    {{ $masakans->appends(request()->query())->links('pagination::bootstrap-5') }}
                </nav>
            </div>
        </div>
    </div>
@endsection
