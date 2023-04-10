<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Error extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'description',
        'json'
    ];
}