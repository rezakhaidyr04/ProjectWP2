# Penjelasan Code Game View (topup/game.blade.php)

## 📋 Ringkasan
File ini menampilkan daftar paket game yang dapat dibeli dengan fitur filter, wishlist, dan review. Terdapat 3 bagian utama: filter harga, grid paket game, dan modal login.

---

## 🎯 Kode-Kode Penting

### 1. **Header & Judul Game**
```php
<h1 class="display-4 mb-2" style="background: linear-gradient(135deg, #00f5ff, #39ff14); 
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
    {{ $gameName }}
</h1>
```
**Penjelasan:**
- Menampilkan nama game dari variabel `$gameName` yang dikirim dari controller
- Menggunakan CSS gradient (dari cyan ke lime green) untuk efek visual yang menarik
- `background-clip: text` membuat gradient tersebut hanya berlaku pada text

---

### 2. **Filter Paket Berdasarkan Harga**
```php
<form method="GET" class="row g-3">
    <div class="col-md-3">
        <input type="number" name="min_price" class="form-control" 
               placeholder="0" value="{{ request('min_price') }}">
    </div>
    <div class="col-md-3">
        <input type="number" name="max_price" class="form-control" 
               placeholder="0" value="{{ request('max_price') }}">
    </div>
    <div class="col-md-3">
        <select name="sort_by" class="form-select">
            <option value="price_asc" {{ request('sort_by') === 'price_asc' ? 'selected' : '' }}>
                Harga Terendah
            </option>
            <option value="price_desc" {{ request('sort_by') === 'price_desc' ? 'selected' : '' }}>
                Harga Tertinggi
            </option>
        </select>
    </div>
</form>
```
**Penjelasan:**
- Form GET untuk filter/pencarian paket
- `name="min_price"` dan `name="max_price"`: Input filter range harga
- `value="{{ request('min_price') }}"`: Mempertahankan nilai filter yang sudah dipilih setelah submit
- `request('sort_by') === 'price_asc' ? 'selected' : ''`: Menandai opsi dropdown yang dipilih
- Semua data filter dikirim via URL query string untuk bookmark-able filter

---

### 3. **Loop Paket & Card Display**
```php
@forelse($packages as $package)
<div class="col-12 col-md-6 col-lg-4">
    <div class="card h-100" style="...">
        <!-- Gambar Paket -->
        @if($package->image)
            <img src="{{ asset('images/games/' . $package->image) }}" 
                 alt="{{ $package->package_name }}">
        @else
            <div>No Image</div>
        @endif
        
        <!-- Info Paket -->
        <h4>{{ $package->package_name }}</h4>
        <p>{{ $package->description }}</p>
        
        <!-- Harga -->
        <h3>Rp{{ number_format($package->price, 0, ',', '.') }}</h3>
```
**Penjelasan:**
- `@forelse($packages as $package)`: Loop menampilkan semua paket dari array `$packages`
- `@else` jika tidak ada paket: Tampilkan pesan "Tidak ada paket tersedia"
- `asset('images/games/' . $package->image)`: Path gambar dari folder public
- `number_format($package->price, 0, ',', '.')`: Format harga jadi "Rp1.500.000" (bukan 1500000)
- `col-lg-4`: Grid 3 kolom di desktop, 2 kolom di tablet, 1 kolom di mobile

---

### 4. **Review & Wishlist Buttons** ⭐❤️
```php
<a href="{{ route('reviews.index', $package->id) }}" class="btn btn-sm">
    <i class="fas fa-star me-1"></i> Lihat Review ({{ $package->reviews()->count() }})
</a>

@auth
    <button type="button" class="btn btn-sm" onclick="toggleWishlist({{ $package->id }})">
        <i class="fas fa-heart me-1"></i> 
        <span id="wishlist-text-{{ $package->id }}">Tambah ke Wishlist</span>
    </button>
@endauth
```
**Penjelasan:**
- Link review menampilkan jumlah review dengan `$package->reviews()->count()`
- `@auth`: Tombol wishlist hanya tampil jika user sudah login
- `onclick="toggleWishlist({{ $package->id }})"`: Memanggil fungsi JavaScript dengan ID paket
- `<span id="wishlist-text-{{ $package->id }}">`: Element yang text-nya berubah dinamis (Tambah/Hapus)
- Jumlah review akan ter-cache per load, gunakan `->count()` untuk real-time count

---

### 5. **Tombol Beli (Conditional Authentication)**
```php
@auth
    <a href="{{ route('topup.checkout', $package->id) }}" class="btn w-100" 
       style="background: linear-gradient(135deg, #00f5ff, #39ff14);">
        <i class="fas fa-shopping-cart"></i> Beli Sekarang
    </a>
@else
    <button class="btn w-100" data-bs-toggle="modal" data-bs-target="#loginModal">
        <i class="fas fa-sign-in-alt"></i> Login untuk Membeli
    </button>
@endauth
```
**Penjelasan:**
- `@auth`: Jika user login → tampilkan tombol "Beli Sekarang" yang direct ke checkout
- `@else`: Jika belum login → tampilkan tombol "Login untuk Membeli" yang trigger modal
- `data-bs-toggle="modal"`: Bootstrap attribute untuk buka modal dialog
- `route('topup.checkout', $package->id)`: URL checkout dengan ID paket sebagai parameter

---

