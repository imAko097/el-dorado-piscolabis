@extends('layouts.admin')

@section('page-title', 'Productos')
@section('page-description', 'Administración de productos')

@php
    use Illuminate\Support\Str;
@endphp

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-6">  
        @if (isset($productos) && count($productos) > 0)
            @livewire('productos.mostrar-productos', ['productos' => $productos, 'categorias' => $categorias])
        @else
            <div class="text-center text-gray-500 py-12">
                No hay productos disponibles.
            </div>
        @endif
    </div>
@endsection
