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
        $this->categoria = $categoria ?? 'bocadillos';
    }

    public function navigate($data)
    {
        $this->categoria = $data['categoria'];
    }

    public function render()
    {
        $tipo = ProductoTipo::where('tipo', $this->categoria)->first();

        $productos = $tipo
            ? Producto::where('id_producto_tipos', $tipo->id)->get()
            : collect();

        return view('livewire.productos.menu-productos', [
            'productos' => $productos,
            'categoria' => $this->categoria,
        ]);
    }
}
