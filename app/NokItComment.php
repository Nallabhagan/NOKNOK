<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NokItComment extends Model
{
    protected $fillable = [
        'user_id', 'nok_it_id', 'comment'
    ];
}
