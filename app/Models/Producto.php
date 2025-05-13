<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\ProductoTipo;

class Producto extends Model
{
    // Los campos a llenar
    protected $fillable = [
        'id_producto_tipos',
        'nombre',
        'ingredientes',
        'imagen',
        'precio'
    ];

    /**
     * Relación con ProductoTipo
     * Un producto pertenece a un tipo de producto
     */
    public function tipo()
    {
        return $this->belongsTo(ProductoTipo::class, 'id_producto_tipos');
    }

    /**
     * Relación con Pedido
     * Un pedido puede tener muchos productos
     */
    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class, 'pedido_productos', 'id_producto', 'id_pedido')
                    ->withPivot('comentario', 'cantidad', 'precio_unitario', 'precio_total')
                    ->withTimestamps();
    }
}
