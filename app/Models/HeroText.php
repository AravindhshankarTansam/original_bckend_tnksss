<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroText extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_en',
        'title_ta',
        'description_en',
        'description_ta',
        'is_public',
    ];
}
