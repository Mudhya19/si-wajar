@extends('backend.v1.templates.index')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Menampilkan Masakan</h4>
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
                            <input type="text" name="search" class="form-control" placeholder="Cari Nama masakan..."
                                value="{{ request('search') }}">
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
            <!-- Menampilkan Data Dalam Bentuk Card -->
            <div class="row">
                @forelse ($masakans as $masakan)
                    <div class="col-md-4">
                        <div class="card mb-3">
                            @dd($masakan->all())
                            <img src="{{ asset('uploads/' . $masakan->menu->photo) }}" class="card-img-top"
                                alt="Foto Masakan" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $masakan->menu->nama_masakan }}</h5>
                                <p class="card-text">
                                    Jenis: {{ $masakan->menu->jenis_masakan }} <br>
                                    Satuan: {{ $masakan->menu->satuan }} <br>
                                    Harga Satuan: {{ $masakan->satuan_harga }} <br>
                                    Jumlah: {{ $masakan->jumlah_satuan }} <br>
                                    Total: {{ $masakan->total_harga }}
                                </p>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('masakan.edit', $masakan->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('masakan.destroy', $masakan->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center">Tidak ada data</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted">
                    Menampilkan {{ $masakans->firstItem() }} sampai {{ $masakans->lastItem() }} dari
                    {{ $masakans->total() }}
                    entri
                </div>
                <nav>
                    {{ $masakans->appends(request()->query())->links('pagination::bootstrap-5') }}
                </nav>
            </div>
        </div>
    </div>
@endsection
