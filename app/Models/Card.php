<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Card extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title',
        'summary',
        'description',
        'keys',
        'video',
        'group',
        'images',
        'image_group',
        'user_id'
    ];

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
    
    public function read(){
        return $this->hasMany(CardLog::class, 'card_id','id');
    }
}