<div>
    
    <nav id="mainMenu"
         class="p-6 pl-40 pr-40 flex justify-between items-center fixed top-0 left-0 w-full bg-transparent text-white z-50 transition-all duration-300 ease-in-out">
        <img src="{{ asset('storage/img/eldorado.png') }}" alt="Logo" class="bg-white w-20 h-20 rounded-full" />
        <button wire:click="toggleMenu" class="text-3xl">
            <i class="bi {{ $menuOpen ? 'bi-x' : 'bi-list' }}"></i>
        </button>
    </nav>

    <!-- Menú desplegable -->
    @if ($menuOpen)
        <div id="dropdownMenu" class="fixed top-0 left-0 w-full h-screen bg-white z-[1000] text-center">
            <nav class="p-6 pl-40 pr-40 flex justify-between items-center">
                <img src="{{ asset('storage/img/eldorado.png') }}" alt="Logo"
                     class="bg-white w-20 h-20 rounded-full" />
                <button wire:click="toggleMenu" class="text-3xl">
                    <i class="bi bi-x"></i>
                </button>
            </nav>
            <ul class="p-5">
                <li class="my-5"><a href="#" class="text-2xl hover:text-yellow-400">Carta</a></li>
                <li class="my-5"><a href="#" class="text-2xl hover:text-yellow-400">Promociones</a></li>
                <li class="my-5"><a href="#" class="text-2xl hover:text-yellow-400">Sobre Nosotros</a></li>
                <li class="my-5"><a href="#" class="text-2xl hover:text-yellow-400">Contáctanos</a></li>
            </ul>
        </div>
    @endif
</div>
