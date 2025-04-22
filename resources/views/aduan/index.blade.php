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
    .bg-orange {
        background-color: #fd7e14 !important;
        color: white;
    }
    .badge.bg-danger {
        background-color: #dc3545 !important;
        color: white;
    }
    .badge.bg-success {
        background-color: #28a745 !important;
        color: white;
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

    .card-stats {
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .card-stats:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .card-stats.active {
        border-left: 4px solid #28a745;
    }

    .card-stats::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: transparent;
        transition: all 0.3s ease;
    }

    .card-stats:hover::after {
        background: #28a745;
    }

    /* Sorting styles */
    .sort-icon {
        display: inline-block;
        position: absolute;
        width: 20px;
        height: 20px;
        right: 8px;
        top: calc(50% - 10px);
        cursor: pointer;
        z-index: 2;
    }

    .sort-icon i {
        font-size: 12px;
        color: #495057;
        position: absolute;
        left: 0;
        transition: color 0.2s ease;
    }

    .sort-icon i.fa-chevron-up {
        top: 0;
    }

    .sort-icon i.fa-chevron-down {
        bottom: 0;
    }

    .sort-icon i.active {
        color: #28a745 !important;
        font-weight: bold;
    }

    .sort-icon:hover i {
        color: #6c757d;
    }

    th.sortable {
        cursor: pointer;
        position: relative;
        padding-right: 30px !important;
        user-select: none;
    }

    th.sortable:hover {
        background-color: rgba(40, 167, 69, 0.05);
        color: #212529 !important;
    }

    th.sortable.active {
        background-color: rgba(40, 167, 69, 0.1);
        font-weight: bold;
    }
    
    .default-sort {
        display: inline-block;
        transition: opacity 0.5s ease;
        vertical-align: middle;
    }
    
    /* Badge styling for priority */
    .badge {
        padding: 5px 10px;
        border-radius: 4px;
        font-weight: 500;
    }
    
    /* Table hover effect */
    .table-hover tbody tr:hover {
        background-color: rgba(40, 167, 69, 0.05);
    }
    
    /* Ticket ID styling */
    .ticket-id {
        font-weight: 600;
        color: #007bff;
    }
    
    /* Custom badge colors for status */
    .badge-normal {
        background-color: #28a745;
        color: white;
    }
    
    .badge-high {
        background-color: #fd7e14;
        color: white;
    }
    
    .badge-urgent {
        background-color: #dc3545;
        color: white;
    }

    /* Hide all active indicators by default unless explicitly set by the user */
    .no-url-params th.sortable i.active {
        color: #adb5bd !important;
    }
    
    .no-url-params th.sortable.active {
        background-color: transparent !important;
        font-weight: normal !important;
    }

    /* Table header styling - dengan selector yang lebih spesifik */
    .table.table-borderless.table-hover thead th,
    .table.table-borderless.table-hover th.sortable {
        color: #212529 !important; /* Warna hitam untuk header kolom */
        font-weight: 600;
    }
    
    /* Ensure text-muted doesn't override our header color - dengan scope lebih spesifik */
    .card-body .table-header th {
        color: #212529 !important;
    }
    
    /* Batasi scope hanya untuk tabel di halaman aduan */
    .card-body .table-responsive th.sortable:hover {
        background-color: rgba(40, 167, 69, 0.05);
        color: #212529 !important; /* Tetap hitam saat hover */
    }

    /* Override text-muted for table headers - dengan scope yang lebih sempit */
    .card-body .table-responsive tr.table-header th,
    .card-body .table-responsive .table thead tr th {
        color: #212529 !important;
    }
    
    /* Remove overly broad selectors */
    .text-muted.table-header {
        color: initial;
    }
    
    .text-muted th {
        color: initial;
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
            <a href="{{ route('aduan.index', ['status' => 'pending']) }}" class="text-decoration-none">
                <div class="card text-center card-stats">
                    <div class="card-body">
                        <h5 class="card-title text-warning"><i class="fas fa-clock"></i></h5>
                        <h2 class="card-text">{{ $jumlahPending }}</h2>
                        <p class="text-muted">Aduan Pending</p>
                    </div>
                </div>
            </a>
            </div>
            <div class="col-md-3">
            <a href="{{ route('aduan.index', ['status' => 'active']) }}" class="text-decoration-none">
                <div class="card text-center card-stats">
                    <div class="card-body">
                        <h5 class="card-title text-primary"><i class="fas fa-clipboard-check"></i></h5>
                        <h2 class="card-text">{{ $jumlahAktif }}</h2>
                        <p class="text-muted">Aduan Aktif</p>
                    </div>
                </div>
            </a>
            </div>
            <div class="col-md-3">
            <a href="{{ route('aduan.index', ['status' => 'selesai']) }}" class="text-decoration-none">
                <div class="card text-center card-stats">
                    <div class="card-body">
                        <h5 class="card-title text-success"><i class="fas fa-check-circle"></i></h5>
                        <h2 class="card-text">{{ $jumlahSelesai }}</h2>
                        <p class="text-muted">Aduan Selesai</p>
                    </div>
                </div>
            </a>
            </div>
            <div class="col-md-3">
            <a href="{{ route('aduan.index', ['status' => 'draft']) }}" class="text-decoration-none">
                <div class="card text-center card-stats">
                    <div class="card-body">
                        <h5 class="card-title text-secondary"><i class="fas fa-file-alt"></i></h5>
                        <h2 class="card-text">{{ $jumlahDraft }}</h2>
                        <p class="text-muted">Draf Aduan</p>
                    </div>
                </div>
            </a>
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
                            <button type="button" id="reset-btn" class="btn btn-secondary me-2" style="width: 200px">Reset Filter</button>
                            <button type="submit" class="btn btn-primary" style="width: 100px">Cari</button>
                        </div>
                        <!-- Hidden fields for sorting and pagination -->
                        <input type="hidden" name="per_page" value="{{ request('per_page', 10) }}">
                        <input type="hidden" name="sort_by" id="sort_by" value="{{ request('sort_by') }}">
                        <input type="hidden" name="sort_dir" id="sort_dir" value="{{ request('sort_dir', 'desc') }}">
                    </form>

                        <hr>

                        <!-- Tabel Aduan -->
                        <div class="table-responsive">
                        <table class="table table-borderless table-hover {{ !request()->has('sort_by') && !request()->has('sort_dir') ? 'no-url-params' : '' }}">
                                <thead>
                                <tr class="table-header">
                                    <th class="sortable" onclick="sortTable('ticket_id')">
                                        Tiket ID
                                        <span class="sort-icon">
                                            <i class="fas fa-chevron-up {{ request('sort_by') == 'ticket_id' && request('sort_dir') == 'asc' ? 'active' : '' }}"></i>
                                            <i class="fas fa-chevron-down {{ request('sort_by') == 'ticket_id' && request('sort_dir') == 'desc' ? 'active' : '' }}"></i>
                                        </span>
                                    </th>
                                    <th class="sortable" onclick="sortTable('kategori')">
                                        Kategori
                                        <span class="sort-icon">
                                            <i class="fas fa-chevron-up {{ request('sort_by') == 'kategori' && request('sort_dir') == 'asc' ? 'active' : '' }}"></i>
                                            <i class="fas fa-chevron-down {{ request('sort_by') == 'kategori' && request('sort_dir') == 'desc' ? 'active' : '' }}"></i>
                                        </span>
                                    </th>
                                    <th class="sortable" onclick="sortTable('prioritas')">
                                        Prioritas
                                        <span class="sort-icon">
                                            <i class="fas fa-chevron-up {{ request('sort_by') == 'prioritas' && request('sort_dir') == 'asc' ? 'active' : '' }}"></i>
                                            <i class="fas fa-chevron-down {{ request('sort_by') == 'prioritas' && request('sort_dir') == 'desc' ? 'active' : '' }}"></i>
                                        </span>
                                    </th>
                                    <th class="sortable" onclick="sortTable('nomor_surat')">
                                        Nomor Surat
                                        <span class="sort-icon">
                                            <i class="fas fa-chevron-up {{ request('sort_by') == 'nomor_surat' && request('sort_dir') == 'asc' ? 'active' : '' }}"></i>
                                            <i class="fas fa-chevron-down {{ request('sort_by') == 'nomor_surat' && request('sort_dir') == 'desc' ? 'active' : '' }}"></i>
                                        </span>
                                    </th>
                                    <th class="sortable" onclick="sortTable('instansi')">
                                        Instansi
                                        <span class="sort-icon">
                                            <i class="fas fa-chevron-up {{ request('sort_by') == 'instansi' && request('sort_dir') == 'asc' ? 'active' : '' }}"></i>
                                            <i class="fas fa-chevron-down {{ request('sort_by') == 'instansi' && request('sort_dir') == 'desc' ? 'active' : '' }}"></i>
                                        </span>
                                    </th>
                                    <th class="sortable" onclick="sortTable('created_at')">
                                        Submit
                                        <span class="sort-icon">
                                            <i class="fas fa-chevron-up {{ request('sort_by') == 'created_at' && request('sort_dir') == 'asc' ? 'active' : '' }}"></i>
                                            <i class="fas fa-chevron-down {{ request('sort_by') == 'created_at' && request('sort_dir') == 'desc' ? 'active' : '' }}"></i>
                                        </span>
                                    </th>
                                    <th class="sortable" onclick="sortTable('updated_at')">
                                        Update
                                        <span class="sort-icon">
                                            <i class="fas fa-chevron-up {{ request('sort_by') == 'updated_at' && request('sort_dir') == 'asc' ? 'active' : '' }}"></i>
                                            <i class="fas fa-chevron-down {{ request('sort_by') == 'updated_at' && request('sort_dir') == 'desc' ? 'active' : '' }}"></i>
                                        </span>
                                    </th>
                                    <th class="sortable" onclick="sortTable('status')">
                                        Status
                                        <span class="sort-icon">
                                            <i class="fas fa-chevron-up {{ request('sort_by') == 'status' && request('sort_dir') == 'asc' ? 'active' : '' }}"></i>
                                            <i class="fas fa-chevron-down {{ request('sort_by') == 'status' && request('sort_dir') == 'desc' ? 'active' : '' }}"></i>
                                        </span>
                                    </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($aduan as $item)
                                        <!-- Filter aduan berdasarkan peran user -->
                                        @if ((Auth::user()->role_id == 4 && Auth::id() == $item->user_id) || Auth::user()->role_id != 4)
                                            <tr>
                                            <td><span class="ticket-id">{{ $item->ticket_id }}</span></td>
                                                <td>{{ $item->kategori }}</td>
                                                <td>
                                                @if($item->prioritas == 'Normal')
                                                    <span class="badge badge-normal">Normal</span>
                                                @elseif($item->prioritas == 'High')
                                                    <span class="badge badge-high">High</span>
                                                @elseif($item->prioritas == 'Urgent')
                                                    <span class="badge badge-urgent">Urgent</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ $item->prioritas }}</span>
                                                @endif
                                                </td>
                                                <td>{{ $item->nomor_surat ?? '-' }}</td>
                                                <td>{{ $item->instansi ?? '-' }}</td>
                                            <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                            <td>{{ $item->updated_at->diffForHumans() }}</td>
                                            <td>
                                                @if($item->status == 'pending')
                                                    <span class="badge bg-warning">Pending</span>
                                                @elseif($item->status == 'active')
                                                    <span class="badge bg-primary">Aktif</span>
                                                @elseif($item->status == 'selesai')
                                                    <span class="badge bg-success">Selesai</span>
                                                @elseif($item->status == 'draft')
                                                    <span class="badge bg-secondary">Draft</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ $item->status }}</span>
                                                @endif
                                            </td>
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
                                        <td colspan="9" class="text-center">Tidak ada data aduan tersedia.</td>
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
                // Check if any filter is active or sorting is applied
                const form = document.getElementById('search-form');
                const search = form.querySelector('input[name="search"]').value;
                const kategori = form.querySelector('select[name="kategori"]').value;
                const status = form.querySelector('select[name="status"]').value;
                const dateFrom = form.querySelector('input[name="date_from"]').value;
                const dateTo = form.querySelector('input[name="date_to"]').value;
                const sortBy = form.querySelector('input[name="sort_by"]').value;
                const sortDir = form.querySelector('input[name="sort_dir"]').value;
                
                // Check if any filter or sort is active
                const hasActiveFilters = search || kategori || status || dateFrom || dateTo;
                // Check if any sorting parameter exists in the URL (even default ones)
                const hasSortingParams = sortBy || sortDir || new URLSearchParams(window.location.search).has('sort_by') || new URLSearchParams(window.location.search).has('sort_dir');
                
                if (hasActiveFilters || hasSortingParams) {
                    // Reset all form fields
                    if (form.querySelector('input[name="search"]')) form.querySelector('input[name="search"]').value = '';
                    if (form.querySelector('select[name="kategori"]')) form.querySelector('select[name="kategori"]').value = '';
                    if (form.querySelector('select[name="status"]')) form.querySelector('select[name="status"]').value = '';
                    if (form.querySelector('input[name="date_from"]')) form.querySelector('input[name="date_from"]').value = '';
                    if (form.querySelector('input[name="date_to"]')) form.querySelector('input[name="date_to"]').value = '';
                    
                    // Reset sort fields to default
                    if (form.querySelector('input[name="sort_by"]')) form.querySelector('input[name="sort_by"]').value = '';
                    if (form.querySelector('input[name="sort_dir"]')) form.querySelector('input[name="sort_dir"]').value = '';
                    
                    // Show loading indicator
                    Swal.fire({
                        title: 'Mereset filter...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    
                    // Redirect to base URL without any parameters
                    window.location.href = '{{ route('aduan.index') }}';
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
        
        // Mark active status card
        const currentStatus = new URLSearchParams(window.location.search).get('status');
        if (currentStatus) {
            const statusCards = {
                'pending': 0,
                'active': 1,
                'selesai': 2,
                'draft': 3
            };
            
            if (statusCards.hasOwnProperty(currentStatus)) {
                const cardIndex = statusCards[currentStatus];
                document.querySelectorAll('.card-stats')[cardIndex].classList.add('active');
            }
        }
        
        // Set up sorting for table headers
        setupTableSorting();
    });
    
    // Function to handle sorting
    function sortTable(column) {
        const form = document.getElementById('search-form');
        const sortByInput = form.querySelector('#sort_by');
        const sortDirInput = form.querySelector('#sort_dir');
        
        // Toggle sort direction or set default
        let direction = 'asc';
        
        if (sortByInput.value === column) {
            // If already sorting by this column, toggle direction
            direction = (sortDirInput.value === 'asc') ? 'desc' : 'asc';
        } else if (column === 'created_at' || column === 'updated_at') {
            // Default to descending for date columns
            direction = 'desc';
        }
        
        // Update form values
        sortByInput.value = column;
        sortDirInput.value = direction;
        
        // Update UI to reflect sorting
        updateSortingUI(column, direction);
        
        // Show loading
        Swal.fire({
            title: 'Mengurutkan data...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
                // Submit form after showing loading
                form.submit();
            }
        });
    }
    
    // Function to update UI for sorting
    function updateSortingUI(column, direction) {
        // Clear active class from all headers
        document.querySelectorAll('th.sortable').forEach(th => {
            th.classList.remove('active');
            const upIcon = th.querySelector('.fa-chevron-up');
            const downIcon = th.querySelector('.fa-chevron-down');
            if (upIcon) upIcon.classList.remove('active');
            if (downIcon) downIcon.classList.remove('active');
        });
        
        // Add active class to current header
        const currentHeader = document.querySelector(`th.sortable[onclick*="'${column}'"]`);
        if (currentHeader) {
            currentHeader.classList.add('active');
            const directionIcon = currentHeader.querySelector(`.fa-chevron-${direction === 'asc' ? 'up' : 'down'}`);
            if (directionIcon) directionIcon.classList.add('active');
        }
    }
    
    // Set up table sorting
    function setupTableSorting() {
        const params = new URLSearchParams(window.location.search);
        const sortBy = params.get('sort_by');
        const sortDir = params.get('sort_dir');
        
        // Only update UI if sort parameters are explicitly set
        if (sortBy && sortDir) {
            updateSortingUI(sortBy, sortDir);
        }
    }
    </script>
@endsection
