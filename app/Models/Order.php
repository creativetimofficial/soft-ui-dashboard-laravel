<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Order extends Authenticatable
{

    protected $table = 'orders';
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    //type 1 = cancelamentos
    //type 2 = estornos

    protected $fillable = [
        'order_number',
        'order_id',
        'attendant_name',
        'attendant_cpf',
        'observation',
        'nf',
        'client_cpf',
        'check_products',
        'check_stores',
        'check_transfer',
        'type',
        'total',
        'store_id',
        'status'
    ];
}