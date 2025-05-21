@extends('layouts.admin')

@section('title', 'Imágenes del Carrusel')

@section('content_header')
@endsection

@section('content')
<div class="container mt-4 position-relative">
    @if ($carrusel_imagenes->isNotEmpty())
    <form id="deleteForm" method="POST" action="{{ route('carrusel_imagenes.delete_multiple') }}">
        @csrf
        @method('DELETE')

        <div id="sortable-images" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 justify-center">
            @foreach ($carrusel_imagenes->sortBy('orden') as $imagen)
            <div class="image-item relative cursor-pointer select-none" data-id="{{ $imagen->id }}">
                <div class="bg-transparent text-light shadow-none border-0 max-w-xs mx-auto relative">
                    <img src="{{ $imagen->imagen }}" alt="Imagen {{ $imagen->id }}"
                        class="w-full h-[250px] object-cover rounded-lg shadow">

                    <input type="checkbox" name="ids[]" value="{{ $imagen->id }}"
                        class="delete-checkbox absolute top-2 left-2 w-6 h-6 rounded border border-gray-400 bg-white"
                        style="display:none; z-index: 10;">
                </div>
            </div>
            @endforeach
        </div>

        {{-- Botones fijos abajo a la izquierda, dejando espacio para menú lateral --}}
        <div style="position: fixed; bottom: 20px; left: 270px; z-index: 1100; display: flex; gap: 10px; align-items: center;">
            <button type="button" id="toggleDeleteMode" class="btn btn-danger" title="Eliminar múltiple" style="display:flex; align-items:center; gap:5px;">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:18px; height:18px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7L5 7M6 7L6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7M10 11v6M14 11v6M9 7V5a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2" />
                </svg>
                Eliminar múltiple
            </button>
            <button type="submit" id="confirmDelete" class="btn btn-success" style="display:none;">Confirmar</button>
        </div>
    </form>
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

        const toggleBtn = document.getElementById('toggleDeleteMode');
        const confirmBtn = document.getElementById('confirmDelete');
        const checkboxes = document.querySelectorAll('.delete-checkbox');

        toggleBtn.addEventListener('click', () => {
            checkboxes.forEach(cb => {
                cb.style.display = cb.style.display === 'none' ? 'block' : 'none';
            });

            confirmBtn.style.display = confirmBtn.style.display === 'none' ? 'inline-block' : 'none';
        });

        // Click en imagen activa/desactiva checkbox
        document.querySelectorAll('.image-item').forEach(item => {
            item.addEventListener('click', function(e) {
                if (e.target.classList.contains('delete-checkbox')) return;

                const checkbox = this.querySelector('.delete-checkbox');
                if (checkbox && checkbox.style.display !== 'none') {
                    checkbox.checked = !checkbox.checked;
                }
            });
        });
    });
</script>
@endsection
