<div>
    <ul class="flex flex-wrap justify-center gap-4 mb-6 mt-4">
        <li>
            <button wire:click="$set('categoriaSeleccionada', null)"
                class="px-4 py-2 rounded-full transition duration-200"
                :class="{ 'bg-gray-500 text-white font-semibold': !@js($categoriaSeleccionada), 'bg-gray-300 hover:bg-gray-400 text-gray-800': @js($categoriaSeleccionada) }">
                Todos
            </button>
        </li>
        @foreach ($categorias as $cat)
            <li>
                <button wire:click="$set('categoriaSeleccionada', '{{ $cat }}')"
                    class="px-4 py-2 rounded-full transition duration-200 {{ $categoriaSeleccionada === $cat ? 'bg-gray-500 text-white font-semibold' : 'bg-gray-300 hover:bg-gray-400 text-gray-800' }}">
                    {{ ucfirst($cat) }}
                </button>
            </li>
        @endforeach
    </ul>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-6">
        @livewire('productos.producto-form', ['categoriaSeleccionada' => request('categoria')])
        
        @foreach ($productos as $producto)
            <div
                class="flex flex-col bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 h-full">
                <div class="relative">
                    @if ($producto->imagen)
                        <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}"
                            class="w-full h-48 object-cover">
                    @endif
                    <label class="relative top-2 left-2 z-20 inline-flex items-center cursor-pointer select-none"
                        wire:key="switch-destacado-{{ $producto->id }}">
                        <input type="checkbox" class="sr-only peer" wire:click="toggleDestacado({{ $producto->id }})"
                            @checked($producto->destacado) autocomplete="off">

                        <div
                            class="w-11 h-6 bg-gray-300 rounded-full peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-blue-500 peer-checked:bg-green-500 transition-colors">
                        </div>
                        <div
                            class="absolute left-1 top-1 bg-white w-4 h-4 rounded-full shadow-md transform peer-checked:translate-x-5 transition-transform">
                        </div>
                    </label>

                </div>
                <div class="flex flex-col flex-grow p-4 text-center">
                    <h5 class="text-lg font-bold text-gray-800">
                        {{ Str::ucfirst($producto->nombre) }}
                    </h5>
                    <h6 class="text-sm text-gray-600 mb-2">
                        {{ $producto->tipo ? Str::ucfirst($producto->tipo->tipo) : 'Sin tipo' }}
                    </h6>
                    <p class="text-sm text-gray-700 mt-1 line-clamp-4">
                        <strong>Ingredientes:</strong> {{ $producto->ingredientes }}
                    </p>

                    <div class="mt-auto flex justify-center items-center gap-2 pt-4">
                        <div>
                            <button wire:click="editar({{ $producto->id }})"
                                class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-yellow-500 hover:bg-yellow-600 rounded-md shadow transition duration-200"
                                title="Editar producto">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5m-10 2l6-6m0 0l3 3m-3-3v0" />
                                </svg>
                            </button>
                        </div>

                        <form action="{{ route('productos.destroy', $producto) }}" method="POST"
                            onsubmit="return confirm('¿Eliminar este producto?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-md shadow transition duration-200"
                                title="Eliminar producto">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M6 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm4-1a1 1 0 00-1 1v6a1 1 0 002 0V8a1 1 0 00-1-1zm4 1a1 1 0 10-2 0v6a1 1 0 102 0V8z"
                                        clip-rule="evenodd" />
                                    <path fill-rule="evenodd"
                                        d="M4 3a1 1 0 011-1h10a1 1 0 011 1v1H4V3zm1 3h10v10a2 2 0 01-2 2H7a2 2 0 01-2-2V6z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="bg-gray-100 px-4 py-2 text-center">
                    <span class="text-blue-700 font-semibold text-md">
                        {{ number_format($producto->precio, 2, ',', '.') }} €
                    </span>
                </div>
            </div>
        @endforeach
    </div>

    @if ($showForm)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 overflow-y-auto px-4">
            <div class="bg-white rounded-xl shadow-2xl w-full max-w-3xl mx-auto my-10">
                <!-- Encabezado -->
                <div class="flex justify-between items-center border-b px-6 py-4">
                    <h2 class="text-xl font-semibold text-gray-800">Editar Producto</h2>
                    <button wire:click="$set('showForm', false)" class="text-gray-500 hover:text-red-600 text-2xl leading-none">×</button>
                </div>

                <!-- Formulario -->
                <div class="px-6 py-6">
                    <form wire:submit.prevent="actualizar" enctype="multipart/form-data" class="space-y-6">
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
                                <div class="mt-4">
                                    <p class="text-sm text-gray-600">Imagen nueva:</p>
                                    <img src="{{ $imagen->temporaryUrl() }}" class="mt-4 rounded-md w-40 h-auto border border-gray-200 shadow-sm">
                                </div>
                            @elseif ($imagen_actual)
                                <div class="mt-4">
                                    <p class="text-sm text-gray-600">Imagen anterior:</p>
                                    <img src="{{ asset('storage/' . $imagen_actual) }}" class="mt-1 rounded-md w-40 h-auto border border-gray-200 shadow-sm">
                                </div>
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
