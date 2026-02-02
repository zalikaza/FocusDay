<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'FocusDay')</title>

    <!-- Google Fonts: Inter (More standard for this clean look) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        :root {
            --primary: #10b981; /* Emerald 500 */
            --primary-hover: #059669;
            --bg-page: #ffffff;
            --text-main: #1f2937; /* Gray 800 */
            --text-muted: #6b7280; /* Gray 500 */
            --border-color: #e5e7eb; /* Gray 200 */
            --input-bg: #ffffff;
        }

        html[data-theme="dark"] {
            --bg-page: #111827; /* Gray 900 */
            --text-main: #f9fafb;
            --text-muted: #9ca3af;
            --border-color: #374151;
            --input-bg: transparent;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-page);
            color: var(--text-main);
            margin: 0;
            overflow-x: hidden;
            height: 100vh;
        }

        .split-layout {
            display: flex;
            height: 100vh;
            width: 100%;
        }

        /* --- Left Side (Visual) --- */
        .left-panel {
            flex: 1;
            background-color: #10b981; /* The main green */
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            padding: 2.5rem;
            color: white;
            justify-content: center;
        }
        
        @media (max-width: 992px) {
            .left-panel {
                display: none; /* Hide on mobile like typical auth flows or move to top */
            }
        }

        /* Decorative Circles (CSS Circles to match image) */
        .circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            pointer-events: none;
        }
        
        .circle-1 {
            width: 500px;
            height: 500px;
            top: -10%;
            left: -10%;
            background: rgba(255, 255, 255, 0.08);
        }

        .circle-2 {
            width: 300px;
            height: 300px;
            bottom: 15%;
            left: 10%;
            background: rgba(255, 255, 255, 0.08); /* Slightly darker intersection */
        }
        
        .circle-3 {
            width: 400px;
            height: 400px;
            bottom: -10%;
            right: 15%;
            background: rgba(255, 255, 255, 0.06);
        }
        
        /* Intersecting area fake effect (stacking divs) */
        .circle-4 {
            width: 200px;
            height: 200px;
            top: 40%;
            left: 40%;
            background: rgba(255, 255, 255, 0.03);
            filter: blur(40px);
        }

        .logo-area {
            position: absolute;
            top: 2.5rem;
            left: 2.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            font-size: 1.5rem;
            z-index: 10;
        }
        
        .logo-icon-bg {
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(4px);
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .hero-text-container {
            position: relative;
            z-index: 5;
            text-align: center;
            max-width: 500px;
            margin: 0 auto;
        }

        .hero-title {
            font-size: 3rem; 
            font-weight: 800;
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        .hero-subtitle {
            font-size: 1.1rem;
            font-weight: 400;
            line-height: 1.6;
            opacity: 0.9;
        }

        /* --- Right Side (Form) --- */
        .right-panel {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            background: var(--bg-page);
            padding: 2rem;
        }

        .form-content {
            width: 100%;
            max-width: 420px; /* Width constraints matching image */
        }

        .theme-toggle-absolute {
            position: absolute;
            top: 2rem;
            right: 2rem;
            color: var(--text-muted);
            background: transparent;
            border: 1px solid var(--border-color);
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .theme-toggle-absolute:hover {
            background: var(--border-color);
            color: var(--text-main);
        }

        /* Typography Override */
        h2.form-title {
            font-size: 1.875rem; /* 3xl */
            font-weight: 700;
            text-align: center;
            color: var(--text-main);
            margin-bottom: 0.5rem;
        }

        p.form-subtitle {
            text-align: center;
            color: var(--text-muted);
            margin-bottom: 2.5rem;
            font-size: 0.95rem;
        }

        /* Form Controls */
        label {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            font-weight: 600; /* Medium-Semibold */
            color: var(--text-main);
        }

        .custom-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: 8px; /* Slightly rounded */
            font-size: 0.95rem;
            color: var(--text-main);
            background: var(--input-bg);
            transition: border-color 0.2s;
        }

        .custom-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        .custom-input::placeholder {
            color: #9ca3af; /* Gray 400 */
        }

        .password-group {
            position: relative;
        }
        
        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            cursor: pointer;
            background: none;
            border: none;
            padding: 0;
        }

        .btn-main {
            width: 100%;
            background-color: var(--primary);
            color: white;
            font-weight: 600;
            padding: 0.85rem;
            border-radius: 8px;
            border: none;
            font-size: 1rem;
            transition: background-color 0.2s;
            margin-top: 1rem;
        }

        .btn-main:hover {
            background-color: var(--primary-hover);
        }

        /* Divider */
        .divider-line {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
            color: var(--text-muted);
            font-size: 0.85rem;
        }
        
        .divider-line::before, .divider-line::after {
            content: "";
            flex: 1;
            height: 1px;
            background: var(--border-color);
        }
        
        .divider-line span {
            padding: 0 1rem;
        }

        /* Bottom text */
        .bottom-text {
            text-align: center;
            font-size: 0.9rem;
            color: var(--text-muted);
            margin-top: 1rem;
        }

        .text-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }
        
        .text-link:hover {
            text-decoration: underline;
        }
        
        .logo-text {
            font-family: 'Inter', sans-serif;
            letter-spacing: -0.5px;
        }

        .logo-icon-img {
            width: 18px;
            height: 18px;
            display: block;
        }

    </style>
