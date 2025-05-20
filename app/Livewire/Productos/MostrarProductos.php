<?php

namespace App\Livewire\Productos;

use Livewire\Component;
use App\Models\Producto;

class MostrarProductos extends Component
{

    public $productos;

    public function mount()
    {
        $this->productos = Producto::with('tipo')->get();
    }

    public function toggleDestacado($productoId)
    {
        $producto = Producto::find($productoId);
        if ($producto) {
            $producto->destacado = !$producto->destacado;
            $producto->save();

            // Actualizar la lista para reflejar el cambio
            $this->productos = Producto::with('tipo')->get();
        }
    }

    public function render()
    {
        return view('livewire.productos.mostrar-productos');
    }
}
