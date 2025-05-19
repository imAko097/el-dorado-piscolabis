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
    public $subtotal = 0;
    public $igic = 0;
    public $total = 0;
    public $recargoEntrega = 1.5;
    public $tipoEntrega = 'domicilio';
    public $direccion = '';
    public $telefono = '';
    public $observaciones = '';
    public $formaPago = 'efectivo';
    public $numeroTarjeta = '';
    public $nombreTitular = '';
    public $fechaExpiracion = '';
    public $cvv = '';

    public function mount()
    {
        $this->productos = Session::get('carrito', []);
        if (empty($this->productos)) {
            return redirect()->route('menu');
        }
        $this->calcularTotal();
    }

    // Calcula el total del pedido, incluido el igic (extraido)
    private function calcularTotal()
    {
        // calcular subtotal de productos (sumando los precios de los productos multiplicados por la cantidad; IGIC incluido)
        $subtotalProductosIgicIncluido = collect($this->productos)->sum(fn($item) => 
            $item['precio'] * $item['cantidad']
        );

        // Extraer el igic del subtotal
        $subtotalProductosIgicExcluido = $subtotalProductosIgicIncluido / 1.07;        
        
        // Añadir recargo de entrega
        $recargo = $this->tipoEntrega === 'domicilio' ? $this->recargoEntrega : 0; // recargo de entrega
        $baseImponible = $subtotalProductosIgicExcluido + $recargo; // base imponible del pedido

        // Calcular igic del pedido
        $igicCalculado = $baseImponible * 0.07;

        // Total del pedido
        $totalPedido = $baseImponible + $igicCalculado;

        // Asignar los valores a las propiedades
        $this->subtotal = round($subtotalProductosIgicExcluido, 2);
        $this->igic = round($igicCalculado, 2);
        $this->total = round($totalPedido, 2);
    }

    // Actualiza el total del pedido cuando se cambia el tipo de entrega
    public function updatedTipoEntrega()
    {
        $this->calcularTotal();
    }

    // Realiza el pedido (añade a la base de datos el pedido y los productos)
    public function realizarPedido()
    {
        $this->validate([
            'tipoEntrega' => 'required|in:domicilio,local',
            'direccion' => 'required_if:tipoEntrega,domicilio',
            'telefono' => 'required',
            'formaPago' => 'required|in:efectivo,tarjeta',
            'numeroTarjeta' => 'required_if:formaPago,tarjeta|digits:16',
            'nombreTitular' => 'required_if:formaPago,tarjeta|min:3',
            'fechaExpiracion' => ['required_if:formaPago,tarjeta', 'regex:/^(0[1-9]|1[0-2])\/([0-9]{2})$/'],
            'cvv' => 'required_if:formaPago,tarjeta|digits:3',
            'observaciones' => 'nullable|string|max:1000',
        ], [
            'direccion.required_if' => 'La dirección es obligatoria para entrega a domicilio.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'numeroTarjeta.required_if' => 'El número de tarjeta es obligatorio para pago con tarjeta.',
            'numeroTarjeta.digits' => 'El número de tarjeta debe tener 16 dígitos.',
            'nombreTitular.required_if' => 'El nombre del titular es obligatorio para pago con tarjeta.',
            'nombreTitular.min' => 'El nombre del titular debe tener al menos 3 caracteres.',
            'fechaExpiracion.required_if' => 'La fecha de expiración es obligatoria para pago con tarjeta.',
            'fechaExpiracion.regex' => 'La fecha de expiración debe tener el formato MM/YY.',
            'cvv.required_if' => 'El CVV es obligatorio para pago con tarjeta.',
            'cvv.digits' => 'El CVV debe tener 3 dígitos.',
        ]);

        // Crear el pedido
        $pedido = Pedido::create([
            'id_usuario' => Auth::check() ? Auth::id() : null,
            'id_estado_pedido' => EstadoPedido::where('estado', 'recibido')->first()->id,
            'direccion' => $this->tipoEntrega === 'domicilio' ? $this->direccion : $this->tipoEntrega,
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