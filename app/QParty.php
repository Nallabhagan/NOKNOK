<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QParty extends Model
{
    protected $fillable = [
        'user_id', 'title', 'description', 'image', 'slug', 'member_id', 'status'
    ];
}
