<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\ProductoTipo;

class Producto extends Model
{
    // Los campos a llenar
    protected $fillable = [
        'id_producto_tipo',
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
        return $this->belongsTo(ProductoTipo::class, 'id_producto_tipo');
    }
}
