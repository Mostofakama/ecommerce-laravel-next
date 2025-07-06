<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
     protected $fillable = [
        'name',
        'sku',
        'slug',
        'description',
        'summary',
        'price',
        'original_price',
        'discount_type',
        'discount_value',
        'final_price',
        'quantity',
        'brand_id',
        'category_id',
        'sub_category_id',
        'status',
        'new_product',
        'best_seller',
        'thumbnail',
        'meta_title',
        'meta_description',
        'meta_keyword',
    ];
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
    // Relationships
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(Category::class, 'sub_category_id');
    }
}
