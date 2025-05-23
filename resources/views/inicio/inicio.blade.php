<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>El Dorado - Restaurante</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/inicio/styles.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <style>
        .carousel {
            position: relative;
            width: 100%;
            height: 610px;
            /* o lo que necesites */
        }

        .carousel-item {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 1s ease-in-out;
            z-index: 0;
        }

        .carousel-item.active {
            opacity: 1;
            z-index: 1;
        }

        .carousel-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>

    @vite('resources/js/carrusel.js')
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


    <!-- Carrusel -->
    <div class="relative overflow-hidden">
        <div class="carousel">
            @foreach ($carrusel_imagenes as $index => $imagen)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    <img src="{{ $imagen->imagen }}" alt="Imagen del carrusel" />
                    <div class="absolute inset-0 bg-black bg-opacity-40"></div>
                </div>
            @endforeach
        </div>

        <div class="carousel-indicators flex justify-center mt-4">
            @foreach ($carrusel_imagenes as $index => $imagen)
                <div class="indicator" data-index="{{ $index }}"></div>
            @endforeach
        </div>
    </div>


    <section class="bg-yellow-400 py-10 px-4">
        <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-6">
            <!-- Tarjeta 1 -->
            <div class="relative rounded-2xl overflow-hidden shadow-lg h-72">
                <img src="{{ asset('storage/img/div1.jpg') }}" alt="Delicias para compartir"
                    class="absolute inset-0 w-full h-full object-cover" />
                <div class="absolute inset-0 bg-black bg-opacity-40 p-6 flex flex-col justify-end text-white">
                    <h2 class="text-2xl font-bold mb-2">¡Delicias para compartir!</h2>
                    <p class="text-sm mb-4">Prueba nuestras especialidades caseras ideales para cualquier ocasión.</p>
                    <a href="{{ route('menu') }}"
                        class="bg-white text-black font-semibold px-4 py-2 rounded-full w-max">DESCUBRIR
                        MENÚ</a>
                </div>
            </div>

            <!-- Tarjeta 2 -->
            <div class="relative rounded-2xl overflow-hidden shadow-lg h-72">
                <img src="{{ asset('storage/img/div2.jpg') }}" alt="Haz tu pedido online"
                    class="absolute inset-0 w-full h-full object-cover" />
                <div class="absolute inset-0 bg-black bg-opacity-40 p-6 flex flex-col justify-end text-white">
                    <h2 class="text-2xl font-bold mb-2">¡Haz tu pedido online!</h2>
                    <p class="text-sm mb-4">Pide desde casa y recógelo en nuestro local sin esperar.</p>
                    <div class="flex gap-3">
                        <a href="{{ route('menu') }}"
                            class="bg-yellow-300 text-black font-bold px-4 py-2 rounded-full">PEDIR AHORA</a>
                        <button class="bg-white text-black font-semibold px-4 py-2 rounded-full">CÓMO FUNCIONA</button>
                    </div>
                </div>
            </div>

            <!-- Tarjeta 3 -->
            <div class="relative md:col-span-2 rounded-2xl overflow-hidden shadow-lg h-72">
                <img src="{{ asset('storage/img/div3.jpg') }}" alt="Nuestra pasión: calidad y cercanía"
                    class="absolute inset-0 w-full h-full object-cover" />
                <div class="absolute inset-0 bg-black bg-opacity-40 p-6 flex flex-col justify-end text-white">
                    <h2 class="text-3xl font-bold mb-2">Nuestra pasión: calidad y cercanía</h2>
                    <p class="text-sm mb-4">Conoce nuestro compromiso con los ingredientes frescos y el buen servicio.
                    </p>
                    <a href="{{ route('sobrenosotros') }}"
                        class="bg-white text-black font-semibold px-4 py-2 rounded-full w-max">CONOCE MÁS</a>
                </div>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 py-12">
        <h2 class="text-3xl font-bold text-center mb-8">Productos Destacados</h2>

        @if ($productosDestacados->isEmpty())
            <p class="text-center text-gray-500">No hay productos destacados por el momento.</p>
        @else
            <div class="w-full relative">
                <div class="swiper multiple-slide-carousel swiper-container relative">
                    <div class="swiper-wrapper mb-16">
                        @foreach ($productosDestacados as $producto)
                            <div class="swiper-slide">
                                <div
                                    class="bg-white rounded-2xl h-96 flex flex-col justify-center items-center shadow-md overflow-hidden max-w-xs mx-auto">
                                    @if ($producto->imagen)
                                        <img src="{{ asset('storage/' . $producto->imagen) }}"
                                            alt="{{ $producto->nombre }}"
                                            class="w-full h-48 object-cover rounded-t-2xl" />
                                    @endif
                                    <div class="p-4 text-center flex flex-col justify-center flex-grow">
                                        <h3 class="text-xl font-semibold text-gray-800">{{ $producto->nombre }}</h3>
                                        <p class="text-gray-600 mt-2 flex-grow">
                                            {{ Str::limit($producto->ingredientes, 60) }}</p>
                                        <div class="mt-4 font-semibold text-blue-700">
                                            {{ number_format($producto->precio, 2, ',', '.') }} €
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div
                        class="absolute top-1/2 left-0 right-0 w-full px-4 flex justify-between items-center -translate-y-1/2 z-50">
                        <button id="slider-button-left"
                            class="swiper-button-prev group p-2 flex justify-center items-center bg-white shadow-lg w-12 h-12 rounded-full transition-all duration-300 hover:bg-gray-100"
                            style="color: black;">

                        </button>

                        <button id="slider-button-right"
                            class="swiper-button-next group p-2 flex justify-center items-center bg-white shadow-lg w-12 h-12 rounded-full transition-all duration-300 hover:bg-gray-100"
                            style="color: black;">

                        </button>
                    </div>

                </div>
            </div>
        @endif
    </section>




    <footer class="bg-white border-t mt-10">
        <div class="max-w-7xl mx-auto px-4 py-6 text-center text-sm text-gray-700 space-y-2">
            <div class="flex flex-wrap justify-center gap-4">
                <a href="#" class="hover:underline">Legal</a>
                <a href="#" class="hover:underline">Política de privacidad</a>
                <a href="#" class="hover:underline">Política de cookies</a>
                <a href="#" class="hover:underline">Bases legales promociones y sorteos</a>
                <a href="#" class="hover:underline">Términos y Condiciones</a>
                <a href="#" class="hover:underline">Configuración de cookies</a>
            </div>
            <div class="flex items-center justify-center space-x-2">
                <span class="text-yellow-500 text-lg">🍴</span>
                <span>Copyright © 2025 El Dorado Piscolabis</span>
            </div>
        </div>
    </footer>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Swiper('.multiple-slide-carousel', {
                loop: true,
                spaceBetween: 20,
                slidesPerView: 1,
                navigation: {
                    nextEl: '#slider-button-right',
                    prevEl: '#slider-button-left',
                },
                breakpoints: {
                    640: {
                        slidesPerView: 1,
                    },
                    768: {
                        slidesPerView: 2,
                    },
                    1024: {
                        slidesPerView: 3,
                    },
                },
            });
        });
    </script>
</body>

</html>
