<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Bookstore Eko Haryono') - Toko Buku Online</title>

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon" href="{{ asset('favicon.ico') }}">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Google Fonts - Roboto (Material Design Typography) -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- Custom CSS dengan Material Design Principles -->
    <style>
        :root {
            /* Color Palette - Merah Putih Indonesia + Abu-abu */
            --primary-color: #DC143C;      /* Crimson Red */
            --primary-dark: #B71C1C;       /* Dark Red */
            --accent-color: #FF1744;       /* Red Accent */
            --secondary-color: #212121;    /* Dark Grey/Black */
            --light-bg: #F5F5F5;           /* Light Grey */
            --white: #FFFFFF;

            /* Material Design Shadows */
            --shadow-1: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
            --shadow-2: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
            --shadow-3: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
            --shadow-4: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
            --shadow-5: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22);

            /* Typography */
            --font-family: 'Roboto', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }

        * {
            font-family: var(--font-family);
        }

        body {
            background-color: var(--light-bg);
            color: var(--secondary-color);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Material Design Card */
        .card {
            box-shadow: var(--shadow-2);
            border: none;
            border-radius: 8px;
            transition: box-shadow 0.3s cubic-bezier(.25,.8,.25,1);
        }

        .card:hover {
            box-shadow: var(--shadow-3);
        }

        /* Material Button Styles */
        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            box-shadow: var(--shadow-1);
            transition: all 0.3s cubic-bezier(.25,.8,.25,1);
            text-transform: uppercase;
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            box-shadow: var(--shadow-3);
            transform: translateY(-2px);
        }

        .btn-primary:active {
            transform: translateY(0);
            box-shadow: var(--shadow-1);
        }

        /* Navbar dengan Material Design */
        .navbar {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            box-shadow: var(--shadow-2);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--white) !important;
            letter-spacing: 1px;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            margin: 0 0.5rem;
            padding: 0.5rem 1rem !important;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: var(--white) !important;
        }

        .nav-link.active {
            background-color: rgba(255, 255, 255, 0.2);
        }

        /* Badge Material Design */
        .badge {
            border-radius: 12px;
            padding: 0.35em 0.65em;
            font-weight: 500;
        }

        /* Footer */
        footer {
            background-color: var(--secondary-color);
            color: var(--white);
            margin-top: auto;
            padding: 2rem 0 1rem;
            box-shadow: var(--shadow-4);
        }

        /* Alert dengan Material Design */
        .alert {
            border: none;
            border-radius: 4px;
            box-shadow: var(--shadow-2);
            padding: 1rem 1.5rem;
        }

        /* Form Control Material Design */
        .form-control, .form-select {
            border: none;
            border-bottom: 2px solid #E0E0E0;
            border-radius: 4px 4px 0 0;
            background-color: #F5F5F5;
            padding: 1rem 0.75rem;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            background-color: #EEEEEE;
            border-bottom-color: var(--primary-color);
            box-shadow: 0 2px 0 var(--primary-color);
        }

        /* Material Floating Action Button (FAB) */
        .btn-fab {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            box-shadow: var(--shadow-3);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            position: fixed;
            bottom: 24px;
            right: 24px;
            z-index: 1000;
        }

        /* Content Wrapper */
        main {
            flex: 1;
            padding: 2rem 0;
        }

        /* Material Ripple Effect (Simple) */
        .btn {
            position: relative;
            overflow: hidden;
        }

        /* Page Header */
        .page-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: var(--white);
            padding: 3rem 0;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-2);
        }

        .page-header h1 {
            font-weight: 300;
            font-size: 2.5rem;
            margin: 0;
        }

        /* Loading Spinner */
        .spinner-border-sm {
            width: 1rem;
            height: 1rem;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .page-header h1 {
                font-size: 2rem;
            }

            .navbar-brand {
                font-size: 1.2rem;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <span class="material-icons me-2">menu_book</span>
                Bookstore Eko Haryono
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <span class="material-icons align-middle" style="font-size: 18px;">home</span>
                            Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('buku.*') ? 'active' : '' }}" href="{{ route('buku.index') }}">
                            <span class="material-icons align-middle" style="font-size: 18px;">library_books</span>
                            Buku
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
                            <span class="material-icons align-middle" style="font-size: 18px;">info</span>
                            Tentang Kami
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('kontak') ? 'active' : '' }}" href="{{ route('kontak') }}">
                            <span class="material-icons align-middle" style="font-size: 18px;">contact_mail</span>
                            Kontak
                        </a>
                    </li>

                    @auth
                        @if(auth()->user()->isAdmin())
                            <!-- Admin Menu -->
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.*') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                    <span class="material-icons align-middle" style="font-size: 18px;">dashboard</span>
                                    Dashboard Admin
                                </a>
                            </li>
                        @else
                            <!-- User Menu -->
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('keranjang.*') ? 'active' : '' }}" href="{{ route('keranjang.index') }}">
                                    <span class="material-icons align-middle" style="font-size: 18px;">shopping_cart</span>
                                    Keranjang
                                    @if(auth()->user()->totalItemKeranjang() > 0)
                                        <span class="badge bg-danger rounded-pill ms-1">{{ auth()->user()->totalItemKeranjang() }}</span>
                                    @endif
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('pesanan.*') ? 'active' : '' }}" href="{{ route('pesanan.index') }}">
                                    <span class="material-icons align-middle" style="font-size: 18px;">receipt_long</span>
                                    Pesanan
                                </a>
                            </li>
                        @endif

                        <!-- User Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                <span class="material-icons align-middle" style="font-size: 18px;">account_circle</span>
                                {{ auth()->user()->name }}
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
                        </li>
                    @else
                        <!-- Guest Menu -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <span class="material-icons align-middle" style="font-size: 18px;">login</span>
                                Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-light" href="{{ route('register') }}" style="border: 2px solid white;">
                                <span class="material-icons align-middle" style="font-size: 18px;">person_add</span>
                                Register
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        <div class="container">
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
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <h5 class="fw-bold mb-3">
                        <span class="material-icons align-middle me-2">menu_book</span>
                        Bookstore Eko Haryono
                    </h5>
                    <p class="text-white-50">Toko buku online terpercaya dengan koleksi lengkap dan harga terjangkau. Melayani pengiriman ke seluruh Indonesia.</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h6 class="fw-bold mb-3">Menu Cepat</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Beranda</a></li>
                        <li class="mb-2"><a href="{{ route('buku.index') }}" class="text-white-50 text-decoration-none">Katalog Buku</a></li>
                        <li class="mb-2"><a href="{{ route('about') }}" class="text-white-50 text-decoration-none">Tentang Kami</a></li>
                        <li class="mb-2"><a href="{{ route('kontak') }}" class="text-white-50 text-decoration-none">Hubungi Kami</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-3">
                    <h6 class="fw-bold mb-3">Hubungi Kami</h6>
                    <p class="text-white-50">
                        <span class="material-icons align-middle" style="font-size: 18px;">email</span>
                        ekomh13@gmail.com
                    </p>
                    <p class="text-white-50">
                        <span class="material-icons align-middle" style="font-size: 18px;">phone</span>
                        +62 822-4610-5463
                    </p>
                    <p class="text-white-50">
                        <span class="material-icons align-middle" style="font-size: 18px;">location_on</span>
                        Bogor, Indonesia
                    </p>
                </div>
            </div>
            <hr class="bg-white">
            <div class="text-center text-white-50">
                <p class="mb-0">&copy; {{ date('Y') }} Bookstore Eko Haryono - Aplikasi BNSP Certification. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>
</html>
