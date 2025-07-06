<?php

namespace App\Services;

use Exception;
use App\Models\Order;
use App\Models\Address;
use App\Models\Payment;
use App\Models\OrderItem;
use App\Models\OrderCoupon;
use Illuminate\Support\Str;
use App\Models\OrderAddress;
use App\Models\OrderStatusLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderServices{
    public function store($request)
{
    
    DB::beginTransaction();

    try {
        // Your order creation logic here (same as before)
        $order = Order::create([
            'user_id' => Auth::user()->id,
            'order_number' => now()->format('YmdHis') . '-' . Str::random(5),
            'subtotal' => $request->subtotal,
            'discount_amount' => $request->discount_amount ?? 0,
            'shipping_cost' => $request->shipping_cost,
            'total' => $request->total,
            'payment_method' => $request->payment_method,
            'payment_status' => 'unpaid',
            'ordered_at' => now(),
            'customer_note' => $request->customer_note,
        ]);

        // Shipping Address copy
        $shippingAddress = Address::findOrFail($request->shipping_id);
        OrderAddress::create([
            'order_id' => $order->id,
            'type' => 'shipping',
            'name' => $shippingAddress->name,
            'phone' => $shippingAddress->phone,
            'email' => $shippingAddress->email,
            'country_code' => $shippingAddress->country_code,
            'division_id' => $shippingAddress->division_id,
            'district_id' => $shippingAddress->district_id,
            'upazila_id' => $shippingAddress->upazila_id,
            'postal_code' => $shippingAddress->postal_code,
            'street_address' => $shippingAddress->street_address,
            'landmark' => $shippingAddress->landmark,
        ]);

        // Billing Address copy (optional)
        if ($request->billing_id) {
            $billingAddress = Address::findOrFail($request->billing_id);
            OrderAddress::create([
                'order_id' => $order->id,
                'type' => 'billing',
                'name' => $billingAddress->name,
                'phone' => $billingAddress->phone,
                'email' => $billingAddress->email,
                'country_code' => $billingAddress->country_code,
                'division_id' => $billingAddress->division_id,
                'district_id' => $billingAddress->district_id,
                'upazila_id' => $billingAddress->upazila_id,
                'postal_code' => $billingAddress->postal_code,
                'street_address' => $billingAddress->street_address,
                'landmark' => $billingAddress->landmark,
            ]);
        }

        // Bulk insert order items
        $orderItems = collect($request->items)->map(function ($item) use ($order) {
            return [
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'product_name' => $item['product_name'],
                'sku' => $item['sku'] ?? null,
                'unit_price' => $item['unit_price'],
                'quantity' => $item['quantity'],
                'total_price' => $item['unit_price'] * $item['quantity'],
                'variant' => isset($item['variant']) ? json_encode($item['variant']) : null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        })->toArray();

        OrderItem::insert($orderItems);

        // Coupon apply (optional)
        if ($request->coupon_id) {
            OrderCoupon::create([
                'order_id' => $order->id,
                'coupon_id' => $request->coupon_id,
            ]);
        }

        // Status log
        OrderStatusLog::create([
            'order_id' => $order->id,
            'status' => 'pending',
            'note' => 'Order placed from frontend',
            'changed_by' => auth()->id(),
        ]);

       
            Payment::create([
                'order_id' => $order->id,
                'payment_method' => 'cod',
                'amount' => $request->total,
                'status' => 'pending',
            ]);
        DB::commit();

      //  return response()->json(['success' => true, 'order_id' => $order->id], 201);
 return success($order->order_number,'Your Order successful!');
    } catch (Exception $e) {
        DB::rollBack();

        return error('Something went wrong',500,$e->getMessage());
    }
}

public function OrderShow($orderId){
 $order = Order::select('id','order_number','subtotal','shipping_cost','discount_amount' ,'total', 'user_id')->where('order_number',$orderId)->first();
   return success($order,'Order successful get!');
}


public function myOrders($request)
{
     $userId = Auth::id();
    $status = $request->query('status'); // URL এর ?status=pending থেকে আসবে

    $orders = Order::with([
        'items' => function ($query) {
            $query->select('id', 'order_id', 'product_id', 'unit_price')
                ->with(['product' => function ($q2) {
                    $q2->select('id', 'name', 'thumbnail', 'slug','price','discount_value');
                }]);
        }
    ])
    ->select('id', 'order_number', 'status')
    ->where('user_id', $userId)
    ->when($status && $status !== 'all', function ($q) use ($status) {
        $q->where('status', $status);
    })
    ->latest()
    ->get();

   
   return success($orders,'filter order by status');
}
}