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
    <div class="max-w-5xl mx-auto px-4 mb-16 space-y-4">
    @forelse($productos as $producto)
        <div class="bg-white rounded-xl overflow-hidden shadow-lg border-2 border-yellow-400 flex animate__animated animate__fadeIn">
            <div class="w-1/3">
                <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="w-full h-full object-cover">
            </div>
            <div class="p-6 flex-1">
                <h3 class="text-2xl font-bold mb-3 text-gray-800">{{ ucfirst($producto->nombre) }}</h3>
                <p class="text-gray-600 mb-4">{{ ucfirst($producto->ingredientes) }}</p>
                <div class="flex items-center justify-between">
                    <p class="text-xl font-semibold text-yellow-600">{{ number_format($producto->precio, 2, ',', '.') }} €</p>
                    <button wire:click="agregarAlCarrito({{ $producto->id }})" class="bg-yellow-400 text-black font-semibold py-2 px-6 rounded-full hover:bg-yellow-500 transition-colors">
                        Añadir
                    </button>
                </div>
            </div>
        </div>
    @empty
        <p class="text-center text-gray-500 text-lg py-8">No hay productos en esta categoría.</p>
    @endforelse
    </div>
</div>
