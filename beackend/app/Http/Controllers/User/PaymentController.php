<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Services\PaymentServices;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    protected $PaymentServices;
    
    public function __construct(PaymentServices $PaymentServices){
      $this->PaymentServices = $PaymentServices;
    }

      public function initiate(Request $request)
    {
      return $this->PaymentServices->initiate($request);
    }
}
