<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('page-title', 'Título por defecto')</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <script>
    const nav = performance.getEntriesByType("navigation")[0];
    if (nav && nav.type !== "reload") {
        window.location.reload();
    }
</script>
  
  @livewireStyles
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F0F4FA] text-black">

<div id="page-loader" class="fixed inset-0 z-50 flex items-center justify-center bg-white transition-opacity duration-500">

  <svg class="animate-spin h-12 w-12 text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
    <path class="opacity-75" fill="currentColor"
      d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z">
    </path>
  </svg>
</div>

<button id="sidebar-toggle" aria-controls="logo-sidebar" type="button"
  class="fixed top-2 z-50 inline-flex items-center p-2 text-sm text-white bg-gray-500 rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black
       right-2 md:left-2 md:right-auto"
>
  <span class="sr-only">Abrir/cerrar sidebar</span>
  <svg id="toggle-icon" class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
    xmlns="http://www.w3.org/2000/svg">
    <path fill-rule="evenodd" clip-rule="evenodd"
      d="M15.78 3.22a.75.75 0 010 1.06L9.06 11l6.72 6.72a.75.75 0 11-1.06 1.06l-7.25-7.25a.75.75 0 010-1.06l7.25-7.25a.75.75 0 011.06 0z"/>
  </svg>
</button>

