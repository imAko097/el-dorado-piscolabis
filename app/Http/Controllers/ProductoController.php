<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();

        return view('admin.producto.index', compact('productos'));
    }

    public function mount()
    {
        $user = Auth::user();

        if (!$user || $user->role !== 'admin' || $user->role !== 'empleado') {
            abort(403, 'No tienes permiso para crear productos.');
        }
    }
}