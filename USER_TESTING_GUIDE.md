# 📋 User Testing Guide - Kelompok 2 Gaming Platform

**Status:** ✅ 8 Test Users Created Successfully  
**Total Users in DB:** 11 users (3 default + 8 test users)

---

## 🎯 8 Tipe User untuk Testing

### 1. **ADMIN USER** 👨‍💼
**Email:** `admin@example.com`  
**Password:** `password`  
**Role:** `admin`  

**Gunakan untuk:**
- ✅ Testing dashboard admin
- ✅ User management & moderation
- ✅ System configuration
- ✅ Analytics & reporting
- ✅ Access control testing

**Karakteristik:**
- Nama: Admin User
- Phone: 081234567890
- Address: Jl. Admin No. 1, Jakarta
- Full database access

---

### 2. **REGULAR USER** 👤
**Email:** `user@example.com`  
**Password:** `password`  
**Role:** `member`  

**Gunakan untuk:**
- ✅ Standard user flow testing
- ✅ Game purchase & topup
- ✅ Review & rating system
- ✅ Wishlist functionality
- ✅ Profile management
- ✅ Transaction history view

**Karakteristik:**
- Nama: User Biasa
- Phone: 082345678901
- Address: Jl. Mawar No. 10, Bandung
- Moderate transaction history expected

---

### 3. **POWER USER** 💎
**Email:** `poweruser@example.com`  
**Password:** `password`  
**Role:** `member`  

**Gunakan untuk:**
- ✅ High-volume transaction testing
- ✅ Multiple review creation
- ✅ Stress testing payment system
- ✅ Loyalty points accumulation
- ✅ Badge achievement testing
- ✅ Large dataset performance testing

**Karakteristik:**
- Nama: Randi Gunawan
- Phone: 083456789012
- Address: Jl. Bima No. 5, Surabaya
- Simulate heavy spender behavior
- Create 10+ transactions manually

---

### 4. **NEW USER** ✨
**Email:** `newuser@example.com`  
**Password:** `password`  
**Role:** `member`  

**Gunakan untuk:**
- ✅ Onboarding flow testing
- ✅ First purchase scenario
- ✅ Empty state UI testing
- ✅ Default data handling
- ✅ Profile completion workflow

**Karakteristik:**
- Nama: User Baru
- Phone: `null` (not filled)
- Address: `null` (not filled)
- No transaction history
- Test incomplete profile scenarios

---

### 5. **REGULAR CUSTOMER** 👥
**Email:** `regular@example.com`  
**Password:** `password`  
**Role:** `member`  

**Gunakan untuk:**
- ✅ Average user behavior simulation
- ✅ Moderate activity testing
- ✅ Standard feature usage
- ✅ Notification testing
- ✅ Email template testing

**Karakteristik:**
- Nama: Siti Nurhaliza
- Phone: 084567890123
- Address: Jl. Kenari No. 8, Yogyakarta
- Typical user with some history
- 3-5 transactions expected

---

### 6. **INACTIVE USER** 😴
**Email:** `inactive@example.com`  
**Password:** `password`  
**Role:** `member`  

**Gunakan untuk:**
- ✅ Long-term inactive user handling
- ✅ Re-engagement campaign testing
- ✅ Cleanup/archival processes
- ✅ Data retention policies
- ✅ Session timeout testing

**Karakteristik:**
- Nama: User Inactive
- Phone: 085678901234
- Address: Jl. Sepi No. 12, Medan
- No recent activity
- Don't add transactions for this user

---

### 7. **VVIP USER** 👑
**Email:** `vvip@example.com`  
**Password:** `password`  
**Role:** `vvip`  

**Gunakan untuk:**
- ✅ Premium tier features
- ✅ Exclusive content access
- ✅ VIP badge display
- ✅ Priority support testing
- ✅ Special discounts/bonuses
- ✅ Premium loyalty rewards

**Karakteristik:**
- Nama: Budi Santoso
- Phone: 086789012345
- Address: Jl. Mewah No. 1, Jakarta Selatan
- Extensive transaction history
- Create 20+ transactions for this user

---

### 8. **MODERATOR** 🛡️
**Email:** `moderator@example.com`  
**Password:** `password`  
**Role:** `moderator`  

**Gunakan untuk:**
- ✅ Review & comment moderation
- ✅ User report handling
- ✅ Content filtering
- ✅ Moderation dashboard
- ✅ Flag/suspend testing
- ✅ Community management

**Karakteristik:**
- Nama: Moderator Staff
- Phone: 087890123456
- Address: Jl. Kantor No. 99, Jakarta Pusat
- Staff role with special permissions
- Moderation queue access

---

## 📊 Testing Scenarios by User Type

