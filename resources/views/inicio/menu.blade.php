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

<body class="bg-yellow-50">
    <!-- Menú desplegable -->
    <div>
        <x-menu-toggle />
    </div>

    <!-- Contenido -->
    <div class="pt-32 px-6 md:px-40 text-black min-h-screen">
        <!-- Volver al inicio -->
        <a href="{{ route('inicio') }}"
            class="text-gray-500 flex items-center gap-2 mb-4 hover:text-black hover:underline transition-colors">
            <i class="bi bi-arrow-left"></i>
            Volver
        </a>

        <!-- Carrito -->
        <livewire:carrito />

        <!-- Carta -->
        <h1 class="text-4xl font-bold mb-8 text-center">NUESTRA CARTA</h1>
        <livewire:menu />
    </div>
</body>

</html>