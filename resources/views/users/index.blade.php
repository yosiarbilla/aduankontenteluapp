@extends('layouts.app')

@section('isi')
<style>
    .card {
        border: none;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }
    .table-borderless th,
    .table-borderless td {
        border: none;
    }
    .badge {
        font-size: 14px;
        padding: 5px 10px;
        border-radius: 20px;
    }
    .btn-success {
        background-color: #28a745;
        border: none;
        color: #fff;
    }
</style>

<div class="container-fluid mt-6">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Manajemen User -->
    <div class="row">
        <div class="col-12 d-flex justify-content-between align-items-center mb-3">
            <h5>Manajemen User</h5>
            <a href="{{ route('users.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Tambah User Baru</a>
        </div>
        
        <!-- Search Field (moved outside card) -->
        <div class="col-12 d-flex justify-content-end mb-3">
            <div class="input-group" style="width: 300px;">
                <span class="input-group-text bg-white border-end-0">
                    <i class="fas fa-search text-muted"></i>
                </span>
                <input type="text" id="searchTable" class="form-control border-start-0" placeholder="Cari...">
            </div>
        </div>
        
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h6 class="mb-3">Semua Pengguna</h6>
                    <!-- Tabel User -->
                    <div class="table-responsive">
                        <table class="table table-borderless" id="userTable">
                            <thead>
                                <tr class="text-muted">
                                    <th>Nama</th>
                                    <th>Pangkat</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->pangkat ?? '-' }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <span class="badge bg-{{ $user->role_id == 1 ? 'danger' : ($user->role_id == 2 ? 'warning' : ($user->role_id == 3 ? 'info' : 'secondary')) }}">
                                                {{ $user->role->name ?? 'Tidak Ada Role' }}
                                            </span>
                                        </td>
                                        <td>{{ $user->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-outline-primary btn-sm">Edit</a>
                                            @if(auth()->id() != $user->id)
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Yakin ingin menghapus user ini?')">Hapus</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Tidak ada user tersedia.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center mt-4">{{ $users->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        confirmButtonText: 'OK',
        showCloseButton: true,
        timer: 3000
    });
    @endif

    @if(session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: '{{ session('error') }}',
        confirmButtonText: 'OK',
        showCloseButton: true
    });
    @endif

    // Simple search functionality
    const searchInput = document.getElementById('searchTable');
    const table = document.getElementById('userTable');
    
    searchInput.addEventListener('keyup', function() {
        const searchTerm = searchInput.value.toLowerCase();
        const rows = table.querySelectorAll('tbody tr');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            if (text.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
        
        // Check if no results found
        const visibleRows = table.querySelectorAll('tbody tr:not([style*="display: none"])');
        const tbody = table.querySelector('tbody');
        const noResultsRow = table.querySelector('.no-results-row');
        
        if (visibleRows.length === 0 && !noResultsRow) {
            const newRow = document.createElement('tr');
            newRow.className = 'no-results-row';
            newRow.innerHTML = `
                <td colspan="5" class="text-center py-4 text-muted">
                    <i class="fas fa-search me-2"></i>Tidak ada hasil pencarian untuk "${searchInput.value}"
                </td>
            `;
            tbody.appendChild(newRow);
        } else if (visibleRows.length > 0 && noResultsRow) {
            noResultsRow.remove();
        }
    });
</script>
@endsection