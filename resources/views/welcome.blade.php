@extends('layouts.app')

@section('title', 'Kelompo 2 - Platform Top Up Game Online Terpercaya')

@section('content')
<!-- Hero Section -->
<div class="hero-section">
    <h1><i class="fas fa-zap me-3"></i>TOP UP GAME FAVORIT ANDA</h1>
    <p>Platform top up game online terpercaya dengan harga terbaik & transaksi super cepat</p>
    @guest
        <div class="mt-4">
            <a href="{{ route('login') }}" class="btn btn-primary me-3">
                <i class="fas fa-sign-in-alt me-2"></i>Masuk Sekarang
            </a>
            <a href="{{ route('register') }}" class="btn btn-outline-secondary">
                <i class="fas fa-user-plus me-2"></i>Daftar Gratis
            </a>
        </div>
    @endguest
</div>

<!-- Feature Section -->
<div class="row g-4 mb-6">
    <div class="col-md-6 col-lg-3">
        <div class="card text-center p-4">
            <i class="fas fa-bolt fa-3x" style="color: var(--neon-cyan); margin-bottom: 15px; filter: drop-shadow(0 0 10px rgba(0, 245, 255, 0.5));"></i>
            <h5 class="fw-bold">Instan</h5>
            <p class="small text-muted mb-0">Top up langsung masuk dalam hitungan detik</p>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card text-center p-4">
            <i class="fas fa-lock fa-3x" style="color: var(--neon-lime); margin-bottom: 15px; filter: drop-shadow(0 0 10px rgba(57, 255, 20, 0.5));"></i>
            <h5 class="fw-bold">Aman</h5>
            <p class="small text-muted mb-0">Transaksi terenkripsi dan terjamin keamanannya</p>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card text-center p-4">
            <i class="fas fa-percent fa-3x" style="color: var(--neon-pink); margin-bottom: 15px; filter: drop-shadow(0 0 10px rgba(255, 0, 110, 0.5));"></i>
            <h5 class="fw-bold">Harga Terbaik</h5>
            <p class="small text-muted mb-0">Harga kompetitif dengan berbagai pilihan paket</p>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card text-center p-4">
            <i class="fas fa-headset fa-3x" style="color: var(--accent-warn); margin-bottom: 15px; filter: drop-shadow(0 0 10px rgba(255, 170, 0, 0.5));"></i>
            <h5 class="fw-bold">Support 24/7</h5>
            <p class="small text-muted mb-0">Customer service siap membantu kapan saja</p>
        </div>
    </div>
</div>

<!-- Game Section Title -->
<div class="text-center mb-5">
    <h2 class="mb-2" style="font-size: 2.5rem; font-weight: 900;">🎮 GAME POPULER</h2>
    <p class="text-muted fs-5">Pilih game favorit Anda dan mulai top up sekarang juga</p>
</div>

<!-- Game Cards Grid (Available for Both Auth & Guest) -->
<div class="row g-4 mb-5">
    <div class="col-md-6 col-lg-3">
        <a href="{{ route('topup.game', 'Mobile Legends') }}" class="text-decoration-none">
            <div class="game-card card p-4 text-center">
                <div style="position: relative; margin-bottom: 20px;">
                    <i class="fas fa-crown fa-4x" style="color: var(--neon-cyan);"></i>
                </div>
                <h4 class="fw-bold mb-2">Mobile Legends</h4>
                <p class="small text-muted mb-1">Top up Diamonds</p>
                <p class="small text-muted mb-4">5.5 Juta+ pengguna</p>
                <button class="btn btn-primary w-100">
                    <i class="fas fa-arrow-right me-2"></i>Lihat Paket
                </button>
            </div>
        </a>
    </div>

    <div class="col-md-6 col-lg-3">
        <a href="{{ route('topup.game', 'Free Fire') }}" class="text-decoration-none">
            <div class="game-card card p-4 text-center">
                <div style="position: relative; margin-bottom: 20px;">
                    <i class="fas fa-fire fa-4x" style="color: var(--accent-warn);"></i>
                </div>
                <h4 class="fw-bold mb-2">Free Fire</h4>
                <p class="small text-muted mb-1">Top up Diamonds</p>
                <p class="small text-muted mb-4">50 Juta+ pengguna</p>
                <button class="btn btn-primary w-100">
                    <i class="fas fa-arrow-right me-2"></i>Lihat Paket
                </button>
            </div>
        </a>
    </div>

    <div class="col-md-6 col-lg-3">
        <a href="{{ route('topup.game', 'PUBG Mobile') }}" class="text-decoration-none">
            <div class="game-card card p-4 text-center">
                <div style="position: relative; margin-bottom: 20px;">
                    <i class="fas fa-gun fa-4x" style="color: var(--neon-lime);"></i>
                </div>
                <h4 class="fw-bold mb-2">PUBG Mobile</h4>
                <p class="small text-muted mb-1">Top up UC</p>
                <p class="small text-muted mb-4">30 Juta+ pengguna</p>
                <button class="btn btn-primary w-100">
                    <i class="fas fa-arrow-right me-2"></i>Lihat Paket
                </button>
            </div>
        </a>
    </div>

    <div class="col-md-6 col-lg-3">
        <a href="{{ route('topup.game', 'Valorant') }}" class="text-decoration-none">
            <div class="game-card card p-4 text-center">
                <div style="position: relative; margin-bottom: 20px;">
                    <i class="fas fa-crosshairs fa-4x" style="color: var(--neon-pink);"></i>
                </div>
                <h4 class="fw-bold mb-2">Valorant</h4>
                <p class="small text-muted mb-1">Top up Points</p>
                <p class="small text-muted mb-4">25 Juta+ pengguna</p>
                <button class="btn btn-primary w-100">
                    <i class="fas fa-arrow-right me-2"></i>Lihat Paket
                </button>
            </div>
        </a>
    </div>
</div>

<!-- Tips Alert -->
@auth
<div class="alert alert-info mt-5" role="alert">
    <i class="fas fa-info-circle me-2"></i>
    <strong>Tips:</strong> Cek riwayat transaksi Anda di menu <strong>Riwayat</strong> untuk melihat semua pembelian.
</div>
@else
<div class="alert alert-info mt-5" role="alert">
    <i class="fas fa-info-circle me-2"></i>
    <strong>Tips:</strong> Anda bisa melihat paket game sekarang, tapi harus <strong><a href="{{ route('login') }}" style="color: #0d6efd; font-weight: 600;">login</a></strong> untuk melakukan pembelian.
</div>
@endif
</div>
@endsection
