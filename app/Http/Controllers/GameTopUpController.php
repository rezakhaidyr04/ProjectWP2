<?php

namespace App\Http\Controllers;

use App\Models\GamePackage;
use App\Models\GameTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GameTopUpController extends Controller
{
    /**
     * Tampilkan daftar game yang tersedia
     */
    public function index()
    {
        $games = GamePackage::select('game_name')
            ->distinct()
            ->orderBy('game_name')
            ->get();
        
        return view('topup.index', compact('games'));
    }

    /**
     * Tampilkan paket untuk game tertentu
     */
    public function showGame($gameName)
    {
        $packages = GamePackage::where('game_name', $gameName)
            ->where('is_active', true)
            ->orderBy('price')
            ->get();

        if ($packages->isEmpty()) {
            return redirect()->route('topup.index')->with('error', 'Game tidak ditemukan');
        }

        return view('topup.game', [
            'gameName' => $gameName,
            'packages' => $packages
        ]);
    }

    /**
     * Tampilkan form checkout
     */
    public function checkout($packageId)
    {
        $package = GamePackage::findOrFail($packageId);

        return view('topup.checkout', compact('package'));
    }

    /**
     * Proses pembelian top-up
     */
    public function process(Request $request, $packageId)
    {
        $validated = $request->validate([
            'game_account' => 'required|string|max:100',
            'payment_method' => 'required|in:bank_transfer,e_wallet,gopay,ovo,dana',
        ], [
            'game_account.required' => 'ID Game harus diisi',
            'game_account.max' => 'ID Game maksimal 100 karakter',
            'payment_method.required' => 'Metode pembayaran harus dipilih',
            'payment_method.in' => 'Metode pembayaran tidak valid',
        ]);

        $package = GamePackage::findOrFail($packageId);

        // Generate unique transaction code
        $transactionCode = 'TRX-' . strtoupper(Str::random(12));

        $transaction = GameTransaction::create([
            'user_id' => Auth::id(),
            'game_package_id' => $package->id,
            'game_account' => $validated['game_account'],
            'total_price' => $package->price,
            'payment_method' => $validated['payment_method'],
            'status' => 'pending',
            'transaction_code' => $transactionCode,
            'notes' => 'Menunggu konfirmasi pembayaran',
        ]);

        return redirect()->route('topup.receipt', $transaction->id)
            ->with('success', 'Transaksi berhasil dibuat. Silakan lanjutkan pembayaran.');
    }

    /**
     * Tampilkan bukti transaksi
     */
    public function receipt($transactionId)
    {
        $transaction = GameTransaction::with(['gamePackage', 'user'])
            ->findOrFail($transactionId);

        // Pastikan user hanya bisa melihat transaksi miliknya
        if ($transaction->user_id !== Auth::id()) {
            abort(403, 'Tidak diizinkan mengakses transaksi ini');
        }

        return view('topup.receipt', compact('transaction'));
    }

    /**
     * Tampilkan riwayat transaksi pengguna
     */
    public function myTransactions()
    {
        $transactions = GameTransaction::with('gamePackage')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('topup.my-transactions', compact('transactions'));
    }
}
