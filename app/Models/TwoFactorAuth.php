<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TwoFactorAuth extends Model
{
    use HasFactory;

    protected $table = 'two_factor_auths';
    protected $fillable = ['user_id', 'enabled', 'method', 'phone_number', 'otp_code', 'otp_expires_at', 'attempts', 'verified_at'];

    protected $casts = [
        'enabled' => 'boolean',
        'attempts' => 'integer',
        'otp_expires_at' => 'datetime',
        'verified_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
