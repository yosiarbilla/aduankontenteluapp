@extends('layouts.app')

@section('isi')

<style>
    .card {
        border: none;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }
    .card .card-title {
        font-size: 20px;
        margin-bottom: 20px;
    }
    .card .card-text {
        font-weight: bold;
        font-size: 24px;
    }
    .badge {
        font-size: 14px;
        padding: 5px 10px;
        border-radius: 20px;
    }
    .table-borderless th,
    .table-borderless td {
        border: none;
    }
    .form-label {
        font-weight: bold;
        margin-bottom: 5px;
        font-size: 14px;
    }
    .form-control {
        margin-bottom: 10px;
    }
    .text-end button {
        min-width: 100px;
    }
    .btn-success {
        background-color: #28a745;
        border: none;
        color: #fff;
    }
    .btn-primary {
        background-color: #28a745;
        border: none;
        color: #fff;
    }
    
    /* Pagination Styling */
    .pagination {
        margin-bottom: 0;
    }
    .pagination .page-item.active .page-link {
        background-color: #28a745;
        border-color: #28a745;
        color: #fff;
    }
    .pagination .page-link {
        color: #28a745;
        padding: 0.375rem 0.75rem;
    }
    .pagination .page-link:hover {
        color: #1e7e34;
        background-color: #e9ecef;
        border-color: #dee2e6;
    }
    .pagination .page-item.disabled .page-link {
        color: #6c757d;
    }
    .form-select-sm {
        font-size: 0.875rem;
        padding: 0.25rem 0.5rem;
    }
    
    /* Pagination responsive styling */
    @media (max-width: 768px) {
        .pagination-container {
            flex-direction: column;
            gap: 15px;
        }
        .pagination-container > div {
            width: 100%;
            justify-content: center;
            text-align: center;
        }
        .pagination {
            justify-content: center;
        }
    }
    
    @media (max-width: 768px) {
        .card {
            margin-bottom: 20px;
            /* Beri jarak antar kartu */
            padding: 15px;
            /* Tambahkan padding agar lebih rapi */
        }

        .col-md-3 {
            width: 100%;
            /* Buat setiap card menjadi full width agar tidak kecil */
        }
    }
</style>

