<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    
	protected $casts = ['questions' => 'array'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'title', 'description','questions','slug','status',
        'privacy_status'
    ];

    
}
