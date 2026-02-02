@extends('layouts.app')

@section('title', 'Kategori - FocusDay')

@section('content')
<div class="container-fluid px-0 px-md-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-start align-items-md-center flex-column flex-md-row">
                <div class="mb-3 mb-md-0">
                    <h2 class="fw-bold text-dark mb-1">Kategori</h2>
                    <p class="text-muted mb-0">Tugas dan rencana Anda dikelompokkan berdasarkan kategori</p>
                </div>
                <button class="btn btn-success btn-add-task shadow-sm" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Kategori
                </button>
            </div>
        </div>
    </div>
    
    <!-- Container Kategori -->
    <div class="row g-4" id="categoriesContainer">
        <!-- Konten akan di-generate otomatis oleh JavaScript berdasarkan kategori -->
    </div>

    <!-- Empty State (Jika tidak ada tugas sama sekali) -->
    <div class="row d-none" id="noCategoriesState">
        <div class="col-12 text-center py-5">
            <i class="bi bi-tags text-muted" style="font-size: 3rem; opacity: 0.3;"></i>
            <p class="text-muted mt-3">Belum ada kategori atau tugas yang tersedia.</p>
        </div>
    </div>
</div>

<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
            <div class="modal-header border-0 pb-3" style="border-bottom: 1px solid #e5e7eb !important;">
                <div class="w-100 d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="modal-title fw-bold text-dark mb-0" id="addCategoryModalLabel">
                            <i class="bi bi-plus-circle-fill me-2" style="color: #10b981;"></i>
                            Kategori Baru
                        </h5>
                        <small class="text-muted">Buat kategori untuk mengelompokkan tugas</small>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>

            <div class="modal-body p-4 pt-3">
                <form id="categoryForm" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="categoryName" class="form-label fw-semibold text-dark">Nama Kategori</label>
                        <input type="text" class="form-control" id="categoryName" required style="border-radius: 10px; border: 2px solid #e5e7eb;">
                        <div class="invalid-feedback">Harap isi nama kategori</div>
                    </div>

                    <div class="mb-3">
                        <label for="categoryColorPreset" class="form-label fw-semibold text-dark">Warna</label>
                        <select class="form-select" id="categoryColorPreset" style="border-radius: 10px; border: 2px solid #e5e7eb;">
                            <option value="work">Biru</option>
                            <option value="learning">Hijau</option>
                            <option value="personal">Kuning</option>
                            <option value="purple">Ungu</option>
                            <option value="pink">Pink</option>
                            <option value="gray">Abu-abu</option>
                        </select>
                    </div>
                </form>
            </div>

            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-light btn-lg px-4" data-bs-dismiss="modal" style="border-radius: 10px;">Batal</button>
                <button type="button" class="btn btn-success btn-lg px-4" id="saveCategoryBtn" style="border-radius: 10px;">
                    <i class="bi bi-check-lg me-2"></i>Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Add Task Modal (SAME AS HOME PAGE) -->
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
                            <input type="radio" class="btn-check" name="taskCategory" id="categoryNone" value="none" autocomplete="off" checked>
                            <label class="btn btn-sm btn-category" for="categoryNone" style="--pill-bg: #f3f4f6; --pill-text: #374151; --pill-bg-dark: rgba(156, 163, 175, 0.15); --pill-text-dark: #e5e7eb; --pill-border-dark: rgba(156, 163, 175, 0.3);">
                                <i class="bi bi-tag me-1"></i>Tanpa Kategori
                            </label>

                            @foreach($categories as $cat)
                                @php
                                    $warna = strtolower(trim($cat->warna ?? ''));
                                    $colorMap = [
                                        'biru' => ['bg' => '#dbeafe', 'text' => '#1e40af'],
                                        'blue' => ['bg' => '#dbeafe', 'text' => '#1e40af'],
                                        'hijau' => ['bg' => '#d1fae5', 'text' => '#065f46'],
                                        'green' => ['bg' => '#d1fae5', 'text' => '#065f46'],
                                        'kuning' => ['bg' => '#fef3c7', 'text' => '#92400e'],
                                        'yellow' => ['bg' => '#fef3c7', 'text' => '#92400e'],
                                        'merah' => ['bg' => '#fee2e2', 'text' => '#991b1b'],
                                        'red' => ['bg' => '#fee2e2', 'text' => '#991b1b'],
                                        'ungu' => ['bg' => '#ede9fe', 'text' => '#5b21b6'],
                                        'purple' => ['bg' => '#ede9fe', 'text' => '#5b21b6'],
                                        'pink' => ['bg' => '#fce7f3', 'text' => '#9d174d'],
                                        'abu-abu' => ['bg' => '#f3f4f6', 'text' => '#374151'],
                                        'gray' => ['bg' => '#f3f4f6', 'text' => '#374151'],
                                        'grey' => ['bg' => '#f3f4f6', 'text' => '#374151'],
                                    ];
                                    $darkMap = [
                                        'biru' => ['bg' => 'rgba(37, 99, 235, 0.15)', 'text' => '#93c5fd', 'border' => 'rgba(59, 130, 246, 0.3)'],
                                        'blue' => ['bg' => 'rgba(37, 99, 235, 0.15)', 'text' => '#93c5fd', 'border' => 'rgba(59, 130, 246, 0.3)'],
                                        'hijau' => ['bg' => 'rgba(16, 185, 129, 0.15)', 'text' => '#6ee7b7', 'border' => 'rgba(16, 185, 129, 0.3)'],
                                        'green' => ['bg' => 'rgba(16, 185, 129, 0.15)', 'text' => '#6ee7b7', 'border' => 'rgba(16, 185, 129, 0.3)'],
                                        'kuning' => ['bg' => 'rgba(245, 158, 11, 0.15)', 'text' => '#fcd34d', 'border' => 'rgba(245, 158, 11, 0.3)'],
                                        'yellow' => ['bg' => 'rgba(245, 158, 11, 0.15)', 'text' => '#fcd34d', 'border' => 'rgba(245, 158, 11, 0.3)'],
                                        'merah' => ['bg' => 'rgba(239, 68, 68, 0.15)', 'text' => '#fca5a5', 'border' => 'rgba(239, 68, 68, 0.3)'],
                                        'red' => ['bg' => 'rgba(239, 68, 68, 0.15)', 'text' => '#fca5a5', 'border' => 'rgba(239, 68, 68, 0.3)'],
                                        'ungu' => ['bg' => 'rgba(124, 58, 237, 0.15)', 'text' => '#ddd6fe', 'border' => 'rgba(124, 58, 237, 0.3)'],
                                        'purple' => ['bg' => 'rgba(124, 58, 237, 0.15)', 'text' => '#ddd6fe', 'border' => 'rgba(124, 58, 237, 0.3)'],
                                        'pink' => ['bg' => 'rgba(236, 72, 153, 0.15)', 'text' => '#fbcfe8', 'border' => 'rgba(236, 72, 153, 0.3)'],
                                        'abu-abu' => ['bg' => 'rgba(156, 163, 175, 0.15)', 'text' => '#e5e7eb', 'border' => 'rgba(156, 163, 175, 0.3)'],
                                        'gray' => ['bg' => 'rgba(156, 163, 175, 0.15)', 'text' => '#e5e7eb', 'border' => 'rgba(156, 163, 175, 0.3)'],
                                        'grey' => ['bg' => 'rgba(156, 163, 175, 0.15)', 'text' => '#e5e7eb', 'border' => 'rgba(156, 163, 175, 0.3)'],
                                    ];
                                    $bg = $colorMap[$warna]['bg'] ?? '#f3f4f6';
                                    $text = $colorMap[$warna]['text'] ?? '#374151';
                                    $darkBg = $darkMap[$warna]['bg'] ?? 'rgba(156, 163, 175, 0.15)';
                                    $darkText = $darkMap[$warna]['text'] ?? '#e5e7eb';
                                @endphp
                                <input type="radio" class="btn-check" name="taskCategory" id="category{{ $cat->kategori_id }}" value="{{ $cat->kategori_id }}" autocomplete="off">
                                <label class="btn btn-sm btn-category" for="category{{ $cat->kategori_id }}" style="--pill-bg: {{ $bg }}; --pill-text: {{ $text }}; --pill-bg-dark: {{ $darkBg }}; --pill-text-dark: {{ $darkText }}; --pill-border-dark: {{ $darkMap[$warna]['border'] ?? 'rgba(156, 163, 175, 0.3)' }}">
                                    <i class="bi bi-tag me-1"></i>{{ $cat->nama_kategori }}
                                </label>
                            @endforeach
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

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;">
            <div class="modal-body p-4 text-center">
                <div class="mb-3">
                    <i class="bi bi-exclamation-circle text-warning display-4"></i>
                </div>
                <h5 class="fw-bold mb-2">Hapus Rencana?</h5>
                <p class="text-muted small mb-4">Apakah Anda yakin ingin menghapus rencana ini?</p>
                <div class="d-flex gap-2 justify-content-center">
                    <button type="button" class="btn btn-light w-100" data-bs-dismiss="modal" style="border-radius: 8px;">Batal</button>
                    <button type="button" class="btn btn-danger w-100" id="confirmDeleteBtn" style="border-radius: 8px;">Hapus</button>
                </div>
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
        background-color: var(--pill-bg, #f3f4f6);
        color: var(--pill-text, #374151);
    }

    html[data-theme="dark"] .btn-category {
        background-color: var(--pill-bg-dark, rgba(156, 163, 175, 0.15));
        color: var(--pill-text-dark, #e5e7eb);
        border-color: var(--pill-border-dark, rgba(156, 163, 175, 0.3));
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
    .task-item-row:hover .hover-show {
        opacity: 1 !important;
        pointer-events: auto;
    }
    .task-actions {
        transition: opacity 0.2s ease-in-out;
        opacity: 0;
        pointer-events: none;
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

    /* --- TAMBAHAN UNTUK HALAMAN KATEGORI --- */
    .btn-add-task-category {
        background-color: transparent;
        border: 2px dashed #d1d5db;
        color: #6b7280;
        font-weight: 500;
        border-radius: 10px;
        width: 100%;
        padding: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.2s ease;
        margin-top: 1rem;
    }
    
    .btn-add-task-category:hover {
        background-color: rgba(16, 185, 129, 0.05);
        border-color: var(--primary-green);
        color: var(--primary-green);
        transform: translateY(-1px);
    }
    
    html[data-theme="dark"] .btn-add-task-category {
        border-color: #4b5563;
        color: #9ca3af;
    }
    
    html[data-theme="dark"] .btn-add-task-category:hover {
        border-color: var(--primary-green);
        color: var(--primary-green);
    }

    /* Kartu Kategori */
    .category-card {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.03);
        border: 1px solid #f3f4f6;
        height: 100%;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    /* Header Warna Kategori */
    .category-header {
        padding: 1rem 1.25rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        background-color: var(--cat-bg, transparent);
        color: var(--cat-text, inherit);
    }

    html[data-theme="dark"] .category-header {
        background-color: var(--cat-bg-dark, rgba(156, 163, 175, 0.12));
        color: var(--cat-text-dark, #e5e7eb);
        border-bottom-color: rgba(255, 255, 255, 0.08);
    }

    /* Warna Spesifik untuk Header (Sesuai desain sebelumnya) */
    .header-work {
        --cat-bg: #dbeafe;
        --cat-text: #1e40af;
        --cat-bg-dark: rgba(37, 99, 235, 0.15);
        --cat-text-dark: #93c5fd;
    }
    .header-learning {
        --cat-bg: #d1fae5;
        --cat-text: #065f46;
        --cat-bg-dark: rgba(16, 185, 129, 0.15);
        --cat-text-dark: #6ee7b7;
    }
    .header-personal {
        --cat-bg: #fef3c7;
        --cat-text: #92400e;
        --cat-bg-dark: rgba(245, 158, 11, 0.15);
        --cat-text-dark: #fcd34d;
    }

    .category-title {
        font-weight: 700;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .category-count {
        background: rgba(255,255,255,0.6);
        padding: 2px 10px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    html[data-theme="dark"] .category-count {
        background: rgba(255, 255, 255, 0.08);
        color: inherit;
    }

    /* List Tugas di dalam Kategori */
    .category-tasks {
        padding: 0;
        flex-grow: 1;
        max-height: 400px;
        overflow-y: auto;
    }

    .task-item-row {
        display: flex;
        align-items: flex-start;
        padding: 1rem 1.25rem;
        border-bottom: 1px solid rgba(17, 24, 39, 0.2);
        transition: background 0.2s;
        cursor: default;
    }

    .task-item-row:last-child {
        border-bottom: none;
    }

    .task-item-row:hover {
        background-color: #f9fafb;
    }

    /* Checkbox Custom */
    .task-checkbox {
        margin-top: 4px;
        margin-right: 12px;
        width: 18px;
        height: 18px;
        cursor: pointer;
        accent-color: #10b981; /* Hijau utama */
    }

    .task-content {
        flex-grow: 1;
    }

    .task-name {
        font-weight: 500;
        color: #374151;
        margin-bottom: 4px;
        display: block;
    }

    /* Styling untuk detail tanggal/waktu */
    .task-meta {
        font-size: 0.8rem;
        color: #9ca3af; /* Abu-abu */
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        align-items: center;
    }
    
    .task-meta span {
        display: flex;
        align-items: center;
        gap: 4px;
    }

    /* State Selesai */
    .task-completed .task-name {
        text-decoration: line-through;
        color: #9ca3af;
    }
    .task-completed .task-meta {
        opacity: 0.6;
    }

    /* Scrollbar cantik untuk list panjang */
    .category-tasks::-webkit-scrollbar {
        width: 6px;
    }
    .category-tasks::-webkit-scrollbar-track {
        background: transparent;
    }
    .category-tasks::-webkit-scrollbar-thumb {
        background-color: #e5e7eb;
        border-radius: 10px;
    }
    
    /* Dark Mode Override */
    html[data-theme="dark"] .category-card {
        background-color: #1f2937;
        border-color: #374151;
    }
    html[data-theme="dark"] .task-item-row {
        border-bottom-color: rgba(255, 255, 255, 0.2);
    }
    html[data-theme="dark"] .task-item-row:hover {
        background-color: #374151;
    }
    html[data-theme="dark"] .task-name {
        color: #e5e7eb;
    }

    .category-empty {
        padding: 1rem 1.25rem;
        color: #9ca3af;
</style>
@endpush

@push('scripts')
<script>
    const backendCategories = @json($categories);
    const backendTasks = @json($tasks);

    let tasksData = (backendTasks || []).map(t => ({
        id: t.id,
        title: t.judul_tugas,
        category: t.kategori_id ? String(t.kategori_id) : 'none',
        dateIso: t.tanggal,
        time: t.waktu,
        notes: t.catatan,
        completed: t.status === 'selesai',
    }));

    function showUiToast(message, type = 'success') {
        if (typeof window.showToast === 'function') {
            window.showToast(message, type);
            return;
        }

        const toastEl = document.getElementById('successToast');
        if (!toastEl || typeof bootstrap === 'undefined') return;

        const titleEl = toastEl.querySelector('strong');
        const msgEl = toastEl.querySelector('.small');

        if (type === 'success') {
            toastEl.className = 'toast align-items-center text-white bg-success border-0 shadow';
            if (titleEl) titleEl.textContent = 'Berhasil';
        } else {
            toastEl.className = 'toast align-items-center text-white bg-danger border-0 shadow';
            if (titleEl) titleEl.textContent = 'Gagal';
        }

        if (msgEl) msgEl.textContent = message;
        const toast = new bootstrap.Toast(toastEl);
        toast.show();
    }

    function resolveHeaderColors(rawColor) {
        const lower = String(rawColor || '').trim().toLowerCase();
        const map = {
            'biru': { bg: '#dbeafe', text: '#1e40af', darkBg: 'rgba(37, 99, 235, 0.15)', darkText: '#93c5fd' },
            'blue': { bg: '#dbeafe', text: '#1e40af', darkBg: 'rgba(37, 99, 235, 0.15)', darkText: '#93c5fd' },
            'hijau': { bg: '#d1fae5', text: '#065f46', darkBg: 'rgba(16, 185, 129, 0.15)', darkText: '#6ee7b7' },
            'green': { bg: '#d1fae5', text: '#065f46', darkBg: 'rgba(16, 185, 129, 0.15)', darkText: '#6ee7b7' },
            'kuning': { bg: '#fef3c7', text: '#92400e', darkBg: 'rgba(245, 158, 11, 0.15)', darkText: '#fcd34d' },
            'yellow': { bg: '#fef3c7', text: '#92400e', darkBg: 'rgba(245, 158, 11, 0.15)', darkText: '#fcd34d' },
            'merah': { bg: '#fee2e2', text: '#991b1b', darkBg: 'rgba(239, 68, 68, 0.15)', darkText: '#fca5a5' },
            'red': { bg: '#fee2e2', text: '#991b1b', darkBg: 'rgba(239, 68, 68, 0.15)', darkText: '#fca5a5' },
            'ungu': { bg: '#ede9fe', text: '#5b21b6', darkBg: 'rgba(124, 58, 237, 0.15)', darkText: '#ddd6fe' },
            'purple': { bg: '#ede9fe', text: '#5b21b6', darkBg: 'rgba(124, 58, 237, 0.15)', darkText: '#ddd6fe' },
            'pink': { bg: '#fce7f3', text: '#9d174d', darkBg: 'rgba(236, 72, 153, 0.15)', darkText: '#fbcfe8' },
            'abu-abu': { bg: '#f3f4f6', text: '#374151', darkBg: 'rgba(156, 163, 175, 0.15)', darkText: '#e5e7eb' },
            'gray': { bg: '#f3f4f6', text: '#374151', darkBg: 'rgba(156, 163, 175, 0.15)', darkText: '#e5e7eb' },
            'grey': { bg: '#f3f4f6', text: '#374151', darkBg: 'rgba(156, 163, 175, 0.15)', darkText: '#e5e7eb' },
        };
        return map[lower] || { bg: '#f3f4f6', text: '#374151', darkBg: 'rgba(156, 163, 175, 0.15)', darkText: '#e5e7eb' };
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

    function loadCustomCategories() {
        return [];
    }

    function saveCustomCategories() {
        return;
    }

    function loadCategoryOptionsFromStorage() {
        return;
    }

    function getAllCategories() {
        const merged = {};

        merged['none'] = {
            label: 'Tanpa Kategori',
            icon: 'bi-tag',
            class: '',
            bg: '#f3f4f6',
            text: '#374151',
            darkBg: 'rgba(156, 163, 175, 0.15)',
            darkText: '#e5e7eb',
        };

        (backendCategories || []).forEach(cat => {
            const key = String(cat.kategori_id);
            const colors = resolveHeaderColors(cat.warna);
            merged[key] = {
                label: cat.nama_kategori,
                icon: 'bi-tag',
                class: '',
                bg: colors.bg,
                text: colors.text,
                darkBg: colors.darkBg,
                darkText: colors.darkText,
            };
        });

        return merged;
    }

    function formatDateIsoToIndonesian(dateIso) {
        if (!dateIso) return '';
        const d = new Date(dateIso);
        if (Number.isNaN(d.getTime())) return String(dateIso);
        return d.toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' });
    }

    function renderCategories() {
        const container = document.getElementById('categoriesContainer');
        const categories = getAllCategories();
        const categoryKeys = Object.keys(categories);

        // 1. Buat Bucket Kosong untuk setiap kategori
        const groupedTasks = {};
        categoryKeys.forEach(key => {
            groupedTasks[key] = [];
        });

        // 2. Masukkan tugas ke bucket yang sesuai
        tasksData.forEach(task => {
            if (groupedTasks[task.category]) {
                groupedTasks[task.category].push(task);
            }
        });

        // 3. Render HTML untuk setiap kategori yang punya tugas
        let htmlContent = '';

        for (const [key, tasks] of Object.entries(groupedTasks)) {
            const config = categories[key];

            // Generate List Item Tugas
            const activeTasks = tasks.filter(t => !t.completed);
            const completedTasks = tasks.filter(t => t.completed);

            let activeTasksHtml = '';
            if (activeTasks.length > 0) {
                activeTasks.forEach(task => {
                    const date = formatDateIsoToIndonesian(task.dateIso);
                    const time = task.time ? String(task.time) : 'All Day';
                    const notesHtml = task.notes ? `<div class="task-notes">${task.notes}</div>` : '';
                    activeTasksHtml += `
                        <div class="task-item-row" data-task-id="${task.id}">
                            <input class="form-check-input task-checkbox" type="checkbox" data-task-id="${task.id}" ${task.completed ? 'checked' : ''}>
                            <div class="task-content">
                                <span class="task-name">${task.title}</span>
                                <div class="task-meta">
                                    <span><i class="bi bi-calendar3"></i> ${date}</span>
                                    <span><i class="bi bi-clock"></i> ${time}</span>
                                </div>
                                ${notesHtml}
                            </div>
                            <!-- Action Buttons -->
                            <div class="task-actions ms-2 hover-show d-flex align-items-center gap-1">
                                <button class="btn btn-sm btn-link text-muted p-1" onclick="event.preventDefault(); openEditTaskModal('${task.id}')" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-sm btn-link text-muted p-1" onclick="event.preventDefault(); confirmDeleteTask('${task.id}')" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    `;
                });
            } else {
                activeTasksHtml = `<div class="category-empty">Belum ada tugas aktif di kategori ini</div>`;
            }

            let completedTasksHtml = '';
            if (completedTasks.length > 0) {
                completedTasks.forEach(task => {
                    const date = formatDateIsoToIndonesian(task.dateIso);
                    const time = task.time ? String(task.time) : 'All Day';
                    const notesHtml = task.notes ? `<div class="task-notes">${task.notes}</div>` : '';
                    completedTasksHtml += `
                        <div class="task-item-row task-completed" data-task-id="${task.id}">
                            <input class="form-check-input task-checkbox" type="checkbox" data-task-id="${task.id}" checked>
                            <div class="task-content">
                                <span class="task-name">${task.title}</span>
                                <div class="task-meta">
                                    <span><i class="bi bi-calendar3"></i> ${date}</span>
                                    <span><i class="bi bi-clock"></i> ${time}</span>
                                </div>
                                ${notesHtml}
                            </div>
                            <!-- Action Buttons -->
                            <div class="task-actions ms-2 hover-show d-flex align-items-center gap-1">
                                <button class="btn btn-sm btn-link text-muted p-1" onclick="event.preventDefault(); openEditTaskModal('${task.id}')" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-sm btn-link text-muted p-1" onclick="event.preventDefault(); confirmDeleteTask('${task.id}')" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    `;
                });
            }

            const completedCollapseId = `completedTasks-${key}`;
            const completedSectionHtml = completedTasks.length > 0
                ? `
                    <div class="pt-2 px-3">
                        <button class="btn btn-sm btn-link text-success fw-semibold px-0" type="button" data-bs-toggle="collapse" data-bs-target="#${completedCollapseId}" aria-expanded="false" aria-controls="${completedCollapseId}">
                            <i class="bi bi-check-circle me-1"></i>Terselesaikan (${completedTasks.length})
                            <i class="bi bi-chevron-down ms-1"></i>
                        </button>
                        <div class="collapse" id="${completedCollapseId}">
                            ${completedTasksHtml}
                        </div>
                    </div>
                `
                : '';

            const headerClass = config.class ? config.class : '';
            const headerStyle = config.bg ? `--cat-bg: ${config.bg}; --cat-text: ${config.text}; --cat-bg-dark: ${config.darkBg || 'rgba(156, 163, 175, 0.15)'}; --cat-text-dark: ${config.darkText || '#e5e7eb'};` : '';

            // Tombol Tambah Tugas untuk kategori ini
            const addTaskButton = `
                <div class="category-footer p-3 border-top">
                    <button type="button" class="btn-add-task-category" onclick="openAddTaskModalForCategory('${key}')">
                        <i class="bi bi-plus-circle"></i>
                        Tambah Tugas
                    </button>
                </div>
            `;

            const tasksHtml = `
                ${activeTasksHtml}
                ${completedSectionHtml}
            `;

            // Buat Kartu Kategori
            htmlContent += `
                <div class="col-md-6 col-lg-4 fade-in">
                    <div class="category-card">
                        <!-- Header Kategori -->
                        <div class="category-header ${headerClass}" style="${headerStyle}">
                            <div class="category-title">
                                <i class="bi ${config.icon}"></i> ${config.label}
                            </div>
                            <span class="category-count">${tasks.length} Tugas</span>
                        </div>
                        
                        <!-- Daftar Tugas -->
                        <div class="category-tasks">
                            ${tasksHtml}
                        </div>
                        
                        <!-- Footer dengan Tombol Tambah Tugas -->
                        ${addTaskButton}
                    </div>
                </div>
            `;
        }

        // Masukkan ke DOM
        if (htmlContent === '' && categoryKeys.length === 0) {
            document.getElementById('noCategoriesState').classList.remove('d-none');
            container.classList.add('d-none');
        } else {
            document.getElementById('noCategoriesState').classList.add('d-none');
            container.classList.remove('d-none');
            container.innerHTML = htmlContent;
        }
    }

    // ========================
    // EDIT & DELETE LOGIC
    // ========================

    let taskToDeleteId = null;

    function confirmDeleteTask(taskId) {
        taskToDeleteId = taskId;
        const modal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
        modal.show();
    }

    const confirmBtn = document.getElementById('confirmDeleteBtn');
    if (confirmBtn) {
        confirmBtn.addEventListener('click', function() {
            if (taskToDeleteId) {
                processDeleteTask(taskToDeleteId);
            }
        });
    }

    function processDeleteTask(taskId) {
        const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
        const csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : '';

        // Tutup modal
        const modalEl = document.getElementById('deleteConfirmationModal');
        const modal = bootstrap.Modal.getInstance(modalEl);
        if (modal) modal.hide();

        fetch(`/rencana/${taskId}/delete`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
        })
        .then(response => {
            if (!response.ok) throw new Error('Gagal menghapus rencana');
            // Remove from array and re-render
            const index = tasksData.findIndex(t => t.id == taskId);
            if (index !== -1) {
                tasksData.splice(index, 1);
                renderCategories();
            }
            showUiToast('Rencana berhasil dihapus.', 'success');
        })
        .catch(error => {
            console.error(error);
            showUiToast('Gagal menghapus rencana.', 'error');
        });
    }

    function openEditTaskModal(taskId) {
        const task = tasksData.find(t => t.id == taskId);
        if (!task) return;

        // --- Switch modal into EDIT MODE ---
        const saveBtn = document.getElementById('submitTaskBtn');
        if (saveBtn) {
            saveBtn.setAttribute('data-edit-id', String(taskId));
            saveBtn.innerHTML = '<i class="bi bi-check-lg me-2"></i>Simpan Perubahan';
        }

        const modalLabel = document.getElementById('addTaskModalLabel');
        if (modalLabel) {
            modalLabel.innerHTML = '<i class="bi bi-pencil-square me-2" style="color: #f59e0b;"></i>Edit Rencana';
        }

        // Populate fields
        const titleEl = document.getElementById('taskTitle');
        if (titleEl) titleEl.value = task.title || '';

        const notesEl = document.getElementById('taskNotes');
        if (notesEl) notesEl.value = task.notes || '';

        // Selected date
        if (task.dateIso) {
            const parsed = new Date(task.dateIso);
            if (!Number.isNaN(parsed.getTime())) {
                selectedDate = parsed;
            }
        }
        updateDateDisplay();

        // Category
        currentCategoryForTask = task.category || 'none';
        const catValue = currentCategoryForTask;
        const catRadio = document.querySelector(`input[name="taskCategory"][value="${catValue}"]`);
        if (catRadio) {
            catRadio.checked = true;
        } else {
            const noneRadio = document.getElementById('categoryNone');
            if (noneRadio) noneRadio.checked = true;
            currentCategoryForTask = 'none';
        }

        // Time
        const noSpecificTime = document.getElementById('noSpecificTime');
        const datetimeSection = document.getElementById('datetimeSection');
        const start = document.getElementById('startTimeInput');
        const end = document.getElementById('endTimeInput');

        const timeRaw = (task.time || '').trim();
        const parts = timeRaw ? timeRaw.split(/\s*[–-]\s*/).map(s => s.trim()).filter(Boolean) : [];

        if (!timeRaw || parts.length < 2) {
            if (noSpecificTime) noSpecificTime.checked = true;
            if (datetimeSection) datetimeSection.classList.add('disabled');
            if (start) { start.value = ''; start.disabled = true; }
            if (end) { end.value = ''; end.disabled = true; }
        } else {
            if (noSpecificTime) noSpecificTime.checked = false;
            if (datetimeSection) datetimeSection.classList.remove('disabled');
            if (start) { start.value = parts[0] || ''; start.disabled = false; }
            if (end) { end.value = parts[1] || ''; end.disabled = false; }
        }

        const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('addTaskModal'));
        modal.show();
    }

    // ========================
    // INITIALIZATION
    // ========================
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Render Categories immediately
        renderCategories();

        // 2. Initialize Widgets & Helpers
        initializeDateTimeWidgets();
        initializeTaskCheckboxes();
        loadCategoryOptionsFromStorage();
        updateDateDisplay();

        // --- Event Listeners ---
        
        // Task Form
        const taskForm = document.getElementById('taskForm');
        if (taskForm) {
            taskForm.addEventListener('submit', function(event) {
                event.preventDefault();
                if (!this.checkValidity()) {
                    event.stopPropagation();
                    this.classList.add('was-validated');
                    return;
                }
                addTask();
            });
        }

        // Category Form (for saving new category)
        const saveCategoryBtn = document.getElementById('saveCategoryBtn');
        if (saveCategoryBtn) {
            saveCategoryBtn.addEventListener('click', addCategory);
        }
        
        const categoryForm = document.getElementById('categoryForm');
        if (categoryForm) {
            categoryForm.addEventListener('submit', function(event) {
                event.preventDefault(); // Handled by button click
            });
        }

        // Helper: auto-focus on category name input
        const addCatModal = document.getElementById('addCategoryModal');
        if (addCatModal) {
            addCatModal.addEventListener('shown.bs.modal', function() {
                const nameInput = document.getElementById('categoryName');
                if (nameInput) nameInput.focus();
            });
        }

        // Add Task Modal Events
        const addTaskModal = document.getElementById('addTaskModal');
        if (addTaskModal) {
            addTaskModal.addEventListener('shown.bs.modal', function() {
                updateDateDisplay();
                const titleInput = document.getElementById('taskTitle');
                if(titleInput) titleInput.focus();
            });
            
            addTaskModal.addEventListener('hidden.bs.modal', function() {
                // Reset form when closed
                if (taskForm) {
                    taskForm.reset();
                    taskForm.classList.remove('was-validated');
                }
                const count = document.getElementById('charCount');
                if(count) count.textContent = '0';
                
                // Reset edit mode buttons
                const saveBtn = document.getElementById('submitTaskBtn');
                if(saveBtn) {
                     saveBtn.removeAttribute('data-edit-id');
                     saveBtn.innerHTML = '<i class="bi bi-plus-circle me-2"></i>Tambah Tugas';
                }
                const modalLabel = document.getElementById('addTaskModalLabel');
                if(modalLabel) {
                    modalLabel.innerHTML = '<i class="bi bi-plus-circle-fill me-2" style="color: #10b981;"></i>Rencana Baru';
                }
                
                // Reset time inputs
                document.getElementById('datetimeSection').classList.remove('disabled');
                const start = document.getElementById('startTimeInput');
                const end = document.getElementById('endTimeInput');
                if(start && end) {
                    start.disabled = false;
                    end.disabled = false;
                    start.value = '7:30pm';
                    end.value = '8:30pm';
                }
                
                // Reset category form visibility inside modal
                const addCatForm = document.getElementById('addCategoryForm');
                if(addCatForm) addCatForm.classList.add('d-none');
            });
        }
        
        // Character counter
        const taskNotes = document.getElementById('taskNotes');
        if (taskNotes) {
            taskNotes.addEventListener('input', function() {
                const count = document.getElementById('charCount');
                if(count) count.textContent = this.value.length;
            });
        }
        
        // No Specific Time Checkbox
        const noSpecificTime = document.getElementById('noSpecificTime');
        if (noSpecificTime) {
            noSpecificTime.addEventListener('change', function() {
                const wrapper = document.getElementById('datetimeSection');
                const timeInputs = document.querySelectorAll('#startTimeInput, #endTimeInput');
                if (this.checked) {
                    wrapper.classList.add('disabled');
                    timeInputs.forEach(input => { 
                        input.value = ''; 
                        input.disabled = true; 
                    });
                } else {
                    wrapper.classList.remove('disabled');
                    timeInputs.forEach(input => {
                        input.value = (input.id === 'startTimeInput' ? '7:30pm' : '8:30pm');
                        input.disabled = false;
                    });
                }
            });
        }

        // Categories Container (global delegation for checkboxes if needed, though initializeTaskCheckboxes handles most)
        const categoriesContainer = document.getElementById('categoriesContainer');
        if (categoriesContainer) {
            categoriesContainer.addEventListener('change', function(e) {
                const checkbox = e.target;
                if (checkbox.classList.contains('task-check-input')) { // Using correct class if needed, or stick to task-checkbox
                     // Logic handled by initializeTaskCheckboxes mostly
                }
            });
        }
    });

    function setTaskCompleted(taskId, completed) {
        // Update local data
        const task = tasksData.find(t => t.id == taskId);
        if (task) task.completed = completed;

        const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
        const csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : '';
        
        fetch(`/rencana/${taskId}/toggle-status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify({ status: completed ? 'selesai' : null }),
        })
        .then(res => {
            if (!res.ok) throw new Error('Gagal mengubah status');
            return res.json();
        })
        .then(() => {
            renderCategories(); // Re-render to update counts and move tasks
        })
        .catch(() => {
            showUiToast('Gagal mengubah status tugas. Silakan coba lagi.', 'error');
            // Revert state
            if (task) task.completed = !completed;
            renderCategories();
        });
    }

    // Variable untuk menyimpan kategori aktif saat ini (untuk form tambah tugas)
    let currentCategoryForTask = 'none';

    // Fungsi untuk membuka modal tambah tugas dengan kategori yang sudah dipilih
    function openAddTaskModalForCategory(categoryKey) {
        currentCategoryForTask = categoryKey;
        
        // Ensure "Add Category" section is hidden/reset
        const addCatForm = document.getElementById('addCategoryForm');
        if(addCatForm) addCatForm.classList.add('d-none');

        // Buka modal
        const addTaskModal = new bootstrap.Modal(document.getElementById('addTaskModal'));
        addTaskModal.show();
    }

    function initializeTaskCheckboxes() {
        // Fallback for direct binding if needed, but delegation in DOMContentLoaded handles it mostly.
        // We define this empty or with logic to prevent ReferenceError.
        document.querySelectorAll('.task-checkbox').forEach(checkbox => {
            // Remove old listeners to prevent duplicates if called multiple times?
            // Actually, delegation is better. Let's just keep this function safe.
        });
    }

    // ========================
    // CATEGORY LOGIC
    // ========================
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
        if (!categoryName) return showUiToast('Mohon isi nama kategori.', 'error');

        fetch('/kategori', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken(),
            },
            body: JSON.stringify({
                nama_kategori: categoryName,
                warna: null,
            }),
        })
            .then(res => {
                if (!res.ok) throw new Error('Gagal menambah kategori');
                return res.json().catch(() => ({}));
            })
            .then(() => {
                window.location.reload();
            })
            .catch(() => {
                showUiToast('Gagal menambah kategori. Silakan coba lagi.', 'error');
            });
    }

    // ========================
    // DATE WIDGET LOGIC (CENTERED)
    // ========================
    let currentDate = new Date(); 
    let selectedDate = new Date();

    function initializeDateTimeWidgets() {
        const dateDisplayBox = document.getElementById('dateDisplayBox');
        const dateText = document.getElementById('dateText');
        const calendarPopup = document.getElementById('calendarPopup');
        const calendarTitle = document.getElementById('calendarTitle');
        const calendarGrid = document.querySelector('.calendar-grid');
        
        if (!dateDisplayBox || !calendarPopup) return;

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

        document.getElementById('prevMonth').addEventListener('click', (e) => { 
            e.stopPropagation(); 
            currentDate.setMonth(currentDate.getMonth() - 1); 
            renderCalendar(); 
        });
        document.getElementById('nextMonth').addEventListener('click', (e) => { 
            e.stopPropagation(); 
            currentDate.setMonth(currentDate.getMonth() + 1); 
            renderCalendar(); 
        });

        // Initialize time pickers
        setupTimePicker('startTimeInput', 'startTimeDropdown');
        setupTimePicker('endTimeInput', 'endTimeDropdown');
    }

    function updateDateDisplay() {
        const dateText = document.getElementById('dateText');
        if (!dateText) return;
        
        // Format untuk ditampilkan (contoh: "Kamis, 8 Januari")
        const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        
        const day = days[selectedDate.getDay()];
        const date = selectedDate.getDate();
        const month = months[selectedDate.getMonth()];
        
        dateText.textContent = `${day}, ${month} ${date}`;
    }

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
        if (!input || !dropdown) return;
        
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

    // ========================
    // GLOBAL POPUP HANDLING
    // ========================
    window.addEventListener('click', closeAllPopups);
    
    function closeAllPopups() {
        const calendarPopup = document.getElementById('calendarPopup');
        const dateDisplayBox = document.getElementById('dateDisplayBox');
        const startTimeDropdown = document.getElementById('startTimeDropdown');
        const endTimeDropdown = document.getElementById('endTimeDropdown');
        const startTimeGroup = document.getElementById('startTimeGroup');
        const endTimeGroup = document.getElementById('endTimeGroup');
        
        if (calendarPopup) calendarPopup.classList.remove('show');
        if (dateDisplayBox) dateDisplayBox.classList.remove('active');
        if (startTimeDropdown) startTimeDropdown.classList.remove('show');
        if (endTimeDropdown) endTimeDropdown.classList.remove('show');
        if (startTimeGroup) startTimeGroup.classList.remove('active');
        if (endTimeGroup) endTimeGroup.classList.remove('active');
    }

    function getCsrfToken() {
        const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
        return csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : '';
    }

    function toIsoDate(dateObj) {
        if (!(dateObj instanceof Date) || Number.isNaN(dateObj.getTime())) return null;
        const y = dateObj.getFullYear();
        const m = String(dateObj.getMonth() + 1).padStart(2, '0');
        const d = String(dateObj.getDate()).padStart(2, '0');
        return `${y}-${m}-${d}`;
    }

    // ========================
    // ADD TASK FUNCTION
    // ========================
    function addTask() {
        const form = document.getElementById('taskForm');
        if (!form.checkValidity()) { 
            form.classList.add('was-validated'); 
            return; 
        }
        
        const saveBtn = document.getElementById('submitTaskBtn');
        const editId = saveBtn.getAttribute('data-edit-id'); // Check update

        // Get form values
        const title = document.getElementById('taskTitle').value;
        const rawCategory = currentCategoryForTask || document.querySelector('input[name="taskCategory"]:checked')?.value;
        const notes = document.getElementById('taskNotes').value;
        const isNoTime = document.getElementById('noSpecificTime').checked;

        const tanggalIso = toIsoDate(selectedDate);

        let waktu = null;
        if (!isNoTime) {
            const startTime = document.getElementById('startTimeInput').value;
            const endTime = document.getElementById('endTimeInput').value;
            waktu = `${startTime} - ${endTime}`;
        }

        const kategori_id = rawCategory && rawCategory !== 'none' ? parseInt(rawCategory, 10) : null;

        const url = editId ? `/rencana/${editId}` : '/rencana';

        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken(),
            },
            body: JSON.stringify({
                judul_tugas: title,
                kategori_id,
                tanggal: tanggalIso,
                waktu,
                catatan: notes,
            }),
        })
            .then(res => {
                if (!res.ok) throw new Error('Gagal menyimpan tugas');
                return res.json().catch(() => ({}));
            })
            .then(() => {
                window.location.reload();
            })
            .catch(() => {
                showUiToast('Gagal menyimpan tugas. Silakan coba lagi.', 'error');
            });

        return;
    }

    // ========================
    // CATEGORY FORM FUNCTIONS
    // ========================
    function addCategory() {
        const form = document.getElementById('categoryForm');
        if (!form.checkValidity()) {
            form.classList.add('was-validated');
            return;
        }

        const nameInput = document.getElementById('categoryName');
        const presetSelect = document.getElementById('categoryColorPreset');
        const label = nameInput.value.trim();
        const preset = presetSelect.value;
        const presetToWarna = {
            work: 'biru',
            learning: 'hijau',
            personal: 'kuning',
            purple: 'ungu',
            pink: 'pink',
            gray: 'abu-abu',
        };

        fetch('/kategori', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken(),
            },
            body: JSON.stringify({
                nama_kategori: label,
                warna: presetToWarna[preset] || null,
            }),
        })
            .then(res => {
                if (!res.ok) throw new Error('Gagal menambah kategori');
                return res.json().catch(() => ({}));
            })
            .then(() => {
                window.location.reload();
            })
            .catch(() => {
                showUiToast('Gagal menambah kategori. Silakan coba lagi.', 'error');
            });
    }

</script>
@endpush