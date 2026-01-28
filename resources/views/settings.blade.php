@extends('layouts.app')

@section('title', 'Pengaturan - FocusDay')

@section('content')
<div class="container-fluid px-0 px-md-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="fw-bold text-dark mb-1">Pengaturan</h2>
            <p class="text-muted mb-0">Sesuaikan preferensi tampilan dan akun Anda</p>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <!-- KOLOM KIRI: PROFIL PENGGUNA -->
        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4 text-center">
                    <!-- Avatar Placeholder (Ganti src dengan foto user asli nanti) -->
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name ?? 'User') }}&background=10b981&color=fff&size=128" 
                         alt="User Avatar" 
                         class="rounded-circle mb-3 shadow-sm"
                         style="width: 100px; height: 100px; object-fit: cover;">
                    
                    <h5 class="fw-bold text-dark mb-1">{{ $user->name ?? 'Pengguna' }}</h5>
                    <p class="text-muted small mb-4">{{ $user->email ?? '-' }}</p>
                    
                    <hr class="my-3">
                    
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-success btn-sm" type="button" id="editProfileBtn" aria-expanded="false" aria-controls="editProfileCollapse">
                            <i class="bi bi-pencil-square me-2"></i>Edit Profil
                        </button>
                        <button class="btn btn-outline-secondary btn-sm" type="button" id="changePasswordBtn" aria-expanded="false" aria-controls="changePasswordCollapse">
                            <i class="bi bi-key me-2"></i>Ganti Password
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- KOLOM KANAN: OPSI PENGATURAN -->
        <div class="col-lg-8">

            <div class="collapse mb-4" id="editProfileCollapse">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <h6 class="fw-bold mb-0 text-dark">
                            <i class="bi bi-person me-2" style="color: #10b981;"></i>Edit Profil
                        </h6>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('settings.profile.update') }}">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label fw-semibold text-dark" for="profileName">Nama</label>
                                <input id="profileName" type="text" class="form-control" name="name" value="{{ old('name', $user->name ?? '') }}" required>
                                @error('name')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold text-dark" for="profileEmail">Email</label>
                                <input id="profileEmail" type="email" class="form-control" name="email" value="{{ old('email', $user->email ?? '') }}" required>
                                @error('email')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end">
                                <button class="btn btn-success btn-sm" type="submit">Simpan Profil</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="collapse mb-4" id="changePasswordCollapse">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <h6 class="fw-bold mb-0 text-dark">
                            <i class="bi bi-key me-2" style="color: #10b981;"></i>Ganti Password
                        </h6>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('settings.password.update') }}">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label fw-semibold text-dark" for="currentPassword">Password Lama</label>
                                <input id="currentPassword" type="password" class="form-control" name="current_password" required>
                                @error('current_password')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold text-dark" for="newPassword">Password Baru</label>
                                <input id="newPassword" type="password" class="form-control" name="password" required>
                                @error('password')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold text-dark" for="newPasswordConfirmation">Konfirmasi Password Baru</label>
                                <input id="newPasswordConfirmation" type="password" class="form-control" name="password_confirmation" required>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button class="btn btn-success btn-sm" type="submit">Simpan Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- 1. PENGATURAN TAMPILAN -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-0 py-3">
                    <h6 class="fw-bold mb-0 text-dark">
                        <i class="bi bi-palette me-2" style="color: #10b981;"></i>Tampilan
                    </h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('settings.preferences.update') }}" id="preferencesForm">
                        @csrf
                        <input type="hidden" name="theme" id="prefTheme" value="{{ old('theme', $user->theme ?? 'light') }}">
                        <input type="hidden" name="week_start" id="prefWeekStart" value="{{ old('week_start', (string)($user->week_start ?? 1)) }}">

                        <!-- Opsi Mode Gelap -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <p class="fw-semibold mb-0 text-dark">Mode Gelap</p>
                                <p class="text-muted small mb-0">Aktifkan tema gelap untuk kenyamanan mata di malam hari.</p>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="darkModeSwitch" role="switch">
                            </div>
                        </div>

                        <!-- Opsi Hari Awal -->
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="fw-semibold mb-0 text-dark">Hari Pertama Minggu</p>
                                <p class="text-muted small mb-0">Menentukan hari awal pada tampilan kalender.</p>
                            </div>
                            <select class="form-select form-select-sm" style="width: 140px;" id="weekStartSelect">
                                <option value="0">Minggu</option>
                                <option value="1">Senin</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>

            <!-- 2. PENGATURAN NOTIFIKASI -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-0 py-3">
                    <h6 class="fw-bold mb-0 text-dark">
                        <i class="bi bi-bell me-2" style="color: #10b981;"></i>Notifikasi
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="fw-semibold mb-0 text-dark">Email Pengingat</p>
                            <p class="text-muted small mb-0">Terima email pengingat untuk tugas yang akan datang.</p>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="emailNotifSwitch" checked>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3. ZONA BAHAYA -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-0 py-3">
                    <h6 class="fw-bold mb-0 text-danger">
                        <i class="bi bi-exclamation-triangle me-2"></i>Zona Bahaya
                    </h6>
                </div>
                <div class="card-body">
                    <p class="text-muted small mb-3">Tindakan ini tidak dapat dibatalkan. Harap berhati-hati.</p>
                    <div class="d-flex flex-wrap gap-2">
                        <button class="btn btn-outline-danger btn-sm">
                            <i class="bi bi-trash me-2"></i>Hapus Semua Data Tugas
                        </button>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-box-arrow-right me-2"></i>Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Styling khusus halaman Settings agar konsisten */
    .card {
        border-radius: 12px;
        transition: transform 0.2s ease;
    }

    .form-check-input {
        cursor: pointer;
        width: 3em;
        height: 1.5em;
    }

    /* Warna Switch Toggle Sesuai Brand (Hijau) */
    .form-check-input:checked {
        background-color: #10b981;
        border-color: #10b981;
    }

    .form-check-input:focus {
        box-shadow: 0 0 0 0.25rem rgba(16, 185, 129, 0.25);
        border-color: #10b981;
    }

    /* Avatar Hover Effect */
    .rounded-circle {
        transition: transform 0.2s;
    }
    .rounded-circle:hover {
        transform: scale(1.05);
    }
</style>
@endpush

@push('scripts')
<script>
    const preferencesForm = document.getElementById('preferencesForm');
    const darkModeSwitch = document.getElementById('darkModeSwitch');
    const weekStartSelect = document.getElementById('weekStartSelect');
    const prefTheme = document.getElementById('prefTheme');
    const prefWeekStart = document.getElementById('prefWeekStart');

    if (preferencesForm && darkModeSwitch && weekStartSelect && prefTheme && prefWeekStart) {
        const initialTheme = prefTheme.value || 'light';
        const initialWeekStart = prefWeekStart.value || '1';

        weekStartSelect.value = initialWeekStart;
        darkModeSwitch.checked = initialTheme === 'dark';

        darkModeSwitch.addEventListener('change', function() {
            const nextTheme = this.checked ? 'dark' : 'light';
            prefTheme.value = nextTheme;
            document.documentElement.setAttribute('data-theme', nextTheme);
            localStorage.setItem('theme', nextTheme);
            preferencesForm.submit();
        });

        weekStartSelect.addEventListener('change', function() {
            prefWeekStart.value = this.value;
            preferencesForm.submit();
        });
    }

    const notifSwitch = document.getElementById('emailNotifSwitch');
    if (notifSwitch) {
        notifSwitch.addEventListener('change', function() {
            const status = this.checked ? 'Diaktifkan' : 'Dimatikan';
            console.log(`Notifikasi Email: ${status}`);
        });
    }

    const editProfileBtn = document.getElementById('editProfileBtn');
    const changePasswordBtn = document.getElementById('changePasswordBtn');
    const editProfileCollapseEl = document.getElementById('editProfileCollapse');
    const changePasswordCollapseEl = document.getElementById('changePasswordCollapse');

    if (editProfileBtn && changePasswordBtn && editProfileCollapseEl && changePasswordCollapseEl && window.bootstrap) {
        const editProfileCollapse = new bootstrap.Collapse(editProfileCollapseEl, { toggle: false });
        const changePasswordCollapse = new bootstrap.Collapse(changePasswordCollapseEl, { toggle: false });

        editProfileBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            editProfileCollapse.toggle();
        });

        changePasswordBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            changePasswordCollapse.toggle();
        });
    }
</script>
@endpush