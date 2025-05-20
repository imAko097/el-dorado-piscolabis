<div>
    <nav id="mainMenu"
        class="p-6 pl-40 pr-40 flex justify-between items-center fixed top-0 left-0 w-full bg-transparent text-white z-50 transition-all duration-300 ease-in-out">
        <img src="{{ asset('storage/img/eldorado.png') }}" alt="Logo" class="bg-white w-20 h-20 rounded-full" />
        <!-- Botón de menú en el navbar -->
        <button id="menuToggle" class="text-3xl">
            <i id="menuIcon" class="bi bi-list text-black"></i>
        </button>
    </nav>
    <div id="dropdownMenu">
        <ul class="p-6 text-5xl">
            <li><a href="{{ route('inicio') }}">Inicio</a></li>
            <li><a href="{{ route('menu') }}">Carta</a></li>
            <li><a href="{{ route('sobrenosotros') }}">Sobre Nosotros</a></li>
            <li><a href="{{ route('contacto') }}">Contacto</a></li>
        </ul>
    </div>
</div>

@vite('resources/js/menuToggle.js')
@vite('resources/js/overflow.js')
