<?php

namespace App\Services;

use App\Models\PromoCode;
use App\Models\PromoCodeUsage;
use Carbon\Carbon;

class PromoCodeService
{
    /**
     * Validate and apply promo code
     */
    public static function applyPromoCode($userId, $promoCode, $totalPrice)
    {
        // Find promo code
        $code = PromoCode::where('code', strtoupper($promoCode))->first();

        if (!$code) {
            return [
                'valid' => false,
                'message' => 'Kode promo tidak ditemukan'
            ];
        }

        // Check if valid
        if (!$code->isValid()) {
            return [
                'valid' => false,
                'message' => 'Kode promo sudah expired atau tidak aktif'
            ];
        }

        // Check user usage limit
        $userUsageCount = PromoCodeUsage::where('user_id', $userId)
            ->where('promo_code_id', $code->id)
            ->count();

        if ($userUsageCount >= $code->max_usage_per_user) {
            return [
                'valid' => false,
                'message' => 'Anda sudah mencapai batas penggunaan kode promo ini'
            ];
        }

        // Calculate discount
        $discountAmount = $code->calculateDiscount($totalPrice);

        return [
            'valid' => true,
            'code_id' => $code->id,
            'discount_amount' => $discountAmount,
            'final_price' => $totalPrice - $discountAmount,
            'message' => 'Kode promo berhasil diterapkan!'
        ];
    }

    /**
     * Record promo code usage
     */
    public static function recordUsage($userId, $codeId, $discountAmount, $transactionId = null)
    {
        // Create usage record
        PromoCodeUsage::create([
            'user_id' => $userId,
            'promo_code_id' => $codeId,
            'transaction_id' => $transactionId,
            'discount_amount' => $discountAmount,
        ]);

        // Increment usage count
        $code = PromoCode::find($codeId);
        $code->increment('usage_count');
    }
}
