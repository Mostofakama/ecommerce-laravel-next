<?php

namespace App\Models;

use App\Models\User;
use App\Models\Payment;
use App\Models\OrderItem;
use App\Models\PromoCode;
use App\Models\OrderAddress;
use App\Models\RefundRequest;
use App\Models\OrderStatusLog;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
      protected $fillable = [
        'user_id', 'order_number', 'subtotal', 'discount_amount', 'shipping_cost',
        'total', 'status', 'payment_method', 'payment_status',
        'ordered_at', 'shipped_at', 'delivered_at', 'cancelled_at',
        'customer_note'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function addresses()
    {
        return $this->hasMany(OrderAddress::class);
    }

    public function coupon()
    {
        return $this->belongsToMany(PromoCode::class, 'order_coupon');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function statusLogs()
    {
        return $this->hasMany(OrderStatusLog::class);
    }

    public function refundRequests()
    {
        return $this->hasMany(RefundRequest::class);
    }
}
