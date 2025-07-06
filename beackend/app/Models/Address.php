<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Devfaysal\BangladeshGeocode\Models\Upazila;
use Devfaysal\BangladeshGeocode\Models\District;
use Devfaysal\BangladeshGeocode\Models\Division;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory;

   protected $fillable = [
        'user_id', 'type', 'label', 'name', 'phone', 'email', 'country_code',
        'division_id', 'district_id', 'upazila_id', 'postal_code', 'street_address',
        'landmark', 'is_default','is_selected'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function division() {
        return $this->belongsTo(Division::class);
    }

    public function district() {
        return $this->belongsTo(District::class);
    }

    public function upazila() {
        return $this->belongsTo(Upazila::class);
    }
}
