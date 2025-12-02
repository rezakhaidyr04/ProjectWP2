@extends('layouts.app')

@section('content')
<div class="container py-5" style="position: relative;">
    <!-- Header -->
    <div class="mb-4">
        <a href="{{ route('topup.game', $package->game_name) }}" class="text-decoration-none" style="color: #00f5ff;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="mb-5">
        <h2 style="color: #ffffff; font-weight: 700; margin-bottom: 25px;">
            Checkout
        </h2>
    </div>

    <div class="row g-4" style="align-items: flex-start;">
        <!-- Ringkasan Pesanan -->
        <div class="col-12 col-lg-8">
            <form action="{{ route('topup.process', $package->id) }}" method="POST">
                @csrf

                <!-- Detail Paket -->
                <div class="card mb-4" style="
                    background: rgba(30, 30, 30, 0.8);
                    border: 2px solid rgba(0, 245, 255, 0.3);
                    border-radius: 15px;
                    backdrop-filter: blur(20px);
                ">
                    <div class="card-body">
                        <h5 style="color: #00f5ff; font-weight: 600; margin-bottom: 20px;">
                            <i class="fas fa-box"></i> Detail Paket
                        </h5>

                        <div style="display: flex; justify-content: space-between; margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid rgba(0, 245, 255, 0.2);">
                            <span style="color: #a0a0c0;">Nama Game</span>
                            <span style="color: #ffffff; font-weight: 600;">{{ $package->game_name }}</span>
                        </div>

                        <div style="display: flex; justify-content: space-between; margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid rgba(0, 245, 255, 0.2);">
                            <span style="color: #a0a0c0;">Paket</span>
                            <span style="color: #ffffff; font-weight: 600;">{{ $package->package_name }}</span>
                        </div>

                        <div style="display: flex; justify-content: space-between;">
                            <span style="color: #a0a0c0;">Harga</span>
                            <span style="color: #39ff14; font-weight: 700; font-size: 1.1rem;">
                                Rp{{ number_format($package->price, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Form Input -->
                <div class="card mb-4" style="
                    background: rgba(30, 30, 30, 0.8);
                    border: 2px solid rgba(0, 245, 255, 0.3);
                    border-radius: 15px;
                    backdrop-filter: blur(20px);
                ">
                    <div class="card-body">
                        <h5 style="color: #00f5ff; font-weight: 600; margin-bottom: 20px;">
                            <i class="fas fa-user-circle"></i> Data Akun Game
                        </h5>

                        <div class="mb-3">
                            <label for="game_account" style="color: #a0a0c0; font-weight: 500; margin-bottom: 8px; display: block;">
                                ID / Username Game <span style="color: #ff006e;">*</span>
                            </label>
                            <input type="text" 
                                class="form-control @error('game_account') is-invalid @enderror" 
                                id="game_account" 
                                name="game_account"
                                placeholder="Masukkan ID atau username game Anda"
                                required
                                style="
                                    background: rgba(18, 18, 18, 0.8);
                                    border: 2px solid rgba(0, 245, 255, 0.3);
                                    color: #ffffff;
                                    border-radius: 8px;
                                    padding: 12px 15px;
                                    transition: all 0.3s;
                                "
                                value="{{ old('game_account') }}"
                            >
                            @error('game_account')
                            <div style="color: #ff3b30; font-size: 0.85rem; margin-top: 5px;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-0">
                            <label for="payment_method" style="color: #a0a0c0; font-weight: 500; margin-bottom: 8px; display: block;">
                                Metode Pembayaran <span style="color: #ff006e;">*</span>
                            </label>
                            <select class="form-control @error('payment_method') is-invalid @enderror" 
                                id="payment_method" 
                                name="payment_method"
                                required
                                style="
                                    background: rgba(18, 18, 18, 0.8);
                                    border: 2px solid rgba(0, 245, 255, 0.3);
                                    color: #ffffff;
                                    border-radius: 8px;
                                    padding: 12px 15px;
                                    transition: all 0.3s;
                                "
                            >
                                <option value="">Pilih metode pembayaran</option>
                                <option value="bank_transfer" @selected(old('payment_method') === 'bank_transfer')>
                                    <i class="fas fa-university"></i> Transfer Bank
                                </option>
                                <option value="qris" @selected(old('payment_method') === 'qris')>
                                    <i class="fas fa-qrcode"></i> QRIS / Barcode
                                </option>
                                <option value="e_wallet" @selected(old('payment_method') === 'e_wallet')>
                                    <i class="fas fa-wallet"></i> E-Wallet
                                </option>
                                <option value="gopay" @selected(old('payment_method') === 'gopay')>
                                    GoPay
                                </option>
                                <option value="ovo" @selected(old('payment_method') === 'ovo')>
                                    OVO
                                </option>
                                <option value="dana" @selected(old('payment_method') === 'dana')>
                                    DANA
                                </option>
                            </select>
                            @error('payment_method')
                            <div style="color: #ff3b30; font-size: 0.85rem; margin-top: 5px;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Tombol Submit -->
                <button type="submit" class="btn w-100" style="
                    background: linear-gradient(135deg, #00f5ff, #39ff14);
                    color: #000;
                    font-weight: 600;
                    border: none;
                    border-radius: 8px;
                    padding: 15px;
                    font-size: 1.1rem;
                    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                    cursor: pointer;
                ">
                    <i class="fas fa-credit-card"></i> Lanjutkan Pembayaran
                </button>
            </form>
        </div>

        <!-- Ringkasan Harga -->
        <div class="col-12 col-lg-4">
            <div class="card" style="
                background: rgba(30, 30, 30, 0.8);
                border: 2px solid rgba(0, 245, 255, 0.3);
                border-radius: 15px;
                backdrop-filter: blur(20px);
                position: sticky;
                top: 90px;
                align-self: start;
            ">
                <div class="card-body">
                    <h5 style="color: #00f5ff; font-weight: 600; margin-bottom: 20px;">
                        <i class="fas fa-receipt"></i> Ringkasan
                    </h5>

                    <div style="display: flex; justify-content: space-between; margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid rgba(0, 245, 255, 0.2);">
                        <span style="color: #a0a0c0;">Subtotal</span>
                        <span style="color: #ffffff;">Rp{{ number_format($package->price, 0, ',', '.') }}</span>
                    </div>

                    <div style="display: flex; justify-content: space-between; margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid rgba(0, 245, 255, 0.2);">
                        <span style="color: #a0a0c0;">Pajak (0%)</span>
                        <span style="color: #ffffff;">Rp0</span>
                    </div>

                    <div style="display: flex; justify-content: space-between; padding-top: 10px;">
                        <span style="color: #ffffff; font-weight: 600; font-size: 1.1rem;">Total</span>
                        <span style="color: #39ff14; font-weight: 700; font-size: 1.2rem;">
                            Rp{{ number_format($package->price, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control:focus {
        background-color: rgba(18, 18, 18, 0.9) !important;
        border-color: #00f5ff !important;
        box-shadow: 0 0 15px rgba(0, 245, 255, 0.3) !important;
        color: #ffffff !important;
    }

    .form-control {
        color: #ffffff !important;
    }

    .form-control::placeholder {
        color: #708fa0 !important;
    }

    .form-control option {
        background: #1e1e1e;
        color: #ffffff;
    }

    .form-control option:checked {
        background: linear-gradient(#1e1e1e, #1e1e1e);
        color: #ffffff;
    }

    .btn:hover {
        box-shadow: 0 0 20px rgba(0, 245, 255, 0.5) !important;
    }
</style>
@endsection
