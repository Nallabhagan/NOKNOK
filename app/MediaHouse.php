<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MediaHouse extends Model
{
    protected $fillable = [
        'user_id', 'name', 'description',
    ];
}
