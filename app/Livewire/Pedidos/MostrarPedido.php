<?php

namespace App\Livewire\Pedidos;

use Livewire\Component;
use App\Models\Pedido;

class MostrarPedido extends Component
{
    public $pedido;
    public $productos;
    public $usuario;
    public $comentario;
    public $cantidad;
    public $precio_unitario;
    public $precio_total;
    public $pedidoId;
    public $pedidoSeleccionado;
    public $showForm = false;

    public function mount($pedido)
    {
        $this->pedido = $pedido;
        
    }

    public function showModal()
{
    $this->pedidoSeleccionado = Pedido::with(['usuario', 'estadoPedido', 'productos' => function ($q) {
        $q->withPivot(['comentario', 'cantidad', 'precio_unitario', 'precio_total']);
    }])->find($this->pedido->id);

    $this->productos = $this->pedidoSeleccionado->productos;
    $this->usuario = $this->pedidoSeleccionado->usuario;
    $this->pedido = $this->pedidoSeleccionado;

    if ($this->productos->isNotEmpty()) {
        $this->comentario = $this->productos[0]->pivot->comentario;
        $this->cantidad = $this->productos[0]->pivot->cantidad;
        $this->precio_unitario = $this->productos[0]->pivot->precio_unitario;
        $this->precio_total = $this->productos[0]->pivot->precio_total;
    } else {
        $this->comentario = null;
        $this->cantidad = null;
        $this->precio_unitario = null;
        $this->precio_total = null;
    }

    $this->showForm = true;
}

    public function render()
    {
        return view('livewire.pedidos.mostrar-pedido');
    }
}
