<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'dob',
        'gender',
        'mobile',
        'affiliate_mobile',
        'profile_image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
