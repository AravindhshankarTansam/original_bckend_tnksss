<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    use HasFactory;

    protected $fillable = [
        'image','description_en','description_ta',
        'facebook','twitter','instagram','is_public'
    ];

    // Add headers and links dynamically
    public function __construct(array $attributes = [])
    {
        for ($h = 1; $h <= 3; $h++) {
            $this->fillable[] = "header{$h}_en";
            $this->fillable[] = "header{$h}_ta";
            for ($l = 1; $l <= 4; $l++) {
                $this->fillable[] = "header{$h}_link{$l}_en";
                $this->fillable[] = "header{$h}_link{$l}_ta";
                $this->fillable[] = "header{$h}_link{$l}_url";
            }
        }
        parent::__construct($attributes);
    }
}
