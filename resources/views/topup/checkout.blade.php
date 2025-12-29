@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Breadcrumb -->
    <div class="mb-4" data-aos="fade-right">
        <a href="{{ route('topup.game', $package->game_name) }}" class="btn btn-glass">
            <i class="fas fa-arrow-left me-2"></i>Kembali ke {{ $package->game_name }}
        </a>
    </div>

    <!-- Header -->
    <div class="mb-5" data-aos="fade-up">
        <span class="badge mb-3" style="background: var(--gradient-primary); padding: 0.5rem 1rem; border-radius: 50px;">
            <i class="fas fa-shopping-cart me-1"></i>Checkout
        </span>
        <h1 class="display-5 fw-bold text-gradient mb-3">Selesaikan Pesanan</h1>
        <p class="lead text-muted">Lengkapi informasi untuk melanjutkan pembayaran</p>
    </div>

    <div class="row g-4">
        <!-- Form Section -->
        <div class="col-12 col-lg-8">
            <form action="{{ route('topup.process', $package->id) }}" method="POST">
                @csrf

                <!-- Detail Paket Card -->
                <div class="card mb-4" data-aos="fade-up" data-aos-delay="100" style="border-radius: 24px;">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-4">
                            <div class="icon-wrapper me-3" style="
                                width: 48px;
                                height: 48px;
                                background: linear-gradient(135deg, rgba(99, 102, 241, 0.2), rgba(168, 85, 247, 0.2));
                                border-radius: 12px;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                            ">
                                <i class="fas fa-box" style="color: var(--accent-primary); font-size: 1.25rem;"></i>
                            </div>
                            <h5 class="fw-bold mb-0">Detail Paket</h5>
                        </div>

                        <div class="checkout-item">
                            <span class="text-muted">Nama Game</span>
                            <span class="fw-semibold">{{ $package->game_name }}</span>
                        </div>

                        <div class="checkout-item">
                            <span class="text-muted">Paket</span>
                            <span class="fw-semibold" style="color: var(--accent-emerald);">{{ $package->package_name }}</span>
                        </div>

                        <div class="checkout-item" style="border: none; padding-bottom: 0;">
                            <span class="text-muted">Harga</span>
                            <span class="fw-bold text-gradient" style="font-size: 1.25rem;">
                                Rp{{ number_format($package->price, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Form Input Card -->
                <div class="card mb-4" data-aos="fade-up" data-aos-delay="200" style="border-radius: 24px;">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-4">
                            <div class="icon-wrapper me-3" style="
                                width: 48px;
                                height: 48px;
                                background: linear-gradient(135deg, rgba(16, 185, 129, 0.2), rgba(6, 182, 212, 0.2));
                                border-radius: 12px;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                            ">
                                <i class="fas fa-user-circle" style="color: var(--accent-emerald); font-size: 1.25rem;"></i>
                            </div>
                            <h5 class="fw-bold mb-0">Data Akun Game</h5>
                        </div>

                        <div class="mb-4">
                            <label for="game_account" class="form-label fw-medium">
                                ID / Username Game <span style="color: var(--accent-rose);">*</span>
                            </label>
                            <input type="text" 
                                class="form-control form-control-lg @error('game_account') is-invalid @enderror" 
                                id="game_account" 
                                name="game_account"
                                placeholder="Masukkan ID atau username game Anda"
                                required
                                value="{{ old('game_account') }}"
                                style="border-radius: 12px;"
                            >
                            @error('game_account')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted mt-2 d-block">
                                <i class="fas fa-info-circle me-1"></i>Pastikan ID game Anda benar untuk menghindari kesalahan pengiriman
                            </small>
                        </div>

                        <div class="mb-0">
                            <label for="payment_method" class="form-label fw-medium">
                                Metode Pembayaran <span style="color: var(--accent-rose);">*</span>
                            </label>
                            <select class="form-select form-select-lg @error('payment_method') is-invalid @enderror" 
                                id="payment_method" 
                                name="payment_method"
                                required
                                style="border-radius: 12px;"
                            >
                                <option value="">Pilih metode pembayaran</option>
                                <optgroup label="Transfer Bank">
                                    <option value="bank_transfer" @selected(old('payment_method') === 'bank_transfer')>
                                        🏦 Transfer Bank
                                    </option>
                                </optgroup>
                                <optgroup label="QRIS">
                                    <option value="qris" @selected(old('payment_method') === 'qris')>
                                        📱 QRIS / Barcode
                                    </option>
                                </optgroup>
                                <optgroup label="E-Wallet">
                                    <option value="e_wallet" @selected(old('payment_method') === 'e_wallet')>
                                        💳 E-Wallet (Umum)
                                    </option>
                                    <option value="gopay" @selected(old('payment_method') === 'gopay')>
                                        💚 GoPay
                                    </option>
                                    <option value="ovo" @selected(old('payment_method') === 'ovo')>
                                        💜 OVO
                                    </option>
                                    <option value="dana" @selected(old('payment_method') === 'dana')>
                                        💙 DANA
                                    </option>
                                </optgroup>
                            </select>
                            @error('payment_method')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Security Notice -->
                <div class="card mb-4" data-aos="fade-up" data-aos-delay="250" style="border-radius: 20px; background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(6, 182, 212, 0.1)); border: 1px solid rgba(16, 185, 129, 0.2);">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-shield-alt fa-2x me-3" style="color: var(--accent-emerald);"></i>
                            <div>
                                <h6 class="fw-bold mb-1" style="color: var(--accent-emerald);">Transaksi Aman & Terpercaya</h6>
                                <p class="mb-0 small text-muted">Data pembayaran Anda dilindungi dengan enkripsi SSL 256-bit</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary btn-lg w-100" data-aos="fade-up" data-aos-delay="300" style="border-radius: 16px; padding: 1rem;">
                    <i class="fas fa-lock me-2"></i>Lanjutkan Pembayaran
                </button>
            </form>
        </div>

        <!-- Summary Sidebar -->
        <div class="col-12 col-lg-4">
            <div class="card sticky-top" data-aos="fade-left" data-aos-delay="150" style="border-radius: 24px; top: 100px;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-4">
                        <div class="icon-wrapper me-3" style="
                            width: 48px;
                            height: 48px;
                            background: linear-gradient(135deg, rgba(251, 191, 36, 0.2), rgba(245, 158, 11, 0.2));
                            border-radius: 12px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        ">
                            <i class="fas fa-receipt" style="color: var(--accent-amber); font-size: 1.25rem;"></i>
                        </div>
                        <h5 class="fw-bold mb-0">Ringkasan</h5>
                    </div>

                    <div class="checkout-item">
                        <span class="text-muted">Subtotal</span>
                        <span>Rp{{ number_format($package->price, 0, ',', '.') }}</span>
                    </div>

                    <div class="checkout-item">
                        <span class="text-muted">Pajak</span>
                        <span class="text-success">Rp0</span>
                    </div>

                    <div class="checkout-item">
                        <span class="text-muted">Biaya Admin</span>
                        <span class="text-success">Gratis</span>
                    </div>

                    <hr style="border-color: var(--glass-border); margin: 1rem 0;">

                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-bold" style="font-size: 1.1rem;">Total Bayar</span>
                        <span class="fw-bold text-gradient" style="font-size: 1.5rem;">
                            Rp{{ number_format($package->price, 0, ',', '.') }}
                        </span>
                    </div>

                    <!-- Benefits -->
                    <div class="mt-4 pt-4" style="border-top: 1px solid var(--glass-border);">
                        <p class="fw-medium mb-3" style="font-size: 0.9rem;">Yang Anda dapatkan:</p>
                        <div class="benefit-item">
                            <i class="fas fa-check-circle" style="color: var(--accent-emerald);"></i>
                            <span>Proses instan 24/7</span>
                        </div>
                        <div class="benefit-item">
                            <i class="fas fa-check-circle" style="color: var(--accent-emerald);"></i>
                            <span>Customer support aktif</span>
                        </div>
                        <div class="benefit-item">
                            <i class="fas fa-check-circle" style="color: var(--accent-emerald);"></i>
                            <span>Garansi 100% uang kembali</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('styles')
<style>
    .text-gradient {
        background: var(--gradient-primary);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .btn-glass {
        background: var(--glass-bg);
        backdrop-filter: blur(10px);
        border: 1px solid var(--glass-border);
        color: var(--text-secondary);
        border-radius: 12px;
        transition: var(--transition-normal);
        padding: 0.75rem 1.25rem;
    }
    
    .btn-glass:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: var(--accent-primary);
        color: var(--text-primary);
        transform: translateY(-2px);
    }
    
    .checkout-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 0;
        border-bottom: 1px solid var(--glass-border);
    }
    
    .checkout-item:last-child {
        border-bottom: none;
    }
    
    .benefit-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 0.75rem;
        font-size: 0.9rem;
        color: var(--text-secondary);
    }
    
    .benefit-item:last-child {
        margin-bottom: 0;
    }
    
    .form-control, .form-select {
        background: var(--glass-bg);
        border: 1px solid var(--glass-border);
        color: var(--text-primary);
        transition: var(--transition-normal);
    }
    
    .form-control:focus, .form-select:focus {
        background: var(--glass-bg);
        border-color: var(--accent-primary);
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.15);
        color: var(--text-primary);
    }
    
    .form-control::placeholder {
        color: var(--text-muted);
    }
    
    .form-select option {
        background: var(--bg-secondary);
        color: var(--text-primary);
    }
</style>
@endsection
@endsection
