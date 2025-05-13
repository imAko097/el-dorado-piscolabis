<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sidebar y Contenido</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body class="bg-gray-100 dark:bg-gray-900">

  <!-- Botón SIEMPRE visible -->
<button id="sidebar-toggle" aria-controls="logo-sidebar" type="button"
  class="fixed top-2 left-2 z-50 inline-flex items-center p-2 text-sm text-yellow-200 bg-black rounded-lg hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-400">
  <span class="sr-only">Abrir/cerrar sidebar</span>
  <svg id="toggle-icon" class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
    xmlns="http://www.w3.org/2000/svg">
    <path clip-rule="evenodd" fill-rule="evenodd"
      d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
    </path>
  </svg>
</button>



  <!-- Sidebar -->
  <aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen bg-black -500 text-yellow-200 transition-transform transform translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto">
      <div class="p-6 text-center text-3xl font-extrabold border-b border-yellow-500">
        <span class="block text-3xl">El</span>
        <span class="block text-5xl">Dorado</span>
      </div>
      <ul class="space-y-2 font-medium mt-6">
        <li>
          <a href="#" class="flex items-center p-2 rounded-lg hover:bg-yellow-700 hover:text-white group">
            <svg class="w-5 h-5 transition duration-75 group-hover:text-white" fill="currentColor"
              viewBox="0 -960 960 960">
              <path
                d="M240-200h120v-240h240v240h120v-360L480-740 240-560v360Zm-80 80v-480l320-240 320 240v480H520v-240h-80v240H160Zm320-350Z" />
            </svg>
            <span class="ms-3">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="#" class="flex items-center p-2 rounded-lg hover:bg-yellow-700 hover:text-white group">
            <svg class="w-5 h-5 transition duration-75 group-hover:text-white" fill="currentColor"
              viewBox="0 -960 960 960">
              <path
                d="M533-440q-32-45-84.5-62.5T340-520q-56 0-108.5 17.5T147-440h386ZM40-360q0-109 91-174.5T340-600q118 0 209 65.5T640-360H40Zm0 160v-80h600v80H40ZM720-40v-80h56l56-560H450l-10-80h200v-160h80v160h200L854-98q-3 25-22 41.5T788-40h-68Zm0-80h56-56ZM80-40q-17 0-28.5-11.5T40-80v-40h600v40q0 17-11.5 28.5T600-40H80Zm260-400Z" />
            </svg>
            <span class="ms-3">Productos</span>
          </a>
        </li>
        <li>
          <a href="#" class="flex items-center p-2 rounded-lg hover:bg-yellow-700 hover:text-white group">
            <svg class="w-5 h-5 transition duration-75 group-hover:text-white" fill="currentColor" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px">
              <path d="M400-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM80-160v-112q0-33 17-62t47-44q51-26 115-44t141-18h14q6 0 12 2-8 18-13.5 37.5T404-360h-4q-71 0-127.5 18T180-306q-9 5-14.5 14t-5.5 20v32h252q6 21 16 41.5t22 38.5H80Zm560 40-12-60q-12-5-22.5-10.5T584-204l-58 18-40-68 46-40q-2-14-2-26t2-26l-46-40 40-68 58 18q11-8 21.5-13.5T628-460l12-60h80l12 60q12 5 22.5 11t21.5 15l58-20 40 70-46 40q2 12 2 25t-2 25l46 40-40 68-58-18q-11 8-21.5 13.5T732-180l-12 60h-80Zm40-120q33 0 56.5-23.5T760-320q0-33-23.5-56.5T680-400q-33 0-56.5 23.5T600-320q0 33 23.5 56.5T680-240ZM400-560q33 0 56.5-23.5T480-640q0-33-23.5-56.5T400-720q-33 0-56.5 23.5T320-640q0 33 23.5 56.5T400-560Zm0-80Zm12 400Z"/>
          </svg>
            <span class="ms-3">Usuarios</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>

  <main class="pl-64 p-4">
    @yield('content')
  </main>

  <!-- Script para abrir/cerrar sidebar -->
  <script>
    const toggleButton = document.getElementById('sidebar-toggle');
    const sidebar = document.getElementById('logo-sidebar');
    const icon = document.getElementById('toggle-icon');
    let sidebarVisible = true;

    const hamburgerIcon = `
      <path clip-rule="evenodd" fill-rule="evenodd"
        d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
      </path>
    `;

    const closeIcon = `
      <path fill-rule="evenodd" clip-rule="evenodd"
        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 
        1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 
        1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 
        10 4.293 5.707a1 1 0 010-1.414z"/>
    `;

    toggleButton.addEventListener('click', () => {
      sidebarVisible = !sidebarVisible;
      sidebar.classList.toggle('-translate-x-full', !sidebarVisible);
      icon.innerHTML = sidebarVisible ? closeIcon : hamburgerIcon;
    });
  </script>

</body>
</html>
