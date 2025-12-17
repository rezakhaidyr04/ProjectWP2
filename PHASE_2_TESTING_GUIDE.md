# Phase 2 Testing Guide - Manual Testing Instructions

## 🎯 Pre-Testing Setup

### 1. Database Preparation
```bash
# Ensure all migrations are applied
php artisan migrate --force

# Seed sample data (optional)
php artisan db:seed

# Create test user
# Via artisan tinker:
php artisan tinker
>>> \App\Models\User::create(['name' => 'Test User', 'email' => 'test@example.com', 'password' => bcrypt('password')])
```

### 2. Start Server
```bash
cd c:\ProjectWP2
php artisan serve
# Access at http://localhost:8000
```

### 3. Create Test Account
- Click "Daftar" (Register)
- Email: testuser@example.com
- Password: test123456
- Verify email if required

---

## 📝 Test Cases by Feature

## ✅ TEST FEATURE #1: REVIEWS & RATINGS

### Test 1.1: View Reviews for a Game
**Scenario:** User views existing reviews for a game
1. Navigate to `/topup`
2. Click on any game
3. Scroll to "Semua Review" section
4. **Expected:** Display list of reviews with:
   - User name & avatar
   - Star rating (1-5)
   - Review text
   - Helpful count
   - Posted time

**Result:** ✅ / ❌

---

### Test 1.2: Create New Review
**Scenario:** Authenticated user creates a review
1. Login to account
2. Go to game detail page
3. Click "Tulis Review" button (or "Edit Review" if exists)
4. Fill form:
   - Click on stars to select 1-5 rating
   - Enter review text (min 10 chars)
5. Click "Kirim Review"
6. **Expected:** 
   - Review saved to database
   - User redirected to reviews page
   - Success message shown
   - Review appears in list

**Result:** ✅ / ❌

---

### Test 1.3: Star Rating Widget
**Scenario:** Test interactive star rating
1. Go to create review page
2. Hover over stars → should change to cyan color
3. Click on star 3 → should show 3 purple stars
4. Hover again → should update hover state
5. Leave rating area → should persist selection
6. **Expected:** Stars correctly show selected rating with proper colors

**Result:** ✅ / ❌

---

### Test 1.4: Edit Review
**Scenario:** User edits their own review
1. Go to reviews page for a game you reviewed
2. See "Edit Review Anda" button in blue alert box
3. Click to edit
4. Change rating & text
5. Click "Perbarui Review"
6. **Expected:** 
   - Review updated in database
   - Changes visible in review list
   - Updated timestamp shown

**Result:** ✅ / ❌

---

### Test 1.5: Delete Review
**Scenario:** User deletes their review
1. Go to reviews page for game you reviewed
2. Click "Hapus Review" button in your review section
3. Confirm deletion
4. **Expected:** 
   - Review removed from list
   - Helpful count decrements
   - Success message shown

**Result:** ✅ / ❌

---

### Test 1.6: Mark Review as Helpful
**Scenario:** User marks review as helpful
1. View review from another user
2. Click "Helpful" button below review
3. **Expected:** 
   - helpful_count increments by 1
   - Button shows updated count
   - No page reload needed (AJAX)

**Result:** ✅ / ❌

---

### Test 1.7: Validation - Short Review
**Scenario:** Try to submit review with <10 chars
1. Go to create review
2. Rate 4 stars
3. Enter review: "Good" (4 chars)
4. Click submit
5. **Expected:** Error message "minimum 10 characters"

**Result:** ✅ / ❌

---

### Test 1.8: Validation - High Rating
**Scenario:** Try to submit rating > 5
1. Go to create review (dev tools)
2. Change rating input value to 6
3. Submit
4. **Expected:** Error message "rating must be 1-5"

**Result:** ✅ / ❌

---

### Test 1.9: Rating Distribution
**Scenario:** Check rating distribution chart
1. Go to game reviews page
2. Look at header section with "Average Rating"
3. See progress bars for 5★, 4★, 3★, 2★, 1★
4. **Expected:**
   - Bars show percentage based on review count
   - Numbers on right show count per rating
   - Matches average rating calculation

**Result:** ✅ / ❌

