<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Services\OrderServices;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;

class OrderController extends Controller
{
     protected $OrderServices;
    
    public function __construct(OrderServices $OrderServices){
      $this->OrderServices = $OrderServices;
    }
    
     public function store(StoreOrderRequest $request){
      
       return $this->OrderServices->store($request);
     }

     public function OrderShow(string $orderId){
       return $this->OrderServices->OrderShow($orderId);
     }
     public function myOrders(Request $request)
    {
      return $this->OrderServices->myOrders($request);
    }

}
