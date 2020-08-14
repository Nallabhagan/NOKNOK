<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BrandInterview extends Model
{
    protected $fillable = [
        'user_id', 'brand_id', 'question', 'status'
    ];
}
