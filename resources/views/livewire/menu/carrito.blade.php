<div>
    <!-- Botón del carrito -->
    <div x-data="{ animate: false }" x-on:carrito-actualizado.window="animate = true; setTimeout(() => animate = false, 500)" class="fixed top-[150px] right-4 z-50">
        <button wire:click="toggleCarrito" class="bg-[#FCD34D] text-[#1C1917] w-16 h-16 flex items-center justify-center rounded-full shadow-lg hover:bg-yellow-500 transition-colors relative active:scale-95 focus:outline-none focus:ring-4 focus:ring-yellow-300" aria-label="Abrir carrito">
            <i class="bi bi-cart3 text-2xl text-[#92400E]"></i>
            @if(count($productos) > 0)
                <span :class="animate ? 'animate-pop' : ''" class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center" aria-label="Cantidad de productos en el carrito">
                    {{ count($productos) }}
                </span>
            @endif
        </button>
    </div>

    <!-- Panel del carrito -->
    @if($mostrarCarrito)
        <div class="fixed inset-0 bg-black bg-opacity-50 z-40" wire:click="toggleCarrito" aria-label="Cerrar carrito"></div>
        <div class="fixed top-0 right-0 h-full w-full md:w-[35rem] bg-[#FFFFFF] shadow-xl z-50 overflow-y-auto" aria-label="Panel del carrito de compras">
            <div class="p-6">
                <!-- Encabezado -->
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-[#1C1917]">Tu pedido</h2>
                    <button wire:click="toggleCarrito" class="text-gray-500 hover:text-gray-700 active:scale-90 focus:outline-none focus:ring-2 focus:ring-gray-300 rounded-full p-2 transition-transform" aria-label="Cerrar panel del carrito">
                        <i class="bi bi-x text-2xl"></i>
                    </button>
                </div>

                <!-- Lista de productos -->
                <div class="space-y-4 mb-6">
                    @forelse($productos as $id => $producto)
                        <div class="flex items-center gap-4 p-4 bg-[#FFF8F0] rounded-lg border border-[#FCD34D]" aria-label="Producto en carrito">
                            @if($producto['imagen'])
                                <img src="{{ asset('storage/' . $producto['imagen']) }}" alt="Imagen de {{ $producto['nombre'] }}" class="w-20 h-20 object-cover rounded-lg">
                            @endif
                            <div class="flex-1">
                                <h3 class="font-semibold text-[#1C1917]">{{ ucfirst($producto['nombre']) }}</h3>
                                <p class="text-[#92400E] font-medium">{{ number_format($producto['precio'], 2, ',', '.') }} €</p>
                                <div class="flex items-center gap-2 mt-2">
                                    <button wire:click="actualizarCantidad({{ $id }}, {{ $producto['cantidad'] - 1 }})" class="text-gray-500 hover:text-gray-700 active:scale-90 transition-transform" aria-label="Reducir cantidad de {{ $producto['nombre'] }}">
                                        <i class="bi bi-dash-circle"></i>
                                    </button>
                                    <span class="w-8 text-center" aria-label="Cantidad actual">{{ $producto['cantidad'] }}</span>
                                    <button wire:click="actualizarCantidad({{ $id }}, {{ $producto['cantidad'] + 1 }})" class="text-gray-500 hover:text-gray-700 active:scale-90 transition-transform" aria-label="Aumentar cantidad de {{ $producto['nombre'] }}">
                                        <i class="bi bi-plus-circle"></i>
                                    </button>
                                </div>
                                <!-- Selección de peticiones especiales / marca de refrescos -->
                                <div>
                                    @if($producto['nombre'] == 'refrescos lata' || $producto['nombre'] == 'refrescos botella 1.5L')
                                        <select name="comentario" id="comentario" class="h-10 border-2 border-[#FCD34D] rounded-lg px-2 text-sm appearance-none w-[180px] mt-1" wire:change="actualizarComentario({{ $id }}, $event.target.value)" aria-label="Selecciona tipo de refresco para {{ $producto['nombre'] }}">
                                            <option value="">¿Qué refresco quieres?</option>
                                            <option value="Coca Cola">Coca Cola</option>
                                            <option value="Fanta">Fanta</option>
                                            <option value="Sprite">Sprite</option>
                                            <option value="Clipper de fresa">Clipper de fresa</option>
                                            <option value="Clipper de naranja">Clipper de naranja</option>
                                        </select>
                                    @else
                                        <textarea name="comentario" id="comentario" class="h-[75px] border-2 border-[#FCD34D] rounded-lg px-2 text-sm w-full mt-1" placeholder="¿Quieres quitar algún ingrediente? ¿Tienes alguna alergia? ¡Comentanos!" wire:change="actualizarComentario({{ $id }}, $event.target.value)" style="resize: none;" aria-label="Comentario adicional sobre {{ $producto['nombre'] }}">{{ $producto['comentario'] }}</textarea>
                                    @endif
                                </div>
                            </div>
                            <button wire:click="eliminarProducto({{ $id }})" class="text-red-500 hover:text-red-700 active:scale-90 transition-transform" aria-label="Eliminar {{ $producto['nombre'] }} del carrito">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    @empty
                        <p class="text-center text-[#1C1917] py-4" aria-label="Mensaje de carrito vacío">Tu carrito está vacío</p>
                    @endforelse
                </div>

                <!-- Total -->
                @if(count($productos) > 0)
                    <div class="border-t pt-4 border-[#FCD34D]">
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-lg font-semibold text-[#1C1917]">Total:</span>
                            <span class="text-xl font-bold text-[#92400E]">{{ number_format($total, 2, ',', '.') }} €</span>
                        </div>

                        <!-- Botones de acción -->
                        <div class="space-y-3">
                            <a href="{{ route('checkout') }}" class="block w-full bg-[#FCD34D] text-[#1C1917] text-center py-3 rounded-lg font-semibold hover:bg-yellow-500 transition-colors active:scale-95 focus:outline-none focus:ring-4 focus:ring-yellow-300" aria-label="Finalizar pedido y proceder al pago">
                                Finalizar pedido
                            </a>
                            <button wire:click="toggleCarrito" class="block w-full bg-[#D1FAE5] text-[#065F46] text-center py-3 rounded-lg font-semibold hover:bg-green-200 transition-colors">
                                Seguir comprando
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>
