<?php


namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class CardServices{
     public function addToCart( $request)
    {
        
        $user = $request->user_id;
        
        $guestToken = $request->header('X-Guest-Token');

        $cart = Cart::firstOrCreate(
            [
                'user_id' => $user? $user : null,
                'guest_token' => $user ? null : $guestToken,
                'status' => 'active',
            ],
            [
                'cart_type' => 'cart',
            ]
        );

        $cartItem = $cart->items()->updateOrCreate(
            [
                'product_id' => $request->product_id,
                'variant_id' => $request->variant_id,
            ],
            [
                'quantity' => $request->quantity ?? 1,
                'unit_price' => $request->unit_price,
                'original_price' => $request->original_price,
                'discount' => $request->discount ?? 0,
                'added_at' => now(),
            ]
        );

      $wishlist =  Wishlist::where('product_id', $request->product_id)
        ->where('user_id', $user)
        ->delete();
       // return $wishlist;
        return response()->json([
            'message' => 'Product added to cart',
            'CartItem' => $cartItem,
            'Cart' => $cart,
        ]);
    }

    // ✅ Get cart details
   public function getCart( $request)
{

    $user_id = auth()->check() ? auth()->id() : $request->header('user_id') ?? $request->query('user_id');
    //return $user_id;

    $guestToken = $request->header('X-Guest-Token') ?? $request->query('guest_token');

    $cart = Cart::with('items.product', 'items.variant')
        ->where(function ($q) use ($user_id, $guestToken) {
            $q->when($user_id, fn($q) => $q->where('user_id', $user_id))
              ->when(!$user_id && $guestToken, fn($q) => $q->where('guest_token', $guestToken));
        })
        ->where('status', 'active')
        ->first();

    return response()->json([
        'cart' => $cart,
        'items' => $cart?->items ?? [],
    ]);
}
    // ✅ Update quantity
    public function updateItemQuantity( $request)
    {
        $cartItem = CartItem::findOrFail($request->item_id);
        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return response()->json(['message' => 'Quantity updated', 'item' => $cartItem]);
    }

    // ✅ Remove item from cart
    public function removeFromCart($itemId)
    {
        $cartItem = CartItem::findOrFail($itemId);
        $cartItem->delete();

        return response()->json(['message' => 'Item removed from cart']);
    }

    // ✅ Merge guest cart into user cart after login
  
}
