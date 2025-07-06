<?php 

namespace App\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class GoogleAuthServices{
    public function redirect(){
       return Socialite::driver('google')->stateless()->redirect();
    }
    public function callback(){
       try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            $user = User::updateOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'google_id' => $googleUser->getId(),
                    'email_verified_at' => now(),
                    'password' => bcrypt(Str::random(16)), // dummy pass
                ]
            );

            $token = $user->createToken('auth_token')->plainTextToken;

            // Redirect to frontend with token
            return redirect("http://localhost:3000/login-success?token=$token");
        } catch (\Exception $e) {
            return response()->json(['error' => 'Login Failed'], 500);
        }
    }
}