### Scenario 1: First-Time Purchase Flow
**Best User:** NEW USER (newuser@example.com)
- Complete profile
- Add first game to cart
- Proceed to checkout
- Verify transaction creation
- Check transaction receipt

### Scenario 2: Wishlist & Review System
**Best User:** REGULAR USER (user@example.com)
- Add games to wishlist
- Write reviews (1-5 stars)
- Mark reviews as helpful
- Test review display

### Scenario 3: Heavy Load Testing
**Best User:** POWER USER (poweruser@example.com)
- Create 50+ transactions
- Multiple reviews
- Loyalty points growth
- Badge unlocking
- Performance monitoring

### Scenario 4: Multi-Language Testing
**Best User:** ANY USER (recommend REGULAR USER)
- Change language preference
- Verify all UI translations
- Check email templates
- Test date/time formatting

### Scenario 5: Payment Method Testing
**Best Users:** REGULAR + POWER + VVIP
- Credit card payment
- E-wallet payment
- Bank transfer
- Verify different statuses (pending, completed, failed)

### Scenario 6: Notification Testing
**Best User:** REGULAR USER
- Verify email notifications
- In-app notifications
- SMS alerts (if implemented)
- Notification preferences

### Scenario 7: Role-Based Access Testing
**Test with All 4 Role Types:**
- **admin@example.com** - Full access
- **moderator@example.com** - Review/content management
- **user@example.com** - Customer access
- **newuser@example.com** - Limited access (no history)

### Scenario 8: 2FA & Security Testing
**Best User:** VVIP (vvip@example.com)
- Enable 2FA
- Test OTP generation
- Test OTP validation
- Session security

---

## 🔧 Quick Setup Commands

### Create All Users
```bash
php artisan db:seed
```

### Create Specific User with Artisan
```bash
php artisan tinker
> User::create(['email' => 'test@test.com', 'name' => 'Test', 'password' => bcrypt('password'), 'role' => 'member'])
```

### View All Users
```bash
php artisan tinker
> User::all()
```

### List Users by Role
```bash
php artisan tinker
> User::where('role', 'member')->get()
```

### Add Transactions to User
```bash
php artisan tinker
> $user = User::find(3);
> $user->transactions()->create(['game_package_id' => 1, 'total_price' => 50000, 'status' => 'completed'])
```

### Add Reviews to User
```bash
php artisan tinker
> $user = User::find(3);
> $user->reviews()->create(['game_id' => 1, 'rating' => 5, 'comment' => 'Amazing game!'])
```

### Add Wishlist Items
```bash
php artisan tinker
> $user = User::find(3);
> $user->wishlists()->create(['game_package_id' => 2])
```

---

## 🚀 Testing Priority

### Phase 1: Basic Authentication (Use NEW USER)
- [ ] Login with new user
- [ ] Logout
- [ ] Password reset
- [ ] Email verification

### Phase 2: Profile Management (Use REGULAR USER)
- [ ] View profile
- [ ] Edit profile information
- [ ] Change password
- [ ] Upload avatar
- [ ] View transaction history

### Phase 3: Game Features (Use POWER USER)
- [ ] Browse games
- [ ] View game details
- [ ] Read reviews
- [ ] Add to wishlist
- [ ] Purchase game

### Phase 4: Admin Features (Use ADMIN USER)
- [ ] Dashboard overview
- [ ] User management
- [ ] Game management
- [ ] Transaction monitoring
- [ ] Report generation

### Phase 5: Moderation (Use MODERATOR)
- [ ] Review management
- [ ] Report handling
- [ ] Content moderation
- [ ] User restrictions

### Phase 6: Premium Features (Use VVIP USER)
- [ ] Premium benefits display
- [ ] Exclusive access
- [ ] Special pricing
- [ ] VIP support

---

## 📝 Notes

- **Default Password:** `password` for all users
- **Never commit real credentials** to repository
- **Change passwords before production**
- **Use test accounts only for development**
- **Keep test data separate** from production
- **Clear test users** before deploying to live
- All users have complete profile data except NEW USER (phone/address nullable)

---

## ✅ Checklist for Complete Testing

- [ ] Login with each user type
- [ ] Verify role-based access
- [ ] Check permission levels
- [ ] Test profile view/edit
- [ ] Create transactions
- [ ] Write reviews
- [ ] Add to wishlist
- [ ] Test pagination
- [ ] Verify notifications
- [ ] Check email sending
- [ ] Test light/dark mode with each user
- [ ] Verify responsive design
- [ ] Check error handling
- [ ] Test data filtering by user
- [ ] Verify security middleware

---

**Last Updated:** December 6, 2025  
**Created by:** AI Assistant  
**Status:** Production Ready ✅
