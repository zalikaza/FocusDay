@extends('layouts.app')

@section('title', 'Beranda - FocusDay')

@section('content')
<div class="container-fluid px-0 px-md-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-start align-items-md-center flex-column flex-md-row">
                <div class="mb-3 mb-md-0">
                    <h2 class="fw-bold text-dark mb-1">Hari Ini</h2>
                    <p class="text-muted mb-0">
                        <i class="bi bi-calendar3 me-2"></i>
                        {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                    </p>
                </div>
                <!-- Tombol Style Baru (Hijau Solid) -->
                <button class="btn btn-success btn-add-task shadow-sm" data-bs-toggle="modal" data-bs-target="#addTaskModal">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Rencana
                </button>
            </div>
        </div>
    </div>
    
    <!-- Task List (Struktur dari Kode Lama) -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-semibold mb-0">Tugas Hari Ini</h5>
                        <span class="badge bg-light text-secondary border">5 Tugas</span>
                    </div>
                    
                    <div class="list-group list-group-flush">
                        <!-- Task Item 1 -->
                        <div class="list-group-item border-0 px-0 py-3 rounded">
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
                        <div class="list-group-item border-0 px-0 py-3 rounded">
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
                        <div class="list-group-item border-0 px-0 py-3 rounded">
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
                        <div class="list-group-item border-0 px-0 py-3 rounded">
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
                        <div class="list-group-item border-0 px-0 py-3 rounded">
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
                    
                    <!-- Empty State -->
                    <div class="text-center py-5 d-none" id="emptyState">
                        <i class="bi bi-check-circle text-success" style="font-size: 4rem; opacity: 0.3;"></i>
                        <p class="text-muted mt-3">Tidak ada tugas untuk hari ini</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Upcoming Plans Section (Dari Kode Lama) -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm upcoming-card">
                <div class="card-body p-4">
                    <h5 class="fw-semibold mb-3">
                        <i class="bi bi-calendar-event me-2 text-success"></i>
                        Rencana Mendatang
                    </h5>
                    
                    <div class="row g-3">
                        <!-- Tomorrow -->
                        <div class="col-md-6">
                            <div class="p-3 bg-white rounded shadow-sm h-100">
                                <p class="fw-semibold text-dark mb-3 border-bottom pb-2">Besok</p>
                                <div class="d-flex align-items-center mb-2">
                                    <span class="badge rounded-pill category-badge category-work me-2">Kerja</span>
                                    <small class="text-truncate">Sprint Planning Meeting</small>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="badge rounded-pill category-badge category-learning me-2">Belajar</span>
                                    <small class="text-truncate">Kursus Online PHP Advanced</small>
                                </div>
                            </div>
                        </div>
                        
                        <!-- This Week -->
                        <div class="col-md-6">
                            <div class="p-3 bg-white rounded shadow-sm h-100">
                                <p class="fw-semibold text-dark mb-3 border-bottom pb-2">Minggu Ini</p>
                                <div class="d-flex align-items-center mb-2">
                                    <span class="badge rounded-pill category-badge category-personal me-2">Pribadi</span>
                                    <small class="text-truncate">Kunjungan Keluarga</small>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="badge rounded-pill category-badge category-work me-2">Kerja</span>
                                    <small class="text-truncate">Deadline Project X</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Task Modal - COMPACT VERSION (Kode Baru) -->
<div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <!-- Modal Header Simple -->
            <div class="modal-header border-0 pb-3" style="border-bottom: 1px solid #e5e7eb !important;">
                <div class="w-100 d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="modal-title fw-bold text-dark mb-0" id="addTaskModalLabel">
                            <i class="bi bi-plus-circle-fill me-2" style="color: #10b981;"></i>
                            Rencana Baru
                        </h5>
                        <small class="text-muted">Isi detail tugas kamu</small>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            
            <div class="modal-body p-4 pt-3">
                <form id="taskForm" class="needs-validation" novalidate>
                    <!-- Judul Tugas -->
                    <div class="mb-4">
                        <label for="taskTitle" class="form-label fw-semibold text-dark">
                            <i class="bi bi-card-heading me-1 text-muted" style="font-size: 0.9rem;"></i>
                            Judul Tugas
                        </label>
                        <input type="text" 
                               class="form-control form-control-lg" 
                               id="taskTitle" 
                               placeholder="Contoh: Meeting dengan tim development" 
                               required
                               style="border-radius: 10px; border: 2px solid #e5e7eb; padding: 0.75rem 1rem;">
                        <div class="invalid-feedback">
                            Harap isi judul tugas
                        </div>
                    </div>
                    
                    <!-- Kategori compact dengan inline -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-dark d-flex justify-content-between align-items-center">
                            <span>
                                <i class="bi bi-tag me-1 text-muted" style="font-size: 0.9rem;"></i>
                                Kategori
                            </span>
                            <button type="button" class="btn btn-sm btn-outline-secondary border-0 p-0" 
                                    style="font-size: 0.8rem;" 
                                    onclick="showAddCategory()">
                                <i class="bi bi-plus-circle me-1"></i>Tambah Kategori
                            </button>
                        </label>
                        <div class="d-flex flex-wrap gap-2" id="categorySelection">
                            <input type="radio" class="btn-check" name="taskCategory" id="categoryWork" value="work" autocomplete="off" checked>
                            <label class="btn btn-sm btn-category btn-work" for="categoryWork">
                                <i class="bi bi-briefcase me-1"></i>Kerja
                            </label>
                            
                            <input type="radio" class="btn-check" name="taskCategory" id="categoryLearning" value="learning" autocomplete="off">
                            <label class="btn btn-sm btn-category btn-learning" for="categoryLearning">
                                <i class="bi bi-book me-1"></i>Belajar
                            </label>
                            
                            <input type="radio" class="btn-check" name="taskCategory" id="categoryPersonal" value="personal" autocomplete="off">
                            <label class="btn btn-sm btn-category btn-personal" for="categoryPersonal">
                                <i class="bi bi-person me-1"></i>Pribadi
                            </label>
                            
                            <!-- Kategori tambahan (akan diisi oleh backend/js) -->
                            <div id="additionalCategories"></div>
                        </div>
                    </div>
                    
                    <!-- Tanggal dan Waktu dalam satu baris compact -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-dark mb-3">
                            <i class="bi bi-clock me-1 text-muted" style="font-size: 0.9rem;"></i>
                            Tanggal & Waktu
                        </label>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="bi bi-calendar-date text-muted"></i>
                                    </span>
                                    <input type="date" 
                                           class="form-control border-start-0 ps-1" 
                                           id="taskDate"
                                           required
                                           style="border-radius: 0 8px 8px 0;">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="bi bi-alarm text-muted"></i>
                                    </span>
                                    <input type="time" 
                                           class="form-control border-start-0 ps-1" 
                                           id="taskTime"
                                           style="border-radius: 0 8px 8px 0;">
                                </div>
                            </div>
                        </div>
                        <div class="form-check form-check-inline mt-2">
                            <input class="form-check-input" type="checkbox" id="noSpecificTime">
                            <label class="form-check-label text-muted" for="noSpecificTime" style="font-size: 0.85rem;">
                                Tanpa waktu spesifik
                            </label>
                        </div>
                    </div>
                    
                    <!-- Catatan -->
                    <div class="mb-3">
                        <label for="taskNotes" class="form-label fw-semibold text-dark">
                            <i class="bi bi-sticky me-1 text-muted" style="font-size: 0.9rem;"></i>
                            Catatan <span class="text-muted fw-normal">(Opsional)</span>
                        </label>
                        <textarea class="form-control" 
                                  id="taskNotes" 
                                  rows="2" 
                                  placeholder="Tambahkan detail, link, atau catatan penting..."
                                  style="border-radius: 10px; border: 2px solid #e5e7eb; resize: none;"></textarea>
                        <div class="d-flex justify-content-between mt-1">
                            <small class="text-muted" style="font-size: 0.75rem;">
                                <i class="bi bi-info-circle me-1"></i>
                                Kosongkan waktu untuk tugas tanpa deadline spesifik
                            </small>
                            <small class="text-muted char-count" style="font-size: 0.75rem;">
                                <span id="charCount">0</span>/300
                            </small>
                        </div>
                    </div>
                </form>
                
                <!-- Form tambah kategori (hidden by default) -->
                <div class="border-top mt-4 pt-3 d-none" id="addCategoryForm">
                    <label class="form-label fw-semibold text-dark mb-2">
                        <i class="bi bi-plus-circle me-1 text-success"></i>
                        Tambah Kategori Baru
                    </label>
                    <div class="input-group input-group-sm">
                        <input type="text" 
                               class="form-control" 
                               id="newCategoryName" 
                               placeholder="Nama kategori baru"
                               style="border-radius: 8px 0 0 8px;">
                        <button class="btn btn-outline-success" type="button" onclick="addNewCategory()" style="border-radius: 0 8px 8px 0;">
                            <i class="bi bi-check-lg"></i>
                        </button>
                    </div>
                    <small class="text-muted d-block mt-1" style="font-size: 0.75rem;">
                        Kategori baru akan tersedia untuk tugas selanjutnya
                    </small>
                </div>
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-light btn-lg px-4" data-bs-dismiss="modal" style="border-radius: 10px;">
                    Batal
                </button>
                <button type="button" class="btn btn-success btn-lg px-4" onclick="addTask()" id="submitTaskBtn" style="border-radius: 10px;">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Tugas
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Toast Notification (Kode Baru) -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="successToast" class="toast align-items-center text-white bg-success border-0 shadow" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body d-flex align-items-center">
                <i class="bi bi-check-circle-fill me-2" style="font-size: 1.2rem;"></i>
                <div>
                    <strong>Rencana berhasil ditambahkan!</strong>
                    <div class="small">Tugas telah masuk ke daftar</div>
                </div>
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    /* --- Styles dari Kode Baru (Compact Modal & Button) --- */
    :root {
        --primary-green: #10b981;
        --primary-green-dark: #059669;
        --primary-green-light: #d1fae5;
    }
    
    #addTaskModal .modal-dialog {
        max-width: 560px;
        margin-left: auto;
        margin-right: auto;
        transform: translateY(-18px);
    }

    #addTaskModal .modal-content {
        max-height: calc(100dvh - 2rem);
        overflow: hidden;
    }

    #addTaskModal .modal-body {
        overflow-y: auto;
        -webkit-overflow-scrolling: touch;
    }

    @media (max-width: 576px) {
        #addTaskModal .modal-dialog {
            max-width: calc(100vw - 1rem);
            margin: 0.5rem;
            transform: translateY(-8px);
        }

        #addTaskModal .modal-content {
            max-height: calc(100dvh - 1rem);
        }

        #addTaskModal .modal-body {
            padding: 1rem !important;
        }

        #addTaskModal .form-control-lg {
            font-size: 1rem;
            padding: 0.6rem 0.9rem;
        }

        #addTaskModal .modal-footer .btn.btn-lg {
            font-size: 0.95rem;
            padding: 0.55rem 0.9rem;
        }
    }
    
    /* Button utama dengan warna brand */
    .btn-add-task,
    .btn-success {
        background-color: var(--primary-green) !important;
        border-color: var(--primary-green) !important;
        font-weight: 500;
        padding: 0.625rem 1.25rem;
        border-radius: 10px;
        transition: all 0.2s ease;
    }

    .btn-add-task:hover,
    .btn-success:hover {
        background-color: var(--primary-green-dark) !important;
        border-color: var(--primary-green-dark) !important;
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.25);
    }
    
    /* Modal styling compact */
    .modal-content {
        border-radius: 16px;
        border: 1px solid #e5e7eb;
    }
    
    /* Category buttons compact */
    .btn-category {
        padding: 0.4rem 0.8rem;
        border-radius: 20px;
        border: 2px solid #e5e7eb;
        font-size: 0.85rem;
        transition: all 0.2s ease;
    }
    
    .btn-work {
        color: #1e40af;
        background-color: #dbeafe;
    }
    
    .btn-learning {
        color: #065f46;
        background-color: #d1fae5;
    }
    
    .btn-personal {
        color: #92400e;
        background-color: #fef3c7;
    }
    
    .btn-check:checked + .btn-category {
        border-color: var(--primary-green);
        box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.2);
        transform: translateY(-1px);
    }
    
    /* Input focus states */
    .form-control:focus,
    .form-select:focus {
        border-color: var(--primary-green) !important;
        box-shadow: 0 0 0 0.2rem rgba(16, 185, 129, 0.15) !important;
    }
    
    /* Checkbox styling */
    .form-check-input:checked {
        background-color: var(--primary-green);
        border-color: var(--primary-green);
    }
    
    .form-check-input:focus {
        border-color: var(--primary-green);
        box-shadow: 0 0 0 0.2rem rgba(16, 185, 129, 0.25);
    }
    
    /* Toast dengan warna brand */
    #successToast {
        background-color: var(--primary-green) !important;
    }
    
    /* Animasi untuk kategori baru */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .category-added {
        animation: fadeInUp 0.3s ease;
    }
    
    /* Compact form elements */
    .input-group-sm .form-control,
    .input-group-sm .input-group-text {
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
    }
    
    /* Hover effects */
    .btn-outline-secondary:hover {
        color: var(--primary-green) !important;
        border-color: var(--primary-green) !important;
    }

    html[data-theme="dark"] .task-title {
        color: #f1f5f9;
    }

    html[data-theme="dark"] .task-completed {
        color: #94a3b8 !important;
    }

    html[data-theme="dark"] .list-group-item:hover {
        background-color: rgba(255, 255, 255, 0.03);
    }

    html[data-theme="dark"] #addTaskModal .modal-header {
        border-bottom: 1px solid #1f2937 !important;
    }

    html[data-theme="dark"] #addTaskModal .btn.btn-light {
        background-color: rgba(255, 255, 255, 0.04);
        border-color: #1f2937;
        color: #e2e8f0;
    }

    html[data-theme="dark"] #addTaskModal .form-control,
    html[data-theme="dark"] #addTaskModal .form-select {
        border-color: #1f2937 !important;
    }

    html[data-theme="dark"] #addTaskModal textarea.form-control {
        border-color: #1f2937 !important;
    }

    html[data-theme="dark"] #addTaskModal .form-check-label {
        color: #cbd5e1;
    }

    html[data-theme="dark"] #addTaskModal .btn-outline-secondary {
        color: #94a3b8;
    }

    html[data-theme="dark"] #addTaskModal .btn-outline-secondary:hover {
        color: var(--primary-green) !important;
    }
    
    /* --- Styles dari Kode Lama (Untuk Tampilan Task List) --- */
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
</style>
@endpush

