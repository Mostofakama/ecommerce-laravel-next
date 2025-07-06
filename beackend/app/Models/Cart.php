<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
        use HasFactory;

    protected $fillable = [
        'user_id',
        'guest_token',
        'status',
        'cart_type',
        'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    /**
     * Relationship: User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: Cart Items
     */
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    /**
     * Scope: Only active carts
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Helper: Get total cart amount
     */
    public function getTotalAmountAttribute()
    {
        return $this->items->sum(fn ($item) => ($item->unit_price - $item->discount) * $item->quantity);
    }
}
