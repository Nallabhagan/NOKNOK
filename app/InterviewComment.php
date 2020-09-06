<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InterviewComment extends Model
{
    protected $fillable = [
        'user_id', 'interview_id', 'comment'
    ];
}
