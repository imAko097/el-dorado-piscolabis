@extends('layouts.admin')

@section('page-title', 'Inicio del Panel')
@section('styles')
<script src="https://cdn.tailwindcss.com"></script>
@endsection

@section('content')


<div class="max-w-7xl mx-auto p-4 py-6">
    @livewire('user-form')

    <div class="overflow-x-auto bg-white rounded-lg shadow-sm">
        <table class="min-w-full text-sm text-left text-gray-700">
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
                @if (isset($usuarios) && count($usuarios) > 0)
                @php $i = 1; @endphp
                @foreach ($usuarios as $usuario)
                <tr class="hover:bg-gray-50">
                    <th class="px-4 py-2 font-medium text-gray-800 whitespace-nowrap">{{ $i }}</th>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $usuario->name }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">{{ $usuario->email }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">
                        @php
                            $roles = [
                                'admin' => 'Administrador',
                                'empleado' => 'Empleado',
                                'cliente' => 'Cliente'
                            ];
                        @endphp
                        {{ $roles[$usuario->role] ?? ucfirst($usuario->role) }}
                    </td>

                    <td class="px-4 py-2 text-right whitespace-nowrap">
                        @livewire('editar-user-form', ['usuario' => $usuario], key('editar-user-form-'.$usuario->id))
                    </td>
                </tr>
                @php $i++; @endphp
                @endforeach
                @else
                <tr>
                    <td colspan="5" class="px-4 py-4 text-center text-gray-500">
                        No hay usuarios disponibles.
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection