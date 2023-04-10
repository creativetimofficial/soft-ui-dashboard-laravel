<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Download extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'art_id',
        'user_id',
        'type',
        'json'
    ];
}