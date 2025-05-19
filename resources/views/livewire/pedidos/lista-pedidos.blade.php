<div>
    <div class="flex flex-wrap gap-3 justify-center mb-6">
        @php
            $estadosDisponibles = collect(['pendientes'])->merge($estados->pluck('estado')->map(fn($e) => strtolower($e)));
        @endphp

        @foreach($estadosDisponibles as $estado)
            <button wire:click="toggleFiltroEstado('{{ $estado }}')"
                class="px-4 py-2 rounded-full transition duration-200
                {{ in_array($estado, $filtroEstados) ? 'bg-gray-500 text-white font-semibold' : 'bg-gray-300 hover:bg-gray-400 text-gray-800' }}">
                {{ ucfirst($estado) }}
            </button>
        @endforeach
    </div>

    @if (!empty($filtroEstados))
        <button wire:click="$set('filtroEstados', ['pendientes'])"
                class="mb-4 px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium rounded-lg shadow transition">
            Limpiar filtros
        </button>
    @endif

    <div wire:poll.5s>
        @if($pedidos->count() > 0)
            <div class="grid grid-cols-1 gap-6 mt-6">
                @foreach ($pedidos as $pedido)
                    @php
                        $estado = $pedido->estadoPedido->estado;
                        $color = app('App\\Livewire\\Pedidos\\ListaPedidos')->getColorEstado($estado);
                    @endphp

                    <div class="bg-white rounded-2xl shadow-md p-6 transition hover:shadow-lg">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xl font-semibold text-gray-800">Pedido #{{ $pedido->id }}</h3>
                            <span class="px-3 py-1 rounded-full text-sm font-medium {{ $color }}">
                                {{ ucfirst($estado) }}
                            </span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700 text-sm">
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" stroke-width="1.5"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 8c1.656 0 3-1.344 3-3S13.656 2 12 2 9 3.344 9 5s1.344 3 3 3zM3 20h18M3 20a9 9 0 0118 0"/>
                                </svg>
                                <span><strong>Cliente:</strong> {{ $pedido->usuario->name }}</span>
                            </div>

                            <div class="flex items-center space-x-2">
                                <span><strong>Total:</strong> {{ number_format($pedido->total, 2) }} €</span>
                            </div>

                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" stroke-width="1.5"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span><strong>Fecha:</strong> {{ $pedido->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>

                        <div class="mt-4">
                            <label for="estado-select-{{ $pedido->id }}" class="block text-sm font-medium text-gray-600 mb-1">
                                Cambiar estado:
                            </label>
                            <select
                                id="estado-select-{{ $pedido->id }}"
                                wire:change="cambiarEstado({{ $pedido->id }}, $event.target.value)"
                                class="w-full md:w-1/2 px-4 py-2 text-sm border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >
                                @foreach($estados as $estadoItem)
                                    <option
                                        value="{{ $estadoItem->id }}"
                                        @selected($pedido->id_estado_pedido == $estadoItem->id)
                                    >
                                        {{ ucfirst($estadoItem->estado) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4 text-right">
                            <button
                                wire:click="mostrarDetalles({{ $pedido->id }})"
                                class="mt-4 px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg shadow">
                                Ver detalles
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500 text-center mt-10">No tienes pedidos.</p>
        @endif
    </div>

    @if ($pedidoSeleccionado)
        <div class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
            <div class="bg-white rounded-2xl shadow-xl w-full max-w-3xl p-6 relative">
                <button wire:click="cerrarModal" class="absolute top-3 right-3 text-gray-500 hover:text-red-500 text-lg font-bold">
                    ✕
                </button>

                <h2 class="text-xl font-bold mb-4">Detalles del Pedido #{{ $pedidoSeleccionado->id }}</h2>

                <div class="space-y-2 text-gray-700 text-sm">
                    <p><strong>Cliente:</strong> {{ $usuario->name }}</p>
                    <p><strong>Estado:</strong> {{ ucfirst($pedidoSeleccionado->estadoPedido->estado) }}</p>
                    <p><strong>Fecha:</strong> {{ $pedidoSeleccionado->created_at->format('d/m/Y H:i') }}</p>
                </div>

                <h3 class="text-lg font-semibold mt-6 mb-2">Productos:</h3>
                <table class="w-full text-sm table-auto border-collapse mb-4">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700">
                            <th class="p-2 text-left">Producto</th>
                            <th class="p-2 text-left">Comentario</th>
                            <th class="p-2 text-right">Cantidad</th>
                            <th class="p-2 text-right">Precio Unitario</th>
                            <th class="p-2 text-right">Precio Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($productos as $item)
                            <tr class="border-t text-gray-700">
                                <td class="p-2">{{ $item->nombre ?? 'Producto #' . $item->id }}</td>
                                <td class="p-2">{{ $item->pivot->comentario ?? '-' }}</td>
                                <td class="p-2 text-right">{{ $item->pivot->cantidad ?? '-' }}</td>
                                <td class="p-2 text-right">{{ isset($item->pivot->precio_unitario) ? number_format($item->pivot->precio_unitario, 2) . ' €' : '-' }}</td>
                                <td class="p-2 text-right">{{ isset($item->pivot->precio_total) ? number_format($item->pivot->precio_total, 2) . ' €' : '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @php
                    $total = $pedidoSeleccionado->total;
                    $igic = $total * 0.07;
                    $subtotal = $total - $igic;
                @endphp

                <div class="border-t pt-4 mt-4 text-right space-y-1 text-sm text-gray-800">
                    <p><strong>Subtotal:</strong> {{ number_format($subtotal, 2) }} €</p>
                    <p><strong>IGIC (7%):</strong> {{ number_format($igic, 2) }} €</p>
                    <p class="text-lg font-bold"><strong>Total:</strong> {{ number_format($total, 2) }} €</p>
                </div>
            </div>
        </div>
    @endif
</div>
