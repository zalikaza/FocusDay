<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - FocusDay</title>
    
    <!-- Google Fonts - Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5.3.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary-green: #10b981;
            --primary-green-dark: #059669;
            --primary-green-light: #d1fae5;
            --bg-gradient-start: #0f172a;
            --bg-gradient-end: #1e293b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--bg-gradient-start) 0%, var(--bg-gradient-end) 100%);
            position: relative;
            overflow: hidden;
        }

        /* Animated Background Elements */
        .bg-decoration {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.4;
            animation: float 8s ease-in-out infinite;
        }

        .bg-decoration-1 {
            width: 400px;
            height: 400px;
            background: linear-gradient(135deg, var(--primary-green), #34d399);
            top: -100px;
            right: -100px;
            animation-delay: 0s;
        }

        .bg-decoration-2 {
            width: 300px;
            height: 300px;
            background: linear-gradient(135deg, #06b6d4, var(--primary-green));
            bottom: -50px;
            left: -50px;
            animation-delay: 2s;
        }

        .bg-decoration-3 {
            width: 200px;
            height: 200px;
            background: linear-gradient(135deg, var(--primary-green-dark), #10b981);
            top: 50%;
            left: 10%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0) scale(1);
            }
            50% {
                transform: translateY(-20px) scale(1.05);
            }
        }

        /* Login Card */
        .login-container {
            width: 100%;
            max-width: 440px;
            padding: 1rem;
            position: relative;
            z-index: 10;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 3rem 2.5rem;
            box-shadow: 
                0 25px 50px -12px rgba(0, 0, 0, 0.5),
                0 0 0 1px rgba(255, 255, 255, 0.05) inset;
            animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Logo Section */
        .logo-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 2.5rem;
        }

        .logo-icon {
            width: 72px;
            height: 72px;
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-green-dark) 100%);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 
                0 10px 25px -5px rgba(16, 185, 129, 0.4),
                0 0 0 4px rgba(16, 185, 129, 0.1);
            margin-bottom: 1.25rem;
            animation: pulse 3s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% {
                box-shadow: 
                    0 10px 25px -5px rgba(16, 185, 129, 0.4),
                    0 0 0 4px rgba(16, 185, 129, 0.1);
            }
            50% {
                box-shadow: 
                    0 15px 35px -5px rgba(16, 185, 129, 0.5),
                    0 0 0 8px rgba(16, 185, 129, 0.15);
            }
        }

        .logo-icon svg {
            width: 36px;
            height: 36px;
        }

        .logo-text {
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(135deg, #ffffff 0%, #94a3b8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }

        .logo-tagline {
            color: #64748b;
            font-size: 0.9rem;
            font-weight: 400;
        }

        /* Form Styling */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            color: #94a3b8;
            font-size: 0.85rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
            letter-spacing: 0.5px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            font-size: 1.1rem;
            transition: color 0.3s ease;
        }

        .form-control {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            background: rgba(255, 255, 255, 0.05);
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 14px;
            color: #f1f5f9;
            font-size: 1rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .form-control::placeholder {
            color: #475569;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-green);
            background: rgba(255, 255, 255, 0.08);
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.15);
        }

        .form-control:focus + .input-icon,
        .input-wrapper:hover .input-icon {
            color: var(--primary-green);
        }

        /* Password Toggle */
        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            cursor: pointer;
            padding: 0.25rem;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: var(--primary-green);
        }

        /* Remember Me & Forgot Password */
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .form-check {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-check-input {
            width: 18px;
            height: 18px;
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 5px;
            background: transparent;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .form-check-input:checked {
            background: var(--primary-green);
            border-color: var(--primary-green);
        }

        .form-check-input:focus {
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
        }

        .form-check-label {
            color: #94a3b8;
            font-size: 0.875rem;
            cursor: pointer;
        }

        .forgot-link {
            color: var(--primary-green);
            font-size: 0.875rem;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .forgot-link:hover {
            color: #34d399;
            text-decoration: underline;
        }

        /* Submit Button */
        .btn-login {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-green-dark) 100%);
            border: none;
            border-radius: 14px;
            color: white;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.3);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px -5px rgba(16, 185, 129, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-login i {
            font-size: 1.1rem;
        }

        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
            color: #475569;
            font-size: 0.85rem;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
        }

        .divider span {
            padding: 0 1rem;
        }

        /* Demo Access */
        .demo-access {
            text-align: center;
            color: #64748b;
            font-size: 0.85rem;
        }

        .demo-access a {
            color: var(--primary-green);
            text-decoration: none;
            font-weight: 500;
        }

        .demo-access a:hover {
            text-decoration: underline;
        }

        /* Footer */
        .login-footer {
            text-align: center;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }

        .login-footer p {
            color: #475569;
            font-size: 0.8rem;
            margin: 0;
        }

        .login-footer a {
            color: #94a3b8;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .login-card {
                padding: 2rem 1.5rem;
                border-radius: 20px;
            }

            .logo-icon {
                width: 60px;
                height: 60px;
                border-radius: 16px;
            }

            .logo-icon svg {
                width: 30px;
                height: 30px;
            }

            .logo-text {
                font-size: 1.75rem;
            }

            .form-options {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }
        }

        /* Loading State */
        .btn-login.loading {
            pointer-events: none;
            opacity: 0.8;
        }

        .btn-login.loading .btn-text {
            display: none;
        }

        .btn-login.loading .btn-loader {
            display: block;
        }

        .btn-loader {
            display: none;
            width: 24px;
            height: 24px;
            border: 3px solid rgba(255,255,255,0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <!-- Background Decorations -->
    <div class="bg-decoration bg-decoration-1"></div>
    <div class="bg-decoration bg-decoration-2"></div>
    <div class="bg-decoration bg-decoration-3"></div>

    <!-- Login Container -->
    <div class="login-container">
        <div class="login-card">
            <!-- Logo Section -->
            <div class="logo-wrapper">
                <div class="logo-icon">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8 6V3C8 2.44772 8.44772 2 9 2H15C15.5523 2 16 2.44772 16 3V6H19C19.5523 6 20 6.44772 20 7V20C20 20.5523 19.5523 21 19 21H5C4.44772 21 4 20.5523 4 20V7C4 6.44772 4.44772 6 5 6H8ZM10 6H14V4H10V6Z" fill="white"/>
                        <path d="M12 10C11.4477 10 11 10.4477 11 11V13C11 13.5523 11.4477 14 12 14C12.5523 14 13 13.5523 13 13V11C13 10.4477 12.5523 10 12 10Z" fill="white"/>
                    </svg>
                </div>
                <h1 class="logo-text">FocusDay</h1>
                <p class="logo-tagline">Kelola tugas harianmu dengan mudah</p>
            </div>

            <!-- Login Form -->
            <form id="loginForm" action="{{ route('home') }}" method="GET">
                <!-- Username Field -->
                <div class="form-group">
                    <label class="form-label" for="username">Username</label>
                    <div class="input-wrapper">
                        <input 
                            type="text" 
                            class="form-control" 
                            id="username" 
                            name="username"
                            placeholder="Masukkan username"
                            required
                            autocomplete="username">
                        <i class="bi bi-person input-icon"></i>
                    </div>
                </div>

                <!-- Password Field -->
                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-wrapper">
                        <input 
                            type="password" 
                            class="form-control" 
                            id="password" 
                            name="password"
                            placeholder="Masukkan password"
                            required
                            autocomplete="current-password">
                        <i class="bi bi-lock input-icon"></i>
                        <span class="password-toggle" onclick="togglePassword()">
                            <i class="bi bi-eye" id="toggleIcon"></i>
                        </span>
                    </div>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="form-options">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Ingat saya</label>
                    </div>
                    <a href="#" class="forgot-link">Lupa password?</a>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-login" id="loginBtn">
                    <span class="btn-text">Masuk ke FocusDay</span>
                    <i class="bi bi-arrow-right btn-text"></i>
                    <div class="btn-loader"></div>
                </button>
            </form>

            <!-- Divider -->
            <div class="divider">
                <span>atau</span>
            </div>

            <!-- Demo Access -->
            <div class="demo-access">
                <p>Belum punya akun? <a href="{{ route('home') }}">Coba Demo Gratis</a></p>
            </div>

            <!-- Footer -->
            <div class="login-footer">
                <p>&copy; 2026 FocusDay. Made with <span style="color: #ef4444;">❤</span> for productivity.</p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Toggle Password Visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
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

        // Form Submit Handler
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const btn = document.getElementById('loginBtn');
            btn.classList.add('loading');
            
            // Simulate loading (remove this in production)
            setTimeout(() => {
                // Form will submit naturally
            }, 500);
        });

        // Input Focus Animation
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.querySelector('.input-icon').style.transform = 'translateY(-50%) scale(1.1)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.querySelector('.input-icon').style.transform = 'translateY(-50%) scale(1)';
            });
        });
    </script>
</body>
</html>
