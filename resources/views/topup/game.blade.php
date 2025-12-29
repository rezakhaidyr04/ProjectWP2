@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Breadcrumb -->
    <div class="mb-4" data-aos="fade-right">
        <a href="{{ route('topup.index') }}" class="btn btn-glass">
            <i class="fas fa-arrow-left me-2"></i>Kembali ke Katalog
        </a>
    </div>

    <!-- Header -->
    <div class="mb-5" data-aos="fade-up">
        <span class="badge mb-3" style="background: var(--gradient-primary); padding: 0.5rem 1rem; border-radius: 50px;">
            <i class="fas fa-gamepad me-1"></i>{{ $gameName }}
        </span>
        <h1 class="display-5 fw-bold text-gradient mb-3">{{ $gameName }}</h1>
        <p class="lead text-muted">Pilih paket yang sesuai dengan kebutuhan Anda</p>
    </div>

    <!-- Filter Section -->
    <div class="card mb-5" data-aos="fade-up" data-aos-delay="100" style="border-radius: 20px;">
        <div class="card-body p-4">
            <div class="d-flex align-items-center mb-3">
                <i class="fas fa-filter me-2" style="color: var(--accent-primary);"></i>
                <h6 class="fw-bold mb-0">Filter Paket</h6>
            </div>
            <form method="GET" class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Harga Minimum</label>
                    <div class="input-group">
                        <span class="input-group-text" style="background: transparent; border-right: none;">Rp</span>
                        <input type="number" name="min_price" class="form-control" placeholder="0" value="{{ request('min_price') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Harga Maksimum</label>
                    <div class="input-group">
                        <span class="input-group-text" style="background: transparent; border-right: none;">Rp</span>
                        <input type="number" name="max_price" class="form-control" placeholder="0" value="{{ request('max_price') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Urutkan</label>
                    <select name="sort_by" class="form-select">
                        <option value="price_asc" {{ request('sort_by') === 'price_asc' ? 'selected' : '' }}>Harga Terendah</option>
                        <option value="price_desc" {{ request('sort_by') === 'price_desc' ? 'selected' : '' }}>Harga Tertinggi</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-primary flex-grow-1">
                        <i class="fas fa-search me-2"></i>Terapkan
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
        <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
            <div class="card h-100 package-card" style="border-radius: 24px; overflow: hidden;">
                <!-- Package Image -->
                <div class="package-image-wrapper" style="
                    height: 280px;
                    background: linear-gradient(135deg, rgba(99, 102, 241, 0.15), rgba(168, 85, 247, 0.15));
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    overflow: hidden;
                    position: relative;
                ">
                    @if($package->image)
                        <img src="{{ asset('images/games/' . $package->image) }}" alt="{{ $package->package_name }}" style="
                            width: 100%;
                            height: 100%;
                            object-fit: contain;
                            padding: 20px;
                            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
                        " class="package-image">
                    @else
                        <div style="color: var(--text-muted); text-align: center;">
                            <i class="fas fa-image fa-4x" style="opacity: 0.3;"></i>
                            <p class="mt-3 mb-0">No Image</p>
                        </div>
                    @endif
                </div>

                <!-- Package Info -->
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <h4 class="fw-bold mb-2" style="color: var(--accent-emerald);">
                            {{ $package->package_name }}
                        </h4>
                        <p class="text-muted small mb-0">{{ $package->description }}</p>
                    </div>

                    <!-- Price -->
                    <div class="text-center mb-4">
                        <span class="text-muted small">Harga</span>
                        <h3 class="fw-bold text-gradient mb-0">
                            Rp{{ number_format($package->price, 0, ',', '.') }}
                        </h3>
                    </div>

                    <!-- Reviews & Wishlist -->
                    <div class="d-flex gap-2 mb-4">
                        <a href="{{ route('reviews.index', $package->id) }}" class="btn btn-glass flex-grow-1" style="font-size: 0.85rem;">
                            <i class="fas fa-star me-1" style="color: var(--accent-amber);"></i> Review ({{ $package->reviews()->count() }})
                        </a>
                        @auth
                            <button type="button" class="btn btn-glass" onclick="toggleWishlist({{ $package->id }})" style="color: var(--accent-rose);">
                                <i class="fas fa-heart"></i>
                            </button>
                        @endauth
                    </div>

                    <!-- Buy Button -->
                    @auth
                        <a href="{{ route('topup.checkout', $package->id) }}" class="btn btn-primary w-100">
                            <i class="fas fa-shopping-cart me-2"></i>Beli Sekarang
                        </a>
                    @else
                        <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#loginModal" style="background: var(--accent-rose); border: none;">
                            <i class="fas fa-sign-in-alt me-2"></i>Login untuk Membeli
                        </button>
                    @endauth
                </div>
            </div>
        </div>
        @empty
        <div class="col-12" data-aos="fade-up">
            <div class="card p-5 text-center" style="border-radius: 24px;">
                <div class="mb-4">
                    <i class="fas fa-box-open fa-4x" style="color: var(--accent-rose); opacity: 0.5;"></i>
                </div>
                <h4 class="fw-bold mb-2">Paket Tidak Tersedia</h4>
                <p class="text-muted mb-4">Tidak ada paket tersedia untuk game ini saat ini</p>
                <div>
                    <a href="{{ route('topup.index') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-left me-2"></i>Lihat Game Lain
                    </a>
                </div>
            </div>
        </div>
        @endforelse
    </div>
