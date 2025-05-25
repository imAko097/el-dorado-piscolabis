<div class="shadow-lg">
    @props(['bgColor' => 'bg-white', 'colorText' => 'text-black'])

    <nav id="mainMenu"
        class="{{ $bgColor }} {{ $colorText }} p-6 pl-40 pr-40 flex justify-between items-center fixed top-0 left-0 w-full z-50 transition-all duration-300 ease-in-out shadow-lg">

        <!-- Logo a la izquierda -->
        <a href="{{ route('inicio') }}">
            <img src="{{ asset('storage/img/eldorado.png') }}" alt="Logo" class="bg-white w-20 h-20 rounded-full" />
        </a>

        <!-- Contenedor de botones a la derecha -->
        <div class="flex items-center space-x-6">
            <!-- Botón de login y registro -->
            @auth
            <livewire:user-dropdown :colorText="$colorText" />
            @else
            <a href="{{ route('login') }}" class="text-3xl hover:text-gray-200 flex items-center gap-2 font-bold">
                <i class="bi bi-person-circle"></i> <span class="text-sm">Iniciar sesión</span>
            </a>
            <a href="{{ route('register') }}" class="text-3xl hover:text-yellow-600 flex items-center gap-2 text-yellow-500 font-bold">
                <i class="bi bi-person-plus"></i> <span class="text-sm">Registrarse</span>
            </a>
            @endauth

            <!-- Botón de menú -->
            <button id="menuToggle" class="text-3xl">
                <i id="menuIcon" class="bi bi-list"></i>
            </button>
        </div>
    </nav>

    <!-- Menú desplegable -->
    <div id="dropdownMenu" class="">
        <ul class="p-6 text-5xl">
            <li><a href="{{ route('inicio') }}">Inicio</a></li>
            <li><a href="{{ route('menu') }}">Carta</a></li>
            <li><a href="{{ route('sobrenosotros') }}">Sobre Nosotros</a></li>
            <li><a href="{{ route('contacto') }}">Contacto</a></li>
            @auth
            @if (auth()->user()->role === 'admin' || auth()->user()->role === 'empleado')
            <li><a href="{{ route('productos.index') }}">Panel Admin</a></li>
            @endif
            @endauth
        </ul>
    </div>
</div>
<!-- Scripts -->
@vite('resources/js/menuToggle.js')