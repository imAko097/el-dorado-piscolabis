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
            @livewire('productos.mostrar-productos', ['productos' => $productos])

        @else
            <div class="text-center text-gray-500 py-12">
                No hay productos disponibles.
            </div>
        @endif
    </div>
@endsection
