<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NokIt extends Model
{
    protected $fillable = [
        'user_id', 'content'
    ];
}
