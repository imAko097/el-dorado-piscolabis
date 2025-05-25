@extends('layouts.admin')


@section('page-title', 'Mensajes Contactos')
@section('title', 'Mensajes Contactos')

@section('content_header')

@endsection

@section('content')
<div class="max-w-7xl mx-auto p-4 py-6">
    <div class="hidden sm:block mt-6">
        <div class="overflow-x-auto bg-white rounded-lg shadow ring-1 ring-black ring-opacity-5">
            <table class="w-full text-sm text-left text-gray-700">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3 w-10">#</th>
                        <th class="px-4 py-3">Nombre</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Mensaje</th>
                        <th class="px-4 py-3">Fecha</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @php $i = 1; @endphp
                    @foreach ($mensajes as $mensaje)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $i }}</td>
                        <td class="px-4 py-2">{{ $mensaje->nombre }}</td>
                        <td class="px-4 py-2">{{ $mensaje->email }}</td>
                        <td class="px-4 py-2">{{ $mensaje->mensaje }}</td>
                        <td class="px-4 py-2">{{ $mensaje->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    @php $i++; @endphp
                    @endforeach
                </tbody>
            </table>

            {{-- 🔽 Paginación justo debajo de la tabla --}}
            <div class="px-4 py-3 bg-white border-t border-gray-200">
                {{ $mensajes->links() }}
            </div>
        </div>
    </div>
</div>
@endsection