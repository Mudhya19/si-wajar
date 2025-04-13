@extends('backend.v1.templates.index')

@section('content')
    @if ($errors->any())
        <div>
            <div class="alert alert-danger">
                @foreach ($errors->all() as $transaksi)
                    <li>{{ $transaksi }}</li>
                @endforeach
            </div>
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Tambah Transaksi Baru</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('transaksi.store') }}">
                @csrf

                {{-- <!-- User ID (Hidden) -->
                <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                <!-- Info Pengguna -->
                <div class="mb-3">
                    <label class="form-label">Kasir</label>
                    <input type="text" class="form-control"
                           value="{{ Auth::user()->rule }}"
                           readonly>
                </div> --}}

                <!-- Total Harga -->
                <div class="mb-3">
                    <label for="total_harga" class="form-label">Total Bayar (Rp.)<span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('total_harga') is-invalid @enderror" id="total_harga"
                        name="total_harga" value="{{ old('total_harga') }}" required>
                    @error('total_harga')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Metode Pembayaran -->
                <div class="mb-3">
                    <label for="metode" class="form-label">Metode Pembayaran <span class="text-danger">*</span></label>
                    <select class="form-select @error('metode') is-invalid @enderror" id="metode" name="metode"
                        required>
                        <option value="" disabled selected>Pilih Metode</option>
                        <option value="tunai" {{ old('metode') == 'tunai' ? 'selected' : '' }}>Tunai</option>
                        <option value="non-tunai" {{ old('metode') == 'non-tunai' ? 'selected' : '' }}>Non-Tunai</option>
                    </select>
                    @error('metode')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tanggal Transaksi -->
                <div class="mb-3">
                    <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi <span
                            class="text-danger">*</span></label>
                    <input type="date" class="form-control @error('tanggal_transaksi') is-invalid @enderror"
                        id="tanggal_transaksi" name="tanggal_transaksi"
                        value="{{ old('tanggal_transaksi', now()->format('Y-m-d')) }}" required>
                    @error('tanggal_transaksi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">
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
