<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Producto;
use App\Models\ProductoTipo;
use Livewire\Attributes\On;
use function Livewire\browser;

class Menu extends Component
{
    public string $categoria = ''; // Categoría actual seleccionada

    // Función para inicializar la categoría
    public function mount($categoria = null)
    {
        // Si no hay categoría en la URL, intentar obtenerla de la ruta actual
        if ($categoria === null) {
            $categoria = request()->route('categoria');
        }
        
        $this->categoria = $categoria ?? 'bocadillos';
    }

    // Evento para navegar entre categorías
    #[On('navigate')]
    public function navigate(string $categoria)
    {
        $this->categoria = $categoria;
    }

    // Función para obtener los productos de la categoría seleccionada
    public function getProductos()
    {
        $tipo = ProductoTipo::where('tipo', $this->categoria)->first();
        return $tipo ? Producto::where('id_producto_tipos', $tipo->id)->get() : collect();
    }

    // Agregar producto al carrito, dispatch evento para el componente 'Carrito.php'
    public function agregarAlCarrito($id)
    {
        $this->dispatch('agregarAlCarrito', id: $id);
        $this->dispatch('carrito-actualizado');
    }

    // Función para renderizar la vista
    public function render()
    {
        return view('livewire.menu.menu-productos', [
            'productos' => $this->getProductos(),
            'categoria' => $this->categoria,
        ]);
    }
}
