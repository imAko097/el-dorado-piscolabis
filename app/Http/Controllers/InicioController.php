<?php

namespace App\Http\Controllers;
use App\Models\Carrusel_imagenes;
use App\Models\Producto;

use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function inicio()
    {
        $carrusel_imagenes = Carrusel_imagenes::orderBy('orden', 'asc')->get();
        $productosDestacados = Producto::where('destacado', true)->take(10)->get();
        return view('inicio.inicio', compact('carrusel_imagenes', 'productosDestacados'));
    }

    public function menu($categoria = null)
    {
        return view('inicio.menu', ['categoria' => $categoria]);
    }

    public function contacto()
    {
        return view('inicio.contacto');
    }

    public function sobreNosotros()
    {
        return view('inicio.sobrenosotros');
    }
}
