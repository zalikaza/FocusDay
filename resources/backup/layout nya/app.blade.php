<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'FocusDay - Aplikasi Manajemen Tugas')</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- Google Fonts - Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-green: #10B981;
            --primary-green-dark: #059669;
            --primary-green-light: #D1FAE5;
            --primary-green-hover: #34D399;
            --bg-light: #f8f9fa;
            --sidebar-width: 260px;
            --topbar-height: 70px;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background-color: var(--bg-light);
            overflow-x: hidden;
        }
        
        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background-color: #ffffff;
            border-right: 1px solid #e5e7eb;
            padding: 2rem 0;
            z-index: 1000;
            transition: transform 0.3s ease;
        }
        
        .sidebar-brand {
            padding: 0 1.5rem;
            margin-bottom: 2rem;
        }
        
        .sidebar-brand h4 {
            color: var(--primary-green-dark);
            font-weight: 700;
            font-size: 1.5rem;
        }
        
        .sidebar-nav {
            list-style: none;
            padding: 0;
        }
        
        .sidebar-nav-item {
            margin-bottom: 0.25rem;
        }
        
        .sidebar-nav-link {
            display: flex;
            align-items: center;
            padding: 0.875rem 1.5rem;
            color: #6b7280;
            text-decoration: none;
            transition: all 0.2s ease;
            font-weight: 500;
            font-size: 0.95rem;
        }
        
        .sidebar-nav-link i {
            font-size: 1.25rem;
            margin-right: 0.875rem;
            width: 24px;
            text-align: center;
        }
        
        .sidebar-nav-link:hover {
            background-color: var(--primary-green-light);
            color: var(--primary-green-dark);
        }
        
        .sidebar-nav-link.active {
            background-color: var(--primary-green-light);
            color: var(--primary-green-dark);
            border-right: 3px solid var(--primary-green);
        }
        
        /* Topbar Styles */
        .topbar {
            position: fixed;
            top: 0;
            left: var(--sidebar-width);
            right: 0;
            height: var(--topbar-height);
            background-color: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            z-index: 999;
        }
        
        .topbar-icons {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        
        .topbar-icon {
            position: relative;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: background-color 0.2s ease;
            cursor: pointer;
            color: #6b7280;
        }
        
        .topbar-icon:hover {
            background-color: var(--bg-light);
        }
        
        .topbar-icon i {
            font-size: 1.25rem;
        }
        
        .notification-badge {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 8px;
            height: 8px;
            background-color: #ef4444;
            border-radius: 50%;
            border: 2px solid #ffffff;
        }
        
        .user-profile {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }
        
        .user-profile:hover {
            background-color: var(--bg-light);
        }
        
        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-green), var(--primary-green-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.875rem;
        }
        
        .user-name {
            font-weight: 500;
            color: #374151;
            font-size: 0.875rem;
        }
        
        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            margin-top: var(--topbar-height);
            padding: 2rem;
            min-height: calc(100vh - var(--topbar-height));
        }
        
        /* Mobile Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .topbar {
                left: 0;
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .mobile-menu-toggle {
                display: block !important;
            }
        }
        
        .mobile-menu-toggle {
            display: none;
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 56px;
            height: 56px;
            background-color: var(--primary-green);
            border-radius: 50%;
            border: none;
            color: white;
            font-size: 1.5rem;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
            z-index: 1001;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .mobile-menu-toggle:hover {
            background-color: var(--primary-green-dark);
            transform: scale(1.05);
        }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #9ca3af;
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <h4><i class="bi bi-check-circle-fill"></i> FocusDay</h4>
        </div>
        
        <nav>
            <ul class="sidebar-nav">
                <li class="sidebar-nav-item">
                    <a href="{{ route('home') }}" class="sidebar-nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                        <i class="bi bi-house-door"></i>
                        <span>Beranda</span>
                    </a>
                </li>
                <li class="sidebar-nav-item">
                    <a href="{{ route('calendar') }}" class="sidebar-nav-link {{ request()->routeIs('calendar') ? 'active' : '' }}">
                        <i class="bi bi-calendar3"></i>
                        <span>Kalender</span>
                    </a>
                </li>
                <li class="sidebar-nav-item">
                    <a href="{{ route('tasks.all') }}" class="sidebar-nav-link {{ request()->routeIs('tasks.all') ? 'active' : '' }}">
                        <i class="bi bi-list-check"></i>
                        <span>Semua Tugas</span>
                    </a>
                </li>
                <li class="sidebar-nav-item">
                    <a href="{{ route('categories') }}" class="sidebar-nav-link {{ request()->routeIs('categories') ? 'active' : '' }}">
                        <i class="bi bi-tag"></i>
                        <span>Kategori</span>
                    </a>
                </li>
                <li class="sidebar-nav-item">
                    <a href="{{ route('settings') }}" class="sidebar-nav-link {{ request()->routeIs('settings') ? 'active' : '' }}">
                        <i class="bi bi-gear"></i>
                        <span>Pengaturan</span>
                    </a>
                </li>
            </ul>
        </nav>
    </aside>
    
    <!-- Topbar -->
    <header class="topbar">
        <div class="topbar-icons">
            <div class="topbar-icon">
                <i class="bi bi-bell"></i>
                <span class="notification-badge"></span>
            </div>
            
            <div class="user-profile">
                <div class="user-avatar">JD</div>
                <span class="user-name">John Doe</span>
            </div>
        </div>
    </header>
    
    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>
    
    <!-- Mobile Menu Toggle -->
    <button class="mobile-menu-toggle" id="mobileMenuToggle">
        <i class="bi bi-list"></i>
    </button>
    
    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Mobile menu toggle
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
        const sidebar = document.getElementById('sidebar');
        
        if (mobileMenuToggle) {
            mobileMenuToggle.addEventListener('click', () => {
                sidebar.classList.toggle('show');
            });
            
            // Close sidebar when clicking outside
            document.addEventListener('click', (e) => {
                if (!sidebar.contains(e.target) && !mobileMenuToggle.contains(e.target)) {
                    sidebar.classList.remove('show');
                }
            });
        }
    </script>
    
    @stack('scripts')
</body>
</html>
