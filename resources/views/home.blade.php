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
    
    <!-- Task List dengan Section Terselesaikan -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <!-- Section Tugas Aktif -->
                    <div class="mb-5" id="activeTasksSection">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="fw-semibold mb-0">Tugas Hari Ini</h5>
                            <span class="badge bg-light text-secondary border" id="activeTasksCount">5 Tugas</span>
                        </div>
                        
                        <div class="list-group list-group-flush" id="activeTasksList">
                            <!-- Task Item 1 -->
                            <div class="list-group-item border-0 px-0 py-3 rounded task-item" data-task-id="1">
                                <div class="d-flex align-items-center">
                                    <div class="form-check me-3">
                                        <input class="form-check-input task-checkbox" type="checkbox" id="task1" data-completed="false">
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
                            <div class="list-group-item border-0 px-0 py-3 rounded task-item" data-task-id="2">
                                <div class="d-flex align-items-center">
                                    <div class="form-check me-3">
                                        <input class="form-check-input task-checkbox" type="checkbox" id="task2" checked data-completed="true">
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
                            <div class="list-group-item border-0 px-0 py-3 rounded task-item" data-task-id="3">
                                <div class="d-flex align-items-center">
                                    <div class="form-check me-3">
                                        <input class="form-check-input task-checkbox" type="checkbox" id="task3" data-completed="false">
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
                            <div class="list-group-item border-0 px-0 py-3 rounded task-item" data-task-id="4">
                                <div class="d-flex align-items-center">
                                    <div class="form-check me-3">
                                        <input class="form-check-input task-checkbox" type="checkbox" id="task4" data-completed="false">
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
                            <div class="list-group-item border-0 px-0 py-3 rounded task-item" data-task-id="5">
                                <div class="d-flex align-items-center">
                                    <div class="form-check me-3">
                                        <input class="form-check-input task-checkbox" type="checkbox" id="task5" data-completed="false">
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
                    </div>
                    
                    <!-- Section Tugas Terselesaikan -->
                    <div class="completed-section" id="completedTasksSection" style="display: none;">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="fw-semibold mb-0 text-success">
                                <i class="bi bi-check-circle me-2"></i>Terselesaikan
                            </h5>
                            <span class="badge bg-success-subtle text-success border" id="completedTasksCount">0 Tugas</span>
                        </div>
                        
                        <div class="list-group list-group-flush" id="completedTasksList">
                            <!-- Completed tasks will be moved here dynamically -->
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
    
    <!-- Upcoming Plans Section -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm upcoming-card">
                <div class="card-body p-4">
                    <h5 class="fw-semibold mb-3">
                        <i class="bi bi-calendar-event me-2 text-success"></i>
                        Rencana Mendatang
                    </h5>
                    
                    <div class="row g-3">
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

<!-- Add Task Modal - UPDATED STYLE & POSITIONING -->
<div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <!-- Modal Header -->
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
                        <div class="invalid-feedback">Harap isi judul tugas</div>
                    </div>
                    
                    <!-- Kategori (WARNA ASLI DIPERTAHANKAN) -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-dark d-flex justify-content-between align-items-center">
                            <span>
                                <i class="bi bi-tag me-1 text-muted" style="font-size: 0.9rem;"></i>
                                Kategori
                            </span>
                            <button type="button" class="btn btn-sm btn-outline-secondary border-0 p-0" 
                                    style="font-size: 0.8rem;" onclick="showAddCategory()">
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
                            
                            <div id="additionalCategories"></div>
                        </div>
                    </div>
                    
                    <!-- WIDGET TANGGAL & WAKTU (THEME ADAPTIVE & CENTERED CALENDAR) -->
                    <div class="mb-4" id="datetimeSection">
                        <label class="form-label fw-semibold text-dark mb-3">
                            <i class="bi bi-clock me-1 text-muted" style="font-size: 0.9rem;"></i>
                            Tanggal & Waktu
                        </label>
                        
                        <div class="datetime-wrapper">
                            <!-- 1. BAGIAN TANGGAL -->
                            <div class="date-section" id="dateWidget">
                                <div class="custom-input-box" id="dateDisplayBox">
                                    <span class="date-display-text" id="dateText">Thursday, January 8</span>
                                    
                                    <!-- CALENDAR POPUP (CENTERED) -->
                                    <div class="calendar-popup" id="calendarPopup">
                                        <div class="calendar-header">
                                            <button type="button" class="calendar-nav-btn" id="prevMonth">&lt;</button>
                                            <span class="calendar-month-title" id="calendarTitle">January 2026</span>
                                            <button type="button" class="calendar-nav-btn" id="nextMonth">&gt;</button>
                                        </div>
                                        <div class="calendar-grid">
                                            <div class="calendar-day-label">Su</div>
                                            <div class="calendar-day-label">Mo</div>
                                            <div class="calendar-day-label">Tu</div>
                                            <div class="calendar-day-label">We</div>
                                            <div class="calendar-day-label">Th</div>
                                            <div class="calendar-day-label">Fr</div>
                                            <div class="calendar-day-label">Sa</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- 2. BAGIAN WAKTU -->
                            <div class="time-section">
                                <div class="custom-input-box" id="timeDisplayBox">
                                    <div class="time-input-group" id="startTimeGroup">
                                        <input type="text" id="startTimeInput" value="7:30pm" placeholder="Start" autocomplete="off">
                                        <div class="time-dropdown" id="startTimeDropdown"></div>
                                    </div>
                                    
                                    <span class="time-separator">–</span>
                                    
                                    <div class="time-input-group" id="endTimeGroup">
                                        <input type="text" id="endTimeInput" value="8:30pm" placeholder="End" autocomplete="off">
                                        <div class="time-dropdown" id="endTimeDropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-check form-check-inline mt-2" style="margin-left: 5px;">
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

