<div>
    <!-- Navegador de categorías de productos -->
    <ul class="flex flex-wrap justify-center gap-4 mb-8">
        @foreach([
            'bocadillos',
            'sandwiches',
            'croissants',
            'kebab',
            'hamburguesas',
            'perritos',
            'entrantes',
            'papas',
            'ensaladas',
            'platos combinados',
            'pizzas',
            'bebidas'
        ] as $cat)
            <li>
                <a
                    href="{{ route('menu', ['categoria' => $cat]) }}"
                    wire:navigate
                    class="px-2 py-2 rounded-full transition duration-200 {{ $categoria === $cat ? 'bg-yellow-400 text-black font-semibold' : 'bg-gray-200 hover:bg-yellow-300 text-gray-700' }}"
                >
                    {{ ucfirst($cat) }}
                </a>
            </li>
        @endforeach
    </ul>

    <!-- Productos -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 text-center">
        @forelse($productos as $producto)
            <div class="p-6 border border-gray-200 rounded-lg shadow hover:shadow-md hover:border-dorado transition">
                <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="w-full h-48 object-cover mb-4">
                <h3 class="text-xl font-bold mb-2">{{ ucfirst($producto->nombre) }}</h3>
                <p class="text-gray-600">{{ ucfirst($producto->ingredientes) }}</p>
                <p class="text-lg text-gray-600">{{ number_format($producto->precio, 2, ',', '.') }} €</p>
                <button class="bg-yellow-400 text-black font-semibold py-2 px-4 rounded-full hover:bg-yellow-300 transition mt-2">
                    Añadir
                </button>
            </div>
        @empty
            <p class="col-span-full text-center text-gray-500">No hay productos en esta categoría.</p>
        @endforelse
    </div>
</div>
