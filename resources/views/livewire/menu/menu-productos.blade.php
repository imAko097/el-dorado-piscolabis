<div class="bg-[#FFF8F0]"> 
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
                    class="px-2 py-2 rounded-full transition duration-200 {{ $categoria === $cat ? 'bg-[#FCD34D] text-black font-semibold' : 'bg-gray-200 hover:bg-[#FCD34D] text-[#1C1917]' }}"
                >
                    {{ ucfirst($cat) }}
                </a>
            </li>
        @endforeach
    </ul>

    <!-- Productos -->
    <div class="max-w-7xl mx-auto px-4 mb-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($productos as $producto)
        <div class="bg-[#FFFFFF] rounded-xl overflow-hidden shadow-lg border-2 border-[#FCD34D] flex flex-col animate__animated animate__fadeIn">
            <div class="w-full h-48 overflow-hidden bg-[#FFFFFF] flex items-center justify-center p-3">
                <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="max-h-full max-w-full object-contain object-center">
            </div>
            <div class="p-6 flex flex-col flex-grow">
                <div>
                    <h3 class="text-2xl font-bold mb-3 text-[#1C1917]">{{ ucfirst($producto->nombre) }}</h3>
                    <p class="text-[#1C1917]">{{ ucfirst($producto->ingredientes) }}</p>
                </div>
                <div class="flex items-center justify-between mt-auto pt-4">
                    <p class="text-xl font-semibold text-[#92400E]">{{ number_format($producto->precio, 2, ',', '.') }} €</p>
                    <button wire:click="agregarAlCarrito({{ $producto->id }})"
                        class="bg-[#FCD34D] text-black font-semibold py-2 px-6 rounded-full hover:bg-yellow-500 transition-colors">
                        Añadir
                    </button>
                </div>
            </div>
        </div>
    @empty
        <p class="text-center text-[#1C1917] text-lg py-8 col-span-full">No hay productos en esta categoría.</p>
    @endforelse
    </div>
</div>
