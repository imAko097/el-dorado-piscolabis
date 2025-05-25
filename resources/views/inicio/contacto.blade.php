<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contacto - El Dorado</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/inicio/styles.css') }}">
    <livewire:styles />
</head>

<body class="bg-[#FFF8F0] text-[#1C1917]">

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
    <section class="relative h-96">
        <img src="{{ asset('storage/img/contacto-banner.jpg') }}" alt="Contáctanos"
            class="absolute inset-0 w-full h-full object-cover" />
        <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
            <h1 class="text-white text-4xl md:text-5xl font-bold text-center">Contáctanos</h1>
        </div>
    </section>

    <!-- Información y formulario -->
    <section class="max-w-6xl mx-auto py-16 px-4 grid md:grid-cols-2 gap-10">
        <!-- Información de contacto -->
        <div>
            <h2 class="text-3xl font-bold text-[#92400E] mb-6">Estamos aquí para ti</h2>
            <p class="text-lg mb-6">
                ¿Tienes preguntas, sugerencias o quieres reservar una mesa? Puedes contactarnos por cualquiera de estos medios:
            </p>

            <ul class="space-y-4 text-gray-800">
                <li><i class="bi bi-telephone-fill text-yellow-500 mr-2"></i><strong>Teléfono:</strong> +34 928 71 59 00</li>
                <li><i class="bi bi-envelope-fill text-yellow-500 mr-2"></i><strong>Email:</strong> contacto@eldorado.com</li>
                <li><i class="bi bi-geo-alt-fill text-yellow-500 mr-2"></i><strong>Dirección:</strong> C. Manuel Alemán Álamo, 35220 Valle de Jinamar, Las Palmas</li>
                <li><i class="bi bi-clock-fill text-yellow-500 mr-2"></i><strong>Horario:</strong> Lun-Dom 12:00 – 23:00</li>
            </ul>

            <!-- Mapa -->
            <div class="mt-10">
                <iframe class="w-full h-64 rounded-2xl shadow-lg"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3363.175099309951!2d-15.408437984519056!3d28.00989501503308!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xc40958e7b187fc3%3A0x6f0cc5b48fa4725d!2sC.%20Manuel%20Alem%C3%A1n%20%C3%81lamo%2C%2035220%20Valle%20de%20Jin%C3%A1mar%2C%20Las%20Palmas!5e0!3m2!1ses!2ses!4v1716617750000!5m2!1ses!2ses"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

        </div>

        <!-- Formulario de contacto -->

      @livewire('contacto-form')
    </section>

    <!-- Footer -->
    <footer class="bg-white border-t mt-10">
        <div class="max-w-7xl mx-auto px-4 py-6 text-center text-sm text-[#1C1917] space-y-2">
            <div class="flex flex-wrap justify-center gap-4">
                <a href="#" class="hover:underline text-[#92400E]">Legal</a>
                <a href="#" class="hover:underline text-[#92400E]">Política de privacidad</a>
                <a href="#" class="hover:underline text-[#92400E]">Política de cookies</a>
                <a href="#" class="hover:underline text-[#92400E]">Términos y Condiciones</a>
            </div>
            <div class="flex items-center justify-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#B7791F">
                    <path d="M280-80v-366q-51-14-85.5-56T160-600v-280h80v280h40v-280h80v280h40v-280h80v280q0 56-34.5 98T360-446v366h-80Zm400 0v-320H560v-280q0-83 58.5-141.5T760-880v800h-80Z"/>
                </svg>
                <span>Copyright © 2025 El Dorado Piscolabis</span>
            </div>
        </div>
    </footer>
    <livewire:scripts />
</body>

</html>