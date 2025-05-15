<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pedido;
use App\Models\EstadoPedido;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Checkout extends Component
{
    public $productos = [];
    public $total = 0;
    public $tipoEntrega = 'domicilio';
    public $direccion = '';
    public $telefono = '';
    public $observaciones = '';
    public $formaPago = 'efectivo';

    public function mount()
    {
        $this->productos = Session::get('carrito', []);
        if (empty($this->productos)) {
            return redirect()->route('menu');
        }
        $this->calcularTotal();
    }

    private function calcularTotal()
    {
        $this->total = collect($this->productos)->sum(function ($item) {
            return $item['precio'] * $item['cantidad'];
        });
    }

    // Realiza el pedido (añade a la base de datos el pedido y los productos)
    public function realizarPedido()
    {
        $this->validate([
            'tipoEntrega' => 'required|in:domicilio,tienda',
            'direccion' => 'required_if:tipoEntrega,domicilio',
            'telefono' => 'required',
            'formaPago' => 'required|in:efectivo,tarjeta',
        ], [
            'direccion.required_if' => 'La dirección es obligatoria para entrega a domicilio.',
            'telefono.required' => 'El teléfono es obligatorio.',
        ]);

        // Crear el pedido
        $pedido = Pedido::create([
            'id_usuario' => Auth::check() ? Auth::id() : null,
            'id_estado_pedido' => EstadoPedido::where('estado', 'recibido')->first()->id,
            'direccion' => $this->tipoEntrega === 'domicilio' ? $this->direccion : null,
            'observaciones' => $this->observaciones,
            'telefono_contacto' => $this->telefono,
            'forma_pago' => $this->formaPago,
            'subtotal' => $this->total,
            'descuento' => 0,
            'total' => $this->total,
        ]);

        

        // Agregar productos al pedido (tabla intermedia pedido_productos)
        foreach ($this->productos as $producto) {
            $pedido->productos()->attach($producto['id'], [
                'cantidad' => $producto['cantidad'],
                'precio_unitario' => $producto['precio'],
                'precio_total' => $producto['precio'] * $producto['cantidad'],
                'comentario' => (string) ($producto['comentario'] ?? ''),
            ]);
        }

        // Limpiar el carrito
        Session::forget('carrito');

        // Redirigir a la página de confirmación
        return redirect()->route('pedido.confirmacion', $pedido->id);
    }

    public function render()
    {
        return view('livewire.pedidos.checkout');
    }
} 