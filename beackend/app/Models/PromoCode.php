<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PromoCode extends Model
{
     use HasFactory;

    protected $fillable = [
        'code',
        'discount_percentage',
        'valid_from',
        'valid_until',
        'is_active',
    ];

    protected $casts = [
        'discount_percentage' => 'integer',
        'valid_from' => 'date',
        'valid_until' => 'date',
        'is_active' => 'boolean',
    ];

    // ✅ Scope: only active and valid
    public function scopeValid($query)
    {
        return $query->where('is_active', true)
                     ->whereDate('valid_from', '<=', now())
                     ->whereDate('valid_until', '>=', now());
    }
}
