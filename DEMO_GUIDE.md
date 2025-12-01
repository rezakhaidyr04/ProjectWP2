# 🎮 GameCredit - Demo & Feature Testing Guide

Panduan lengkap untuk mencoba semua fitur aplikasi GameCredit secara langsung.

---

## 🚀 Quick Start (5 Menit)

### Setup Project
```bash
git clone https://github.com/rezakhaidyr04/ProjectWP2.git
cd ProjectWP2
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
```

**Akses di browser**: http://127.0.0.1:8000

---

## 👤 Test Credentials

### User Account
```
Email: test@example.com
Password: password
```

### Admin Account
```
Email: admin@example.com
Password: password
```

---

## 📋 Fitur-Fitur yang Bisa Dicoba

### 1️⃣ **Authentication (Login & Register)**
**Lokasi**: `/login`, `/register`

**Yang bisa dilakukan**:
- ✅ Login dengan test@example.com / password
- ✅ Register akun baru
- ✅ Reset password via email
- ✅ Verify email

**Expected Result**: Berhasil login dan redirect ke homepage

---

### 2️⃣ **Homepage dengan Game Cards**
**Lokasi**: `/` (home page)

**Yang bisa dilakukan**:
- ✅ Lihat 4 game populer (Mobile Legends, Free Fire, PUBG, Valorant)
- ✅ Lihat featured games dengan icon animasi
- ✅ Info promo dan keamanan pembayaran
- ✅ Click "Lihat Paket" untuk masuk ke game

**Expected Result**: 
- Desain modern dengan neon colors
- Glass morphism effects
- Responsive di mobile

---

### 3️⃣ **Game Selection & Packages**
**Lokasi**: `/topup`

**Yang bisa dilakukan**:
- ✅ Lihat daftar 4 game
- ✅ Klik salah satu game untuk melihat paket
- ✅ **Search** game by name (coba: "mobile" atau "free")
- ✅ **Filter** paket by price range (min_price, max_price)
- ✅ **Sort** by price (ascending/descending)

**Test Cases**:
```
1. Search "Mobile Legends" → Hanya ML paket yang muncul
2. Filter min: 10000, max: 50000 → Hanya paket dalam range
3. Sort by Price (ASC) → Urut dari harga terendah
```

**Expected Result**: Filter dan search bekerja real-time

---

### 4️⃣ **Checkout & Validation**
**Lokasi**: `/topup/{gameName}` → Select Package → Checkout

**Yang bisa dilakukan**:
- ✅ Pilih game package (contoh: "Mobile Legends - 56 Diamonds")
- ✅ Input Game Account ID (validasi per game):
  - Mobile Legends: 8-10 angka (coba: `12345678`)
  - Free Fire: 10-12 angka (coba: `1234567890`)
  - PUBG Mobile: 10 angka (coba: `1234567890`)
  - Valorant: 3-16 karakter alphanumeric (coba: `Player_Name`)
- ✅ Pilih payment method (Bank Transfer, E-Wallet, GoPay, OVO, DANA)
- ✅ **Promo Code** - Input kode promo jika ada

**Test Invalid Input**:
```
Mobile Legends ID: "123" → Error: "ID harus 8-10 angka"
Mobile Legends ID: "12345" → Error: "ID harus 8-10 angka"
Free Fire ID: "123" → Error: "ID harus 10-12 angka"
```

**Expected Result**: 
- Validasi real-time per game type
- Error message jelas dalam Bahasa Indonesia
- Promo code discount applied

---

### 5️⃣ **Payment & Transaction Receipt**
**Lokasi**: After Checkout → Payment Process

**Yang bisa dilakukan**:
- ✅ Submit checkout form
- ✅ Lihat Transaction Receipt dengan:
  - Transaction code (format: TRX-XXXXX)
  - Game info
  - Jumlah & harga
  - Payment method
  - Status (Pending/Completed)
- ✅ Copy transaction code
- ✅ Lihat email notification (TransactionCreated)

