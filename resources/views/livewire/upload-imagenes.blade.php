<div>
    <!-- Botón para abrir el modal -->
    <button wire:click="showModal"
        class="flex items-center justify-center w-12 h-12 bg-gray-800 hover:bg-gray-900 text-yellow-200 rounded-full shadow">
        <i class="bi bi-plus-lg text-xl"></i>
    </button>

    @if (session()->has('mensaje'))
        <div class="bg-green-100 text-green-800 p-2 rounded my-4">
            {{ session('mensaje') }}
        </div>
    @endif

    <!-- Modal -->
    @if ($showForm)
        <div class="fixed inset-0 bg-opacity-50 z-40 flex items-center justify-center">
            <div class="bg-[#161B22] p-6 rounded-lg shadow-lg w-full max-w-md relative z-50">
                <!-- Botón X -->
                <button wire:click="closeModal"
                    class="absolute top-2 right-2 text-gray-600 hover:text-black text-xl font-bold">&times;</button>

                <form wire:submit.prevent="subirImagenes">
                    <!-- Dropzone personalizado -->
                    <div class="flex items-center justify-center w-full">
                        <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                </svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Haz clic para subir</span> o arrastra y suelta</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG o GIF (MAX. 800x400px)</p>
                            </div>
                            <input id="dropzone-file" type="file" wire:model="imagenes" multiple class="hidden" />
                        </label>
                    </div>

                    @error('imagenes.*')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror

                    <div class="flex justify-end mt-4">
                        <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700">
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
