<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductoTipo extends Model
{

    protected $fillable = ['tipo'];

    /**
     * Relación con la tabla 'productos'
     */
    public function productos()
    {
        return $this->hasMany(Producto::class, 'id_producto_tipo');
    }   
}
