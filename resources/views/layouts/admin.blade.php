<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('page-title', 'Título por defecto')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F0F4FA] text-black">

    <!-- Botón para abrir/cerrar sidebar -->
    <button id="sidebar-toggle" aria-controls="logo-sidebar" aria-expanded="false"
        class="fixed top-2 left-2 z-50 inline-flex items-center p-2 text-sm bg-gray-500 text-white rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black">
        <span class="sr-only">Abrir/cerrar sidebar</span>
        <svg id="toggle-icon" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
            <path clip-rule="evenodd" fill-rule="evenodd"
                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z" />
        </svg>
    </button>

    <!-- Sidebar -->
    <aside id="logo-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen bg-gray-200 text-black transition-transform transform -translate-x-full shadow-lg"
        aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto">
            <div class="p-6 text-center text-3xl font-extrabold border-b border-gray-800">
                <span class="block text-3xl">El</span>
                <span class="block text-5xl">Dorado</span>
            </div>
            <ul class="space-y-2 font-medium mt-6">
                <li>
                    <a href="{{ route('inicio') }}"
                        class="flex items-center p-2 rounded-lg hover:bg-gray-400 hover:text-white focus:outline focus:ring-2 focus:ring-black">
                        <svg class="w-5 h-5 transition duration-75" fill="currentColor" viewBox="0 -960 960 960">
                            <path
                                d="M240-200h120v-240h240v240h120v-360L480-740 240-560v360Zm-80 80v-480l320-240 320 240v480H520v-240h-80v240H160Zm320-350Z" />
                        </svg>
                        <span class="ms-3">Inicio</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('productos.index') }}"
                        class="flex items-center p-2 rounded-lg hover:bg-gray-400 hover:text-white focus:outline focus:ring-2 focus:ring-black">
                        <svg class="w-5 h-5 transition duration-75" fill="currentColor" viewBox="0 -960 960 960">
                            <path
                                d="M533-440q-32-45-84.5-62.5T340-520q-56 0-108.5 17.5T147-440h386ZM40-360q0-109 91-174.5T340-600q118 0 209 65.5T640-360H40Zm0 160v-80h600v80H40ZM720-40v-80h56l56-560H450l-10-80h200v-160h80v160h200L854-98q-3 25-22 41.5T788-40h-68Zm0-80h56-56ZM80-40q-17 0-28.5-11.5T40-80v-40h600v40q0 17-11.5 28.5T600-40H80Zm260-400Z" />
                        </svg>
                        <span class="ms-3">Productos</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pedidos.index') }}"
                        class="flex items-center p-2 rounded-lg hover:bg-gray-400 hover:text-white focus:outline focus:ring-2 focus:ring-black">
                        <svg class="w-5 h-5 transition duration-75" fill="currentColor" viewBox="0 -960 960 960">
                            <path
                                d="M280-80q-33 0-56.5-23.5T200-160q0-33 23.5-56.5T280-240q33 0 56.5 23.5T360-160q0 33-23.5 56.5T280-80Zm400 0q-33 0-56.5-23.5T600-160q0-33 23.5-56.5T680-240q33 0 56.5 23.5T760-160q0 33-23.5 56.5T680-80ZM246-720l96 200h280l110-200H246Zm-38-80h590q23 0 35 20.5t1 41.5L692-482q-11 20-29.5 31T622-440H324l-44 80h480v80H280q-45 0-68-39.5t-2-78.5l54-98-144-304H40v-80h130l38 80Zm134 280h280-280Z" />
                        </svg>
                        <span class="ms-3">Pedidos</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('usuarios.index') }}"
                        class="flex items-center p-2 rounded-lg hover:bg-gray-400 hover:text-white focus:outline focus:ring-2 focus:ring-black">
                        <svg class="w-5 h-5 transition duration-75" fill="currentColor" viewBox="0 -960 960 960">
                            <path
                                d="M400-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM80-160v-112q0-33 17-62t47-44q51-26 115-44t141-18h14q6 0 12 2-8 18-13.5 37.5T404-360h-4q-71 0-127.5 18T180-306q-9 5-14.5 14t-5.5 20v32h252q6 21 16 41.5t22 38.5H80Z" />
                        </svg>
                        <span class="ms-3">Usuarios</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <div id="main-container" class="transition-all duration-300 pl-8">
        <main id="main-content" class="p-4">
            @yield('content')
        </main>
        @yield('scripts')
        @stack('scripts')
        @livewireScripts
    </div>
    <!-- Script para abrir/cerrar sidebar -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggleButton = document.getElementById('sidebar-toggle');
            const sidebar = document.getElementById('logo-sidebar');
            const icon = document.getElementById('toggle-icon');
            const mainContainer = document.getElementById('main-container');

            const hamburgerIcon = `
      <path clip-rule="evenodd" fill-rule="evenodd"
        d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"/>
    `;

            const closeIcon = `
      <path fill-rule="evenodd" clip-rule="evenodd"
        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 
        1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 
        1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 
        10 4.293 5.707a1 1 0 010-1.414z"/>
    `;

            let sidebarVisible = window.innerWidth >= 768;

            const updateUI = () => {
                const isDesktop = window.innerWidth >= 768;

                // Limpiar clases previas
                sidebar.classList.remove('translate-x-full', '-translate-x-full', 'translate-x-0');

                if (sidebarVisible) {
                    sidebar.classList.add('translate-x-0');
                    mainContainer.classList.remove('pl-8');
                    mainContainer.classList.add(isDesktop ? 'pl-64' : 'pl-8');
                    icon.innerHTML = closeIcon;
                } else {
                    // Si es escritorio, lo ocultamos hacia la izquierda. Si es móvil, hacia la derecha.
                    sidebar.classList.add(isDesktop ? '-translate-x-full' : 'translate-x-full');
                    mainContainer.classList.remove('pl-64');
                    mainContainer.classList.add('pl-8');
                    icon.innerHTML = hamburgerIcon;
                }
            };

            toggleButton.addEventListener('click', () => {
                sidebarVisible = !sidebarVisible;
                updateUI();
            });

            window.addEventListener('resize', () => {
                sidebarVisible = window.innerWidth >= 768;
                updateUI();
            });

            updateUI();
        });
    </script>

</body>

</html>
