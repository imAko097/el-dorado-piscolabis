<?php

namespace App\Livewire\Productos;
use Livewire\WithFileUploads;
use App\Models\Producto;
use App\Models\ProductoTipo;
use Illuminate\Support\Facades\Storage;

use Livewire\Component;

class EditarProductoForm extends Component
{
    use WithFileUploads;
    public $nombre, $ingredientes, $precio, $stock, $imagen;
    public $imagen_actual;
    public $id_producto_tipos;
    public $producto;
    public $showForm = false;

    protected $rules = [
        'nombre' => 'required|string|max:255',
        'ingredientes' => 'required|string|max:255',
        'precio' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'imagen' => 'nullable|image|max:2048',
        'id_producto_tipos' => 'required|exists:producto_tipos,id'
    ];
    protected $messages = [
        'nombre.required' => 'El nombre es obligatorio.',
        'ingredientes.required' => 'Los ingredientes son obligatorios.',
        'precio.required' => 'El precio es obligatorio.',
        'stock.required' => 'El stock es obligatorio.',
        'imagen.image' => 'La imagen debe ser un archivo de imagen.',
        'id_producto_tipos.required' => 'El tipo de producto es obligatorio.'
    ];
    public function mount($producto)
    {
        $this->producto = $producto;
    }

    public function showModal()
    {

        $this->nombre = $this->producto->nombre;
        $this->ingredientes = $this->producto->ingredientes;
        $this->precio = $this->producto->precio;
        $this->stock = $this->producto->stock;
        $this->imagen_actual = $this->producto->imagen;
        $this->id_producto_tipos = $this->producto->id_producto_tipos;
        $this->showForm = true;
    }

    public function storage()
    {
        $this->validate();
        if ($this->imagen) {
            if ($this->imagen_actual) {
                Storage::disk('public')->delete($this->imagen_actual);
            }
            $path = $this->imagen->store('productos', 'public');
        } else {
            $path = $this->imagen_actual;
        }

        $this->producto->update([
            'nombre' => $this->nombre,
            'ingredientes' => $this->ingredientes,
            'precio' => $this->precio,
            'stock' => $this->stock,
            'imagen' => $path ?? null,
            'id_producto_tipos' => $this->id_producto_tipos,
        ]);

        session()->flash('message', 'Producto actualizado correctamente.');
        return redirect()->route('productos.index');
    }

    public function render()
    {
        return view('livewire.productos.editar-producto-form');
    }
}
