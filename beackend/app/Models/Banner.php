<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'title',
        'subtitle',
        'cta',
        'cta_url',
        'position',
        'type',
        'order',
        'status',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'status' => 'boolean',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];
}
