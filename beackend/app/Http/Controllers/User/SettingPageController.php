<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\SettingPageServices;

class SettingPageController extends Controller
{
    protected $SettingPageServices;
    
    public function __construct(SettingPageServices $SettingPageServices){
      $this->SettingPageServices = $SettingPageServices;
    }

    public function Banner(){
        
       return $this->SettingPageServices->Banner();
    }
}
