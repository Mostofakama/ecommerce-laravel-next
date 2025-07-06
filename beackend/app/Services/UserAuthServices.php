<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\User;
use App\Services\CardServices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\CartController;

class UserAuthServices{
    // protected $CardServices;

    // // Constructor injection (or set manually)
    // public function __construct()
    // {
    //     $this->CardServices = new CardServices();
    // }
      public function login( $request)
    {
       // return $request->password;
            $request->validate([
                    'email' => 'required|email',
                    'password' => 'required'
                ]);

            if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return response()->json(['status' => 401, 'message' => 'Invalid credentials'], 401);
            }
    

            $user = Auth::user();

            $token = $user->createToken('auth_token')->plainTextToken;

       

        // ✅ Merge cart after login
         $guestToken = $request->header('X-Guest-Token');
        if ($guestToken) {
            $this->mergeGuestCartAfterLogin($user, $guestToken);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Login successful',
            'user' => $user,
            'token' => $token
        ]);
    }


     public function register($request)
    {
        // return 'yes';
        // Validate input
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|unique:users,email',
        //     'password' => 'required|string|min:8|confirmed', // password_confirmation ফিল্ড প্রয়োজন
        // ]);

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // এখানে হ্যাশিং
        ]);

        // Optionally create token immediately
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 201,
            'message' => 'User registered successfully',
            'user' => $user,
            'token' => $token,
        ]);
    }
    

      public function mergeGuestCartAfterLogin($user, $guestToken)
    {
        $guestCart = Cart::with('items')->where('guest_token', $guestToken)->whereNull('user_id')->first();

        if (!$guestCart) return;

        $userCart = Cart::firstOrCreate(
            ['user_id' => $user->id, 'status' => 'active'],
            ['cart_type' => 'cart']
        );

        foreach ($guestCart->items as $item) {
            $existingItem = $userCart->items()
                ->where('product_id', $item->product_id)
                ->where('variant_id', $item->variant_id)
                ->first();

            if ($existingItem) {
                $existingItem->quantity += $item->quantity;
                $existingItem->save();
            } else {
                $item->cart_id = $userCart->id;
                $item->replicate()->save(); // copy item to userCart
            }
        }

        $guestCart->delete();
    }
}