@extends('layouts.app')
<style>
    body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin: 0; /* Menghilangkan margin default */
            
        }
    .card {
        position: relative;
        border: none !important;
        height: 250px;
        overflow: hidden;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        
    }

    .card img {
        max-width: 100%;
        height: 200px;
        object-fit: cover;
        filter: brightness(0.35); /* Mencerahkan gambar */
        opacity: 0.5; /* Transparansi pada gambar */
        background-color:green!important;
     
    }

    .card-title {
        position: absolute;
        top: 10px;
        left: 15px;
        font-size: 18px;
        font-weight: bold;
        color: white!important;
        text-align: center!important;
        padding: 3px;
      
    }

    .card-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 30%; /* Overlay hanya 50% dari bawah */
        background: rgba(0, 128, 0, 0.7); /* Overlay hijau */
        color: white;
        padding: 15px;
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }

    .card-link {
        font-size: 12px;
        text-decoration: none;
        color: white;
        font-weight: bold;
        text-align: right;
    }

    .card-link:hover {
        color: #d4edda;
    }

    /* Konten Utama */
    .table-borderless th,
    .table-borderless td {
        border: none;
    }
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

    /* Modal overlay style fix - stronger styling */
    .modal-backdrop {
        opacity: 0.7 !important;
        background-color: #000 !important;
        z-index: 1040 !important;
    }
    
    /* Pastikan modal tampil di atas semua elemen */
    .modal {
        z-index: 9999 !important;
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0);
        padding-top: 60px;
    }
    
    .modal.show {
        display: block !important;
    }
    
    .text-success {
        color: #28a745;
        font-weight: bold;
    }
    
    /* Custom overlay for manual implementation */
    #custom-modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: 9000;
        display: none;
    }
    
    /* Mobile spacing for cards */
    @media (max-width: 768px) {
        .card-container {
            margin-bottom: 20px;
        }
    }
    
    /* Override Bootstrap's modal styling */
    .modal-dialog {
        max-width: 500px;
        margin: 1.75rem auto;
    }
    
    .modal-content {
        position: relative;
        background-color: #fff;
        border-radius: 0.3rem;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.5);
        outline: 0;
    }
    
    .modal-open {
        overflow: hidden;
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
    
    .badge-medium {
        background-color: #ffc107;
        color: #212529;
    }
    
    .badge-high {
        background-color: #fd7e14;
        color: white;
    }
    
    .badge-urgent {
        background-color: #dc3545;
        color: white;
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
        color: #adb5bd;
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
        color: #28a745;
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
    }

    th.sortable.sorted {
        background-color: rgba(40, 167, 69, 0.1);
    }
</style>

@section('isi')
    <!-- Informasi Umum -->
    <h5>Informasi Umum</h5>
    <div class="row mb-4">
        <div class="col-md-4 card-container mb-3">
            <div class="card">
                <img src="{{ asset('images/laptop.jpg') }}" alt="Tata Cara Pengisian Aduan">
                <div class="card-title">Tata Cara Pengisian Aduan</div>
                <div class="card-overlay">
                <a href="#" class="card-link modal-trigger" data-content="aduan">Pelajari Selengkapnya</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 card-container mb-3">
            <div class="card">
                <img src="{{ asset('images/laptop2.jpg') }}" alt="Pemberitahuan Hari Ini">
                <div class="card-title">Pemberitahuan Hari Ini</div>
                <div class="card-overlay">
                <a href="#" class="card-link modal-trigger" data-content="pemberitahuan">Pelajari Selengkapnya</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 card-container mb-3">
            <div class="card">
                <img src="{{ asset('images/laptop3.jpg') }}" alt="Kenali Lebih Dalam TNI Siber">
                <div class="card-title">Kenali Lebih Dalam TNI Siber</div>
                <div class="card-overlay">
                <a href="#" class="card-link modal-trigger" data-content="tni-siber">Pelajari Selengkapnya</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Aduan Terakhir -->
    <div class="card-header d-flex justify-content-between">
        <h5>Aduan Terakhir</h5>
        <a href="{{ route('aduan.index') }}" class="text-success">Lihat Lebih Detail Semua Aduan</a>
    </div>
    <div class="card shadow-sm">
        <div class="card-body">
            <form id="sort-form" action="{{ url()->current() }}" method="GET">
                <input type="hidden" name="per_page" value="{{ request('per_page', 10) }}">
                <input type="hidden" name="sort_by" id="sort_by" value="{{ request('sort_by', 'created_at') }}">
                <input type="hidden" name="sort_dir" id="sort_dir" value="{{ request('sort_dir', 'desc') }}">
            </form>
            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th class="sortable" data-sort="ticket_id">
                                Tiket ID
                                <span class="sort-icon">
                                    <i class="fas fa-chevron-up {{ request('sort_by') == 'ticket_id' && request('sort_dir') == 'asc' ? 'active' : '' }}"></i>
                                    <i class="fas fa-chevron-down {{ request('sort_by') == 'ticket_id' && request('sort_dir') == 'desc' ? 'active' : '' }}"></i>
                                </span>
                            </th>
                            <th class="sortable" data-sort="kategori">
                                Kategori
                                <span class="sort-icon">
                                    <i class="fas fa-chevron-up {{ request('sort_by') == 'kategori' && request('sort_dir') == 'asc' ? 'active' : '' }}"></i>
                                    <i class="fas fa-chevron-down {{ request('sort_by') == 'kategori' && request('sort_dir') == 'desc' ? 'active' : '' }}"></i>
                                </span>
                            </th>
                            <th class="sortable" data-sort="prioritas">
                                Prioritas
                                <span class="sort-icon">
                                    <i class="fas fa-chevron-up {{ request('sort_by') == 'prioritas' && request('sort_dir') == 'asc' ? 'active' : '' }}"></i>
                                    <i class="fas fa-chevron-down {{ request('sort_by') == 'prioritas' && request('sort_dir') == 'desc' ? 'active' : '' }}"></i>
                                </span>
                            </th>
                            <th class="sortable" data-sort="nomor_surat">
                                Nomor Surat
                                <span class="sort-icon">
                                    <i class="fas fa-chevron-up {{ request('sort_by') == 'nomor_surat' && request('sort_dir') == 'asc' ? 'active' : '' }}"></i>
                                    <i class="fas fa-chevron-down {{ request('sort_by') == 'nomor_surat' && request('sort_dir') == 'desc' ? 'active' : '' }}"></i>
                                </span>
                            </th>
                            <th class="sortable" data-sort="instansi">
                                Instansi
                                <span class="sort-icon">
                                    <i class="fas fa-chevron-up {{ request('sort_by') == 'instansi' && request('sort_dir') == 'asc' ? 'active' : '' }}"></i>
                                    <i class="fas fa-chevron-down {{ request('sort_by') == 'instansi' && request('sort_dir') == 'desc' ? 'active' : '' }}"></i>
                                </span>
                            </th>
                            <th class="sortable" data-sort="created_at">
                                Submit
                                <span class="sort-icon">
                                    <i class="fas fa-chevron-up {{ request('sort_by') == 'created_at' && request('sort_dir') == 'asc' ? 'active' : '' }}"></i>
                                    <i class="fas fa-chevron-down {{ request('sort_by') == 'created_at' && request('sort_dir') == 'desc' ? 'active' : '' }}"></i>
                                </span>
                            </th>
                            <th class="sortable" data-sort="updated_at">
                                Update
                                <span class="sort-icon">
                                    <i class="fas fa-chevron-up {{ request('sort_by') == 'updated_at' && request('sort_dir') == 'asc' ? 'active' : '' }}"></i>
                                    <i class="fas fa-chevron-down {{ request('sort_by') == 'updated_at' && request('sort_dir') == 'desc' ? 'active' : '' }}"></i>
                                </span>
                            </th>
                            <th class="sortable" data-sort="status">
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
                        @forelse($aduan as $item)
                        <tr>
                            <td><span class="ticket-id">{{ $item->ticket_id }}</span></td>
                            <td>{{ $item->kategori }}</td>
                            <td>
                                @if($item->prioritas == 'Normal')
                                    <span class="badge badge-normal">Normal</span>
                                @elseif($item->prioritas == 'Medium')
                                    <span class="badge badge-medium">Medium</span>
                                @elseif($item->prioritas == 'High')
                                    <span class="badge badge-high">High</span>
                                @elseif($item->prioritas == 'Urgent')
                                    <span class="badge badge-urgent">Urgent</span>
                                @else
                                    <span class="badge bg-secondary">{{ $item->prioritas }}</span>
                                @endif
                            </td>
                            <td>{{ $item->nomor_surat }}</td>
                            <td>{{ $item->instansi }}</td>
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
                            <td><a href="{{ route('aduan.export-pdf', $item->id) }}" class="btn btn-sm btn-outline-success">Unduh</a></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-3">Belum ada data aduan</td>
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
                    Tampilkan isi {{ $aduan->firstItem() ?? 0 }} sampai {{ $aduan->lastItem() ?? 0 }} dari {{ $aduan->total() }}
                </div>
                @else
                <div></div>
                <div class="text-muted">
                    Tampilkan isi 1 sampai {{ count($aduan) }} dari {{ count($aduan) }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Custom overlay element -->
<div id="custom-modal-overlay"></div>

<!-- Modal with enhanced structure -->
<div class="modal" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="infoModalLabel">Tata Cara Pengisian Aduan</h5>
                <button type="button" class="btn-close close-modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="{{ asset('images/pelajariselengkapnya-tulis.jpeg') }}" alt="Tata Cara" class="img-fluid mb-3">
                <ol>
                    <li>Buka menu Aduan</li>
                    <li>Pilih Buat Aduan</li>
                    <li>Isi form sesuai informasi yang ada</li>
                    <li>Pastikan seluruh informasi telah benar</li>
                    <li>Pilih Simpan Draft untuk berhenti mengisi sementara, atau pilih Kirim untuk menyelesaikan pembuatan aduan</li>
                </ol>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success close-modal">Mengerti</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Per page select handler
        const perPageSelect = document.getElementById('per-page-select');
        if (perPageSelect) {
            perPageSelect.addEventListener('change', function() {
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
                
                window.location.href = updateQueryStringParameter(window.location.href, 'per_page', this.value);
            });
        }
        
        // Sorting functionality
        const sortableHeaders = document.querySelectorAll('th.sortable');
        sortableHeaders.forEach(header => {
            header.addEventListener('click', function(event) {
                // Jika yang diklik adalah ikon, biarkan event handler ikon yang menangani
                if (event.target.closest('.sort-icon')) {
                    return;
                }
                
                const sortBy = this.getAttribute('data-sort');
                handleSort(sortBy);
            });
        });
        
        // Tambahan untuk ikon panah
        const sortIcons = document.querySelectorAll('.sort-icon i');
        sortIcons.forEach(icon => {
            icon.addEventListener('click', function(event) {
                event.stopPropagation(); // Hentikan propagasi event ke parent
                const sortBy = this.closest('th').getAttribute('data-sort');
                const isAsc = this.classList.contains('fa-chevron-up');
                
                // Jika ikon yang aktif diklik, reset sorting ke default
                if (this.classList.contains('active')) {
                    document.getElementById('sort_by').value = 'created_at';
                    document.getElementById('sort_dir').value = 'desc';
                } else {
                    // Set sorting berdasarkan ikon yang diklik
                    document.getElementById('sort_by').value = sortBy;
                    document.getElementById('sort_dir').value = isAsc ? 'asc' : 'desc';
                }
                
                // Submit form
                document.getElementById('sort-form').submit();
            });
        });
        
        // Fungsi untuk menangani sorting dari header
        function handleSort(sortBy) {
            const currentSortBy = document.getElementById('sort_by').value;
            const currentSortDir = document.getElementById('sort_dir').value;
            
            // Check if clicking the same column that's already sorted
            if (sortBy === currentSortBy) {
                if (currentSortDir === 'asc') {
                    // If ascending, change to descending
                    document.getElementById('sort_dir').value = 'desc';
                } else {
                    // If already descending, reset to default sorting
                    document.getElementById('sort_by').value = 'created_at';
                    document.getElementById('sort_dir').value = 'desc';
                }
            } else {
                // New column, start with ascending
                document.getElementById('sort_by').value = sortBy;
                document.getElementById('sort_dir').value = 'asc';
            }
            
            // Submit the form
            document.getElementById('sort-form').submit();
        }
        
        // Highlight the current sorted column
        const currentSortBy = document.getElementById('sort_by').value;
        if (currentSortBy) {
            const sortedHeader = document.querySelector(`th[data-sort="${currentSortBy}"]`);
            if (sortedHeader) {
                sortedHeader.classList.add('sorted');
            }
        }
        
        // Modal functionality
        const modalElement = document.getElementById('infoModal');
        const customOverlay = document.getElementById('custom-modal-overlay');
        const modalTriggers = document.querySelectorAll('.modal-trigger');
        const closeButtons = document.querySelectorAll('.close-modal');
        
        // Function to open modal with dynamic content
        function openModal(contentType) {
            const modalTitle = document.querySelector('#infoModalLabel');
            const modalBody = document.querySelector('.modal-body');
            
            // Set content based on the triggered element
            if (contentType === 'aduan') {
                modalTitle.textContent = 'Tata Cara Pengisian Aduan';
                modalBody.innerHTML = `
                    <img src="{{ asset('images/pelajariselengkapnya-tulis.jpeg') }}" alt="Tata Cara" class="img-fluid mb-3">
                    <ol class="ps-3">
                        <li>Buka menu Aduan</li>
                        <li>Pilih Buat Aduan</li>
                        <li>Isi form sesuai informasi yang ada</li>
                        <li>Pastikan seluruh informasi telah benar</li>
                        <li>Pilih Simpan Draft untuk berhenti mengisi sementara, atau pilih Kirim untuk menyelesaikan pembuatan aduan</li>
                    </ol>
                `;
            } else if (contentType === 'pemberitahuan') {
                modalTitle.textContent = 'Pemberitahuan Hari Ini';
                modalBody.innerHTML = `
                    <div class="alert alert-success">
                        <h6>Update Sistem - 21 April 2025</h6>
                        <p>Sistem aduan konten telah diperbarui dengan fitur baru untuk memudahkan pelaporan. Silakan gunakan fitur terbaru kami untuk pengalaman yang lebih baik.</p>
                    </div>
                    <div class="alert alert-info">
                        <h6>Maintenance Terjadwal</h6>
                        <p>Sistem akan mengalami pemeliharaan pada tanggal 25 April 2025 pukul 22:00 - 01:00 WIB. Mohon maaf atas ketidaknyamanannya.</p>
                    </div>
                `;
            } else if (contentType === 'tni-siber') {
                modalTitle.textContent = 'Kenali Lebih Dalam TNI Siber';
                modalBody.innerHTML = `
                    <img src="{{ asset('images/laptop3.jpg') }}" alt="TNI Siber" class="img-fluid mb-3">
                    <p>TNI Siber adalah satuan yang bertugas untuk melindungi ruang siber Indonesia dari berbagai ancaman. Sebagai bagian dari pertahanan negara, TNI Siber memiliki peran strategis dalam mengamankan infrastruktur digital nasional.</p>
                    <p>Tugas utama TNI Siber meliputi:</p>
                    <ul class="ps-3">
                        <li>Melakukan operasi siber untuk kepentingan pertahanan</li>
                        <li>Melindungi infrastruktur kritis negara dari serangan siber</li>
                        <li>Melakukan pengamanan terhadap sistem informasi strategis</li>
                        <li>Memberikan dukungan teknis terhadap unit-unit TNI lainnya</li>
                    </ul>
                `;
            }
            
            // Show the custom overlay
            customOverlay.style.display = 'block';
            
            // Show the modal immediately
            modalElement.style.display = 'block';
            modalElement.classList.add('show');
            document.body.classList.add('modal-open');
            document.body.style.overflow = 'hidden'; // Prevent background scrolling
        }
        
        // Function to close modal
        function closeModal() {
            // Hide modal
            modalElement.style.display = 'none';
            modalElement.classList.remove('show');
            
            // Hide overlay
            customOverlay.style.display = 'none';
            
            // Restore scrolling
            document.body.classList.remove('modal-open');
            document.body.style.overflow = '';
        }
        
        // Event listeners for opening modal
        modalTriggers.forEach(trigger => {
            trigger.addEventListener('click', function(e) {
                e.preventDefault();
                const contentType = this.getAttribute('data-content');
                openModal(contentType);
            });
        });
        
        // Event listeners for closing modal
        closeButtons.forEach(button => {
            button.addEventListener('click', closeModal);
        });
        
        // Close when clicking outside modal
        customOverlay.addEventListener('click', closeModal);
        
        // Close when pressing ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modalElement.classList.contains('show')) {
                closeModal();
            }
        });

        // Fungsi untuk menangani kolom Status yang belum punya data-sort
        const statusColumn = document.querySelector('th.sortable[onclick*="sortTable"]');
        if (statusColumn) {
            statusColumn.addEventListener('click', function() {
                const currentSortBy = document.getElementById('sort_by').value;
                const currentSortDir = document.getElementById('sort_dir').value;
                
                if (currentSortBy === 'status') {
                    if (currentSortDir === 'asc') {
                        document.getElementById('sort_dir').value = 'desc';
                    } else {
                        // Reset to default
                        document.getElementById('sort_by').value = 'created_at';
                        document.getElementById('sort_dir').value = 'desc';
                    }
                } else {
                    document.getElementById('sort_by').value = 'status';
                    document.getElementById('sort_dir').value = 'asc';
                }
                
                document.getElementById('sort-form').submit();
            });
            
            // Juga tambahkan event listener untuk icon di kolom Status
            const statusIcons = statusColumn.querySelectorAll('.sort-icon i');
            statusIcons.forEach(icon => {
                icon.addEventListener('click', function(event) {
                    event.stopPropagation();
                    const isAsc = this.classList.contains('fa-chevron-up');
                    
                    // Jika ikon yang aktif diklik, reset sorting ke default
                    if (this.classList.contains('active')) {
                        document.getElementById('sort_by').value = 'created_at';
                        document.getElementById('sort_dir').value = 'desc';
                    } else {
                        document.getElementById('sort_by').value = 'status';
                        document.getElementById('sort_dir').value = isAsc ? 'asc' : 'desc';
                    }
                    
                    document.getElementById('sort-form').submit();
                });
            });
        }
    });
</script>
@endsection