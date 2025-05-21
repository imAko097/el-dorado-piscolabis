@extends('layouts.admin')

@section('title', 'Imágenes del Carrusel')

@section('content_header')
    
@endsection

@section('content')
    <div class="container mt-4 position-relative">
        @if ($carrusel_imagenes->isNotEmpty())
            <div id="sortable-images" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 justify-center">
                @foreach ($carrusel_imagenes->sortBy('orden') as $imagen)
                    <div class="image-item" data-id="{{ $imagen->id }}">
                        <div class="bg-transparent text-light shadow-none border-0 max-w-xs mx-auto">
                            <img src="{{ $imagen->imagen }}" alt="Imagen {{ $imagen->id }}"
                                class="w-full h-[250px] object-cover rounded-lg shadow">
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info text-center text-gray-700 border-warning mt-4">
                No hay imágenes en el carrusel.
            </div>
        @endif

        {{-- Componente Livewire para subir imágenes --}}
        <div style="position: fixed; bottom: 20px; right: 20px; z-index: 1050;">
            @livewire('upload-imagenes')
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let sortable = new Sortable(document.getElementById('sortable-images'), {
                animation: 150,
                ghostClass: 'sortable-ghost',
                onEnd: function(evt) {
                    let order = [];
                    document.querySelectorAll('.image-item').forEach((item, index) => {
                        order.push({
                            id: item.getAttribute('data-id'),
                            position: index + 1
                        });
                    });

                    fetch("{{ route('carrusel.updateOrder') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({
                                order
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                console.log('Orden actualizado correctamente');
                            }
                        })
                        .catch(error => console.error('Error:', error));
                }
            });
        });
    </script>
@endsection