</div>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 24px; border: 1px solid var(--glass-border);">
            <div class="modal-header" style="border-bottom: 1px solid var(--glass-border);">
                <h5 class="modal-title fw-bold">
                    <i class="fas fa-lock me-2" style="color: var(--accent-primary);"></i>Login Diperlukan
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 text-center">
                <div class="mb-4">
                    <i class="fas fa-user-lock fa-4x" style="color: var(--accent-primary); opacity: 0.5;"></i>
                </div>
                <p class="text-muted mb-4">
                    Silakan login terlebih dahulu untuk melakukan pembelian top-up game.
                </p>
                <div class="d-flex gap-3 justify-content-center">
                    <a href="{{ route('login') }}" class="btn btn-primary px-4">
                        <i class="fas fa-sign-in-alt me-2"></i>Login
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-outline-secondary px-4">
                        <i class="fas fa-user-plus me-2"></i>Daftar
                    </a>
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
    
    .package-card:hover .package-image {
        transform: scale(1.1);
    }
    
    .btn-glass {
        background: var(--glass-bg);
        backdrop-filter: blur(10px);
        border: 1px solid var(--glass-border);
        color: var(--text-secondary);
        border-radius: 12px;
        transition: var(--transition-normal);
    }
    
    .btn-glass:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: var(--accent-primary);
        color: var(--text-primary);
        transform: translateY(-2px);
    }
    
    .input-group-text {
        border-color: var(--glass-border);
    }
</style>
@endsection
@endsection
                <a href="{{ route('login') }}" class="btn" style="background: linear-gradient(135deg, #00f5ff, #39ff14); color: #000; font-weight: 600; border: none;">
                    <i class="fas fa-sign-in-alt"></i> Login Sekarang
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function toggleWishlist(gamePackageId) {
    // Check if already in wishlist
    fetch(`/wishlist/check/${gamePackageId}`, {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.in_wishlist) {
            // Remove from wishlist
            fetch(`/wishlist/${gamePackageId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById(`wishlist-text-${gamePackageId}`).textContent = 'Tambah ke Wishlist';
                    alert(data.message);
                }
            });
        } else {
            // Add to wishlist
            fetch('/wishlist/store', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    game_package_id: gamePackageId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById(`wishlist-text-${gamePackageId}`).textContent = 'Hapus dari Wishlist';
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan');
            });
        }
    });
}

// Load wishlist status on page load
document.addEventListener('DOMContentLoaded', function() {
    const packageIds = document.querySelectorAll('[id^="wishlist-text-"]');
    packageIds.forEach(element => {
        const gamePackageId = element.id.split('-')[2];
        fetch(`/wishlist/check/${gamePackageId}`, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.in_wishlist) {
                element.textContent = 'Hapus dari Wishlist';
            }
        });
    });
});
</script>
