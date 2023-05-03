<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogsDiscounts extends Model
{
    use HasFactory;

    protected $table = 'logs_discounts';
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'product_id',
        'store_id',
        'user_id',
        'product_value'
    ];
}
