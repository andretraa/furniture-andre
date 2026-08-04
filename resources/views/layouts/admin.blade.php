<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') — DrewWood Furniture</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --admin-bg: #12100E;
            --admin-surface: #1C1917;
            --admin-card: #24201D;
            --admin-border: #322D29;
            --admin-border-hover: #4A433D;
            --admin-gold: #C59B27;
            --admin-gold-hover: #D4A82F;
            --admin-gold-bg: rgba(197, 155, 39, 0.12);
            --text-main: #F5F5F4;
            --text-muted: #A8A29E;
            --text-sub: #78716C;
            --danger: #EF4444;
            --danger-bg: rgba(239, 68, 68, 0.12);
            --success: #10B981;
            --success-bg: rgba(16, 185, 129, 0.12);
            --radius-md: 10px;
            --radius-lg: 16px;
            --transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        h1, h2, h3, h4, .font-heading {
            font-family: 'Outfit', sans-serif;
        }

        body {
            background-color: var(--admin-bg);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            overflow-x: hidden;
        }

        /* Sidebar Styling */
        .admin-sidebar {
            width: 270px;
            background: var(--admin-surface);
            border-right: 1px solid var(--admin-border);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            transition: var(--transition);
        }

        .sidebar-brand {
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
            text-decoration: none;
            border-bottom: 1px solid var(--admin-border);
        }

        .brand-icon {
            width: 42px;
            height: 42px;
            background: var(--admin-gold);
            color: #1C1917;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
        }

        .brand-title {
            font-family: 'Outfit', sans-serif;
            font-size: 1.3rem;
            font-weight: 800;
            color: var(--text-main);
            letter-spacing: -0.5px;
        }

        .brand-title span {
            color: var(--admin-gold);
        }

        .brand-badge {
            font-size: 0.65rem;
            font-weight: 700;
            background: var(--admin-gold-bg);
            color: var(--admin-gold);
            padding: 2px 8px;
            border-radius: 20px;
            border: 1px solid rgba(197, 155, 39, 0.3);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .sidebar-nav {
            padding: 1.5rem 1rem;
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
            flex: 1;
            overflow-y: auto;
        }

        .nav-label {
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            color: var(--text-sub);
            letter-spacing: 1px;
            margin: 1.2rem 0.5rem 0.4rem 0.5rem;
        }

        .nav-label:first-child {
            margin-top: 0;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            padding: 0.8rem 1rem;
            color: var(--text-muted);
            text-decoration: none;
            border-radius: var(--radius-md);
            font-size: 0.92rem;
            font-weight: 500;
            transition: var(--transition);
        }

        .nav-item i {
            font-size: 1.1rem;
            width: 22px;
            text-align: center;
            transition: var(--transition);
        }

        .nav-item:hover {
            color: var(--text-main);
            background: rgba(255, 255, 255, 0.05);
        }

        .nav-item.active {
            color: var(--admin-gold);
            background: var(--admin-gold-bg);
            border: 1px solid rgba(197, 155, 39, 0.3);
            font-weight: 600;
        }

        .nav-item.active i {
            color: var(--admin-gold);
        }

        .sidebar-footer {
            padding: 1.2rem;
            border-top: 1px solid var(--admin-border);
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
        }

        .btn-view-site {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.6rem;
            padding: 0.75rem 1rem;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--admin-border);
            color: var(--text-main);
            text-decoration: none;
            border-radius: var(--radius-md);
            font-size: 0.85rem;
            font-weight: 500;
            transition: var(--transition);
        }

        .btn-view-site:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: var(--admin-border-hover);
        }

        /* Main Content Styling */
        .admin-main {
            margin-left: 270px;
            flex: 1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            width: calc(100% - 270px);
        }

        .admin-header {
            height: 70px;
            background: var(--admin-surface);
            border-bottom: 1px solid var(--admin-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            position: sticky;
            top: 0;
            z-index: 90;
        }

        .header-title-box {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .mobile-menu-toggle {
            display: none;
            background: transparent;
            border: none;
            color: var(--text-main);
            font-size: 1.3rem;
            cursor: pointer;
        }

        .header-page-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-main);
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 1.2rem;
        }

        .admin-user-profile {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.4rem 0.8rem;
            background: var(--admin-card);
            border: 1px solid var(--admin-border);
            border-radius: 30px;
        }

        .admin-user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
        }

        .admin-user-info {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .admin-user-name {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-main);
        }

        .admin-user-role {
            font-size: 0.7rem;
            color: var(--admin-gold);
            font-weight: 500;
        }

        .admin-content {
            padding: 2rem;
            flex: 1;
        }

        /* Buttons & Forms */
        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--admin-gold);
            color: #1C1917;
            border: none;
            padding: 0.75rem 1.4rem;
            border-radius: var(--radius-md);
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            text-decoration: none;
            transition: var(--transition);
        }

        .btn-primary:hover {
            background: var(--admin-gold-hover);
            transform: translateY(-1px);
        }

        .btn-secondary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--admin-card);
            color: var(--text-main);
            border: 1px solid var(--admin-border);
            padding: 0.75rem 1.4rem;
            border-radius: var(--radius-md);
            font-weight: 500;
            font-size: 0.9rem;
            cursor: pointer;
            text-decoration: none;
            transition: var(--transition);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.05);
            border-color: var(--admin-border-hover);
        }

        .btn-danger {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: var(--danger-bg);
            color: var(--danger);
            border: 1px solid rgba(239, 68, 68, 0.3);
            padding: 0.5rem 0.9rem;
            border-radius: var(--radius-md);
            font-weight: 500;
            font-size: 0.85rem;
            cursor: pointer;
            text-decoration: none;
            transition: var(--transition);
        }

        .btn-danger:hover {
            background: var(--danger);
            color: #FFFFFF;
        }

        .btn-sm {
            padding: 0.45rem 0.85rem;
            font-size: 0.82rem;
        }

        /* Card Container */
        .admin-card {
            background: var(--admin-surface);
            border: 1px solid var(--admin-border);
            border-radius: var(--radius-lg);
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        /* Alert Toast/Banner */
        .alert-banner {
            padding: 1rem 1.2rem;
            border-radius: var(--radius-md);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
            font-size: 0.92rem;
        }

        .alert-banner.success {
            background: var(--success-bg);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #34D399;
        }

        .alert-banner.info {
            background: var(--admin-gold-bg);
            border: 1px solid rgba(197, 155, 39, 0.3);
            color: var(--admin-gold);
        }

        /* Responsive Layout */
        @media (max-width: 992px) {
            .admin-sidebar {
                transform: translateX(-100%);
            }
            .admin-sidebar.show {
                transform: translateX(0);
            }
            .admin-main {
                margin-left: 0;
                width: 100%;
            }
            .mobile-menu-toggle {
                display: block;
            }
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- Admin Sidebar -->
    <aside class="admin-sidebar" id="admin-sidebar">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
            <div class="brand-icon"><i class="fa-solid fa-couch"></i></div>
            <div>
                <div class="brand-title">DREW<span>WOOD</span></div>
                <div class="brand-badge">Admin Console</div>
            </div>
        </a>

        <nav class="sidebar-nav">
            <div class="nav-label">Utama</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-chart-line"></i> Dashboard
            </a>

            <div class="nav-label">Konten</div>
            <a href="{{ route('admin.articles.index') }}" class="nav-item {{ request()->routeIs('admin.articles.index') || request()->routeIs('admin.articles.edit') ? 'active' : '' }}">
                <i class="fa-solid fa-newspaper"></i> Kelola Artikel
            </a>
            <a href="{{ route('admin.articles.create') }}" class="nav-item {{ request()->routeIs('admin.articles.create') ? 'active' : '' }}">
                <i class="fa-solid fa-plus"></i> Tambah Artikel Baru
            </a>

            <div class="nav-label">Pengguna</div>
            <a href="{{ route('admin.users.index') }}" class="nav-item {{ request()->routeIs('admin.users.index') ? 'active' : '' }}">
                <i class="fa-solid fa-users"></i> Akun Terdaftar
            </a>
        </nav>

        <div class="sidebar-footer">
            <a href="{{ route('home') }}" class="btn-view-site">
                <i class="fa-solid fa-globe"></i> Lihat Website Utama
            </a>
            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="btn-view-site" style="width: 100%; color: var(--danger); cursor: pointer;">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="admin-main">
        <!-- Admin Header -->
        <header class="admin-header">
            <div class="header-title-box">
                <button class="mobile-menu-toggle" id="sidebar-toggle">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <h1 class="header-page-title">@yield('page-title', 'Dashboard Overview')</h1>
            </div>

            <div class="header-actions">
                <div class="admin-user-profile">
                    <img src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name }}" class="admin-user-avatar">
                    <div class="admin-user-info">
                        <span class="admin-user-name">{{ Auth::user()->name }}</span>
                        <span class="admin-user-role">Administrator</span>
                    </div>
                </div>
            </div>
        </header>

        <!-- Admin Body Content -->
        <main class="admin-content">
            @if(session('success'))
                <div class="alert-banner success">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('info'))
                <div class="alert-banner info">
                    <i class="fa-solid fa-circle-info"></i>
                    <span>{{ session('info') }}</span>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <script>
        // Sidebar Toggle for Mobile
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const adminSidebar = document.getElementById('admin-sidebar');
        if (sidebarToggle && adminSidebar) {
            sidebarToggle.addEventListener('click', () => {
                adminSidebar.classList.toggle('show');
            });
        }
    </script>
    @stack('scripts')
</body>
</html>
