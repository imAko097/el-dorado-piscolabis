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

<body class="bg-[#FFF8F0] text-[#1C1917]">
    <!-- Navbar -->
    <x-menu-toggle />

    <!-- Encabezado -->
    <header class="py-12 shadow-inner">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h1 class="text-4xl font-bold text-[#92400E] mb-2">Perfil de Usuario</h1>
            <p class="text-[#1C1917]">Gestiona tu información personal, seguridad y cuenta.</p>
        </div>
    </header>

    <!-- Contenido principal -->
    <main class="py-12">
        <div class="max-w-4xl mx-auto px-4 space-y-10">

            @if (session('message'))
                <div class="bg-green-100 text-[#15803D] p-2 rounded mb-4">
                    {{ session('message') }}
                </div>
            @endif

            <!-- Actualizar perfil -->
            <section class="bg-white shadow-lg rounded-2xl p-6 border border-[#FCD34D]">
                <h2 class="text-xl font-semibold text-[#92400E] mb-4 flex items-center gap-2">
                    <i class="bi bi-person-circle text-[#92400E]"></i>
                    Información del Perfil
                </h2>

                <livewire:profile.update-profile-information-form />
            </section>

            <!-- Cambiar contraseña -->
            <section class="bg-white shadow-lg rounded-2xl p-6 border border-[#FCD34D]">
                <h2 class="text-xl font-semibold text-[#92400E] mb-4 flex items-center gap-2">
                    <i class="bi bi-shield-lock text-[#92400E]"></i>
                    Cambiar Contraseña
                </h2>
                <livewire:profile.update-password-form />
            </section>

            <!-- Eliminar cuenta -->
            <section class="bg-white shadow-lg rounded-2xl p-6 border border-[#FCD34D]">
                <h2 class="text-xl font-semibold text-[#92400E] mb-4 flex items-center gap-2">
                    <i class="bi bi-trash text-[#92400E]"></i>
                    Eliminar Cuenta
                </h2>
                <livewire:profile.delete-user-form />
            </section>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t mt-16 py-6 text-sm text-center text-[#92400E]">
        <div class="flex justify-center gap-4 flex-wrap">
            <a href="#" class="hover:text-[#92400E]">Legal</a>
            <a href="#" class="hover:text-[#92400E]">Privacidad</a>
            <a href="#" class="hover:text-[#92400E]">Cookies</a>
            <a href="#" class="hover:text-[#92400E]">Condiciones</a>
        </div>
        <div class="mt-4 text-[#92400E]">🍴 El Dorado Piscolabis © 2025</div>
    </footer>
</body>

</html>
