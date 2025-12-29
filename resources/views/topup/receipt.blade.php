@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Success Header -->
    <div class="text-center mb-5" data-aos="zoom-in">
        <div class="success-icon mx-auto mb-4" style="
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.2), rgba(6, 182, 212, 0.2));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        ">
            <i class="fas fa-check" style="font-size: 2.5rem; color: var(--accent-emerald);"></i>
            <div class="pulse-ring"></div>
        </div>
        <h1 class="display-5 fw-bold mb-2" style="color: var(--accent-emerald);">Transaksi Berhasil!</h1>
        <p class="lead text-muted">Pesanan Anda sedang diproses. Terima kasih telah berbelanja.</p>
    </div>

    <div class="row g-4">
        <!-- Main Content -->
        <div class="col-12 col-lg-8">
            <!-- Transaction Code Card -->
            <div class="card mb-4" data-aos="fade-up" style="border-radius: 24px; background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(6, 182, 212, 0.1)); border: 1px solid rgba(16, 185, 129, 0.3);">
                <div class="card-body p-4 text-center">
                    <p class="text-muted mb-2">Kode Transaksi</p>
                    <h3 class="fw-bold mb-3" style="color: var(--accent-emerald); font-family: 'JetBrains Mono', monospace; letter-spacing: 2px;">
                        {{ $transaction->transaction_code }}
                    </h3>
                    <button class="btn btn-glass" onclick="copyToClipboard('{{ $transaction->transaction_code }}')">
                        <i class="fas fa-copy me-2"></i>Salin Kode
                    </button>
                </div>
            </div>

            <!-- Purchase Details -->
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
                        <h5 class="fw-bold mb-0">Detail Pembelian</h5>
                    </div>

                    <div class="receipt-item">
                        <span class="text-muted">Game</span>
                        <span class="fw-semibold">{{ $transaction->gamePackage->game_name }}</span>
                    </div>
                    <div class="receipt-item">
                        <span class="text-muted">Paket</span>
                        <span class="fw-semibold" style="color: var(--accent-emerald);">{{ $transaction->gamePackage->package_name }}</span>
                    </div>
                    <div class="receipt-item">
                        <span class="text-muted">ID Game</span>
                        <span class="fw-semibold">{{ $transaction->game_account }}</span>
                    </div>
                    <div class="receipt-item" style="border: none;">
                        <span class="text-muted">Harga</span>
                        <span class="fw-bold text-gradient" style="font-size: 1.25rem;">
                            Rp{{ number_format($transaction->total_price, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Payment Section -->
            @if($transaction->status === 'pending')
            <div class="card mb-4" data-aos="fade-up" data-aos-delay="150" style="border-radius: 24px; background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(168, 85, 247, 0.1)); border: 1px solid rgba(99, 102, 241, 0.3);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-4">
                        <div class="icon-wrapper me-3" style="
                            width: 48px;
                            height: 48px;
                            background: linear-gradient(135deg, rgba(99, 102, 241, 0.3), rgba(168, 85, 247, 0.3));
                            border-radius: 12px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        ">
                            <i class="fas fa-credit-card" style="color: var(--accent-primary); font-size: 1.25rem;"></i>
                        </div>
                        <h5 class="fw-bold mb-0">Lanjutkan Pembayaran</h5>
                    </div>
                    
                    @if($transaction->payment_method === 'qris')
                    <p class="text-muted mb-4">Klik tombol di bawah untuk menampilkan QR Code yang dapat di-scan</p>
                    <button id="pay-button" class="btn btn-primary w-100 mb-4" style="border-radius: 16px; padding: 1rem;">
                        <i class="fas fa-qrcode me-2"></i>Tampilkan QR Code
                    </button>
                    
                    <div id="qris-container" style="display: none;">
                        <div class="text-center p-4" style="background: var(--glass-bg); border-radius: 16px;">
                            <!-- Demo QR Code -->
                            <svg style="max-width: 250px; border-radius: 16px; background: white; padding: 20px;" viewBox="0 0 200 200">
                                <rect width="200" height="200" fill="white"/>
                                <rect x="10" y="10" width="40" height="40" fill="black"/>
                                <rect x="15" y="15" width="30" height="30" fill="white"/>
                                <rect x="20" y="20" width="20" height="20" fill="black"/>
                                <rect x="150" y="10" width="40" height="40" fill="black"/>
                                <rect x="155" y="15" width="30" height="30" fill="white"/>
                                <rect x="160" y="20" width="20" height="20" fill="black"/>
                                <rect x="10" y="150" width="40" height="40" fill="black"/>
                                <rect x="15" y="155" width="30" height="30" fill="white"/>
                                <rect x="20" y="160" width="20" height="20" fill="black"/>
                                <rect x="60" y="60" width="80" height="80" fill="black" opacity="0.1"/>
                                <text x="100" y="105" text-anchor="middle" fill="black" font-size="10">DEMO</text>
                            </svg>
                            <p class="text-muted mt-3 mb-2">
                                <strong>Kode:</strong> {{ $transaction->transaction_code }}<br>
                                <strong>Nominal:</strong> Rp{{ number_format($transaction->total_price, 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="alert mt-3" style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); border-radius: 12px; color: var(--accent-emerald);">
                            <i class="fas fa-info-circle me-2"></i><strong>Demo Mode</strong> - Ini adalah barcode demo untuk testing.
                        </div>
                    </div>
                    @else
                    @php
                        $paymentMethods = [
                            'bank_transfer' => 'Transfer Bank',
                            'qris' => 'QRIS / Barcode',
                            'e_wallet' => 'E-Wallet',
                            'gopay' => 'GoPay',
                            'ovo' => 'OVO',
                            'dana' => 'DANA',
                        ];
                    @endphp
                    <p class="text-muted mb-4">
                        Metode pembayaran: <strong>{{ $paymentMethods[$transaction->payment_method] ?? $transaction->payment_method }}</strong>
                    </p>
                    <button id="pay-button" class="btn btn-primary w-100" style="border-radius: 16px; padding: 1rem;">
                        <i class="fas fa-lock me-2"></i>Bayar Sekarang
                    </button>
                    <div class="alert mt-3" style="background: rgba(99, 102, 241, 0.1); border: 1px solid rgba(99, 102, 241, 0.3); border-radius: 12px; color: var(--accent-primary);">
                        <i class="fas fa-info-circle me-2"></i><strong>Demo Mode</strong> - Hubungi support untuk pembayaran.
                    </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Payment Status -->
            <div class="card mb-4" data-aos="fade-up" data-aos-delay="200" style="border-radius: 24px;">
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
                            <i class="fas fa-clock" style="color: var(--accent-amber); font-size: 1.25rem;"></i>
                        </div>
                        <h5 class="fw-bold mb-0">Status Pembayaran</h5>
                    </div>

                    <div class="status-alert" style="
                        background: rgba(251, 191, 36, 0.1);
                        border-left: 4px solid var(--accent-amber);
                        padding: 1rem 1.25rem;
                        border-radius: 12px;
                    ">
                        <p class="fw-bold mb-1" style="color: var(--accent-amber);">
                            <i class="fas fa-hourglass-half me-2"></i>Menunggu Konfirmasi
                        </p>
                        <p class="text-muted mb-0 small">
                            Pembayaran Anda sedang diproses. Kami akan mengonfirmasi dalam beberapa menit.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Payment Method -->
            <div class="card mb-4" data-aos="fade-up" data-aos-delay="250" style="border-radius: 24px;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-wrapper me-3" style="
                            width: 48px;
                            height: 48px;
                            background: linear-gradient(135deg, rgba(6, 182, 212, 0.2), rgba(59, 130, 246, 0.2));
                            border-radius: 12px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        ">
                            <i class="fas fa-wallet" style="color: var(--accent-cyan); font-size: 1.25rem;"></i>
                        </div>
                        <h5 class="fw-bold mb-0">Metode Pembayaran</h5>
                    </div>
                    @php
                        $paymentMethods = [
                            'bank_transfer' => 'Transfer Bank',
                            'qris' => 'QRIS / Barcode',
                            'e_wallet' => 'E-Wallet',
                            'gopay' => 'GoPay',
                            'ovo' => 'OVO',
                            'dana' => 'DANA',
                        ];
                    @endphp
                    <p class="fw-semibold mb-0">{{ $paymentMethods[$transaction->payment_method] ?? $transaction->payment_method }}</p>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-12 col-lg-4">
            <!-- Important Notice -->
            <div class="card mb-4" data-aos="fade-left" style="border-radius: 24px; background: linear-gradient(135deg, rgba(244, 63, 94, 0.1), rgba(239, 68, 68, 0.1)); border: 1px solid rgba(244, 63, 94, 0.3);">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3" style="color: var(--accent-rose);">
                        <i class="fas fa-exclamation-triangle me-2"></i>Penting
                    </h6>
                    <ul class="notice-list">
                        <li>Simpan kode transaksi Anda</li>
                        <li>Jangan tutup halaman ini sampai pembayaran selesai</li>
                        <li>Cek email untuk detail pembayaran</li>
                        <li>Hubungi support jika ada masalah</li>
                    </ul>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="d-grid gap-3 mb-4" data-aos="fade-left" data-aos-delay="100">
                <a href="{{ route('topup.index') }}" class="btn btn-glass">
                    <i class="fas fa-arrow-left me-2"></i>Belanja Lagi
                </a>
                <a href="{{ route('topup.myTransactions') }}" class="btn btn-primary">
                    <i class="fas fa-history me-2"></i>Riwayat Transaksi
                </a>
            </div>

            <!-- Contact Support -->
            <div class="card" data-aos="fade-left" data-aos-delay="150" style="border-radius: 24px;">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3">
                        <i class="fas fa-headset me-2" style="color: var(--accent-primary);"></i>Butuh Bantuan?
                    </h6>
                    <div class="contact-item">
                        <i class="fas fa-envelope" style="color: var(--accent-primary);"></i>
                        <span>support@gamecredit.com</span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-phone" style="color: var(--accent-emerald);"></i>
                        <span>+62 812 3456 7890</span>
                    </div>
                    <div class="contact-item">
                        <i class="fab fa-whatsapp" style="color: #25d366;"></i>
                        <span>WhatsApp Support</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        // Show toast or alert
        const btn = event.target.closest('button');
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check me-2"></i>Tersalin!';
        btn.style.color = 'var(--accent-emerald)';
        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.style.color = '';
        }, 2000);
    });
}

