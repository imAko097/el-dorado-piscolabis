@extends('layouts.admin')

@section('title', 'Imágenes del Carrusel')

@section('content_header')
    <h1 class="text-center">Imágenes del Carrusel</h1>
    <!-- Carga de estilos y scripts necesarios -->
@endsection

@section('content')
    <div class="container mt-4">

        @if ($carrusel_imagenes->isNotEmpty())
            <div id="sortable-images" class="row row-cols-1 row-cols-md-3 g-4">
                @foreach ($carrusel_imagenes->sortBy('orden') as $imagen)
                    <div class="col mb-4 image-item" data-id="{{ $imagen->id }}">
                        <div class="card h-100" style="max-width: 200px; margin: 0 auto;">
                            <img src="{{ $imagen->imagen }}" class="card-img-top img-thumbnail"
                                alt="Imagen {{ $imagen->id }}" style="max-height: 150px; object-fit: cover;">
                        </div>
                    </div>
                @endforeach

            </div>
        @else
            <div class="alert alert-info text-center">
                No hay imágenes en el carrusel.
            </div>
        @endif
    </div>

    @livewire('upload-imagenes')
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
