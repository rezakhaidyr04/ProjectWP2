<?php

namespace App\Http\Controllers;

use App\Models\GamePackage;
use App\Models\GameTransaction;
use App\Mail\TransactionCreated;
use App\Services\GameIdValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class GameTopUpController extends Controller
{
    /**
     * Tampilkan daftar game yang tersedia dengan filter
     */
    public function index()
    {
        $search = request()->get('search');
        
        $games = GamePackage::select('game_name')
            ->distinct()
            ->orderBy('game_name');
        
        if ($search) {
            $games->where('game_name', 'LIKE', "%{$search}%");
        }
        
        $games = $games->get();
        
        return view('topup.index', compact('games', 'search'));
    }

    /**
     * Tampilkan paket untuk game tertentu dengan filter harga
     */
    public function showGame($gameName)
    {
        $minPrice = request()->get('min_price');
        $maxPrice = request()->get('max_price');
        $sortBy = request()->get('sort_by', 'price');
        
        $packages = GamePackage::where('game_name', $gameName)
            ->where('is_active', true);

        if ($minPrice) {
            $packages->where('price', '>=', $minPrice);
        }
        if ($maxPrice) {
            $packages->where('price', '<=', $maxPrice);
        }

        // Sort options
        if ($sortBy === 'price_asc') {
            $packages->orderBy('price', 'asc');
        } elseif ($sortBy === 'price_desc') {
            $packages->orderBy('price', 'desc');
        } else {
            $packages->orderBy('price', 'asc');
        }

        $packages = $packages->get();

        if ($packages->isEmpty()) {
            return redirect()->route('topup.index')->with('error', 'Game tidak ditemukan');
        }

        return view('topup.game', [
            'gameName' => $gameName,
            'packages' => $packages,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
            'sortBy' => $sortBy,
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

        // Validate game account ID format
        $idValidation = GameIdValidator::validate($package->game_name, $validated['game_account']);
        if (!$idValidation['valid']) {
            return back()
                ->withInput()
                ->withErrors(['game_account' => $idValidation['message']]);
        }

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

        // Send email notification
        // Mail::to(Auth::user()->email)->send(new TransactionCreated($transaction));

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
