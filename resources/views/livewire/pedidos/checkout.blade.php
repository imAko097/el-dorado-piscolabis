<div class="min-h-screen bg-gray-100 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Resumen del pedido -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-2xl font-bold mb-6">Resumen del Pedido</h2>
                
                <!-- Lista de productos -->
                <div class="space-y-4 mb-6">
                    @foreach($productos as $producto)
                        <div class="flex items-center gap-4">
                            @if($producto['imagen'])
                                <img src="{{ asset('storage/' . $producto['imagen']) }}" alt="{{ $producto['nombre'] }}" class="w-16 h-16 object-cover rounded-lg">
                            @endif
                            <div class="flex-1">
                                <h3 class="font-semibold">{{ ucfirst($producto['nombre']) }}</h3>
                                <p class="text-sm text-gray-600">Cantidad: {{ $producto['cantidad'] }}</p>
                                <p class="text-yellow-600 font-medium">{{ number_format($producto['precio'] * $producto['cantidad'], 2, ',', '.') }} €</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Total -->
                <div class="border-t pt-4">
                    <div class="text-right mt-4">
                        <p class="text-sm text-gray-600">Subtotal: {{ number_format($subtotal, 2, ',', '.') }} €</p>
                        <p class="text-sm text-gray-600">IGIC incluido (7%): {{ number_format($igic, 2, ',', '.') }} €</p>
                        <p class="text-lg font-semibold">Total: {{ number_format($total, 2, ',', '.') }} €</p>
                    </div>
                </div>
            </div>

            <!-- Formulario de entrega -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-2xl font-bold mb-6">Detalles de Entrega</h2>
                
                <form wire:submit.prevent="realizarPedido" class="space-y-6">
                    <!-- Tipo de entrega -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tipo de Entrega</label>
                        <div class="flex gap-4">
                            <label class="flex items-center">
                                <input type="radio" wire:model.live="tipoEntrega" value="domicilio" class="mr-2">
                                <span>Entrega a Domicilio</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" wire:model.live="tipoEntrega" value="local" class="mr-2">
                                <span>Recoger en Tienda</span>
                            </label>
                        </div>
                        @error('tipoEntrega') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Dirección -->
                    <div wire:key="address-field">
                        @if($tipoEntrega === 'domicilio')
                            <div>
                                <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección de Entrega</label>
                                <input type="text" wire:model.live="direccion" id="direccion" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500">
                                @error('direccion') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        @endif
                    </div>

                    <!-- Teléfono -->
                    <div>
                        <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono de Contacto</label>
                        <input type="tel" wire:model="telefono" id="telefono" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500">
                        @error('telefono') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Forma de pago -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Forma de Pago</label>
                        <div class="flex gap-4">
                            <label class="flex items-center">
                                <input type="radio" wire:model.live="formaPago" value="efectivo" class="mr-2">
                                <span>Efectivo</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" wire:model.live="formaPago" value="tarjeta" class="mr-2">
                                <span>Tarjeta</span>
                            </label>
                        </div>
                        @error('formaPago') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Formulario de tarjeta -->
                    <div wire:key="card-form">
                        @if($formaPago === 'tarjeta')
                            <div class="space-y-4 border-t pt-4">
                                <div>
                                    <label for="numeroTarjeta" class="block text-sm font-medium text-gray-700">Número de Tarjeta</label>
                                    <input type="text" wire:model="numeroTarjeta" id="numeroTarjeta" maxlength="16" placeholder="1234 5678 9012 3456" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500">
                                    @error('numeroTarjeta') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label for="nombreTitular" class="block text-sm font-medium text-gray-700">Nombre del Titular</label>
                                    <input type="text" wire:model="nombreTitular" id="nombreTitular" placeholder="Como aparece en la tarjeta" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500">
                                    @error('nombreTitular') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="fechaExpiracion" class="block text-sm font-medium text-gray-700">Fecha de Expiración</label>
                                        <input type="text" wire:model="fechaExpiracion" id="fechaExpiracion" placeholder="MM/YY" maxlength="5" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500">
                                        @error('fechaExpiracion') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    </div>

                                    <div>
                                        <label for="cvv" class="block text-sm font-medium text-gray-700">CVV</label>
                                        <input type="text" wire:model="cvv" id="cvv" maxlength="3" placeholder="123" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500">
                                        @error('cvv') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Observaciones -->
                    <div>
                        <label for="observaciones" class="block text-sm font-medium text-gray-700">Observaciones</label>
                        <textarea wire:model="observaciones" id="observaciones" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500"></textarea>
                    </div>

                    <!-- Botones -->
                    <div class="flex gap-4">
                        <a href="{{ route('menu') }}" class="flex-1 bg-gray-200 text-gray-700 text-center py-3 rounded-lg font-semibold hover:bg-gray-300 transition-colors">
                            Volver al Menú
                        </a>
                        <button type="submit" class="flex-1 bg-yellow-400 text-black text-center py-3 rounded-lg font-semibold hover:bg-yellow-500 transition-colors">
                            Realizar Pedido
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 