# 🎮 Kelompo 2 - Quick Reference Card

## 🔗 GitHub Link
```
https://github.com/rezakhaidyr04/ProjectWP2
```

---

## ⚡ 5-Minute Setup
```bash
git clone https://github.com/rezakhaidyr04/ProjectWP2.git
cd ProjectWP2
composer install && npm install
cp .env.example .env && php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
# Open: http://127.0.0.1:8000
```

---

## 👤 Login Credentials

| Role | Email | Password |
|------|-------|----------|
| **User** | test@example.com | password |
| **Admin** | admin@example.com | password |

---

## 🎯 10 Main Features to Try

### 1. **Authentication**
- `/login` - Login dengan email & password
- `/register` - Daftar akun baru
- Password reset & email verification

### 2. **Game Top-Up Listing**
- `/topup` - Lihat 4 game (ML, FF, PUBG, Valorant)
- **Search** - Cari game by name
- **Filter** - Min/max price, sort by price

### 3. **Game ID Validation**
- Mobile Legends: 8-10 digit (contoh: `12345678`)
- Free Fire: 10-12 digit (contoh: `1234567890`)
- PUBG Mobile: 10 digit (contoh: `1234567890`)
- Valorant: 3-16 alphanumeric (contoh: `Player_Name`)

### 4. **Checkout Process**
- Select package → Input account ID → Pick payment method
- Validasi real-time per game type
- Error messages jelas dalam Bahasa Indonesia

### 5. **Transaction Receipt**
- Lihat transaction code (TRX-XXXXX)
- Game details & payment info
- Copy to clipboard feature

### 6. **User Profile**
- `/profile` - Edit nama, email, phone, address
- `/profile/password` - Ubah password (verify current password)
- `/profile/wallet` - Lihat spending history & statistics

### 7. **Admin Dashboard** (Hanya admin@example.com)
- `/admin/dashboard` - 7 metrics + charts
- `/admin/transactions` - Manage all transactions
- `/admin/users` - View user list
- `/admin/game-packages` - Toggle package status

### 8. **Promo Codes** (Admin only)
- Create/Edit/Delete promo codes
- Support: percentage & fixed amount discounts
- Max usage limits & expiry dates
- Test di checkout: Input promo code → See discount applied

### 9. **Email Notifications**
- TransactionCreated - saat order dibuat
- PaymentConfirmed - saat pembayaran berhasil
- (Cek di mailhog atau log)

### 10. **Security Features**
- Rate limiting - Max 10 checkout/minute
- CSRF protection - Semua forms
- Input validation - Per game type
- Authorization - Admin & user roles

---

## 📊 Database Pre-Seeded Data

**Users:**
- test@example.com (user)
- admin@example.com (admin)

**Games & Packages:**
- Mobile Legends: 3 packages (9k, 18k, 29k)
- Free Fire: 2 packages (8k, 39k)
- PUBG Mobile: 2 packages (9k, 45k)
- Valorant: 1 package (50k)

**Test Transactions:**
- Pre-seeded untuk demo (visible di admin dashboard)

---

## 🎨 UI/UX Features

✅ **Dark Gaming Aesthetic**
- Neon cyan, magenta, yellow colors
- Glass morphism effects
- Gradient buttons & animations

✅ **Responsive Design**
- Mobile-first approach
- Works on desktop, tablet, mobile
- Bootstrap 5 grid system

✅ **Indonesian Localization**
- 100% Bahasa Indonesia
- Currency in Rupiah (Rp)
- Timestamp in Indonesian

✅ **Professional Components**
- Custom error pages (404, 500)
- Loading spinners & transitions
- Toast notifications (if added)
- Pagination with styling

---

## 🔐 Security Implemented

| Feature | Detail |
|---------|--------|
| **CSRF Protection** | Token validation on all POST/PUT/DELETE |
| **Password Hashing** | bcrypt with Laravel default |
| **Role-Based Access** | Middleware checking user roles |
| **Input Validation** | Per game type, per form field |
| **Rate Limiting** | 10 requests/minute per user on checkout |
| **Signature Verification** | Webhook validation untuk payment |
| **SQL Injection** | Protected via Eloquent ORM |
| **XSS Protection** | Blade templating auto-escapes |

---

## 📁 Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── GameTopUpController.php
│   │   ├── ProfileController.php
│   │   ├── PaymentController.php
│   │   └── Admin/DashboardController.php
│   ├── Middleware/
│   │   └── ThrottleCheckout.php
│   └── Services/
│       ├── GameIdValidator.php
│       └── PromoCodeService.php
├── Models/
│   ├── User.php
│   ├── GamePackage.php
│   ├── GameTransaction.php
│   ├── PromoCode.php
│   └── PromoCodeUsage.php
└── Mail/
    ├── TransactionCreated.php
    └── PaymentConfirmed.php

resources/views/
├── layouts/app.blade.php (Master layout)
├── topup/
│   ├── index.blade.php (Games list)
│   ├── game.blade.php (Packages)
│   ├── checkout.blade.php (Form)
│   └── receipt.blade.php (Confirmation)
├── profile/
│   ├── show.blade.php
│   ├── edit.blade.php
│   └── wallet.blade.php
├── admin/
│   ├── dashboard.blade.php
│   ├── transactions.blade.php
│   ├── users.blade.php
│   └── promo-codes/

database/
├── migrations/ (5 tables)
└── seeders/ (Test data)

config/
├── midtrans.php (Payment gateway)
└── ...standard Laravel configs
```

---

## 🧪 Test Scenarios

### Scenario 1: Complete Purchase Flow
```
1. Login with test@example.com
2. Click "Topup"
3. Select "Mobile Legends"
4. Pick "Diamonds 56" package
5. Input ID: "12345678"
6. Choose payment method
7. Submit → See receipt
8. Check transaction in profile
```

### Scenario 2: Admin Management
```
1. Login with admin@example.com
2. Go to /admin/dashboard
3. View statistics
4. Go to /admin/transactions
5. Find a transaction & update status
6. Check promo codes
7. Create new promo code
```

### Scenario 3: Validation Testing
```
1. At checkout, try invalid IDs:
   - Mobile Legends: "123" → Error!
   - Free Fire: "1234" → Error!
   - PUBG: "123456789" → Error!
2. Try edit profile with duplicate email → Error!
3. Change password with wrong current → Error!
```

---

## 📚 Additional Docs

In the repository, find:
- **DEMO_GUIDE.md** - Detailed feature testing (10 pages)
- **SETUP.md** - Installation & maintenance
- **README.md** - Overview & tech stack
- **FEATURES_COMPLETED.md** - What's implemented
- **COMPLETION.md** - Checklist of all features

---

## 💡 Key Highlights

🎯 **What Makes This Special:**
- ✨ Professional gaming aesthetic (not generic)
- 🌐 100% Indonesian interface
- 🔒 Enterprise-grade security
- 📱 Fully responsive design
- ⚡ Real-time validation
- 🎁 Promo system included
- 👨‍💼 Complete admin dashboard
- 📧 Email notifications
- 💳 Payment gateway ready (Midtrans)
- 📊 Statistics & reporting

---

## 🚀 Ready to Go!

Everything is setup, tested, and ready for:
- ✅ Demonstrating to clients
- ✅ Learning Laravel best practices
- ✅ Production deployment
- ✅ Team collaboration
- ✅ Scaling with new features

**Clone, setup, and start exploring!** 🎮
