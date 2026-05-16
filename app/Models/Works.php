<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Works extends Model
{
    protected $fillable = [
        'category',
        'name',
        'type',
        'theme',
        'cta',
        'features',
        'image',
        'description',
     
    ];

    protected $casts = [
        'features' => 'array',
    ];
}
