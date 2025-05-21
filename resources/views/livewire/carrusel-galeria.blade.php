<div id="sortable-images" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 justify-center">
    @foreach ($imagenes as $imagen)
        <div class="image-item relative" data-id="{{ $imagen->id }}">
            <div class="bg-transparent text-light shadow-none border-0 max-w-xs mx-auto relative">
                <img src="{{ $imagen->imagen }}" alt="Imagen {{ $imagen->id }}"
                     class="w-full h-[250px] object-cover rounded-lg shadow">

                    <button onclick="if(confirm('¿Estás seguro de que deseas eliminar esta imagen?')) { @this.call('eliminarImagen', {{ $imagen->id }}) }"
                            class="absolute top-2 right-2 bg-red-600 bg-opacity-80 hover:bg-red-700 text-white p-2 rounded-full transition"
                            title="Eliminar">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m-6 0a1 1 0 01-1-1V5a1 1 0 011-1h4a1 1 0 011 1v1m-6 0h6" />
                        </svg>
                    </button>
            </div>
        </div>
    @endforeach
</div>
