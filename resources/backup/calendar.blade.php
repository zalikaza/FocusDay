@extends('layouts.app')

@section('title', 'Kalender - FocusDay')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="fw-bold text-dark mb-1">Kalender Rencana</h2>
                    <p class="text-muted mb-0">Lihat semua rencana Anda dalam sebulan</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <!-- Calendar Section -->
        <div class="col-lg-9 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <!-- Month Navigation -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <button class="btn btn-light">
                            <i class="bi bi-chevron-left"></i>
                        </button>
                        <h4 class="fw-bold mb-0">Januari 2026</h4>
                        <button class="btn btn-light">
                            <i class="bi bi-chevron-right"></i>
                        </button>
                    </div>
                    
                    <!-- Calendar Grid -->
                    <div class="calendar-grid">
                        <!-- Day Headers -->
                        <div class="calendar-day-header">Min</div>
                        <div class="calendar-day-header">Sen</div>
                        <div class="calendar-day-header">Sel</div>
                        <div class="calendar-day-header">Rab</div>
                        <div class="calendar-day-header">Kam</div>
                        <div class="calendar-day-header">Jum</div>
                        <div class="calendar-day-header">Sab</div>
                        
                        <!-- Previous Month Days (faded) -->
                        <div class="calendar-day other-month">28</div>
                        <div class="calendar-day other-month">29</div>
                        <div class="calendar-day other-month">30</div>
                        <div class="calendar-day other-month">31</div>
                        
                        <!-- Current Month Days -->
                        <div class="calendar-day" data-date="2026-01-01">
                            <span class="day-number">1</span>
                        </div>
                        <div class="calendar-day" data-date="2026-01-02">
                            <span class="day-number">2</span>
                        </div>
                        <div class="calendar-day" data-date="2026-01-03">
                            <span class="day-number">3</span>
                            <div class="task-indicators">
                                <span class="task-dot task-dot-work"></span>
                                <span class="task-dot task-dot-personal"></span>
                            </div>
                        </div>
                        
                        <div class="calendar-day" data-date="2026-01-04">
                            <span class="day-number">4</span>
                        </div>
                        <div class="calendar-day" data-date="2026-01-05">
                            <span class="day-number">5</span>
                            <div class="task-indicators">
                                <span class="task-dot task-dot-learning"></span>
                            </div>
                        </div>
                        <div class="calendar-day" data-date="2026-01-06">
                            <span class="day-number">6</span>
                        </div>
                        <div class="calendar-day" data-date="2026-01-07">
                            <span class="day-number">7</span>
                            <div class="task-indicators">
                                <span class="task-dot task-dot-work"></span>
                            </div>
                        </div>
                        <div class="calendar-day" data-date="2026-01-08">
                            <span class="day-number">8</span>
                        </div>
                        <div class="calendar-day" data-date="2026-01-09">
                            <span class="day-number">9</span>
                        </div>
                        <div class="calendar-day" data-date="2026-01-10">
                            <span class="day-number">10</span>
                            <div class="task-indicators">
                                <span class="task-dot task-dot-personal"></span>
                            </div>
                        </div>
                        
                        <div class="calendar-day" data-date="2026-01-11">
                            <span class="day-number">11</span>
                        </div>
                        <div class="calendar-day" data-date="2026-01-12">
                            <span class="day-number">12</span>
                        </div>
                        <div class="calendar-day" data-date="2026-01-13">
                            <span class="day-number">13</span>
                        </div>
                        <div class="calendar-day today" data-date="2026-01-14">
                            <span class="day-number">14</span>
                            <div class="task-indicators">
                                <span class="task-dot task-dot-work"></span>
                                <span class="task-dot task-dot-learning"></span>
                                <span class="task-dot task-dot-personal"></span>
                            </div>
                        </div>
                        <div class="calendar-day" data-date="2026-01-15">
                            <span class="day-number">15</span>
                            <div class="task-indicators">
                                <span class="task-dot task-dot-work"></span>
                                <span class="task-dot task-dot-learning"></span>
                            </div>
                        </div>
                        <div class="calendar-day" data-date="2026-01-16">
                            <span class="day-number">16</span>
                        </div>
                        <div class="calendar-day" data-date="2026-01-17">
                            <span class="day-number">17</span>
                        </div>
                        
                        <div class="calendar-day" data-date="2026-01-18">
                            <span class="day-number">18</span>
                        </div>
                        <div class="calendar-day" data-date="2026-01-19">
                            <span class="day-number">19</span>
                        </div>
                        <div class="calendar-day" data-date="2026-01-20">
                            <span class="day-number">20</span>
                            <div class="task-indicators">
                                <span class="task-dot task-dot-personal"></span>
                            </div>
                        </div>
                        <div class="calendar-day" data-date="2026-01-21">
                            <span class="day-number">21</span>
                        </div>
                        <div class="calendar-day" data-date="2026-01-22">
                            <span class="day-number">22</span>
                            <div class="task-indicators">
                                <span class="task-dot task-dot-work"></span>
                            </div>
                        </div>
                        <div class="calendar-day" data-date="2026-01-23">
                            <span class="day-number">23</span>
                        </div>
                        <div class="calendar-day" data-date="2026-01-24">
                            <span class="day-number">24</span>
                        </div>
                        
                        <div class="calendar-day" data-date="2026-01-25">
                            <span class="day-number">25</span>
                        </div>
                        <div class="calendar-day" data-date="2026-01-26">
                            <span class="day-number">26</span>
                            <div class="task-indicators">
                                <span class="task-dot task-dot-learning"></span>
                            </div>
                        </div>
                        <div class="calendar-day" data-date="2026-01-27">
                            <span class="day-number">27</span>
                        </div>
                        <div class="calendar-day" data-date="2026-01-28">
                            <span class="day-number">28</span>
                        </div>
                        <div class="calendar-day" data-date="2026-01-29">
                            <span class="day-number">29</span>
                        </div>
                        <div class="calendar-day" data-date="2026-01-30">
                            <span class="day-number">30</span>
                            <div class="task-indicators">
                                <span class="task-dot task-dot-work"></span>
                                <span class="task-dot task-dot-personal"></span>
                            </div>
                        </div>
                        <div class="calendar-day" data-date="2026-01-31">
                            <span class="day-number">31</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Sidebar Legend -->
        <div class="col-lg-3">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-semibold mb-3">
                        <i class="bi bi-palette me-2"></i>
                        Kategori
                    </h5>
                    
                    <div class="category-legend">
                        <div class="legend-item">
                            <span class="legend-dot task-dot-work"></span>
                            <span class="legend-label">Kerja</span>
                        </div>
                        <div class="legend-item">
                            <span class="legend-dot task-dot-learning"></span>
                            <span class="legend-label">Belajar</span>
                        </div>
                        <div class="legend-item">
                            <span class="legend-dot task-dot-personal"></span>
                            <span class="legend-label">Pribadi</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Quick Stats -->
            <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #f0fdf4 0%, #ffffff 100%);">
                <div class="card-body p-4">
                    <h5 class="fw-semibold mb-3">
                        <i class="bi bi-graph-up me-2 text-success"></i>
                        Statistik Bulan Ini
                    </h5>
                    
                    <div class="stat-item mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted">Total Tugas</span>
                            <span class="fw-bold text-dark">24</span>
                        </div>
                    </div>
                    
                    <div class="stat-item mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted">Selesai</span>
                            <span class="fw-bold text-success">18</span>
                        </div>
                    </div>
                    
                    <div class="stat-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted">Tertunda</span>
                            <span class="fw-bold text-warning">6</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Task Detail Modal -->
