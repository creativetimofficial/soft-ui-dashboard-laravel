<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Art extends Authenticatable
{

    protected $table = 'arts';
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
        'images',
        'image_group',
        'user_id',
        'type',
        'fields',
        'function',
        'permission',
        'order',
        'status'
    ];

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
    
    public function download(){
        return $this->hasMany(Download::class, 'art_id','id')->where('type',2)->whereDate('created_at', Carbon::today())->limit(10);
    }
    
    public function read(){
        return $this->hasMany(Download::class, 'art_id','id')->where('type',1)->whereDate('created_at', Carbon::today())->limit(10);
    }
    
    public function allfields(){
        return $this->hasMany(ArtField::class, 'art_id','id')->orderBy('order','ASC');
    }
}