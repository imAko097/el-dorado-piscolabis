<?php

namespace App\Livewire\Pedidos;

use Livewire\Component;
use App\Models\Pedido;
use Illuminate\Support\Facades\Auth;

class MisPedidos extends Component
{
    public function render()
    {
        $pedidos = Pedido::with(['estadoPedido', 'productos'])
            ->where('id_usuario', Auth::id())
            ->latest()
            ->get();

        return view('livewire.pedidos.mis-pedidos', [
            'pedidos' => $pedidos
        ]);
    }
} 