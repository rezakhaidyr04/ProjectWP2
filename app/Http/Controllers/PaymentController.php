<?php

namespace App\Http\Controllers;

use App\Models\GameTransaction;
use App\Models\GamePackage;
use App\Mail\PaymentConfirmed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Midtrans\Snap;
use Midtrans\Config;

class PaymentController extends Controller
{
    public function __construct()
    {
        // Set Midtrans Configuration
        Config::$serverKey = config('midtrans.server_key');
        Config::$clientKey = config('midtrans.client_key');
        Config::$isSanitized = config('midtrans.sanitize');
        Config::$is3ds = true;
        Config::$isProduction = config('midtrans.is_production');
    }

    /**
     * Generate Midtrans Snap Token untuk pembayaran
     */
    public function generateToken($transactionId)
    {
        $transaction = GameTransaction::with(['gamePackage', 'user'])
            ->findOrFail($transactionId);

        // Verify ownership
        if ($transaction->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        try {
            $params = [
                'transaction_details' => [
                    'order_id' => $transaction->transaction_code,
                    'gross_amount' => (int)$transaction->total_price,
                ],
                'customer_details' => [
                    'first_name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                    'phone' => Auth::user()->phone ?? '62812345678',
                ],
                'item_details' => [
                    [
                        'id' => $transaction->gamePackage->id,
                        'price' => (int)$transaction->total_price,
                        'quantity' => 1,
                        'name' => $transaction->gamePackage->game_name . ' - ' . $transaction->gamePackage->package_name,
                    ]
                ],
            ];

            $snapToken = Snap::getSnapToken($params);
            
            return response()->json([
                'snap_token' => $snapToken,
                'transaction_id' => $transaction->id,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Handle Midtrans Webhook Callback
     */
    public function handleCallback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed === $request->signature_key) {
            $transactionStatus = $request->transaction_status;
            $transactionCode = $request->order_id;

            $transaction = GameTransaction::where('transaction_code', $transactionCode)->firstOrFail();

            if ($transactionStatus === 'capture' || $transactionStatus === 'settlement') {
                $transaction->update([
                    'status' => 'completed',
                    'notes' => 'Pembayaran berhasil',
                ]);
                // Send confirmation email
                Mail::to($transaction->user->email)->send(new PaymentConfirmed($transaction));
            } elseif ($transactionStatus === 'pending') {
                $transaction->update([
                    'status' => 'pending',
                    'notes' => 'Menunggu pembayaran',
                ]);
            } elseif ($transactionStatus === 'deny' || $transactionStatus === 'cancel' || $transactionStatus === 'expire') {
                $transaction->update([
                    'status' => 'failed',
                    'notes' => 'Pembayaran ditolak/dibatalkan',
                ]);
            }

            return response()->json(['status' => 'ok']);
        }

        return response()->json(['status' => 'error'], 400);
    }

    /**
     * Check payment status
     */
    public function checkStatus($transactionId)
    {
        $transaction = GameTransaction::findOrFail($transactionId);

        if ($transaction->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        return response()->json([
            'status' => $transaction->status,
            'message' => $transaction->notes,
        ]);
    }
}
