<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function inicio()
    {
        return view('inicio.inicio');
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
