<?php

namespace App\Livewire\Pedidos;

use Livewire\Component;
use App\Models\EstadoPedido;
use App\Models\Pedido;

class ListaPedidos extends Component
{
    public $pedidos;
    public $estados;
    public $mostrarModal = false;
    public $pedidoSeleccionado;


    public function mount()
    {
        $this->estados = EstadoPedido::all();
    }


    public function cambiarEstado($pedidoId, $nuevoEstadoId)
    {
        $pedido = Pedido::find($pedidoId);
        if ($pedido) {
            $pedido->id_estado_pedido = $nuevoEstadoId;
            $pedido->save();
        }
    }


    public function getColorEstado($estadoNombre)
    {
        return match (strtolower($estadoNombre)) {
            'recibido' => 'bg-blue-100 text-blue-800',
            'en preparación' => 'bg-yellow-100 text-yellow-800',
            'en camino' => 'bg-fuchsia-100 text-fuchsia-800',
            'listo para recoger' => 'bg-cyan-100 text-cyan-800',
            'entregado' => 'bg-green-100 text-green-800',
            'cancelado' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }


    public function render()
    {
        $this->pedidos = Pedido::with(['productos', 'usuario', 'estadoPedido'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.pedidos.lista-pedidos');
    }
}
