<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'FocusDay - Aplikasi Manajemen Tugas')</title>
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    
    <!-- Google Fonts - Inter (Dari layout lama untuk tipografi terbaik) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5.3.2 (Versi lebih stabil dari layout lama) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        :root {
            --sidebar-width: 280px;
            --sidebar-collapsed: 80px;
            --primary-green: #10b981;
            --primary-green-dark: #059669;
            --primary-green-light: #d1fae5;
            --sidebar-bg: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
            --sidebar-border: #e2e8f0;
            --sidebar-text: #475569;
            --sidebar-text-dark: #1e293b;
            --sidebar-hover: #f1f5f9;
            --bg-light: #f8fafc;
        }

        html[data-theme="dark"] {
            --sidebar-bg: linear-gradient(180deg, #0f172a 0%, #0b1220 100%);
            --sidebar-border: #1f2937;
            --sidebar-text: #cbd5e1;
            --sidebar-text-dark: #f1f5f9;
            --sidebar-hover: rgba(255, 255, 255, 0.06);
            --bg-light: #0b1220;
        }

        /* Base Styles */
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-light);
            color: var(--sidebar-text-dark);
            overflow-x: hidden;
        }

        html[data-theme="dark"] .sidebar-container {
            box-shadow: 4px 0 24px rgba(0, 0, 0, 0.25);
        }

        /* --- Sidebar Styles (Dari Layout Baru) --- */
        .sidebar-container {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: var(--sidebar-bg);
            border-right: 1px solid var(--sidebar-border);
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow-x: hidden;
            box-shadow: 4px 0 24px rgba(0, 0, 0, 0.02);
            display: flex;
            flex-direction: column;
        }

        .sidebar-logo {
            padding: 1.5rem;
            border-bottom: 1px solid var(--sidebar-border);
            display: flex;
            align-items: center;
            gap: 1rem;
            height: 80px;
        }

        .logo-wrapper {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            color: var(--sidebar-text-dark);
            overflow: hidden;
            white-space: nowrap;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.25rem;
            box-shadow: 0 4px 6px rgba(16, 185, 129, 0.2);
            flex-shrink: 0;
        }

        .logo-text {
            font-size: 1.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin: 0;
            transition: opacity 0.2s ease;
        }

        .sidebar-nav {
            padding: 1.5rem 1rem;
            flex-grow: 1;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .sidebar-nav ul {
            padding-left: 0;
            margin: 0;
        }

        .nav-section {
            margin-bottom: 0.75rem;
        }

        .nav-item {
            list-style: none;
            margin-bottom: 0.25rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.875rem 1rem;
            color: var(--sidebar-text);
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.2s ease;
            position: relative;
            white-space: nowrap;
            overflow: hidden;
        }

        .nav-link:hover {
            background: var(--sidebar-hover);
            color: var(--primary-green);
        }

        .nav-link.active {
            background: linear-gradient(90deg, rgba(16, 185, 129, 0.1) 0%, rgba(16, 185, 129, 0.05) 100%);
            color: var(--primary-green);
            font-weight: 600;
            border-left: 3px solid var(--primary-green);
        }

        .nav-icon {
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .nav-text {
            flex-grow: 1;
            font-size: 0.9375rem;
            transition: opacity 0.2s ease;
        }

        .badge {
            background: var(--primary-green);
            color: white;
            font-size: 0.7rem;
            padding: 0.25rem 0.5rem;
            border-radius: 6px;
            font-weight: 600;
        }

        /* Stats Widget */
        .today-stats {
            background: linear-gradient(135deg, #f0fdf4 0%, #ffffff 100%);
            border: 1px solid #d1fae5;
            border-radius: 12px;
            padding: 1rem;
            margin-top: 2rem;
        }

        html[data-theme="dark"] .today-stats {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.12) 0%, rgba(15, 23, 42, 0.6) 100%);
            border-color: rgba(16, 185, 129, 0.22);
        }

        .stats-header {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--primary-green);
            font-weight: 600;
            font-size: 0.875rem;
            margin-bottom: 0.75rem;
        }

        .stats-content {
            display: flex;
            justify-content: space-between;
        }

        .stat-item {
            text-align: center;
        }

        .stat-label {
            display: block;
            font-size: 0.75rem;
            color: #64748b;
            margin-bottom: 0.25rem;
        }

        html[data-theme="dark"] .stat-label {
            color: #94a3b8;
        }

        .stat-value {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--sidebar-text-dark);
        }

        .stat-value.success { color: var(--primary-green); }
        .stat-value.warning { color: #f59e0b; }

        /* Top Navbar */
        .top-navbar {
            height: 64px;
            background: white;
            border-bottom: 1px solid var(--sidebar-border);
        }

        html[data-theme="dark"] .top-navbar {
            background: rgba(15, 23, 42, 0.92);
            backdrop-filter: blur(10px);
        }

        .top-navbar .navbar-brand {
            font-weight: 700;
            color: var(--sidebar-text-dark);
        }

        .icon-btn {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--sidebar-border);
            background: white;
            color: var(--sidebar-text);
            transition: all 0.2s ease;
        }

        html[data-theme="dark"] .icon-btn {
            background: rgba(255, 255, 255, 0.03);
        }

        .icon-btn:hover {
            background: var(--sidebar-hover);
            color: var(--sidebar-text-dark);
        }

        .profile-btn {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 12px;
            border: 1px solid var(--sidebar-border);
            background: white;
            color: var(--sidebar-text-dark);
            transition: all 0.2s ease;
        }

        html[data-theme="dark"] .profile-btn {
            background: rgba(255, 255, 255, 0.03);
        }

        .profile-btn:hover {
            background: var(--sidebar-hover);
        }

        /* --- Main Content --- */
        .main-content {
            margin-left: var(--sidebar-width);
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* --- Mobile Responsive --- */
        @media (max-width: 992px) {
            .sidebar-container {
                position: fixed;
                left: -100%;
                width: 280px;
                z-index: 1050;
                transition: left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                box-shadow: none;
            }
            
            .sidebar-container.mobile-open {
                left: 0;
                box-shadow: 8px 0 24px rgba(0, 0, 0, 0.15);
            }
            
            .main-content {
                margin-left: 0 !important;
            }

            .profile-btn .profile-meta {
                display: none;
            }
            
            /* Hamburger Menu Button */
            .mobile-menu-btn {
                display: flex !important;
            }
            
            /* Mobile Overlay */
            .mobile-overlay {
                display: block;
            }
            
            .mobile-overlay.active {
                opacity: 1;
                pointer-events: all;
            }
        }
        
        /* Desktop - sembunyikan hamburger */
        @media (min-width: 993px) {
            .mobile-menu-btn {
                display: none;
            }
            
            .mobile-overlay {
                display: none;
            }
        }
        
        /* Hamburger Button */
        .mobile-menu-btn {
            display: none;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--sidebar-border);
            background: white;
            color: var(--sidebar-text);
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        html[data-theme="dark"] .mobile-menu-btn {
            background: rgba(255, 255, 255, 0.03);
        }
        
        .mobile-menu-btn:hover {
            background: var(--sidebar-hover);
            color: var(--primary-green);
        }
        
        /* Mobile Overlay Backdrop */
        .mobile-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1040;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }
        
        /* Close Button di Sidebar Mobile */
        .sidebar-close-btn {
            display: none;
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            width: 32px;
            height: 32px;
            border-radius: 8px;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: var(--sidebar-text);
            cursor: pointer;
            transition: all 0.2s ease;
            z-index: 10;
        }
        
        @media (max-width: 992px) {
            .sidebar-close-btn {
                display: flex;
            }
        }
        
        .sidebar-close-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            color: var(--primary-green);
        }

        /* --- Common Components --- */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.04);
            transition: transform 0.2s ease;
        }

        html[data-theme="dark"] .card {
            background: rgba(15, 23, 42, 0.85);
            box-shadow: 0 2px 16px rgba(0, 0, 0, 0.25);
            color: #e2e8f0;
        }

        html[data-theme="dark"] h1,
        html[data-theme="dark"] h2,
        html[data-theme="dark"] h3,
        html[data-theme="dark"] h4,
        html[data-theme="dark"] h5,
        html[data-theme="dark"] h6,
        html[data-theme="dark"] .card-title {
            color: #f1f5f9;
        }

        html[data-theme="dark"] .text-muted {
            color: #94a3b8 !important;
        }

        html[data-theme="dark"] .text-secondary {
            color: #94a3b8 !important;
        }

        html[data-theme="dark"] .dropdown-menu {
            background: #0f172a;
            border-color: #1f2937;
        }

        html[data-theme="dark"] .dropdown-item {
            color: #e2e8f0;
        }

        html[data-theme="dark"] .dropdown-item:hover,
        html[data-theme="dark"] .dropdown-item:focus {
            background: rgba(255, 255, 255, 0.06);
            color: #f1f5f9;
        }

        html[data-theme="dark"] .form-control,
        html[data-theme="dark"] .form-select {
            background-color: rgba(255, 255, 255, 0.03);
            border-color: #1f2937;
            color: #e2e8f0;
        }

        html[data-theme="dark"] .form-control::placeholder {
            color: #94a3b8;
        }

        html[data-theme="dark"] .text-dark {
            color: #f1f5f9 !important;
        }

        html[data-theme="dark"] .bg-white {
            background-color: rgba(15, 23, 42, 0.85) !important;
        }

        html[data-theme="dark"] .bg-light {
            background-color: rgba(15, 23, 42, 0.6) !important;
        }

        html[data-theme="dark"] .border,
        html[data-theme="dark"] .border-top,
        html[data-theme="dark"] .border-bottom,
        html[data-theme="dark"] .border-start,
        html[data-theme="dark"] .border-end {
            border-color: #1f2937 !important;
        }

        html[data-theme="dark"] .list-group-item {
            background-color: transparent;
            color: #e2e8f0;
        }

        html[data-theme="dark"] .btn-light {
            background-color: rgba(255, 255, 255, 0.04);
            border-color: #1f2937;
            color: #e2e8f0;
        }

        html[data-theme="dark"] .btn-light:hover {
            background-color: rgba(255, 255, 255, 0.06);
            border-color: #334155;
            color: #f1f5f9;
        }

        html[data-theme="dark"] .modal-content {
            background-color: #0f172a;
            border-color: #1f2937;
            color: #e2e8f0;
        }

        html[data-theme="dark"] .modal-header,
        html[data-theme="dark"] .modal-footer {
            border-color: #1f2937 !important;
        }

        html[data-theme="dark"] .btn-close {
            filter: invert(1) grayscale(100%);
            opacity: 0.8;
        }

        html[data-theme="dark"] .input-group-text {
            background-color: rgba(255, 255, 255, 0.03) !important;
            border-color: #1f2937 !important;
            color: #cbd5e1;
        }

        /* ===========================================
           DARK MODE: CATEGORY BADGES & BUTTONS
           Warna transparan untuk tampilan proper
           =========================================== */
        
        /* Category Badges (di task list) */
        html[data-theme="dark"] .category-badge.category-work,
        html[data-theme="dark"] .category-work {
            background-color: rgba(37, 99, 235, 0.2) !important;
            color: #93c5fd !important;
            border: 1px solid rgba(59, 130, 246, 0.3);
        }
        
        html[data-theme="dark"] .category-badge.category-learning,
        html[data-theme="dark"] .category-learning {
            background-color: rgba(16, 185, 129, 0.2) !important;
            color: #6ee7b7 !important;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }
        
        html[data-theme="dark"] .category-badge.category-personal,
        html[data-theme="dark"] .category-personal {
            background-color: rgba(245, 158, 11, 0.2) !important;
            color: #fcd34d !important;
            border: 1px solid rgba(245, 158, 11, 0.3);
        }
        
        /* Category Buttons (di form modal) */
        html[data-theme="dark"] .btn-category.btn-work {
            background-color: rgba(37, 99, 235, 0.15) !important;
            color: #93c5fd !important;
            border-color: rgba(59, 130, 246, 0.3) !important;
        }
        
        html[data-theme="dark"] .btn-category.btn-learning {
            background-color: rgba(16, 185, 129, 0.15) !important;
            color: #6ee7b7 !important;
            border-color: rgba(16, 185, 129, 0.3) !important;
        }
        
        html[data-theme="dark"] .btn-category.btn-personal {
            background-color: rgba(245, 158, 11, 0.15) !important;
            color: #fcd34d !important;
            border-color: rgba(245, 158, 11, 0.3) !important;
        }
        
        /* Category Headers (di halaman Kategori) */
        html[data-theme="dark"] .header-work {
            background-color: rgba(37, 99, 235, 0.15) !important;
            color: #93c5fd !important;
            border-bottom: 1px solid rgba(59, 130, 246, 0.2) !important;
        }
        
        html[data-theme="dark"] .header-learning {
            background-color: rgba(16, 185, 129, 0.15) !important;
            color: #6ee7b7 !important;
            border-bottom: 1px solid rgba(16, 185, 129, 0.2) !important;
        }
        
        html[data-theme="dark"] .header-personal {
            background-color: rgba(245, 158, 11, 0.15) !important;
            color: #fcd34d !important;
            border-bottom: 1px solid rgba(245, 158, 11, 0.2) !important;
        }
        
        /* Category Count Badge (di header kategori) */
        html[data-theme="dark"] .category-count {
            background: rgba(255, 255, 255, 0.1) !important;
            color: inherit !important;
        }
        
        /* Additional category colors (purple, pink, gray) */
        html[data-theme="dark"] .category-purple,
        html[data-theme="dark"] .btn-category.btn-purple,
        html[data-theme="dark"] .header-purple {
            background-color: rgba(139, 92, 246, 0.15) !important;
            color: #c4b5fd !important;
            border-color: rgba(139, 92, 246, 0.3) !important;
        }
        
        html[data-theme="dark"] .category-pink,
        html[data-theme="dark"] .btn-category.btn-pink,
        html[data-theme="dark"] .header-pink {
            background-color: rgba(236, 72, 153, 0.15) !important;
            color: #f9a8d4 !important;
            border-color: rgba(236, 72, 153, 0.3) !important;
        }
        
        html[data-theme="dark"] .category-gray,
        html[data-theme="dark"] .btn-category.btn-gray,
        html[data-theme="dark"] .header-gray {
            background-color: rgba(107, 114, 128, 0.15) !important;
            color: #d1d5db !important;
            border-color: rgba(107, 114, 128, 0.3) !important;
        }

        .btn-success {
            background-color: var(--primary-green);
            border-color: var(--primary-green);
            font-weight: 500;
            padding: 0.625rem 1.25rem;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .btn-success:hover {
            background-color: var(--primary-green-dark);
            border-color: var(--primary-green-dark);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-green);
            box-shadow: 0 0 0 0.2rem rgba(16, 185, 129, 0.15);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        html[data-theme="dark"] ::-webkit-scrollbar-thumb {
            background: #334155;
        }

        html[data-theme="dark"] ::-webkit-scrollbar-thumb:hover {
            background: #475569;
        }
        
        /* ============================================
           MOBILE RESPONSIVE IMPROVEMENTS
           ============================================ */
        
        @media (max-width: 576px) {
            /* Reduce main content padding on mobile */
            .main-content main {
                padding: 1rem !important;
            }
            
            /* Smaller headings */
            h1, .h1 { font-size: 1.75rem !important; }
            h2, .h2 { font-size: 1.5rem !important; }
            h3, .h3 { font-size: 1.25rem !important; }
            h4, .h4 { font-size: 1.1rem !important; }
            h5, .h5 { font-size: 1rem !important; }
            
            /* Cards more compact */
            .card-body {
                padding: 1rem !important;
            }
            
            /* Navbar adjustments */
            .top-navbar {
                height: 56px;
            }
            
            .top-navbar .container-fluid {
                padding-left: 1rem !important;
                padding-right: 1rem !important;
            }
            
            /* Button sizing */
            .btn {
                padding: 0.5rem 0.75rem;
                font-size: 0.875rem;
            }
            
            .btn-lg {
                padding: 0.625rem 1rem;
                font-size: 1rem;
            }
            
            /* Stats widget dalam sidebar - lebih compact */
            .today-stats {
                padding: 0.75rem;
                margin-top: 1rem;
            }
            
            .stat-value {
                font-size: 1rem;
            }
            
            /* Form controls */
            .form-control, .form-select {
                font-size: 1rem; /* Prevent auto-zoom on iOS */
            }
            
            /* Modal improvements */
            .modal-dialog {
                margin: 0.5rem;
                max-width: calc(100% - 1rem);
            }
            
            .modal-body {
                padding: 1rem !important;
                max-height: 60vh !important;
            }
            
            .modal-header, .modal-footer {
                padding: 0.75rem 1rem !important;
            }
        }
        
        @media (max-width: 768px) {
            /* Stack columns on tablet */
            .col-md-6 {
                margin-bottom: 1rem;
            }
            
            /* Reduce container padding */
            .container-fluid {
                padding-left: 1rem;
                padding-right: 1rem; 
            }
            
            /* Flex direction untuk header actions */
            .d-flex.justify-content-between {
                gap: 0.75rem;
            }
        }
        
        /* Improve touch targets for mobile */
        @media (max-width: 992px) {
            .btn, .icon-btn, .nav-link {
                min-height: 44px; /* Apple's recommended touch target */
                min-width: 44px;
            }
            
            /* Make badges more visible */
            .badge {
                font-size: 0.75rem;
                padding: 0.3rem 0.6rem;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Mobile Overlay -->
    <div class="mobile-overlay" id="mobileOverlay"></div>
    
    <!-- Sidebar -->
    <div class="sidebar-container" id="sidebar">
        <!-- Close Button (Mobile Only) -->
        <button class="sidebar-close-btn" id="sidebarCloseBtn" aria-label="Close sidebar">
            <i class="bi bi-x-lg"></i>
        </button>
        
        <!-- Logo & Toggle -->
        <div class="sidebar-logo">
            <a href="{{ route('home') }}" class="logo-wrapper">
                <div class="logo-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8 6V3C8 2.44772 8.44772 2 9 2H15C15.5523 2 16 2.44772 16 3V6H19C19.5523 6 20 6.44772 20 7V20C20 20.5523 19.5523 21 19 21H5C4.44772 21 4 20.5523 4 20V7C4 6.44772 4.44772 6 5 6H8ZM10 6H14V4H10V6Z" fill="white"/>
                        <path d="M12 10C11.4477 10 11 10.4477 11 11V13C11 13.5523 11.4477 14 12 14C12.5523 14 13 13.5523 13 13V11C13 10.4477 12.5523 10 12 10Z" fill="white"/>
                    </svg>
                </div>
                <h1 class="logo-text">FocusDay</h1>
            </a>
        </div>

        <!-- Navigation -->
        <nav class="sidebar-nav">
            <!-- Main Section -->
            <div class="nav-section">
                <ul>
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                            <span class="nav-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3 9L12 2L21 9V20C21 20.5304 20.7893 21.0391 20.4142 21.4142C20.0391 21.7893 19.5304 22 19 22H5C4.46957 22 3.96086 21.7893 3.58579 21.4142C3.21071 21.0391 3 20.5304 3 20V9Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            <span class="nav-text">Beranda</span>
                            <span class="badge ms-auto" id="sidebarBadge" style="display: none;"></span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{ route('calendar') }}" class="nav-link {{ request()->routeIs('calendar') ? 'active' : '' }}">
                            <span class="nav-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8 2V6M16 2V6M3 10H21M5 4H19C20.1046 4 21 4.89543 21 6V20C21 20.5523 20.1046 21 19 21H5C3.89543 21 3 20.5523 3 20V6C3 4.89543 3.89543 4 5 4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            <span class="nav-text">Kalender</span>
                            <!-- Contoh Badge Statis -->
                             <!--<span class="badge ms-auto">New</span> -->
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{ route('tasks.all') }}" class="nav-link {{ request()->routeIs('tasks.all') ? 'active' : '' }}">
                            <span class="nav-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 11L12 14L22 4M21 12V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            <span class="nav-text">Semua Tugas</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Organization Section -->
            <div class="nav-section">
                <ul>
                    <li class="nav-item">
                        <a href="{{ route('categories') }}" class="nav-link {{ request()->routeIs('categories') ? 'active' : '' }}">
                            <span class="nav-icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4 4H10V10H4V4ZM14 4H20V10H14V4ZM4 14H10V20H4V14ZM14 14H20V20H14V14Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            <span class="nav-text">Kategori</span>
                        </a>
                    </li>
                    
<li class="nav-item">
    <a href="{{ route('settings') }}" class="nav-link {{ request()->routeIs('settings') ? 'active' : '' }}">
        <span class="nav-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
                <path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/>
                <circle cx="12" cy="12" r="3"/>
            </svg>
        </span>
        <span class="nav-text">Pengaturan</span>
    </a>
</li>
                </ul>
            </div>

            <!-- Today's Stats Widget -->
            <div class="today-stats">
                <div class="stats-header">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 8V12L15 15M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    <span>Statistik Hari Ini</span>
                </div>
                <div class="stats-content">
                    <div class="stat-item">
                        <span class="stat-label">Total</span>
                        <span class="stat-value" id="todayTotalTasks">0</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Selesai</span>
                        <span class="stat-value success" id="todayCompletedTasks">0</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Pending</span>
                        <span class="stat-value warning" id="todayPendingTasks">0</span>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <nav class="navbar top-navbar sticky-top">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center gap-2">
                    <!-- Mobile Menu Button (Hamburger) -->
                    <button type="button" class="mobile-menu-btn" id="mobileMenuBtn" aria-label="Toggle menu">
                        <i class="bi bi-list" style="font-size: 1.5rem;"></i>
                    </button>
                </div>
                
                <div class="ms-auto d-flex align-items-center gap-2">
                    <button type="button" class="icon-btn" id="themeToggle" aria-label="Toggle theme">
                        <i class="bi bi-moon"></i>
                    </button>

                    <div class="dropdown">
                        @php
                            $sessionUser = session('user');
                            $displayName = $sessionUser['name'] ?? $sessionUser['email'] ?? 'Pengguna';
                            $displayEmail = $sessionUser['email'] ?? 'user@example.com';
                            $initials = strtoupper(substr($displayName, 0, 2));
                        @endphp
                        <button class="profile-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="profile-avatar">
                                {{ $initials }}
                            </span>
                            <span class="profile-meta text-start">
                                <span class="d-block" style="font-weight: 600; font-size: 0.875rem; line-height: 1.1;">
                                    {{ $displayName }}
                                </span>
                                <span class="d-block text-muted" style="font-size: 0.75rem; line-height: 1.1;">
                                    {{ $displayEmail }}
                                </span>
                            </span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                            <li>
                                <a class="dropdown-item" href="{{ route('settings') }}">
                                    <i class="bi bi-gear me-2"></i>Pengaturan
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        
        <!-- Page Content -->
        <main class="px-4 px-md-5 pt-3 pt-md-4 pb-4 pb-md-5">
            @yield('content')
        </main>
    </div>
    
    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Layout Logic -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
    const themeToggle = document.getElementById('themeToggle');

    if (themeToggle) {
        const root = document.documentElement;
        const savedTheme = localStorage.getItem('theme');

        // Set tema awal
        if (savedTheme) {
            root.setAttribute('data-theme', savedTheme);
        } else {
            // Default ke light mode
            root.setAttribute('data-theme', 'light');
        }

        // Fungsi update icon (LOGIKA DIPERBAIKI)
        const updateIcon = () => {
            const current = root.getAttribute('data-theme');
            const icon = themeToggle.querySelector('i');
            if (!icon) return;

            // LOGIKA BARU:
            // Mode terang (light) -> icon MATAHARI (sun) karena klik akan ke dark
            // Mode gelap (dark) -> icon BULAN (moon) karena klik akan ke light
            if (current === 'dark') {
                icon.className = 'bi bi-moon'; // Mode gelap: bulan
                icon.setAttribute('aria-label', 'Switch to light mode');
            } else {
                icon.className = 'bi bi-sun'; // Mode light: matahari
                icon.setAttribute('aria-label', 'Switch to dark mode');
            }
        };

        updateIcon();

        themeToggle.addEventListener('click', function() {
            const current = root.getAttribute('data-theme');
            const next = current === 'dark' ? 'light' : 'dark';
            root.setAttribute('data-theme', next);
            localStorage.setItem('theme', next);
            updateIcon();
        });
    }
    
    // ========================
    // MOBILE SIDEBAR TOGGLE
    // ========================
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const sidebarCloseBtn = document.getElementById('sidebarCloseBtn');
    const sidebar = document.getElementById('sidebar');
    const mobileOverlay = document.getElementById('mobileOverlay');
    
    // Function to open sidebar
    function openSidebar() {
        sidebar.classList.add('mobile-open');
        mobileOverlay.classList.add('active');
        document.body.style.overflow = 'hidden'; // Prevent scrolling
    }
    
    // Function to close sidebar
    function closeSidebar() {
        sidebar.classList.remove('mobile-open');
        mobileOverlay.classList.remove('active');
        document.body.style.overflow = ''; // Restore scrolling
    }
    
    // Event listeners
    if (mobileMenuBtn) {
        mobileMenuBtn.addEventListener('click', openSidebar);
    }
    
    if (sidebarCloseBtn) {
        sidebarCloseBtn.addEventListener('click', closeSidebar);
    }
    
    if (mobileOverlay) {
        mobileOverlay.addEventListener('click', closeSidebar);
    }
    
    // Close sidebar on navigation link click (mobile)
    document.querySelectorAll('.sidebar-nav .nav-link').forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth <= 992) {
                closeSidebar();
            }
        });
    });
    
    // ========================
    // GLOBAL SIDEBAR BADGE LOGIC
    // ========================
    // Fungsi global untuk update sidebar badge dari localStorage
    window.updateSidebarBadgeFromStorage = function() {
        const sidebarBadge = document.getElementById('sidebarBadge');
        if (!sidebarBadge) return;
        
        // Baca jumlah pending tasks dari localStorage
        const pendingTasks = parseInt(localStorage.getItem('focusday.pendingTasks') || '0');
        
        if (pendingTasks > 0) {
            sidebarBadge.textContent = pendingTasks;
            sidebarBadge.style.display = '';
        } else {
            sidebarBadge.style.display = 'none';
        }
    };
    
    // Fungsi global untuk menyimpan jumlah pending tasks ke localStorage
    window.savePendingTasksCount = function(count) {
        localStorage.setItem('focusday.pendingTasks', count.toString());
        window.updateSidebarBadgeFromStorage();
    };
    
    // ========================
    // GLOBAL TODAY STATS WIDGET LOGIC
    // ========================
    window.updateTodayStatsFromStorage = function() {
        const totalEl = document.getElementById('todayTotalTasks');
        const completedEl = document.getElementById('todayCompletedTasks');
        const pendingEl = document.getElementById('todayPendingTasks');

        if (!totalEl || !completedEl || !pendingEl) return;

        try {
            const raw = localStorage.getItem('focusday.todayStats');
            if (!raw) return;
            const parsed = JSON.parse(raw);

            const total = parseInt(parsed.total ?? 0);
            const completed = parseInt(parsed.completed ?? 0);
            const pending = parseInt(parsed.pending ?? 0);

            totalEl.textContent = isNaN(total) ? '0' : total.toString();
            completedEl.textContent = isNaN(completed) ? '0' : completed.toString();
            pendingEl.textContent = isNaN(pending) ? '0' : pending.toString();
        } catch (e) {
            // Abaikan error parsing / akses localStorage
        }
    };

    // Panggil saat halaman dimuat untuk menampilkan badge & statistik dari localStorage
    window.updateSidebarBadgeFromStorage();
    window.updateTodayStatsFromStorage();
    
    // Listen untuk perubahan localStorage dari tab/halaman lain
    window.addEventListener('storage', function(e) {
        if (e.key === 'focusday.pendingTasks') {
            window.updateSidebarBadgeFromStorage();
        }
        if (e.key === 'focusday.todayStats') {
            window.updateTodayStatsFromStorage();
        }
    });
});
    </script>
    
    @stack('scripts')
</body>
</html>