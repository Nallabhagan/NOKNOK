<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QPartyInterview extends Model
{
    protected $fillable = [
        'user_id', 'qparty_id', 'question', 'status'
    ];
}
