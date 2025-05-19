@extends('layouts.admin')

@section('title', 'Imágenes del Carrusel')

@section('content_header')
    <h1 class="text-center text-yellow-200 mt-4 text-2xl">Imágenes del Carrusel</h1>
@endsection

@section('content')
    <div class="container mt-4 position-relative">

        @if ($carrusel_imagenes->isNotEmpty())
            <div id="sortable-images" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4 justify-content-center">
                @foreach ($carrusel_imagenes->sortBy('orden') as $imagen)
                    <div class="col mb-4 image-item" data-id="{{ $imagen->id }}">
                        <div class="card h-100 bg-transparent text-light shadow-none border-0" style="max-width: 300px; margin: 0 auto;">
                            <img src="{{ $imagen->imagen }}"
                                 alt="Imagen {{ $imagen->id }}"
                                 style="width: 100%; height: 250px; object-fit: cover; border: none;">
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info text-center text-white bg-dark border border-warning">
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
        document.addEventListener("DOMContentLoaded", function () {
            let sortable = new Sortable(document.getElementById('sortable-images'), {
                animation: 150,
                ghostClass: 'sortable-ghost',
                onEnd: function (evt) {
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
                        body: JSON.stringify({ order })
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