<div class="modal fade" id="taskDetailModal" tabindex="-1" aria-labelledby="taskDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" id="taskDetailModalLabel">Tugas - <span id="modalDate"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="taskDetailBody">
                <!-- Tasks will be populated here via JavaScript -->
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    .calendar-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 8px;
    }
    
    .calendar-day-header {
        text-align: center;
        font-weight: 600;
        color: #6b7280;
        padding: 0.75rem 0;
        font-size: 0.875rem;
    }
    
    .calendar-day {
        aspect-ratio: 1;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 0.5rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        cursor: pointer;
        transition: all 0.2s ease;
        background-color: #ffffff;
        position: relative;
    }
    
    .calendar-day:hover {
        border-color: var(--primary-green);
        background-color: #f0fdf4;
        transform: scale(1.05);
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.15);
    }
    
    .calendar-day.today {
        background: linear-gradient(135deg, var(--primary-green-light), #ffffff);
        border: 2px solid var(--primary-green);
    }
    
    .calendar-day.today .day-number {
        color: var(--primary-green-dark);
        font-weight: 700;
    }
    
    .calendar-day.other-month {
        background-color: #f9fafb;
        color: #d1d5db;
        cursor: default;
    }
    
    .calendar-day.other-month:hover {
        transform: none;
        border-color: #e5e7eb;
        background-color: #f9fafb;
    }
    
    .day-number {
        font-weight: 600;
        color: #1f2937;
        font-size: 0.875rem;
        margin-bottom: 0.25rem;
    }
    
    .task-indicators {
        display: flex;
        gap: 3px;
        flex-wrap: wrap;
        justify-content: center;
        margin-top: auto;
    }
    
    .task-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        display: inline-block;
    }
    
    .task-dot-work {
        background-color: #2563eb;
    }
    
    .task-dot-learning {
        background-color: #10b981;
    }
    
    .task-dot-personal {
        background-color: #f59e0b;
    }
    
    /* Legend Styles */
    .category-legend {
        display: flex;
        flex-direction: column;
        gap: 0.875rem;
    }
    
    .legend-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .legend-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
    }
    
    .legend-label {
        font-weight: 500;
        color: #4b5563;
        font-size: 0.875rem;
    }
    
    .stat-item {
        padding-bottom: 0.75rem;
        border-bottom: 1px solid #e5e7eb;
    }
    
    .stat-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }
    
    .btn-light {
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 0.5rem 1rem;
        transition: all 0.2s ease;
    }
    
    .btn-light:hover {
        background-color: var(--bg-light);
        border-color: #d1d5db;
    }
    
    /* Modal Styles */
    .modal-content {
        border-radius: 16px;
    }
    
    .task-item-modal {
        padding: 0.875rem;
        border-left: 3px solid;
        background-color: #f9fafb;
        border-radius: 6px;
        margin-bottom: 0.75rem;
    }
    
    .task-item-modal:last-child {
        margin-bottom: 0;
    }
    
    .task-item-modal.task-work {
        border-left-color: #2563eb;
    }
    
    .task-item-modal.task-learning {
        border-left-color: #10b981;
    }
    
    .task-item-modal.task-personal {
        border-left-color: #f59e0b;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .calendar-grid {
            gap: 4px;
        }
        
        .calendar-day {
            padding: 0.25rem;
        }
        
        .day-number {
            font-size: 0.75rem;
        }
        
        .task-dot {
            width: 4px;
            height: 4px;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Sample task data
    const tasksData = {
        '2026-01-03': [
            { title: 'Review Code', category: 'work', time: '09:00' },
            { title: 'Gym', category: 'personal', time: '17:00' }
        ],
        '2026-01-05': [
            { title: 'Laravel Tutorial', category: 'learning', time: '14:00' }
        ],
        '2026-01-07': [
            { title: 'Team Meeting', category: 'work', time: '10:00' }
        ],
        '2026-01-10': [
            { title: 'Grocery Shopping', category: 'personal', time: '15:00' }
        ],
        '2026-01-14': [
            { title: 'Meeting dengan Tim Developer', category: 'work', time: '09:00' },
            { title: 'Belajar Laravel Livewire', category: 'learning', time: '14:00' },
            { title: 'Olahraga Sore', category: 'personal', time: '17:00' }
        ],
        '2026-01-15': [
            { title: 'Sprint Planning', category: 'work', time: '09:00' },
            { title: 'PHP Advanced Course', category: 'learning', time: '19:00' }
        ],
        '2026-01-20': [
            { title: 'Family Visit', category: 'personal', time: '14:00' }
        ],
        '2026-01-22': [
            { title: 'Project X Deadline', category: 'work', time: '12:00' }
        ],
        '2026-01-26': [
            { title: 'Vue.js Workshop', category: 'learning', time: '10:00' }
        ],
        '2026-01-30': [
            { title: 'Client Presentation', category: 'work', time: '15:00' },
            { title: 'Dentist Appointment', category: 'personal', time: '09:00' }
        ]
    };
    
    // Category labels
    const categoryLabels = {
        'work': 'Kerja',
        'learning': 'Belajar',
        'personal': 'Pribadi'
    };
    
    // Add click event to calendar days
    document.querySelectorAll('.calendar-day[data-date]').forEach(day => {
        day.addEventListener('click', function() {
            const date = this.getAttribute('data-date');
            const tasks = tasksData[date];
            
            if (tasks) {
                showTaskDetails(date, tasks);
            }
        });
    });
    
    function showTaskDetails(date, tasks) {
        // Format date
        const dateObj = new Date(date);
        const options = { day: 'numeric', month: 'long', year: 'numeric' };
        const formattedDate = dateObj.toLocaleDateString('id-ID', options);
        
        // Update modal title
        document.getElementById('modalDate').textContent = formattedDate;
        
        // Generate task list
        let tasksHtml = '';
        tasks.forEach(task => {
            tasksHtml += `
                <div class="task-item-modal task-${task.category}">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="mb-1 fw-semibold">${task.title}</h6>
                            <span class="badge rounded-pill category-badge category-${task.category}">${categoryLabels[task.category]}</span>
                        </div>
                        <small class="text-muted">
                            <i class="bi bi-clock me-1"></i>${task.time}
                        </small>
                    </div>
                </div>
            `;
        });
        
        document.getElementById('taskDetailBody').innerHTML = tasksHtml;
        
        // Show modal
        const modal = new bootstrap.Modal(document.getElementById('taskDetailModal'));
        modal.show();
    }
</script>
@endpush
