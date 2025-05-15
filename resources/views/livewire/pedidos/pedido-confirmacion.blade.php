<div class="min-h-screen bg-gray-100 py-12">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-lg p-8 text-center">
            <div class="mb-6">
                <i class="bi bi-check-circle-fill text-green-500 text-6xl"></i>
            </div>
            
            <h1 class="text-3xl font-bold mb-4">¡Pedido Realizado con Éxito!</h1>
            
            <p class="text-gray-600 mb-6">
                Tu pedido ha sido registrado correctamente. Te enviaremos una confirmación por correo electrónico con los detalles.
            </p>

            <div class="bg-gray-50 rounded-lg p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4">Detalles del Pedido</h2>
                <div class="space-y-2 text-left">
                    <p><span class="font-medium">Número de Pedido:</span> #{{ $pedido->id }}</p>
                    <p><span class="font-medium">Total:</span> {{ number_format($pedido->total, 2, ',', '.') }} €</p>
                    <p><span class="font-medium">Estado:</span> {{ ucfirst($pedido->estadoPedido->estado) }}</p>
                    @if($pedido->direccion)
                        <p><span class="font-medium">Dirección de Entrega:</span> {{ $pedido->direccion }}</p>
                    @endif
                    <p><span class="font-medium">Teléfono:</span> {{ $pedido->telefono_contacto }}</p>
                    <p><span class="font-medium">Forma de Pago:</span> {{ ucfirst($pedido->forma_pago) }}</p>
                </div>
            </div>

            <div class="space-y-4">
                <a href="{{ route('menu') }}" class="block w-full bg-yellow-400 text-black text-center py-3 rounded-lg font-semibold hover:bg-yellow-500 transition-colors">
                    Volver al Menú
                </a>
                <a href="{{ route('pedidos.mis-pedidos') }}" class="block w-full bg-gray-200 text-gray-700 text-center py-3 rounded-lg font-semibold hover:bg-gray-300 transition-colors">
                    Ver Mis Pedidos
                </a>
            </div>
        </div>
    </div>
</div> 