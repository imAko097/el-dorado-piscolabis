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

    // Agrega productos al carrito
    #[On('agregarAlCarrito')]
    public function agregarProducto($id)
    {
        $producto = Producto::findOrFail($id);

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
    }

    // Elimina los productos del carrito
    public function eliminarProducto($idProducto)
    {
        // Verifica si el producto está en el carrito
        if (isset($this->productos[$idProducto])) {
            unset($this->productos[$idProducto]); // Lo elimina del array
            $this->actualizarCarrito();
        }
    }

    // Actualiza la cantidad de los productos seleccionados
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

    // Actualiza el carrito
    private function actualizarCarrito()
    {
        Session::put('carrito', $this->productos);
        $this->calcularTotal();
    }

    // Calcula el total a pagar
    private function calcularTotal()
    {
        $this->total = collect($this->productos)->sum(function ($item) {
            return $item['precio'] * $item['cantidad'];
        });
    }

    // Abre/Cierra el panel lateral con el carrito
    public function toggleCarrito()
    {
        $this->mostrarCarrito = !$this->mostrarCarrito;
    }

    public function render()
    {
        return view('livewire.carrito');
    }
} 