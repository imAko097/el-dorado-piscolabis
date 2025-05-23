<div class="relative" x-data="{ open: false }" @click.away="open = false">
    <button @click="open = !open" class="text-3xl hover:text-yellow-600 text-yellow-500 flex items-center gap-2 font-bold">
        <i class="bi bi-person-circle"></i>
        <span class="text-sm">{{ auth()->user()->name }}</span>
        <i class="bi bi-chevron-down text-sm"></i>
    </button>

    <div x-show="open" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="transform opacity-0 scale-95"
         x-transition:enter-end="transform opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="transform opacity-100 scale-100"
         x-transition:leave-end="transform opacity-0 scale-95"
         class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50">
        <div class="py-1">
            <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                <i class="bi bi-person-gear mr-2"></i> Editar Perfil
            </a>
            
            @if(auth()->user()->isAdmin() || auth()->user()->isEmpleado())
                <a href="{{ route('productos.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    <i class="bi bi-clipboard-data mr-2"></i> Panel de administrador
                </a>
            @else
                <a href="{{ route('pedidos.mis-pedidos') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    <i class="bi bi-bag mr-2"></i> Mis Pedidos
                </a>
            @endif

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                    <i class="bi bi-box-arrow-right mr-2"></i> Cerrar Sesión
                </button>
            </form>
        </div>
    </div>
</div>
