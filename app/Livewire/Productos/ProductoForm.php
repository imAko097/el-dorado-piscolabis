<?php

namespace App\Livewire\Productos;

use Livewire\WithFileUploads;
use App\Models\Producto;
use App\Models\ProductoTipo;
use Livewire\Component;

class ProductoForm extends Component
{
    use WithFileUploads;

    public $nombre, $ingredientes, $precio, $imagen;
    public $id_producto_tipos;
    public $producto;
    public $showForm = false;
    public $categoriaSeleccionada;


    protected $rules = [
        'nombre' => 'required|string|max:255',
        'ingredientes' => 'required|string|max:255',
        'precio' => 'required|numeric|min:0',
        'imagen' => 'nullable|image|max:2048',
        'id_producto_tipos' => 'required|exists:producto_tipos,id'
    ];
    protected $messages = [
        'nombre.required' => 'El nombre es obligatorio.',
        'ingredientes.required' => 'Los ingredientes son obligatorios.',
        'precio.required' => 'El precio es obligatorio.',
        'imagen.image' => 'La imagen debe ser un archivo de imagen.',
        'id_producto_tipos.required' => 'El tipo de producto es obligatorio.'
    ];

    public function showModal()
    {
        $this->reset(['nombre', 'ingredientes', 'precio', 'imagen', 'id_producto_tipos']);
        $this->showForm = true;

        if ($this->categoriaSeleccionada) {
            $tipo = \App\Models\ProductoTipo::where('tipo', $this->categoriaSeleccionada)->first();
            if ($tipo) {
                $this->id_producto_tipos = $tipo->id;
            }
        }
    }


    public function save()
    {
        $this->validate();
        if ($this->imagen) {
            $path = $this->imagen->store('productos', 'public');
        }

        Producto::create([
            'nombre' => $this->nombre,
            'ingredientes' => $this->ingredientes,
            'precio' => $this->precio,
            'imagen' => $path ?? null,
            'id_producto_tipos' => $this->id_producto_tipos,
        ]);

        $this->dispatch('productoAgregado');
        session()->flash('message', 'Producto agregado correctamente.');
        return redirect()->route('productos.index');
    }



    public function render()
    {
        return view('livewire.productos.producto-form');
    }
}
