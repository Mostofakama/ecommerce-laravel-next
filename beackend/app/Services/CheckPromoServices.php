<?php

namespace App\Services;

use App\Models\Address;
use App\Models\PromoCode;
use Illuminate\Support\Facades\Auth;

class CheckPromoServices{
    public function CheckPromo($request){
       // return $request;
       $request->validate([
            'code' => 'required|string'
        ]);

        $promo = PromoCode::where('code', $request->code)
            ->where('is_active', true)
            ->whereDate('valid_from', '<=', now())
            ->whereDate('valid_until', '>=', now())
            ->first();

        if (!$promo) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or expired promo code.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'discount' => $promo->discount_percentage,
        ]);
    }

      public function selectAddress($request)
    {
        $user = Auth::user()->id;

        $addressId = $request->address_id;
        $address = Address::where('id', $addressId)->first();

        if (!$address) {
            return response()->json(['message' => 'Address not found.'], 404);
        }

        Address::where('user_id', $user)->update(['is_selected' => false]);

        $address->is_selected = true;
        $address->save();

        return response()->json([
            'message' => 'Address selected successfully.',
            'data' => $address
        ]);
    }
}