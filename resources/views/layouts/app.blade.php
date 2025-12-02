<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'Kelompok 2 - Platform Top Up Game Online Terpercaya')</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <!-- Google Fonts - Poppins & Inter -->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        
        <style>
            :root {
                /* === PRIMARY COLORS === */
                --primary-dark: #0f1419;
                --secondary-dark: #1a1f2e;
                --tertiary-dark: #242d3d;
                
                /* === NEON ACCENTS === */
                --neon-cyan: #00d4ff;
                --neon-lime: #4ade80;
                --neon-pink: #ec4899;
                --neon-purple: #a855f7;
                
                /* === TEXT COLORS === */
                --text-primary: #f8fafc;
                --text-secondary: #e2e8f0;
                --text-muted: #94a3b8;
                
                /* === STATUS COLORS === */
                --accent-warn: #f59e0b;
                --accent-success: #10b981;
                --accent-danger: #ef4444;
            }

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            html {
                scroll-behavior: smooth;
            }

            body {
                font-family: 'Poppins', 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
                background: linear-gradient(135deg, #0f1419 0%, #1a1f2e 25%, #1a2a3e 50%, #0f1a24 75%, #0f1419 100%);
                background-attachment: fixed;
                color: var(--text-secondary);
                min-height: 100vh;
                position: relative;
                overflow-x: hidden;
            }

            /* === BACKGROUND OVERLAY === */
            body::before {
                content: '';
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: 
                    radial-gradient(circle at 15% 40%, rgba(168, 85, 247, 0.08) 0%, transparent 50%),
                    radial-gradient(circle at 85% 70%, rgba(0, 212, 255, 0.06) 0%, transparent 50%);
                pointer-events: none;
                z-index: -1;
            }

            /* ====== NAVBAR STYLING ====== */
            .navbar {
                background: linear-gradient(90deg, rgba(15, 20, 25, 0.95) 0%, rgba(26, 31, 46, 0.95) 50%, rgba(15, 20, 25, 0.95) 100%);
                backdrop-filter: blur(30px);
                border-bottom: 2px solid;
                border-image: linear-gradient(90deg, var(--neon-cyan), var(--neon-purple), var(--neon-pink)) 1;
                box-shadow: 0 10px 40px rgba(0, 212, 255, 0.1), 0 0 30px rgba(168, 85, 247, 0.08);
                padding: 0.8rem 0 !important;
                position: sticky;
                top: 0;
                z-index: 1000;
            }

            .navbar-brand {
                font-family: 'Poppins', sans-serif;
                font-weight: 900;
                font-size: 1.6rem;
                background: linear-gradient(135deg, var(--neon-cyan) 0%, var(--neon-purple) 50%, var(--neon-pink) 100%);
                background-size: 300% 300%;
                animation: gradientFlow 6s ease infinite;
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                letter-spacing: 2px;
                text-transform: uppercase;
                filter: drop-shadow(0 0 20px rgba(0, 212, 255, 0.3));
                margin-bottom: 0;
            }

            @keyframes gradientFlow {
                0% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
                100% { background-position: 0% 50%; }
            }

            .navbar .nav-link {
                color: var(--text-muted) !important;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                margin: 0 12px;
                position: relative;
                font-weight: 600;
                text-transform: uppercase;
                font-size: 0.85rem;
                letter-spacing: 1px;
            }

            .navbar .nav-link:hover {
                color: var(--neon-cyan) !important;
                text-shadow: 0 0 15px rgba(0, 212, 255, 0.6);
            }

            .navbar .nav-link::after {
                content: '';
                position: absolute;
                bottom: -8px;
                left: 0;
                width: 0;
                height: 3px;
                background: linear-gradient(90deg, var(--neon-cyan), var(--neon-purple));
                transition: width 0.3s ease;
                border-radius: 2px;
            }

            .navbar .nav-link:hover::after {
                width: 100%;
            }

            /* ====== BUTTON STYLING ====== */
            .btn-primary {
                background: linear-gradient(135deg, var(--neon-cyan) 0%, var(--neon-purple) 100%);
                border: none;
                color: var(--primary-dark) !important;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 1.5px;
                padding: 0.6rem 1.5rem;
                border-radius: 8px;
                position: relative;
                overflow: hidden;
                transition: all 0.3s ease;
                box-shadow: 0 8px 25px rgba(0, 212, 255, 0.25);
            }

            .btn-primary::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
                transition: left 0.5s ease;
            }

            .btn-primary:hover::before {
                left: 100%;
            }

            .btn-primary:hover {
                transform: translateY(-4px);
                box-shadow: 0 15px 40px rgba(0, 212, 255, 0.4), 0 0 30px rgba(168, 85, 247, 0.2);
            }

            .btn-outline-secondary {
                border: 2px solid var(--text-muted);
                color: var(--text-muted);
                font-weight: 600;
            }

            .btn-outline-secondary:hover {
                background: transparent;
                border-color: var(--neon-cyan);
                color: var(--neon-cyan);
                box-shadow: 0 0 20px rgba(0, 212, 255, 0.3);
            }

            /* ====== CARD STYLING ====== */
            .card {
                background: rgba(26, 31, 46, 0.4);
                border: 1.5px solid rgba(0, 212, 255, 0.2);
                backdrop-filter: blur(20px);
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                position: relative;
                overflow: hidden;
                border-radius: 12px;
            }

            .card::before {
                content: '';
                position: absolute;
                top: -50%;
                left: -50%;
                width: 200%;
                height: 200%;
                background: radial-gradient(circle, rgba(0, 212, 255, 0.1) 0%, transparent 70%);
                transition: all 0.3s ease;
                pointer-events: none;
            }

            .card:hover {
                border-color: var(--neon-cyan);
                transform: translateY(-10px);
                box-shadow: 0 20px 60px rgba(0, 212, 255, 0.2), 0 0 40px rgba(168, 85, 247, 0.1);
                background: rgba(26, 31, 46, 0.6);
            }

            .card:hover::before {
                top: 0;
                left: 0;
            }

            .card-header {
                background: linear-gradient(90deg, rgba(0, 212, 255, 0.1) 0%, rgba(168, 85, 247, 0.08) 100%);
                border-bottom: 1px solid rgba(0, 212, 255, 0.15);
                font-weight: 600;
                color: var(--text-primary);
            }

            /* ====== GAME CARD STYLING ====== */
            .game-card {
                border: 2px solid rgba(0, 212, 255, 0.3);
                background: rgba(26, 31, 46, 0.3);
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
                border-radius: 12px;
                cursor: pointer;
            }

            .game-card::after {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(135deg, rgba(0, 212, 255, 0.1), rgba(168, 85, 247, 0.1));
                opacity: 0;
                transition: opacity 0.3s ease;
                pointer-events: none;
                border-radius: 12px;
            }

            .game-card:hover {
                border-color: var(--neon-purple);
                background: rgba(26, 31, 46, 0.6);
                transform: translateY(-12px);
                box-shadow: 0 20px 50px rgba(168, 85, 247, 0.25), 0 0 30px rgba(0, 212, 255, 0.15);
            }

            .game-card:hover::after {
                opacity: 1;
            }

            .game-card img {
                transition: transform 0.3s ease;
                width: 100%;
                height: 200px;
                object-fit: cover;
            }

            .game-card:hover img {
                transform: scale(1.05);
            }

            /* ====== BADGE STYLING ====== */
            .badge {
                font-weight: 700;
                padding: 0.5rem 1rem;
                border-radius: 8px;
                text-transform: uppercase;
                letter-spacing: 1px;
                font-size: 0.75rem;
            }

            .badge-price {
                background: linear-gradient(135deg, var(--neon-cyan) 0%, var(--neon-purple) 100%);
                color: var(--primary-dark);
                box-shadow: 0 8px 25px rgba(0, 212, 255, 0.35);
                font-size: 1rem;
                padding: 0.8rem 1.5rem;
                font-weight: 800;
            }

            .badge-bg-pending {
                background: rgba(245, 158, 11, 0.15);
                color: var(--accent-warn);
                border: 1.5px solid var(--accent-warn);
                box-shadow: 0 0 20px rgba(245, 158, 11, 0.25);
            }

            .badge-bg-completed {
                background: rgba(16, 185, 129, 0.15);
                color: var(--accent-success);
                border: 1.5px solid var(--accent-success);
                box-shadow: 0 0 20px rgba(16, 185, 129, 0.25);
            }

            .badge-bg-failed {
                background: rgba(239, 68, 68, 0.15);
                color: var(--accent-danger);
                border: 1.5px solid var(--accent-danger);
                box-shadow: 0 0 20px rgba(239, 68, 68, 0.25);
            }

            /* ====== FORM STYLING ====== */
            .form-control, .form-select {
                background: rgba(42, 42, 62, 0.6);
                border: 2px solid rgba(0, 245, 255, 0.3);
                color: var(--text-secondary);
                border-radius: 8px;
                transition: all 0.3s ease;
                font-weight: 500;
            }

            .form-control:focus, .form-select:focus {
                background: rgba(42, 42, 62, 0.9);
                border-color: var(--neon-cyan);
                color: var(--text-secondary);
                box-shadow: 0 0 25px rgba(0, 245, 255, 0.4), 0 0 0 3px rgba(0, 245, 255, 0.1);
            }

            .form-control::placeholder {
                color: rgba(255, 255, 255, 0.25);
                font-weight: 400;
            }

            .form-label {
                color: var(--text-secondary);
                font-weight: 600;
                text-transform: uppercase;
                font-size: 0.85rem;
                letter-spacing: 0.5px;
                margin-bottom: 0.8rem;
            }

            .invalid-feedback {
                color: var(--accent-danger);
                font-weight: 600;
                display: block;
                margin-top: 0.5rem;
            }

            .is-invalid {
                border-color: var(--accent-danger) !important;
                box-shadow: 0 0 20px rgba(255, 59, 48, 0.3) !important;
            }

            /* ====== ALERT STYLING ====== */
            .alert {
                border-radius: 10px;
                border: 2px solid;
                font-weight: 500;
            }

            .alert-info {
                background: rgba(0, 245, 255, 0.1);
                border-color: var(--neon-cyan);
                color: var(--neon-cyan);
                box-shadow: 0 0 25px rgba(0, 245, 255, 0.2);
            }

            .alert-warning {
                background: rgba(255, 170, 0, 0.1);
                border-color: var(--accent-warn);
                color: var(--accent-warn);
                box-shadow: 0 0 25px rgba(255, 170, 0, 0.2);
            }

            .alert-success {
                background: rgba(0, 255, 136, 0.1);
                border-color: var(--accent-success);
                color: var(--accent-success);
                box-shadow: 0 0 25px rgba(0, 255, 136, 0.2);
            }

            .alert-danger {
                background: rgba(255, 59, 48, 0.1);
                border-color: var(--accent-danger);
                color: var(--accent-danger);
                box-shadow: 0 0 25px rgba(255, 59, 48, 0.2);
            }

            /* ====== HERO SECTION ====== */
            .hero-section {
                background: linear-gradient(135deg, rgba(5, 15, 30, 0.9) 0%, rgba(15, 5, 40, 0.85) 50%, rgba(10, 10, 25, 0.9) 100%);
                border-radius: 15px;
                padding: 80px 40px;
                border: 1px solid rgba(255, 255, 255, 0.1);
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
                text-align: center;
                margin-bottom: 60px;
                position: relative;
                overflow: hidden;
            }

            .hero-section h1 {
                color: #ffffff;
                font-size: 3.5rem;
                font-weight: 900;
                margin-bottom: 20px;
                letter-spacing: 2px;
                text-transform: uppercase;
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            }

            .hero-section p {
                font-size: 1.3rem;
                color: #c0d0e0;
                font-weight: 500;
                text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
                letter-spacing: 0.5px;
            }

            /* ====== DROPDOWN STYLING ====== */
            .dropdown-menu {
                background: linear-gradient(135deg, rgba(18, 18, 18, 0.98) 0%, rgba(30, 30, 30, 0.98) 100%);
                border: 2px solid rgba(0, 245, 255, 0.3);
                box-shadow: 0 15px 40px rgba(0, 245, 255, 0.2);
                border-radius: 10px;
            }

            .dropdown-item {
                color: var(--text-muted);
                transition: all 0.2s ease;
                font-weight: 500;
            }

            .dropdown-item:hover {
                background: rgba(0, 245, 255, 0.15);
                color: var(--neon-cyan);
                border-left: 3px solid var(--neon-cyan);
                padding-left: calc(1rem - 3px);
            }

            .dropdown-divider {
                border-color: rgba(0, 245, 255, 0.2);
            }

            /* ====== PAGINATION STYLING ====== */
            .pagination {
                gap: 8px;
            }

            .page-link {
                background: rgba(0, 245, 255, 0.1);
                border: 1px solid rgba(0, 245, 255, 0.3);
                color: var(--text-muted);
                font-weight: 600;
                transition: all 0.2s ease;
                border-radius: 6px;
            }

            .page-link:hover {
                background: rgba(0, 212, 255, 0.15);
                border-color: var(--neon-cyan);
                color: var(--neon-cyan);
                box-shadow: 0 0 15px rgba(0, 212, 255, 0.25);
            }

            .page-item.active .page-link {
                background: linear-gradient(135deg, var(--neon-cyan) 0%, var(--neon-purple) 100%);
                border-color: var(--neon-cyan);
                color: var(--primary-dark);
                box-shadow: 0 8px 25px rgba(0, 212, 255, 0.35);
            }

            /* ====== FOOTER STYLING ====== */
            footer {
                background: linear-gradient(90deg, rgba(15, 20, 25, 0.98) 0%, rgba(26, 31, 46, 0.98) 100%);
                border-top: 2px solid rgba(0, 245, 255, 0.3);
                color: var(--text-muted);
                margin-top: 80px;
                box-shadow: 0 -10px 40px rgba(0, 0, 0, 0.5);
                padding: 50px 0 20px;
            }

            footer h5 {
                color: var(--neon-cyan);
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 1px;
            }

            footer a {
                color: var(--text-muted);
                text-decoration: none;
                transition: all 0.3s ease;
            }

            footer a:hover {
                color: var(--neon-cyan);
                text-shadow: 0 0 10px rgba(0, 245, 255, 0.5);
            }

            /* ====== TYPOGRAPHY ====== */
            h1, h2, h3, h4, h5, h6 {
                color: var(--text-primary);
                font-weight: 700;
                letter-spacing: 0.5px;
            }

            .text-muted {
                color: var(--text-muted) !important;
            }

            .text-danger {
                color: var(--accent-danger) !important;
            }

            .text-success {
                color: var(--accent-success) !important;
            }

            .text-warning {
                color: var(--accent-warn) !important;
            }

            .text-info {
                color: var(--neon-cyan) !important;
            }

            /* ====== UTILITY CLASSES ====== */
            .border-glow {
                border: 2px solid var(--neon-cyan);
                box-shadow: 0 0 20px rgba(0, 245, 255, 0.3);
            }

            .text-glow {
                color: var(--neon-cyan);
                text-shadow: 0 0 20px rgba(0, 245, 255, 0.5);
            }

            /* ====== RESPONSIVE DESIGN ====== */
            @media (max-width: 768px) {
                .hero-section {
                    padding: 40px 20px;
                }

                .hero-section h1 {
                    font-size: 2rem;
                }

                .navbar-brand {
                    font-size: 1.3rem;
                }

                .btn-primary {
                    padding: 0.5rem 1rem;
                    font-size: 0.85rem;
                }
            }
        </style>

        @yield('styles')
    </head>
    <body>
        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-md navbar-dark">
            <div class="container-fluid px-4">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="fas fa-gamepad me-2"></i>Kelompok 2
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Navigation -->
                    <ul class="navbar-nav me-auto ms-4">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('topup.index') }}">
                                <i class="fas fa-star me-1"></i>Top Up
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#help">
                                <i class="fas fa-question-circle me-1"></i>Bantuan
                            </a>
                        </li>
                    </ul>

                    <!-- Right Side - Auth Links -->
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">
                                        <i class="fas fa-sign-in-alt me-1"></i>Masuk
                                    </a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="btn btn-primary ms-2" href="{{ route('register') }}">
                                        <i class="fas fa-user-plus me-1"></i>Daftar
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('topup.myTransactions') }}">
                                    <i class="fas fa-history me-1"></i>Riwayat
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-user-circle me-1"></i>{{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-cog me-2"></i>Pengaturan Profil
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-2"></i>Keluar
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="py-5">
            <div class="container-fluid px-4">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <strong>Oops! Ada Kesalahan:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        <strong>Berhasil!</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-times-circle me-2"></i>
                        <strong>Kesalahan!</strong> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>

        <!-- Footer -->
        <footer>
            <div class="container-fluid px-4">
                <div class="row">
                    <div class="col-md-4">
                        <h5><i class="fas fa-gamepad me-2"></i>Kelompok 2</h5>
                        <p>Platform top up game online terpercaya. Top up game favorit Anda dengan aman dan cepat.</p>
                    </div>
                    <div class=\"col-md-4\">
                        <h5>Bantuan</h5>
                        <ul class=\"list-unstyled\">
                            <li><a href=\"#\"><i class=\"fas fa-question me-2\"></i>FAQ</a></li>
                            <li><a href=\"#\"><i class=\"fas fa-headset me-2\"></i>Layanan Pelanggan</a></li>
                            <li><a href=\"#\"><i class=\"fas fa-file me-2\"></i>Panduan</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h5>Informasi</h5>
                        <ul class="list-unstyled">
                            <li><a href="#"><i class="fas fa-lock me-2"></i>Kebijakan Privasi</a></li>
                            <li><a href="#"><i class="fas fa-scroll me-2"></i>Syarat & Ketentuan</a></li>
                            <li><a href="#"><i class="fas fa-wallet me-2"></i>Metode Pembayaran</a></li>
                        </ul>
                    </div>
                </div>
                <hr class="my-4" style="border-color: rgba(0, 245, 255, 0.2);">
                <div class="row align-items-center">
                    <div class=\"col-md-6\">
                        <p class="small mb-0">&copy; 2025 Kelompok 2. Semua hak dilindungi.</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <p class="small mb-0"><i class="fas fa-lock me-1"></i>Aman | <i class="fas fa-shield me-1"></i>Terpercaya | <i class="fas fa-bolt me-1"></i>Cepat</p>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        @yield('scripts')
    </body>
</html>