</head>
<body>

    <div class="split-layout">
        <!-- Left Panel -->
        <div class="left-panel">
            <div class="logo-area">
                <div class="logo-icon-bg">
                    <img class="logo-icon-img" src="{{ asset('favicon.svg') }}" alt="{{ config('app.name', 'FocusDay') }}">
                </div>
                <span class="logo-text">FocusDay</span>
            </div>

            <!-- Decorative Circles matching the image style roughly -->
            <div class="circle circle-1"></div>
            <div class="circle circle-2"></div>
            <div class="circle circle-3"></div>
            <div class="circle circle-4"></div>

            <div class="hero-text-container">
                <h1 class="hero-title">@yield('hero-title')</h1>
                <p class="hero-subtitle">@yield('hero-subtitle')</p>
            </div>
        </div>

        <!-- Right Panel -->
        <div class="right-panel">
            <button class="theme-toggle-absolute" id="themeToggle">
                <i class="bi bi-moon" id="themeIcon"></i>
            </button>

            <div class="form-content">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Global Toast Container -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 9999;">
        <div id="globalToast" class="toast align-items-center text-white border-0 shadow-lg" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body d-flex align-items-center gap-3">
                    <i id="globalToastIcon" class="bi bi-check-circle-fill fs-4"></i>
                    <div>
                        <strong class="d-block" id="globalToastTitle">Sukses!</strong>
                        <span class="small opacity-75" id="globalToastMessage">Berhasil.</span>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ========================
            // GLOBAL TOAST LOGIC
            // ========================
            const toastEl = document.getElementById('globalToast');
            const toast = new bootstrap.Toast(toastEl, { delay: 5000 });
            const toastTitle = document.getElementById('globalToastTitle');
            const toastMessage = document.getElementById('globalToastMessage');
            const toastIcon = document.getElementById('globalToastIcon');

            function showGlobalToast(message, type = 'success', title = null) {
                if (type === 'success') {
                    toastEl.className = 'toast align-items-center text-white border-0 shadow-lg bg-success';
                    toastEl.style.backgroundColor = '#10b981'; // Tailwind emerald-500
                    toastIcon.className = 'bi bi-check-circle-fill fs-4';
                    toastTitle.textContent = title || 'Berhasil!';
                } else if (type === 'error') {
                    toastEl.className = 'toast align-items-center text-white border-0 shadow-lg bg-danger';
                    toastIcon.className = 'bi bi-x-circle-fill fs-4';
                    toastTitle.textContent = title || 'Gagal!';
                } else {
                    toastEl.className = 'toast align-items-center text-white border-0 shadow-lg bg-primary';
                    toastIcon.className = 'bi bi-info-circle-fill fs-4';
                    toastTitle.textContent = title || 'Info';
                }
                
                toastMessage.textContent = message;
                toast.show();
            }

            // Expose to window for manual calls
            window.showToast = showGlobalToast;

            // Auto-show flash messages
            @if(session('success'))
                showGlobalToast("{{ session('success') }}", 'success');
            @endif

            @if($errors->any())
                // Optional: show errors as toast too?
                // showGlobalToast("Terjadi kesalahan. Periksa input Anda.", 'error');
            @endif
        });

        (function() {
            const root = document.documentElement;
            const toggleBtn = document.getElementById('themeToggle');
            const icon = document.getElementById('themeIcon');
            
            // Theme Init
            const savedTheme = localStorage.getItem('theme') || 'light';
            root.setAttribute('data-theme', savedTheme);
            updateIcon(savedTheme);

            if(toggleBtn) {
                toggleBtn.addEventListener('click', () => {
                    const current = root.getAttribute('data-theme');
                    const next = current === 'dark' ? 'light' : 'dark';
                    root.setAttribute('data-theme', next);
                    localStorage.setItem('theme', next);
                    updateIcon(next);
                });
            }

            function updateIcon(theme) {
                if(!icon) return;
                if(theme === 'dark') {
                    icon.className = 'bi bi-sun';
                } else {
                    icon.className = 'bi bi-moon';
                }
            }
        })();
        
        // Toggle Password Script
        function setupPasswordToggles() {
            document.querySelectorAll('.password-toggle').forEach(btn => {
                btn.addEventListener('click', function() {
                    const input = this.previousElementSibling;
                    const icon = this.querySelector('i');
                    if(input.type === 'password') {
                        input.type = 'text';
                        icon.classList.remove('bi-eye');
                        icon.classList.add('bi-eye-slash');
                    } else {
                        input.type = 'password';
                        icon.classList.add('bi-eye');
                        icon.classList.remove('bi-eye-slash');
                    }
                });
            });
        }
        setupPasswordToggles();
    </script>
</body>
</html>
