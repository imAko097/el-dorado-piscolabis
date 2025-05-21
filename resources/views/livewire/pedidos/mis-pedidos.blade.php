<div class="min-h-screen bg-gray-100 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h1 class="text-3xl font-bold mb-8">Mis Pedidos</h1>

            @if($this->pedidos->isEmpty())
                <div class="text-center py-12">
                    <p class="text-gray-500 text-lg">No tienes pedidos realizados.</p>
                    <a href="{{ route('menu') }}" class="inline-block mt-4 bg-yellow-400 text-black px-6 py-3 rounded-lg font-semibold hover:bg-yellow-500 transition-colors">
                        Ver Menú
                    </a>
                </div>
            @else
                <div class="space-y-6">
                    @foreach($this->pedidos as $pedido)
                        <div class="border rounded-lg p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h2 class="text-xl font-semibold">Pedido #{{ $pedido->id }}</h2>
                                    <p class="text-gray-600">Realizado el {{ $pedido->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                                <span class="px-4 py-2 rounded-full text-sm font-semibold
                                    @if($pedido->estadoPedido->estado === 'recibido') bg-yellow-100 text-yellow-800
                                    @elseif($pedido->estadoPedido->estado === 'en preparación') bg-blue-100 text-blue-800
                                    @elseif($pedido->estadoPedido->estado === 'en camino') 
                                    @elseif($pedido->estadoPedido->estado === 'entregado') bg-green-100 text-green-800
                                    @elseif($pedido->estadoPedido->estado === 'cancelado') bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst($pedido->estadoPedido->estado) }}
                                </span>
                            </div>

                            <div class="space-y-4">
                                <!-- Productos -->
                                <div>
                                    <h3 class="font-semibold mb-2">Productos:</h3>
                                    <div class="space-y-2">
                                        @foreach($pedido->productos as $producto)
                                            <div class="flex justify-between items-center">
                                                <span>{{ $producto->nombre }} x{{ $producto->pivot->cantidad }}</span>
                                                <span class="text-yellow-600">{{ number_format($producto->pivot->precio_total, 2, ',', '.') }} €</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Detalles de entrega -->
                                <div>
                                    <h3 class="font-semibold mb-2">Detalles de Entrega:</h3>
                                    <div class="space-y-1 text-gray-600">
                                        @if($pedido->direccion)
                                            <p><span class="font-medium">Dirección:</span> {{ $pedido->direccion }}</p>
                                        @else
                                            <p>Recoger en tienda</p>
                                        @endif
                                        <p><span class="font-medium">Teléfono:</span> {{ $pedido->telefono_contacto }}</p>
                                        <p><span class="font-medium">Forma de Pago:</span> {{ ucfirst($pedido->forma_pago) }}</p>
                                    </div>
                                </div>

                                <!-- Total -->
                                <div class="border-t pt-4">
                                    <div class="flex justify-between items-center">
                                        <span class="text-lg font-semibold">Total:</span>
                                        <span class="text-xl font-bold text-yellow-600">{{ number_format($pedido->total, 2, ',', '.') }} €</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div> 