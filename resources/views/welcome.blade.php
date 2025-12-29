@extends('layouts.app')

@section('title', 'PayToWin - Platform Top Up Game Online Terpercaya')

@section('content')
<!-- Hero Section with Animated Background -->
<div class="hero-section" data-aos="fade-up">
    <div class="hero-content">
        <span class="badge mb-4" style="background: var(--gradient-primary); padding: 0.75rem 1.5rem; font-size: 0.85rem; border-radius: 50px;">
            <i class="fas fa-sparkles me-2"></i>Platform Gaming #1 di Indonesia
        </span>
        <h1 class="mb-4">
            <i class="fas fa-bolt"></i> TOP UP GAME<br>
            <span class="text-gradient">FAVORIT KAMU!</span>
        </h1>
        <p class="mb-5">Platform top up game online terpercaya dengan harga terbaik,<br>transaksi super cepat & keamanan terjamin</p>
        @guest
            <div class="d-flex flex-wrap gap-3 justify-content-center">
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-5">
                    <i class="fas fa-rocket me-2"></i>Mulai Sekarang
                </a>
                <a href="{{ route('register') }}" class="btn btn-outline-secondary btn-lg px-4">
                    <i class="fas fa-user-plus me-2"></i>Daftar Gratis
                </a>
            </div>
        @else
            <a href="{{ route('topup.index') }}" class="btn btn-primary btn-lg px-5">
                <i class="fas fa-gamepad me-2"></i>Mulai Top Up
            </a>
        @endguest
    </div>
    
    <!-- Floating Elements -->
    <div class="hero-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
    </div>
</div>

<!-- Stats Section -->
<div class="row g-4 mb-5" data-aos="fade-up" data-aos-delay="100">
    <div class="col-6 col-lg-3">
        <div class="card text-center p-4 stat-card">
            <div class="stat-icon mb-3">
                <i class="fas fa-users fa-2x"></i>
            </div>
            <h3 class="stat-number mb-1">100K+</h3>
            <p class="text-muted mb-0">Pengguna Aktif</p>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card text-center p-4 stat-card">
            <div class="stat-icon mb-3" style="color: var(--accent-emerald);">
                <i class="fas fa-check-circle fa-2x"></i>
            </div>
            <h3 class="stat-number mb-1">500K+</h3>
            <p class="text-muted mb-0">Transaksi Sukses</p>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card text-center p-4 stat-card">
            <div class="stat-icon mb-3" style="color: var(--accent-amber);">
                <i class="fas fa-gamepad fa-2x"></i>
            </div>
            <h3 class="stat-number mb-1">50+</h3>
            <p class="text-muted mb-0">Game Tersedia</p>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card text-center p-4 stat-card">
            <div class="stat-icon mb-3" style="color: var(--accent-rose);">
                <i class="fas fa-star fa-2x"></i>
            </div>
            <h3 class="stat-number mb-1">4.9/5</h3>
            <p class="text-muted mb-0">Rating Pengguna</p>
        </div>
    </div>
</div>

<!-- Feature Section with Icons -->
<div class="text-center mb-5" data-aos="fade-up">
    <span class="badge mb-3" style="background: rgba(99, 102, 241, 0.15); color: var(--accent-primary); padding: 0.5rem 1rem;">
        <i class="fas fa-star me-1"></i>Keunggulan Kami
    </span>
    <h2 class="display-6 fw-bold mb-3">Kenapa Pilih Kami?</h2>
    <p class="text-muted fs-5 mb-5">Layanan terbaik untuk pengalaman gaming tanpa batas</p>
</div>

