<?php

namespace App\Livewire\Productos;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Producto;
use App\Models\ProductoTipo;
use Illuminate\Support\Facades\Storage;

class MostrarProductos extends Component
{
    use WithFileUploads;

    public $productos;
    public $categorias;
    public $categoriaSeleccionada;
    public $producto;
    public $nombre, $ingredientes, $precio, $imagen;
    public $imagen_actual;
    public $id_producto_tipos;
    public $showForm = false;

    protected $listeners = ['productoAgregado' => 'cargarProductos'];

    protected $rules = [
        'nombre' => 'required|string|max:255',
        'ingredientes' => 'required|string|max:255',
        'precio' => 'required|numeric|min:0',
        'imagen' => 'nullable|image|max:2048',
        'id_producto_tipos' => 'required|exists:producto_tipos,id',
    ];

    public function mount($productos, $categorias)
    {
        $this->productos = $productos;
        $this->categorias = $categorias;
    }

    public function updatedCategoriaSeleccionada()
    {
        $this->cargarProductos();
    }

    public function cargarProductos()
    {
        $this->productos = Producto::with('tipo')
            ->when($this->categoriaSeleccionada, function ($query) {
                $query->whereHas('tipo', function ($q) {
                    $q->where('tipo', $this->categoriaSeleccionada);
                });
            })
            ->get();
    }

    public function toggleDestacado($id)
    {
        $producto = Producto::find($id);
        if ($producto) {
            $producto->destacado = !$producto->destacado;
            $producto->save();
            $this->cargarProductos();
        }
    }

    public function editar($id)
    {
        $this->producto = Producto::findOrFail($id);
        $this->nombre = $this->producto->nombre;
        $this->ingredientes = $this->producto->ingredientes;
        $this->precio = $this->producto->precio;
        $this->imagen_actual = $this->producto->imagen;
        $this->id_producto_tipos = $this->producto->id_producto_tipos;
        $this->showForm = true;
    }

    public function actualizar()
    {
        $this->validate();

        $imagenPath = $this->imagen_actual;

        if ($this->imagen) {
            if ($this->imagen_actual) {
                Storage::disk('public')->delete($this->imagen_actual);
            }
            $imagenPath = $this->imagen->store('productos', 'public');
        }

        $this->producto->update([
            'nombre' => $this->nombre,
            'ingredientes' => $this->ingredientes,
            'precio' => $this->precio,
            'imagen' => $imagenPath,
            'id_producto_tipos' => $this->id_producto_tipos,
        ]);

        session()->flash('message', 'Producto actualizado correctamente.');
        $this->reset(['showForm', 'imagen']);
        $this->cargarProductos();
    }

    public function render()
    {
        return view('livewire.productos.mostrar-productos');
    }
}
