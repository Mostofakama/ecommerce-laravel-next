<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LocationServices;

class LocationController extends Controller
{
    protected $LocationServices;

    public function __construct(LocationServices $LocationServices){
        $this->LocationServices = $LocationServices;
    }

   
    public function getDivisions()
    {
       return $this->LocationServices->getDivisions(); 
    }

    // ✅ Get districts by division
    public function getDistrictsByDivision(string $division_id)
    {
      return $this->LocationServices->getDistrictsByDivision($division_id);
    }

    
    public function getUpazilasByDistrict(string $district_id)
    {
       return $this->LocationServices->getUpazilasByDistrict($district_id);
    }
}
