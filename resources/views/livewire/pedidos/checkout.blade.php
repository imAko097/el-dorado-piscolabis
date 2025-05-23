<div class="min-h-screen bg-yellow-50 py-12">
    <div class="max-w-7xl mx-auto my-[100px] px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Resumen del pedido -->
            <div class="bg-white rounded-lg shadow-lg p-6 border border-yellow-300">
                <div class="flex items-center gap-4 mb-1">
                    <x-icono-resumen-pedido width="50" height="50" />
                    <h2 class="text-xl font-bold">RESUMEN DE TU PEDIDO</h2>
                </div>
                
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
                        @if($tipoEntrega === 'domicilio')
                            <p class="text-sm text-gray-600">Entrega a domicilio: {{ number_format($recargoEntrega, 2, ',', '.') }} €</p>
                        @endif
                        <p class="text-sm text-gray-600">IGIC (7%): {{ number_format($igic, 2, ',', '.') }} €</p>
                        <p class="text-lg font-semibold text-yellow-600">Total: {{ number_format($total, 2, ',', '.') }} €</p>
                    </div>
                </div>
            </div>

            <!-- Formulario de entrega -->
            <div class="bg-white rounded-lg shadow-lg p-6 border border-yellow-300">
                <div class="flex items-center gap-4 mb-1">
                    <x-icono-repartidor width="50" height="50" />
                    <h2 class="text-xl font-bold">DETALLES DE LA ENTREGA</h2>
                </div>
                <h4 class="text-lg mb-4">Por favor, rellena los siguientes datos.</h4>
                
                <form wire:submit.prevent="realizarPedido" class="space-y-6">
                    <!-- Tipo de entrega -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">¿A domicilio o recogida en local?</label>
                        <div class="flex gap-4">
                            <label class="flex items-center">
                                <input type="radio" wire:model.live="tipoEntrega" value="domicilio" class="mr-2" style="accent-color: #fbec96;">
                                <span>Entrega a domicilio</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" wire:model.live="tipoEntrega" value="local" class="mr-2" style="accent-color: #fbec96;">
                                <span>Recoger en tienda</span>
                            </label>
                        </div>
                        @error('tipoEntrega') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Dirección -->
                    <div wire:key="address-field">
                        @if($tipoEntrega === 'domicilio')
                            <div>
                                <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección de entrega</label>
                                <div class="grid grid-cols-12 gap-2">
                                    <div class="col-span-6">
                                        <input type="text" wire:model.live="calle" id="calle" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500" placeholder="Calle" maxlength="500">
                                        @error('calle') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-span-2">
                                        <input type="text" wire:model.live="numero" id="numero" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500" placeholder="Nº" maxlength="2">
                                        @error('numero') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-span-2">
                                        <input type="text" wire:model.live="piso" id="piso" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500" placeholder="Piso" maxlength="2">
                                        @error('piso') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-span-2">
                                        <input type="text" wire:model.live="puerta" id="puerta" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500" placeholder="Puerta" maxlength="2">
                                        @error('puerta') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Teléfono -->
                    <div>
                        <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono de contacto</label>
                        <input type="tel" wire:model="telefono" id="telefono" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500" placeholder="000000000" maxlength="9">
                        @error('telefono') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Forma de pago -->
                    @if($tipoEntrega === 'domicilio')
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Forma de pago</label>
                            <div class="flex gap-4">
                                <label class="flex items-center">
                                    <input type="radio" wire:model.live="formaPago" value="efectivo" class="mr-2" style="accent-color: #fbec96;">
                                    <span>Efectivo</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" wire:model.live="formaPago" value="tarjeta" class="mr-2" style="accent-color: #fbec96;">
                                    <span>Tarjeta</span>
                                </label>
                            </div>
                            @error('formaPago') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    @endif
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
                        <textarea wire:model="observaciones" id="observaciones" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500" placeholder="¿Tienes alguna instrucción especial para la entrega? ¡Cuéntanoslo!" maxlength="1000"></textarea>
                    </div>

                    <!-- Botones -->
                    <div class="flex gap-4">
                        <a href="{{ route('menu') }}" class="flex-1 bg-gray-200 text-gray-700 text-center py-3 rounded-lg font-semibold hover:bg-gray-300 transition-colors">
                            Volver al menú
                        </a>
                        <button type="submit" class="flex-1 bg-yellow-400 text-black text-center py-3 rounded-lg font-semibold hover:bg-yellow-500 transition-colors">
                            Realizar pedido
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 