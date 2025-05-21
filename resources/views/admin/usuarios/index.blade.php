@extends('layouts.admin')

@section('page-title', 'Usuarios')
@section('page-description', 'Administración de usuarios')

@section('content')
<div class="max-w-7xl mx-auto p-4 py-6">
    @livewire('usuarios.user-form')

    {{-- Vista tipo tarjetas para móviles --}}
<div class="sm:hidden space-y-4 mt-6">
    @if (isset($usuarios) && count($usuarios) > 0)
        @php $i = 1; @endphp
        @foreach ($usuarios as $usuario)
            <div class="bg-white shadow rounded-lg p-4">
                <p class="text-sm"><strong>#:</strong> {{ $i }}</p>
                <p class="text-sm"><strong>Nombre:</strong> {{ $usuario->name }}</p>
                <p class="text-sm"><strong>Correo:</strong> {{ $usuario->email }}</p>
                <p class="text-sm"><strong>Rol:</strong> {{ $roles[$usuario->role] ?? ucfirst($usuario->role) }}</p>
                <div class="flex justify-center mt-3">
                    <livewire:usuarios.editar-user-form :usuario="$usuario" />
                </div>
            </div>
            @php $i++; @endphp
        @endforeach
    @else
        <div class="text-center text-gray-500 py-4">No hay usuarios disponibles.</div>
    @endif
</div>

{{-- Vista tipo tabla para pantallas medianas en adelante --}}
<div class="hidden sm:block mt-6">
    <div class="overflow-x-auto bg-white rounded-lg shadow ring-1 ring-black ring-opacity-5">
        <table class="w-full text-sm text-left text-gray-700">
            <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-4 py-3 w-10">#</th>
                    <th class="px-4 py-3">Nombre</th>
                    <th class="px-4 py-3">Correo</th>
                    <th class="px-4 py-3">Rol</th>
                    <th class="px-4 py-3 w-10 text-right"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @php $i = 1; @endphp
                @foreach ($usuarios as $usuario)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $i }}</td>
                        <td class="px-4 py-2">{{ $usuario->name }}</td>
                        <td class="px-4 py-2">{{ $usuario->email }}</td>
                        <td class="px-4 py-2">
                            {{ $roles[$usuario->role] ?? ucfirst($usuario->role) }}
                        </td>
                        <td class="px-4 py-2 text-right">
                            <livewire:usuarios.editar-user-form :usuario="$usuario" />
                        </td>
                    </tr>
                    @php $i++; @endphp
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
