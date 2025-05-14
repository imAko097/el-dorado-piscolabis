@extends('layouts.admin')

@section('page-title', 'Productos')
@section('page-description', 'Administración de productos')

@php
    use Illuminate\Support\Str;
@endphp

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    @livewire('productos.producto-form')

    <ul class="flex flex-wrap justify-center gap-4 mb-6 mt-4">
        <li>
            <a href="{{ route('productos.index') }}"
            class="px-4 py-2 rounded-full transition duration-200 {{ request('categoria') ? 'bg-gray-200 hover:bg-yellow-300 text-gray-700' : 'bg-yellow-400 text-black font-semibold' }}">
                Todos
            </a>
        </li>
        @foreach ($categorias as $cat)
            <li>
                <a href="{{ route('productos.index', ['categoria' => $cat]) }}"
                class="px-4 py-2 rounded-full transition duration-200 {{ request('categoria') === $cat ? 'bg-yellow-400 text-black font-semibold' : 'bg-gray-200 hover:bg-yellow-300 text-gray-700' }}">
                    {{ ucfirst($cat) }}
                </a>
            </li>
        @endforeach
    </ul>


    @if (isset($productos) && count($productos) > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-6">
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
                        <p class="text-sm text-gray-700"><strong>Stock:</strong> {{ $producto->stock }}</p>
                        <p class="text-sm text-gray-700 mt-1 line-clamp-4">
                            <strong>Ingredientes:</strong> {{ $producto->ingredientes }}
                        </p>
                        
                        <div class="mt-auto flex justify-center items-center pt-4">
                            @livewire('productos.editar-producto-form', ['producto' => $producto], key('producto.editar-producto-form-'.$producto->id))
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
