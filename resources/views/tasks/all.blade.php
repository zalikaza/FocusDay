@extends('layouts.app')

@section('title', 'Semua Tugas - FocusDay')

@section('content')
<div class="container-fluid px-0 px-md-4">
    <!-- Header Section -->
    <div class="row mb-4 align-items-center">
        <div class="col-md-6 col-12">
            <h2 class="fw-bold text-dark mb-1">Semua Tugas</h2>
            <p class="text-muted mb-0">Riwayat dan daftar lengkap semua aktivitas</p>
        </div>
        <div class="col-md-6 col-12 mt-3 mt-md-0">
            <!-- Search Bar -->
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0">
                    <i class="bi bi-search text-muted"></i>
                </span>
                <input type="text" class="form-control border-start-0 ps-0" id="searchTaskInput" placeholder="Cari tugas berdasarkan judul..." style="border-radius: 0 10px 10px 0;">
            </div>
        </div>
    </div>
    
    <!-- Filter Kategori (Tab) -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex gap-2 pb-2 flex-nowrap" id="categoryFilters">
                <button class="btn btn-sm btn-filter active" data-filter="all">
                    <i class="bi bi-grid me-1"></i> Semua
                </button>
                <button class="btn btn-sm btn-filter" data-filter="none">
                    <i class="bi bi-tag me-1"></i> Tanpa Kategori
                </button>
                @foreach($categories as $cat)
                    @php
                        $warna = trim($cat->warna ?? '');
                        $warnaLower = strtolower($warna);
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
                        $cssBg = $colorMap[$warnaLower]['bg'] ?? '#f3f4f6';
                        $cssText = $colorMap[$warnaLower]['text'] ?? '#4b5563';

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
                        $darkBg = $darkMap[$warnaLower]['bg'] ?? 'rgba(156, 163, 175, 0.15)';
                        $darkText = $darkMap[$warnaLower]['text'] ?? '#e5e7eb';
                        $darkBorder = $darkMap[$warnaLower]['border'] ?? 'rgba(156, 163, 175, 0.3)';
                    @endphp
                    <button class="btn btn-sm btn-filter" data-filter="cat-{{ $cat->kategori_id }}" style="--filter-bg: {{ $cssBg }}; --filter-text: {{ $cssText }}; --filter-border: transparent; --filter-bg-dark: {{ $darkBg }}; --filter-text-dark: {{ $darkText }}; --filter-border-dark: {{ $darkBorder }};">
                        <i class="bi bi-tag me-1"></i> {{ $cat->nama_kategori }}
                    </button>
                @endforeach
            </div>
        </div>
    </div>
    
    <!-- List Tugas (Full Width) -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <!-- Section Tugas Aktif -->
                    <div id="activeTasksSection">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="fw-semibold mb-0">Tugas Aktif</h5>
                            <span class="badge bg-light text-secondary border" id="activeTasksCount">0 Tugas</span>
                        </div>
                        
                        <div class="list-group list-group-flush" id="activeTasksList">
                            <!-- Tugas aktif akan muncul di sini -->
                        </div>
                    </div>
                    
                    <!-- Section Tugas Terselesaikan -->
                    <div class="completed-section mt-5" id="completedTasksSection" style="display: none;">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="fw-semibold mb-0 text-success">
                                <i class="bi bi-check-circle me-2"></i>Terselesaikan
                            </h5>
                            <span class="badge bg-success-subtle text-success border" id="completedTasksCount">0 Tugas</span>
                        </div>
                        
                        <div class="list-group list-group-flush" id="completedTasksList">
                            <!-- Tugas selesai akan muncul di sini -->
                        </div>
                    </div>
                    
                    <!-- Empty State -->
                    <div class="text-center py-5 d-none" id="emptyState">
                        <i class="bi bi-inbox text-muted" style="font-size: 4rem; opacity: 0.3;"></i>
                        <p class="text-muted mt-3">Tidak ada tugas yang ditemukan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Task Modal (Reused Add Task Modal Structure) -->
    <div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
                <div class="modal-header border-0 pb-3" style="border-bottom: 1px solid #e5e7eb !important;">
                    <div class="w-100 d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="modal-title fw-bold text-dark mb-0" id="addTaskModalLabel">Edit Rencana</h5>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>
                <div class="modal-body p-4 pt-3">
                    <form id="taskForm" class="needs-validation" novalidate>
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark">Judul Tugas</label>
                            <input type="text" class="form-control" id="taskTitle" required style="border-radius: 10px;">
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark">Catatan</label>
                            <textarea class="form-control" id="taskNotes" rows="2" style="border-radius: 10px;"></textarea>
                        </div>
                        <!-- Simplified Category & Time for All Tasks Page Edit -->
                        <div class="alert alert-info small">
                            <i class="bi bi-info-circle me-1"></i> Untuk mengubah tanggal atau kategori, silakan gunakan menu Kalender.
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal" style="border-radius: 10px;">Batal</button>
                    <button type="button" class="btn btn-success" id="submitTaskBtn" style="border-radius: 10px;">Simpan Perubahan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal (Shared) -->
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
</div>
@endsection