---

### Test 1.10: Average Rating Calculation
**Scenario:** Verify average rating is correct
1. Open reviews page
2. Check displayed average (e.g., 4.2/5)
3. Calculate manually: (reviews with rating * rating) / total reviews
4. **Expected:** Displayed average matches calculation

**Result:** ✅ / ❌

---

## ❤️ TEST FEATURE #2: WISHLIST

### Test 2.1: Add Game to Wishlist
**Scenario:** Authenticated user adds game to wishlist
1. Login
2. Go to game detail page
3. Click "Tambah ke Wishlist" button (pink button)
4. **Expected:**
   - Button text changes to "Hapus dari Wishlist"
   - Confirmation message appears
   - Game saved to wishlist

**Result:** ✅ / ❌

---

### Test 2.2: View Wishlist
**Scenario:** User views their wishlist
1. Click "Wishlist" in navbar
2. **Expected:**
   - Grid display of games in wishlist
   - Shows: thumbnail, name, category, developer, price
   - "Lihat Detail" & "Top Up" buttons per game
   - Count of games shown in header

**Result:** ✅ / ❌

---

### Test 2.3: Remove from Wishlist
**Scenario:** User removes game from wishlist
1. View wishlist page
2. Click heart-broken button on game card
3. Confirm removal
4. **Expected:**
   - Game removed from grid
   - Count decrements
   - Success message

**Result:** ✅ / ❌

---

### Test 2.4: Wishlist Status Check
**Scenario:** Verify button updates based on wishlist status
1. Add game to wishlist
2. Refresh page
3. Button should show "Hapus dari Wishlist"
4. Remove from wishlist
5. Refresh page
6. Button should show "Tambah ke Wishlist"
7. **Expected:** Status persists across page reloads

**Result:** ✅ / ❌

---

### Test 2.5: Empty Wishlist Message
**Scenario:** User with no wishlist items
1. Ensure wishlist is empty
2. Go to `/wishlist`
3. **Expected:** 
   - Large inbox icon displayed
   - Message: "Wishlist Kosong"
   - Link to "Jelajahi game sekarang"

**Result:** ✅ / ❌

---

### Test 2.6: Wishlist Pagination
**Scenario:** Test pagination with 13+ games
1. Add 13+ games to wishlist
2. Go to `/wishlist`
3. **Expected:**
   - Shows 12 games per page
   - Pagination controls shown
   - Can navigate between pages

**Result:** ✅ / ❌

---

### Test 2.7: Quick Actions
**Scenario:** Test action buttons
1. Go to wishlist
2. Click "Lihat Detail" → should go to game page
3. Click "Top Up" → should go to checkout page
4. **Expected:** Navigation works correctly

**Result:** ✅ / ❌

---

### Test 2.8: Wishlist Count Display
**Scenario:** Verify count updates
1. Start with empty wishlist
2. Add 3 games
3. Check navbar or header count
4. **Expected:** Count shows "3"

**Result:** ✅ / ❌

---

## 📥 TEST FEATURE #3: EXPORT

### Test 3.1: Export Form Display
**Scenario:** User views export page
1. Click "Export" in navbar
2. **Expected:** 4 sections displayed:
   - Transaksi (PDF/CSV with filters)
   - Review (PDF only)
   - Wishlist (PDF only)
   - Statistics (display live stats)

**Result:** ✅ / ❌

---

### Test 3.2: Export Transactions as PDF
**Scenario:** Export all transactions as PDF
1. Go to `/export`
2. Leave all filters empty
3. Click "Download PDF"
4. **Expected:**
   - PDF downloads with filename: transaksi-YYYY-MM-DD-HH-MM-SS.pdf
   - PDF contains:
     - Header with title & count
     - Table with columns: No., Game, Jumlah, Status, Tanggal
     - Total row at bottom
     - Footer with copyright

**Result:** ✅ / ❌

---

### Test 3.3: Export Transactions as CSV
**Scenario:** Export transactions as CSV
1. Go to `/export`
2. Click "Download CSV"
3. **Expected:**
   - CSV downloads with filename: transaksi-YYYY-MM-DD-HH-MM-SS.csv
   - Can open in Excel/Google Sheets
   - Contains: ID, Game, Jumlah, Status, Tanggal
   - Proper formatting with headers

