@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card" style="background: linear-gradient(135deg, #1a1f2e 0%, #242d3d 100%); border: 1px solid #00d4ff33;">
                <div class="card-body p-5">
                    <h3 class="mb-4" style="color: #00d4ff;">
                        <i class="fas fa-star me-2"></i> {{ $existing ? 'Edit' : 'Tulis' }} Review
                    </h3>

                    <div class="mb-4 p-3 rounded" style="background: #0f1419; border-left: 4px solid #a855f7;">
                        <h6 style="color: #00d4ff;">{{ $game->name }}</h6>
                        <small class="text-muted">{{ $game->description ?? 'Game yang menarik' }}</small>
                    </div>

                    <form method="POST" action="{{ route('reviews.store') }}">
                        @csrf

                        <input type="hidden" name="game_package_id" value="{{ $game->id }}">

                        <!-- Rating -->
                        <div class="mb-4">
                            <label class="form-label" style="color: #00d4ff;">Rating Anda</label>
                            <div class="rating-input" style="font-size: 3rem;">
                                @for($i = 1; $i <= 5; $i++)
                                    <span class="star" data-rating="{{ $i }}" style="cursor: pointer; color: #242d3d; margin-right: 10px; transition: all 0.2s;">
                                        <i class="fas fa-star"></i>
                                    </span>
                                @endfor
                            </div>
                            <input type="hidden" name="rating" id="rating-input" value="{{ $existing->rating ?? 0 }}">
                            @error('rating')
                                <small class="text-danger d-block mt-2">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Review Text -->
                        <div class="mb-4">
                            <label for="review" class="form-label" style="color: #00d4ff;">Komentar Anda</label>
                            <textarea 
                                name="review" 
                                id="review" 
                                class="form-control" 
                                rows="6"
                                placeholder="Bagikan pengalaman Anda dengan game ini..."
                                style="background: #0f1419; border: 1px solid #00d4ff33; color: #e9d5ff; resize: vertical;"
                                required>{{ $existing->review ?? '' }}</textarea>
                            <small class="text-muted d-block mt-2">Minimum 10 karakter, maksimal 500 karakter</small>
                            @error('review')
                                <small class="text-danger d-block mt-2">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn flex-grow-1" style="background: linear-gradient(135deg, #00d4ff 0%, #a855f7 100%); color: #0f1419; border: none; font-weight: 600;">
                                <i class="fas fa-check me-2"></i> {{ $existing ? 'Perbarui' : 'Kirim' }} Review
                            </button>
                            <a href="{{ route('reviews.index', $game->id) }}" class="btn" style="background: #242d3d; color: #00d4ff; border: 1px solid #00d4ff;">
                                <i class="fas fa-times me-2"></i> Batal
                            </a>
                        </div>
                    </form>

                    <!-- Tips -->
                    <div class="alert mt-4" style="background: #a855f733; border: 1px solid #a855f7; color: #e9d5ff;">
                        <h6 style="color: #a855f7;"><i class="fas fa-lightbulb me-2"></i> Tips Menulis Review</h6>
                        <ul class="mb-0 small">
                            <li>Jelaskan pengalaman Anda bermain game ini</li>
                            <li>Berikan rating yang jujur</li>
                            <li>Hindari spoiler atau konten yang tidak pantas</li>
                            <li>Review Anda membantu gamers lain!</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.querySelectorAll('.star').forEach(star => {
    star.addEventListener('click', function() {
        const rating = this.dataset.rating;
        document.getElementById('rating-input').value = rating;
        
        document.querySelectorAll('.star').forEach(s => {
            s.style.color = '#242d3d';
        });
        
        for (let i = 0; i < rating; i++) {
            document.querySelectorAll('.star')[i].style.color = '#a855f7';
        }
    });
    
    star.addEventListener('mouseover', function() {
        const rating = this.dataset.rating;
        document.querySelectorAll('.star').forEach(s => {
            s.style.color = '#242d3d';
        });
        
        for (let i = 0; i < rating; i++) {
            document.querySelectorAll('.star')[i].style.color = '#00d4ff';
        }
    });
});

document.querySelector('.rating-input').addEventListener('mouseleave', function() {
    const currentRating = document.getElementById('rating-input').value;
    document.querySelectorAll('.star').forEach(s => {
        s.style.color = '#242d3d';
    });
    
    for (let i = 0; i < currentRating; i++) {
        document.querySelectorAll('.star')[i].style.color = '#a855f7';
    }
});

// Set initial rating on page load
window.addEventListener('load', function() {
    const currentRating = document.getElementById('rating-input').value;
    for (let i = 0; i < currentRating; i++) {
        document.querySelectorAll('.star')[i].style.color = '#a855f7';
    }
});
</script>
@endsection
