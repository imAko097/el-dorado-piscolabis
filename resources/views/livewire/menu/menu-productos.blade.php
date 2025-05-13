<div class="pt-32 px-6 md:px-40 bg-white text-black min-h-screen">
    <!-- Navegador de categorías -->
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
                    class="px-4 py-2 rounded-full transition duration-200 
                           {{ $categoria === $cat ? 'bg-yellow-400 text-black font-semibold' : 'bg-gray-200 hover:bg-yellow-300 text-gray-700' }}"
                >
                    {{ ucfirst($cat) }}
                </a>
            </li>
        @endforeach
    </ul>

    <!-- Productos -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($productos as $producto)
            <div class="p-6 border border-gray-200 rounded-lg shadow hover:shadow-md transition">
                <h3 class="text-xl font-bold mb-2">{{ $producto->nombre }}</h3>
                <p class="text-lg text-gray-600">{{ number_format($producto->precio, 2) }} €</p>
            </div>
        @empty
            <p class="col-span-full text-center text-gray-500">No hay productos en esta categoría.</p>
        @endforelse
    </div>
</div>
