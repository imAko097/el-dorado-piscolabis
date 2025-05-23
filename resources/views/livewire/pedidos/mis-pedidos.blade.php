<div class="min-h-screen bg-[#FFF8F0] py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('inicio') }}"
           class="text-[#6B7280] flex items-center gap-2 mb-4 hover:text-[#1C1917] hover:underline transition-colors">
            <i class="bi bi-arrow-left"></i>
            Volver
        </a>

        <div class="bg-white rounded-lg shadow-lg p-6">
            <h1 class="text-3xl font-bold text-[#92400E] mb-8">Mis Pedidos</h1>

            @if($this->pedidos->isEmpty())
                <div class="text-center py-12">
                    <p class="text-[#6B7280] text-lg">No tienes pedidos realizados.</p>
                    <a href="{{ route('menu') }}"
                       class="inline-block mt-4 bg-[#FBBF24] text-[#1C1917] px-6 py-3 rounded-lg font-semibold hover:bg-[#FACC15] transition-colors">
                        Ver Menú
                    </a>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($this->pedidos as $pedido)
                        <div class="border border-[#FCD34D] rounded-lg overflow-hidden" x-data="{ open: false }">
                            <div class="p-4 cursor-pointer hover:bg-[#FFFBEB] transition-colors" @click="open = !open">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <h2 class="text-xl font-semibold text-[#B45309]">Pedido #{{ $pedido->id }}</h2>
                                        <p class="text-[#6B7280]">Realizado el {{ $pedido->created_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <span class="px-4 py-2 rounded-full text-sm font-semibold
                                            @if($pedido->estadoPedido->estado === 'recibido') bg-blue-100 text-blue-800
                                            @elseif($pedido->estadoPedido->estado === 'en preparación') bg-[#FDE68A] text-[#92400E]
                                            @elseif($pedido->estadoPedido->estado === 'en camino') bg-[#FBCFE8] text-[#9D174D]
                                            @elseif($pedido->estadoPedido->estado === 'listo para recoger') bg-[#CFFAFE] text-[#155E75]
                                            @elseif($pedido->estadoPedido->estado === 'entregado') bg-green-100 text-green-800
                                            @elseif($pedido->estadoPedido->estado === 'cancelado') bg-red-100 text-red-800
                                            @else bg-gray-100 text-gray-800
                                            @endif">
                                            {{ ucfirst($pedido->estadoPedido->estado) }}
                                        </span>
                                        <svg class="w-6 h-6 transform transition-transform" :class="{ 'rotate-180': open }" fill="none"
                                             stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div class="border-t bg-[#FFFBEB]" x-show="open"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 transform -translate-y-2"
                                 x-transition:enter-end="opacity-100 transform translate-y-0"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 transform translate-y-0"
                                 x-transition:leave-end="opacity-0 transform -translate-y-1">
                                <div class="p-6 space-y-4 text-[#1C1917]">
                                    <div>
                                        <h3 class="font-semibold mb-2">Productos:</h3>
                                        <div class="space-y-2">
                                            @foreach($pedido->productos as $producto)
                                                <div class="flex justify-between items-center">
                                                    <span>{{ ucfirst($producto->nombre) }} x{{ $producto->pivot->cantidad }}</span>
                                                    <span class="text-[#B45309]">{{ number_format($producto->pivot->precio_total, 2, ',', '.') }} €</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div>
                                        <h3 class="font-semibold mb-2">Detalles de Entrega:</h3>
                                        <div class="space-y-1 text-[#6B7280]">
                                            @if($pedido->direccion)
                                                <p><span class="font-medium">Dirección:</span> {{ $pedido->direccion }}</p>
                                            @else
                                                <p>Recoger en tienda</p>
                                            @endif
                                            <p><span class="font-medium">Teléfono:</span> {{ $pedido->telefono_contacto }}</p>
                                            <p><span class="font-medium">Forma de Pago:</span> {{ ucfirst($pedido->forma_pago) }}</p>
                                        </div>
                                    </div>

                                    <div class="border-t pt-4">
                                        <div class="space-y-2">
                                            @php
                                                $subtotalConIgic = $pedido->productos->sum(fn($producto) => $producto->pivot->precio_total);
                                                $subtotalSinIgic = $subtotalConIgic / 1.07;
                                                $recargo = $pedido->direccion ? 1.50 : 0;
                                                $baseImponible = $subtotalSinIgic + $recargo;
                                                $igic = $baseImponible * 0.07;
                                                $totalCalculado = $baseImponible + $igic;
                                            @endphp
                                            <div class="flex justify-between items-center text-[#6B7280]">
                                                <span>Subtotal:</span>
                                                <span>{{ number_format($subtotalSinIgic, 2, ',', '.') }} €</span>
                                            </div>
                                            @if($pedido->direccion)
                                                <div class="flex justify-between items-center text-[#6B7280]">
                                                    <span>Recargo entrega:</span>
                                                    <span>{{ number_format($recargo, 2, ',', '.') }} €</span>
                                                </div>
                                            @endif
                                            <div class="flex justify-between items-center text-[#6B7280]">
                                                <span>IGIC (7%):</span>
                                                <span>{{ number_format($igic, 2, ',', '.') }} €</span>
                                            </div>
                                            <div class="flex justify-between items-center">
                                                <span class="text-lg font-semibold text-[#92400E]">Total:</span>
                                                <span class="text-xl font-bold text-[#B45309]">{{ number_format($totalCalculado, 2, ',', '.') }} €</span>
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
