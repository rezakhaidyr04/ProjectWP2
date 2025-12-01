<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GamePackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_name',
        'package_name',
        'amount',
        'price',
        'description',
        'image',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price' => 'decimal:2',
        'amount' => 'integer',
    ];

    /**
     * Relasi dengan GameTransaction
     */
    public function transactions()
    {
        return $this->hasMany(GameTransaction::class);
    }
}