**Result:** ✅ / ❌

---

### Test 3.4: Filter by Date Range
**Scenario:** Export with date filters
1. Go to `/export`
2. Set Start Date: 2024-01-01
3. Set End Date: 2024-12-31
4. Click "Download PDF"
5. **Expected:**
   - Only transactions within date range included
   - Total calculated correctly
   - Count matches filtered transactions

**Result:** ✅ / ❌

---

### Test 3.5: Filter by Status
**Scenario:** Export only successful transactions
1. Go to `/export`
2. Select Status: "Berhasil"
3. Click "Download PDF"
4. **Expected:**
   - Only completed transactions shown
   - Count shows only successful ones
   - Total matches completed transactions only

**Result:** ✅ / ❌

---

### Test 3.6: Export Reviews
**Scenario:** Export all reviews as PDF
1. Go to `/export`
2. Click "Export PDF" in Review section
3. **Expected:**
   - PDF downloads: reviews-YYYY-MM-DD-HH-MM-SS.pdf
   - Contains:
     - Game name for each review
     - Star rating display (★/☆)
     - Review text in quotes
     - Helpful count
     - Posted date

**Result:** ✅ / ❌

---

### Test 3.7: Export Wishlist
**Scenario:** Export wishlist as PDF
1. Go to `/export`
2. Add games to wishlist first
3. Click "Export PDF" in Wishlist section
4. **Expected:**
   - PDF downloads: wishlist-YYYY-MM-DD-HH-MM-SS.pdf
   - Contains table with:
     - Game name, Category, Developer, Price, Added Date
     - All wishlist games listed

**Result:** ✅ / ❌

---

### Test 3.8: Statistics Display
**Scenario:** Check statistics section
1. Go to `/export`
2. Look at Statistics card
3. **Expected:** Shows:
   - Total Pengeluaran (total spent)
   - Total Transaksi (transaction count)
   - Transaksi Berhasil (completed count)
   - Rata-rata Transaksi (average per transaction)

**Result:** ✅ / ❌

---

### Test 3.9: Export with No Data
**Scenario:** User with no transactions
1. Create new test user
2. Go to `/export`
3. Try to download PDF
4. **Expected:**
   - PDF still generates
   - Shows "Tidak ada data transaksi" message
   - No errors thrown

**Result:** ✅ / ❌

---

### Test 3.10: PDF Styling
**Scenario:** Check PDF appearance
1. Export transaction as PDF
2. Open in PDF viewer
3. **Expected:**
   - Professional styling
   - Dark theme colors
   - Table properly formatted
   - Status badges with colors
   - Clean, readable layout

**Result:** ✅ / ❌

---

## 🔗 INTEGRATION TESTS

### Test 4.1: Navbar Links Visibility
**Scenario:** Check navbar shows correct links
1. **Not Logged In:** 
   - Should NOT see Wishlist or Export links
   - Only see Top Up, Bantuan, Login, Daftar
2. **Logged In:**
   - Should see Wishlist link with heart icon
   - Should see Export link with download icon
   - Should see Top Up, Bantuan, Riwayat

**Result:** ✅ / ❌

---

### Test 4.2: Game Detail Page Integration
**Scenario:** Check all features on game page
1. Go to game detail
2. **Expected:**
   - "Lihat Review (count)" button visible
   - "Tambah ke Wishlist" button visible
   - Buttons properly styled
   - Hover effects work

**Result:** ✅ / ❌

---

### Test 4.3: Database Integrity
**Scenario:** Verify data stored correctly
1. Create review, add to wishlist, export
2. Check database directly:
   ```bash
   php artisan tinker
   >>> \App\Models\GameReview::first()
   >>> \App\Models\Wishlist::first()
   ```
3. **Expected:** All data properly stored with relationships

**Result:** ✅ / ❌

---

### Test 4.4: Authentication Protection
**Scenario:** Verify auth-only endpoints protected
1. Logout
2. Try to access:
   - `/wishlist` → redirect to login
   - `/export` → redirect to login
   - `/reviews/create/1` → redirect to login
