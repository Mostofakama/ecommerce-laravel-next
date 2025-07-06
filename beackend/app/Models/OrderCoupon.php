<?php

namespace App\Models;

use App\Models\Order;
use App\Models\PromoCode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderCoupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'coupon_id',
    ];

    /**
     * Get the order associated with the coupon.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the coupon used for the order.
     */
    public function coupon()
    {
        return $this->belongsTo(PromoCode::class);
    }
}
