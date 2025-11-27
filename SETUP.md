# 🎮 GameCredit Setup & Maintenance Guide

Dokumentasi lengkap untuk setup, maintenance, dan troubleshooting aplikasi GameCredit.

## 📋 Pre-Installation Checklist

Sebelum memulai, pastikan Anda memiliki:

- [x] PHP 8.1+ dengan extensions: mbstring, PDO, OpenSSL, Tokenizer
- [x] MySQL Server (LARAGON recommended)
- [x] Composer (PHP Dependency Manager)
- [x] Node.js & NPM (untuk assets)
- [x] Git (untuk version control)
- [x] Code Editor (VS Code recommended)

## 🚀 Quick Start (5 Menit)

```bash
# 1. Clone & Navigate
git clone <repo-url>
cd ProjectWP2

# 2. Install Dependencies
composer install
npm install

# 3. Setup Environment
cp .env.example .env
php artisan key:generate

# 4. Setup Database
# Edit .env dengan konfigurasi database Anda
php artisan migrate:fresh --seed

# 5. Start Development Server
php artisan serve --host=127.0.0.1 --port=8000
```

Aplikasi berjalan di: **http://127.0.0.1:8000**

## 📖 Detailed Installation

### 1. Clone Repository
```bash
git clone https://github.com/rezakhaidyr04/ProjectWP2.git
cd ProjectWP2
```

### 2. Install PHP Dependencies
```bash
composer install
```

Pastikan tidak ada error. Jika ada issues dengan package, coba:
```bash
composer update
composer dump-autoload
```

### 3. Install Node Dependencies
```bash
npm install
```

### 4. Setup Environment Variables
```bash
# Copy template .env
cp .env.example .env

# Generate application key (untuk encryption)
php artisan key:generate
```

Edit `.env` sesuai konfigurasi lokal:
```env
APP_NAME=GameCredit
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=projectwp2
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Create Database
```bash
# Via MySQL Client
CREATE DATABASE projectwp2;

# Or via phpMyAdmin
```

### 6. Run Migrations & Seeders
```bash
# Fresh setup (drops & rebuilds tables)
php artisan migrate:fresh --seed

# Or step-by-step
php artisan migrate
php artisan db:seed
```

### 7. Build Frontend Assets
```bash
# Development mode
npm run dev

# Or watch for changes
npm run watch
```

### 8. Start Development Server
```bash
php artisan serve --host=127.0.0.1 --port=8000
```

Server akan berjalan di **http://127.0.0.1:8000**

## ✅ Verification Steps

Setelah setup, verify setiap bagian:

### 1. Homepage Access
```
URL: http://127.0.0.1:8000
Expected: Welcome page dengan hero section dan game cards
```

### 2. Login Page
```
URL: http://127.0.0.1:8000/login
Credentials:
  Email: test@example.com
  Password: password
```

### 3. After Login
```
Expected: Navbar shows "Top Up" link dan user menu
```

### 4. Game Top-Up Workflow
```
1. Click "Top Up" in navbar
2. Select a game (e.g., Mobile Legends)
3. Select a package
4. Fill game account & payment method
5. Confirm transaction
6. See receipt with transaction code
```

### 5. Transaction History
```
URL: http://127.0.0.1:8000/my-topups
Expected: Table with all user transactions
```

## 🛠️ Development Commands

### Useful Artisan Commands

```bash
# Database
php artisan migrate              # Run all pending migrations
php artisan migrate:fresh        # Fresh migration (drops all)
php artisan migrate:refresh      # Rollback & re-migrate
php artisan db:seed              # Run all seeders
php artisan migrate:fresh --seed # Fresh + seed in one command

# Routes
php artisan route:list           # List all routes
php artisan route:clear          # Clear route cache

# Cache
php artisan cache:clear          # Clear application cache
php artisan config:cache         # Cache configuration
php artisan config:clear         # Clear config cache
php artisan view:clear           # Clear compiled views

# Generate
php artisan make:controller NameController
php artisan make:model Name
php artisan make:migration create_table_name
php artisan make:seeder NameSeeder

