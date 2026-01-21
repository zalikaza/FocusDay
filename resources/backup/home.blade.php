@extends('layouts.app')

@section('title', 'Beranda - FocusDay')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="fw-bold text-dark mb-1">Hari Ini</h2>
                    <p class="text-muted mb-0">
                        <i class="bi bi-calendar3 me-2"></i>
                        {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                    </p>
                </div>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addTaskModal">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Rencana
                </button>
            </div>
        </div>
    </div>
    
    <!-- Task List -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h5 class="fw-semibold mb-4">Tugas Hari Ini</h5>
                    
                    <div class="list-group list-group-flush">
                        <!-- Task Item 1 -->
                        <div class="list-group-item border-0 px-0 py-3">
                            <div class="d-flex align-items-center">
                                <div class="form-check me-3">
                                    <input class="form-check-input task-checkbox" type="checkbox" id="task1">
                                </div>
                                <div class="flex-grow-1">
                                    <label for="task1" class="task-title mb-1">Meeting dengan Tim Developer</label>
                                    <p class="text-muted small mb-0">
                                        <i class="bi bi-clock me-1"></i>09:00 - 10:30
                                    </p>
                                </div>
                                <span class="badge rounded-pill category-badge category-work">Kerja</span>
                            </div>
                        </div>
                        
                        <!-- Task Item 2 -->
                        <div class="list-group-item border-0 px-0 py-3">
                            <div class="d-flex align-items-center">
                                <div class="form-check me-3">
                                    <input class="form-check-input task-checkbox" type="checkbox" id="task2" checked>
                                </div>
                                <div class="flex-grow-1">
                                    <label for="task2" class="task-title task-completed mb-1">Review Pull Request #234</label>
                                    <p class="text-muted small mb-0">
                                        <i class="bi bi-clock me-1"></i>11:00 - 12:00
                                    </p>
                                </div>
                                <span class="badge rounded-pill category-badge category-work">Kerja</span>
                            </div>
                        </div>
                        
                        <!-- Task Item 3 -->
                        <div class="list-group-item border-0 px-0 py-3">
                            <div class="d-flex align-items-center">
                                <div class="form-check me-3">
                                    <input class="form-check-input task-checkbox" type="checkbox" id="task3">
                                </div>
                                <div class="flex-grow-1">
                                    <label for="task3" class="task-title mb-1">Belajar Laravel Livewire</label>
                                    <p class="text-muted small mb-0">
                                        <i class="bi bi-clock me-1"></i>14:00 - 16:00
                                    </p>
                                </div>
                                <span class="badge rounded-pill category-badge category-learning">Belajar</span>
                            </div>
                        </div>
                        
                        <!-- Task Item 4 -->
                        <div class="list-group-item border-0 px-0 py-3">
                            <div class="d-flex align-items-center">
                                <div class="form-check me-3">
                                    <input class="form-check-input task-checkbox" type="checkbox" id="task4">
                                </div>
                                <div class="flex-grow-1">
                                    <label for="task4" class="task-title mb-1">Olahraga Sore</label>
                                    <p class="text-muted small mb-0">
                                        <i class="bi bi-clock me-1"></i>17:00 - 18:00
                                    </p>
                                </div>
                                <span class="badge rounded-pill category-badge category-personal">Pribadi</span>
                            </div>
                        </div>
                        
                        <!-- Task Item 5 -->
                        <div class="list-group-item border-0 px-0 py-3">
                            <div class="d-flex align-items-center">
                                <div class="form-check me-3">
                                    <input class="form-check-input task-checkbox" type="checkbox" id="task5">
                                </div>
                                <div class="flex-grow-1">
                                    <label for="task5" class="task-title mb-1">Persiapan Presentasi Client</label>
                                    <p class="text-muted small mb-0">
                                        <i class="bi bi-clock me-1"></i>19:00 - 20:00
                                    </p>
                                </div>
                                <span class="badge rounded-pill category-badge category-work">Kerja</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Empty State (hidden when there are tasks) -->
                    <div class="text-center py-5 d-none" id="emptyState">
                        <i class="bi bi-check-circle text-success" style="font-size: 4rem; opacity: 0.3;"></i>
                        <p class="text-muted mt-3">Tidak ada tugas untuk hari ini</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Upcoming Plans Section -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #f0fdf4 0%, #ffffff 100%);">
                <div class="card-body p-4">
                    <h5 class="fw-semibold mb-3">
                        <i class="bi bi-calendar-event me-2 text-success"></i>
                        Rencana Mendatang
                    </h5>
                    
                    <div class="row g-3">
                        <!-- Tomorrow -->
                        <div class="col-md-6">
                            <div class="p-3 bg-white rounded">
                                <p class="fw-semibold text-dark mb-2">Besok</p>
                                <div class="d-flex align-items-center mb-2">
                                    <span class="badge rounded-pill category-badge category-work me-2">Kerja</span>
                                    <small class="text-muted">Sprint Planning Meeting</small>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="badge rounded-pill category-badge category-learning me-2">Belajar</span>
                                    <small class="text-muted">Kursus Online PHP Advanced</small>
                                </div>
                            </div>
                        </div>
                        
                        <!-- This Week -->
                        <div class="col-md-6">
                            <div class="p-3 bg-white rounded">
                                <p class="fw-semibold text-dark mb-2">Minggu Ini</p>
                                <div class="d-flex align-items-center mb-2">
                                    <span class="badge rounded-pill category-badge category-personal me-2">Pribadi</span>
                                    <small class="text-muted">Kunjungan Keluarga</small>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="badge rounded-pill category-badge category-work me-2">Kerja</span>
                                    <small class="text-muted">Deadline Project X</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Task Modal -->
<div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="addTaskModalLabel">Tambah Rencana Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0">
                <form>
                    <div class="mb-3">
                        <label for="taskTitle" class="form-label">Judul Tugas</label>
                        <input type="text" class="form-control" id="taskTitle" placeholder="Masukkan judul tugas">
                    </div>
                    
                    <div class="mb-3">
                        <label for="taskCategory" class="form-label">Kategori</label>
                        <select class="form-select" id="taskCategory">
                            <option selected>Pilih kategori</option>
                            <option value="work">Kerja</option>
                            <option value="learning">Belajar</option>
                            <option value="personal">Pribadi</option>
                        </select>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="taskDate" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="taskDate">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="taskTime" class="form-label">Waktu</label>
                            <input type="time" class="form-control" id="taskTime">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="taskNotes" class="form-label">Catatan (Opsional)</label>
                        <textarea class="form-control" id="taskNotes" rows="3" placeholder="Tambahkan catatan..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success" onclick="addTask()">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Tugas
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Toast Notification -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="successToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                <i class="bi bi-check-circle-fill me-2"></i>
                Rencana berhasil ditambahkan!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    .btn-success {
        background-color: var(--primary-green);
        border-color: var(--primary-green);
        font-weight: 500;
        padding: 0.625rem 1.25rem;
        border-radius: 8px;
        transition: all 0.2s ease;
    }
    
    .btn-success:hover {
        background-color: var(--primary-green-dark);
        border-color: var(--primary-green-dark);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }
    
    .card {
        border-radius: 12px;
        transition: transform 0.2s ease;
    }
    
    .task-checkbox {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        cursor: pointer;
        border: 2px solid #d1d5db;
    }
    
    .task-checkbox:checked {
        background-color: var(--primary-green);
        border-color: var(--primary-green);
    }
    
    .task-title {
        font-weight: 500;
        color: #1f2937;
        cursor: pointer;
        transition: color 0.2s ease;
    }
    
    .task-completed {
        text-decoration: line-through;
        color: #9ca3af !important;
    }
    
    .category-badge {
        padding: 0.4rem 0.9rem;
        font-weight: 500;
        font-size: 0.75rem;
        letter-spacing: 0.3px;
    }
    
    .category-work {
        background-color: #dbeafe;
        color: #1e40af;
    }
    
    .category-learning {
        background-color: #d1fae5;
        color: #065f46;
    }
    
    .category-personal {
        background-color: #fef3c7;
        color: #92400e;
    }
    
    .list-group-item {
        transition: background-color 0.2s ease;
    }
    
    .list-group-item:hover {
        background-color: #f9fafb;
    }
    
    .modal-content {
        border-radius: 16px;
    }
    
    .form-control, .form-select {
        border-radius: 8px;
        border: 1px solid #e5e7eb;
        padding: 0.625rem 0.875rem;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: var(--primary-green);
        box-shadow: 0 0 0 0.2rem rgba(16, 185, 129, 0.15);
    }
    
    .toast {
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
</style>
@endpush

@push('scripts')
<script>
    // Task checkbox toggle
    document.querySelectorAll('.task-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const taskTitle = this.closest('.d-flex').querySelector('.task-title');
            if (this.checked) {
                taskTitle.classList.add('task-completed');
            } else {
                taskTitle.classList.remove('task-completed');
            }
        });
    });
    
    // Add task function
    function addTask() {
        // Close modal
        const modal = bootstrap.Modal.getInstance(document.getElementById('addTaskModal'));
        modal.hide();
        
        // Show toast
        const toast = new bootstrap.Toast(document.getElementById('successToast'));
        toast.show();
        
        // Here you would normally send data to server
        // For demo purposes, we just show the notification
    }
    
    // Auto-show toast on page load (for demo)
    window.addEventListener('load', function() {
        // Uncomment to show toast on page load
        // setTimeout(() => {
        //     const toast = new bootstrap.Toast(document.getElementById('successToast'));
        //     toast.show();
        // }, 500);
    });
</script>
@endpush
