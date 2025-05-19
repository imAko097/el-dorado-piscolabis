<?php

namespace App\Livewire\Pedidos;


use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\EstadoPedido;
use App\Models\Pedido;

class ListaPedidos extends Component
{
    public $pedidos;
    public $estados;
    public $usuario;
    public $productos;
    public $pedidoSeleccionado;



    public $filtroEstados = ['pendientes'];


    protected $queryString = ['filtroEstados'];

    public function mount()
    {
        $this->estados = EstadoPedido::all();
    }
    

    public function mostrarDetalles($pedidoId)
    {
        $this->pedidoSeleccionado = Pedido::find($pedidoId);
        $this->usuario = $this->pedidoSeleccionado->usuario ?? null;
        $this->productos = $this->pedidoSeleccionado->productos;
    }


    public function cerrarModal()
    {
        $this->pedidoSeleccionado = null;
        $this->usuario = null;
        $this->productos = null;
    }



    public function toggleFiltroEstado($estado)
    {
        if (in_array($estado, $this->filtroEstados)) {
            // Si ya está activo, se desmarca (lo quitamos del array)
            $this->filtroEstados = array_filter($this->filtroEstados, fn($e) => $e !== $estado);
        } else {
            if ($estado === 'pendientes') {
                // Si activamos "pendientes", eliminamos todos los demás filtros
                $this->filtroEstados = ['pendientes'];
            } else {
                // Si "pendientes" está activo, lo quitamos antes de añadir otros
                $this->filtroEstados = array_filter($this->filtroEstados, fn($e) => $e !== 'pendientes');
                $this->filtroEstados[] = $estado;
            }
        }

        // Reindexamos y eliminamos duplicados por seguridad
        $this->filtroEstados = array_values(array_unique($this->filtroEstados));
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
        if ($this->pedidoSeleccionado) {
            $this->productos = $this->pedidoSeleccionado->productos;
        }

        $query = Pedido::with(['usuario', 'estadoPedido', 'productos']);

        if (!empty($this->filtroEstados)) {
            $query->whereHas('estadoPedido', function ($q) {
                if (in_array('pendientes', $this->filtroEstados)) {
                    $q->whereNotIn(DB::raw('LOWER(estado)'), ['entregado', 'cancelado']);
                } else {
                    $q->whereIn(DB::raw('LOWER(estado)'), $this->filtroEstados);
                }
            });
        }

        $this->pedidos = $query->orderByDesc('created_at')->get();

        return view('livewire.pedidos.lista-pedidos', [
            'pedidos' => $this->pedidos,
            'estados' => $this->estados,
        ]);
    }


}
