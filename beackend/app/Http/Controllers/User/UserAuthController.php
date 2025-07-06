<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Services\UserAuthServices;
use App\Http\Controllers\Controller;

class UserAuthController extends Controller
{
     protected $UserAuthServices;
    
    public function __construct(UserAuthServices $UserAuthServices){
      $this->UserAuthServices = $UserAuthServices;
    }

    public function login(Request $request){
        return $this->UserAuthServices->login($request);
    }

     public function register(Request $request)
    {
     
      return $this->UserAuthServices->register($request);
    }
}
