<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sobre Nosotros - El Dorado</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/inicio/styles.css') }}">
</head>

<body class="bg-white text-black">
    
  @php
        $isInicio = request()->routeIs('inicio');
        $bgColor = $isInicio ? 'bg-transparent' : 'bg-white';
        $colorText = $isInicio ? 'text-white' : 'text-black';
    @endphp

    <script>
        window.menuColors = {
            bgColor: "{{ $bgColor }}",
            colorText: "{{ $colorText }}"
        };
    </script>

    <x-menu-toggle :colorText="$colorText" :bgColor="$bgColor" />

    <!-- Encabezado -->
    <section class="relative h-96">
        <img src="{{ asset('storage/img/sobrenosotros.webp') }}" alt="Sobre Nosotros"
            class="absolute inset-0 w-full h-full object-cover" />
        <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
            <h1 class="text-white text-4xl md:text-5xl font-bold text-center">Sobre Nosotros</h1>
        </div>
    </section>

    <!-- Contenido principal -->
    <section class="max-w-5xl mx-auto py-16 px-4 text-gray-800 space-y-12">
        <div class="text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-yellow-500 mb-4">Pasión por la buena comida</h2>
            <p class="text-lg leading-relaxed">
                En <strong>El Dorado</strong>, creemos que cada plato cuenta una historia. Desde nuestros humildes inicios,
                nos hemos dedicado a ofrecer una experiencia culinaria única basada en ingredientes frescos,
                recetas caseras y un ambiente acogedor para toda la familia.
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-10 items-center">
            <img src="{{ asset('storage/img/nuestra-historia.jpg') }}" alt="Nuestra Historia"
                class="w-full h-80 object-cover rounded-2xl shadow-lg">
            <div>
                <h3 class="text-2xl font-semibold text-yellow-600 mb-2">Nuestra Historia</h3>
                <p class="text-base leading-relaxed">
                    Desde 2010, hemos crecido junto a nuestra comunidad, manteniendo siempre la esencia de la cocina
                    tradicional y el cariño en cada preparación. Lo que comenzó como un pequeño local familiar, hoy es un
                    referente gastronómico en la zona.
                </p>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-10 items-center">
            <div>
                <h3 class="text-2xl font-semibold text-yellow-600 mb-2">Misión y Valores</h3>
                <ul class="list-disc list-inside space-y-2">
                    <li><strong>Calidad:</strong> Usamos ingredientes frescos y de temporada.</li>
                    <li><strong>Cercanía:</strong> Nos preocupamos por cada cliente como si fuera parte de la familia.</li>
                    <li><strong>Pasión:</strong> Cocinamos con alma y corazón.</li>
                    <li><strong>Innovación:</strong> Renovamos nuestros platos sin perder la tradición.</li>
                </ul>
            </div>
            <img src="{{ asset('storage/img/valores.jpg') }}" alt="Misión y Valores"
                class="w-full h-80 object-cover rounded-2xl shadow-lg">
        </div>
    </section>

    <!-- Equipo -->
    <section class="bg-yellow-400 py-16">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-white mb-10">Conoce al equipo</h2>
            <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-10">
                <!-- Miembro del equipo -->
                <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                    <img src="{{ asset('storage/img/chef1.jpg') }}" alt="Chef Ana"
                        class="w-full h-60 object-cover">
                    <div class="p-4">
                        <h3 class="text-xl font-semibold text-gray-800">Ana García</h3>
                        <p class="text-gray-600 text-sm">Chef Ejecutiva</p>
                    </div>
                </div>
                <!-- Otro miembro -->
                <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                    <img src="{{ asset('storage/img/chef2.jpg') }}" alt="Chef Marco"
                        class="w-full h-60 object-cover">
                    <div class="p-4">
                        <h3 class="text-xl font-semibold text-gray-800">Marco Díaz</h3>
                        <p class="text-gray-600 text-sm">Maestro Parrillero</p>
                    </div>
                </div>
                <!-- Otro miembro -->
                <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                    <img src="{{ asset('storage/img/chef3.jpg') }}" alt="Manager"
                        class="w-full h-60 object-cover">
                    <div class="p-4">
                        <h3 class="text-xl font-semibold text-gray-800">Laura Pérez</h3>
                        <p class="text-gray-600 text-sm">Gerente General</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white border-t mt-10">
        <div class="max-w-7xl mx-auto px-4 py-6 text-center text-sm text-gray-700 space-y-2">
            <div class="flex flex-wrap justify-center gap-4">
                <a href="#" class="hover:underline">Legal</a>
                <a href="#" class="hover:underline">Política de privacidad</a>
                <a href="#" class="hover:underline">Política de cookies</a>
                <a href="#" class="hover:underline">Términos y Condiciones</a>
            </div>
            <div class="flex items-center justify-center space-x-2">
                <span class="text-yellow-500 text-lg">🍴</span>
                <span>Copyright © 2025 El Dorado Piscolabis</span>
            </div>
        </div>
    </footer>
</body>

</html>
