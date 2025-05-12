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
    class="fixed top-2 left-2 z-50 inline-flex items-center p-2 text-sm text-yellow-500 rounded-lg hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-400">
    <span class="sr-only">Abrir/cerrar sidebar</span>
    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
      xmlns="http://www.w3.org/2000/svg">
      <path clip-rule="evenodd" fill-rule="evenodd"
        d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
      </path>
    </svg>
  </button>

  <!-- Sidebar -->
  <aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen bg-black text-yellow-500 transition-transform transform translate-x-0"
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
    let sidebarVisible = true;

    toggleButton.addEventListener('click', () => {
      sidebarVisible = !sidebarVisible;
      sidebar.classList.toggle('-translate-x-full', !sidebarVisible);
    });
  </script>
</body>
</html>