@if(Auth::user()->role_id != null)
<div class="container-fluid mt-6">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    <!-- Statistik Aduan -->
    <h5 style="margin-bottom: 20px;">Statistik Aduan</h5>
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title text-warning"><i class="fas fa-clock"></i></h5>
                    <h2 class="card-text">{{ $jumlahPending }}</h2>
                    <p class="text-muted">Aduan Pending</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title text-primary"><i class="fas fa-clipboard-check"></i></h5>
                    <h2 class="card-text">{{ $jumlahAktif }}</h2>
                    <p class="text-muted">Aduan Aktif</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title text-success"><i class="fas fa-check-circle"></i></h5>
                    <h2 class="card-text">{{ $jumlahSelesai }}</h2>
                    <p class="text-muted">Aduan Selesai</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title text-secondary"><i class="fas fa-file-alt"></i></h5>
                    <h2 class="card-text">{{ $jumlahDraft }}</h2>
                    <p class="text-muted">Draf Aduan</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Semua Aduan -->
    <div class="row">
        <div class="col-12 d-flex justify-content-between align-items-center mb-3">
            <!-- Judul disesuaikan berdasarkan role -->
            @if (Auth::user()->role_id == 4)
                <h5>Aduan Saya</h5>
            @else
                <h5>Semua Aduan</h5>
            @endif
            <a href="{{ route('aduan.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Buat Aduan</a>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- Detail Pencarian -->
                    <h6>Detail Pencarian @if(request()->hasAny(['search', 'kategori', 'status', 'date_from', 'date_to'])) <small class="text-success">(Filter aktif)</small> @endif</h6>
                    <form action="{{ route('aduan.index') }}" method="GET" id="search-form">
                        <div class="row mb-3">
                            <div class="col">
                                <label for="search" class="form-label">Pencarian</label>
                                <input type="text" id="search" class="form-control {{ request('search') ? 'border-success' : '' }}" name="search" placeholder="Kata Kunci Pencarian" value="{{ request('search') }}">
                            </div>
                            <div class="col">
                                <label for="kategori" class="form-label">Kategori</label>
                                <div class="position-relative">
                                    <select id="kategori" class="form-control {{ request('kategori') ? 'border-success' : '' }}" name="kategori">
                                        <option value="">Kategori</option>
                                        <option value="Konten Negatif" {{ request('kategori') == 'Konten Negatif' ? 'selected' : '' }}>Konten Negatif</option>
                                        <option value="Penipuan" {{ request('kategori') == 'Penipuan' ? 'selected' : '' }}>Penipuan</option>
                                        <option value="Terorisme" {{ request('kategori') == 'Terorisme' ? 'selected' : '' }}>Terorisme</option>
                                    </select>
                                    <div class="position-absolute"
                                        style="top: 50%; right: 10px; transform: translateY(-50%);">
                                        <i class="fas fa-chevron-down text-muted"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <label for="status" class="form-label">Status</label>
                                <div class="position-relative">
                                    <select id="status" class="form-control {{ request('status') ? 'border-success' : '' }}" name="status">
                                        <option value="">Status</option>
                                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                    </select>
                                    <div class="position-absolute"
                                        style="top: 50%; right: 10px; transform: translateY(-50%);">
                                        <i class="fas fa-chevron-down text-muted"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <label for="date_from" class="form-label">Periode Awal</label>
                                <input type="date" id="date_from" class="form-control {{ request('date_from') ? 'border-success' : '' }}" name="date_from" placeholder="Periode Awal" value="{{ request('date_from') }}">
                            </div>
                            <div class="col">
                                <label for="date_to" class="form-label">Periode Akhir</label>
                                <input type="date" id="date_to" class="form-control {{ request('date_to') ? 'border-success' : '' }}" name="date_to" placeholder="Periode Akhir" value="{{ request('date_to') }}">
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mb-4">
                            <button type="button" id="reset-btn" class="btn btn-secondary me-2" style="width: 100px">Reset</button>
                            <button type="submit" class="btn btn-primary" style="width: 100px">Cari</button>
                        </div>
                        <!-- Hidden field for per_page to maintain when submitting form -->
                        <input type="hidden" name="per_page" value="{{ request('per_page', 10) }}">
                    </form>

                    <hr>

                    <!-- Tabel Aduan -->
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                                <tr class="text-muted">
                                    <th>Tiket ID</th>
                                    <th>Kategori</th>
                                    <th>Prioritas</th>
                                    <th>Nomor Surat</th>
                                    <th>Instansi</th>
                                    <th>Submit</th>
                                    <th>Update</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($aduan as $item)
                                    <!-- Filter aduan berdasarkan peran user -->
                                    @if ((Auth::user()->role_id == 4 && Auth::id() == $item->user_id) || Auth::user()->role_id != 4)
                                        <tr>
                                            <td class="text-primary">{{ $item->ticket_id }}</td>
                                            <td>{{ $item->kategori }}</td>
                                            <td>
                                                <span
                                                    class="badge bg-{{ $item->prioritas == 'High' ? 'danger' : ($item->prioritas == 'Urgent' ? 'warning' : 'success') }}">
                                                    {{ ucfirst($item->prioritas) }}
                                                </span>
                                            </td>
                                            <td>{{ $item->nomor_surat ?? '-' }}</td>
                                            <td>{{ $item->instansi ?? '-' }}</td>
                                            <td>{{ $item->created_at->format('d-m-Y') ?? '-' }}</td>
                                            <td>{{ $item->updated_at->format('d-m-Y') ?? '-' }}</td>
                                            <td>
                                                <a href="{{ route('aduan.show', $item->id) }}"
                                                    class="btn btn-outline-success btn-sm">Detail</a>
                                                <a href="{{ route('aduan.export-pdf', $item->id) }}" target="_blank"
                                                    class="btn btn-outline-success btn-sm">Unduh</a>
                                            </td>
                                        </tr>
                                    @endif
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Tidak ada data aduan tersedia.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination Component -->
                    <div class="d-flex justify-content-between align-items-center mt-4 pagination-container">
                        <div class="d-flex align-items-center">
                            <span class="me-2">Jumlah Tampil</span>
                            <select class="form-select form-select-sm" style="width: 70px;" id="per-page-select">
                                <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                            </select>
                        </div>
                        
                        @if ($aduan->hasPages())
                        <div>
                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-sm mb-0">
                                    {{-- Previous Page Link --}}
                                    <li class="page-item {{ $aduan->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $aduan->previousPageUrl() }}" aria-label="Previous">
                                            <span aria-hidden="true">Sebelumnya</span>
                                        </a>
                                    </li>
                                    
                                    {{-- Pagination Elements --}}
                                    @php
                                        $start = max(1, $aduan->currentPage() - 1);
                                        $end = min($start + 2, $aduan->lastPage());
                                        $start = max(1, $end - 2);
                                    @endphp
                                    
                                    @for ($i = $start; $i <= $end; $i++)
                                        <li class="page-item {{ $aduan->currentPage() == $i ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $aduan->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor
                                    
                                    {{-- Next Page Link --}}
                                    <li class="page-item {{ !$aduan->hasMorePages() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $aduan->nextPageUrl() }}" aria-label="Next">
                                            <span aria-hidden="true">Berikutnya</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        
                        <div class="text-muted">
                            Tampilkan isi {{ $aduan->firstItem() ?? 0 }} to {{ $aduan->lastItem() ?? 0 }} of {{ $aduan->total() }}
                        </div>
                        @else
                        <div></div>
                        <div class="text-muted">
                            Tampilkan isi 1 to {{ count($aduan) }} of {{ count($aduan) }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div>
    <h1 class="text-center">Hubungi Admin Untuk Mendapatkan Role</h1>
</div>
@endif


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            confirmButtonText: 'OK',
            showCloseButton: true, // Menampilkan tombol X untuk menutup alert
            timer: 3000
        });
    @endif
    
    document.addEventListener('DOMContentLoaded', function() {
        // Per page select handler
        const perPageSelect = document.getElementById('per-page-select');
        if (perPageSelect) {
            perPageSelect.addEventListener('change', function() {
                // Add the per_page value to the form and submit it
                const hiddenPerPage = document.querySelector('input[name="per_page"]');
                if (hiddenPerPage) {
                    hiddenPerPage.value = this.value;
                    document.getElementById('search-form').submit();
                } else {
                    window.location.href = updateQueryStringParameter(window.location.href, 'per_page', this.value);
                }
            });
        }
        
        // Reset button handler with confirmation
        const resetBtn = document.getElementById('reset-btn');
        if (resetBtn) {
            resetBtn.addEventListener('click', function() {
                // Check if any filter is active
                const form = document.getElementById('search-form');
                const search = form.querySelector('input[name="search"]').value;
                const kategori = form.querySelector('select[name="kategori"]').value;
                const status = form.querySelector('select[name="status"]').value;
                const dateFrom = form.querySelector('input[name="date_from"]').value;
                const dateTo = form.querySelector('input[name="date_to"]').value;
                
                if (search || kategori || status || dateFrom || dateTo) {
                    // Instead of submitting the form with empty values,
                    // redirect to the base URL to ensure all parameters are removed
                    Swal.fire({
                        title: 'Mereset pencarian...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    
                    // Get the current per_page value to preserve it if needed
                    const perPageValue = document.querySelector('input[name="per_page"]').value;
                    const baseUrl = window.location.href.split('?')[0];
                    
                    // If we want to keep the per_page setting, add it to the URL
                    const targetUrl = perPageValue && perPageValue !== '10' 
                        ? baseUrl + '?per_page=' + perPageValue 
                        : baseUrl;
                    
                    // Redirect after a short delay
                    setTimeout(() => {
                        window.location.href = targetUrl;
                    }, 300);
                } else {
                    // No filters active, just notify user
                    Swal.fire({
                        icon: 'info',
                        title: 'Tidak ada filter aktif',
                        text: 'Tidak ada filter pencarian yang perlu direset.',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            });
        }
        
        // Form submit handler - show loading
        const searchForm = document.getElementById('search-form');
        const searchButton = searchForm.querySelector('button[type="submit"]');
        
        if (searchForm && searchButton) {
            searchButton.addEventListener('click', function(e) {
                // Check if any filter was changed
                const formData = new FormData(searchForm);
                let hasFilter = false;
                
                for (const [key, value] of formData.entries()) {
                    if (key !== 'per_page' && value) {
                        hasFilter = true;
                        break;
                    }
                }
                
                if (hasFilter) {
                    // Show loading indicator
                    Swal.fire({
                        title: 'Mencari data...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                }
            });
        }
        
        // Helper function to update URL parameters
        function updateQueryStringParameter(uri, key, value) {
            const re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
            const separator = uri.indexOf('?') !== -1 ? "&" : "?";
            
            if (uri.match(re)) {
                return uri.replace(re, '$1' + key + "=" + value + '$2');
            } else {
                return uri + separator + key + "=" + value;
            }
        }
        
        // Initialize date pickers with better UX
        const dateInputs = document.querySelectorAll('input[type="date"]');
        dateInputs.forEach(input => {
            // Add event listener to check date range logic
            input.addEventListener('change', function() {
                const dateFrom = document.querySelector('input[name="date_from"]');
                const dateTo = document.querySelector('input[name="date_to"]');
                
                if (dateFrom.value && dateTo.value) {
                    if (new Date(dateFrom.value) > new Date(dateTo.value)) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Rentang tanggal tidak valid',
                            text: 'Tanggal awal tidak boleh lebih besar dari tanggal akhir',
                            timer: 3000
                        });
                        
                        // Reset the current input
                        this.value = '';
                    }
                }
            });
        });
    });
</script>
@endsection
