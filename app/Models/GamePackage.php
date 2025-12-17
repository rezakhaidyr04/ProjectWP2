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

    /**
     * Reviews untuk game ini
     */
    public function reviews()
    {
        return $this->hasMany(GameReview::class);
    }

    /**
     * Wishlists untuk game ini
     */
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    /**
     * Get average rating
     */
    public function getAverageRating()
    {
        return GameReview::getAverageRating($this->id);
    }

    /**
     * Get rating distribution
     */
    public function getRatingDistribution()
    {
        return GameReview::getRatingDistribution($this->id);
    }
}