@push('scripts')
<script>
    // --- Logic dari Kode Lama (Checkbox Toggle & Stats) ---
    document.querySelectorAll('.task-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const taskTitle = this.closest('.d-flex').querySelector('.task-title');
            
            if (this.checked) {
                taskTitle.classList.add('task-completed');
                updateSidebarStats('completed');
            } else {
                taskTitle.classList.remove('task-completed');
                updateSidebarStats('pending');
            }
        });
    });

    function updateSidebarStats(status) {
        // Mengambil elemen statistik dari Sidebar (Layout App)
        const totalValue = document.querySelector('.stat-value:not(.success):not(.warning)'); // Angka pertama (Total)
        const completedValue = document.querySelector('.stat-value.success');
        const pendingValue = document.querySelector('.stat-value.warning');
        
        if (totalValue && completedValue && pendingValue) {
            let total = parseInt(totalValue.textContent);
            let completed = parseInt(completedValue.textContent);
            let pending = parseInt(pendingValue.textContent);
            
            // Logika perubahan angka
            if (status === 'completed') {
                completed++;
                pending--;
            } else {
                completed--;
                pending++;
            }
            
            // Update DOM
            completedValue.textContent = completed;
            pendingValue.textContent = pending;
            
            // Visual feedback
            completedValue.style.color = '#fff';
            setTimeout(() => completedValue.style.color = '', 300);
        }
    }

    // --- Logic dari Kode Baru (Form Validation & UI) ---
    
    // Form validation
    document.getElementById('taskForm').addEventListener('submit', function(event) {
        event.preventDefault();
        if (!this.checkValidity()) {
            event.stopPropagation();
            this.classList.add('was-validated');
            return;
        }
        addTask();
    });
    
    // Character count for notes
    document.getElementById('taskNotes').addEventListener('input', function() {
        const count = this.value.length;
        document.getElementById('charCount').textContent = count;
        
        if (count > 280) {
            document.querySelector('.char-count').classList.add('text-danger');
        } else {
            document.querySelector('.char-count').classList.remove('text-danger');
        }
    });
    
    // No specific time checkbox (Fitur Baru)
    document.getElementById('noSpecificTime').addEventListener('change', function() {
        const timeInput = document.getElementById('taskTime');
        if (this.checked) {
            timeInput.disabled = true;
            timeInput.value = '';
            timeInput.style.backgroundColor = '#f8f9fa';
        } else {
            timeInput.disabled = false;
            timeInput.style.backgroundColor = '';
        }
    });
    
    // Show add category form
    function showAddCategory() {
        const form = document.getElementById('addCategoryForm');
        form.classList.toggle('d-none');
        
        if (!form.classList.contains('d-none')) {
            document.getElementById('newCategoryName').focus();
        }
    }
    
    // Add new category (simulasi untuk frontend)
    function addNewCategory() {
        const categoryName = document.getElementById('newCategoryName').value.trim();
        
        if (!categoryName) {
            alert('Mohon isi nama kategori');
            return;
        }
        
        // Generate random color for new category
        const colors = [
            {bg: '#fef3c7', text: '#92400e', icon: 'bi-palette'},
            {bg: '#e0e7ff', text: '#3730a3', icon: 'bi-star'},
            {bg: '#fce7f3', text: '#9d174d', icon: 'bi-heart'},
            {bg: '#dcfce7', text: '#166534', icon: 'bi-check-circle'}
        ];
        
        const color = colors[Math.floor(Math.random() * colors.length)];
        const categoryId = 'category' + Date.now();
        
        // Add new category radio button
        const newCategory = document.createElement('div');
        newCategory.className = 'category-added';
        newCategory.innerHTML = `
            <input type="radio" class="btn-check" name="taskCategory" id="${categoryId}" value="${categoryName.toLowerCase()}" autocomplete="off">
            <label class="btn btn-sm btn-category" for="${categoryId}" style="background-color: ${color.bg}; color: ${color.text};">
                <i class="bi ${color.icon} me-1"></i>${categoryName}
            </label>
        `;
        
        document.getElementById('additionalCategories').appendChild(newCategory);
        
        // Reset form
        document.getElementById('newCategoryName').value = '';
        document.getElementById('addCategoryForm').classList.add('d-none');
        
        // Show temporary message
        showTempMessage('Kategori "' + categoryName + '" berhasil ditambahkan!', 'success');
    }
    
    // Temporary message function
    function showTempMessage(message, type) {
        const toast = document.createElement('div');
        toast.className = `position-fixed bottom-0 start-50 translate-middle-x mb-3 alert alert-${type} border-0 shadow`;
        toast.style.zIndex = '1060';
        toast.innerHTML = `
            <div class="d-flex align-items-center">
                <i class="bi ${type === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-circle-fill'} me-2"></i>
                <span>${message}</span>
            </div>
        `;
        
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.remove();
        }, 3000);
    }
    
    // Gabungan Fungsi Add Task
    function addTask() {
        const form = document.getElementById('taskForm');
        
        if (!form.checkValidity()) {
            form.classList.add('was-validated');
            return;
        }
        
        // Get form values (dari kode baru)
        const isNoTime = document.getElementById('noSpecificTime').checked;
        const taskData = {
            title: document.getElementById('taskTitle').value,
            category: document.querySelector('input[name="taskCategory"]:checked')?.value,
            date: document.getElementById('taskDate').value,
            time: isNoTime ? null : document.getElementById('taskTime').value,
            notes: document.getElementById('taskNotes').value,
            hasNoSpecificTime: isNoTime
        };
        
        // Close modal
        const modal = bootstrap.Modal.getInstance(document.getElementById('addTaskModal'));
        modal.hide();
        
        // Reset form (termasuk logika no time)
        form.reset();
        form.classList.remove('was-validated');
        document.getElementById('charCount').textContent = '0';
        
        const timeInput = document.getElementById('taskTime');
        timeInput.disabled = false;
        timeInput.style.backgroundColor = '';
        
        // Show toast
        const toast = new bootstrap.Toast(document.getElementById('successToast'));
        toast.show();
        
        // Simulasi Update Sidebar Stats (karena data belum benar-benar tersimpan ke DB di demo ini)
        const totalValue = document.querySelector('.stat-value:not(.success):not(.warning)');
        const pendingValue = document.querySelector('.stat-value.warning');
        
        if (totalValue && pendingValue) {
            let total = parseInt(totalValue.textContent) + 1;
            let pending = parseInt(pendingValue.textContent) + 1;
            
            totalValue.textContent = total;
            pendingValue.textContent = pending;
        }

        // Button animation (Feedback visual)
        const submitBtn = document.getElementById('submitTaskBtn');
        const originalHTML = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="bi bi-check-circle me-2"></i>Berhasil!';
        submitBtn.disabled = true;
        
        setTimeout(() => {
            submitBtn.innerHTML = originalHTML;
            submitBtn.disabled = false;
        }, 2000);
        
        // Console log data (Untuk debugging backend nanti)
        console.log('Task added:', taskData);
    }
    
    // Set minimum date to today & Init
    document.addEventListener('DOMContentLoaded', function() {
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('taskDate').value = today;
        document.getElementById('taskDate').min = today;
        
        // Auto-focus on modal open
        const modal = document.getElementById('addTaskModal');
        modal.addEventListener('shown.bs.modal', function() {
            document.getElementById('taskTitle').focus();
        });
        
        // Load categories from localStorage (simulasi)
        loadSavedCategories();
    });
    
    // Simulasi load kategori dari storage
    function loadSavedCategories() {
        const savedCategories = JSON.parse(localStorage.getItem('userCategories')) || [];
        
        savedCategories.forEach(category => {
            const categoryId = 'category' + category.id;
            const newCategory = document.createElement('div');
            newCategory.innerHTML = `
                <input type="radio" class="btn-check" name="taskCategory" id="${categoryId}" value="${category.value}" autocomplete="off">
                <label class="btn btn-sm btn-category" for="${categoryId}" style="background-color: ${category.bg}; color: ${category.text};">
                    <i class="bi ${category.icon} me-1"></i>${category.name}
                </label>
            `;
            document.getElementById('additionalCategories').appendChild(newCategory);
        });
    }
</script>
@endpush