@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2 style="color: #00d4ff;">
                <i class="fas fa-heart me-2"></i> Wishlist Saya
                <small class="text-muted">({{ $wishlists->total() }})</small>
            </h2>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('games.index') }}" class="btn btn-sm" style="background: #242d3d; color: #00d4ff; border: 1px solid #00d4ff;">
                <i class="fas fa-plus me-2"></i> Tambah Game
            </a>
        </div>
    </div>

    @if($wishlists->count() > 0)
        <div class="row g-4">
            @foreach($wishlists as $wishlist)
                @php $game = $wishlist->gamePackage; @endphp
                <div class="col-md-6 col-lg-4">
                    <div class="game-card h-100 p-4 rounded position-relative" style="background: linear-gradient(135deg, #1a1f2e 0%, #242d3d 100%); border: 1px solid #00d4ff33; transition: all 0.3s; cursor: pointer;">
                        <!-- Remove Button -->
                        <button onclick="removeWishlist({{ $game->id }})" class="btn btn-sm position-absolute top-0 end-0 m-3" style="background: #ec489933; color: #ec4899; border: 1px solid #ec4899; z-index: 10;">
                            <i class="fas fa-heart-broken"></i>
                        </button>

                        <!-- Image -->
                        <div class="mb-3">
                            <img src="{{ $game->image_url ?? 'https://via.placeholder.com/300x200' }}" alt="{{ $game->name }}" class="img-fluid rounded" style="width: 100%; height: 150px; object-fit: cover;">
                        </div>

                        <!-- Game Info -->
                        <h5 style="color: #00d4ff;" class="mb-2">{{ $game->name }}</h5>
                        
                        <div class="mb-3">
                            <small class="text-muted d-block">Kategori: {{ $game->category ?? 'RPG' }}</small>
                            <small class="text-muted d-block">Developer: {{ $game->developer ?? 'Unknown' }}</small>
                        </div>

                        <!-- Price -->
                        <div class="mb-3">
                            <h6 style="color: #a855f7;">Rp {{ number_format($game->base_price ?? 0, 0, ',', '.') }}</h6>
                        </div>

                        <!-- Actions -->
                        <div class="d-grid gap-2">
                            <a href="{{ route('games.show', $game->id) }}" class="btn btn-sm" style="background: linear-gradient(135deg, #00d4ff 0%, #a855f7 100%); color: #0f1419; border: none; font-weight: 600;">
                                <i class="fas fa-eye me-2"></i> Lihat Detail
                            </a>
                            <a href="{{ route('transactions.create', ['game_package_id' => $game->id]) }}" class="btn btn-sm" style="background: #242d3d; color: #00d4ff; border: 1px solid #00d4ff;">
                                <i class="fas fa-shopping-cart me-2"></i> Top Up
                            </a>
                        </div>

                        <!-- Added Date -->
                        <small class="text-muted d-block mt-3 text-center">
                            <i class="fas fa-clock me-1"></i> {{ $wishlist->created_at->format('d M Y') }}
                        </small>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($wishlists->hasPages())
            <div class="d-flex justify-content-center mt-5">
                {{ $wishlists->links() }}
            </div>
        @endif
    @else
        <div class="alert" style="background: linear-gradient(135deg, #1a1f2e 0%, #242d3d 100%); border: 1px solid #00d4ff33; color: #a0aec0; padding: 60px 20px; text-align: center;">
            <i class="fas fa-inbox" style="font-size: 3rem; color: #00d4ff; opacity: 0.5; display: block; margin-bottom: 20px;"></i>
            <h5>Wishlist Kosong</h5>
            <p class="mb-0">Anda belum menambahkan game ke wishlist. <a href="{{ route('games.index') }}" style="color: #00d4ff;">Jelajahi game sekarang!</a></p>
        </div>
    @endif
</div>

<script>
function removeWishlist(gameId) {
    if (confirm('Hapus dari wishlist?')) {
        fetch(`/wishlist/${gameId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            }
        })
        .then(response => {
            if (response.ok) {
                location.reload();
            }
        })
        .catch(error => console.error('Error:', error));
    }
}
</script>

<style>
.game-card:hover {
    border-color: #a855f7 !important;
    box-shadow: 0 0 30px rgba(168, 85, 247, 0.3);
    transform: translateY(-5px);
}
</style>
@endsection