**Expected Result**:
- Receipt muncul dengan all details
- Transaction code unique
- Email terkirim (cek di mailhog/test inbox)

---

### 6️⃣ **User Profile & Wallet**
**Lokasi**: Click Username (top right) → Profile

**Yang bisa dilakukan**:
- ✅ **View Profile**
  - Lihat info personal
  - Total transactions & spending
  - Recent transactions history
- ✅ **Edit Profile**
  - Change name, email, phone, address
  - Validation works (email must unique)
- ✅ **Change Password**
  - Input current password + new password
  - Validation: current_password must correct
- ✅ **Wallet/Spending History**
  - Lihat all completed transactions
  - Filter & pagination
  - Total spending summary

**Test Cases**:
```
1. Edit email ke existing email → Error: "Email sudah terdaftar"
2. Change password dengan wrong current → Error: "Password saat ini tidak sesuai"
3. View wallet → Hanya completed transactions yang muncul
```

**Expected Result**: All user data editable, password change secure

---

### 7️⃣ **Admin Dashboard** (Admin-only feature)
**Lokasi**: Login dengan admin@example.com → Click menu admin atau `/admin/dashboard`

**Yang bisa dilakukan**:

#### A. Dashboard (Statistics)
- ✅ Lihat 7 metrics card:
  - Total Users
  - Total Transactions
  - Completed Transactions
  - Total Revenue (Rp)
  - Pending Transactions
  - Recent 10 transactions
  - Top 5 games
  - Status distribution (pie chart optional)

**Expected Result**: Real-time statistics update

#### B. Manage Transactions (`/admin/transactions`)
- ✅ Lihat semua transactions dalam table
- ✅ Pagination (20 per page)
- ✅ Click transaction → Detail view
- ✅ Update transaction status (pending → completed/failed)
- ✅ Lihat user info & game details

**Test Cases**:
```
1. Create new transaction as user
2. Go to admin transactions
3. Find the transaction
4. Click to view detail
5. Change status from "pending" to "completed"
6. Back to list → Status updated
```

#### C. Manage Users (`/admin/users`)
- ✅ Lihat semua users
- ✅ Info user dan transaction count
- ✅ Pagination

#### D. Manage Game Packages (`/admin/game-packages`)
- ✅ Lihat semua packages
- ✅ Toggle active/inactive status
- ✅ Lihat transaction count per package

#### E. Promo Codes (`/admin/promo-codes`)
- ✅ **View** - Lihat semua kode promo
- ✅ **Create** - Buat kode promo baru dengan:
  - Code (unique)
  - Type (percentage / fixed amount)
  - Discount value
  - Max usage
  - Expiry date
- ✅ **Edit** - Ubah existing promo
- ✅ **Delete** - Hapus promo code
- ✅ **Validate** - Test promo di checkout (API endpoint)

**Test Promo Code**:
```
1. Create promo: "WELCOME" - 20% discount, max 5x usage
2. Go to checkout as user
3. Input "WELCOME" at promo field
4. See discount calculated
5. Back to admin → Usage count increased
```

**Expected Result**: Promo system fully functional

---

### 8️⃣ **Error Pages (Custom Design)**
**Lokasi**: Try invalid routes

**Yang bisa dilakukan**:
- ✅ Access invalid URL → `/invalid-page` → Lihat custom 404 page
- ✅ Try delete someone else's transaction → Lihat custom 500 page

**Expected Result**: Professional error pages dengan gaming aesthetic

---

### 9️⃣ **Rate Limiting (Security)**
**Lokasi**: During checkout

**Yang bisa dilakukan**:
- ✅ Repeatedly submit checkout form 10x in 1 minute
- ✅ 11th attempt → Get throttled (429 Too Many Requests)

**Expected Result**: Request denied with rate limit message

---

### 🔟 **Email Notifications**
**Lokasi**: After creating transaction & payment confirmation

