<?php

namespace App\Services;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistServices{
    public function index()
    {
       // $user = $request->user();
       $user = Auth::user();
     //  return $user;
        $wishlist = Wishlist::with('product')
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        return response()->json([
            'message' => 'Wishlist fetched',
            'wishlist' => $wishlist,
        ]);
    }

    // ✅ wishlist-এ প্রোডাক্ট অ্যাড করা
    public function add( $request)
    {
        $user = Auth::user();
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $wishlist = Wishlist::firstOrCreate([
            'user_id' => $user->id,
            'product_id' => $request->product_id,
        ]);

        return response()->json([
            'message' => 'Added to wishlist',
            'wishlist' => $wishlist,
        ]);
    }

    // ✅ wishlist থেকে প্রোডাক্ট রিমুভ করা
    public function remove($id)
    {
        $user = Auth::user();
        $wishlist = Wishlist::where('id', $id)->first();

        if (!$wishlist) {
            return response()->json([
                'message' => 'Product not found in wishlist',
            ], 404);
        }

        $wishlist->delete();

        return response()->json([
            'message' => 'Removed from wishlist',
        ]);
    }
}