@extends('layouts.admin')

@section('page-title', 'Productos')
@section('page-description', 'Administración de productos')
@section('styles')
<script src="https://cdn.tailwindcss.com"></script>
@endsection

@section('content')

<div class="max-w-7xl mx-auto p-4 py-6">
    @livewire('productos.producto-form')

    <div class="overflow-x-auto bg-white rounded-lg shadow-sm">
        <table class="min-w-full text-sm text-left text-gray-700">
            <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-4 py-3 w-10">#</th>
                    <th class="px-4 py-3">Nombre</th>
                    <th class="px-4 py-3">Ingredientes</th>
                    <th class="px-4 py-3">Tipo de Producto</th>
                    <th class="px-4 py-3">Imagen</th>
                    <th class="px-4 py-3">Precio</th>
                    <th class="px-4 py-3">Stock</th>
                    <th class="px-4 py-3 w-10 text-right"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @if (isset($productos) && count($productos) > 0)
                @php $i = 1; @endphp
                @foreach ($productos as $producto)
                <tr class="hover:bg-gray-50">
                    <th class="px-4 py-2 font-medium text-gray-800 whitespace-nowrap">{{ $i }}</th>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $producto->nombre }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $producto->ingredientes }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $producto->tipo ? $producto->tipo->tipo : 'Sin tipo' }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">
                        @if ($producto->imagen)
                        <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="w-16 h-16 object-cover rounded">
                        @else
                        Sin imagen
                        @endif
                    </td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $producto->precio }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $producto->stock }}</td>

                    <td class="px-4 py-2 text-right whitespace-nowrap">
                    </td>
                </tr>
                @php $i++; @endphp
                @endforeach
                @else
                <tr>
                    <td colspan="6" class="px-4 py-4 text-center text-gray-500">
                        No hay productos disponibles.
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
