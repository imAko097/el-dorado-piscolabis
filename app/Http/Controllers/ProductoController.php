<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\User;
use App\Models\ProductoTipo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProductoController extends Controller
{

    public function index()
    {
        $categorias = \App\Models\ProductoTipo::pluck('tipo');
        $productos = \App\Models\Producto::with('tipo')->get();

        return view('admin.producto.index', compact('productos', 'categorias'));
    }


    public function toggleDestacado(Request $request, Producto $producto)
    {
        $producto->destacado = $request->has('destacado');
        $producto->save();

        return redirect()->back()->with('mensaje', 'Estado destacado actualizado.');
    }


    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('productos.index')->with('mensaje', 'Producto eliminado correctamente.');
    }
}