# Optimization
php artisan optimize             # Optimize application
php artisan optimize:clear       # Clear optimized files
```

### NPM Commands

```bash
npm run dev          # Build for development
npm run build        # Build for production
npm run watch        # Watch for changes
npm run prod         # Build production optimized
```

## 📂 Project Structure

### Controllers
```
app/Http/Controllers/
├── Auth/
│   ├── AuthenticatedSessionController.php    (Login)
│   ├── RegisteredUserController.php          (Register)
│   ├── PasswordResetLinkController.php       (Forgot Password)
│   ├── NewPasswordController.php             (Reset Password)
│   ├── EmailVerificationPromptController.php
│   ├── VerifyEmailController.php
│   ├── EmailVerificationNotificationController.php
│   └── ConfirmablePasswordController.php
│
└── GameTopUpController.php                   (Game Top-Up Logic)
    ├── index()           - List games
    ├── showGame()        - Show packages
    ├── checkout()        - Checkout form
    ├── process()         - Process transaction
    ├── receipt()         - Show receipt
    └── myTransactions()  - User history
```

### Models
```
app/Models/
├── User.php
│   └── gameTransactions() : HasMany
├── GamePackage.php
│   └── gameTransactions() : HasMany
└── GameTransaction.php
    ├── user() : BelongsTo
    └── gamePackage() : BelongsTo
```

### Views
```
resources/views/
├── layouts/app.blade.php         (Master layout - 726 lines)
├── welcome.blade.php             (Homepage)
├── auth/
│   ├── login.blade.php
│   ├── register.blade.php
│   ├── forgot-password.blade.php
│   ├── reset-password.blade.php
│   ├── verify-email.blade.php
│   └── confirm-password.blade.php
└── topup/
    ├── index.blade.php           (Games list)
    ├── game.blade.php            (Packages)
    ├── checkout.blade.php        (Form)
    ├── receipt.blade.php         (Confirmation)
    └── my-transactions.blade.php (History)
```

### Routes
```
routes/
├── web.php           (Game top-up routes - protected by auth)
└── auth.php          (Authentication routes)
```

### Database
```
database/
├── migrations/
│   ├── create_users_table.php
│   ├── create_game_packages_table.php
│   └── create_game_transactions_table.php
└── seeders/
    ├── DatabaseSeeder.php
    └── GamePackageSeeder.php (Seeds 8 game packages)
```

## 🚨 Common Issues & Solutions

### 1. Database Connection Error
```
Error: SQLSTATE[HY000] [2002] Connection refused

Solution:
- Cek MySQL running: systemctl status mysql
- Verify .env DB_HOST, DB_PORT, DB_USERNAME, DB_PASSWORD
- Try: php artisan tinker -> DB::connection()->getPdo()
```

### 2. 404 Routes Not Found
```
Error: The requested resource was not found on this server

Solution:
php artisan route:clear
php artisan config:cache
php artisan serve --host=127.0.0.1 --port=8000
```

### 3. CSRF Token Mismatch
```
Error: TokenMismatchException

Solution:
- Clear cookies in browser
- php artisan cache:clear
- php artisan view:clear
```

### 4. Composer Memory Error
```
Error: "Allowed memory size ... exhausted"

Solution:
# Increase memory limit
php -d memory_limit=-1 /usr/bin/composer install

# Or temporarily
export COMPOSER_MEMORY_LIMIT=-1
composer install
```

### 5. npm audit vulnerabilities
```
Error: npm audit found vulnerabilities

Solution:
npm audit fix
npm audit fix --force (use with caution)
```

### 6. Blank Page / No Styling
```
Error: Page loads but no styles applied

Solution:
npm run dev              # Rebuild assets
php artisan cache:clear
php artisan view:clear
Hard refresh: Ctrl+Shift+R
```

### 7. File Permissions
```
Error: Storage error / Permission denied

