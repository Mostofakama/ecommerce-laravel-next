<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Services\HomePageServices;
use App\Http\Controllers\Controller;

class HomePageController extends Controller
{
    protected $HomePageServices;
    
    public function __construct(HomePageServices $HomePageServices){
      $this->HomePageServices = $HomePageServices;
    }

   public function HomePageProduct(){
    return $this->HomePageServices->HomePageProduct();
   }
   public function SingleProduct(string $slug){
    return $this->HomePageServices->SingleProduct($slug);
   }
   public function search(Request $request){
    return $this->HomePageServices->search($request);
   }
     public function FilterProduct(Request $request)
    {
      return $this->HomePageServices->FilterProduct($request);
    }

    public function NewProduct(){
      return $this->HomePageServices->NewProduct();
    }

    public function BestSeller(){
      return $this->HomePageServices->BestSeller();
    }
}
