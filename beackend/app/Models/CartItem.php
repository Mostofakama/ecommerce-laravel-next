<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'product_id',
        'variant_id',
        'quantity',
        'unit_price',
        'original_price',
        'discount',
        'notes',
        'added_at',
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'original_price' => 'decimal:2',
        'discount' => 'decimal:2',
        'added_at' => 'datetime',
    ];

    /**
     * Relationship: Cart
     */
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    /**
     * Relationship: Product
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Relationship: Product Variant
     */
    public function variant()
    {
        return $this->belongsTo(ProductVariant::class);
    }

    /**
     * Helper: Get subtotal for this cart item
     */
    public function getSubtotalAttribute()
    {
        return ($this->unit_price - $this->discount) * $this->quantity;
    }
}
