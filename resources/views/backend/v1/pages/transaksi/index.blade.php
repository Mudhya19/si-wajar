@extends('backend.v1.templates.index')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Menampilkan Transaksi</h4>
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <a href="{{ route('transaksi.create') }}" class="btn btn-primary mb-2">
                    <i class="fas fa-plus"></i> Tambah Transaksi
                </a>
                <div class="d-flex flex-wrap gap-2">
                    <!-- Form Pencarian -->
                    <form action="{{ route('transaksi.index') }}" method="GET" class="form-inline">
                        <input type="hidden" name="status" value="{{ request('status') }}">
                        <input type="hidden" name="per_page" value="{{ request('per_page') }}">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari Nama transaksi..."
                                value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary" type="submit">
                                    <i class="fas fa-search">Pencarian</i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <!-- Entries Per Page -->
                    <form method="GET" action="{{ route('transaksi.index') }}" class="form-inline">
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
                        href="{{ route('transaksi.index', request()->except('status')) }}">
                        Semua
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link {{ request('status') == 'tersedia' ? 'active' : '' }}"
                        href="{{ route('transaksi.index', array_merge(request()->except('status'), ['status' => 'tersedia'])) }}">
                        Active
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request('status') == 'tidak tersedia' ? 'active' : '' }}"
                        href="{{ route('transaksi.index', array_merge(request()->except('status'), ['status' => 'tidak tersedia'])) }}">
                        Inactive
                    </a>
                </li> --}}
            </ul>
            <div class="table-responsive p-3">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>ID transaksi</th>
                            <th>Nama Masakan</th>
                            <th>Total Harga</th>
                            <th>Metode Pembayaran</th>
                            <th>Tanggal Transaksi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transaksis as $transaksi)
                            <tr>
                                <td>{{ $loop->iteration + ($transaksis->currentPage() - 1) * $transaksis->perPage() }}</td>
                                <td>{{ $transaksi->masakan->transaksi_id }}</td>
                                <td>{{ $transaksi->masakan->menu->nama_menu }}</td>
                                <td>{{ $transaksi->total_harga }}</td>
                                <td>{{ $transaksi->metode }}</td>
                                <td>{{ $transaksi->tanggal_transaksi }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('transaksi.edit', $transaksi->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit">Edit</i>
                                        </a>
                                        <form action="{{ route('transaksi.destroy', $transaksi->id) }}" method="POST">
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
                    Menampilkan {{ $transaksis->firstItem() }} sampai {{ $transaksis->lastItem() }} dari {{ $transaksis->total() }}
                    entri
                </div>
                <nav>
                    {{ $transaksis->appends(request()->query())->links('pagination::bootstrap-5') }}
                </nav>
            </div>
        </div>
    </div>
@endsection
