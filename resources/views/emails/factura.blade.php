@component('mail::message')
# Factura del Pedido #{{ $pedido->id }}

Hola {{ $usuario->name }},  
Gracias por tu pedido. Aquí tienes los detalles de tu factura:

---

**Fecha del pedido:** {{ $pedido->created_at->format('d/m/Y H:i') }}  
**Forma de pago:** {{ ucfirst($pedido->forma_pago) }}  
**Teléfono de contacto:** {{ $pedido->telefono_contacto }}  
@if($pedido->direccion)  
**Dirección de entrega:** {{ $pedido->direccion }}  
@endif

---

## Detalles del pedido

@component('mail::table')
| Producto | Cantidad | Precio unidad | Total |
|----------|----------|---------------|--------|
@foreach ($productos as $producto)
| {{ $producto->nombre }} | {{ $producto->pivot->cantidad }} | {{ number_format($producto->pivot->precio_unitario, 2, ',', '.') }} € | {{ number_format($producto->pivot->precio_total, 2, ',', '.') }} € |
@endforeach
@endcomponent

**Subtotal:** {{ number_format($pedido->subtotal, 2, ',', '.') }} €  
**IGIC (7%):** {{ number_format($pedido->subtotal * 0.07, 2, ',', '.') }} €  
**Total:** **{{ number_format($pedido->total, 2, ',', '.') }} €**

---

Gracias por tu compra.  
Si tienes alguna duda, puedes responder a este correo.

@endcomponent
