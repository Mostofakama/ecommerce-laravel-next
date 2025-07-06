<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\GoogleAuthServices;

class GoogleAuthController extends Controller
{
     protected $GoogleAuthServices;
    
    public function __construct(GoogleAuthServices $GoogleAuthServices){
      $this->GoogleAuthServices = $GoogleAuthServices;
    }
    
    public function redirect(){
      return $this->GoogleAuthServices->redirect(); 
    }
    public function callback(){
      return $this->GoogleAuthServices->callback(); 
    }
}
