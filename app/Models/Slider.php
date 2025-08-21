<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_en',
        'title_ta',
        'images',
        'desc_en',
        'desc_ta',
        'is_public',
    ];

    // Cast images to array and is_public to boolean
    protected $casts = [
        'images' => 'array',
        'is_public' => 'boolean',
    ];
}
