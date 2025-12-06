<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Load Auth Routes
require __DIR__.'/auth.php';

// Game Top-Up Routes
use App\Http\Controllers\GameTopUpController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;

// Public routes (guest dapat lihat)
Route::get('/topup', [GameTopUpController::class, 'index'])->name('topup.index');
Route::get('/topup/{gameName}', [GameTopUpController::class, 'showGame'])->name('topup.game');

// Protected routes (harus login untuk checkout)
Route::middleware('auth')->group(function () {
    Route::get('/topup/{packageId}/checkout', [GameTopUpController::class, 'checkout'])->name('topup.checkout');
    Route::post('/topup/{packageId}/process', [GameTopUpController::class, 'process'])->middleware('throttle.checkout')->name('topup.process');
    Route::get('/topup/{transactionId}/receipt', [GameTopUpController::class, 'receipt'])->name('topup.receipt');
    Route::get('/my-topups', [GameTopUpController::class, 'myTransactions'])->name('topup.myTransactions');
    
    // Payment Routes
    Route::get('/payment/{transactionId}/snap', [PaymentController::class, 'generateSnap'])->name('payment.snap');
    Route::get('/payment/{transactionId}/token', [PaymentController::class, 'generateToken'])->name('payment.token');
    Route::get('/payment/{transactionId}/status', [PaymentController::class, 'checkStatus'])->name('payment.status');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/password', [ProfileController::class, 'editPassword'])->name('profile.edit-password');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');
    Route::get('/profile/wallet', [ProfileController::class, 'wallet'])->name('profile.wallet');
});

// Midtrans Webhook (no auth required)
Route::post('/payment/callback', [PaymentController::class, 'handleCallback'])->name('payment.callback');

// Admin Routes
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PromoCodeController;

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/transactions', [DashboardController::class, 'transactions'])->name('admin.transactions');
    Route::get('/transactions/{id}', [DashboardController::class, 'transactionDetail'])->name('admin.transaction-detail');
    Route::put('/transactions/{id}/status', [DashboardController::class, 'updateTransactionStatus'])->name('admin.update-transaction-status');
    Route::get('/users', [DashboardController::class, 'users'])->name('admin.users');
    Route::get('/game-packages', [DashboardController::class, 'gamePackages'])->name('admin.game-packages');
    Route::put('/game-packages/{id}/status', [DashboardController::class, 'updatePackageStatus'])->name('admin.update-package-status');
    
    // Promo Code Routes
    Route::resource('promo-codes', PromoCodeController::class);
});

// Promo code validation API (authenticated)
Route::post('/api/promo-code/validate', [PromoCodeController::class, 'validate'])->middleware('auth')->name('api.promo-code.validate');

// Reviews & Ratings Routes
use App\Http\Controllers\GameReviewController;

Route::prefix('reviews')->middleware(['web'])->group(function () {
    Route::get('/game/{gamePackageId}', [GameReviewController::class, 'index'])->name('reviews.index');
    Route::get('/create/{gamePackageId}', [GameReviewController::class, 'create'])->middleware('auth')->name('reviews.create');
    Route::post('/store', [GameReviewController::class, 'store'])->middleware('auth')->name('reviews.store');
    Route::get('/{review}', [GameReviewController::class, 'show'])->name('reviews.show');
    Route::post('/{review}/helpful', [GameReviewController::class, 'markHelpful'])->middleware('auth')->name('reviews.helpful');
    Route::delete('/{review}', [GameReviewController::class, 'destroy'])->middleware('auth')->name('reviews.destroy');
});

// Wishlist Routes
use App\Http\Controllers\WishlistController;

Route::prefix('wishlist')->middleware('auth')->group(function () {
    Route::get('/', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/store', [WishlistController::class, 'store'])->name('wishlist.store');
    Route::delete('/{gamePackageId}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');
    Route::get('/check/{gamePackageId}', [WishlistController::class, 'check'])->name('wishlist.check');
});

// Export Routes
use App\Http\Controllers\ExportController;

Route::prefix('export')->middleware('auth')->group(function () {
    Route::get('/', [ExportController::class, 'create'])->name('export.create');
    Route::post('/transactions/pdf', [ExportController::class, 'pdf'])->name('export.transactions.pdf');
    Route::post('/transactions/csv', [ExportController::class, 'csv'])->name('export.transactions.csv');
    Route::get('/reviews', [ExportController::class, 'reviews'])->name('export.reviews');
    Route::get('/wishlist', [ExportController::class, 'wishlist'])->name('export.wishlist');
    Route::get('/stats', [ExportController::class, 'stats'])->name('export.stats');
});
