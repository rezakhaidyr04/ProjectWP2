<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BulkTransaction extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'bulk_code', 'total_items', 'completed_items', 'failed_items', 'total_price', 'status', 'accounts_data'];

    protected $casts = [
        'total_items' => 'integer',
        'completed_items' => 'integer',
        'failed_items' => 'integer',
        'total_price' => 'decimal:2',
        'accounts_data' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->bulk_code = 'BULK-' . strtoupper(Str::random(10));
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
