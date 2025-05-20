@extends('layouts.admin')

@section('page-title', 'Productos')
@section('page-description', 'Administración de productos')

@php
    use Illuminate\Support\Str;
@endphp

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <ul class="flex flex-wrap justify-center gap-4 mb-6 mt-4">
        <li>
            <a href="{{ route('productos.index') }}"
            class="px-4 py-2 rounded-full transition duration-200 {{ request('categoria') ? 'bg-gray-300 hover:bg-gray-400 text-gray-800' : 'bg-gray-500 text-white font-semibold' }}">
                Todos
            </a>
        </li>
        @foreach ($categorias as $cat)
            <li>
                <a href="{{ route('productos.index', ['categoria' => $cat]) }}"
                class="px-4 py-2 rounded-full transition duration-200 {{ request('categoria') === $cat ? 'bg-gray-500 text-white font-semibold' : 'bg-gray-300 hover:bg-gray-400 text-gray-800' }}">
                    {{ ucfirst($cat) }}
                </a>
            </li>
        @endforeach
    </ul>

    @if (isset($productos) && count($productos) > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-6">
            @livewire('productos.producto-form', ['categoriaSeleccionada' => request('categoria')])

            @foreach ($productos as $producto)
                <div class="flex flex-col bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 h-full">
                    
                    @if ($producto->imagen)
                        <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="w-full h-48 object-cover">
                    @endif

                    <div class="flex flex-col flex-grow p-4 text-center">
                        <h5 class="text-lg font-bold text-gray-800">
                            {{ Str::ucfirst($producto->nombre) }}
                        </h5>
                        <h6 class="text-sm text-gray-600 mb-2">
                            {{ $producto->tipo ? Str::ucfirst($producto->tipo->tipo) : 'Sin tipo' }}
                        </h6>
                        <p class="text-sm text-gray-700 mt-1 line-clamp-4">
                            <strong>Ingredientes:</strong> {{ $producto->ingredientes }}
                        </p>
                        
                        <div class="mt-auto flex justify-center items-center gap-2 pt-4">
                            @livewire('productos.editar-producto-form', ['producto' => $producto], key('producto.editar-producto-form-'.$producto->id))

                            <form action="{{ route('productos.destroy', $producto) }}" method="POST" onsubmit="return confirm('¿Eliminar este producto?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-md shadow transition duration-200"
                                    title="Eliminar producto">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M6 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm4-1a1 1 0 00-1 1v6a1 1 0 002 0V8a1 1 0 00-1-1zm4 1a1 1 0 10-2 0v6a1 1 0 102 0V8z"
                                            clip-rule="evenodd" />
                                        <path fill-rule="evenodd"
                                            d="M4 3a1 1 0 011-1h10a1 1 0 011 1v1H4V3zm1 3h10v10a2 2 0 01-2 2H7a2 2 0 01-2-2V6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="bg-gray-100 px-4 py-2 text-center">
                        <span class="text-blue-700 font-semibold text-md">
                            {{ number_format($producto->precio, 2, ',', '.') }} €
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center text-gray-500 py-12">
            No hay productos disponibles.
        </div>
    @endif
</div>
@endsection
