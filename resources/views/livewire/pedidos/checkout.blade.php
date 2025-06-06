<div class="min-h-screen bg-[#FFF8F0] py-12"> 
    <div class="max-w-7xl mx-auto my-[100px] px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Resumen del pedido -->
            <div class="bg-[#FFFFFF] rounded-lg shadow-lg p-6 border border-[#FCD34D]">
                <div class="flex items-center gap-4 mb-1">
                    <x-icono-resumen-pedido width="50" height="50" />
                    <h2 class="text-xl font-bold text-[#92400E]">RESUMEN DE TU PEDIDO</h2>
                </div>
                
                <div class="space-y-4 mb-6">
                    @foreach($productos as $producto)
                        <div class="flex items-center gap-4">
                            @if($producto['imagen'])
                                <img src="{{ asset('storage/' . $producto['imagen']) }}" alt="{{ $producto['nombre'] }}" class="w-16 h-16 object-cover rounded-lg">
                            @endif
                            <div class="flex-1">
                                <h3 class="font-semibold text-[#1C1917]">{{ ucfirst($producto['nombre']) }}</h3>
                                <p class="text-sm text-[#1C1917]">Cantidad: {{ $producto['cantidad'] }}</p>
                                <p class="text-[#92400E] font-medium">{{ number_format($producto['precio'] * $producto['cantidad'], 2, ',', '.') }} €</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="border-t pt-4">
                    <div class="text-right mt-4">
                        <p class="text-sm text-[#1C1917]">Subtotal: {{ number_format($subtotal, 2, ',', '.') }} €</p>
                        @if($tipoEntrega === 'domicilio')
                            <p class="text-sm text-[#1C1917]">Entrega a domicilio: {{ number_format($recargoEntrega, 2, ',', '.') }} €</p>
                        @endif
                        <p class="text-sm text-[#1C1917]">IGIC (7%): {{ number_format($igic, 2, ',', '.') }} €</p>
                        <p class="text-lg font-semibold text-[#92400E]">Total: {{ number_format($total, 2, ',', '.') }} €</p>
                    </div>
                </div>
            </div>

            <!-- Formulario de entrega -->
            <div class="bg-[#FFFFFF] rounded-lg shadow-lg p-6 border border-[#FCD34D]">
                <div class="flex items-center gap-4 mb-1">
                    <x-icono-repartidor width="50" height="50" />
                    <h2 class="text-xl font-bold text-[#92400E]">DETALLES DE LA ENTREGA</h2>
                </div>
                <h4 class="text-lg mb-4 text-[#1C1917]">Por favor, rellena los siguientes datos.</h4>
                
                <form wire:submit.prevent="realizarPedido" class="space-y-6">
                    <!-- Tipo de entrega -->
                    <div>
                        <label class="block text-sm font-medium text-[#1C1917] mb-2">¿A domicilio o recogida en local?</label>
                        <div class="flex gap-4 text-[#1C1917]">
                            <label class="flex items-center">
                                <input type="radio" wire:model.live="tipoEntrega" value="domicilio" class="mr-2" style="accent-color: #FCD34D;">
                                <span>Entrega a domicilio</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" wire:model.live="tipoEntrega" value="local" class="mr-2" style="accent-color: #FCD34D;">
                                <span>Recoger en tienda</span>
                            </label>
                        </div>
                        @error('tipoEntrega') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Dirección -->
                    <div wire:key="address-field">
                        @if($tipoEntrega === 'domicilio')
                            <div>
                                <label for="direccion" class="block text-sm font-medium text-[#1C1917]">Dirección de entrega</label>
                                <div class="grid grid-cols-12 gap-2">
                                    @foreach(['calle' => 'Calle', 'numero' => 'Nº', 'piso' => 'Piso', 'puerta' => 'Puerta'] as $campo => $placeholder)
                                        <div class="col-span-{{ $campo === 'calle' ? '6' : '2' }}">
                                            <input type="text" wire:model.live="{{ $campo }}" id="{{ $campo }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-[#FCD34D] focus:border-[#FCD34D]" placeholder="{{ $placeholder }}" maxlength="{{ $campo === 'calle' ? '500' : '2' }}">
                                            @error($campo) <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Teléfono -->
                    <div>
                        <label for="telefono" class="block text-sm font-medium text-[#1C1917]">Teléfono de contacto</label>
                        <input type="tel" wire:model="telefono" id="telefono" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-[#FCD34D] focus:border-[#FCD34D]" placeholder="000000000" maxlength="9">
                        @error('telefono') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Forma de pago -->
                    @if($tipoEntrega === 'domicilio')
                        <div>
                            <label class="block text-sm font-medium text-[#1C1917] mb-2">Forma de pago</label>
                            <div class="flex gap-4 text-[#1C1917]">
                                <label class="flex items-center">
                                    <input type="radio" wire:model.live="formaPago" value="efectivo" class="mr-2" style="accent-color: #FCD34D;">
                                    <span>Efectivo</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" wire:model.live="formaPago" value="tarjeta" class="mr-2" style="accent-color: #FCD34D;">
                                    <span>Tarjeta</span>
                                </label>
                            </div>
                            @error('formaPago') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    @endif

                    <!-- Formulario tarjeta -->
                    @if($formaPago === 'tarjeta')
                        <div class="space-y-4 border-t pt-4">
                            @foreach([
                                ['id' => 'numeroTarjeta', 'label' => 'Número de Tarjeta', 'placeholder' => '1234 5678 9012 3456'],
                                ['id' => 'nombreTitular', 'label' => 'Nombre del Titular', 'placeholder' => 'Como aparece en la tarjeta']
                            ] as $field)
                                <div>
                                    <label for="{{ $field['id'] }}" class="block text-sm font-medium text-[#1C1917]">{{ $field['label'] }}</label>
                                    <input type="text" wire:model="{{ $field['id'] }}" id="{{ $field['id'] }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-[#FCD34D] focus:border-[#FCD34D]" placeholder="{{ $field['placeholder'] }}">
                                    @error($field['id']) <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                            @endforeach

                            <div class="grid grid-cols-2 gap-4">
                                @foreach([
                                    ['id' => 'fechaExpiracion', 'label' => 'Fecha de Expiración', 'placeholder' => 'MM/YY'],
                                    ['id' => 'cvv', 'label' => 'CVV', 'placeholder' => '123']
                                ] as $field)
                                    <div>
                                        <label for="{{ $field['id'] }}" class="block text-sm font-medium text-[#1C1917]">{{ $field['label'] }}</label>
                                        <input type="text" wire:model="{{ $field['id'] }}" id="{{ $field['id'] }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-[#FCD34D] focus:border-[#FCD34D]" placeholder="{{ $field['placeholder'] }}">
                                        @error($field['id']) <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Observaciones -->
                    <div>
                        <label for="observaciones" class="block text-sm font-medium text-[#1C1917]">Observaciones</label>
                        <textarea wire:model="observaciones" id="observaciones" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-[#FCD34D] focus:border-[#FCD34D]" placeholder="¿Tienes alguna instrucción especial para la entrega? ¡Cuéntanoslo!" maxlength="1000"></textarea>
                    </div>

                    <!-- Botones -->
                    <div class="flex gap-4">
                        <a href="{{ route('menu') }}" class="flex-1 bg-gray-200 text-[#1C1917] text-center py-3 rounded-lg font-semibold hover:bg-gray-300 transition-colors">
                            Volver al menú
                        </a>
                        <button type="submit" class="flex-1 bg-[#FCD34D] text-[#1C1917] text-center py-3 rounded-lg font-semibold hover:bg-[#FCD34D]/90 transition-colors">
                            Realizar pedido
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