<div class="row g-4 mb-6">
    <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
        <div class="card feature-card text-center p-4 h-100">
            <div class="feature-icon mb-4">
                <div class="icon-wrapper" style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.2), rgba(139, 92, 246, 0.2));">
                    <i class="fas fa-bolt fa-2x" style="color: var(--accent-primary);"></i>
                </div>
            </div>
            <h5 class="fw-bold mb-3">Proses Instan</h5>
            <p class="text-muted mb-0">Top up langsung masuk dalam hitungan detik tanpa perlu menunggu lama</p>
        </div>
    </div>
    <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
        <div class="card feature-card text-center p-4 h-100">
            <div class="feature-icon mb-4">
                <div class="icon-wrapper" style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.2), rgba(34, 211, 238, 0.2));">
                    <i class="fas fa-shield-alt fa-2x" style="color: var(--accent-emerald);"></i>
                </div>
            </div>
            <h5 class="fw-bold mb-3">100% Aman</h5>
            <p class="text-muted mb-0">Transaksi terenkripsi dengan standar keamanan tertinggi</p>
        </div>
    </div>
    <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
        <div class="card feature-card text-center p-4 h-100">
            <div class="feature-icon mb-4">
                <div class="icon-wrapper" style="background: linear-gradient(135deg, rgba(244, 63, 94, 0.2), rgba(249, 115, 22, 0.2));">
                    <i class="fas fa-tags fa-2x" style="color: var(--accent-rose);"></i>
                </div>
            </div>
            <h5 class="fw-bold mb-3">Harga Terbaik</h5>
            <p class="text-muted mb-0">Harga kompetitif dengan berbagai promo menarik setiap hari</p>
        </div>
    </div>
    <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
        <div class="card feature-card text-center p-4 h-100">
            <div class="feature-icon mb-4">
                <div class="icon-wrapper" style="background: linear-gradient(135deg, rgba(245, 158, 11, 0.2), rgba(251, 191, 36, 0.2));">
                    <i class="fas fa-headset fa-2x" style="color: var(--accent-amber);"></i>
                </div>
            </div>
            <h5 class="fw-bold mb-3">Support 24/7</h5>
            <p class="text-muted mb-0">Tim support siap membantu kapan saja via chat atau telepon</p>
        </div>
    </div>
</div>

<!-- Game Section Title -->
<div class="text-center mb-5" data-aos="fade-up">
    <span class="badge mb-3" style="background: rgba(168, 85, 247, 0.15); color: var(--accent-secondary); padding: 0.5rem 1rem;">
        <i class="fas fa-fire me-1"></i>Trending
    </span>
    <h2 class="display-6 fw-bold mb-3">🎮 Game Populer</h2>
    <p class="text-muted fs-5">Pilih game favorit Anda dan mulai top up sekarang</p>
</div>

