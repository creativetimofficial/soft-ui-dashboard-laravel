<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;
               
        protected $fillable = [
            'category',
            'description',
            'obs',
            'status',
            'date_requisition',
            'url',
            'user_email',
        ];
}
