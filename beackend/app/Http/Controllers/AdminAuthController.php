<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AdminAuthServices;
use App\Http\Requests\AdminLoginRequest;

class AdminAuthController extends Controller
{
    
    protected $AdminAuthServices;

    public function __construct(AdminAuthServices $AdminAuthServices){
        $this->AdminAuthServices = $AdminAuthServices;
    }

    public function login(AdminLoginRequest $request) {
       return $this->AdminAuthServices->login($request);
    }
    public function logout(Request $request) {
       return $this->AdminAuthServices->logout($request);
    }

}
