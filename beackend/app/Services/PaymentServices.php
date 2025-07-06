<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class PaymentServices
{

    public function initiate($request)
    {
    $orderNumber = $request->order_number;
        $paymentMethod = $request->payment_method;

        // Get order
        $order = Order::select('id', 'total', 'user_id', 'order_number')
            ->where('order_number', $orderNumber)
            ->firstOrFail();

        // COD
        if ($paymentMethod === 'cod') {
            Payment::updateOrCreate(
                ['order_id' => $order->id],
                [
                    'payment_method' => 'cod',
                    'amount'         => $order->total,
                    'status'         => 'pending',
                    'transaction_id' => $orderNumber,
                    'response'       => json_encode(['note' => 'COD Payment']),
                ]
            );

            return [
                'status'  => 'success',
                'type'    => 'cod',
                'message' => 'Cash on Delivery payment initialized',
            ];
        }

        // bKash or Nagad
        if (in_array($paymentMethod, ['bkash', 'nagad'])) {
            $redirectUrl = $paymentMethod === 'bkash'
                ? 'https://pay.bkash.com/payment/start/' . $orderNumber
                : 'https://sandbox.nagad.com/payment/start/' . $orderNumber;

            Payment::updateOrCreate(
                ['order_id' => $order->id],
                [
                    'payment_method' => $paymentMethod,
                    'amount'         => $order->total,
                    'status'         => 'pending',
                    'transaction_id' => $orderNumber,
                    'response'       => json_encode(['gateway' => $paymentMethod]),
                ]
            );

            return [
                'status'  => 'success',
                'type'    => $paymentMethod,
                'message' => ucfirst($paymentMethod) . ' payment initialized.',
                'url'     => $redirectUrl,
            ];
        }

        // SSLCommerz
        if ($paymentMethod === 'sslcommerz') {
            $user = Auth::user();

            $post_data = [
                'store_id'       => config('sslcommerz.store_id'),
                'store_passwd'   => config('sslcommerz.store_password'),
                'total_amount'   => $order->total,
                'currency'       => "BDT",
                'tran_id'        => $orderNumber,

                'success_url'    => url(config('sslcommerz.success_url', '/payment/success')),
                'fail_url'       => url(config('sslcommerz.fail_url', '/payment/fail')),
                'cancel_url'     => url(config('sslcommerz.cancel_url', '/payment/cancel')),

                'cus_name'       => $user->name,
                'cus_email'      => $user->email ?? 'demo@email.com',
                'cus_add1'       => 'Dhaka',
                'cus_city'       => 'Dhaka',
                'cus_postcode'   => '1207',
                'cus_country'    => 'Bangladesh',
                'cus_phone'      => $user->phone ?? '01711111111',

                'shipping_method' => 'Courier',
                'ship_name'       => $user->name ?? 'Customer',
                'ship_add1'       => 'Dhaka',
                'ship_city'       => 'Dhaka',
                'ship_postcode'   => '1207',
                'ship_country'    => 'Bangladesh',
                'ship_phone'      => $user->phone ?? '01711111111',

                'product_name'     => 'Ecommerce Order',
                'product_category' => 'General',
                'product_profile'  => 'general',
            ];

            $api_url = config('sslcommerz.sandbox')
                ? 'https://sandbox.sslcommerz.com/gwprocess/v4/api.php'
                : 'https://securepay.sslcommerz.com/gwprocess/v4/api.php';

            $response = Http::asForm()->timeout(30)->post($api_url, $post_data);
            $data = json_decode($response->body());

            if (!empty($data->GatewayPageURL)) {
                Payment::updateOrCreate(
                    ['order_id' => $order->id],
                    [
                        'payment_method' => 'sslcommerz',
                        'amount'         => $order->total,
                        'status'         => 'pending',
                        'transaction_id' => $orderNumber,
                        'response'       => $response->body(),
                    ]
                );

                return [
                    'status' => 'success',
                    'type'   => 'sslcommerz',
                    'url'    => $data->GatewayPageURL,
                ];
            }

            return [
                'status'  => 'error',
                'message' => $data->failedreason ?? 'Payment gateway failed to respond',
            ];
        }

        return [
            'status'  => 'error',
            'message' => 'Invalid payment method',
        ];
    }
}
