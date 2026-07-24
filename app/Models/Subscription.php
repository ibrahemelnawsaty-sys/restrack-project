<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subscription extends Model
{
    protected $fillable = [
        'user_id', 'status', 'payment_id', 'payment_method', 'payment_gateway',
        'amount', 'currency', 'coupon_id', 'discount_amount', 'activated_at',
        'expires_at', 'refunded_at', 'gateway_response',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'discount_amount' => 'decimal:2',
            'activated_at' => 'datetime',
            'expires_at' => 'datetime',
            'refunded_at' => 'datetime',
            'gateway_response' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
