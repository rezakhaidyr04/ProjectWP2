@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Header -->
    <div class="mb-4">
        <a href="{{ route('topup.index') }}" class="text-decoration-none" style="color: #00f5ff;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="mb-5">
        <h1 class="display-4 mb-2" style="background: linear-gradient(135deg, #00f5ff, #39ff14); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
            {{ $gameName }}
        </h1>
        <p class="lead" style="color: #a0a0c0;">Pilih paket yang ingin Anda beli</p>
    </div>

    <!-- Packages Grid -->
    <div class="row g-4">
        @forelse($packages as $package)
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card h-100" style="
                background: rgba(30, 30, 30, 0.8);
                border: 2px solid rgba(0, 245, 255, 0.3);
                border-radius: 15px;
                backdrop-filter: blur(20px);
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                overflow: hidden;
            ">
                <div style="
                    background: linear-gradient(135deg, rgba(0, 245, 255, 0.1), rgba(57, 255, 20, 0.1));
                    padding: 30px;
                    text-align: center;
                ">
                    <h4 style="color: #39ff14; font-weight: 700; margin: 0 0 10px 0;">
                        {{ $package->package_name }}
                    </h4>
                    <p style="color: #a0a0c0; margin: 0; font-size: 0.9rem;">
                        {{ $package->description }}
                    </p>
                </div>

                <div class="card-body">
                    <div style="margin-bottom: 20px;">
                        <p style="color: #a0a0c0; margin: 0 0 8px 0; font-size: 0.85rem;">Harga</p>
                        <h3 style="color: #00f5ff; font-weight: 700; margin: 0;">
                            Rp{{ number_format($package->price, 0, ',', '.') }}
                        </h3>
                    </div>
                    <a href="{{ route('topup.checkout', $package->id) }}" class="btn w-100" style="
                        background: linear-gradient(135deg, #00f5ff, #39ff14);
                        color: #000;
                        font-weight: 600;
                        border: none;
                        border-radius: 8px;
                        padding: 12px;
                        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                    ">
                        <i class="fas fa-shopping-cart"></i> Beli Sekarang
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert" style="background: rgba(255, 59, 48, 0.1); border: 2px solid #ff3b30; color: #ff3b30; border-radius: 10px;">
                <i class="fas fa-exclamation-circle"></i> Tidak ada paket tersedia untuk game ini
            </div>
        </div>
        @endforelse
    </div>
</div>

<style>
    .card:hover {
        border-color: #00f5ff !important;
        box-shadow: 0 0 30px rgba(0, 245, 255, 0.3) !important;
        transform: translateY(-5px);
    }

    .btn:hover {
        box-shadow: 0 0 20px rgba(0, 245, 255, 0.5) !important;
    }
</style>
@endsection
