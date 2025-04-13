@extends('backend.v1.templates.index')

@section('content')
    @if ($errors->any())
        <div>
            <div class="alert alert-danger">
                @foreach ($errors->all() as $user)
                    <li>{{ $user }}</li>
                @endforeach
            </div>
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Akses Pengguna</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('user.update', $user) }}">
                @csrf
                @method('patch')
                <!-- Nama username -->
                <div class="mb-3">
                    <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                        name="username" value="{{ old('username', $user->username) }}" required autofocus>
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password Baru<span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                            name="password" value="{{ old('password') }}" required>
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                            <i class="fas fa-eye">Tampilkan</i>
                        </button>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <small class="text-muted">Minimal 8 karakter</small>
                </div>

                <!-- Rule Admin atau kasir -->
                <div class="mb-3">
                    <label for="rule" class="form-label">Rule Akses Pengguna<span class="text-danger">*</span></label>
                    <select class="form-select @error('rule') is-invalid @enderror" id="rule" name="rule" required>
                        <option value="" disabled selected>Pilih Rule Pengguna</option>
                        @foreach (['admin', 'kasir'] as $rule)
                            <option value="{{ $rule }}" {{ old('rule', $user->rule) == $rule ? 'selected' : '' }}>
                                {{ ucfirst($rule) }}
                            </option>
                        @endforeach
                    </select>
                    @error('rule')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('user.index') }}" class="btn btn-secondary">
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
