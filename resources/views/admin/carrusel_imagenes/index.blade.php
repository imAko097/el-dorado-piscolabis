@extends('layouts.admin')

@section('title', 'Imágenes del Carrusel')

@section('content_header')

    
@endsection

@section('content')
    <div class="container mt-4 position-relative">
        @livewire('carrusel-galeria')

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


        document.addEventListener('livewire:load', function () {
            Livewire.on('imagenEliminada', () => {
                alert('Imagen eliminada correctamente');
            });
        });

    </script>
@endsection
