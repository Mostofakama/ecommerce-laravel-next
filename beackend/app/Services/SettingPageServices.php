<?php

namespace App\Services;

use App\Models\Banner;
  

class SettingPageServices{
    public function Banner(){
        $banners = Banner::select('id','image','title','subtitle','cta','cta_url',)->where('status',true)->get();
        return success($banners,'All banners fetched successfully');
    }

}