<aside id="logo-sidebar"
  class="fixed top-0 md:left-0 right-0 z-40 w-64 h-screen bg-gray-200 text-black transform transition-transform duration-300 translate-x-full shadow-lg"
  aria-label="Sidebar">
  <div class="h-full px-3 py-4 overflow-y-auto">  
      <div class="p-6 text-center text-3xl font-extrabold border-b border-gray-800">
        <span class="block text-3xl">El</span>
        <span class="block text-5xl">Dorado</span>
      </div>
      <ul class="space-y-2 font-medium mt-6">
        <li>
          <a href="{{ route('inicio') }}" class="flex items-center p-2 rounded-lg hover:bg-gray-400 hover:text-white focus:outline focus:ring-2 focus:ring-black">
            <svg class="w-5 h-5 transition duration-75" fill="currentColor" viewBox="0 -960 960 960">
              <path d="M240-200h120v-240h240v240h120v-360L480-740 240-560v360Zm-80 80v-480l320-240 320 240v480H520v-240h-80v240H160Zm320-350Z" />
            </svg>
            <span class="ms-3">Inicio</span>
          </a>
        </li>
        <li>
          <a href="{{ route('productos.index') }}" class="flex items-center p-2 rounded-lg hover:bg-gray-400 hover:text-white focus:outline focus:ring-2 focus:ring-black">
            <svg class="w-5 h-5 transition duration-75" fill="currentColor" viewBox="0 -960 960 960">
              <path d="M533-440q-32-45-84.5-62.5T340-520q-56 0-108.5 17.5T147-440h386ZM40-360q0-109 91-174.5T340-600q118 0 209 65.5T640-360H40Zm0 160v-80h600v80H40ZM720-40v-80h56l56-560H450l-10-80h200v-160h80v160h200L854-98q-3 25-22 41.5T788-40h-68Zm0-80h56-56ZM80-40q-17 0-28.5-11.5T40-80v-40h600v40q0 17-11.5 28.5T600-40H80Zm260-400Z" />
            </svg>
            <span class="ms-3">Productos</span>
          </a>
        </li>
        <li>
          <a href="{{ route('pedidos.index') }}" class="flex items-center p-2 rounded-lg hover:bg-gray-400 hover:text-white focus:outline focus:ring-2 focus:ring-black">
            <svg class="w-5 h-5 transition duration-75" fill="currentColor" viewBox="0 -960 960 960">
              <path d="M280-80q-33 0-56.5-23.5T200-160q0-33 23.5-56.5T280-240q33 0 56.5 23.5T360-160q0 33-23.5 56.5T280-80Zm400 0q-33 0-56.5-23.5T600-160q0-33 23.5-56.5T680-240q33 0 56.5 23.5T760-160q0 33-23.5 56.5T680-80ZM246-720l96 200h280l110-200H246Zm-38-80h590q23 0 35 20.5t1 41.5L692-482q-11 20-29.5 31T622-440H324l-44 80h480v80H280q-45 0-68-39.5t-2-78.5l54-98-144-304H40v-80h130l38 80Zm134 280h280-280Z" />
            </svg>
            <span class="ms-3">Pedidos</span>
          </a>
        </li>
        <li>
          <a href="{{ route('usuarios.index') }}" class="flex items-center p-2 rounded-lg hover:bg-gray-400 hover:text-white focus:outline focus:ring-2 focus:ring-black">
            <svg class="w-5 h-5 transition duration-75" fill="currentColor" viewBox="0 -960 960 960">
              <path d="M400-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM80-160v-112q0-33 17-62t47-44q51-26 115-44t141-18h14q6 0 12 2-8 18-13.5 37.5T404-360h-4q-71 0-127.5 18T180-306q-9 5-14.5 14t-5.5 20v32h252q6 21 16 41.5t22 38.5H80Zm560 40-12-60q-12-5-22.5-10.5T584-204l-58 18-40-68 46-40q-2-14-2-26t2-26l-46-40 40-68 58 18q11-8 21.5-13.5T628-460l12-60h80l12 60q12 5 22.5 11t21.5 15l58-20 40 70-46 40q2 12 2 25t-2 25l46 40-40 68-58-18q-11 8-21.5 13.5T732-180l-12 60h-80Zm40-120q33 0 56.5-23.5T760-320q0-33-23.5-56.5T680-400q-33 0-56.5 23.5T600-320q0 33 23.5 56.5T680-240ZM400-560q33 0 56.5-23.5T480-640q0-33-23.5-56.5T400-720q-33 0-56.5 23.5T320-640q0 33 23.5 56.5T400-560Zm0-80Zm12 400Z"/>
            </svg>
            <span class="ms-3">Usuarios</span>
          </a>
        </li>

        <li>
          <a href="{{ route('carrusel.index') }}" class="flex items-center p-2 rounded-lg hover:bg-gray-400 hover:text-white focus:outline focus:ring-2 focus:ring-black">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f">
              <path d="m480-420 240-160-240-160v320Zm28 220h224q-7 26-24 42t-44 20L228-85q-33 5-59.5-15.5T138-154L85-591q-4-33 16-59t53-30l46-6v80l-36 5 54 437 290-36Zm-148-80q-33 0-56.5-23.5T280-360v-440q0-33 23.5-56.5T360-880h440q33 0 56.5 23.5T880-800v440q0 33-23.5 56.5T800-280H360Zm0-80h440v-440H360v440Zm220-220ZM218-164Z"/>
            </svg>
              <span class="ms-3">Carrusel Imagenes</span>
          </a>
        </li>

        <li>
            <a href="{{ route('menu') }}" class="flex items-center p-2 rounded-lg hover:bg-gray-400 hover:text-white focus:outline focus:ring-2 focus:ring-black">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition duration-75" viewBox="0 -960 960 960" fill="currentColor">
                <path d="M80-200v-80h800v80H80Zm40-120v-40q0-128 78.5-226T400-710v-10q0-33 23.5-56.5T480-800q33 0 56.5 23.5T560-720v10q124 26 202 124t78 226v40H120Zm82-80h556q-14-104-93-172t-185-68q-106 0-184.5 68T202-400Zm278 0Z"/>
              </svg>
                <span class="ms-3">Menú</span>
            </a>
        </li>
      </ul>
    </div>

    <div class="absolute bottom-0 left-0 w-full p-4 border-t border-gray-300 bg-gray-100">
    <div x-data="{ open: false }" class="relative">
        <button @click="open = !open" class="w-full flex items-center justify-between text-sm font-medium text-left">
            <div>
                <div class="text-sm font-semibold">{{ Auth::user()->name }}</div>
                <div class="text-xs text-gray-600">{{ Auth::user()->email }}</div>
            </div>
            <svg class="w-5 h-5 text-gray-600 transform transition-transform duration-200"
                :class="{ 'rotate-180': open }"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </button>

        <div x-show="open" @click.away="open = false" x-transition
            class="absolute bottom-full mb-2 w-full bg-gray-300 rounded-lg p-2 space-y-1">
            <a href="{{ route('profile') }}"
              class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-400 hover:text-white rounded">Editar perfil</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                  class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-400 hover:text-white rounded">
                  Cerrar sesión
                </button>
            </form>
        </div>
    </div>
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

    const arrowLeftIcon = `
      <path fill-rule="evenodd" clip-rule="evenodd"
        d="M15.78 3.22a.75.75 0 010 1.06L9.06 11l6.72 6.72a.75.75 0 11-1.06 1.06l-7.25-7.25a.75.75 0 010-1.06l7.25-7.25a.75.75 0 011.06 0z"/>
    `;

    const arrowRightIcon = `
      <path fill-rule="evenodd" clip-rule="evenodd"
        d="M8.22 3.22a.75.75 0 000 1.06L14.94 11l-6.72 6.72a.75.75 0 101.06 1.06l7.25-7.25a.75.75 0 000-1.06L9.28 3.22a.75.75 0 00-1.06 0z"/>
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
        icon.innerHTML = isDesktop ? arrowLeftIcon : arrowRightIcon;
      } else {
        sidebar.classList.add(isDesktop ? '-translate-x-full' : 'translate-x-full');
        mainContainer.classList.remove('pl-64');
        mainContainer.classList.add('pl-8');
        icon.innerHTML = isDesktop ? arrowRightIcon : arrowLeftIcon;
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

  
    // Ocultar loader cuando se carga la página
    window.addEventListener('load', () => {
      const loader = document.getElementById('page-loader');
      if (loader) {
        loader.classList.add('opacity-0');
        setTimeout(() => loader.remove(), 500);
      }
    });
</script>

</body>
</html>