<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoyaltyPoint extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'points', 'earned_points', 'redeemed_points', 'reason', 'transaction_id'];

    protected $casts = [
        'points' => 'integer',
        'earned_points' => 'integer',
        'redeemed_points' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
