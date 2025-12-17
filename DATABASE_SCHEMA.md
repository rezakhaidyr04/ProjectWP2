# 📋 Database Schema - 12 New Features

## **1. game_reviews Table** ⭐
```sql
CREATE TABLE game_reviews (
    id BIGINT PRIMARY KEY,
    user_id BIGINT FK→users,
    game_package_id BIGINT FK→game_packages,
    rating TINYINT (1-5),
    review TEXT,
    helpful_count INT DEFAULT 0,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    INDEX(user_id, game_package_id, rating, created_at)
);
```

**Available Methods**:
- `getAverageRating($gameId)` → float (0-5)
- `getRatingDistribution($gameId)` → array [1→count, 2→count...]
- `scopeLatest()`, `scopeHighestRated()`, `scopeForGame()`

---

## **2. wishlists Table** ❤️
```sql
CREATE TABLE wishlists (
    id BIGINT PRIMARY KEY,
    user_id BIGINT FK→users,
    game_package_id BIGINT FK→game_packages,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    UNIQUE(user_id, game_package_id),
    INDEX(user_id, created_at)
);
```

**Features**:
- Unique constraint prevents duplicate wishlist items
- Fast lookup for user's wishlist
- Soft delete not used (simple removal)

---

## **3. user_badges Table** 🏆
```sql
CREATE TABLE user_badges (
    id BIGINT PRIMARY KEY,
    user_id BIGINT FK→users,
    badge_code VARCHAR (unique),
    badge_name VARCHAR,
    badge_description TEXT,
    badge_icon VARCHAR (emoji/class),
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    UNIQUE(user_id, badge_code),
    INDEX(user_id, badge_code)
);
```

**Predefined Badges**:
```
🎯 early_bird      - First 10 users
💰 power_user      - Total spend > Rp 500k
🎮 collector       - Own 5+ games
⭐ reviewer        - Write 10+ reviews
🤝 referral_master - Refer 5+ users
💎 vip_member      - Total spend > Rp 5M
🔥 streaker        - 7+ consecutive days login
🏅 legend          - Highest total spending
```

---

## **4. loyalty_points Table** 🎁
```sql
CREATE TABLE loyalty_points (
    id BIGINT PRIMARY KEY,
    user_id BIGINT FK→users,
    points INT DEFAULT 0 (current balance),
    earned_points INT DEFAULT 0 (lifetime earned),
    redeemed_points INT DEFAULT 0 (lifetime redeemed),
    reason VARCHAR (purchase, referral, login_bonus, etc),
    transaction_id BIGINT,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    INDEX(user_id, created_at)
);
```

**Points Earning**:
```
+10 pts → Every purchase (Rp 50k+)
+5 pts  → Every review
+20 pts → Successful referral
+2 pts  → Daily login bonus (max 30/month)
+50 pts → Birthday bonus
```

**Points Redemption**:
```
100 pts = Rp 10,000 discount
250 pts = Rp 30,000 discount
500 pts = Rp 70,000 discount
```

---

## **5. two_factor_auths Table** 🔐
```sql
CREATE TABLE two_factor_auths (
    id BIGINT PRIMARY KEY,
    user_id BIGINT FK→users,
    enabled BOOLEAN DEFAULT FALSE,
    method ENUM('email', 'sms'),
    phone_number VARCHAR,
    otp_code VARCHAR,
    otp_expires_at TIMESTAMP,
    attempts INT DEFAULT 0 (failed attempts),
    verified_at TIMESTAMP,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    INDEX(user_id, enabled)
);
```

**OTP Flow**:
```
1. User enables 2FA
2. Generate 6-digit OTP
3. Send via email/SMS
4. Valid for 5 minutes only
5. Max 5 failed attempts (lock for 15 min)
6. Set verified_at on success
```

---

## **6. user_languages Table** 🌐
```sql
CREATE TABLE user_languages (
    id BIGINT PRIMARY KEY,
    user_id BIGINT FK→users UNIQUE,
    language ENUM('id', 'en', 'ar', 'zh') DEFAULT 'id',
    dark_mode BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    INDEX(user_id, language)
);
```

**Supported Languages**:
```
🇮🇩 id (Bahasa Indonesia) - Default
🇺🇸 en (English)
🇸🇦 ar (العربية)
🇨🇳 zh (简体中文)
```

---

## **7. bulk_transactions Table** 📦
```sql
CREATE TABLE bulk_transactions (
    id BIGINT PRIMARY KEY,
    user_id BIGINT FK→users,
    bulk_code VARCHAR UNIQUE (BULK-XXXXXXXXXX),
    total_items INT,
    completed_items INT DEFAULT 0,
    failed_items INT DEFAULT 0,
    total_price DECIMAL(12,2),
    status ENUM('pending', 'processing', 'completed', 'partial_failed'),
    accounts_data JSON [
        {
            "game": "Mobile Legends",
            "account": "123456789",
            "package": "1 Million",
            "status": "completed"
        }
    ],
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    INDEX(user_id, status, created_at)
);
```

**Auto-generated Code**: `BULK-ABCDE12345` (16 char alphanumeric)

---

## **RELATIONSHIPS DIAGRAM**

```
users
├── GameReview (1:N)          ← User writes many reviews
├── Wishlist (1:N)             ← User has many wishlists
├── UserBadge (1:N)            ← User earned many badges
├── LoyaltyPoint (1:N)         ← User has points history
├── TwoFactorAuth (1:1)        ← User has one 2FA config
├── UserLanguage (1:1)         ← User has one language pref
└── BulkTransaction (1:N)      ← User made many bulk purchases

game_packages
├── GameReview (1:N)           ← Game has many reviews
└── Wishlist (1:N)             ← Game on many wishlists
```

---

## **MIGRATION EXECUTION ORDER**

```
1. create_game_reviews_table
2. create_wishlists_table
3. create_user_badges_table
4. create_loyalty_points_table
5. create_two_factor_auths_table
6. create_user_languages_table
7. create_bulk_transactions_table
```

**Run with**:
```bash
php artisan migrate --force
```

---

## **INDICES STRATEGY**

| Table | Indices | Purpose |
|-------|---------|---------|
| game_reviews | (user_id, game_package_id, rating, created_at) | Query reviews by user, game, or sort |
| wishlists | (user_id, created_at) | Show user's wishlist quickly |
| user_badges | (user_id, badge_code) | Check user's badges |
| loyalty_points | (user_id, created_at) | Show points history |
| two_factor_auths | (user_id, enabled) | Find enabled 2FA |
| user_languages | (user_id, language) | Get user's language pref |
| bulk_transactions | (user_id, status, created_at) | Filter & sort bulk ops |

---

## **DATA INTEGRITY**

✅ Foreign keys with cascade delete  
✅ Unique constraints to prevent duplicates  
✅ Proper enum types for status fields  
✅ Timestamp columns for audit trail  
✅ Adequate indexing for query performance  
✅ JSON field for flexible data structure (bulk_transactions)  

---

## **READY FOR SEEDING**

Sample seeder data needed:
```
- 10 sample reviews across different games
- 5 sample badges per test user
- Initial loyalty points allocation
- Test 2FA configurations
- Sample bulk transactions in progress
```

