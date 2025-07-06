<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Devfaysal\BangladeshGeocode\Models\Upazila;
use Devfaysal\BangladeshGeocode\Models\District;
use Devfaysal\BangladeshGeocode\Models\Division;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderAddress extends Model
{
     use HasFactory;

    protected $fillable = [
        'order_id',
        'type',
        'name',
        'phone',
        'email',
        'country_code',
        'division_id',
        'district_id',
        'upazila_id',
        'postal_code',
        'street_address',
        'landmark',
    ];

    /**
     * Get the order that owns the address.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the division.
     */
    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    /**
     * Get the district.
     */
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    /**
     * Get the upazila.
     */
    public function upazila()
    {
        return $this->belongsTo(Upazila::class);
    }
}
