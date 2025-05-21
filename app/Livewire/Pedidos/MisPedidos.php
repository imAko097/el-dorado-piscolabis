<?php

namespace App\Livewire\Pedidos;

use Livewire\Component;
use App\Models\Pedido;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;

class MisPedidos extends Component
{
    // Cargar pedidos
    #[Computed]
    public function pedidos()
    {
        return Pedido::with(['estadoPedido', 'productos'])
            ->where('id_usuario', Auth::id())
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.pedidos.mis-pedidos');
    }
} 