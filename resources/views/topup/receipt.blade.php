@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Header -->
    <div class="mb-5 text-center">
        <i class="fas fa-check-circle" style="font-size: 4rem; color: #39ff14; margin-bottom: 20px; display: block;"></i>
        <h1 class="display-5" style="color: #39ff14; font-weight: 700; margin-bottom: 10px;">
            Transaksi Berhasil!
        </h1>
        <p class="lead" style="color: #a0a0c0;">
            Pesanan Anda sedang diproses. Terima kasih telah berbelanja di Kelompok 2.
        </p>
    </div>

    <div class="row g-4">
        <!-- Detail Transaksi -->
        <div class="col-12 col-lg-8">
            <!-- Kode Transaksi -->
            <div class="card mb-4" style="
                background: rgba(30, 30, 30, 0.8);
                border: 2px solid rgba(57, 255, 20, 0.3);
                border-radius: 15px;
                backdrop-filter: blur(20px);
            ">
                <div class="card-body text-center">
                    <p style="color: #a0a0c0; margin-bottom: 10px;">Kode Transaksi</p>
                    <h3 style="color: #39ff14; font-weight: 700; font-family: 'Courier New', monospace; margin: 0; letter-spacing: 2px;">
                        {{ $transaction->transaction_code }}
                    </h3>
                    <button class="btn btn-sm" style="
                        background: rgba(0, 245, 255, 0.2);
                        border: 1px solid #00f5ff;
                        color: #00f5ff;
                        margin-top: 10px;
                        border-radius: 6px;
                        padding: 6px 12px;
                    " onclick="copyToClipboard('{{ $transaction->transaction_code }}')">
                        <i class="fas fa-copy"></i> Salin
                    </button>
                </div>
            </div>

            <!-- Detail Pembelian -->
            <div class="card mb-4" style="
                background: rgba(30, 30, 30, 0.8);
                border: 2px solid rgba(0, 245, 255, 0.3);
                border-radius: 15px;
                backdrop-filter: blur(20px);
            ">
                <div class="card-body">
                    <h5 style="color: #00f5ff; font-weight: 600; margin-bottom: 20px;">
                        <i class="fas fa-box"></i> Detail Pembelian
                    </h5>

                    <div style="display: flex; justify-content: space-between; margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid rgba(0, 245, 255, 0.2);">
                        <span style="color: #a0a0c0;">Game</span>
                        <span style="color: #ffffff; font-weight: 600;">{{ $transaction->gamePackage->game_name }}</span>
                    </div>

                    <div style="display: flex; justify-content: space-between; margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid rgba(0, 245, 255, 0.2);">
                        <span style="color: #a0a0c0;">Paket</span>
                        <span style="color: #ffffff; font-weight: 600;">{{ $transaction->gamePackage->package_name }}</span>
                    </div>

                    <div style="display: flex; justify-content: space-between; margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid rgba(0, 245, 255, 0.2);">
                        <span style="color: #a0a0c0;">ID Game</span>
                        <span style="color: #ffffff; font-weight: 600;">{{ $transaction->game_account }}</span>
                    </div>

                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: #a0a0c0;">Harga</span>
                        <span style="color: #39ff14; font-weight: 700; font-size: 1.1rem;">
                            Rp{{ number_format($transaction->total_price, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Button Pembayaran -->
            @if($transaction->status === 'pending')
            <div class="card mb-4" style="
                background: rgba(30, 30, 30, 0.8);
                border: 2px solid rgba(57, 255, 20, 0.3);
                border-radius: 15px;
                backdrop-filter: blur(20px);
            ">
                <div class="card-body">
                    <h5 style="color: #39ff14; font-weight: 600; margin-bottom: 15px;">
                        <i class="fas fa-credit-card"></i> Lanjutkan Pembayaran
                    </h5>
                    
                    @if($transaction->payment_method === 'qris')
                    <p style="color: #a0a0c0; margin-bottom: 15px; font-size: 0.9rem;">
                        Klik tombol di bawah untuk menampilkan QR Code yang dapat di-scan
                    </p>
                    <button id="pay-button" class="btn w-100" style="
                        background: linear-gradient(135deg, #00f5ff, #39ff14);
                        color: #000;
                        font-weight: 600;
                        border: none;
                        border-radius: 8px;
                        padding: 15px;
                        font-size: 1.1rem;
                        cursor: pointer;
                        margin-bottom: 15px;
                    ">
                        <i class="fas fa-qrcode"></i> Tampilkan QR Code
                    </button>
                    
                    <div id="qris-container" style="display: none; text-align: center; padding: 20px; background: rgba(255, 255, 255, 0.05); border-radius: 8px; margin-bottom: 15px;">
                        <!-- Demo QRIS Barcode -->
                        <svg style="max-width: 300px; border-radius: 8px;" viewBox="0 0 200 200">
                            <!-- Simple QR Code Pattern for Demo -->
                            <rect width="200" height="200" fill="white"/>
                            <!-- Position markers (3 corners) -->
                            <rect x="10" y="10" width="40" height="40" fill="black"/>
                            <rect x="15" y="15" width="30" height="30" fill="white"/>
                            <rect x="20" y="20" width="20" height="20" fill="black"/>
                            
                            <rect x="150" y="10" width="40" height="40" fill="black"/>
                            <rect x="155" y="15" width="30" height="30" fill="white"/>
                            <rect x="160" y="20" width="20" height="20" fill="black"/>
                            
                            <rect x="10" y="150" width="40" height="40" fill="black"/>
                            <rect x="15" y="155" width="30" height="30" fill="white"/>
                            <rect x="20" y="160" width="20" height="20" fill="black"/>
                            
                            <!-- Random pattern in middle -->
                            <rect x="60" y="60" width="10" height="10" fill="black"/>
                            <rect x="75" y="60" width="10" height="10" fill="black"/>
                            <rect x="90" y="60" width="10" height="10" fill="white"/>
                            <rect x="105" y="60" width="10" height="10" fill="black"/>
                            
                            <rect x="60" y="75" width="10" height="10" fill="white"/>
                            <rect x="75" y="75" width="10" height="10" fill="black"/>
                            <rect x="90" y="75" width="10" height="10" fill="black"/>
                            <rect x="105" y="75" width="10" height="10" fill="white"/>
                            
                            <rect x="60" y="90" width="10" height="10" fill="black"/>
                            <rect x="75" y="90" width="10" height="10" fill="white"/>
                            <rect x="90" y="90" width="10" height="10" fill="black"/>
                            <rect x="105" y="90" width="10" height="10" fill="black"/>
                            
                            <rect x="60" y="105" width="10" height="10" fill="black"/>
                            <rect x="75" y="105" width="10" height="10" fill="black"/>
                            <rect x="90" y="105" width="10" height="10" fill="white"/>
                            <rect x="105" y="105" width="10" height="10" fill="black"/>
                        </svg>
                        <p style="color: #a0a0c0; margin-top: 15px; font-size: 0.85rem;">
                            <strong>Kode Transaksi:</strong> {{ $transaction->transaction_code }}<br>
                            <strong>Nominal:</strong> Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                        </p>
                        <div style="background: rgba(57, 255, 20, 0.1); border-left: 4px solid #39ff14; padding: 15px; border-radius: 8px; margin-top: 15px;">
                            <p style="color: #39ff14; font-weight: 600; margin: 0 0 8px 0;">
                                <i class="fas fa-check-circle"></i> Demo Mode
                            </p>
                            <p style="color: #a0a0c0; margin: 0; font-size: 0.9rem;">
                                Ini adalah barcode demo. Untuk pembayaran asli, hubungi support.
                            </p>
                        </div>
                    </div>
                    @else
                    <p style="color: #a0a0c0; margin-bottom: 15px; font-size: 0.9rem;">
                        Metode pembayaran: <strong>{{ $paymentMethods[$transaction->payment_method] ?? $transaction->payment_method }}</strong>
                    </p>
                    
                    <button id="pay-button" class="btn w-100" style="
                        background: linear-gradient(135deg, #00f5ff, #39ff14);
                        color: #000;
                        font-weight: 600;
                        border: none;
                        border-radius: 8px;
                        padding: 15px;
                        font-size: 1.1rem;
                        cursor: pointer;
                    ">
                        <i class="fas fa-lock"></i> Bayar Sekarang
                    </button>
                    
                    <div style="background: rgba(0, 245, 255, 0.1); border-left: 4px solid #00f5ff; padding: 15px; border-radius: 8px; margin-top: 15px;">
                        <p style="color: #00f5ff; font-weight: 600; margin: 0 0 8px 0;">
                            <i class="fas fa-info-circle"></i> Demo Mode
                        </p>
                        <p style="color: #a0a0c0; margin: 0; font-size: 0.9rem;">
                            Hubungi support untuk melakukan pembayaran. Sistem saat ini dalam mode demo.
                        </p>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Status Pembayaran -->
            <div class="card mb-4" style="
                background: rgba(30, 30, 30, 0.8);
                border: 2px solid rgba(0, 245, 255, 0.3);
                border-radius: 15px;
                backdrop-filter: blur(20px);
            ">
                <div class="card-body">
                    <h5 style="color: #00f5ff; font-weight: 600; margin-bottom: 20px;">
                        <i class="fas fa-clock"></i> Status Pembayaran
                    </h5>

                    <div style="background: rgba(255, 170, 0, 0.1); border-left: 4px solid #ffaa00; padding: 15px; border-radius: 8px;">
                        <p style="color: #ffaa00; font-weight: 600; margin: 0;">
                            <i class="fas fa-hourglass-half"></i> Menunggu Konfirmasi
                        </p>
                        <p style="color: #a0a0c0; margin: 8px 0 0 0; font-size: 0.9rem;">
                            Pembayaran Anda sedang diproses. Kami akan mengonfirmasi pembayaran Anda dalam beberapa menit.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Status Pembayaran -->
            </div>

            <!-- Metode Pembayaran -->
            <div class="card mb-4" style="
                background: rgba(30, 30, 30, 0.8);
                border: 2px solid rgba(0, 245, 255, 0.3);
                border-radius: 15px;
                backdrop-filter: blur(20px);
            ">
                <div class="card-body">
                    <h5 style="color: #00f5ff; font-weight: 600; margin-bottom: 20px;">
                        <i class="fas fa-credit-card"></i> Metode Pembayaran
                    </h5>

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

                    <p style="color: #ffffff; font-weight: 600; margin: 0;">
                        {{ $paymentMethods[$transaction->payment_method] ?? $transaction->payment_method }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-12 col-lg-4">
            <!-- Info Penting -->
            <div class="card mb-4" style="
                background: rgba(255, 59, 48, 0.1);
                border: 2px solid rgba(255, 59, 48, 0.3);
                border-radius: 15px;
                backdrop-filter: blur(20px);
            ">
                <div class="card-body">
                    <h5 style="color: #ff3b30; font-weight: 600; margin-bottom: 15px;">
                        <i class="fas fa-exclamation-triangle"></i> Penting
                    </h5>
                    <ul style="color: #a0a0c0; font-size: 0.9rem; padding-left: 20px; margin: 0;">
                        <li style="margin-bottom: 10px;">Simpan kode transaksi Anda</li>
                        <li style="margin-bottom: 10px;">Jangan tutup halaman ini sampai pembayaran selesai</li>
                        <li style="margin-bottom: 10px;">Cek email untuk detail pembayaran</li>
                        <li>Hubungi support jika ada masalah</li>
                    </ul>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="d-grid gap-2">
                <a href="{{ route('topup.index') }}" class="btn" style="
                    background: rgba(0, 245, 255, 0.2);
                    border: 2px solid #00f5ff;
                    color: #00f5ff;
                    font-weight: 600;
                    border-radius: 8px;
                    padding: 12px;
                    text-decoration: none;
                    text-align: center;
                    transition: all 0.3s;
                ">
                    <i class="fas fa-arrow-left"></i> Belanja Lagi
                </a>

                <a href="{{ route('topup.myTransactions') }}" class="btn" style="
                    background: linear-gradient(135deg, #00f5ff, #39ff14);
                    color: #000;
                    font-weight: 600;
                    border: none;
                    border-radius: 8px;
                    padding: 12px;
                    text-decoration: none;
                    text-align: center;
                ">
                    <i class="fas fa-history"></i> Riwayat Transaksi
                </a>
            </div>

            <!-- Informasi Kontak -->
            <div class="card mt-4" style="
                background: rgba(30, 30, 30, 0.8);
                border: 2px solid rgba(0, 245, 255, 0.3);
                border-radius: 15px;
                backdrop-filter: blur(20px);
            ">
                <div class="card-body">
                    <h6 style="color: #00f5ff; font-weight: 600; margin-bottom: 15px;">
                        Butuh Bantuan?
                    </h6>
                    <p style="color: #a0a0c0; margin-bottom: 10px; font-size: 0.9rem;">
                        <i class="fas fa-envelope"></i> support@gamecredit.com
                    </p>
                    <p style="color: #a0a0c0; margin: 0; font-size: 0.9rem;">
                        <i class="fas fa-phone"></i> +62 812 3456 7890
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        alert('Kode transaksi berhasil disalin!');
    });
}

// Toggle barcode untuk QRIS
@if($transaction->status === 'pending' && $transaction->payment_method === 'qris')
document.getElementById('pay-button').addEventListener('click', function() {
    const container = document.getElementById('qris-container');
    if (container.style.display === 'none') {
        container.style.display = 'block';
        this.innerHTML = '<i class="fas fa-eye-slash"></i> Sembunyikan QR Code';
    } else {
        container.style.display = 'none';
        this.innerHTML = '<i class="fas fa-qrcode"></i> Tampilkan QR Code';
    }
});
@endif
</script>


<style>
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 245, 255, 0.2);
    }
</style>
@endsection
