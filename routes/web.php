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

Route::middleware('auth')->group(function () {
    Route::get('/topup', [GameTopUpController::class, 'index'])->name('topup.index');
    Route::get('/topup/{gameName}', [GameTopUpController::class, 'showGame'])->name('topup.game');
    Route::get('/topup/{packageId}/checkout', [GameTopUpController::class, 'checkout'])->name('topup.checkout');
    Route::post('/topup/{packageId}/process', [GameTopUpController::class, 'process'])->name('topup.process');
    Route::get('/topup/{transactionId}/receipt', [GameTopUpController::class, 'receipt'])->name('topup.receipt');
    Route::get('/my-topups', [GameTopUpController::class, 'myTransactions'])->name('topup.myTransactions');
});
