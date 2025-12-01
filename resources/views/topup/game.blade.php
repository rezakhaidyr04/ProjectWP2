@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Header -->
    <div class="mb-4">
        <a href="{{ route('topup.index') }}" class="text-decoration-none" style="color: #00f5ff;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="mb-4">
        <h1 class="display-4 mb-2" style="background: linear-gradient(135deg, #00f5ff, #39ff14); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
            {{ $gameName }}
        </h1>
        <p class="lead" style="color: #a0a0c0;">Pilih paket yang ingin Anda beli</p>
    </div>

    <!-- Filter Section -->
    <div class="card mb-4" style="background: rgba(30, 30, 30, 0.6); border: 2px solid rgba(0, 245, 255, 0.2);">
        <div class="card-body">
            <form method="GET" class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Harga Minimum</label>
                    <input type="number" name="min_price" class="form-control" placeholder="0" value="{{ request('min_price') }}"
                           style="background: rgba(30, 30, 30, 0.8); border: 2px solid rgba(0, 245, 255, 0.3);">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Harga Maksimum</label>
                    <input type="number" name="max_price" class="form-control" placeholder="0" value="{{ request('max_price') }}"
                           style="background: rgba(30, 30, 30, 0.8); border: 2px solid rgba(0, 245, 255, 0.3);">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Urutkan</label>
                    <select name="sort_by" class="form-select" style="background: rgba(30, 30, 30, 0.8); border: 2px solid rgba(0, 245, 255, 0.3);">
                        <option value="price_asc" {{ request('sort_by') === 'price_asc' ? 'selected' : '' }}>Harga Terendah</option>
                        <option value="price_desc" {{ request('sort_by') === 'price_desc' ? 'selected' : '' }}>Harga Tertinggi</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                    @if(request('min_price') || request('max_price') || request('sort_by'))
                        <a href="{{ route('topup.game', $gameName) }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>
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