<!-- Game Cards Grid -->
<div class="row g-4 mb-5">
    <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
        <a href="{{ route('topup.game', 'Mobile Legends') }}" class="text-decoration-none">
            <div class="game-card card p-4 text-center h-100">
                <div class="game-icon-wrapper mb-4">
                    <div class="game-icon" style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.3), rgba(139, 92, 246, 0.3));">
                        <i class="fas fa-crown fa-3x" style="color: var(--accent-primary);"></i>
                    </div>
                    <div class="game-glow"></div>
                </div>
                <h4 class="fw-bold mb-2">Mobile Legends</h4>
                <p class="text-muted small mb-2">Top up Diamonds</p>
                <div class="d-flex align-items-center justify-content-center gap-2 mb-4">
                    <i class="fas fa-users" style="color: var(--accent-cyan); font-size: 0.75rem;"></i>
                    <span class="text-muted small">10.5 Juta+ pengguna</span>
                </div>
                <button class="btn btn-primary w-100">
                    <i class="fas fa-arrow-right me-2"></i>Lihat Paket
                </button>
            </div>
        </a>
    </div>

    <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
        <a href="{{ route('topup.game', 'Free Fire') }}" class="text-decoration-none">
            <div class="game-card card p-4 text-center h-100">
                <div class="game-icon-wrapper mb-4">
                    <div class="game-icon" style="background: linear-gradient(135deg, rgba(249, 115, 22, 0.3), rgba(245, 158, 11, 0.3));">
                        <i class="fas fa-fire fa-3x" style="color: var(--accent-orange);"></i>
                    </div>
                    <div class="game-glow" style="background: var(--accent-orange);"></div>
                </div>
                <h4 class="fw-bold mb-2">Free Fire</h4>
                <p class="text-muted small mb-2">Top up Diamonds</p>
                <div class="d-flex align-items-center justify-content-center gap-2 mb-4">
                    <i class="fas fa-users" style="color: var(--accent-cyan); font-size: 0.75rem;"></i>
                    <span class="text-muted small">50 Juta+ pengguna</span>
                </div>
                <button class="btn btn-primary w-100">
                    <i class="fas fa-arrow-right me-2"></i>Lihat Paket
                </button>
            </div>
        </a>
    </div>

    <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
        <a href="{{ route('topup.game', 'PUBG Mobile') }}" class="text-decoration-none">
            <div class="game-card card p-4 text-center h-100">
                <div class="game-icon-wrapper mb-4">
                    <div class="game-icon" style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.3), rgba(34, 211, 238, 0.3));">
                        <i class="fas fa-crosshairs fa-3x" style="color: var(--accent-emerald);"></i>
                    </div>
                    <div class="game-glow" style="background: var(--accent-emerald);"></div>
                </div>
                <h4 class="fw-bold mb-2">PUBG Mobile</h4>
                <p class="text-muted small mb-2">Top up UC</p>
                <div class="d-flex align-items-center justify-content-center gap-2 mb-4">
                    <i class="fas fa-users" style="color: var(--accent-cyan); font-size: 0.75rem;"></i>
                    <span class="text-muted small">30 Juta+ pengguna</span>
                </div>
                <button class="btn btn-primary w-100">
                    <i class="fas fa-arrow-right me-2"></i>Lihat Paket
                </button>
            </div>
        </a>
    </div>

    <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
        <a href="{{ route('topup.game', 'Valorant') }}" class="text-decoration-none">
            <div class="game-card card p-4 text-center h-100">
                <div class="game-icon-wrapper mb-4">
                    <div class="game-icon" style="background: linear-gradient(135deg, rgba(244, 63, 94, 0.3), rgba(236, 72, 153, 0.3));">
                        <i class="fas fa-bullseye fa-3x" style="color: var(--accent-rose);"></i>
                    </div>
                    <div class="game-glow" style="background: var(--accent-rose);"></div>
                </div>
                <h4 class="fw-bold mb-2">Valorant</h4>
                <p class="text-muted small mb-2">Top up Points</p>
                <div class="d-flex align-items-center justify-content-center gap-2 mb-4">
                    <i class="fas fa-users" style="color: var(--accent-cyan); font-size: 0.75rem;"></i>
                    <span class="text-muted small">25 Juta+ pengguna</span>
                </div>
                <button class="btn btn-primary w-100">
                    <i class="fas fa-arrow-right me-2"></i>Lihat Paket
                </button>
            </div>
        </a>
    </div>
</div>

<!-- View All Games Button -->
<div class="text-center mb-5" data-aos="fade-up">
    <a href="{{ route('topup.index') }}" class="btn btn-outline-secondary btn-lg px-5">
        <i class="fas fa-th-large me-2"></i>Lihat Semua Game
    </a>
</div>

<!-- How It Works Section -->
<div class="card p-5 mb-5" data-aos="fade-up" style="border-radius: 32px;">
    <div class="text-center mb-5">
        <span class="badge mb-3" style="background: rgba(34, 211, 238, 0.15); color: var(--accent-cyan); padding: 0.5rem 1rem;">
            <i class="fas fa-lightbulb me-1"></i>Panduan
        </span>
        <h2 class="display-6 fw-bold mb-3">Cara Top Up</h2>
        <p class="text-muted">Hanya 3 langkah mudah untuk top up game favorit Anda</p>
    </div>
    
    <div class="row g-4">
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
            <div class="text-center">
                <div class="step-number mb-4">
                    <span class="badge" style="background: var(--gradient-primary); width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin: 0 auto;">1</span>
                </div>
                <h5 class="fw-bold mb-3">Pilih Game</h5>
                <p class="text-muted">Pilih game yang ingin Anda top up dari berbagai pilihan game populer</p>
            </div>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
            <div class="text-center">
                <div class="step-number mb-4">
                    <span class="badge" style="background: var(--gradient-primary); width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin: 0 auto;">2</span>
                </div>
                <h5 class="fw-bold mb-3">Pilih Nominal</h5>
                <p class="text-muted">Tentukan nominal top up sesuai kebutuhan dengan harga terbaik</p>
            </div>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
            <div class="text-center">
                <div class="step-number mb-4">
                    <span class="badge" style="background: var(--gradient-primary); width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin: 0 auto;">3</span>
                </div>
                <h5 class="fw-bold mb-3">Bayar & Selesai</h5>
                <p class="text-muted">Lakukan pembayaran dan top up langsung masuk ke akun game Anda</p>
            </div>
        </div>
    </div>
