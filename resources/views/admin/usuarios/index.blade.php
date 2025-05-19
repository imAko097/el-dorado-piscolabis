@extends('layouts.admin')

@section('page-title', 'Usuarios')
@section('page-description', 'Administración de usuarios')
@section('styles')
<script src="https://cdn.tailwindcss.com"></script>
@endsection

@section('content')
<div class="max-w-7xl mx-auto p-4 py-6">
    @livewire('usuarios.user-form')

    <div class="overflow-x-auto mt-6 bg-white rounded-lg shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
        <table class="w-full min-w-[640px] text-sm text-left text-gray-700">
            <thead class="bg-gray-100 text-gray-600 uppercase text-xs hidden sm:table-header-group">
                <tr>
                    <th class="px-4 py-3 w-10">#</th>
                    <th class="px-4 py-3">Nombre</th>
                    <th class="px-4 py-3">Correo</th>
                    <th class="px-4 py-3">Rol</th>
                    <th class="px-4 py-3 w-10 text-right"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 block sm:table-row-group">
                @if (isset($usuarios) && count($usuarios) > 0)
                    @php $i = 1; @endphp
                    @foreach ($usuarios as $usuario)
                        <tr class="hover:bg-gray-50 block sm:table-row border-b sm:border-none">
                            <td class="px-4 py-2 block sm:table-cell">
                                <span class="font-semibold sm:hidden">#:</span> {{ $i }}
                            </td>
                            <td class="px-4 py-2 block sm:table-cell">
                                <span class="font-semibold sm:hidden">Nombre:</span> {{ $usuario->name }}
                            </td>
                            <td class="px-4 py-2 block sm:table-cell">
                                <span class="font-semibold sm:hidden">Correo:</span> {{ $usuario->email }}
                            </td>
                            <td class="px-4 py-2 block sm:table-cell">
                                <span class="font-semibold sm:hidden">Rol:</span>
                                @php
                                    $roles = ['admin' => 'Administrador', 'empleado' => 'Empleado', 'cliente' => 'Cliente'];
                                @endphp
                                {{ $roles[$usuario->role] ?? ucfirst($usuario->role) }}
                            </td>
                            <td class="px-4 py-2 text-center sm:text-right block sm:table-cell">
                                <div class="inline-block sm:block">
                                    @livewire('usuarios.editar-user-form', ['usuario' => $usuario], key('usuarios.editar-user-form-'.$usuario->id))
                                </div>
                            </td>
                        </tr>
                        @php $i++; @endphp
                    @endforeach
                @else
                    <tr class="block sm:table-row">
                        <td colspan="5" class="px-4 py-4 text-center text-gray-500 block sm:table-cell">
                            No hay usuarios disponibles.
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
