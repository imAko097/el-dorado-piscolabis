<div class="min-h-screen bg-yellow-50 py-10">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-lg p-8 text-center border border-yellow-300">
            <div class="mb-1">
                <i class="bi bi-check-circle-fill text-green-500 text-6xl"></i>
            </div>
            
            <h1 class="text-3xl font-bold mb-3">¡Pedido Realizado con Éxito!</h1>
            
            <div class="mb-3">
                <span class="text-gray-600">
                    Tu pedido ha sido registrado correctamente. No salgas de la página para saber el estado de tu pedido.
                </span>
            </div>

            <div class="bg-gray-50 rounded-lg p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4">Detalles del Pedido</h2>
                <div class="space-y-2 text-left">
                    <p><span class="font-bold">Número de pedido:</span> #{{ $pedido->id }}</p>
                    <p><span class="font-bold">Total:</span> {{ number_format($pedido->total, 2, ',', '.') }} €</p>
                    <p><span class="font-bold">Estado:</span> {{ ucfirst($pedido->estadoPedido->estado) }}</p>
                    @if($pedido->direccion)
                        <p><span class="font-bold">Dirección de entrega:</span> {{ $pedido->direccion }}</p>
                    @endif
                    <p><span class="font-bold">Teléfono:</span> {{ $pedido->telefono_contacto }}</p>
                    <p><span class="font-bold">Forma de pago:</span> {{ ucfirst($pedido->forma_pago) }}</p>
                </div>
            </div>

            <div>
                <a href="{{ route('menu') }}" class="block w-full bg-gray-200 text-gray-700 text-center py-3 rounded-lg font-semibold hover:bg-gray-300 transition-colors">
                    Volver al Menú
                </a>
                @if(Auth::check())
                    <a href="{{ route('pedidos.mis-pedidos') }}" class="block w-full bg-yellow-400 text-center py-3 rounded-lg font-semibold hover:bg-gray-300 transition-colors">
                        Ver Mis Pedidos
                    </a>
                @else
                    <div class="mt-3">
                        <span class="text-gray-600">¿No tienes cuenta?
                            <a href="{{ route('login') }}" class="text-yellow-900 text-center py-3 rounded-lg">
                                ¡Regístrate para ver tus pedidos!
                            </a>
                        </span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div> 