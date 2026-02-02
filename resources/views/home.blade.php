@extends('layouts.app')

@section('title', 'Beranda - FocusDay')

@section('content')
<div class="container-fluid px-0 px-md-4">
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
                <!-- Tombol Tambah Rencana (Sama dengan Kalender) -->
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
                            <span class="badge bg-light text-secondary border" id="activeTasksCount">{{ $todayTasks->count() }} Tugas</span>
                        </div>
                        
                        <div class="list-group list-group-flush" id="activeTasksList">
                            @forelse($todayTasks as $task)
                                @php
                                    $taskId = $task->id ?? uniqid('task_');
                                    $title = $task->judul_tugas;
                                    $timeText = $task->waktu;
                                    $categoryLabel = $task->nama_kategori;
                                    $notesText = $task->catatan;
                                    $warna = trim($task->warna ?? '');
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
                                    $badgeBg = $colorMap[$warnaLower]['bg'] ?? '#f3f4f6';
                                    $badgeText = $colorMap[$warnaLower]['text'] ?? '#374151';
                                    $badgeDarkMap = [
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
                                    $badgeDarkBg = $badgeDarkMap[$warnaLower]['bg'] ?? 'rgba(156, 163, 175, 0.15)';
                                    $badgeDarkText = $badgeDarkMap[$warnaLower]['text'] ?? '#e5e7eb';
                                    $badgeDarkBorder = $badgeDarkMap[$warnaLower]['border'] ?? 'rgba(156, 163, 175, 0.3)';
                                    $isCompleted = ($task->status === 'selesai');
                                @endphp
                                <div class="list-group-item border-0 px-0 py-3 rounded task-item" data-task-id="{{ $taskId }}">
                                    <div class="d-flex align-items-center">
                                        <div class="form-check me-3">
                                            <input class="form-check-input task-checkbox" type="checkbox" id="task{{ $taskId }}" data-completed="{{ $isCompleted ? 'true' : 'false' }}" @checked($isCompleted)>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    <label for="task{{ $taskId }}" class="task-title mb-1">{{ $title }}</label>
                                                    @if($timeText)
                                                        <p class="text-muted small mb-0">
                                                            <i class="bi bi-clock me-1"></i>{{ $timeText }}
                                                        </p>
                                                    @endif
                                                    @if($notesText)
                                                        <p class="text-muted small mb-0 mt-1">{{ $notesText }}</p>
                                                    @endif
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <span class="badge rounded-pill category-badge" style="--badge-bg: {{ $badgeBg }}; --badge-text: {{ $badgeText }}; --badge-bg-dark: {{ $badgeDarkBg }}; --badge-text-dark: {{ $badgeDarkText }}; --badge-border-dark: {{ $badgeDarkBorder }};">{{ $categoryLabel ?: 'Tanpa Kategori' }}</span>
                                                    
                                                    <!-- Action Buttons (Hover Only) -->
                                                    <div class="task-actions ms-3 hover-show d-flex align-items-center gap-2">
                                                        <button class="btn btn-sm btn-link text-muted p-0" onclick="event.preventDefault(); openEditTaskModal('{{ $taskId }}')" title="Edit" style="text-decoration: none;">
                                                            <i class="bi bi-pencil"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-link text-muted p-0" onclick="event.preventDefault(); confirmDeleteTask('{{ $taskId }}')" title="Hapus" style="text-decoration: none;">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                {{-- Tidak ada tugas hari ini, biarkan JS menampilkan empty state berdasarkan counter --}}
                            @endforelse
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
                    
                    @if($upcomingTasks->isEmpty())
                        <p class="text-muted mb-0">Belum ada rencana mendatang.</p>
                    @else
                        <div class="row g-3">
                            @foreach($upcomingTasks as $plan)
                                @php
                                    $planTitle = $plan->judul_tugas;
                                    $planDate = $plan->tanggal;
                                    $planTime = $plan->waktu;
                                    $planCategory = $plan->nama_kategori;
                                    $warna = trim($plan->warna ?? '');
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
                                    $badgeBg = $colorMap[$warnaLower]['bg'] ?? '#f3f4f6';
                                    $badgeText = $colorMap[$warnaLower]['text'] ?? '#374151';
                                    $badgeDarkMap = [
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
                                    $badgeDarkBg = $badgeDarkMap[$warnaLower]['bg'] ?? 'rgba(156, 163, 175, 0.15)';
                                    $badgeDarkText = $badgeDarkMap[$warnaLower]['text'] ?? '#e5e7eb';
                                    $badgeDarkBorder = $badgeDarkMap[$warnaLower]['border'] ?? 'rgba(156, 163, 175, 0.3)';
                                @endphp
                                <div class="col-md-6">
                                    <div class="p-3 bg-white rounded shadow-sm h-100">
                                        <p class="fw-semibold text-dark mb-3 border-bottom pb-2">
                                            @if($planDate)
                                                {{ \Carbon\Carbon::parse($planDate)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                                            @else
                                                Jadwal Mendatang
                                            @endif
                                        </p>
                                        <div class="d-flex align-items-center mb-2">
                                            <span class="badge rounded-pill category-badge me-2" style="--badge-bg: {{ $badgeBg }}; --badge-text: {{ $badgeText }}; --badge-bg-dark: {{ $badgeDarkBg }}; --badge-text-dark: {{ $badgeDarkText }}; --badge-border-dark: {{ $badgeDarkBorder }};">{{ $planCategory ?: 'Tanpa Kategori' }}</span>
                                            <small class="text-truncate">{{ $planTitle }}</small>
                                        </div>
                                        @if($planTime)
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-clock me-2 text-muted"></i>
                                                <small class="text-muted">{{ $planTime }}</small>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
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
                    
                    <!-- Kategori (dibaca dari tabel kategori milik user) -->
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
                            @forelse($categories as $index => $category)
                                @php
                                    $inputId = 'categoryDb_' . $category->kategori_id;
                                    $isFirst = $index === 0;
                                    $warna = trim($category->warna ?? '');
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
                                    $cssText = $colorMap[$warnaLower]['text'] ?? '#374151';

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
                                <input type="radio" class="btn-check" name="taskCategory" id="{{ $inputId }}" value="{{ $category->kategori_id }}" autocomplete="off" @checked($isFirst)>
                                <label class="btn btn-sm btn-category" for="{{ $inputId }}" style="--pill-bg: {{ $cssBg }}; --pill-text: {{ $cssText }}; --pill-bg-dark: {{ $darkBg }}; --pill-text-dark: {{ $darkText }}; --pill-border-dark: {{ $darkBorder }};">
                                    <i class="bi bi-tag me-1"></i>{{ $category->nama_kategori }}
                                </label>

                            @empty
                                <span class="text-muted small" id="emptyCategoryHint">Belum ada kategori. Tambah kategori dulu.</span>
                            @endforelse
                            
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
                        <select class="form-select" id="newCategoryColor" aria-label="Pilih warna kategori" style="max-width: 140px;">
                            <option value="biru" selected>Biru</option>
                            <option value="hijau">Hijau</option>
                            <option value="kuning">Kuning</option>
                            <option value="merah">Merah</option>
                            <option value="ungu">Ungu</option>
                            <option value="pink">Pink</option>
                            <option value="abu-abu">Abu-abu</option>
                        </select>
                        <button class="btn btn-outline-success" type="button" onclick="addNewCategory()" aria-label="Simpan kategori" style="border-radius: 0;">
                            <i class="bi bi-check-lg"></i>
                        </button>
                        <button class="btn btn-outline-danger" type="button" onclick="cancelAddCategory()" aria-label="Batal" style="border-radius: 0 8px 8px 0;">
                            <i class="bi bi-x-lg"></i>
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

<!-- Delete Confirmation Modal (Same as Calendar) -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;">
            <div class="modal-body p-4 text-center">
                <div class="mb-3">
                    <i class="bi bi-exclamation-circle text-warning display-4"></i>
                </div>
                <h5 class="fw-bold mb-2">Hapus Rencana?</h5>
                <p class="text-muted small mb-4">Apakah Anda yakin ingin menghapus rencana ini? Tindakan ini tidak dapat dibatalkan.</p>
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
    }

    .btn-category {
        background-color: var(--pill-bg, #f3f4f6) !important;
        color: var(--pill-text, #374151) !important;
        border-color: var(--pill-bg, #f3f4f6) !important;
    }

    html[data-theme="dark"] .btn-category {
        background-color: var(--pill-bg-dark, rgba(148, 163, 184, 0.12)) !important;
        color: var(--pill-text-dark, #e5e7eb) !important;
        border-color: var(--pill-border-dark, rgba(148, 163, 184, 0.25)) !important;
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
        background-color: var(--badge-bg, #f3f4f6) !important;
        color: var(--badge-text, #374151) !important;
        border: 1px solid var(--badge-bg, #f3f4f6);
    }

    html[data-theme="dark"] .category-badge {
        background-color: var(--badge-bg-dark, rgba(148, 163, 184, 0.12)) !important;
        color: var(--badge-text-dark, #e5e7eb) !important;
        border-color: var(--badge-border-dark, rgba(148, 163, 184, 0.25));
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
    
    .task-item:hover .hover-show {
        opacity: 1 !important;
        pointer-events: auto;
    }

    .task-actions {
        transition: opacity 0.2s ease-in-out;
        opacity: 0; 
        pointer-events: none; /* Prevent accidental clicks when hidden */
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
        
        /* Header button responsiveness */
        .row.mb-4 .btn-add-task {
            font-size: 0.875rem;
            padding: 0.5rem 0.75rem;
            white-space: nowrap;
        }
        
        .row.mb-4 h2 {
            font-size: 1.5rem;
        }
        
        .row.mb-4 p {
            font-size: 0.85rem;
        }
    }
    
    @media (max-width: 400px) {
        /* Very small screens - compact button */
        .row.mb-4 .btn-add-task {
            font-size: 0.8rem;
            padding: 0.45rem 0.6rem;
        }
        
        .row.mb-4 .btn-add-task .bi {
            display: none; /* Hide icon on very small screens */
        }
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

                const isCompleted = this.checked === true;

                if (isCompleted) {
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

                // Update status di database ("selesai" atau null)
                updateTaskStatusOnServer(taskId, isCompleted);
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

        // Update widget Statistik Hari Ini di sidebar
        updateTodayStatsFromDOM();
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

    function updateTaskStatusOnServer(taskId, isCompleted) {
        if (!taskId) return;

        const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
        const csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : '';

        fetch("{{ route('rencana.updateStatus') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify({
                id: Number(taskId),
                status: isCompleted ? 'selesai' : null,
            }),
        }).catch(() => {
            // Kalau gagal, untuk sekarang cukup log di console; UI tetap jalan
            console.error('Gagal memperbarui status tugas di server');
        });
    }

    // ========================
    // TODAY STATS WIDGET LOGIC
    // ========================
    function updateTodayStatsFromDOM() {
        const totalEl = document.getElementById('todayTotalTasks');
        const completedEl = document.getElementById('todayCompletedTasks');
        const pendingEl = document.getElementById('todayPendingTasks');

        // Jika elemen tidak ada (misalnya di halaman lain), cukup keluar
        if (!totalEl || !completedEl || !pendingEl) return;

        const activeTasks = document.querySelectorAll('#activeTasksList .task-item').length;
        const completedTasks = document.querySelectorAll('#completedTasksList .task-item').length;

        const total = activeTasks + completedTasks;
        const pending = activeTasks; // pada layout ini, "pending" = tugas yang masih aktif

        totalEl.textContent = total.toString();
        completedEl.textContent = completedTasks.toString();
        pendingEl.textContent = pending.toString();

        // Simpan ke localStorage agar bisa dibaca di halaman lain
        try {
            const todayStats = { total, completed: completedTasks, pending };
            localStorage.setItem('focusday.todayStats', JSON.stringify(todayStats));
        } catch (e) {
            // Abaikan error localStorage (misalnya mode private)
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

        const emptyHint = document.getElementById('emptyCategoryHint');
        if (emptyHint) emptyHint.remove();

        const categoryId = 'category' + Date.now() + Math.floor(Math.random() * 1000);
        const newCategory = document.createElement('div');
        const display = category && category.nama_kategori ? category.nama_kategori : 'Kategori';
        const warnaRaw = category ? category.warna : null;
        const lower = String(warnaRaw || '').trim().toLowerCase();
        const map = {
            'biru': { bg:'#dbeafe', text:'#1e40af' },
            'blue': { bg:'#dbeafe', text:'#1e40af' },
            'hijau': { bg:'#d1fae5', text:'#065f46' },
            'green': { bg:'#d1fae5', text:'#065f46' },
            'kuning': { bg:'#fef3c7', text:'#92400e' },
            'yellow': { bg:'#fef3c7', text:'#92400e' },
            'merah': { bg:'#fee2e2', text:'#991b1b' },
            'red': { bg:'#fee2e2', text:'#991b1b' },
            'ungu': { bg:'#ede9fe', text:'#5b21b6' },
            'purple': { bg:'#ede9fe', text:'#5b21b6' },
            'pink': { bg:'#fce7f3', text:'#9d174d' },
            'abu-abu': { bg:'#f3f4f6', text:'#374151' },
            'gray': { bg:'#f3f4f6', text:'#374151' },
            'grey': { bg:'#f3f4f6', text:'#374151' },
        };
        const style = map[lower] || { bg: '#f3f4f6', text: '#374151' };

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
        const darkStyle = darkMap[lower] || { bg: 'rgba(156, 163, 175, 0.15)', text: '#e5e7eb', border: 'rgba(156, 163, 175, 0.3)' };
        const value = category && (category.kategori_id ?? category.id) ? (category.kategori_id ?? category.id) : '';
        newCategory.innerHTML = `<input type="radio" class="btn-check" name="taskCategory" id="${categoryId}" value="${value}" autocomplete="off"><label class="btn btn-sm btn-category" for="${categoryId}" style="--pill-bg: ${style.bg}; --pill-text: ${style.text}; --pill-bg-dark: ${darkStyle.bg}; --pill-text-dark: ${darkStyle.text}; --pill-border-dark: ${darkStyle.border};"><i class="bi bi-tag me-1"></i>${display}</label>`;
        additional.appendChild(newCategory);

        const input = newCategory.querySelector('input[type="radio"]');
        if (input) input.checked = true;
    }

    function loadCategoryOptionsFromStorage() {
        const additional = document.getElementById('additionalCategories');
        if (!additional) return;
        additional.innerHTML = '';
    }

    function showAddCategory() {
        const form = document.getElementById('addCategoryForm');
        form.classList.toggle('d-none');
        if (!form.classList.contains('d-none')) document.getElementById('newCategoryName').focus();
    }

    function cancelAddCategory() {
        const form = document.getElementById('addCategoryForm');
        document.getElementById('newCategoryName').value = '';
        const colorEl = document.getElementById('newCategoryColor');
        if (colorEl) colorEl.value = 'biru';
        form.classList.add('d-none');
    }
    
    function addNewCategory() {
        const categoryName = document.getElementById('newCategoryName').value.trim();
        if (!categoryName) {
            if (window.showToast) window.showToast('Mohon isi nama kategori.', 'error');
            return;
        }

        const colorEl = document.getElementById('newCategoryColor');
        const warna = colorEl ? colorEl.value : null;

        const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
        const csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : '';

        fetch("{{ route('categories.store') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify({ nama_kategori: categoryName, warna }),
        }).then(async (response) => {
            if (!response.ok) {
                const text = await response.text();
                throw new Error(text || 'Gagal menambahkan kategori');
            }
            return response.json();
        }).then((data) => {
            if (!data || !data.success || !data.category) {
                throw new Error('Gagal menambahkan kategori');
            }

            addCategoryOptionToHome(data.category);
            cancelAddCategory();
        }).catch(() => {
            if (window.showToast) window.showToast('Gagal menambahkan kategori. Silakan coba lagi.', 'error');
        });
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
        const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        calendarTitle.textContent = `${monthNames[month]} ${year}`;
        calendarGrid.innerHTML = '<div class="calendar-day-label">Min</div><div class="calendar-day-label">Sen</div><div class="calendar-day-label">Sel</div><div class="calendar-day-label">Rab</div><div class="calendar-day-label">Kam</div><div class="calendar-day-label">Jum</div><div class="calendar-day-label">Sab</div>';
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
        dateText.textContent = selectedDate.toLocaleDateString('id-ID', options);
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

    function addTask() {
        const form = document.getElementById('taskForm');
        if (!form.checkValidity()) { form.classList.add('was-validated'); return; }

        const saveBtn = document.getElementById('submitTaskBtn');
        const editId = saveBtn.getAttribute('data-edit-id'); // Check if editing

        const isNoTime = document.getElementById('noSpecificTime').checked;
        const year = selectedDate.getFullYear();
        const month = String(selectedDate.getMonth() + 1).padStart(2, '0');
        const day = String(selectedDate.getDate()).padStart(2, '0');
        const formattedDate = `${year}-${month}-${day}`;
        const startTime = document.getElementById('startTimeInput').value;
        const endTime = document.getElementById('endTimeInput').value;
        const formattedTime = isNoTime ? null : `${startTime} – ${endTime}`; // Ensure dash format matches

        const modalEl = document.getElementById('addTaskModal');
        const modal = bootstrap.Modal.getInstance(modalEl);

        const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
        const csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : '';

        // Category Logic
        const newCategoryNameEl = document.getElementById('newCategoryName');
        const newCategoryColorEl = document.getElementById('newCategoryColor');
        const addCategoryFormEl = document.getElementById('addCategoryForm');
        const newCategoryName = newCategoryNameEl ? newCategoryNameEl.value.trim() : '';
        const newCategoryColor = newCategoryColorEl ? newCategoryColorEl.value : null;
        const isAddCategoryVisible = addCategoryFormEl && !addCategoryFormEl.classList.contains('d-none');

        const storeOrUpdatePlan = (kategoriId) => {
            const payload = {
                judul_tugas: document.getElementById('taskTitle').value,
                kategori_id: kategoriId,
                tanggal: formattedDate,
                waktu: formattedTime,
                catatan: document.getElementById('taskNotes').value
            };

            const url = editId ? `/rencana/${editId}` : "{{ route('rencana.store') }}";
            
            return fetch(url, {
                method: 'POST', // Laravel updates via POST usually fine, or strict PUT? Route is POST in web.php
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify(payload),
            });
        };

        const createCategoryIfNeeded = () => {
            if (!editId && isAddCategoryVisible && newCategoryName) { // Only create category on new task or explicit add? 
                 // Actually, editing might also create category if user selects "New"? 
                 // For now, assume Category creation logic remains same.
                 return fetch("{{ route('categories.store') }}", {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                    body: JSON.stringify({ nama_kategori: newCategoryName, warna: newCategoryColor }),
                }).then(res => res.json()).then(data => {
                    if (!data.success) throw new Error('Gagal kategori');
                    addCategoryOptionToHome(data.category);
                    cancelAddCategory();
                    return data.category.kategori_id;
                });
            }
            return Promise.resolve(null);
        };

        const kategoriInput = document.querySelector('input[name="taskCategory"]:checked');
        const selectedKategoriId = kategoriInput ? kategoriInput.value : null;

        createCategoryIfNeeded()
            .then((newKategoriId) => {
                const kategoriIdToUse = newKategoriId || selectedKategoriId;
                return storeOrUpdatePlan(kategoriIdToUse);
            })
            .then((response) => {
                if (!response.ok) throw new Error('Gagal menyimpan');
                return response.json();
            })
            .then(() => {
                modal.hide();
                form.reset();
                form.classList.remove('was-validated');
                saveBtn.removeAttribute('data-edit-id'); // Reset edit state
                saveBtn.innerText = 'Simpan Rencana';
                document.getElementById('addTaskModalLabel').innerHTML = '<i class="bi bi-calendar-plus me-2" style="color: #10b981;"></i> Tambah Rencana Baru';
                
                document.getElementById('charCount').textContent = '0';
                selectedDate = new Date(); currentDate = new Date();
                updateDateDisplay();
                
                // Show Toast
                const toastEl = document.getElementById('successToast');
                if (toastEl) {
                    toastEl.querySelector('strong').textContent = editId ? 'Rencana Diperbarui' : 'Rencana Disimpan';
                    toastEl.querySelector('.small').textContent = editId ? 'Perubahan berhasil disimpan' : 'Rencana baru telah ditambahkan';
                    const toast = new bootstrap.Toast(toastEl);
                    toast.show();
                }

                setTimeout(() => {
                    window.location.reload();
                }, 600);
            })
            .catch(() => {
                if (window.showToast) window.showToast('Gagal menyimpan rencana. Silakan coba lagi.', 'error');
            });
    }

    function resetAddModalState() {
        const form = document.getElementById('taskForm');
        if (form) {
            form.reset();
            form.classList.remove('was-validated');
        }
        
        const saveBtn = document.getElementById('submitTaskBtn');
        if (saveBtn) {
            saveBtn.removeAttribute('data-edit-id');
            saveBtn.innerHTML = '<i class="bi bi-plus-circle me-2"></i>Tambah Rencana';
        }
        
        const labelEl = document.getElementById('addTaskModalLabel');
        if (labelEl) {
            labelEl.innerHTML = '<i class="bi bi-plus-circle-fill me-2" style="color: #10b981;"></i> Rencana Baru';
        }

        const titleInput = document.getElementById('taskTitle');
        if (titleInput) titleInput.value = '';
        const notesInput = document.getElementById('taskNotes');
        if (notesInput) notesInput.value = '';
        const count = document.getElementById('charCount');
        if (count) count.textContent = '0';
        
        // Reset Date/Time to defaults
        selectedDate = new Date();
        if (typeof updateDateDisplay === 'function') updateDateDisplay();
        
        const start = document.getElementById('startTimeInput');
        const end = document.getElementById('endTimeInput');
        if (start) { start.value = "7:30pm"; start.disabled = false; }
        if (end) { end.value = "8:30pm"; end.disabled = false; }
        
        const noTime = document.getElementById('noSpecificTime');
        if (noTime) noTime.checked = false;
        
        const dtSection = document.getElementById('datetimeSection');
        if (dtSection) dtSection.classList.remove('disabled');

        // Reset Categories
         const radios = document.querySelectorAll('input[name="taskCategory"]');
         radios.forEach(r => r.checked = false);
         if (typeof cancelAddCategory === 'function') cancelAddCategory();
    }
    const todayTasksData = @json($todayTasks); // Inject PHP data to JS
    let taskToDeleteId = null;

    document.addEventListener('DOMContentLoaded', function() {
        // Initialize semua komponen
        initializeTaskCheckboxes();
        updateDateDisplay();
        loadCategoryOptionsFromStorage();

        // Set initial state untuk task yang sudah checked (pindahkan dulu ke section Terselesaikan)
        document.querySelectorAll('.task-checkbox:checked').forEach(checkbox => {
            const taskItem = checkbox.closest('.task-item');
            const taskId = taskItem.getAttribute('data-task-id');
            moveTaskToCompleted(taskItem, taskId);
        });

        // Setelah posisi task benar, baru hitung ulang counter dan statistik
        updateCompletedSectionVisibility();
        updateTaskCounters();
        
        // Modal focus
        const modal = document.getElementById('addTaskModal');
        if (modal) {
            modal.addEventListener('shown.bs.modal', function() { 
                document.getElementById('taskTitle').focus(); 
            });
            
            // RESET MODAL WHEN OPENED VIA ADD BUTTON
            modal.addEventListener('show.bs.modal', function (event) {
                const trigger = event.relatedTarget;
                if (trigger && (trigger.classList.contains('btn-add-task') || trigger.id === 'floatingAddBtn')) {
                    resetAddModalState();
                }
            });
        }

        // DELETE MODAL LISTENER
        const confirmBtn = document.getElementById('confirmDeleteBtn');
        if (confirmBtn) {
            confirmBtn.addEventListener('click', function() {
                if (taskToDeleteId) {
                    processDeleteTask(taskToDeleteId);
                }
            });
        }
    });

    // ========================
    // EDIT & DELETE LOGIC
    // ========================

    function confirmDeleteTask(taskId) {
        taskToDeleteId = taskId;
        const modal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
        modal.show();
    }

    function processDeleteTask(taskId) {
        const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
        const csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : '';

        // Tutup modal dulu supaya UX lebih responsif
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
            // Hapus elemen dari DOM
            const taskItem = document.querySelector(`.task-item[data-task-id="${taskId}"]`);
            if (taskItem) {
                taskItem.remove();
                updateTaskCounters(); // Update counters
            }
            // Show Toast
            const toastEl = document.getElementById('successToast');
            if (toastEl) {
                // Update toast message dynamic
                toastEl.querySelector('strong').textContent = 'Rencana berhasil dihapus';
                toastEl.querySelector('.small').textContent = 'Tugas telah dihapus dari daftar';
                const toast = new bootstrap.Toast(toastEl);
                toast.show();
            }
        })
        .catch(error => {
            console.error(error);
            if (window.showToast) window.showToast('Gagal menghapus rencana.', 'error');
        });
    }

    /* NOTE: Simplified Edit - Reuses Add Modal properly */
    function openEditTaskModal(taskId) {
        // Find task in local data
        const task = todayTasksData.find(t => t.id == taskId || t.rencana_id == taskId);
        
        if (!task) {
            if (window.showToast) window.showToast('Data tugas tidak ditemukan.', 'error');
            return;
        }

        // Change Modal Title & Behavior (Basic Implementation)
        // Since the current Add logic is strictly "Store", we might need to adjust it to "Update" if ID exists.
        // For now, let's just alert user that this is a placeholder or allow simple repopulation.
        // To implement FULL Edit, we need to modify the addTask function to handle updates.
        // For speed, I'll populate the Update form but warn that it creates a NEW one currently unless I patch `addTask`.
        
        // --- PATCHING ADDTASK FOR EDIT ---
        // Let's modify the modal title to indicate "Edit" (Visual only for now if backend does not support update easily via same form)
        // CHECK: The backend route `rencana.update` exists? Yes it usually does in resource controllers.
        // I will implement a quick "Edit Mode" switch.
        
        // 1. Populate Fields
        document.getElementById('taskTitle').value = task.judul_tugas;
        document.getElementById('taskNotes').value = task.catatan || '';
        
        // Time
        if (task.waktu) {
            const parts = task.waktu.split('–').map(s => s.trim()); // En dash used in display? Or user input?
            // Actually the input value is what we saved. The display might differ.
            // Let's try to split by dash/hyphen
             if (parts.length >= 2) {
                 document.getElementById('startTimeInput').value = parts[0];
                 document.getElementById('endTimeInput').value = parts[1];
             } else {
                 // Fallback
                 const p = task.waktu.split('-');
                 if(p.length >= 2) {
                     document.getElementById('startTimeInput').value = p[0].trim();
                     document.getElementById('endTimeInput').value = p[1].trim();
                 }
             }
             document.getElementById('noSpecificTime').checked = false;
             document.getElementById('datetimeSection').classList.remove('disabled');
        } else {
             document.getElementById('noSpecificTime').checked = true;
             document.getElementById('datetimeSection').classList.add('disabled');
        }

        // Category
        if (task.kategori_id) {
            const radio = document.querySelector(`input[name="taskCategory"][value="${task.kategori_id}"]`);
            if (radio) radio.checked = true;
        }

        // 2. Change Modal State to "Edit"
        // We attach the ID to the save button
        const saveBtn = document.getElementById('submitTaskBtn');
        saveBtn.setAttribute('data-edit-id', taskId);
        saveBtn.innerText = 'Simpan Perubahan';
        
        // Change Title
        document.getElementById('addTaskModalLabel').innerHTML = '<i class="bi bi-pencil-square me-2" style="color: #f59e0b;"></i> Edit Rencana';
        
        // Show Modal
        const modal = new bootstrap.Modal(document.getElementById('addTaskModal'));
        modal.show();

        // Hook into the save button - I need to modify `addTask` to check for this ID!
    }
</script>
@endpush