### 6. **JavaScript - Toggle Wishlist** 🎯
```javascript
function toggleWishlist(gamePackageId) {
    // 1. CHECK STATUS WISHLIST
    fetch(`/wishlist/check/${gamePackageId}`, {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.in_wishlist) {
            // 2. JIKA SUDAH DI WISHLIST → HAPUS
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
            // 3. JIKA BELUM DI WISHLIST → TAMBAH
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
        }
    });
}
```
**Penjelasan Alur:**
1. **Check Status**: `GET /wishlist/check/{id}` → Cek apakah paket sudah di wishlist
2. **Jika Sudah Ada**: `DELETE /wishlist/{id}` → Hapus dari wishlist, ubah text tombol jadi "Tambah"
3. **Jika Belum**: `POST /wishlist/store` → Tambah ke wishlist, ubah text tombol jadi "Hapus"
4. **CSRF Token**: `X-CSRF-TOKEN` diperlukan untuk security (cegah CSRF attack)
5. **Update UI**: `textContent` diubah tanpa reload halaman (AJAX)

---

### 7. **Load Wishlist Status on Page Load** 🔄
```javascript
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
```
**Penjelasan:**
- `DOMContentLoaded`: Event yang trigger setelah HTML selesai loading
- `querySelectorAll('[id^="wishlist-text-"]')`: Cari semua element dengan ID mulai dari "wishlist-text-"
- `element.id.split('-')[2]`: Extract ID paket dari "wishlist-text-5" → "5"
- Loop setiap paket & check status → ubah text tombol jadi "Hapus" jika sudah di wishlist
- Ini membuat state tombol akurat sesuai dengan database

---

### 8. **Login Modal**
```php
<div class="modal fade" id="loginModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login Diperlukan</h5>
            </div>
            <div class="modal-body">
                <p>Silakan login terlebih dahulu untuk melakukan pembelian.</p>
                <p>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <a href="{{ route('login') }}" class="btn">Login Sekarang</a>
            </div>
        </div>
    </div>
</div>
```
**Penjelasan:**
- Modal popup yang tampil ketika user yang belum login klik tombol beli
- `id="loginModal"`: ID yang direfensi di `data-bs-target="#loginModal"`
- Menyediakan 2 link: Login atau Register
- UX yang user-friendly tanpa keluar dari halaman

---

### 9. **CSS Hover Effects** ✨
```css
.card:hover {
    border-color: #00f5ff !important;
    box-shadow: 0 0 30px rgba(0, 245, 255, 0.3) !important;
    transform: translateY(-5px);
}

.card:hover .package-image {
    transform: scale(1.05);
}
```
**Penjelasan:**
- Saat hover card: Border jadi cyan, glow effect, card naik 5px
- Saat hover image: Gambar zoom in 105%
- Memberikan feedback visual yang menarik untuk UX yang lebih interaktif

---

## 🔌 Koneksi ke Backend

### Routes yang Digunakan:
```php
route('topup.index')              // Kembali ke daftar game
route('topup.game', $gameName)    // Reset filter
route('reviews.index', $package->id) // Lihat review
route('topup.checkout', $package->id) // Halaman checkout
route('login')                    // Halaman login
route('register')                 // Halaman register
```

### API Endpoints (JavaScript):
```
GET  /wishlist/check/{id}         // Check apakah di wishlist
POST /wishlist/store              // Tambah ke wishlist
DELETE /wishlist/{id}             // Hapus dari wishlist
```

---

## 📊 Data Flow

```
┌─────────────────────────────────────────────────────┐
│ USER MEMBUKA HALAMAN                                │
└──────────────────┬──────────────────────────────────┘
                   ↓
┌─────────────────────────────────────────────────────┐
│ Page Load:                                          │
│ 1. Tampilkan filter & grid paket                    │
│ 2. Load wishlist status via API untuk setiap paket  │
└──────────────────┬──────────────────────────────────┘
                   ↓
         ┌─────────┴──────────┐
         ↓                    ↓
    USER FILTER          USER KLIK BELI
    (Ganti Query URL)    │
         ↓               ├→ Login? 
    RELOAD PAKET        │  ├─→ Ya: Ke Checkout
    BERDASARKAN          │  └─→ Tidak: Buka Modal Login
    MIN/MAX/SORT        │
                        └→ KLIK WISHLIST
                           │
                           ├→ Check Status
                           │  ├─→ Already in? DELETE
                           │  └─→ Not in? POST
                           │
                           └→ Update Button Text
```

---

## ⚠️ Catatan Penting

### 1. **CSRF Protection**
Semua fetch request harus sertakan CSRF token:
```javascript
headers: {
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
}
```

### 2. **Performance**
- `reviews()->count()` di loop bisa slow jika banyak paket
- Solusi: Gunakan `withCount('reviews')` di controller query

### 3. **Security**
- Tombol beli hanya tampil jika authenticated (`@auth`)
- Modal login memaksa user untuk authentication sebelum akses checkout

### 4. **UX Flow**
- Wishlist bisa di-toggle tanpa login (jika di-enable)
- Checkout wajib login
- Rating/review visible untuk semua user (tidak harus login)

---

## 📌 Kesimpulan

File ini mengintegrasikan 3 fitur utama:
1. **Filter & Sort** → Cari paket berdasarkan harga
2. **Wishlist** → Save favorit dengan toggle AJAX
3. **Review** → Link ke halaman review (yang dibuat sebelumnya)

Semuanya dengan design yang modern (cyberpunk gradient, glow effect) dan UX yang smooth (no page reload, real-time updates).
