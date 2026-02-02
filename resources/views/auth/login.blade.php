@extends('layouts.auth')

@section('title', 'Login - FocusDay')

@section('hero-title', 'Selamat Datang!')
@section('hero-subtitle', 'Kelola tugas harianmu dengan mudah dan tingkatkan produktivitasmu bersama FocusDay')

@section('content')
    <h2 class="form-title">Masuk</h2>
    <p class="form-subtitle">Masukkan kredensial Anda untuk melanjutkan</p>

    @if ($errors->has('login'))
        <div class="alert alert-danger border-0 bg-danger-subtle text-danger mb-4" role="alert" style="border-radius: 8px; font-size: 0.9rem;">
            {{ $errors->first('login') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login.submit') }}" id="loginForm">
        @csrf

        <!-- Username Field -->
        <div class="mb-3">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" class="custom-input" placeholder="Masukkan username" required autofocus value="{{ old('username') }}">
            @error('username')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password Field -->
        <div class="mb-3">
            <label for="password">Password</label>
            <div class="password-group">
                <input type="password" id="password" name="password" class="custom-input" placeholder="Masukkan password" required>
                <button type="button" class="password-toggle">
                    <i class="bi bi-eye"></i>
                </button>
            </div>
            @error('password')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember & Forgot Password -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" style="cursor: pointer; border-color: var(--border-color);">
                <label class="form-check-label text-muted small" for="remember" style="margin-bottom: 0; font-weight: 400; cursor: pointer;">
                    Ingat saya
                </label>
            </div>
            <a href="#" class="text-link small">Lupa password?</a>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn-main" id="loginBtn">Masuk</button>

        <!-- Divider -->
        <div class="divider-line">
            <span>atau</span>
        </div>

        <!-- Footer -->
        <div class="bottom-text">
            Belum punya akun? <a href="{{ route('register') }}" class="text-link">Buat akun</a>
        </div>
    </form>

    <!-- Loading Modal -->
    <div class="modal fade" id="loginLoadingModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow" style="border-radius: 12px; overflow: hidden;">
                <div class="modal-body py-4 px-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="spinner-border text-success" role="status" style="width: 2rem; height: 2rem; border-width: 3px;">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <div>
                            <div class="fw-bold text-dark fs-5 mb-1">Sedang Masuk...</div>
                            <div class="text-muted small">Mohon tunggu sebentar, mengalihkan ke beranda.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginForm = document.getElementById('loginForm');
            const loginBtn = document.getElementById('loginBtn');
            const loadingModalEl = document.getElementById('loginLoadingModal');
            let loadingModal = null;

            // Pastikan bootstrap sudah terload
            if (typeof bootstrap !== 'undefined' && loadingModalEl) {
                loadingModal = new bootstrap.Modal(loadingModalEl);
            }

            if (loginForm) {
                loginForm.addEventListener('submit', function(e) {
                    if (!this.checkValidity()) {
                        return;
                    }

                    e.preventDefault();
                    
                    if (loginBtn) {
                        loginBtn.disabled = true;
                        loginBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Memuat...';
                    }

                    if (loadingModal) {
                        loadingModal.show();
                    }

                    setTimeout(() => {
                        this.submit();
                    }, 800);
                });
            }
        });
    </script>
@endsection
