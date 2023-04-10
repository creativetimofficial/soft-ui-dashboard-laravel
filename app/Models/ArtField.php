<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class ArtField extends Authenticatable
{

    protected $table = 'arts_fields';
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'art_id',
        'order',
        'type',
        'field',
        'name',
        'other',
        'function',
        'values'
    ];
}