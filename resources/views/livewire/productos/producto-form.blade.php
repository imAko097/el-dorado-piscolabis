<div>
    <div wire:click="showModal" 
        class="cursor-pointer flex flex-col justify-center items-center bg-white border-2 border-dashed border-gray-300 rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 h-full p-6 hover:bg-gray-100 text-gray-500 hover:text-gray-700">
        <div class="flex flex-col items-center justify-center flex-grow text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <span class="font-semibold">Agregar Producto</span>
        </div>
    </div>

    @if ($showForm)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 overflow-y-auto px-4">
            <div class="bg-white rounded-xl shadow-2xl w-full max-w-3xl mx-auto my-10">
                <!-- Encabezado -->
                <div class="flex justify-between items-center border-b px-6 py-4">
                    <h2 class="text-xl font-semibold text-gray-800">Agregar Nuevo Producto</h2>
                    <button wire:click="$set('showForm', false)" class="text-gray-500 hover:text-red-600 text-2xl leading-none">×</button>
                </div>

                <!-- Formulario -->
                <div class="px-6 py-6">
                    <form wire:submit.prevent="save" enctype="multipart/form-data" class="space-y-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <!-- Nombre -->
                            <div>
                                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                                <input wire:model="nombre" id="nombre" type="text"
                                    class="px-3 py-2 mt-1 w-full rounded-md border-[1.5px] border-gray-400 bg-white shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 text-sm">
                                @error('nombre') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- Precio -->
                            <div>
                                <label for="precio" class="block text-sm font-medium text-gray-700">Precio</label>
                                <input wire:model="precio" id="precio" type="number" step="0.01"
                                    class="px-3 py-2 mt-1 w-full rounded-md border-[1.5px] border-gray-400 bg-white shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 text-sm">
                                @error('precio') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- Tipo de Producto -->
                            <div class="sm:col-span-2">
                                <label for="id_producto_tipos" class="block text-sm font-medium text-gray-700">Tipo de Producto</label>
                                <select wire:model="id_producto_tipos" id="id_producto_tipos"
                                    class="px-3 py-2 mt-1 w-full rounded-md border-[1.5px] border-gray-400 bg-white shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 text-sm capitalize">
                                    <option value="">Seleccione un tipo</option>
                                    @foreach(\App\Models\ProductoTipo::all() as $tipo)
                                        <option value="{{ $tipo->id }}">{{ $tipo->tipo }}</option>
                                    @endforeach
                                </select>
                                @error('id_producto_tipos') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Ingredientes -->
                        <div>
                            <label for="ingredientes" class="block text-sm font-medium text-gray-700">Ingredientes</label>
                            <textarea wire:model="ingredientes" id="ingredientes" rows="4"
                                class="px-3 py-2 mt-1 w-full rounded-md border-[1.5px] border-gray-400 bg-white shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 text-sm"></textarea>
                            @error('ingredientes') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Imagen -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Imagen del Producto</label>
                            <input type="file" wire:model="imagen"
                                class="py-2 block w-full text-sm text-gray-700 border-[1.5px] border-gray-400 bg-white rounded-md file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" /> 
                            <!-- Cargando imagen -->
                            <div wire:loading wire:target="imagen" class="mt-2">
                                <div class="w-full bg-gray-200 rounded-full h-5">
                                    <div class="bg-blue-500 text-white text-sm font-medium text-center leading-5 rounded-full h-5 animate-pulse" style="width: 100%">
                                        Subiendo imagen...
                                    </div>
                                </div>
                            </div>

                            <!-- Vista previa -->
                            @if ($imagen)
                                <img src="{{ $imagen->temporaryUrl() }}" class="mt-4 rounded-md w-40 h-auto border border-gray-200 shadow-sm">
                            @endif
                            @error('imagen') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Botones -->
                        <div class="flex justify-end space-x-3 pt-4">
                            <button type="button" wire:click="$set('showForm', false)"
                                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md text-sm transition duration-150">
                                Cancelar
                            </button>
                            <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm transition duration-150">
                                Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