**Yang bisa dilakukan**:
- ✅ Create transaction → Receive `TransactionCreated` email
- ✅ Admin update status to completed → Receive `PaymentConfirmed` email

**Email Content Checklist**:
- ✅ Order details (code, game, amount)
- ✅ Payment instruction
- ✅ Support contact
- ✅ Professional design

**Expected Result**: Emails terkirim ke user inbox

---

## 🔧 Advanced Testing

### Database Seeding (Pre-loaded Data)
```bash
php artisan db:seed

# Akan create:
# - 2 test users (test@example.com, admin@example.com)
# - 8 game packages dengan harga bervariasi
# - Sample transactions (untuk admin dashboard testing)
```

### View Raw Database
```bash
# Via MySQL CLI
mysql -u root projectwp2

# View tables:
SHOW TABLES;
DESCRIBE users;
DESCRIBE game_packages;
DESCRIBE game_transactions;
DESCRIBE promo_codes;
```

### Test API Endpoints (Using Postman/Curl)
```bash
# Promo code validation
POST /api/promo-code/validate
Headers: Authorization: Bearer {token}
Body: {
  "code": "WELCOME",
  "total_price": 50000
}

# Response:
{
  "valid": true,
  "discount_amount": 10000,
  "final_price": 40000,
  "message": "Kode promo berhasil diterapkan!"
}
```

---

## 📸 Screenshots / Visual Expectations

### Homepage
- Hero section dengan neon colors
- 4 game cards dengan icons
- Features showcase (24/7 Support, Secure Payment, etc)
- Responsive navbar with login button

### Game List
- Grid layout dengan game cards
- Hover effects (scale, shadow)
- Search bar at top
- Filter controls

### Checkout Form
- Game image & details
- Account ID input field
- Payment method selector (5 options)
- Promo code input
- Submit button with loading state

### Receipt
- Transaction code displayed prominent
- QR code or copy button
- Game details summary
- Status badge (pending/completed)
- Print option (optional)

### Admin Dashboard
- Statistics cards grid
- Charts/graphs
- Recent transactions table
- Quick action buttons

---

## ⚠️ Common Issues During Testing

### Issue: Database not found
```bash
# Solution:
php artisan migrate:fresh --seed
```

### Issue: Can't login
```bash
# Solution:
# Make sure email is: test@example.com (exact)
# Password: password (exact)
# Or register new account
```

### Issue: No styles showing (blank page)
```bash
# Solution:
npm run dev
php artisan cache:clear
php artisan view:clear
# Then hard refresh: Ctrl+Shift+R
```

### Issue: Email not sending
```bash
# Solution:
# Check MAIL_* settings in .env
# For testing, use: MAIL_MAILER=log
# Emails will appear in laravel.log instead
```

---

## ✅ Feature Checklist for Demo

- [ ] Login/Register working
- [ ] Homepage displaying 4 games
- [ ] Search & filter working
- [ ] Game ID validation per type
- [ ] Checkout form submittable
- [ ] Transaction receipt showing
- [ ] User profile editable
- [ ] Password change working
- [ ] Wallet/history displaying
- [ ] Admin dashboard loading
- [ ] Promo codes creatable & usable
- [ ] Transactions manageable in admin
- [ ] Email notifications sent
- [ ] Custom error pages showing
- [ ] Rate limiting working

---

## 🎯 Next Steps After Testing

1. **Feedback**: Report any bugs or improvements
2. **Deployment**: Deploy ke hosting (Heroku, Vercel, etc)
3. **Production**: Setup Midtrans real keys
4. **Marketing**: Create demo video
5. **Scaling**: Add more games, payment methods

---

## 📞 Support

- **GitHub**: https://github.com/rezakhaidyr04/ProjectWP2
- **Issue Tracker**: Report bugs in GitHub Issues
- **Documentation**: See README.md, SETUP.md, FEATURES_COMPLETED.md

**Happy Testing! 🚀**
