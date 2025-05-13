<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Producto;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;

class Carrito extends Component
{
    public $productos = [];
    public $total = 0;
    public $mostrarCarrito = false;

    public function mount()
    {
        $this->productos = Session::get('carrito', []);
        $this->calcularTotal();
    }

    #[On('agregarAlCarrito')]
    public function agregarProducto($id)
    {
        $producto = Producto::find($id);
        
        if (!$producto) {
            return;
        }

        if (isset($this->productos[$id])) {
            $this->productos[$id]['cantidad']++;
        } else {
            $this->productos[$id] = [
                'id' => $producto->id,
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
                'cantidad' => 1,
                'imagen' => $producto->imagen
            ];
        }

        $this->actualizarCarrito();
        $this->mostrarCarrito = true;
    }

    public function eliminarProducto($idProducto)
    {
        if (isset($this->productos[$idProducto])) {
            unset($this->productos[$idProducto]);
            $this->actualizarCarrito();
        }
    }

    public function actualizarCantidad($idProducto, $cantidad)
    {
        if (isset($this->productos[$idProducto])) {
            if ($cantidad > 0) {
                $this->productos[$idProducto]['cantidad'] = $cantidad;
            } else {
                $this->eliminarProducto($idProducto);
            }
            $this->actualizarCarrito();
        }
    }

    private function actualizarCarrito()
    {
        Session::put('carrito', $this->productos);
        $this->calcularTotal();
    }

    private function calcularTotal()
    {
        $this->total = collect($this->productos)->sum(function ($item) {
            return $item['precio'] * $item['cantidad'];
        });
    }

    public function toggleCarrito()
    {
        $this->mostrarCarrito = !$this->mostrarCarrito;
    }

    public function render()
    {
        return view('livewire.carrito');
    }
} 