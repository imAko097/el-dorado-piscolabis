<div>
    <!-- Botón para abrir el modal -->
    <button wire:click="showModal" class="w-12 h-12 bg-gray-800 hover:bg-gray-900 text-white text-sm px-4 py-2 rounded-full">
        <i class="bi bi-plus-lg"></i>
    </button>

    @if (session()->has('mensaje'))
        <div class="bg-green-100 text-green-800 p-2 rounded my-4">
            {{ session('mensaje') }}
        </div>
    @endif

    <!-- Modal -->
    @if ($showForm)
        <div class="fixed inset-0 bg-black bg-opacity-50 z-40 flex items-center justify-center">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md relative z-50">
                <!-- Botón X -->
                <button wire:click="closeModal" class="absolute top-2 right-2 text-gray-600 hover:text-black text-xl font-bold">&times;</button>

                <form wire:submit.prevent="subirImagenes">
                    <input type="file" wire:model="imagenes" multiple class="mb-4">

                    @error('imagenes.*') 
                        <span class="text-red-500 text-sm">{{ $message }}</span> 
                    @enderror

                    <div class="flex justify-end mt-4">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
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
