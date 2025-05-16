<div>
    <div class="mt-4 text-right">
        <button
            wire:click="showModal"
            class="px-4 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition"
        >
            Ver detalles
        </button>
    </div>

    @if ($showForm)
    <div class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-3xl p-6 relative">
            <button wire:click="$set('showForm', false)" class="absolute top-3 right-3 text-gray-500 hover:text-red-500">
                ✕
            </button>

            <h2 class="text-xl font-bold mb-4">Detalles del Pedido #{{ $pedido->id }}</h2>

            @if($pedido)
                <p><strong>Cliente:</strong> {{ $pedido->usuario->name }}</p>
                <p><strong>Estado:</strong> {{ ucfirst($pedido->estadoPedido->estado) }}</p>
                <p><strong>Total:</strong> {{ number_format($pedido->total, 2) }} €</p>
                <p><strong>Fecha:</strong> {{ $pedido->created_at->format('d/m/Y H:i') }}</p>

                <h3 class="text-lg font-semibold mt-6 mb-2">Productos:</h3>
                <table class="w-full text-sm table-auto border-collapse">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="p-2 text-left">Producto</th>
                            <th class="p-2 text-left">Comentario</th>
                            <th class="p-2 text-right">Cantidad</th>
                            <th class="p-2 text-right">Precio Unitario</th>
                            <th class="p-2 text-right">Precio Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pedido->productos as $item)
                            <tr class="border-t">
                                <td class="p-2">{{ $item->nombre ?? 'Producto #' . $item->id_producto }}</td>
                                <td class="p-2">{{ $item->pivot->comentario }}</td>
                                <td class="p-2 text-right">{{ $item->pivot->cantidad }}</td>
                                <td class="p-2 text-right">{{ number_format($item->pivot->precio_unitario, 2) }} €</td>
                                <td class="p-2 text-right">{{ number_format($item->pivot->precio_total, 2) }} €</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-center text-gray-500">No se pudo cargar el pedido.</p>
            @endif
        </div>
    </div>
    @endif
</div>
