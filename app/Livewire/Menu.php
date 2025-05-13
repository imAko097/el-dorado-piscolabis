<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Producto;
use App\Models\ProductoTipo;

class Menu extends Component
{
    public string $categoria = '';

    protected $listeners = ['navigate'];

    public function mount($categoria = null)
    {
        // Si no hay categoría en la URL, intentar obtenerla de la ruta actual
        if ($categoria === null) {
            $categoria = request()->route('categoria');
        }
        $this->categoria = $categoria ?? 'bocadillos';
    }

    public function navigate(string $categoria)
    {
        $this->categoria = $categoria;
    }

    public function render()
    {
        $tipo = ProductoTipo::where('tipo', $this->categoria)->first();

        $productos = $tipo
            ? Producto::where('id_producto_tipos', $tipo->id)->get()
            : collect();

        return view('livewire.menu.menu-productos', [
            'productos' => $productos,
            'categoria' => $this->categoria,
        ]);
    }
}