Solution:
# Linux/Mac
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Windows (usually not needed with proper setup)
```

## 🔒 Security Checklist

Untuk production deployment:

- [ ] Set `APP_ENV=production` in `.env`
- [ ] Set `APP_DEBUG=false` in `.env`
- [ ] Generate secure `APP_KEY`: `php artisan key:generate`
- [ ] Setup SSL/TLS certificate
- [ ] Hash sensitive data in database
- [ ] Implement rate limiting
- [ ] Setup proper authentication guards
- [ ] Validate all user inputs
- [ ] Use HTTPS for all connections
- [ ] Keep dependencies updated: `composer update`
- [ ] Regular backups of database
- [ ] Monitor error logs: `storage/logs/`
- [ ] Setup proper firewall rules

## 📊 Database Schema

### users Table
```sql
CREATE TABLE users (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  email_verified_at TIMESTAMP NULL,
  created_at TIMESTAMP,
  updated_at TIMESTAMP
);
```

### game_packages Table
```sql
CREATE TABLE game_packages (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  game_name VARCHAR(255) NOT NULL,
  package_name VARCHAR(255) NOT NULL,
  amount INT NOT NULL,
  price DECIMAL(10, 2) NOT NULL,
  description TEXT,
  image VARCHAR(255),
  is_active BOOLEAN DEFAULT true,
  created_at TIMESTAMP,
  updated_at TIMESTAMP
);
```

### game_transactions Table
```sql
CREATE TABLE game_transactions (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  user_id BIGINT NOT NULL (FK to users),
  game_package_id BIGINT NOT NULL (FK to game_packages),
  game_account VARCHAR(255) NOT NULL,
  total_price DECIMAL(10, 2) NOT NULL,
  payment_method VARCHAR(50) NOT NULL,
  status VARCHAR(50) DEFAULT 'pending',
  transaction_code VARCHAR(255) UNIQUE NOT NULL,
  notes TEXT,
  created_at TIMESTAMP,
  updated_at TIMESTAMP
);
```

## 🧪 Testing

### Manual Testing Scenarios

#### Scenario 1: Complete Sign-Up Flow
```
1. Go to /register
2. Fill form: name, email, password, password_confirmation
3. Submit form
4. Check database: user created
5. Try login with new credentials
```

#### Scenario 2: Game Top-Up Purchase
```
1. Login as test@example.com / password
2. Click "Top Up" in navbar
3. Select game (Mobile Legends)
4. Select package (Diamonds 34)
5. Fill game account: "test_acc_123"
6. Select payment method: "bank_transfer"
7. Submit form
8. Verify: redirected to receipt
9. Check database: transaction created with pending status
10. Visit /my-topups and verify transaction appears
```

#### Scenario 3: Form Validation
```
1. Try checkout without filling game account
2. Verify error message appears
3. Try with empty payment method
4. Verify error message appears
5. Try with game account > 100 chars
6. Verify error message appears
```

## 📈 Performance Optimization

### Caching
```bash
php artisan config:cache      # Cache configuration files
php artisan route:cache        # Cache routes
php artisan view:cache         # Compile views
```

### Database
```php
// Use eager loading to avoid N+1 queries
GameTransaction::with('user', 'gamePackage')->get();

// Add indexes to frequently queried columns
// Already in migrations for FK columns
```

### Frontend
```bash
npm run build  # Build minified production assets
```

## 📚 Additional Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Bootstrap Documentation](https://getbootstrap.com/docs)
- [MySQL Reference](https://dev.mysql.com/doc/)
- [Font Awesome Icons](https://fontawesome.com/icons)
- [Blade Template Engine](https://laravel.com/docs/blade)

## 🤝 Support

Untuk questions atau issues:
- Email: support@gamecredit.com
- Issue Tracker: GitHub Issues
- Documentation: README.md

## 📝 Changelog

### v1.0.0 - Initial Release
- ✅ Complete authentication system
- ✅ Game top-up workflow
- ✅ Professional gaming UI
- ✅ Responsive design
- ✅ Indonesian language support
- ✅ Transaction management
- ✅ Database seeders

---

**Last Updated:** November 28, 2025
**Maintained By:** Development Team
**License:** MIT
