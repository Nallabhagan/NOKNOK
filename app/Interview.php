<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    protected $casts = ['answers' => 'array'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array 
     */
    protected $fillable = [
        'user_id', 'question_id', 'answers', 'slug', 'status',
    ];
    
    
}
