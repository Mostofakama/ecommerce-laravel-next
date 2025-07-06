<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'color',
        'size',
        'quantity',
        'is_active',
    ];

    /**
     * Relationship: Variant belongs to Product
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
