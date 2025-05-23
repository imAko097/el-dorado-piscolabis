<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Dorado - Menú</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/inicio/styles.css') }}">
</head>

<body>


    @php
        $isProfile = request()->routeIs('profile');
        $bgColor = $isProfile ? 'bg-white' : 'bg-transparent';
        $colorText = $isProfile ? 'text-black' : 'text-white';
    @endphp

    <script>
        window.menuColors = {
            bgColor: "{{ $bgColor }}",
            colorText: "{{ $colorText }}"
        };
    </script>


    <x-menu-toggle :colorText="$colorText" :bgColor="$bgColor" />

    <!-- Encabezado -->
    <header class=" py-12 shadow-inner">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Perfil de Usuario</h1>
            <p class="text-gray-700">Gestiona tu información personal, seguridad y cuenta.</p>
        </div>
    </header>

    <!-- Contenido principal -->
    <main class="py-12 bg-yellow-50">
        <div class="max-w-4xl mx-auto px-4 space-y-10">

            @if (session('message'))
                <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
                    {{ session('message') }}
                </div>
            @endif

            <!-- Actualizar perfil -->
            <section class="bg-white shadow-lg rounded-2xl p-6 border border-yellow-200">
                <h2 class="text-xl font-semibold text-yellow-600 mb-4 flex items-center gap-2">
                    <i class="bi bi-person-circle text-yellow-500"></i>
                    Información del Perfil
                </h2>
                <livewire:profile.update-profile-information-form />
            </section>

            <!-- Cambiar contraseña -->
            <section class="bg-white shadow-lg rounded-2xl p-6 border border-yellow-200">
                <h2 class="text-xl font-semibold text-yellow-600 mb-4 flex items-center gap-2">
                    <i class="bi bi-shield-lock text-yellow-500"></i>
                    Cambiar Contraseña
                </h2>
                <livewire:profile.update-password-form />
            </section>

            <!-- Eliminar cuenta -->
            <section class="bg-white shadow-lg rounded-2xl p-6 border border-yellow-200">
                <h2 class="text-xl font-semibold text-yellow-600 mb-4 flex items-center gap-2">
                    <i class="bi bi-trash text-yellow-500"></i>
                    Eliminar Cuenta
                </h2>
                <livewire:profile.delete-user-form />
            </section>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t mt-16 py-6 text-sm text-center text-gray-500">
        <div class="flex justify-center gap-4 flex-wrap">
            <a href="#" class="hover:text-yellow-600">Legal</a>
            <a href="#" class="hover:text-yellow-600">Privacidad</a>
            <a href="#" class="hover:text-yellow-600">Cookies</a>
            <a href="#" class="hover:text-yellow-600">Condiciones</a>
        </div>
        <div class="mt-4 text-yellow-500">🍴 El Dorado Piscolabis © 2025</div>
    </footer>
</body>

</html>
