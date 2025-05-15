<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pedido;

class EstadoPedido extends Model
{
    protected $table = 'estado_pedido';

    protected $fillable = ['estado'];
    
    /**
     * Relación con los pedidos
     * Un estado de pedido puede tener muchos pedidos
     */
    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
}
