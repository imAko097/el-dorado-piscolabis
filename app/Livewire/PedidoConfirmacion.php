<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pedido;

class PedidoConfirmacion extends Component
{
    public $pedido;

    public function mount($id)
    {
        $this->pedido = Pedido::with('estadoPedido')->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.pedido-confirmacion');
    }
} 