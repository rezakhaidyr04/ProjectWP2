<?php

namespace App\Services;

class GameIdValidator
{
    /**
     * Validate game account ID based on game type
     */
    public static function validate($gameName, $accountId)
    {
        $gameName = strtolower($gameName);

        switch ($gameName) {
            case 'mobile legends':
                return self::validateMobileLegends($accountId);
            case 'free fire':
                return self::validateFreeFire($accountId);
            case 'pubg mobile':
                return self::validatePubgMobile($accountId);
            case 'valorant':
                return self::validateValorant($accountId);
            default:
                return ['valid' => true]; // Default accept if game not found
        }
    }

    /**
     * Mobile Legends: ID harus numeric, 8-10 digit
     */
    private static function validateMobileLegends($accountId)
    {
        if (!preg_match('/^\d{8,10}$/', $accountId)) {
            return [
                'valid' => false,
                'message' => 'ID Mobile Legends harus 8-10 angka'
            ];
        }
        return ['valid' => true];
    }

    /**
     * Free Fire: ID harus numeric, 10-12 digit
     */
    private static function validateFreeFire($accountId)
    {
        if (!preg_match('/^\d{10,12}$/', $accountId)) {
            return [
                'valid' => false,
                'message' => 'ID Free Fire harus 10-12 angka'
            ];
        }
        return ['valid' => true];
    }

    /**
     * PUBG Mobile: ID harus numeric, 10 digit
     */
    private static function validatePubgMobile($accountId)
    {
        if (!preg_match('/^\d{10}$/', $accountId)) {
            return [
                'valid' => false,
                'message' => 'ID PUBG Mobile harus 10 angka'
            ];
        }
        return ['valid' => true];
    }

    /**
     * Valorant: Username (3-16 character alphanumeric + underscore)
     */
    private static function validateValorant($accountId)
    {
        if (!preg_match('/^[a-zA-Z0-9_]{3,16}$/', $accountId)) {
            return [
                'valid' => false,
                'message' => 'Username Valorant harus 3-16 karakter (huruf, angka, underscore)'
            ];
        }
        return ['valid' => true];
    }
}
