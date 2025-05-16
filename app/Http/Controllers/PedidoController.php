<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Producto;
use App\Models\User;
use App\Models\EstadoPedido;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::with('productos')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.pedido.index', compact('pedidos'));
    }

}