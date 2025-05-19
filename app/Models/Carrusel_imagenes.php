<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrusel_imagenes extends Model
{
    protected $table = 'carrusel_imagenes';
    protected $fillable = ['imagen'];

    public function getImagenAttribute($value)
    {
        return asset('storage/' . $value);
    }
}