</div>

<!-- Tips Alert -->
@auth
<div class="alert alert-info d-flex align-items-center" role="alert" data-aos="fade-up">
    <div class="me-3">
        <i class="fas fa-info-circle fa-2x"></i>
    </div>
    <div>
        <strong>Tips:</strong> Cek riwayat transaksi Anda di menu <a href="{{ route('topup.myTransactions') }}" style="color: inherit; font-weight: 700;">Riwayat</a> untuk melihat semua pembelian dan status transaksi.
    </div>
</div>
@else
<div class="alert alert-info d-flex align-items-center" role="alert" data-aos="fade-up">
    <div class="me-3">
        <i class="fas fa-info-circle fa-2x"></i>
    </div>
    <div>
        <strong>Tips:</strong> Anda bisa melihat paket game sekarang, tapi harus <a href="{{ route('login') }}" style="color: inherit; font-weight: 700;">login</a> untuk melakukan pembelian.
    </div>
</div>
@endif
@endsection

@section('styles')
<style>
    /* Hero Section Enhancements */
    .hero-section {
        position: relative;
        min-height: 500px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .hero-content {
        position: relative;
        z-index: 2;
    }
    
    .hero-shapes {
        position: absolute;
        inset: 0;
        overflow: hidden;
        pointer-events: none;
    }
    
    .shape {
        position: absolute;
        border-radius: 50%;
        filter: blur(60px);
        animation: float 20s ease-in-out infinite;
    }
    
    .shape-1 {
        width: 400px;
        height: 400px;
        background: rgba(99, 102, 241, 0.2);
        top: -100px;
        left: -100px;
    }
    
    .shape-2 {
        width: 300px;
        height: 300px;
        background: rgba(168, 85, 247, 0.15);
        bottom: -50px;
        right: -50px;
        animation-delay: -5s;
    }
    
    .shape-3 {
        width: 200px;
        height: 200px;
        background: rgba(236, 72, 153, 0.1);
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        animation-delay: -10s;
    }
    
    @keyframes float {
        0%, 100% { transform: translate(0, 0) scale(1); }
        25% { transform: translate(20px, -20px) scale(1.05); }
        50% { transform: translate(-10px, 20px) scale(0.95); }
        75% { transform: translate(-20px, -10px) scale(1.02); }
    }
    
    /* Stats Card */
    .stat-card {
        border-radius: 20px;
    }
    
    .stat-icon {
        color: var(--accent-primary);
    }
    
    .stat-number {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 2rem;
        font-weight: 700;
        background: var(--gradient-primary);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    
    /* Feature Cards */
    .feature-card {
        border-radius: 24px;
    }
    
    .icon-wrapper {
        width: 80px;
        height: 80px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        transition: var(--transition-normal);
    }
    
    .feature-card:hover .icon-wrapper {
        transform: scale(1.1) rotate(5deg);
    }
    
    /* Game Card Enhancements */
    .game-icon-wrapper {
        position: relative;
        display: inline-block;
    }
    
    .game-icon {
        width: 100px;
        height: 100px;
        border-radius: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        z-index: 1;
        transition: var(--transition-normal);
    }
    
    .game-glow {
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 60%;
        height: 20px;
        background: var(--accent-primary);
        filter: blur(20px);
        opacity: 0.5;
        transition: var(--transition-normal);
    }
    
    .game-card:hover .game-icon {
        transform: translateY(-5px) scale(1.05);
    }
    
    .game-card:hover .game-glow {
        opacity: 0.8;
        width: 80%;
    }
    
    /* Text Gradient */
    .text-gradient {
        background: var(--gradient-primary);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
</style>
@endsection
