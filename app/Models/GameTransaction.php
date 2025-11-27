<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'game_package_id',
        'game_account',
        'total_price',
        'payment_method',
        'status',
        'transaction_code',
        'notes',
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi dengan User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi dengan GamePackage
     */
    public function gamePackage()
    {
        return $this->belongsTo(GamePackage::class);
    }
}
