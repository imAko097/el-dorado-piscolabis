<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\EstadoPedido;

class Pedido extends Model
{
    use HasFactory;

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'id_usuario',
        'id_estado_pedido',
        'direccion',
        'observaciones',
        'telefono_contacto',
        'forma_pago',
        'fecha_entrega',
        'subtotal',
        'descuento',
        'total',
    ];

    /**
     * Relación con el modelo Usuario
     * Un pedido pertenece a un usuario (cliente).
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    /**
     * Relación con el modelo EstadoPedido
     * Un pedido tiene un estado.
     */
    public function estadoPedido()
    {
        return $this->belongsTo(EstadoPedido::class, 'id_estado_pedido');
    }

    /**
     * 
     */
    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'pedido_productos', 'id_pedido', 'id_producto')
                    ->withPivot('comentario', 'cantidad', 'precio_unitario', 'precio_total')
                    ->withTimestamps();
    }

}
