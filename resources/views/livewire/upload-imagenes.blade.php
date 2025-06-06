<div>
    <div wire:click="showModal" 
        class="cursor-pointer flex flex-col justify-center items-center bg-white border-2 border-dashed border-gray-300 rounded-lg shadow p-4 hover:shadow-lg transition-shadow duration-300 max-w-xs h-[250px] mx-auto text-gray-500 hover:text-gray-700">
        <div class="flex flex-col items-center justify-center text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <span class="font-semibold">Agregar Imagen</span>
        </div>
    </div>

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

                <!-- Mensajes de error -->
                @if ($mensajeError)
                    <div class="mt-2 text-red-600 text-sm font-semibold">
                        {{ $mensajeError }}
                    </div>
                @endif

                @error('imagenes.*')
                    <div class="mt-2 text-red-500 text-sm">{{ $message }}</div>
                @enderror

                @error('limite')
                    <div class="mt-2 text-red-500 text-sm font-semibold">
                        {{ $message }}
                    </div>
                @enderror


                <div class="flex justify-end mt-4">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                        @if ($mensajeError) disabled class="opacity-50 cursor-not-allowed" @endif>
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
