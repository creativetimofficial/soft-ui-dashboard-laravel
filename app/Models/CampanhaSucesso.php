<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampanhaSucesso extends Model
{
    protected $table = 'ecommerce_campanha';

    protected $connection = 'pgsql';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'cdloja',
        'cdregiao',
        'cdplano',
        'ticket_meta',
        'ticket_atual',
        'venda_meta',
        'venda_atual',
        'desconto_meta',
        'desconto_atual',
        'genericos_meta',
        'genericos_atual',
        'perfumaria_meta',
        'perfumaria_atual',
        'clientes_meta',
        'clientes_atual'
    ];
}
