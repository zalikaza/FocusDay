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
            <div class="d-flex gap-2 overflow-auto pb-2" id="categoryFilters">
                <button class="btn btn-sm btn-filter active" data-filter="all">
                    <i class="bi bi-grid me-1"></i> Semua
                </button>
                <button class="btn btn-sm btn-filter" data-filter="work">
                    <i class="bi bi-briefcase me-1"></i> Kerja
                </button>
                <button class="btn btn-sm btn-filter" data-filter="learning">
                    <i class="bi bi-book me-1"></i> Belajar
                </button>
                <button class="btn btn-sm btn-filter" data-filter="personal">
                    <i class="bi bi-person me-1"></i> Pribadi
                </button>
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
    
    /* Styling untuk Filter Buttons */
    .btn-filter {
        padding: 0.5rem 1.2rem;
        border-radius: 20px;
        background-color: #f3f4f6;
        color: #4b5563;
        border: 1px solid transparent;
        font-weight: 500;
        white-space: nowrap;
        transition: all 0.2s;
    }

    .btn-filter:hover {
        background-color: #e5e7eb;
    }

    .btn-filter.active {
        background-color: #10b981; /* Warna Brand Hijau */
        color: white;
        box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.3);
    }

    /* Styling Badge Kategori (Sama seperti Home) */
    .category-badge {
        padding: 0.4rem 0.9rem;
        font-weight: 500;
        font-size: 0.75rem;
        letter-spacing: 0.3px;
    }
    .category-work { background-color: #dbeafe; color: #1e40af; }
    .category-learning { background-color: #d1fae5; color: #065f46; }
    .category-personal { background-color: #fef3c7; color: #92400e; }

    /* --- TASK COMPLETED STYLES (SAMA DENGAN HOME) --- */
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

    /* Highlight Tanggal pada halaman ini */
    .task-date {
        font-size: 0.8rem;
        font-weight: 600;
        color: #6b7280;
        background: #f3f4f6;
        padding: 2px 8px;
        border-radius: 4px;
        margin-right: 8px;
    }

    /* Dark Mode Overrides */
    html[data-theme="dark"] .task-title { color: #f1f5f9; }
    html[data-theme="dark"] .list-group-item:hover { background-color: rgba(255, 255, 255, 0.03); }
    html[data-theme="dark"] .btn-filter { background-color: #374151; color: #e5e7eb; }
    html[data-theme="dark"] .btn-filter:hover { background-color: #4b5563; }
    html[data-theme="dark"] .task-date { background: #374151; color: #d1d5db; }
    html[data-theme="dark"] .task-completed { color: #9ca3af !important; }
</style>
@endpush

@push('scripts')
<script>
    // --- DATA SIMULASI (DARI JANUARI SAMPAI DESEMBER) ---
    const allTasksData = [
        // Januari
        { id: 1, title: "Rapat Tahunan Awal", category: "work", date: "1 Jan 2026", time: "09:00 - 12:00", completed: false },
        { id: 2, title: "Belajar React Basics", category: "learning", date: "5 Jan 2026", time: "19:00 - 21:00", completed: false },
        { id: 3, title: "Ke Dokter Gigi", category: "personal", date: "10 Jan 2026", time: "14:00 - 15:00", completed: false },
        { id: 4, title: "Meeting dengan Tim Developer", category: "work", date: "15 Jan 2026", time: "09:00 - 10:30", completed: false },
        { id: 5, title: "Review Pull Request #234", category: "work", date: "16 Jan 2026", time: "11:00 - 12:00", completed: true },
        { id: 6, title: "Belajar Laravel Livewire", category: "learning", date: "18 Jan 2026", time: "14:00 - 16:00", completed: false },
        
        // Februari
        { id: 7, title: "Rencana Liburan", category: "personal", date: "1 Feb 2026", time: "20:00 - 21:00", completed: false },
        { id: 8, title: "Project Deadline Alpha", category: "work", date: "14 Feb 2026", time: "23:59 - Selesai", completed: false },
        { id: 9, title: "Kursus Online Advanced", category: "learning", date: "20 Feb 2026", time: "08:00 - 10:00", completed: true },

        // Maret
        { id: 10, title: "Ulang Tahun Pacar", category: "personal", date: "10 Mar 2026", time: "All Day", completed: false },
        { id: 11, title: "Sprint Planning Q2", category: "work", date: "15 Mar 2026", time: "09:00 - 11:00", completed: false },
    ];

    let currentFilter = 'all';
    let currentSearch = '';

    // --- FUNGSI UTAMA UNTUK TASK COMPLETION ---
    function initializeTaskCheckboxes() {
        document.querySelectorAll('.task-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const taskItem = this.closest('.task-item');
                const taskTitle = taskItem.querySelector('.task-title');
                const taskId = parseInt(taskItem.getAttribute('data-task-id'));
                
                if (this.checked) {
                    // Animasi fade out untuk berpindah
                    taskItem.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                    taskItem.style.opacity = '0.5';
                    taskItem.style.transform = 'translateX(-10px)';
                    
                    setTimeout(() => {
                        // Pindahkan task ke section Terselesaikan
                        moveTaskToCompleted(taskItem, taskId);
                        updateTaskCounters();
                        updateDataArray(taskId, true);
                    }, 300);
                } else {
                    // Jika dicentang ulang, pindah kembali ke aktif
                    taskTitle.classList.remove('task-completed');
                    moveTaskToActive(taskItem, taskId);
                    updateTaskCounters();
                    updateDataArray(taskId, false);
                }
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
            allTasksData[index].completed = completed;
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
            const matchCategory = currentFilter === 'all' || task.category === currentFilter;
            const matchSearch = task.title.toLowerCase().includes(currentSearch.toLowerCase());
            return matchCategory && matchSearch;
        });

        // Pisahkan tugas aktif dan selesai
        const activeTasks = filteredTasks.filter(task => !task.completed);
        const completedTasks = filteredTasks.filter(task => task.completed);

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

    function createTaskElement(task, isCompleted = false) {
        const badgeClass = `category-${task.category}`;
        const categoryLabel = getCategoryLabel(task.category);
        
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
                    <label class="task-title mb-1 ${isCompleted ? 'task-completed' : ''}">${task.title}</label>
                    <div class="d-flex align-items-center flex-wrap gap-2 mt-1">
                        <span class="task-date">
                            <i class="bi bi-calendar3 me-1"></i>${task.date}
                        </span>
                        <span class="text-muted small">
                            <i class="bi bi-clock me-1"></i>${task.time}
                        </span>
                    </div>
                </div>
                <span class="badge rounded-pill category-badge ${badgeClass} ms-2">${categoryLabel}</span>
            </div>
        `;
        
        return taskElement;
    }

    // Helper untuk label kategori
    function getCategoryLabel(category) {
        const labels = {
            'work': 'Kerja',
            'learning': 'Belajar',
            'personal': 'Pribadi'
        };
        return labels[category] || category;
    }

    // --- INTERAKSI FILTER & SEARCH ---
    
    // 1. Klik Tab Filter
    document.querySelectorAll('.btn-filter').forEach(btn => {
        btn.addEventListener('click', function() {
            // Update visual active state
            document.querySelectorAll('.btn-filter').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            // Update Logika Filter
            currentFilter = this.getAttribute('data-filter');
            renderAllTasks();
        });
    });

    // 2. Ketik di Search Bar
    document.getElementById('searchTaskInput').addEventListener('input', function() {
        currentSearch = this.value;
        renderAllTasks();
    });

    // 3. Inisialisasi
    document.addEventListener('DOMContentLoaded', function() {
        renderAllTasks();
    });

</script>
@endpush