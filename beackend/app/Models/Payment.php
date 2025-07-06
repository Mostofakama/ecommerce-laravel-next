<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'order_id', 'transaction_id', 'payment_method', 'amount',
        'status', 'paid_at', 'response'
    ];

    protected $casts = [
        'paid_at' => 'datetime',
        'response' => 'array'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
