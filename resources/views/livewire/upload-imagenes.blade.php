<div>
    <!-- Botón para abrir el modal -->
    <button wire:click="showModal"
        class="flex items-center justify-center w-12 h-12 bg-whites hover:bg-gray-100 rounded-full shadow-lg border-2 border-gray-300 text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring--500 focus:ring-offset-2 transition duration-200 ease-in-out">
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px">
            <path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z" />
        </svg>
    </button>

   

    <!-- Modal -->
    @if ($showForm)
    <div class="fixed inset-0 bg-opacity-50 z-40 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md relative z-50">
            <!-- Botón X -->
            <button wire:click="closeModal"
                class="absolute top-2 right-2 text-gray-400 hover:text-gray-500 text-xl font-bold">&times;</button>

            <form wire:submit.prevent="subirImagenes">
                <!-- Dropzone personalizado -->
                <div class="flex items-center justify-center w-full">
                    <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-100 hover:bg-gray-200 shadow-inner ">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                            </svg>
                            <p class="mb-2 text-sm text-gray-500 hover:text-gray-500"><span>Haz clic para subir</span> o arrastra y suelta</p>
                            <p class="text-xs text-gray-500 hover:text-gray-500">SVG, PNG, JPG o GIF (MAX. 800x400px)</p>
                        </div>
                        <input id="dropzone-file" type="file" wire:model="imagenes" multiple class="hidden" />
                    </label>
                </div>

                @error('imagenes.*')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror

                <div class="flex justify-end mt-4">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Subir
                    </button>
                </div>
            </form>

            <!-- Vista previa -->
            @if ($imagenes)
            <div class="mt-4 grid grid-cols-3 gap-2">
                @foreach ($imagenes as $imagen)
                <img src="{{ $imagen->temporaryUrl() }}" class="w-full rounded shadow">
                @endforeach
            </div>
            @endif
        </div>
    </div>
    @endif
</div>