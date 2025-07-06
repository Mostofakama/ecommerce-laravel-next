<?php

namespace App\Services;

use Devfaysal\BangladeshGeocode\Models\Upazila;
use Devfaysal\BangladeshGeocode\Models\District;
use Devfaysal\BangladeshGeocode\Models\Division;

class LocationServices{
    public function getDivisions()
    {
       $division = Division::select('id', 'name')->get();
        return success($division, "Division loaded successfully");
    }

    // ✅ Get districts by division
    public function getDistrictsByDivision($division_id)
    {
       $districts= District::select('id', 'name', 'division_id')
                      ->where('division_id', $division_id)
                      ->get();
        return success($districts, "Districts loaded successfully");
    }

    
    public function getUpazilasByDistrict($district_id)
    {
        return response()->json([
            'status' => true,
            'data' => Upazila::select('id', 'name', 'district_id')
                      ->where('district_id', $district_id)
                      ->get()
        ]);
    }
}