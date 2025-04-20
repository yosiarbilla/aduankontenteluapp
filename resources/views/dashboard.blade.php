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
    }
    .text-success {
        color: #28a745;
        font-weight: bold;
    
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
            <div class="table-responsive table-borderless">
                <table class="table table-borderless">
                    <thead>
                        <tr>
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
                        @forelse($aduan as $item)
                        <tr>
                            <td class="text-primary">{{ $item->ticket_id }}</td>
                            <td>{{ $item->kategori }}</td>
                            <td>
                                @if($item->prioritas == 'Normal')
                                    <span class="badge bg-success">Normal</span>
                                @elseif($item->prioritas == 'Medium' || $item->prioritas == 'High')
                                    <span class="badge bg-warning">{{ $item->prioritas }}</span>
                                @elseif($item->prioritas == 'Urgent')
                                    <span class="badge bg-danger">Urgent</span>
                                @else
                                    <span class="badge bg-secondary">{{ $item->prioritas }}</span>
                                @endif
                            </td>
                            <td>{{ $item->nomor_surat }}</td>
                            <td>{{ $item->instansi }}</td>
                            <td>{{ $item->created_at->format('d/m/Y') }}</td>
                            <td>{{ $item->updated_at->diffForHumans() }}</td>
                            <td><a href="{{ route('aduan.export-pdf', $item->id) }}" class="btn btn-sm btn-outline-success">Unduh</a></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-3">Belum ada data aduan</td>
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
                    <li>1.  Buka menu Aduan</li>
                    <li>2. Pilih Buat Aduan</li>
                    <li>3. Isi form sesuai informasi yang ada</li>
                    <li>4. Pastikan seluruh informasi telah benar</li>
                    <li>5. Pilih Simpan Draft untuk berhenti mengisi sementara, atau pilih Kirim untuk menyelesaikan pembuatan aduan</li>
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
        
        // Modal functionality here...
        const modalElement = document.getElementById('infoModal');
        const customOverlay = document.getElementById('custom-modal-overlay');
        const modalTriggers = document.querySelectorAll('.modal-trigger');
        const closeButtons = document.querySelectorAll('.close-modal');
        
        // Function to open modal
        function openModal() {
            // Show the custom overlay
            customOverlay.style.display = 'block';
            
            // Show the modal with a slight delay for the overlay
            setTimeout(() => {
                modalElement.style.display = 'block';
                document.body.classList.add('modal-open');
                document.body.style.overflow = 'hidden'; // Prevent background scrolling
            }, 50);
        }
        
        // Function to close modal
        function closeModal() {
            // Hide modal
            modalElement.style.display = 'none';
            
            // Hide overlay
            customOverlay.style.display = 'none';
            
            // Restore scrolling
            document.body.classList.remove('modal-open');
            document.body.style.overflow = '';
            
            // Clean up any Bootstrap modal remnants
            const backdrops = document.querySelectorAll('.modal-backdrop');
            backdrops.forEach(backdrop => {
                backdrop.parentNode.removeChild(backdrop);
            });
        }
        
        // Event listeners for opening modal
        modalTriggers.forEach(trigger => {
            trigger.addEventListener('click', function(e) {
                e.preventDefault();
                openModal();
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
            if (e.key === 'Escape' && modalElement.style.display === 'block') {
                closeModal();
            }
        });
    });
</script>
@endsection
