<div class="min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('inicio') }}"
            class="text-gray-500 flex items-center gap-2 mb-4 hover:text-black hover:underline transition-colors">
            <i class="bi bi-arrow-left"></i>
            Volver
        </a>
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
                <div class="space-y-4">
                    @foreach($this->pedidos as $pedido)
                        <div class="border rounded-lg overflow-hidden" x-data="{ open: false }">
                            <!-- Header del pedido (siempre visible) -->
                            <div class="p-4 cursor-pointer hover:bg-gray-50 transition-colors" @click="open = !open">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <h2 class="text-xl font-semibold">Pedido #{{ $pedido->id }}</h2>
                                        <p class="text-gray-600">Realizado el {{ $pedido->created_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <span class="px-4 py-2 rounded-full text-sm font-semibold
                                            @if($pedido->estadoPedido->estado === 'recibido') bg-blue-100 text-blue-800
                                            @elseif($pedido->estadoPedido->estado === 'en preparación') bg-yellow-100 text-yellow-800
                                            @elseif($pedido->estadoPedido->estado === 'en camino') bg-fuchsia-100 text-fuchsia-800
                                            @elseif($pedido->estadoPedido->estado === 'listo para recoger') bg-cyan-100 text-cyan-800
                                            @elseif($pedido->estadoPedido->estado === 'entregado') bg-green-100 text-green-800
                                            @elseif($pedido->estadoPedido->estado === 'cancelado') bg-red-100 text-red-800
                                            @else bg-gray-100 text-gray-800
                                            @endif">
                                            {{ ucfirst($pedido->estadoPedido->estado) }}
                                        </span>
                                        <svg class="w-6 h-6 transform transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Contenido colapsable -->
                            <div class="border-t" x-show="open" x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 transform -translate-y-2"
                                x-transition:enter-end="opacity-100 transform translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 transform translate-y-0"
                                x-transition:leave-end="opacity-0 transform -translate-y-1">
                                <div class="p-6 space-y-4">
                                    <!-- Productos -->
                                    <div>
                                        <h3 class="font-semibold mb-2">Productos:</h3>
                                        <div class="space-y-2">
                                            @foreach($pedido->productos as $producto)
                                                <div class="flex justify-between items-center">
                                                    <span>{{ ucfirst($producto->nombre) }} x{{ $producto->pivot->cantidad }}</span>
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
                                        <div class="space-y-2">
                                            @php
                                                // Sumamos los precios totales de los productos (IGIC incluido)
                                                $subtotalConIgic = $pedido->productos->sum(function($producto) {
                                                    return $producto->pivot->precio_total;
                                                });
                                                
                                                // Extraemos el IGIC del subtotal
                                                $subtotalSinIgic = $subtotalConIgic / 1.07;
                                                
                                                // Añadimos el recargo de entrega si es a domicilio
                                                $recargo = $pedido->direccion ? 1.50 : 0;
                                                
                                                // Calculamos la base imponible
                                                $baseImponible = $subtotalSinIgic + $recargo;
                                                
                                                // Calculamos el IGIC sobre la base imponible
                                                $igic = $baseImponible * 0.07;
                                                
                                                // El total final es la base imponible + IGIC
                                                $totalCalculado = $baseImponible + $igic;
                                            @endphp
                                            <div class="flex justify-between items-center">
                                                <span class="text-gray-600">Subtotal:</span>
                                                <span class="text-gray-600">{{ number_format($subtotalSinIgic, 2, ',', '.') }} €</span>
                                            </div>
                                            @if($pedido->direccion)
                                                <div class="flex justify-between items-center">
                                                    <span class="text-gray-600">Recargo entrega:</span>
                                                    <span class="text-gray-600">{{ number_format($recargo, 2, ',', '.') }} €</span>
                                                </div>
                                            @endif
                                            <div class="flex justify-between items-center">
                                                <span class="text-gray-600">IGIC (7%):</span>
                                                <span class="text-gray-600">{{ number_format($igic, 2, ',', '.') }} €</span>
                                            </div>
                                            <div class="flex justify-between items-center">
                                                <span class="text-lg font-semibold">Total:</span>
                                                <span class="text-xl font-bold text-yellow-600">{{ number_format($totalCalculado, 2, ',', '.') }} €</span>
                                            </div>
                                        </div>
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