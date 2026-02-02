@extends('layouts.auth')

@section('title', 'Daftar - FocusDay')

@section('hero-title', 'Mulai Sekarang!')
@section('hero-subtitle', 'Buat akun untuk mulai mengelola tugas harianmu dan tingkatkan produktivitas bersama FocusDay')

@section('content')
    <h2 class="form-title">Buat Akun</h2>
    <p class="form-subtitle">Lengkapi data Anda untuk melanjutkan</p>

    <form method="POST" action="{{ route('register.store') }}">
        @csrf

        <!-- Username -->
        <div class="mb-3">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" class="custom-input" placeholder="Masukkan username" value="{{ old('username') }}" required>
            @error('username')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="custom-input" placeholder="Masukkan email" value="{{ old('email') }}" required>
            @error('email')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
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

        <!-- Confirm Password -->
        <div class="mb-4">
            <label for="password_confirmation">Konfirmasi Password</label>
            <div class="password-group">
                <input type="password" id="password_confirmation" name="password_confirmation" class="custom-input" placeholder="Ulangi password" required>
                <button type="button" class="password-toggle">
                    <i class="bi bi-eye"></i>
                </button>
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn-main">Daftar</button>

        <!-- Divider -->
        <div class="divider-line">
            <span>atau</span>
        </div>

        <!-- Footer -->
        <div class="bottom-text">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-link">Masuk</a>
        </div>
    </form>
@endsection
