<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'game_package_id',
        'rating',
        'review',
        'helpful_count',
    ];

    protected $casts = [
        'rating' => 'integer',
        'helpful_count' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user who wrote the review
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the game package being reviewed
     */
    public function gamePackage()
    {
        return $this->belongsTo(GamePackage::class);
    }

    /**
     * Get average rating for a game
     */
    public static function getAverageRating($gamePackageId)
    {
        return self::where('game_package_id', $gamePackageId)->avg('rating') ?? 0;
    }

    /**
     * Get rating distribution
     */
    public static function getRatingDistribution($gamePackageId)
    {
        return self::where('game_package_id', $gamePackageId)
            ->selectRaw('rating, count(*) as count')
            ->groupBy('rating')
            ->pluck('count', 'rating');
    }

    /**
     * Scope for latest reviews
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Scope for highest rated
     */
    public function scopeHighestRated($query)
    {
        return $query->orderBy('rating', 'desc');
    }

    /**
     * Scope for game
     */
    public function scopeForGame($query, $gamePackageId)
    {
        return $query->where('game_package_id', $gamePackageId);
    }
}
