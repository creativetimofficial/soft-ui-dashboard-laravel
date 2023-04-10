<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class CardLog extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'card_id',
        'user_id',
    ];

}