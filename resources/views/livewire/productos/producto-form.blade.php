<div>
    <button wire:click="showModal"
        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-600 hover:bg-green-700 rounded-md shadow transition duration-200"
        title="Agregar nuevo producto">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
        </svg>
        Agregar Producto
    </button>


    @if ($showForm)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 overflow-y-auto px-4">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl sm:max-w-3xl md:max-w-4xl mx-auto my-10">
                <div class="flex justify-between items-center border-b px-4 sm:px-6 py-3 sm:py-4">
                    <h2 class="text-lg sm:text-xl font-semibold">Agregar Nuevo Usuario</h2>
                    <button wire:click="$set('showForm', false)" class="text-gray-600 hover:text-gray-900 text-xl">✕</button>
                </div>


                <div class="px-4 sm:px-6 py-4">
                    <form wire:submit.prevent="save" enctype="multipart/form-data" class="space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Nombre -->
                            <div>
                                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                                <input wire:model="nombre" id="nombre" type="text"
                                       class="py-2 mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                                @error('nombre') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- Precio -->
                            <div>
                                <label for="precio" class="block text-sm font-medium text-gray-700">Precio</label>
                                <input wire:model="precio" id="precio" type="number" step="0.01"
                                       class="py-2 mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" />
                                @error('precio') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- Stock -->
                            <div>
                                <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                                <input wire:model="stock" id="stock" type="number"
                                       class="py-2 mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" />
                                @error('stock') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- Tipo de Producto -->
                            <div>
                                <label for="id_producto_tipos" class="block text-sm font-medium text-gray-700">Tipo de Producto</label>
                                <select wire:model="id_producto_tipos" id="id_producto_tipos"
                                        class="capitalize py-2 mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
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
                            <textarea wire:model="ingredientes" id="ingredientes" rows="5"
                                      class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"></textarea>
                            @error('ingredientes') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Imagen -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Imagen Producto</label>
                            <input type="file" wire:model="imagen"
                                   class="block w-full text-sm text-gray-700 border border-gray-300 rounded-md file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />

                            <!-- Barra de carga -->
                            <div wire:loading wire:target="imagen" class="mt-2">
                                <div class="w-full bg-gray-200 rounded-full h-5">
                                    <div class="bg-blue-500 text-white text-sm font-medium text-center leading-5 rounded-full h-6 animate-pulse" style="width: 100%">
                                        Subiendo imagen...
                                    </div>
                                </div>
                            </div>

                            @if ($imagen)
                                <img src="{{ $imagen->temporaryUrl() }}" class="mt-3 rounded-md w-48 h-auto">
                            @endif
                            @error('imagen') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Botones -->
                        <div class="flex justify-end space-x-2 pt-4">
                            <button type="button" wire:click="$set('showForm', false)"
                                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md text-sm">
                                Cancelar
                            </button>
                            <button type="submit"
                                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm">
                                Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
