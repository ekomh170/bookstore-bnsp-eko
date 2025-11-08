<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - Admin Bookstore Eko Haryono</title>

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon" href="{{ asset('favicon.ico') }}">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #DC143C;
            --primary-dark: #B71C1C;
            --accent-color: #FF1744;
            --secondary-color: #212121;
            --light-bg: #F5F5F5;
            --white: #FFFFFF;
            --sidebar-width: 260px;

            --shadow-1: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
            --shadow-2: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
            --shadow-3: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);

            --font-family: 'Roboto', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }

        * {
            font-family: var(--font-family);
        }

        body {
            background-color: var(--light-bg);
            min-height: 100vh;
        }

        /* Sidebar Navigation */
        .admin-sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            min-height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
            box-shadow: var(--shadow-3);
            overflow-y: auto;
        }

        .admin-sidebar .brand {
            padding: 1.5rem;
            color: var(--white);
            font-weight: 700;
            font-size: 1.3rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .admin-sidebar .brand .logo-icon {
            width: 40px;
            height: 40px;
            background-color: var(--white);
            border-radius: 8px;
            padding: 6px;
            box-shadow: var(--shadow-2);
            flex-shrink: 0;
        }

        .admin-sidebar .brand .brand-text {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .admin-sidebar .brand .brand-title {
            font-size: 1.1rem;
            font-weight: 700;
        }

        .admin-sidebar .brand .brand-subtitle {
            font-size: 0.75rem;
            opacity: 0.8;
            font-weight: 400;
        }

        .admin-sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.875rem 1.5rem;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .admin-sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: var(--white);
        }

        .admin-sidebar .nav-link.active {
            background-color: rgba(255, 255, 255, 0.15);
            border-left-color: var(--white);
            color: var(--white);
            font-weight: 500;
        }

        .admin-sidebar .nav-link .material-icons {
            margin-right: 1rem;
            font-size: 20px;
        }

        /* Main Content Area */
        .admin-main {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }

        /* Top Bar */
        .admin-topbar {
            background-color: var(--white);
            box-shadow: var(--shadow-1);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 900;
        }

        .admin-content {
            padding: 2rem;
        }

        /* Stats Card dengan Material Design */
        .stat-card {
            background: var(--white);
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: var(--shadow-2);
            transition: all 0.3s ease;
            border-left: 4px solid var(--primary-color);
        }

        .stat-card:hover {
            box-shadow: var(--shadow-3);
            transform: translateY(-4px);
        }

        .stat-card .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: var(--white);
            box-shadow: var(--shadow-2);
        }

        .stat-card .stat-value {
            font-size: 2rem;
            font-weight: 300;
            color: var(--secondary-color);
            margin: 0.5rem 0 0.25rem;
        }

        .stat-card .stat-label {
            color: #757575;
            font-size: 0.875rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Card */
        .card {
            box-shadow: var(--shadow-2);
            border: none;
            border-radius: 8px;
            transition: box-shadow 0.3s cubic-bezier(.25,.8,.25,1);
        }

        .card-header {
            background-color: var(--white);
            border-bottom: 2px solid var(--light-bg);
            padding: 1.25rem 1.5rem;
            font-weight: 500;
            font-size: 1.125rem;
        }

        /* Table Material Design */
        .table {
            background-color: var(--white);
        }

        .table thead th {
            border-bottom: 2px solid var(--light-bg);
            font-weight: 500;
            text-transform: uppercase;
            font-size: 0.875rem;
            letter-spacing: 0.5px;
            color: #616161;
        }

        /* Buttons */
        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            box-shadow: var(--shadow-1);
            transition: all 0.3s cubic-bezier(.25,.8,.25,1);
            font-weight: 500;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            box-shadow: var(--shadow-3);
            transform: translateY(-2px);
        }

        /* Badges */
        .badge {
            font-weight: 500;
            padding: 0.5em 0.75em;
            border-radius: 12px;
        }

        /* Alert */
        .alert {
            border: none;
            border-radius: 4px;
            box-shadow: var(--shadow-2);
        }

        /* Utility Classes */
        .flex-grow-1 {
            flex-grow: 1 !important;
        }

        .fw-500 {
            font-weight: 500 !important;
        }

        .fw-bold {
            font-weight: 700 !important;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .admin-sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .admin-sidebar.show {
                transform: translateX(0);
            }

            .admin-main {
                margin-left: 0;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <div class="admin-sidebar" id="adminSidebar">
        <div class="brand">
            <div class="logo-icon">
                <img src="{{ asset('favicon.svg') }}" alt="Logo" style="width: 100%; height: 100%; display: block;">
            </div>
            <div class="brand-text">
                <span class="brand-title">Bookstore Eko</span>
                <span class="brand-subtitle">Admin Panel</span>
            </div>
        </div>

        <nav class="nav flex-column mt-3">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="material-icons">dashboard</span>
                Dashboard
            </a>

            <a href="{{ route('admin.kategori.index') }}" class="nav-link {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}">
                <span class="material-icons">category</span>
                Kategori Buku
            </a>

            <a href="{{ route('admin.buku.index') }}" class="nav-link {{ request()->routeIs('admin.buku.*') ? 'active' : '' }}">
                <span class="material-icons">menu_book</span>
                Data Buku
            </a>

            <a href="{{ route('admin.user.index') }}" class="nav-link {{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
                <span class="material-icons">people</span>
                List User
            </a>

            <a href="{{ route('admin.pesanan.index') }}" class="nav-link {{ request()->routeIs('admin.pesanan.*') ? 'active' : '' }}">
                <span class="material-icons">receipt_long</span>
                Pesanan
                @php
                    $pesanan_baru = \App\Models\Pesanan::where('status', 'menunggu_pembayaran')->count();
                @endphp
                @if($pesanan_baru > 0)
                    <span class="badge bg-danger ms-2">{{ $pesanan_baru }}</span>
                @endif
            </a>

            <a href="{{ route('admin.pesan.index') }}" class="nav-link {{ request()->routeIs('admin.pesan.*') ? 'active' : '' }}">
                <span class="material-icons">mail</span>
                Pesan Kontak
                @php
                    $pesan_belum_dibaca = \App\Models\PesanKontak::where('sudah_dibaca', false)->count();
                @endphp
                @if($pesan_belum_dibaca > 0)
                    <span class="badge bg-danger ms-2">{{ $pesan_belum_dibaca }}</span>
                @endif
            </a>

            <hr style="border-color: rgba(255, 255, 255, 0.1);">

            <a href="{{ route('home') }}" class="nav-link">
                <span class="material-icons">storefront</span>
                Lihat Toko
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="admin-main">
        <!-- Top Bar -->
        <div class="admin-topbar">
            <div class="d-flex align-items-center">
                <button class="btn btn-link d-lg-none me-2" id="sidebarToggle">
                    <span class="material-icons">menu</span>
                </button>
                <h5 class="mb-0 fw-normal">@yield('page-title', 'Dashboard')</h5>
            </div>

            <div class="dropdown">
                <a class="btn btn-link text-decoration-none dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                    <span class="material-icons me-2">account_circle</span>
                    <span class="d-none d-md-inline">{{ auth()->user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <span class="material-icons align-middle me-2" style="font-size: 18px;">logout</span>
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Content -->
        <div class="admin-content">
            <!-- Flash Messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span class="material-icons align-middle me-2">check_circle</span>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span class="material-icons align-middle me-2">error</span>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span class="material-icons align-middle me-2">error</span>
                    <strong>Terjadi kesalahan:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Sidebar Toggle untuk Mobile
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.getElementById('adminSidebar').classList.toggle('show');
        });
    </script>

    @stack('scripts')
</body>
</html>
