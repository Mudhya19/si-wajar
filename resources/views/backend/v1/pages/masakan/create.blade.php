@extends('backend.v1.templates.index')

@section('content')
    @if ($errors->any())
        <div>
            <div class="alert alert-danger">
                @foreach ($errors->all() as $masakan)
                    <li>{{ $masakan }}</li>
                @endforeach
            </div>
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Tambah Masakan Baru</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('masakan.store') }}" enctype="multipart/form-data">
                @csrf
                <!-- Jenis Menu -->
                <div class="mb-3">
                    <label for="menu_id" class="form-label">Nama Menu Masakan <span class="text-danger">*</span></label>
                    <select class="form-select @error('menu_id') is-invalid @enderror" id="menu_id" name="menu_id"
                        required>
                        <option value="" disabled selected>Pilih Menu yang ada</option>
                        @foreach ($menus as $menu)
                            <option value="{{ $menu->id }}">
                                {{ ucfirst($menu->nama_menu . ' - ' . $menu->jenis_menu) }}
                            </option>
                        @endforeach
                    </select>
                    @error('menu_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- <!-- Satuan Harga -->
                <div class="mb-3">
                    <label for="harga_satuan" class="form-label">Harga Satuan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('harga_satuan') is-invalid @enderror" id="harga_satuan"
                        name="harga_satuan" value="{{ old('harga_satuan') }}" required autofocus>
                    @error('harga_satuan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Jumlah Satuan -->
                <div class="mb-3">
                    <label for="jumlah_satuan" class="form-label">Jumlah Satuan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('jumlah_satuan') is-invalid @enderror"
                        id="jumlah_satuan" name="jumlah_satuan" value="{{ old('jumlah_satuan') }}" required autofocus>
                    @error('jumlah_satuan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Total Harga -->
                <div class="mb-3">
                    <label for="total_harga" class="form-label">Total Harga<span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('total_harga') is-invalid @enderror" id="total_harga"
                        name="total_harga" value="{{ old('total_harga') }}" required autofocus>
                    @error('total_harga')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div> --}}

                <div class="mb-3">
                    <label for="harga_satuan" class="form-label">Harga Satuan (Rp.)<span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('harga_satuan') is-invalid @enderror" id="harga_satuan"
                        name="harga_satuan" value="{{ old('harga_satuan') }}" required>
                    @error('harga_satuan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="jumlah_satuan" class="form-label">Jumlah Satuan<span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('jumlah_satuan') is-invalid @enderror"
                        id="jumlah_satuan" name="jumlah_satuan" value="{{ old('jumlah_satuan') }}" required>
                    @error('jumlah_satuan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="total_harga" class="form-label">Total Harga (Rp.)</label>
                    <input type="text" class="form-control @error('total_harga') is-invalid @enderror" id="total_harga"
                        name="total_harga" value="{{ old('total_harga') }}" readonly>
                    @error('total_harga')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('masakan.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-2"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