<!-- Toast Notification -->
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
    /* --- VARIABLES & BASE STYLES --- */
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
    #addTaskModal .modal-content { border-radius: 16px; }
    #addTaskModal .modal-body { position: relative; overflow-y: auto; max-height: 70vh; }

    /* --- BUTTONS & FORM UTILS --- */
    .btn-add-task, .btn-success {
        background-color: var(--primary-green) !important;
        border-color: var(--primary-green) !important;
        font-weight: 500;
        border-radius: 10px;
        transition: all 0.2s ease;
    }
    .btn-add-task:hover, .btn-success:hover {
        background-color: var(--primary-green-dark) !important;
        transform: translateY(-1px);
    }

    /* --- CATEGORY BUTTONS (ORIGINAL COLORS) --- */
    .btn-category {
        padding: 0.4rem 0.8rem;
        border-radius: 20px;
        border: 2px solid transparent; /* Border handled by color */
        font-size: 0.85rem;
        transition: all 0.2s ease;
        font-weight: 500;
    }
    
    /* WARNA ASLI KERJA */
    .btn-work { color: #1e40af; background-color: #dbeafe; border-color: #dbeafe; }
    
    /* WARNA ASLI BELAJAR */
    .btn-learning { color: #065f46; background-color: #d1fae5; border-color: #d1fae5; }
    
    /* WARNA ASLI PRIBADI */
    .btn-personal { color: #92400e; background-color: #fef3c7; border-color: #fef3c7; }
    
    .btn-check:checked + .btn-category {
        border-color: var(--primary-green); /* Border hijau saat dipilih */
        box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.2);
        transform: translateY(-1px);
    }

    /* --- CATEGORY BADGES (TASK LIST) --- */
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

    /* --- TASK COMPLETED STYLES --- */
    .task-title {
        font-size: 1rem;
        font-weight: 500;
        color: #111827;
        cursor: pointer;
        transition: all 0.2s ease;
        margin-bottom: 0.25rem;
    }

    .task-completed {
        text-decoration: line-through !important;
        text-decoration-thickness: 2px !important;
        text-decoration-color: #10b981 !important;
        color: #9ca3af !important;
        opacity: 0.7;
    }

    /* Dark mode support */
    html[data-theme="dark"] .task-title {
        color: #f9fafb;
    }

    html[data-theme="dark"] .task-completed {
        color: #9ca3af !important;
    }

    /* Custom checkbox styling */
    .form-check-input.task-checkbox {
        width: 1.2rem;
        height: 1.2rem;
        cursor: pointer;
        border: 2px solid #d1d5db;
        transition: all 0.2s ease;
    }

    .form-check-input.task-checkbox:checked {
        background-color: #10b981;
        border-color: #10b981;
    }

    .form-check-input.task-checkbox:focus {
        box-shadow: 0 0 0 0.25rem rgba(16, 185, 129, 0.25);
    }

    /* --- TASK ANIMATIONS --- */
    .task-item {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .task-item:hover {
        background-color: rgba(16, 185, 129, 0.05);
        transform: translateY(-1px);
    }

    .completed-section {
        animation: slideDown 0.3s ease-out;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Success badge for completed section */
    .bg-success-subtle {
        background-color: rgba(16, 185, 129, 0.1) !important;
        color: #059669 !important;
        border-color: rgba(16, 185, 129, 0.2) !important;
    }

    /* --- WIDGET STYLING (THEME ADAPTIVE) --- */
    .datetime-wrapper { display: flex; gap: 12px; margin-bottom: 1.5rem; }

    /* 1. DEFAULT (LIGHT MODE) - PUTIH BERSIH */
    .custom-input-box {
        background-color: #ffffff;
        border: 1px solid #e5e7eb; /* Border abu-abu halus */
        color: #111827; /* Teks Hitam */
        border-radius: 10px;
        padding: 12px 16px;
        cursor: pointer;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        user-select: none;
        min-height: 48px;
        transition: all 0.2s;
        box-shadow: 0 1px 2px rgba(0,0,0,0.05); /* Shadow halus */
    }

    .custom-input-box:hover {
        border-color: #d1d5db;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    /* Active State: Border Hijau */
    .custom-input-box.active {
        border-color: var(--primary-green) !important;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.15) !important;
    }

    /* 2. DARK MODE OVERRIDE - KOTAK GELAP */
    html[data-theme="dark"] .custom-input-box {
        background-color: #374151;
        border-color: #4b5563;
        color: #f9fafb; /* Teks Putih */
        box-shadow: none;
    }
    
    html[data-theme="dark"] .custom-input-box:hover {
        background-color: #4b5563;
    }

    /* Input Elements Styling (Teks Waktu) */
    .date-display-text { font-size: 0.95rem; font-weight: 500; }
    
    .time-section { flex: 1.5; display: flex; align-items: center; justify-content: center; gap: 8px; }
    .time-input-group { display: flex; align-items: center; gap: 4px; padding: 2px 6px; border-radius: 6px; position: relative; cursor: text; min-width: 85px; justify-content: center; }
    
    /* Light Mode Input Background (Transparan di atas kotak putih) */
    html:not([data-theme="dark"]) .time-input-group {
        background: rgba(0,0,0,0.03); /* Abu sangat tipis */
    }
    html:not([data-theme="dark"]) .time-input-group:hover {
        background: rgba(0,0,0,0.06);
    }

    /* Dark Mode Input Background */
    html[data-theme="dark"] .time-input-group {
        background: rgba(255,255,255,0.1);
    }
    html[data-theme="dark"] .time-input-group:hover {
        background: rgba(255,255,255,0.2);
    }

    .time-input-group input { background: transparent; border: none; width: 100%; outline: none; text-align: center; font-weight: 500; font-size: 0.9rem; text-transform: lowercase; cursor: text; }
    
    /* Color Teks Waktu (Adaptif) */
    html:not([data-theme="dark"]) .time-input-group input { color: #111827; }
    html[data-theme="dark"] .time-input-group input { color: #ffffff; }
    
    .time-separator { opacity: 0.5; font-weight: 300; pointer-events: none; }

    /* --- CALENDAR POPUP (CENTERED) --- */
    .calendar-popup {
        position: fixed; /* FIXED agar di tengah layar */
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%); /* Posisi absolut tengah */
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        width: 320px;
        z-index: 2000; /* Sangat tinggi di atas modal */
        padding: 20px;
        display: none;
        border: 1px solid #e5e7eb;
        animation: fadeInScale 0.2s cubic-bezier(0.16, 1, 0.3, 1);
    }
    
    html[data-theme="dark"] .calendar-popup {
        background: #1f2937;
        border-color: #374151;
    }

    .calendar-popup.show { display: block; }
    .calendar-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
    .calendar-month-title { font-weight: 700; font-size: 1.1rem; }
    
    /* Calendar Colors Adaptif */
    html:not([data-theme="dark"]) .calendar-month-title { color: #111827; }
    html[data-theme="dark"] .calendar-month-title { color: #f3f4f6; }

    .calendar-nav-btn { background: none; border: none; cursor: pointer; padding: 4px; border-radius: 50%; transition: background 0.2s; color: #6b7280; }
    .calendar-nav-btn:hover { background: #f3f4f6; color: #111827; }
    html[data-theme="dark"] .calendar-nav-btn:hover { background: #374151; color: white; }

    .calendar-grid { display: grid; grid-template-columns: repeat(7, 1fr); gap: 4px; text-align: center; }
    .calendar-day-label { font-size: 0.75rem; font-weight: 600; padding-bottom: 10px; text-transform: uppercase; color: #9ca3af; }
    
    .calendar-day { width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; font-size: 0.95rem; border-radius: 50%; cursor: pointer; margin: 0 auto; transition: all 0.2s; }
    
    /* Calendar Day Colors (Light Mode) */
    html:not([data-theme="dark"]) .calendar-day { color: #374151; }
    html:not([data-theme="dark"]) .calendar-day:hover:not(.selected) { background-color: #f3f4f6; }
    html:not([data-theme="dark"]) .calendar-day.other-month { color: #e5e7eb; }
    
    /* Calendar Day Colors (Dark Mode) */
    html[data-theme="dark"] .calendar-day { color: #d1d5db; }
    html[data-theme="dark"] .calendar-day:hover:not(.selected) { background-color: #374151; }
    html[data-theme="dark"] .calendar-day.other-month { color: #374151; }

    .calendar-day.selected { background-color: var(--primary-green) !important; color: white !important; font-weight: 600; box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.4); }
    .calendar-day.today { border: 2px solid var(--primary-green); }
    .calendar-day.empty { cursor: default; }

    /* --- TIME DROPDOWN (ANCHORED TO INPUT) --- */
    .time-dropdown {
        position: absolute;
        top: 110%; left: 0;
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        width: 130px;
        max-height: 250px;
        overflow-y: auto;
        z-index: 2000;
        display: none;
        border: 1px solid #e5e7eb;
        padding: 4px;
    }
    
    html[data-theme="dark"] .time-dropdown {
        background: #1f2937;
        border-color: #374151;
    }

    .time-dropdown.show { display: block; }
    .time-option { padding: 6px 10px; font-size: 0.85rem; border-radius: 4px; cursor: pointer; text-transform: lowercase; transition: all 0.1s; }
    
    html:not([data-theme="dark"]) .time-option { color: #374151; }
    html:not([data-theme="dark"]) .time-option:hover { background-color: #f3f4f6; color: var(--primary-green); }
    
    html[data-theme="dark"] .time-option { color: #e5e7eb; }
    html[data-theme="dark"] .time-option:hover { background-color: #374151; color: var(--primary-green); }

    .time-option.highlighted { background-color: var(--primary-green); color: white; }

    /* Animation */
    @keyframes fadeInScale {
        from { opacity: 0; transform: translate(-50%, -45%); }
        to { opacity: 1; transform: translate(-50%, -50%); }
    }

    /* Disabled State */
    .datetime-wrapper.disabled .custom-input-box { opacity: 0.5; pointer-events: none; filter: grayscale(0.8); }

    /* Responsive */
    @media (max-width: 576px) {
        .datetime-wrapper { flex-direction: column; }
        .date-section, .time-section { width: 100%; flex: auto; }
    }
</style>
@endpush

@push('scripts')
<script>
    // ========================
    // TASK COMPLETION LOGIC
    // ========================
    function initializeTaskCheckboxes() {
        document.querySelectorAll('.task-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const taskItem = this.closest('.task-item');
                const taskTitle = taskItem.querySelector('.task-title');
                const taskId = taskItem.getAttribute('data-task-id');
                
                if (this.checked) {
                    // Animasi fade out untuk berpindah
                    taskItem.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                    taskItem.style.opacity = '0.5';
                    taskItem.style.transform = 'translateX(-10px)';
                    
                    setTimeout(() => {
                        // Pindahkan task ke section Terselesaikan
                        moveTaskToCompleted(taskItem, taskId);
                        updateTaskCounters();
                    }, 300);
                } else {
                    // Jika dicentang ulang, pindah kembali ke aktif
                    taskTitle.classList.remove('task-completed');
                    moveTaskToActive(taskItem, taskId);
                    updateTaskCounters();
                }
            });
        });
    }

    function moveTaskToCompleted(taskItem, taskId) {
        const completedList = document.getElementById('completedTasksList');
        const taskTitle = taskItem.querySelector('.task-title');
        
        // Tambah class completed
        taskTitle.classList.add('task-completed');
        
        // Update checkbox attribute
        const checkbox = taskItem.querySelector('.task-checkbox');
        checkbox.setAttribute('data-completed', 'true');
        
        // Pindahkan ke list completed
        completedList.appendChild(taskItem);
        
        // Tampilkan section Terselesaikan jika sebelumnya hidden
        const completedSection = document.getElementById('completedTasksSection');
        completedSection.style.display = 'block';
        
        // Animasi fade in
        setTimeout(() => {
            taskItem.style.opacity = '1';
            taskItem.style.transform = 'translateX(0)';
        }, 10);
    }

    function moveTaskToActive(taskItem, taskId) {
        const activeList = document.getElementById('activeTasksList');
        
        // Update checkbox attribute
        const checkbox = taskItem.querySelector('.task-checkbox');
        checkbox.setAttribute('data-completed', 'false');
        
        // Pindahkan ke list aktif
        activeList.appendChild(taskItem);
        
        // Sembunyikan section Terselesaikan jika tidak ada task
        updateCompletedSectionVisibility();
    }

    function updateTaskCounters() {
        const activeTasks = document.querySelectorAll('#activeTasksList .task-item').length;
        const completedTasks = document.querySelectorAll('#completedTasksList .task-item').length;
        
        // Update counters
        document.getElementById('activeTasksCount').textContent = `${activeTasks} Tugas`;
        document.getElementById('completedTasksCount').textContent = `${completedTasks} Tugas`;
        
        // Tampilkan empty state jika tidak ada task aktif
        const emptyState = document.getElementById('emptyState');
        if (activeTasks === 0 && completedTasks === 0) {
            emptyState.classList.remove('d-none');
        } else {
            emptyState.classList.add('d-none');
        }
        
        // Update sidebar badge secara realtime
        updateSidebarBadge();
    }
    
    function updateSidebarBadge() {
        const sidebarBadge = document.getElementById('sidebarBadge');
        if (!sidebarBadge) return;
        
        // Hitung task yang belum selesai (pending) = task di activeTasksList yang checkboxnya TIDAK di-check
        const pendingTasks = document.querySelectorAll('#activeTasksList .task-item .task-checkbox:not(:checked)').length;
        
        // Simpan ke localStorage agar bisa dibaca di halaman lain
        if (typeof window.savePendingTasksCount === 'function') {
            window.savePendingTasksCount(pendingTasks);
        } else {
            // Fallback jika fungsi global belum tersedia
            localStorage.setItem('focusday.pendingTasks', pendingTasks.toString());
        }
        
        if (pendingTasks > 0) {
            // Tampilkan badge dengan jumlah pending tasks
            sidebarBadge.textContent = pendingTasks;
            sidebarBadge.style.display = '';
        } else {
            // Sembunyikan badge jika semua task sudah selesai
            sidebarBadge.style.display = 'none';
        }
    }

    function updateCompletedSectionVisibility() {
        const completedSection = document.getElementById('completedTasksSection');
        const completedTasks = document.querySelectorAll('#completedTasksList .task-item').length;
        
        if (completedTasks > 0) {
            completedSection.style.display = 'block';
        } else {
            completedSection.style.display = 'none';
        }
    }

    // ========================
    // FORM VALIDATION & UI
    // ========================
    document.getElementById('taskForm').addEventListener('submit', function(event) {
        event.preventDefault();
        if (!this.checkValidity()) { event.stopPropagation(); this.classList.add('was-validated'); return; }
        addTask();
    });
    
    document.getElementById('taskNotes').addEventListener('input', function() {
        document.getElementById('charCount').textContent = this.value.length;
    });
    
    document.getElementById('noSpecificTime').addEventListener('change', function() {
        const wrapper = document.getElementById('datetimeSection');
        const timeInputs = document.querySelectorAll('#startTimeInput, #endTimeInput');
        if (this.checked) {
            wrapper.classList.add('disabled');
            timeInputs.forEach(input => { input.value = ''; input.disabled = true; });
        } else {
            wrapper.classList.remove('disabled');
            timeInputs.forEach(input => {
                input.value = (input.id === 'startTimeInput' ? '7:30pm' : '8:30pm');
                input.disabled = false;
            });
        }
    });

    // ========================
    // CATEGORY LOGIC
    // ========================
    const STORAGE_KEY_CATEGORIES = 'focusday.categories';

    function loadCustomCategories() {
        try {
            const raw = localStorage.getItem(STORAGE_KEY_CATEGORIES);
            const parsed = raw ? JSON.parse(raw) : [];
            return Array.isArray(parsed) ? parsed : [];
        } catch (e) {
            return [];
        }
    }

    function saveCustomCategories(items) {
        localStorage.setItem(STORAGE_KEY_CATEGORIES, JSON.stringify(items));
    }

    function slugify(value) {
        return value
            .toString()
            .trim()
            .toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');
    }

    function addCategoryOptionToHome(category) {
        const additional = document.getElementById('additionalCategories');
        if (!additional) return;

        const categoryId = 'category' + Date.now() + Math.floor(Math.random() * 1000);
        const newCategory = document.createElement('div');
        newCategory.innerHTML = `<input type="radio" class="btn-check" name="taskCategory" id="${categoryId}" value="${category.key}" autocomplete="off"><label class="btn btn-sm btn-category" for="${categoryId}" style="background-color: ${category.bg}; color: ${category.text};"><i class="bi ${category.icon} me-1"></i>${category.label}</label>`;
        additional.appendChild(newCategory);
    }

    function loadCategoryOptionsFromStorage() {
        const additional = document.getElementById('additionalCategories');
        if (!additional) return;
        additional.innerHTML = '';

        const custom = loadCustomCategories();
        custom.forEach(cat => addCategoryOptionToHome(cat));
    }

    function showAddCategory() {
        const form = document.getElementById('addCategoryForm');
        form.classList.toggle('d-none');
        if (!form.classList.contains('d-none')) document.getElementById('newCategoryName').focus();
    }
    
    function addNewCategory() {
        const categoryName = document.getElementById('newCategoryName').value.trim();
        if (!categoryName) return alert('Mohon isi nama kategori');
        const colors = [{bg:'#fef3c7', text:'#92400e', icon:'bi-palette'}, {bg:'#e0e7ff', text:'#3730a3', icon:'bi-star'}, {bg:'#fce7f3', text:'#9d174d', icon:'bi-heart'}];
        const color = colors[Math.floor(Math.random() * colors.length)];
        const key = slugify(categoryName) || ('kategori-' + Date.now());

        const current = loadCustomCategories();
        const exists = current.some(c => c.key === key || c.label.toLowerCase() === categoryName.toLowerCase());
        if (!exists) {
            current.push({ key, label: categoryName, bg: color.bg, text: color.text, icon: color.icon });
            saveCustomCategories(current);
        }

        loadCategoryOptionsFromStorage();
        document.getElementById('newCategoryName').value = '';
        document.getElementById('addCategoryForm').classList.add('d-none');
    }

    // ========================
    // DATE WIDGET LOGIC (CENTERED)
    // ========================
    const dateDisplayBox = document.getElementById('dateDisplayBox');
    const dateText = document.getElementById('dateText');
    const calendarPopup = document.getElementById('calendarPopup');
    const calendarTitle = document.getElementById('calendarTitle');
    const calendarGrid = document.querySelector('.calendar-grid');
    
    let currentDate = new Date(); 
    let selectedDate = new Date();

    dateDisplayBox.addEventListener('click', (e) => {
        e.stopPropagation();
        if (document.getElementById('datetimeSection').classList.contains('disabled')) return;
        const isOpen = calendarPopup.classList.contains('show');
        closeAllPopups();
        if (!isOpen) {
            calendarPopup.classList.add('show');
            dateDisplayBox.classList.add('active');
            renderCalendar();
        }
    });

    function renderCalendar() {
        const year = currentDate.getFullYear();
        const month = currentDate.getMonth();
        const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        calendarTitle.textContent = `${monthNames[month]} ${year}`;
        calendarGrid.innerHTML = '<div class="calendar-day-label">Su</div><div class="calendar-day-label">Mo</div><div class="calendar-day-label">Tu</div><div class="calendar-day-label">We</div><div class="calendar-day-label">Th</div><div class="calendar-day-label">Fr</div><div class="calendar-day-label">Sa</div>';
        const firstDayIndex = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        const today = new Date();

        for (let i = 0; i < firstDayIndex; i++) {
            const emptyDiv = document.createElement('div');
            emptyDiv.classList.add('calendar-day', 'empty');
            calendarGrid.appendChild(emptyDiv);
        }

        for (let i = 1; i <= daysInMonth; i++) {
            const dayEl = document.createElement('div');
            dayEl.classList.add('calendar-day');
            dayEl.textContent = i;
            if (i === selectedDate.getDate() && month === selectedDate.getMonth() && year === selectedDate.getFullYear()) dayEl.classList.add('selected');
            if (i === today.getDate() && month === today.getMonth() && year === today.getFullYear()) dayEl.classList.add('today');
            dayEl.addEventListener('click', (e) => {
                e.stopPropagation();
                selectedDate = new Date(year, month, i);
                updateDateDisplay();
                calendarPopup.classList.remove('show');
                dateDisplayBox.classList.remove('active');
            });
            calendarGrid.appendChild(dayEl);
        }
    }

    function updateDateDisplay() {
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        const parts = selectedDate.toLocaleDateString('en-US', options).split(',');
        dateText.textContent = `${parts[0]}, ${parts[1]}`;
    }

    document.getElementById('prevMonth').addEventListener('click', (e) => { e.stopPropagation(); currentDate.setMonth(currentDate.getMonth() - 1); renderCalendar(); });
    document.getElementById('nextMonth').addEventListener('click', (e) => { e.stopPropagation(); currentDate.setMonth(currentDate.getMonth() + 1); renderCalendar(); });

    // ========================
    // TIME WIDGET LOGIC
    // ========================
    function generateTimeOptions() {
        const times = [];
        for (let i = 0; i < 24; i++) {
            for (let j = 0; j < 60; j += 15) {
                const hour = i; const minute = j;
                const period = hour >= 12 ? 'pm' : 'am';
                const displayHour = hour % 12 || 12;
                const displayMinute = minute < 10 ? '0' + minute : minute;
                times.push(`${displayHour}:${displayMinute}${period}`);
            }
        }
        return times;
    }
    const timeOptions = generateTimeOptions();

    function setupTimePicker(inputId, dropdownId) {
        const input = document.getElementById(inputId);
        const dropdown = document.getElementById(dropdownId);
        populateDropdown(dropdown, timeOptions, input);

        input.addEventListener('focus', (e) => {
            e.stopPropagation();
            if (document.getElementById('datetimeSection').classList.contains('disabled')) return;
            document.querySelectorAll('.time-dropdown').forEach(d => { if(d !== dropdown) d.classList.remove('show'); });
            dropdown.classList.add('show');
            input.parentElement.classList.add('active');
            filterDropdown(input.value, dropdown);
        });

        input.addEventListener('input', (e) => { filterDropdown(e.target.value, dropdown); });
        
        input.addEventListener('keydown', (e) => {
            const highlighted = dropdown.querySelector('.time-option.highlighted');
            if (e.key === 'ArrowDown' || e.key === 'ArrowUp') {
                e.preventDefault();
                const options = Array.from(dropdown.querySelectorAll('.time-option:not([style*="display: none"])'));
                let currentIndex = options.indexOf(highlighted);
                if (e.key === 'ArrowDown') currentIndex = (currentIndex + 1) % options.length;
                if (e.key === 'ArrowUp') currentIndex = (currentIndex - 1 + options.length) % options.length;
                options.forEach(opt => opt.classList.remove('highlighted'));
                if(options[currentIndex]) {
                    options[currentIndex].classList.add('highlighted');
                    options[currentIndex].scrollIntoView({ block: 'nearest' });
                }
            } else if (e.key === 'Enter') {
                e.preventDefault();
                if (highlighted) { input.value = highlighted.textContent; dropdown.classList.remove('show'); } 
                else { dropdown.classList.remove('show'); }
            }
        });

        dropdown.addEventListener('click', (e) => {
            if (e.target.classList.contains('time-option')) {
                input.value = e.target.textContent;
                dropdown.classList.remove('show');
            }
        });
    }

    function populateDropdown(dropdown, options, input) {
        dropdown.innerHTML = '';
        options.forEach(time => {
            const div = document.createElement('div');
            div.className = 'time-option';
            div.textContent = time;
            if (time === input.value) div.classList.add('highlighted');
            div.addEventListener('mouseover', function() {
                dropdown.querySelectorAll('.time-option').forEach(el => el.classList.remove('highlighted'));
                this.classList.add('highlighted');
            });
            dropdown.appendChild(div);
        });
    }

    function filterDropdown(query, dropdown) {
        const options = dropdown.querySelectorAll('.time-option');
        const lowerQuery = query.toLowerCase();
        let firstVisible = null;
        options.forEach(opt => {
            const text = opt.textContent.toLowerCase();
            if (text.includes(lowerQuery)) {
                opt.style.display = 'block';
                if (!firstVisible) firstVisible = opt;
            } else { opt.style.display = 'none'; }
            opt.classList.remove('highlighted');
        });
        if (firstVisible) { firstVisible.classList.add('highlighted'); firstVisible.scrollIntoView({ block: 'nearest' }); }
    }

    setupTimePicker('startTimeInput', 'startTimeDropdown');
    setupTimePicker('endTimeInput', 'endTimeDropdown');

    // ========================
    // GLOBAL POPUP HANDLING
    // ========================
    window.addEventListener('click', closeAllPopups);
    calendarPopup.addEventListener('click', (e) => e.stopPropagation());
    document.getElementById('startTimeDropdown').addEventListener('click', (e) => e.stopPropagation());
    document.getElementById('endTimeDropdown').addEventListener('click', (e) => e.stopPropagation());

    function closeAllPopups() {
        calendarPopup.classList.remove('show');
        dateDisplayBox.classList.remove('active');
        document.getElementById('startTimeDropdown').classList.remove('show');
        document.getElementById('endTimeDropdown').classList.remove('show');
        document.getElementById('startTimeGroup').classList.remove('active');
        document.getElementById('endTimeGroup').classList.remove('active');
    }

    // ========================
    // ADD TASK FUNCTION
    // ========================
    function addTask() {
        const form = document.getElementById('taskForm');
        if (!form.checkValidity()) { form.classList.add('was-validated'); return; }
        const isNoTime = document.getElementById('noSpecificTime').checked;
        const year = selectedDate.getFullYear();
        const month = String(selectedDate.getMonth() + 1).padStart(2, '0');
        const day = String(selectedDate.getDate()).padStart(2, '0');
        const formattedDate = `${year}-${month}-${day}`;
        const startTime = document.getElementById('startTimeInput').value;
        const endTime = document.getElementById('endTimeInput').value;
        const formattedTime = isNoTime ? null : `${startTime} – ${endTime}`;

        const taskData = {
            title: document.getElementById('taskTitle').value,
            category: document.querySelector('input[name="taskCategory"]:checked')?.value,
            date: formattedDate, time: formattedTime,
            notes: document.getElementById('taskNotes').value,
            hasNoSpecificTime: isNoTime
        };
        
        const modal = bootstrap.Modal.getInstance(document.getElementById('addTaskModal'));
        modal.hide();
        form.reset();
        form.classList.remove('was-validated');
        document.getElementById('charCount').textContent = '0';
        selectedDate = new Date(); currentDate = new Date();
        updateDateDisplay();
        document.getElementById('startTimeInput').value = "7:30pm";
        document.getElementById('endTimeInput').value = "8:30pm";
        document.getElementById('datetimeSection').classList.remove('disabled');
        document.getElementById('startTimeInput').disabled = false;
        document.getElementById('endTimeInput').disabled = false;
        
        const toast = new bootstrap.Toast(document.getElementById('successToast'));
        toast.show();
        
        const totalValue = document.querySelector('.stat-value:not(.success):not(.warning)');
        const pendingValue = document.querySelector('.stat-value.warning');
        if (totalValue && pendingValue) {
            totalValue.textContent = parseInt(totalValue.textContent) + 1;
            pendingValue.textContent = parseInt(pendingValue.textContent) + 1;
        }

        const submitBtn = document.getElementById('submitTaskBtn');
        const originalHTML = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="bi bi-check-circle me-2"></i>Berhasil!';
        submitBtn.disabled = true;
        setTimeout(() => { submitBtn.innerHTML = originalHTML; submitBtn.disabled = false; }, 2000);
        console.log('Task added:', taskData);
        
        // Update sidebar badge setelah menambah task baru
        updateSidebarBadge();
    }

    // ========================
    // INITIALIZATION
    // ========================
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize semua komponen
        initializeTaskCheckboxes();
        updateTaskCounters();
        updateCompletedSectionVisibility();
        updateDateDisplay();
        loadCategoryOptionsFromStorage();
        
        // Set initial state untuk task yang sudah checked
        document.querySelectorAll('.task-checkbox:checked').forEach(checkbox => {
            const taskItem = checkbox.closest('.task-item');
            const taskId = taskItem.getAttribute('data-task-id');
            moveTaskToCompleted(taskItem, taskId);
        });
        
        // Modal focus
        const modal = document.getElementById('addTaskModal');
        modal.addEventListener('shown.bs.modal', function() { document.getElementById('taskTitle').focus(); });
    });
</script>
@endpush