@push('styles')
<style>
    /* Reuse styles dari Home untuk konsistensi */
    .list-group-item {
        transition: background-color 0.2s ease;
        cursor: pointer;
    }
    .list-group-item:hover {
        background-color: #f9fafb;
    }
    .list-group-item:hover .hover-show {
        opacity: 1 !important;
        pointer-events: auto;
    }
    .task-actions {
        transition: opacity 0.2s ease-in-out;
        opacity: 0;
        pointer-events: none;
    }

    /* Filter bar: jangan ke-clip saat tombol active (ring/shadow) + scrollbar tipis */
    #categoryFilters {
        overflow-x: auto !important;
        overflow-y: visible !important;
        align-items: center;
        flex-wrap: nowrap;
        padding-left: 6px;
        padding-right: 6px;
        padding-top: 6px;
        padding-bottom: 10px;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: thin;
        scrollbar-color: rgba(156, 163, 175, 0.7) transparent;
    }
    #categoryFilters::-webkit-scrollbar { height: 3px; }
    #categoryFilters::-webkit-scrollbar-track { background: transparent; }
    #categoryFilters::-webkit-scrollbar-thumb {
        background-color: rgba(156, 163, 175, 0.7);
        border-radius: 999px;
    }
    html[data-theme="dark"] #categoryFilters {
        scrollbar-color: rgba(107, 114, 128, 0.8) transparent;
    }
    html[data-theme="dark"] #categoryFilters::-webkit-scrollbar-thumb {
        background-color: rgba(107, 114, 128, 0.8);
    }

    /* Styling untuk Filter Buttons */
    .btn-filter {
        padding: 0.5rem 1.2rem;
        border-radius: 20px;
        background-color: var(--filter-bg, #f3f4f6);
        color: var(--filter-text, #4b5563);
        border: 1px solid var(--filter-border, transparent);
        font-weight: 500;
        white-space: nowrap;
        flex: 0 0 auto;
        transition: all 0.2s;
    }

    .btn-filter:hover {
        background-color: var(--filter-bg, #e5e7eb);
    }

    .btn-filter.active {
        border-color: #10b981;
        box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.2);
    }

    .category-badge {
        background: var(--badge-bg, #e5e7eb) !important;
        color: var(--badge-text, #374151) !important;
        border: 1px solid transparent;
        font-weight: 600;
    }

    /* --- TASK COMPLETED STYLES (samakan dengan Beranda) --- */
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

    @media (max-width: 576px) {
        #categoryFilters {
            gap: 10px;
            padding-left: 10px;
            padding-right: 10px;
            padding-top: 8px;
            padding-bottom: 12px;
        }

        .btn-filter {
            padding: 0.45rem 0.9rem;
            font-size: 0.85rem;
        }
    }

    /* Dark Mode Overrides */
    html[data-theme="dark"] .btn-filter {
        background-color: var(--filter-bg-dark, #374151);
        color: var(--filter-text-dark, #e5e7eb);
        border-color: var(--filter-border-dark, transparent);
    }
    html[data-theme="dark"] .btn-filter:hover {
        background-color: var(--filter-bg-dark, #4b5563);
    }

    html[data-theme="dark"] .category-badge {
        background: var(--badge-bg-dark, rgba(156, 163, 175, 0.15)) !important;
        color: var(--badge-text-dark, #e5e7eb) !important;
        border-color: var(--badge-border-dark, rgba(156, 163, 175, 0.3));
    }

    html[data-theme="dark"] .task-title {
        color: #f9fafb;
    }

    html[data-theme="dark"] .task-completed {
        color: #9ca3af !important;
    }
</style>
@endpush

@push('scripts')
<script>
    const backendTasks = @json($tasks);
    const allTasksData = (backendTasks || []).map(t => ({
        id: t.id,
        title: t.judul_tugas,
        dateIso: t.tanggal,
        time: t.waktu,
        notes: t.catatan,
        status: t.status,
        kategori_id: t.kategori_id,
        kategori_nama: t.nama_kategori,
        warna: t.warna,
    }));

    let currentFilter = 'all';
    let currentSearch = '';

    // --- FUNGSI UTAMA UNTUK TASK COMPLETION ---
    function initializeTaskCheckboxes() {
        document.querySelectorAll('.task-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const taskItem = this.closest('.task-item');
                const taskTitle = taskItem.querySelector('.task-title');
                const taskId = parseInt(taskItem.getAttribute('data-task-id'));
                if (!taskId) return;

                const checkedNow = this.checked;
                const newStatus = checkedNow ? 'selesai' : null;

                const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
                const csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : '';

                this.disabled = true;

                fetch(`/rencana/${taskId}/toggle-status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({ status: newStatus }),
                })
                    .then(res => {
                        if (!res.ok) throw new Error('Gagal mengubah status');
                        return res.json().catch(() => ({}));
                    })
                    .then(() => {
                        if (checkedNow) {
                            taskItem.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                            taskItem.style.opacity = '0.5';
                            taskItem.style.transform = 'translateX(-10px)';
                            
                            setTimeout(() => {
                                moveTaskToCompleted(taskItem, taskId);
                                updateTaskCounters();
                                updateDataArray(taskId, true);
                            }, 300);
                        } else {
                            taskTitle.classList.remove('task-completed');
                            moveTaskToActive(taskItem, taskId);
                            updateTaskCounters();
                            updateDataArray(taskId, false);
                        }
                    })
                    .catch(() => {
                        this.checked = !checkedNow;
                        if (window.showToast) {
                            window.showToast('Gagal mengubah status tugas. Silakan coba lagi.', 'error');
                        }
                    })
                    .finally(() => {
                        this.disabled = false;
                    });
            });
        });
    }

    function moveTaskToCompleted(taskItem, taskId) {
        const completedList = document.getElementById('completedTasksList');
        const taskTitle = taskItem.querySelector('.task-title');

        // Tambah class completed ke seluruh elemen yang perlu
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

    function updateDataArray(taskId, completed) {
        const index = allTasksData.findIndex(task => task.id === taskId);
        if (index !== -1) {
            allTasksData[index].status = completed ? 'selesai' : null;
        }
    }

    function updateTaskCounters() {
        const activeTasks = document.querySelectorAll('#activeTasksList .task-item').length;
        const completedTasks = document.querySelectorAll('#completedTasksList .task-item').length;

        // Update counters
        document.getElementById('activeTasksCount').textContent = `${activeTasks} Tugas`;
        document.getElementById('completedTasksCount').textContent = `${completedTasks} Tugas`;

        // Tampilkan empty state jika tidak ada task
        updateEmptyState();
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

    function updateEmptyState() {
        const emptyState = document.getElementById('emptyState');
        const activeTasks = document.querySelectorAll('#activeTasksList .task-item').length;
        const completedTasks = document.querySelectorAll('#completedTasksList .task-item').length;

        if (activeTasks === 0 && completedTasks === 0) {
            emptyState.classList.remove('d-none');
        } else {
            emptyState.classList.add('d-none');
        }
    }

    // --- RENDER LOGIC ---
    function renderAllTasks() {
        const activeList = document.getElementById('activeTasksList');
        const completedList = document.getElementById('completedTasksList');

        activeList.innerHTML = '';
        completedList.innerHTML = '';

        // Filter Logic
        const filteredTasks = allTasksData.filter(task => {
            const filter = String(currentFilter || 'all');

            let matchCategory = true;
            if (filter === 'none') {
                matchCategory = !task.kategori_id;
            } else if (filter.startsWith('cat-')) {
                const idStr = filter.replace('cat-', '');
                matchCategory = String(task.kategori_id || '') === String(idStr);
            } else if (filter === 'all') {
                matchCategory = true;
            }

            const title = String(task.title || '');
            const matchSearch = title.toLowerCase().includes(String(currentSearch || '').toLowerCase());
            return matchCategory && matchSearch;
        });

        // Pisahkan tugas aktif dan selesai
        const activeTasks = filteredTasks.filter(task => task.status !== 'selesai');
        const completedTasks = filteredTasks.filter(task => task.status === 'selesai');

        // Render tugas aktif
        activeTasks.forEach(task => {
            activeList.appendChild(createTaskElement(task));
        });

        // Render tugas selesai
        completedTasks.forEach(task => {
            completedList.appendChild(createTaskElement(task, true));
        });

        // Update UI
        updateTaskCounters();
        updateCompletedSectionVisibility();
        initializeTaskCheckboxes();
    }

    function resolveCategoryBadgeStyle(rawColor) {
        const lower = String(rawColor || '').trim().toLowerCase();
        const map = {
            'biru': { bg: '#dbeafe', text: '#1e40af' },
            'blue': { bg: '#dbeafe', text: '#1e40af' },
            'hijau': { bg: '#d1fae5', text: '#065f46' },
            'green': { bg: '#d1fae5', text: '#065f46' },
            'kuning': { bg: '#fef3c7', text: '#92400e' },
            'yellow': { bg: '#fef3c7', text: '#92400e' },
            'merah': { bg: '#fee2e2', text: '#991b1b' },
            'red': { bg: '#fee2e2', text: '#991b1b' },
            'ungu': { bg: '#ede9fe', text: '#5b21b6' },
            'purple': { bg: '#ede9fe', text: '#5b21b6' },
            'pink': { bg: '#fce7f3', text: '#9d174d' },
            'abu-abu': { bg: '#f3f4f6', text: '#374151' },
            'gray': { bg: '#f3f4f6', text: '#374151' },
            'grey': { bg: '#f3f4f6', text: '#374151' },
        };
        const darkMap = {
            'biru': { bg: 'rgba(37, 99, 235, 0.15)', text: '#93c5fd', border: 'rgba(59, 130, 246, 0.3)' },
            'blue': { bg: 'rgba(37, 99, 235, 0.15)', text: '#93c5fd', border: 'rgba(59, 130, 246, 0.3)' },
            'hijau': { bg: 'rgba(16, 185, 129, 0.15)', text: '#6ee7b7', border: 'rgba(16, 185, 129, 0.3)' },
            'green': { bg: 'rgba(16, 185, 129, 0.15)', text: '#6ee7b7', border: 'rgba(16, 185, 129, 0.3)' },
            'kuning': { bg: 'rgba(245, 158, 11, 0.15)', text: '#fcd34d', border: 'rgba(245, 158, 11, 0.3)' },
            'yellow': { bg: 'rgba(245, 158, 11, 0.15)', text: '#fcd34d', border: 'rgba(245, 158, 11, 0.3)' },
            'merah': { bg: 'rgba(239, 68, 68, 0.15)', text: '#fca5a5', border: 'rgba(239, 68, 68, 0.3)' },
            'red': { bg: 'rgba(239, 68, 68, 0.15)', text: '#fca5a5', border: 'rgba(239, 68, 68, 0.3)' },
            'ungu': { bg: 'rgba(124, 58, 237, 0.15)', text: '#ddd6fe', border: 'rgba(124, 58, 237, 0.3)' },
            'purple': { bg: 'rgba(124, 58, 237, 0.15)', text: '#ddd6fe', border: 'rgba(124, 58, 237, 0.3)' },
            'pink': { bg: 'rgba(236, 72, 153, 0.15)', text: '#fbcfe8', border: 'rgba(236, 72, 153, 0.3)' },
            'abu-abu': { bg: 'rgba(156, 163, 175, 0.15)', text: '#e5e7eb', border: 'rgba(156, 163, 175, 0.3)' },
            'gray': { bg: 'rgba(156, 163, 175, 0.15)', text: '#e5e7eb', border: 'rgba(156, 163, 175, 0.3)' },
            'grey': { bg: 'rgba(156, 163, 175, 0.15)', text: '#e5e7eb', border: 'rgba(156, 163, 175, 0.3)' },
        };

        const base = map[lower] || { bg: '#f3f4f6', text: '#374151' };
        const dark = darkMap[lower] || { bg: 'rgba(156, 163, 175, 0.15)', text: '#e5e7eb', border: 'rgba(156, 163, 175, 0.3)' };
        return { ...base, darkBg: dark.bg, darkText: dark.text, darkBorder: dark.border };
    }

    function formatDateId(dateIso) {
        if (!dateIso) return '';
        const d = new Date(dateIso);
        if (Number.isNaN(d.getTime())) return String(dateIso);
        return d.toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });
    }

    function createTaskElement(task, isCompleted = false) {
        const categoryLabel = task.kategori_nama || 'Tanpa Kategori';
        const style = resolveCategoryBadgeStyle(task.warna);
        const dateLabel = formatDateId(task.dateIso);
        const timeLabel = task.time ? task.time : 'All Day';

        const taskElement = document.createElement('div');
        taskElement.className = `list-group-item border-0 px-0 py-3 rounded task-item`;
        taskElement.setAttribute('data-task-id', task.id);

        const checkedAttr = isCompleted ? 'checked' : '';

        taskElement.innerHTML = `
            <div class="d-flex align-items-start">
                <div class="form-check me-3 mt-1">
                    <input class="form-check-input task-checkbox" type="checkbox" ${checkedAttr}>
                </div>
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <label class="task-title mb-1 ${isCompleted ? 'task-completed' : ''}">${task.title}</label>
                            <div class="d-flex align-items-center flex-wrap gap-2 mt-1">
                                <span class="task-date">
                                    <i class="bi bi-calendar3 me-1"></i>${dateLabel}
                                </span>
                                <span class="text-muted small">
                                    <i class="bi bi-clock me-1"></i>${timeLabel}
                                </span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="badge rounded-pill category-badge" style="--badge-bg: ${style.bg}; --badge-text: ${style.text}; --badge-bg-dark: ${style.darkBg}; --badge-text-dark: ${style.darkText}; --badge-border-dark: ${style.darkBorder};">${categoryLabel}</span>
                            
                            <!-- Action Buttons -->
                            <div class="task-actions ms-3 hover-show d-flex align-items-center gap-2">
                                <button class="btn btn-sm btn-link text-muted p-0" onclick="event.preventDefault(); openEditTaskModal('${task.id}')" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-sm btn-link text-muted p-0" onclick="event.preventDefault(); confirmDeleteTask('${task.id}')" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;

        return taskElement;
    }

    // --- INTERAKSI FILTER & SEARCH ---

    document.querySelectorAll('.btn-filter').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.btn-filter').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            currentFilter = this.getAttribute('data-filter');
            renderAllTasks();
        });
    });

    document.getElementById('searchTaskInput').addEventListener('input', function() {
        currentSearch = this.value;
        renderAllTasks();
    });

    // --- EDIT & DELETE LOGIC ---
    let taskToDeleteId = null;

    function confirmDeleteTask(taskId) {
        taskToDeleteId = taskId;
        const modal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
        modal.show();
    }

    document.getElementById('confirmDeleteBtn')?.addEventListener('click', function() {
        if (!taskToDeleteId) return;
        
        const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
        const csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : '';

        // Tutup modal
        const modalEl = document.getElementById('deleteConfirmationModal');
        const modal = bootstrap.Modal.getInstance(modalEl);
        if (modal) modal.hide();

        fetch(`/rencana/${taskToDeleteId}/delete`, {
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
            const index = allTasksData.findIndex(t => t.id == taskToDeleteId);
            if (index !== -1) {
                allTasksData.splice(index, 1);
                renderAllTasks();
            }
            if (window.showToast) {
                window.showToast('Rencana berhasil dihapus.', 'success');
            }
        })
        .catch(error => {
            console.error(error);
            if (window.showToast) {
                window.showToast('Gagal menghapus rencana.', 'error');
            }
        });
    });

    function openEditTaskModal(taskId) {
        const task = allTasksData.find(t => t.id == taskId);
        if (!task) return;

        document.getElementById('taskTitle').value = task.title;
        document.getElementById('taskNotes').value = task.notes || '';
        document.getElementById('submitTaskBtn').onclick = () => saveTaskEdit(taskId);

        const modal = new bootstrap.Modal(document.getElementById('addTaskModal'));
        modal.show();
    }

    function saveTaskEdit(taskId) {
        const title = document.getElementById('taskTitle').value;
        const notes = document.getElementById('taskNotes').value;
        
        const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
        const csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : '';

        // We need date to be safe, pass existing date from local data?
        const task = allTasksData.find(t => t.id == taskId);
        if(!task) return;

        fetch(`/rencana/${taskId}`, {
            method: 'POST', // Route definition is POST for update
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify({
                judul_tugas: title,
                catatan: notes,
                // Pass existing values to avoid clearing them if backend requires them
                tanggal: task.dateIso, 
                waktu: task.time,
                kategori_id: task.kategori_id
            }),
        })
        .then(response => {
            if (!response.ok) throw new Error('Gagal menyimpan');
            return response.json();
        })
        .then(() => {
             // Update Local Data
            const index = allTasksData.findIndex(t => t.id == taskId);
            if (index !== -1) {
                allTasksData[index].title = title;
                allTasksData[index].notes = notes;
                renderAllTasks();
            }
            const modal = bootstrap.Modal.getInstance(document.getElementById('addTaskModal'));
            modal.hide();
            
            // Show Toast using global layout helper
            if (window.showToast) {
                window.showToast('Perubahan berhasil disimpan.', 'success');
            }
        })
        .catch(err => {
            console.error(err);
            if (window.showToast) {
                window.showToast('Gagal menyimpan perubahan.', 'error');
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        renderAllTasks();

        // Setup filter listeners
        document.querySelectorAll('#categoryFilters .btn-filter').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('#categoryFilters .btn-filter').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                currentFilter = this.getAttribute('data-filter');
                renderAllTasks();
            });
        });

        // Setup search listener
        const searchInput = document.getElementById('searchTaskInput');
        if (searchInput) {
            searchInput.addEventListener('input', function(e) {
                currentSearch = e.target.value;
                renderAllTasks();
            });
        }
        
        // Modal Event for Edit
        // We reuse the 'addTaskModal' for editing
        // No special listener needed as we call openEditTaskModal directly
    });

</script>
@endpush