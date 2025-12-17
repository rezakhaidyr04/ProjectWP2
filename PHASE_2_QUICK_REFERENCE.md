# Phase 2 Quick Reference - Reviews, Wishlist & Export

## 🚀 Quick Start

### View the Features:
```bash
# Start Laravel server
php artisan serve

# Access the application
http://localhost:8000

# Login/Register for authenticated features
```

---

## 📋 File Structure

```
app/
├── Http/Controllers/
│   ├── GameReviewController.php      (3 halaman + JSON endpoints)
│   ├── WishlistController.php        (Wishlist management)
│   └── ExportController.php          (PDF/CSV exports)
├── Models/
│   ├── GameReview.php               (with scopes & methods)
│   ├── Wishlist.php
│   ├── GamePackage.php              (updated)
│   └── User.php                     (updated)
└── Exports/
    └── TransactionsExport.php       (CSV formatter)

resources/views/
├── reviews/
│   ├── index.blade.php              (Display reviews)
│   └── create.blade.php             (Create/Edit form)
├── wishlist/
│   └── index.blade.php              (Wishlist grid)
├── export/
│   ├── create.blade.php             (Export control center)
│   ├── pdf.blade.php                (Transaction PDF template)
│   ├── reviews.blade.php            (Reviews PDF template)
│   └── wishlist.blade.php           (Wishlist PDF template)
└── layouts/
    └── app.blade.php                (updated navbar)

routes/
└── web.php                          (11 new routes added)
```

---

## 🔗 Routes Added

### Reviews Routes:
```php
GET    /reviews/game/{gamePackageId}     → GameReviewController@index
GET    /reviews/create/{gamePackageId}   → GameReviewController@create
POST   /reviews/store                    → GameReviewController@store
GET    /reviews/{review}                 → GameReviewController@show
POST   /reviews/{review}/helpful         → GameReviewController@markHelpful
DELETE /reviews/{review}                 → GameReviewController@destroy
```

### Wishlist Routes:
```php
GET    /wishlist/                        → WishlistController@index
POST   /wishlist/store                   → WishlistController@store
DELETE /wishlist/{gamePackageId}         → WishlistController@destroy
GET    /wishlist/check/{gamePackageId}   → WishlistController@check
```

### Export Routes:
```php
GET    /export/                          → ExportController@create
POST   /export/transactions/pdf          → ExportController@pdf
POST   /export/transactions/csv          → ExportController@csv
GET    /export/reviews                   → ExportController@reviews
GET    /export/wishlist                  → ExportController@wishlist
GET    /export/stats                     → ExportController@stats
```

---

## 🎯 Use Cases & Examples

### 1. Display Reviews for a Game
```php
// In controller or view
$gameId = 5;
$reviews = GameReview::forGame($gameId)->latest()->paginate(10);
$avgRating = GameReview::getAverageRating($gameId);
$ratingDist = GameReview::getRatingDistribution($gameId);
```

### 2. Add to Wishlist (JavaScript)
```javascript
fetch('/wishlist/store', {
    method: 'POST',
    headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        'Content-Type': 'application/json',
    },
    body: JSON.stringify({
        game_package_id: 5
    })
})
.then(response => response.json())
.then(data => {
    if (data.success) {
        alert('Added to wishlist!');
    }
});
```

### 3. Export Transactions as PDF
```php
// POST /export/transactions/pdf
// Send filters:
// - start_date: 2024-01-01
// - end_date: 2024-12-31
// - status: completed
```

### 4. Get User Wishlist
```php
// In controller
$user = Auth::user();
$wishlist = $user->wishlists()->with('gamePackage')->get();

// In view
@foreach($wishlists as $item)
    {{ $item->gamePackage->name }}
@endforeach
```

---

## 🎨 UI Components

### Rating Stars Component
```blade
<!-- 5-star rating display -->
@for($i = 1; $i <= 5; $i++)
    <i class="fas fa-star" style="color: {{ $i <= $review->rating ? '#a855f7' : '#242d3d' }}"></i>
@endfor

<!-- Interactive star selector (in create form) -->
<div class="rating-input" style="font-size: 3rem;">
    @for($i = 1; $i <= 5; $i++)
        <span class="star" data-rating="{{ $i }}" style="cursor: pointer; color: #242d3d;">
            <i class="fas fa-star"></i>
        </span>
    @endfor
</div>
```

### Wishlist Button
```blade
<button onclick="toggleWishlist({{ $game->id }})" class="btn">
    <i class="fas fa-heart me-1"></i> 
    <span id="wishlist-text-{{ $game->id }}">Tambah ke Wishlist</span>
</button>
```

