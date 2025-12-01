# Kelompok 2 - Platform Top Up Game Online

Platform web modern untuk top-up game online dengan desain professional gaming aesthetic.

## ✨ Fitur

- **Desain Gaming Modern**: UI dengan neon colors (#00f5ff, #39ff14, #ff006e)
- **Autentikasi Lengkap**: Login, Register, Password Reset, Email Verification
- **Game Top-Up System**: Katalog game, paket, checkout, dan riwayat transaksi
- **Responsive Design**: Mobile-first dengan Bootstrap 5
- **Multilingual Support**: 100% Interface dalam Bahasa Indonesia
- **Database Integration**: MySQL dengan Eloquent ORM
- **Professional Styling**: Glass morphism, animations, gradients

## 🛠️ Tech Stack

- **Backend**: Laravel 10.49.1 (PHP 8.1.10)
- **Frontend**: Bootstrap 5.3.0, Poppins Font, Font Awesome 6.4.0
- **Database**: MySQL via LARAGON
- **Build**: Vite, NPM

## 📖 Documentation

Pilih dokumentasi sesuai kebutuhan:

| Dokumen | Deskripsi |
|---------|-----------|
| **[QUICK_REFERENCE.md](QUICK_REFERENCE.md)** | 📋 Ringkas - Credentials, setup 5 menit, feature checklist |
| **[DEMO_GUIDE.md](DEMO_GUIDE.md)** | 🎮 Lengkap - Testing guide untuk semua 10 fitur |
| **[SETUP.md](SETUP.md)** | 🔧 Detail - Installation, troubleshooting, architecture |
| **[FEATURES_COMPLETED.md](FEATURES_COMPLETED.md)** | ✅ Feature list - Semua yang sudah diimplementasikan |
| **[COMPLETION.md](COMPLETION.md)** | 📊 Checklist - Project completion status |

---

## 🚀 Instalasi & Setup (5 Menit)

### Quick Start
```bash
git clone https://github.com/rezakhaidyr04/ProjectWP2.git
cd ProjectWP2
composer install && npm install
cp .env.example .env && php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
```

Server berjalan di: **http://127.0.0.1:8000**

### Login Credentials
```
👤 User: test@example.com / password
👨‍💼 Admin: admin@example.com / password
```

---

## 🎮 Fitur Utama (10 Features)

1. ✅ **Authentication** - Login, register, password reset
2. ✅ **Game Top-Up** - Katalog game dengan search & filter
3. ✅ **Game ID Validation** - Per game type validation
4. ✅ **Checkout** - Form dengan payment method selection
5. ✅ **Transaction Receipt** - Transaction code & history
6. ✅ **User Profile** - Edit info, change password, wallet
7. ✅ **Admin Dashboard** - Statistics & management
8. ✅ **Promo Codes** - Create, edit, delete, validate
9. ✅ **Email Notifications** - TransactionCreated & PaymentConfirmed
10. ✅ **Security** - Rate limiting, CSRF, input validation

Untuk detail testing, lihat **[DEMO_GUIDE.md](DEMO_GUIDE.md)**

### 5. Migration & Seeding
```bash
php artisan migrate:fresh --seed
```

### 6. Start Server
```bash
php artisan serve --host=127.0.0.1 --port=8000
```

Server akan berjalan di: **http://127.0.0.1:8000**

## 📝 Default Credentials

**User Uji Coba:**
- Email: `test@example.com`
- Password: `password`

## 📂 Struktur Project

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Auth/              (8 Authentication Controllers)
│   │   └── GameTopUpController.php
│   └── Middleware/
├── Models/
│   ├── User.php
│   ├── GamePackage.php
│   └── GameTransaction.php
│
database/
├── migrations/
│   ├── create_users_table
│   ├── create_game_packages_table
│   └── create_game_transactions_table
└── seeders/
    ├── DatabaseSeeder.php
    └── GamePackageSeeder.php (12 game packages)

resources/views/
├── layouts/
│   └── app.blade.php          (Master layout - 726 lines)
├── auth/                       (6 authentication views)
│   ├── login.blade.php
│   ├── register.blade.php
│   ├── forgot-password.blade.php
│   ├── reset-password.blade.php
│   ├── verify-email.blade.php
│   └── confirm-password.blade.php
├── topup/                      (5 game top-up views)
│   ├── index.blade.php
│   ├── game.blade.php
│   ├── checkout.blade.php
│   ├── receipt.blade.php
│   └── my-transactions.blade.php
└── welcome.blade.php

routes/
├── web.php                     (Game top-up routes)
└── auth.php                    (Authentication routes)
```

## 🎮 Workflow

### 1. **Homepage** (`/`)
   - Hero section dengan featured games
   - Game cards (Mobile Legends, Free Fire, PUBG, Valorant)
   - Guest users melihat disabled cards

### 2. **Authentication**
   - Login: `/login` (dengan test user credentials)
   - Register: `/register` (form validasi lengkap)
   - Password Reset: `/forgot-password`

### 3. **Game Top-Up**
   - List Games: `/topup` (GET)
   - Game Packages: `/topup/{gameName}` (GET)
   - Checkout: `/topup/{packageId}/checkout` (GET/POST)
   - Receipt: `/topup/{transactionId}/receipt` (GET)
   - History: `/my-topups` (GET)

## 🎨 Color Palette

```
Primary Dark:      #121212, #1e1e1e
Neon Cyan:         #00f5ff (Primary accent)
Neon Lime:         #39ff14 (Secondary accent)
Neon Pink:         #ff006e (Tertiary accent)
Text White:        #ffffff
Text Secondary:    #a0a0c0
Status Success:    #00ff88
Status Warning:    #ffaa00
Status Danger:     #ff3b30
```

## 🗄️ Database Schema

### users
- id, name, email, password, email_verified_at, created_at, updated_at

### game_packages
- id, game_name, package_name, amount, price, description, image, is_active, created_at, updated_at

### game_transactions
- id, user_id (FK), game_package_id (FK), game_account, total_price, payment_method, status, transaction_code, notes, created_at, updated_at

## ✅ Validation Rules

### Game Top-Up Process
- **game_account**: required, string, max:100
- **payment_method**: required, in:bank_transfer,e_wallet,gopay,ovo,dana

### Register
- **name**: required, string, max:255
- **email**: required, email, unique:users
- **password**: required, string, min:8, confirmed

## 📦 Seeded Data

### Game Packages (8 paket)
- **Mobile Legends**: 17, 34, 56 diamonds
- **Free Fire**: 10, 50 diamonds
- **PUBG Mobile**: 60, 300 UC
- **Valorant**: 500 points

### Payment Methods
- Transfer Bank
- E-Wallet
- GoPay
- OVO
- DANA

## 🚨 Troubleshooting

### Database Connection Error
```bash
# Cek konfigurasi .env
php artisan config:cache
php artisan migrate:fresh --seed
```

### Page Styling Issues
```bash
# Rebuild assets
npm install
npm run dev
```

### Route Not Found
```bash
# Clear route cache
php artisan route:clear
php artisan route:list
```

## 📖 API Endpoints

### Authentication (routes/auth.php)
- `POST /register` - Register user baru
- `POST /login` - Login user
- `POST /logout` - Logout user
- `POST /forgot-password` - Request password reset
- `POST /reset-password` - Reset password
- `GET /verify-email` - Email verification prompt
- `GET /verify-email/{id}/{hash}` - Verify email link

### Game Top-Up (routes/web.php)
- `GET /topup` - List semua games
- `GET /topup/{gameName}` - List paket game
- `GET /topup/{packageId}/checkout` - Checkout form
- `POST /topup/{packageId}/process` - Process transaction
- `GET /topup/{transactionId}/receipt` - Transaction receipt
- `GET /my-topups` - User transaction history

## 📋 Checklist Fitur

- ✅ Design system dengan neon colors
- ✅ Responsive layout Bootstrap 5
- ✅ Authentication system lengkap (8 controllers)
- ✅ Game top-up workflow (6 methods, 5 views)
- ✅ Database schema & seeders
- ✅ Form validation dengan error handling
- ✅ Glass morphism & animations
- ✅ Indonesian language localization
- ✅ Pagination dengan custom styling
- ✅ Transaction code generation
- ✅ Payment method selection
- ✅ User transaction history

## 📞 Support

Untuk bantuan atau pertanyaan:
- Email: support@gamecredit.com
- Phone: +62 812 3456 7890

## 📄 License

Laravel framework bersifat open-source software di bawah [MIT license](https://opensource.org/licenses/MIT).**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
