<div>
    <nav id="mainMenu"
        class="p-6 pl-40 pr-40 flex justify-between items-center fixed top-0 left-0 w-full bg-transparent text-white z-50 transition-all duration-300 ease-in-out shadow-lg">

        <!-- Logo a la izquierda -->
        <img src="{{ asset('storage/img/eldorado.png') }}" alt="Logo" class="bg-white w-20 h-20 rounded-full" />

        <!-- Contenedor de botones a la derecha -->
        <div class="flex items-center space-x-6">
            <!-- Botón de login y registro -->
            @auth
                <a href="{{ auth()->user()->isAdmin() || auth()->user()->isEmpleado() ? route('pedidos.index') : route('pedidos.mis-pedidos') }}" class="text-3xl hover:text-yellow-600 text-yellow-500 flex items-center gap-2 font-bold">
                    <i class="bi bi-person-circle"></i> <span class="text-sm">{{ auth()->user()->name }}</span>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-3xl text-red-300 hover:text-red-500 flex items-center gap-2" title="Cerrar sesión">
                        <i class="bi bi-box-arrow-right"></i>
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-3xl hover:text-yellow-600 flex items-center gap-2 text-gray-400 font-bold">
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
    <div id="dropdownMenu">
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
@vite('resources/js/overflow.js')
