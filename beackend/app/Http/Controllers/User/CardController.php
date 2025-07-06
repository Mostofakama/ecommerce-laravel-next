<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Services\CardServices;
use App\Http\Controllers\Controller;

class CardController extends Controller
{
     protected $CardServices;
    
    public function __construct(CardServices $CardServices){
      $this->CardServices = $CardServices;
    }

    public function addToCart(Request $request)
    {
      //  return $request;
        return $this->CardServices->addToCart($request);
    }

    // ✅ Get cart details
    public function getCart(Request $request)
    {
     return $this->CardServices->getCart($request);
    }

    // ✅ Update quantity
    public function updateItemQuantity(Request $request)
    {
        return $this->CardServices->updateItemQuantity($request);
    }

    // ✅ Remove item from cart
    public function removeFromCart($itemId)
    {
        return $this->CardServices->removeFromCart($itemId);
    }

    // ✅ Merge guest cart into user cart after login
    public function mergeGuestCartAfterLogin($user, $guestToken)
    {
        return $this->CardServices->mergeGuestCartAfterLogin($user, $guestToken);
    }
}
