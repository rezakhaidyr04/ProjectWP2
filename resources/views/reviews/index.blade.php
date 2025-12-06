@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row mb-5">
        <div class="col-lg-8 mx-auto">
            <!-- Game Header -->
            <div class="game-header mb-5 p-4 rounded" style="background: linear-gradient(135deg, #1a1f2e 0%, #242d3d 100%); border: 1px solid #00d4ff33;">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <img src="{{ $game->image_url ?? 'https://via.placeholder.com/200' }}" alt="{{ $game->name }}" class="img-fluid rounded">
                    </div>
                    <div class="col-md-9">
                        <h2 class="mb-3" style="color: #00d4ff;">{{ $game->name }}</h2>
                        
                        <!-- Rating Display -->
                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-2">
                                <span class="fs-4 fw-bold" style="color: #a855f7;">★ {{ number_format($avgRating, 1) }}</span>
                                <span class="ms-3 text-muted">dari 5 bintang</span>
                            </div>
                            
                            <!-- Rating Distribution -->
                            <div style="font-size: 0.9rem;">
                                @foreach([5,4,3,2,1] as $star)
                                    @php
                                        $count = $ratingDist[$star] ?? 0;
                                        $percentage = $count > 0 ? ($count / array_sum($ratingDist) * 100) : 0;
                                    @endphp
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="me-2 text-muted" style="width: 30px;">{{ $star }} ★</span>
                                        <div class="progress flex-grow-1" style="height: 8px; background: #242d3d;">
                                            <div class="progress-bar" role="progressbar" style="width: {{ $percentage }}%; background: linear-gradient(90deg, #00d4ff 0%, #a855f7 100%));" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <span class="ms-2 text-muted" style="width: 40px;">{{ $count }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        @auth
                            @if(!$userReview)
                                <a href="{{ route('reviews.create', $game->id) }}" class="btn btn-sm" style="background: linear-gradient(135deg, #00d4ff 0%, #a855f7 100%); color: #0f1419; border: none;">
                                    <i class="fas fa-star me-2"></i> Tulis Review
                                </a>
                            @else
                                <a href="{{ route('reviews.create', $game->id) }}" class="btn btn-sm" style="background: #00d4ff33; color: #00d4ff; border: 1px solid #00d4ff;">
                                    <i class="fas fa-edit me-2"></i> Edit Review Anda
                                </a>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn btn-sm" style="background: linear-gradient(135deg, #00d4ff 0%, #a855f7 100%); color: #0f1419; border: none;">
                                <i class="fas fa-star me-2"></i> Login untuk Review
                            </a>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- User's Review (if exists) -->
            @auth
                @if($userReview)
                    <div class="alert alert-info mb-5" style="background: #a855f733; border: 1px solid #a855f7; color: #e9d5ff;">
                        <h5 class="mb-3"><i class="fas fa-user-circle me-2"></i> Review Anda</h5>
                        <div class="mb-3">
                            <span style="color: #a855f7;">★★★★★</span><span class="ms-2 text-muted">{{ $userReview->rating }}/5</span>
                        </div>
                        <p class="mb-3">{{ $userReview->review }}</p>
                        <small class="text-muted">{{ $userReview->created_at->format('d M Y H:i') }}</small>
                        <div class="mt-3">
                            <form action="{{ route('reviews.destroy', $userReview->id) }}" method="POST" style="display: inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus review?')">Hapus Review</button>
                            </form>
                        </div>
                    </div>
                @endif
            @endauth

            <!-- Reviews List -->
            <h4 class="mb-4" style="color: #00d4ff;">
                <i class="fas fa-comments me-2"></i> Semua Review ({{ $reviews->total() }})
            </h4>

            @forelse($reviews as $review)
                <div class="card mb-4" style="background: #1a1f2e; border: 1px solid #00d4ff33; border-radius: 12px;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h6 class="mb-1" style="color: #00d4ff;">
                                    <i class="fas fa-user-circle me-2"></i> {{ $review->user->name }}
                                </h6>
                                <div style="color: #a855f7;">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star" style="color: {{ $i <= $review->rating ? '#a855f7' : '#242d3d' }}; font-size: 0.9rem;"></i>
                                    @endfor
                                    <span class="ms-2 text-muted">({{ $review->rating }}/5)</span>
                                </div>
                            </div>
                            <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                        </div>

                        <p class="mb-3">{{ $review->review }}</p>

                        <div class="d-flex align-items-center gap-3">
                            <button class="btn btn-sm" style="background: #00d4ff33; color: #00d4ff; border: none; cursor: pointer;" onclick="markHelpful({{ $review->id }})">
                                <i class="fas fa-thumbs-up me-2"></i> Helpful <span id="helpful-{{ $review->id }}">{{ $review->helpful_count }}</span>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert" style="background: #242d3d; border: 1px solid #00d4ff33; color: #a0aec0;">
                    <i class="fas fa-inbox me-2"></i> Belum ada review untuk game ini. Jadilah yang pertama! 
                </div>
            @endforelse

            <!-- Pagination -->
            @if($reviews->hasPages())
                <div class="d-flex justify-content-center mt-5">
                    {{ $reviews->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<script>
function markHelpful(reviewId) {
    fetch(`/reviews/${reviewId}/helpful`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById(`helpful-${reviewId}`).textContent = data.helpful_count;
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>

@style
<style>
.card {
    transition: all 0.3s ease;
}

.card:hover {
    border-color: #a855f7 !important;
    box-shadow: 0 0 20px rgba(168, 85, 247, 0.2);
}

.progress {
    border-radius: 6px;
}
</style>
@endstyle
@endsection
