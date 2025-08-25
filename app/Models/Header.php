<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Header extends Model
{
    use HasFactory;
        protected $fillable = [
        'image', 'alt_en', 'alt_ta', 'is_public'
    ];
}
