<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title_en',
        'title_ta',
        'description_en',
        'description_ta',
        'image',
        'publish_date',
        'is_public',
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'publish_date' => 'datetime',
        'is_public' => 'boolean',
    ];

    /**
     * Default attribute values
     */
    protected $attributes = [
        'is_public' => true,
    ];
}
