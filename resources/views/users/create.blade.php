@extends('layouts.app')

@section('isi')
<style>
    .card {
        border: none;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }
    .form-label {
        font-weight: bold;
        margin-bottom: 5px;
        font-size: 14px;
    }
    .form-control {
        margin-bottom: 10px;
    }
    .back-button {
        text-decoration: none;
        color: #007bff;
        font-weight: bold;
        margin-bottom: 20px;
        display: inline-block;
    }
    .back-button i {
        margin-right: 4px;
    }
</style>

<div class="container-fluid mt-6">
    <div class="row">
        <div class="col-12 mb-3">
        <a href="{{ route('users.index') }}" class="back-button">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        </div>
        
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="pangkat" class="form-label">Pangkat (Opsional)</label>
                            <select class="form-control" id="pangkat" name="pangkat">
                                <option value="">Pilih Pangkat</option>
                                <!-- Pangkat TNI AD Perwira -->
                                <optgroup label="Perwira Tinggi">
                                    <option value="Jenderal" {{ old('pangkat') == 'Jenderal' ? 'selected' : '' }}>Jenderal TNI</option>
                                    <option value="Letnan Jenderal" {{ old('pangkat') == 'Letnan Jenderal' ? 'selected' : '' }}>Letnan Jenderal TNI</option>
                                    <option value="Mayor Jenderal" {{ old('pangkat') == 'Mayor Jenderal' ? 'selected' : '' }}>Mayor Jenderal TNI</option>
                                    <option value="Brigadir Jenderal" {{ old('pangkat') == 'Brigadir Jenderal' ? 'selected' : '' }}>Brigadir Jenderal TNI</option>
                                </optgroup>
                                <optgroup label="Perwira Menengah">
                                    <option value="Kolonel" {{ old('pangkat') == 'Kolonel' ? 'selected' : '' }}>Kolonel</option>
                                    <option value="Letnan Kolonel" {{ old('pangkat') == 'Letnan Kolonel' ? 'selected' : '' }}>Letnan Kolonel</option>
                                    <option value="Mayor" {{ old('pangkat') == 'Mayor' ? 'selected' : '' }}>Mayor</option>
                                </optgroup>
                                <optgroup label="Perwira Pertama">
                                    <option value="Kapten" {{ old('pangkat') == 'Kapten' ? 'selected' : '' }}>Kapten</option>
                                    <option value="Letnan Satu" {{ old('pangkat') == 'Letnan Satu' ? 'selected' : '' }}>Letnan Satu</option>
                                    <option value="Letnan Dua" {{ old('pangkat') == 'Letnan Dua' ? 'selected' : '' }}>Letnan Dua</option>
                                </optgroup>
                                <!-- Pangkat TNI AD Bintara -->
                                <optgroup label="Bintara Tinggi">
                                    <option value="Pembantu Letnan Satu" {{ old('pangkat') == 'Pembantu Letnan Satu' ? 'selected' : '' }}>Pembantu Letnan Satu</option>
                                    <option value="Pembantu Letnan Dua" {{ old('pangkat') == 'Pembantu Letnan Dua' ? 'selected' : '' }}>Pembantu Letnan Dua</option>
                                </optgroup>
                                <optgroup label="Bintara">
                                    <option value="Sersan Mayor" {{ old('pangkat') == 'Sersan Mayor' ? 'selected' : '' }}>Sersan Mayor</option>
                                    <option value="Sersan Kepala" {{ old('pangkat') == 'Sersan Kepala' ? 'selected' : '' }}>Sersan Kepala</option>
                                    <option value="Sersan Satu" {{ old('pangkat') == 'Sersan Satu' ? 'selected' : '' }}>Sersan Satu</option>
                                    <option value="Sersan Dua" {{ old('pangkat') == 'Sersan Dua' ? 'selected' : '' }}>Sersan Dua</option>
                                </optgroup>
                                <!-- Pangkat TNI AD Tamtama -->
                                <optgroup label="Tamtama">
                                    <option value="Kopral Kepala" {{ old('pangkat') == 'Kopral Kepala' ? 'selected' : '' }}>Kopral Kepala</option>
                                    <option value="Kopral Satu" {{ old('pangkat') == 'Kopral Satu' ? 'selected' : '' }}>Kopral Satu</option>
                                    <option value="Kopral Dua" {{ old('pangkat') == 'Kopral Dua' ? 'selected' : '' }}>Kopral Dua</option>
                                    <option value="Prajurit Kepala" {{ old('pangkat') == 'Prajurit Kepala' ? 'selected' : '' }}>Prajurit Kepala</option>
                                    <option value="Prajurit Satu" {{ old('pangkat') == 'Prajurit Satu' ? 'selected' : '' }}>Prajurit Satu</option>
                                    <option value="Prajurit Dua" {{ old('pangkat') == 'Prajurit Dua' ? 'selected' : '' }}>Prajurit Dua</option>
                                </optgroup>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="role_id" class="form-label">Role</label>
                            <select class="form-control" id="role_id" name="role_id" required>
                                <option value="">Pilih Role</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>
                        
                        <div class="d-flex justify-content-end mt-4">
                            <button type="reset" class="btn btn-secondary me-2">Reset</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection