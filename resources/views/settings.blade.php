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
    
    <div class="row">
        <!-- KOLOM KIRI: PROFIL PENGGUNA -->
        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4 text-center">
                    <!-- Avatar Placeholder (Ganti src dengan foto user asli nanti) -->
                    <img src="https://ui-avatars.com/api/?name=User+Focus&background=10b981&color=fff&size=128" 
                         alt="User Avatar" 
                         class="rounded-circle mb-3 shadow-sm"
                         style="width: 100px; height: 100px; object-fit: cover;">
                    
                    <h5 class="fw-bold text-dark mb-1">Pengguna FocusDay</h5>
                    <p class="text-muted small mb-4">user@focusday.com</p>
                    
                    <hr class="my-3">
                    
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-success btn-sm">
                            <i class="bi bi-pencil-square me-2"></i>Edit Profil
                        </button>
                        <button class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-key me-2"></i>Ganti Password
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- KOLOM KANAN: OPSI PENGATURAN -->
        <div class="col-lg-8">
            
            <!-- 1. PENGATURAN TAMPILAN -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-0 py-3">
                    <h6 class="fw-bold mb-0 text-dark">
                        <i class="bi bi-palette me-2" style="color: #10b981;"></i>Tampilan
                    </h6>
                </div>
                <div class="card-body">
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
                        <select class="form-select form-select-sm" style="width: 140px;">
                            <option value="0">Minggu</option>
                            <option value="1">Senin</option>
                        </select>
                    </div>
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
                        <a href="{{ route('login') }}" class="btn btn-danger btn-sm">
                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                        </a>
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
    // --- Simulasi Toggle Dark Mode ---
    // Catatan: Di Laravel asli, Anda akan menghubungkan ini ke LocalStorage atau Backend
    const darkModeSwitch = document.getElementById('darkModeSwitch');
    
    // Cek apakah HTML sudah punya atribut dark mode saat load
    if (document.documentElement.getAttribute('data-theme') === 'dark') {
        darkModeSwitch.checked = true;
    }

    darkModeSwitch.addEventListener('change', function() {
        if(this.checked) {
            document.documentElement.setAttribute('data-theme', 'dark');
        } else {
            document.documentElement.removeAttribute('data-theme');
        }
    });

    // --- Simulasi Notifikasi ---
    const notifSwitch = document.getElementById('emailNotifSwitch');
    notifSwitch.addEventListener('change', function() {
        const status = this.checked ? 'Diaktifkan' : 'Dimatikan';
        // Disini Anda bisa memanggil API/Fetch request ke Laravel
        console.log(`Notifikasi Email: ${status}`);
    });
</script>
@endpush