### Export Form
```blade
<form id="transactionForm">
    <input type="date" name="start_date">
    <input type="date" name="end_date">
    <select name="status">
        <option value="">Semua Status</option>
        <option value="completed">Berhasil</option>
        <option value="pending">Menunggu</option>
    </select>
    <button onclick="exportTransaction('pdf')">Export PDF</button>
    <button onclick="exportTransaction('csv')">Export CSV</button>
</form>
```

---

## 🧪 Testing Checklist

### Reviews:
- [ ] Create review untuk game
- [ ] Edit existing review
- [ ] Delete review
- [ ] View all reviews untuk game
- [ ] Mark review as helpful
- [ ] Verify rating distribution
- [ ] Check average rating calculation

### Wishlist:
- [ ] Add game to wishlist
- [ ] View wishlist page
- [ ] Remove game from wishlist
- [ ] Verify wishlist count
- [ ] Check wishlist status endpoint
- [ ] Test with multiple games

### Export:
- [ ] Export transactions as PDF
- [ ] Export transactions as CSV
- [ ] Filter by date range
- [ ] Filter by status
- [ ] Export reviews as PDF
- [ ] Export wishlist as PDF
- [ ] Verify statistics endpoint

---

## 🔐 Security Notes

### Authentication:
- Reviews: Auth required untuk create/edit/delete
- Wishlist: Auth required untuk all actions
- Export: Auth required untuk all exports
- Show: Public untuk view reviews & statistics

### Authorization:
- Users can only edit/delete own reviews
- Users can only manage own wishlist
- Users can only export own data
- Admin features coming in Phase 3

### Validation:
```php
// Reviews
'rating' => 'required|integer|min:1|max:5',
'review' => 'required|string|min:10|max:500',
'game_package_id' => 'required|exists:game_packages,id'

// Wishlist
'game_package_id' => 'required|exists:game_packages,id',
// Unique constraint: user_id + game_package_id

// Export
'start_date' => 'nullable|date',
'end_date' => 'nullable|date|after_or_equal:start_date',
'status' => 'nullable|in:pending,completed,failed'
```

---

## 🐛 Troubleshooting

### Reviews not showing:
- Check game_package_id exists
- Verify database migration applied
- Check database connection
- Verify GameReview model relationships

### Wishlist button not working:
- Ensure user is authenticated
- Check CSRF token in HTML
- Verify wishlist table exists
- Check browser console for errors

### Export failing:
- Install dompdf & excel packages:
  ```bash
  composer require barryvdh/laravel-dompdf maatwebsite/excel
  ```
- Ensure storage/ directory writable
- Check for PDF generation errors
- Verify data exists before export

---

## 📦 Dependencies

```json
{
    "barryvdh/laravel-dompdf": "^2.0",
    "maatwebsite/excel": "^3.1"
}
```

### Installation:
```bash
cd c:\ProjectWP2
composer require barryvdh/laravel-dompdf maatwebsite/excel
```

---

## 🎯 Performance Notes

### Database Queries Optimized:
```php
// Reviews with user loaded
$reviews = GameReview::with('user')->latest()->paginate(10);

// Wishlist with game package
$wishlists = $user->wishlists()->with('gamePackage')->get();

// Transactions with game
$transactions = $user->transactions()->with('gamePackage')->get();
```

### Indexes Created:
- game_reviews: (user_id, game_package_id, rating, created_at)
- wishlists: (user_id, created_at)
- user_badges: (user_id, badge_code)
- loyalty_points: (user_id, created_at)

---

## 📊 Data Models

### GameReview
```php
[
    'id' => 1,
    'user_id' => 5,
    'game_package_id' => 10,
    'rating' => 4,
    'review' => 'Great game...',
    'helpful_count' => 12,
    'created_at' => '2024-01-15 10:30:00',
    'updated_at' => '2024-01-15 10:30:00'
]
```

### Wishlist
```php
[
    'id' => 1,
    'user_id' => 5,
    'game_package_id' => 10,
    'created_at' => '2024-01-15 10:30:00',
    'updated_at' => '2024-01-15 10:30:00'
]
```

---

## 🚀 Next Phase Features

Ready to implement:
- **Dark Mode** - Toggle button, CSS classes
- **2FA** - OTP generation, verification
- **Badges** - Achievement tracking
- **Points** - Loyalty points system
- **Bulk Top-Up** - CSV parser
- **Languages** - Multi-language support
- **Live Chat** - Real-time messaging
- **Analytics** - Dashboard with charts
- **Marketing** - Newsletter, campaigns
- **Swagger** - API documentation

---

**Last Updated:** Phase 2 Session 1 ✅
**Status:** Ready for testing & next phase
