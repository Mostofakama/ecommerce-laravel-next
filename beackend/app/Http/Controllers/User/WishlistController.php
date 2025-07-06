<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Services\WishlistServices;
use App\Http\Controllers\Controller;

class WishlistController extends Controller
{
    protected $WishlistServices;
    
    public function __construct(WishlistServices $WishlistServices){
      $this->WishlistServices = $WishlistServices;
    }

    public function index()
    {
      return $this->WishlistServices->index();
    }

    // ✅ wishlist-এ প্রোডাক্ট অ্যাড করা
    public function add(Request $request)
    {
        return $this->WishlistServices->add($request);
    }

    // ✅ wishlist থেকে প্রোডাক্ট রিমুভ করা
    public function remove($id)
    {
      return $this->WishlistServices->remove($id);
    }
}
