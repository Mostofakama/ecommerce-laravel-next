<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CheckPromoServices;

class CheckPromoController extends Controller
{
    protected $CheckPromoServices;
    
    public function __construct(CheckPromoServices $CheckPromoServices){
      $this->CheckPromoServices = $CheckPromoServices;
    }

    public function CheckPromo(Request $request){
        return $this->CheckPromoServices->CheckPromo($request);
    }

    public function selectAddress(Request $request)
    {
        return $this->CheckPromoServices->selectAddress($request);
    }
}
