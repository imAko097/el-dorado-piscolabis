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

    <section class="bg-[#FCD34D] py-10 px-4">
        <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-6">
            <!-- Tarjeta 1 -->
            <div class="relative rounded-2xl overflow-hidden shadow-lg h-72">
                <img src="{{ asset('storage/img/div1.jpg') }}" alt="Delicias para compartir"
                    class="absolute inset-0 w-full h-full object-cover" />
                <div class="absolute inset-0 bg-black bg-opacity-40 p-6 flex flex-col justify-end text-white">
                    <h2 class="text-2xl font-bold mb-2">¡Delicias para compartir!</h2>
                    <p class="text-sm mb-4">Prueba nuestras especialidades caseras ideales para cualquier ocasión.</p>
                    <a href="{{ route('menu') }}"
                        class="bg-[#FFFFFF] text-[#1C1917] font-semibold px-4 py-2 rounded-full w-max">DESCUBRIR MENÚ</a>
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
                            class="bg-[#FCD34D] text-[#1C1917] font-bold px-4 py-2 rounded-full">PEDIR AHORA</a>
                        <button class="bg-[#FFFFFF] text-[#1C1917] font-semibold px-4 py-2 rounded-full">CÓMO FUNCIONA</button>
                    </div>
                </div>
            </div>

            <!-- Tarjeta 3 -->
            <div class="relative md:col-span-2 rounded-2xl overflow-hidden shadow-lg h-72">
                <img src="{{ asset('storage/img/div3.jpg') }}" alt="Nuestra pasión: calidad y cercanía"
                    class="absolute inset-0 w-full h-full object-cover" />
                <div class="absolute inset-0 bg-black bg-opacity-40 p-6 flex flex-col justify-end text-white">
                    <h2 class="text-3xl font-bold mb-2">Nuestra pasión: calidad y cercanía</h2>
                    <p class="text-sm mb-4">Conoce nuestro compromiso con los ingredientes frescos y el buen servicio.</p>
                    <a href="{{ route('sobrenosotros') }}"
                        class="bg-[#FFFFFF] text-[#1C1917] font-semibold px-4 py-2 rounded-full w-max">CONOCE MÁS</a>
                </div>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 py-12">
        <h2 class="text-3xl font-bold text-center mb-8">Productos Destacados</h2>
        <p class="text-center text-gray-600 mb-6">Descubre nuestros platos más populares, elaborados con los mejores
            ingredientes y mucho cariño.</p>

        @if ($productosDestacados->isEmpty())
        <p class="text-center text-gray-500">No hay productos destacados por el momento.</p>
        @else

        <div class="swiper multiple-slide-carousel mx-auto h-96">
            <div class="swiper-wrapper">
                @foreach ($productosDestacados as $producto)
                <div class="swiper-slide">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden w-full max-w-sm mx-auto p-6"> <!-- Cambiado max-w-xs a max-w-sm y agregado p-6 -->
                        @if ($producto->imagen)
                        <img src="{{ asset('storage/' . $producto->imagen) }}"
                            alt="{{ $producto->nombre }}"
                            class="w-full h-48 object-cover rounded-lg " />
                        @endif
                        <div class="pt-4 text-center">
                            <h3 class="text-lg font-semibold text-gray-800 mt-2">{{ $producto->nombre }}</h3>
                            <p class="text-gray-600 mt-2 text-sm">
                                {{ Str::limit($producto->ingredientes, 60) }}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <button id="slider-button-left"
                class="swiper-button-prev "
                style="color: black;">
            </button>
            <button id="slider-button-right"
                class="swiper-button-next"
                style="color: black;">
            </button>
        </div>
        @endif
    </section>

    <footer class="bg-[#FFFFFF] border-t-2 border-[#FCD34D] mt-10">
        <div class="max-w-7xl mx-auto px-4 py-6 text-center text-sm text-[#1C1917] space-y-2">
            <div class="flex flex-wrap justify-center gap-4">
                <a href="#" class="hover:underline text-[#92400E]">Legal</a>
                <a href="#" class="hover:underline text-[#92400E]">Política de privacidad</a>
                <a href="#" class="hover:underline text-[#92400E]">Política de cookies</a>
                <a href="#" class="hover:underline text-[#92400E]">Bases legales promociones y sorteos</a>
                <a href="#" class="hover:underline text-[#92400E]">Términos y Condiciones</a>
                <a href="#" class="hover:underline text-[#92400E]">Configuración de cookies</a>
            </div>
            <div class="flex items-center justify-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#92400E">
                    <path d="M280-80v-366q-51-14-85.5-56T160-600v-280h80v280h40v-280h80v280h40v-280h80v280q0 56-34.5 98T360-446v366h-80Zm400 0v-320H560v-280q0-83 58.5-141.5T760-880v800h-80Z" />
                </svg>
                <span>Copyright © 2025 El Dorado Piscolabis</span>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const swiper = new Swiper('.multiple-slide-carousel', {
                loop: true,
                spaceBetween: 0,
                centeredSlides: true,
                slidesPerView: 1,
                navigation: {
                    nextEl: '#slider-button-right',
                    prevEl: '#slider-button-left',
                },
                breakpoints: {
                    640: {
                        slidesPerView: 1
                    },
                    768: {
                        slidesPerView: 2
                    },
                    1024: {
                        slidesPerView: 3
                    },

                },
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const items = document.querySelectorAll('.carousel-item');
            let current = 0;

            function showSlide(index) {
                items.forEach((item, i) => {
                    item.classList.remove('active');
                    if (i === index) item.classList.add('active');
                });
            }

            setInterval(() => {
                current = (current + 1) % items.length;
                showSlide(current);
            }, 5000);
        });
    </script>

</body>

</html>