3. **Expected:** All redirect to login page

**Result:** ✅ / ❌

---

### Test 4.5: Model Relationships
**Scenario:** Test model relationships work
```bash
php artisan tinker
>>> $user = \App\Models\User::first()
>>> $user->reviews()->count()          # Should return number
>>> $user->wishlists()->count()        # Should return number
>>> $user->wishlists()->first()->gamePackage->name  # Should show game name
```
**Expected:** All relationships work and return correct data

**Result:** ✅ / ❌

---

## 🐛 EDGE CASES & ERROR HANDLING

### Test 5.1: Invalid Game ID
**Scenario:** Try to view reviews for non-existent game
1. Go to `/reviews/game/99999`
2. **Expected:** 404 error or empty state message

**Result:** ✅ / ❌

---

### Test 5.2: CSRF Token Missing
**Scenario:** Submit form without CSRF token
1. Dev tools → remove csrf-token from form
2. Submit
3. **Expected:** 419 error (Token Mismatch)

**Result:** ✅ / ❌

---

### Test 5.3: Duplicate Wishlist Entry
**Scenario:** Try to add same game twice
1. Add game to wishlist
2. Click "Add to Wishlist" again
3. **Expected:** Error message "Game sudah ada di wishlist"

**Result:** ✅ / ❌

---

### Test 5.4: Concurrency - Multiple Users
**Scenario:** Test concurrent review/wishlist operations
1. Open game in 2 browser tabs
2. Add to wishlist in both tabs simultaneously
3. **Expected:** Both succeed or show conflict message appropriately

**Result:** ✅ / ❌

---

## 📊 PERFORMANCE TESTS

### Test 6.1: Page Load Time
**Scenario:** Measure page load times
1. Open Chrome DevTools
2. Measure:
   - `/reviews/game/1` → Should load < 2s
   - `/wishlist` → Should load < 2s
   - `/export` → Should load < 1s
3. **Expected:** Fast load times

**Result:** ✅ / ❌

---

### Test 6.2: Database Queries
**Scenario:** Check query count
```bash
php artisan tinker
>>> \Illuminate\Support\Facades\DB::enableQueryLog()
>>> // Load reviews page
>>> dd(\Illuminate\Support\Facades\DB::getQueryLog())
```
**Expected:** < 10 queries (check for N+1 problems)

**Result:** ✅ / ❌

---

## 📋 TEST SUMMARY

Create this checklist for final testing:

```
REVIEWS & RATINGS: ___/10 tests passed
- [ ] View reviews
- [ ] Create review
- [ ] Star widget
- [ ] Edit review
- [ ] Delete review
- [ ] Helpful counter
- [ ] Validation
- [ ] Distribution
- [ ] Average rating
- [ ] Permissions

WISHLIST: ___/8 tests passed
- [ ] Add to wishlist
- [ ] View wishlist
- [ ] Remove from wishlist
- [ ] Status check
- [ ] Empty state
- [ ] Pagination
- [ ] Quick actions
- [ ] Count display

EXPORT: ___/10 tests passed
- [ ] Export form
- [ ] PDF export
- [ ] CSV export
- [ ] Date filter
- [ ] Status filter
- [ ] Reviews export
- [ ] Wishlist export
- [ ] Stats display
- [ ] No data handling
- [ ] Styling

INTEGRATION: ___/5 tests passed
- [ ] Navbar links
- [ ] Game page integration
- [ ] Database integrity
- [ ] Auth protection
- [ ] Model relationships

EDGE CASES: ___/4 tests passed
- [ ] Invalid game ID
- [ ] CSRF protection
- [ ] Duplicate entry
- [ ] Concurrency

PERFORMANCE: ___/2 tests passed
- [ ] Page load time
- [ ] Query optimization
```

---

## ✅ Final Sign-Off

**Tested By:** _________________
**Date:** _________________
**Overall Status:** ✅ PASS / ❌ FAIL

**Notes:**
_________________________________
_________________________________

**Ready for Production:** YES / NO

---

**Next Phase:** Dark Mode Toggle, 2FA, Gamification
