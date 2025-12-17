<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            background: #f5f5f5;
        }
        .header {
            background: linear-gradient(135deg, #0f1419 0%, #242d3d 100%);
            color: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            color: #00d4ff;
            font-size: 24px;
        }
        .header p {
            margin: 5px 0 0 0;
            font-size: 12px;
            opacity: 0.8;
        }
        .review-item {
            background: white;
            border-left: 4px solid #a855f7;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 4px;
            page-break-inside: avoid;
        }
        .review-item h4 {
            margin: 0 0 5px 0;
            color: #a855f7;
            font-size: 14px;
        }
        .review-item p {
            margin: 8px 0;
            line-height: 1.5;
        }
        .review-game {
            color: #00d4ff;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .review-rating {
            color: #a855f7;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .review-text {
            color: #333;
            font-style: italic;
            margin: 10px 0;
        }
        .review-date {
            color: #999;
            font-size: 12px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            font-size: 12px;
            color: #666;
        }
        .empty {
            text-align: center;
            padding: 40px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1><i>⭐</i> Laporan Review</h1>
        <p>Total Review: {{ $reviews->count() }} | Dicetak pada: {{ now()->format('d M Y H:i:s') }}</p>
    </div>

    @forelse($reviews as $review)
        <div class="review-item">
            <div class="review-game">🎮 {{ $review->gamePackage->name ?? 'Unknown Game' }}</div>
            <div class="review-rating">
                @for($i = 1; $i <= 5; $i++)
                    @if($i <= $review->rating) ★ @else ☆ @endif
                @endfor
                ({{ $review->rating }}/5)
            </div>
            <div class="review-text">
                "{{ $review->review }}"
            </div>
            <div class="review-date">
                📅 {{ $review->created_at->format('d M Y') }}
                @if($review->helpful_count > 0)
                    | 👍 {{ $review->helpful_count }} people found this helpful
                @endif
            </div>
        </div>
    @empty
        <div class="empty">
            <p>Anda belum menulis review apapun</p>
        </div>
    @endforelse

    <div class="footer">
        <p>Laporan ini dibuat dari platform Kelompok 2 Gaming Top-Up</p>
        <p>© {{ now()->year }} - Semua hak dilindungi</p>
    </div>
</body>
</html>
