<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NokItLike extends Model
{
    protected $fillable = [
        'user_id', 'nok_it_id'
    ];
}
