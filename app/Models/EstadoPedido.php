<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pedido;

class EstadoProducto extends Model
{
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
