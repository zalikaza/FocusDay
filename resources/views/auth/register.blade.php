<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - FocusDay</title>
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    
    <!-- Google Fonts - Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5.3.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            overflow: hidden;
            transition: background-color 0.3s ease;
        }

        /* ===============================
           SPLIT SCREEN CONTAINER
           =============================== */
        .login-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* ===============================
           LEFT SIDE - ANIMATED GREEN BG
           =============================== */
        .left-section {
            flex: 1;
            background: linear-gradient(135deg, #10b981 0%, #059669 50%, #047857 100%);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            transition: background 0.3s ease;
        }

        /* Dark Mode Left */
        [data-theme="dark"] .left-section {
            background: linear-gradient(135deg, #047857 0%, #065f46 50%, #064e3b 100%);
        }

        /* Logo in LEFT Section */
        .left-logo {
            position: absolute;
            top: 2rem;
            left: 2rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            z-index: 10;
        }

        .left-logo .logo-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .left-logo .logo-icon svg {
            width: 20px;
            height: 20px;
        }

        .left-logo .brand-name {
            font-size: 1.25rem;
            font-weight: 800;
            color: white;
            margin: 0;
        }

        /* Animated Background Shapes */
        .animated-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .shape {
            position: absolute;
            opacity: 0.15;
            animation: float-shape 20s ease-in-out infinite;
        }

        .shape-1 {
            width: 300px;
            height: 300px;
            background: #ffffff;
            border-radius: 50%;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape-2 {
            width: 200px;
            height: 200px;
            background: #ffffff;
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            bottom: 20%;
            right: 15%;
            animation-delay: 3s;
        }

        .shape-3 {
            width: 150px;
            height: 150px;
            background: #ffffff;
            border-radius: 50%;
            top: 60%;
            left: 20%;
            animation-delay: 6s;
        }

        .shape-4 {
            width: 250px;
            height: 250px;
            background: #ffffff;
            border-radius: 63% 37% 54% 46% / 55% 48% 52% 45%;
            top: 40%;
            right: 20%;
            animation-delay: 9s;
        }

        @keyframes float-shape {
            0%, 100% {
                transform: translateY(0) rotate(0deg) scale(1);
            }
            25% {
                transform: translateY(-30px) rotate(5deg) scale(1.05);
            }
            50% {
                transform: translateY(-50px) rotate(-5deg) scale(0.95);
            }
            75% {
                transform: translateY(-30px) rotate(3deg) scale(1.02);
            }
        }

        /* Illustration Content */
        .illustration-content {
            position: relative;
            z-index: 10;
            text-align: center;
            padding: 2rem;
            color: white;
        }

        .illustration-content h2 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .illustration-content p {
            font-size: 1.125rem;
            opacity: 0.95;
            max-width: 400px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* ===============================
           RIGHT SIDE - WHITE FORM
           =============================== */
        .right-section {
            flex: 1;
            background: #ffffff;
            display: flex;
            flex-direction: column;
            padding: 1.5rem;
            position: relative;
            transition: background-color 0.3s ease;
        }

        /* Dark Mode Right */
        [data-theme="dark"] .right-section {
            background: #1f2937;
        }

        /* Theme Toggle Button - TOP RIGHT */
        .theme-toggle {
            position: absolute;
            top: 2rem;
            right: 2rem;
            width: 48px;
            height: 48px;
            background: #f3f4f6;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            z-index: 100;
        }

        .theme-toggle:hover {
            background: #e5e7eb;
            transform: scale(1.05);
        }

        .theme-toggle i {
            font-size: 1.25rem;
            color: #374151;
        }

        [data-theme="dark"] .theme-toggle {
            background: #374151;
        }

        [data-theme="dark"] .theme-toggle:hover {
            background: #4b5563;
        }

        [data-theme="dark"] .theme-toggle i {
            color: #f3f4f6;
        }

        /* Form Container - CENTERED */
        .login-form-container {
            width: 100%;
            max-width: 400px;
            margin: auto;
        }

        /* Form Heading */
        .form-heading {
            margin-bottom: 1.25rem;
            text-align: center;
        }

        .form-heading h1 {
            font-size: 2rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        [data-theme="dark"] .form-heading h1 {
            color: #f9fafb;
        }

        .form-heading p {
            color: #6b7280;
            font-size: 0.95rem;
        }

        [data-theme="dark"] .form-heading p {
            color: #9ca3af;
        }

        /* Form Fields */
        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            display: block;
            color: #374151;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        [data-theme="dark"] .form-label {
            color: #d1d5db;
        }

        .input-wrapper {
            position: relative;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 0.95rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 1rem;
            color: #1f2937;
            transition: all 0.3s ease;
            background: #ffffff;
        }

        [data-theme="dark"] .form-control {
            background: #374151;
            border-color: #4b5563;
            color: #f9fafb;
        }

        .form-control:focus {
            outline: none;
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        .form-control::placeholder {
            color: #9ca3af;
        }

        [data-theme="dark"] .form-control::placeholder {
            color: #6b7280;
        }

        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
            cursor: pointer;
            font-size: 1.125rem;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: #10b981;
        }

        /* Submit Button */
        .btn-login {
            width: 100%;
            padding: 0.85rem;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            margin: 1rem 0;
            color: #9ca3af;
            font-size: 0.875rem;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e5e7eb;
        }

        [data-theme="dark"] .divider::before,
        [data-theme="dark"] .divider::after {
            background: #374151;
        }

        .divider span {
            padding: 0 1rem;
        }

        /* Sign Up Link */
        .signup-link {
            text-align: center;
            color: #6b7280;
            font-size: 0.875rem;
        }

        [data-theme="dark"] .signup-link {
            color: #9ca3af;
        }

        .signup-link a {
            color: #10b981;
            text-decoration: none;
            font-weight: 600;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }

        /* ===============================
           RESPONSIVE
           =============================== */
        @media (max-width: 768px) {
            .login-wrapper {
                flex-direction: column;
            }

            .left-section {
                min-height: 40vh;
                padding: 2rem 1rem;
            }

            .illustration-content h2 {
                font-size: 1.75rem;
            }

            .illustration-content p {
                font-size: 0.95rem;
            }

            .right-section {
                padding: 1.5rem 1.25rem;
            }

            .theme-toggle {
                top: 1rem;
                right: 1rem;
            }
        }

        @media (max-height: 800px) {
            .right-section {
                padding: 1.25rem;
            }

            .form-heading h1 {
                font-size: 1.75rem;
            }

            .form-heading {
                margin-bottom: 1rem;
            }

            .form-group {
                margin-bottom: 0.85rem;
            }

            .divider {
                margin: 0.85rem 0;
            }

            .theme-toggle {
                top: 1.5rem;
                right: 1.5rem;
                width: 44px;
                height: 44px;
            }
        }

        /* Loading State */
        .btn-login.loading {
            pointer-events: none;
            opacity: 0.7;
        }

        .btn-login .spinner-border {
            width: 1.25rem;
            height: 1.25rem;
            border-width: 2px;
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <!-- LEFT SECTION - ANIMATED GREEN BACKGROUND -->
        <div class="left-section">
            <!-- Logo - Top Left -->
            <div class="left-logo">
                <div class="logo-icon">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8 6V3C8 2.44772 8.44772 2 9 2H15C15.5523 2 16 2.44772 16 3V6H19C19.5523 6 20 6.44772 20 7V20C20 20.5523 19.5523 21 19 21H5C4.44772 21 4 20.5523 4 20V7C4 6.44772 4.44772 6 5 6H8ZM10 6H14V4H10V6Z" fill="white"/>
                    </svg>
                </div>
                <h2 class="brand-name">FocusDay</h2>
            </div>

            <!-- Animated Background Shapes -->
            <div class="animated-bg">
                <div class="shape shape-1"></div>
                <div class="shape shape-2"></div>
                <div class="shape shape-3"></div>
                <div class="shape shape-4"></div>
            </div>

            <!-- Main Content -->
            <div class="illustration-content">
                <h2>Mulai Sekarang!</h2>
                <p>Buat akun untuk mulai mengelola tugas harianmu dan tingkatkan produktivitas bersama FocusDay</p>
            </div>
        </div>

        <!-- RIGHT SECTION - REGISTER FORM -->
        <div class="right-section">
            <!-- Theme Toggle - Top Right -->
            <button class="theme-toggle" id="themeToggle" onclick="toggleTheme()">
                <i class="bi bi-moon" id="themeIcon"></i>
            </button>

            <!-- Form Container - Centered -->
            <div class="login-form-container">
                <!-- Form Heading -->
                <div class="form-heading">
                    <h1>Buat Akun</h1>
                    <p>Lengkapi data Anda untuk melanjutkan</p>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Register Form -->
                <form id="registerForm" action="{{ route('register.store') }}" method="POST">
                    @csrf

                    <!-- Username -->
                    <div class="form-group">
                        <label class="form-label" for="name">Username</label>
                        <div class="input-wrapper">
                            <input 
                                type="text" 
                                class="form-control" 
                                id="name" 
                                name="name"
                                placeholder="Masukkan username"
                                value="{{ old('name') }}"
                                required>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label class="form-label" for="email">Email</label>
                        <div class="input-wrapper">
                            <input 
                                type="email" 
                                class="form-control" 
                                id="email" 
                                name="email"
                                placeholder="Masukkan email"
                                value="{{ old('email') }}"
                                required>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <div class="input-wrapper">
                            <input 
                                type="password" 
                                class="form-control" 
                                id="password" 
                                name="password"
                                placeholder="Masukkan password"
                                required>
                            <span class="password-toggle" onclick="togglePassword('password', 'toggleIcon')">
                                <i class="bi bi-eye" id="toggleIcon"></i>
                            </span>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group">
                        <label class="form-label" for="confirmPassword">Konfirmasi Password</label>
                        <div class="input-wrapper">
                            <input 
                                type="password" 
                                class="form-control" 
                                id="confirmPassword" 
                                name="password_confirmation"
                                placeholder="Ulangi password"
                                required>
                            <span class="password-toggle" onclick="togglePassword('confirmPassword', 'toggleIcon2')">
                                <i class="bi bi-eye" id="toggleIcon2"></i>
                            </span>
                        </div>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn-login" id="registerBtn">
                        <span id="btnText">Daftar</span>
                        <span class="spinner-border spinner-border-sm d-none" id="btnSpinner"></span>
                    </button>
                </form>

                <!-- Divider -->
                <div class="divider">
                    <span>atau</span>
                </div>

                <!-- Sign In Link -->
                <div class="signup-link">
                    Sudah punya akun? <a href="{{ route('login') }}">Masuk</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Toggle Password
        function togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const toggleIcon = document.getElementById(iconId);
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('bi-eye');
                toggleIcon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('bi-eye-slash');
                toggleIcon.classList.add('bi-eye');
            }
        }

        // Toggle Theme
        function toggleTheme() {
            const html = document.documentElement;
            const themeIcon = document.getElementById('themeIcon');
            const currentTheme = html.getAttribute('data-theme');
            
            if (currentTheme === 'dark') {
                html.removeAttribute('data-theme');
                themeIcon.classList.remove('bi-sun');
                themeIcon.classList.add('bi-moon');
                localStorage.setItem('loginTheme', 'light');
            } else {
                html.setAttribute('data-theme', 'dark');
                themeIcon.classList.remove('bi-moon');
                themeIcon.classList.add('bi-sun');
                localStorage.setItem('loginTheme', 'dark');
            }
        }

        // Load saved theme on page load
        document.addEventListener('DOMContentLoaded', function() {
            const savedTheme = localStorage.getItem('loginTheme');
            const html = document.documentElement;
            const themeIcon = document.getElementById('themeIcon');
            
            if (savedTheme === 'dark') {
                html.setAttribute('data-theme', 'dark');
                themeIcon.classList.remove('bi-moon');
                themeIcon.classList.add('bi-sun');
            }
        });

        // Form Submit
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            const btn = document.getElementById('registerBtn');
            const btnText = document.getElementById('btnText');
            const btnSpinner = document.getElementById('btnSpinner');
            
            btn.classList.add('loading');
            btnText.classList.add('d-none');
            btnSpinner.classList.remove('d-none');
        });
    </script>
</body>
</html>
