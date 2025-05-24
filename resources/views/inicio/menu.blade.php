<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/inicio/styles.css') }}">
    <title>El Dorado - Menú</title>
</head>

<body style="background-color: #FFF8F0;" class="min-h-screen text-[#1C1917]">

    @php
        $isMenu = request()->routeIs('menu');
        $bgColor = $isMenu ? '#FFFFFF' : 'transparent';
        $colorText = $isMenu ? '#1C1917' : '#FFFFFF';
    @endphp

    <script>
        window.menuColors = {
            bgColor: "{{ $bgColor }}",
            colorText: "{{ $colorText }}"
        };
    </script>

    <x-menu-toggle :colorText="$colorText" :bgColor="$bgColor" />

    <!-- Contenido -->
    <div class="pt-32 px-6 md:px-40" style="color: #1C1917;">
        <!-- Volver al inicio -->
        <a href="{{ route('inicio') }}"
            class="text-gray-500 flex items-center gap-2 mb-4 hover:text-[#1C1917] hover:underline transition-colors">
            <i class="bi bi-arrow-left"></i>
            Volver
        </a>

        <!-- Carrito -->
        <livewire:carrito />

        <!-- Carta -->
        <h1 class="text-4xl font-bold mb-8 text-center" style="color: #92400E;">NUESTRA CARTA</h1>
        <livewire:menu />
    </div>

    <!-- Footer -->
    <footer style="background-color: #FFFFFF; border-top: 2px solid #FCD34D;" class="mt-10">
        <div class="max-w-7xl mx-auto px-4 py-6 text-center text-sm text-[#1C1917]">
            <div class="flex flex-wrap justify-center gap-4">
                <a href="#" class="hover:underline" style="color: #92400E;">Legal</a>
                <a href="#" class="hover:underline" style="color: #92400E;">Política de privacidad</a>
                <a href="#" class="hover:underline" style="color: #92400E;">Política de cookies</a>
                <a href="#" class="hover:underline" style="color: #92400E;">Bases legales promociones y sorteos</a>
                <a href="#" class="hover:underline" style="color: #92400E;">Términos y Condiciones</a>
                <a href="#" class="hover:underline" style="color: #92400E;">Configuración de cookies</a>
            </div>
            <div class="flex items-center justify-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#92400E">
                    <path d="M280-80v-366q-51-14-85.5-56T160-600v-280h80v280h40v-280h80v280h40v-280h80v280q0 56-34.5 98T360-446v366h-80Zm400 0v-320H560v-280q0-83 58.5-141.5T760-880v800h-80Z"/>
                </svg>
                <span>Copyright © 2025 El Dorado Piscolabis</span>
            </div>
        </div>
    </footer>
</body>

</html>