@if($transaction->status === 'pending' && $transaction->payment_method === 'qris')
document.getElementById('pay-button').addEventListener('click', function() {
    const container = document.getElementById('qris-container');
    if (container.style.display === 'none') {
        container.style.display = 'block';
        this.innerHTML = '<i class="fas fa-eye-slash me-2"></i>Sembunyikan QR Code';
    } else {
        container.style.display = 'none';
        this.innerHTML = '<i class="fas fa-qrcode me-2"></i>Tampilkan QR Code';
    }
});
@endif
</script>

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
        border-radius: 16px;
        padding: 0.875rem 1.5rem;
        transition: var(--transition-normal);
    }
    
    .btn-glass:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: var(--accent-primary);
        color: var(--text-primary);
        transform: translateY(-2px);
    }
    
    .pulse-ring {
        position: absolute;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        border: 2px solid var(--accent-emerald);
        animation: pulse 2s ease-out infinite;
    }
    
    @keyframes pulse {
        0% { transform: scale(1); opacity: 1; }
        100% { transform: scale(1.5); opacity: 0; }
    }
    
    .receipt-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 0;
        border-bottom: 1px solid var(--glass-border);
    }
    
    .notice-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .notice-list li {
        padding: 0.5rem 0;
        padding-left: 1.5rem;
        position: relative;
        color: var(--text-secondary);
        font-size: 0.9rem;
    }
    
    .notice-list li::before {
        content: '•';
        position: absolute;
        left: 0;
        color: var(--accent-rose);
    }
    
    .contact-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 0;
        color: var(--text-secondary);
        font-size: 0.9rem;
    }
    
    .contact-item i {
        width: 20px;
        text-align: center;
    }
</style>
@endsection
@endsection
