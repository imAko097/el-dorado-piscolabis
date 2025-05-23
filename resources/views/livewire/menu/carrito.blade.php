<div>
    <!-- Botón del carrito -->
    <div x-data="{ animate: false }" x-on:carrito-actualizado.window="animate = true; setTimeout(() => animate = false, 500)" class="fixed top-[150px] right-4 z-50">
        <button wire:click="toggleCarrito" class="bg-yellow-400 text-black p-3 rounded-full shadow-lg hover:bg-yellow-500 transition-colors relative">
            <i class="bi bi-cart3 text-2xl"></i>
            @if(count($productos) > 0)
                <span :class="animate ? 'animate-pop' : ''" class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                    {{ count($productos) }}
                </span>
            @endif
        </button>
    </div>
    
    <!-- Panel del carrito -->
    @if($mostrarCarrito)
        <div class="fixed inset-0 bg-black bg-opacity-50 z-40" wire:click="toggleCarrito"></div>
        <div class="fixed top-0 right-0 h-full w-full md:w-[35rem] bg-white shadow-xl z-50 overflow-y-auto">
            <div class="p-6">
                <!-- Encabezado -->
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Tu pedido</h2>
                    <button wire:click="toggleCarrito" class="text-gray-500 hover:text-gray-700">
                        <i class="bi bi-x text-2xl"></i>
                    </button>
                </div>

                <!-- Lista de productos -->
                <div class="space-y-4 mb-6">
                    @forelse($productos as $id => $producto)
                        <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg">
                            @if($producto['imagen'])
                                <img src="{{ asset('storage/' . $producto['imagen']) }}" alt="{{ $producto['nombre'] }}" class="w-20 h-20 object-cover rounded-lg">
                            @endif
                            <div class="flex-1">
                                <h3 class="font-semibold">{{ ucfirst($producto['nombre']) }}</h3>
                                <p class="text-yellow-600 font-medium">{{ number_format($producto['precio'], 2, ',', '.') }} €</p>
                                <div class="flex items-center gap-2 mt-2">
                                    <button wire:click="actualizarCantidad({{ $id }}, {{ $producto['cantidad'] - 1 }})" class="text-gray-500 hover:text-gray-700">
                                        <i class="bi bi-dash-circle"></i>
                                    </button>
                                    <span class="w-8 text-center">{{ $producto['cantidad'] }}</span>
                                    <button wire:click="actualizarCantidad({{ $id }}, {{ $producto['cantidad'] + 1 }})" class="text-gray-500 hover:text-gray-700">
                                        <i class="bi bi-plus-circle"></i>
                                    </button>
                                </div>
                                <!-- Selección de peticiones especiales / marca de refrescos -->
                                <div>
                                    <textarea name="comentario" id="comentario" class="h-[75px] border-2 border-gray-300 rounded-lg px-2 text-sm w-full mt-1" placeholder="¿Quieres quitar algún ingrediente? ¿Tienes alguna alergia? ¡Comentanos!" wire:change="actualizarComentario({{ $id }}, $event.target.value)" style="resize: none;">{{ $producto['comentario'] }}</textarea>
                                </div>
                            </div>
                            <button wire:click="eliminarProducto({{ $id }})" class="text-red-500 hover:text-red-700">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    @empty
                        <p class="text-center text-gray-500 py-4">Tu carrito está vacío</p>
                    @endforelse
                </div>

                <!-- Total -->
                @if(count($productos) > 0)
                    <div class="border-t pt-4">
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-lg font-semibold">Total:</span>
                            <span class="text-xl font-bold text-yellow-600">{{ number_format($total, 2, ',', '.') }} €</span>
                        </div>

                        <!-- Botones de acción -->
                        <div class="space-y-3">
                            <a href="{{ route('checkout') }}" class="block w-full bg-yellow-400 text-black text-center py-3 rounded-lg font-semibold hover:bg-yellow-500 transition-colors">
                                Finalizar pedido
                            </a>
                            <button wire:click="toggleCarrito" class="block w-full bg-gray-200 text-gray-700 text-center py-3 rounded-lg font-semibold hover:bg-gray-300 transition-colors">
                                Seguir comprando
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>