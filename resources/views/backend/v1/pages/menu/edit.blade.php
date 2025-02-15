@extends('backend.v1.templates.index')

@section('content')
    @if ($errors->any())
        <div>
            <div class="alert alert-danger">
                @foreach ($errors->all() as $program)
                    <li>{{ $program }}</li>
                @endforeach
            </div>
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Menu</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('menu.update', $menu) }}" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <!-- Nama Menu -->
                <div class="mb-3">
                    <label for="nama_menu" class="form-label">Nama Menu <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nama_menu') is-invalid @enderror" id="nama_menu"
                        name="nama_menu" value="{{ old('nama_menu', $menu->nama_menu) }}" required autofocus>
                    @error('nama_menu')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Jenis Menu -->
                <div class="mb-3">
                    <label for="jenis_menu" class="form-label">Jenis Menu <span class="text-danger">*</span></label>
                    <select class="form-select @error('jenis_menu') is-invalid @enderror" id="jenis_menu" name="jenis_menu"
                        required>
                        <option value="" disabled>Pilih Jenis Menu</option>
                        @foreach (['makanan', 'minuman'] as $jenis)
                            <option value="{{ $jenis }}"
                                {{ old('jenis_menu', $menu->jenis_menu) == $jenis ? 'selected' : '' }}>
                                {{ ucfirst($jenis) }}
                            </option>
                        @endforeach
                    </select>
                    @error('jenis_menu')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Satuan -->
                <div class="mb-3">
                    <label for="satuan" class="form-label">Satuan</label>
                    <input type="text" class="form-control @error('satuan') is-invalid @enderror" id="satuan"
                        name="satuan" value="{{ old('satuan', $menu->satuan) }}" placeholder="Contoh: Porsi, Gelas, etc.">
                    @error('satuan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Status -->
                <div class="mb-4">
                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status"
                        required>
                        <option value="" disabled>Pilih Status</option>
                        @foreach (['tersedia', 'tidak tersedia'] as $status)
                            <option value="{{ $status }}"
                                {{ old('status', $menu->status) == $status ? 'selected' : '' }}>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Upload Photo -->
                <div class="mb-3">
                    <label for="photo" class="form-label">Upload Foto Baru</label>
                    <!-- Preview foto lama -->
                    @if ($menu->photo)
                        <div class="mb-2">
                            <img src="{{ asset('uploads/' . $menu->photo) }}" alt="Foto Menu" width="100">
                        </div>
                    @endif
                    <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo"
                        name="photo" accept="image/*">
                    @error('photo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('menu.index') }}" class="btn btn-secondary">
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
