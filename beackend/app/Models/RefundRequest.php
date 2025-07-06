<?php

namespace App\Models;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Model;

class RefundRequest extends Model
{
   protected $fillable = [
        'order_id', 'order_item_id', 'amount', 'reason', 'status',
        'requested_at', 'resolved_at'
    ];

    protected $casts = [
        'requested_at' => 'datetime',
        'resolved_at' => 'datetime'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function item()
    {
        return $this->belongsTo(OrderItem::class, 'order_item_id');
    }
}
