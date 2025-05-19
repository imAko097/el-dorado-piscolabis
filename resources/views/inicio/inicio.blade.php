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

    <script>
        $(document).ready(function() {
            let index = 0;
            const totalItems = $('.carousel-item').length;

            function goToSlide(i) {
                index = (i + totalItems) % totalItems;
                $('.carousel-item').removeClass('active');
                $('.carousel-item').eq(index).addClass('active');

                $('.indicator').removeClass('active');
                $(`.indicator[data-index="${index}"]`).addClass('active');
            }


            // Auto slide
            let autoSlide = setInterval(() => {
                goToSlide(index + 1);
            }, 7000);

            // Next/Prev controls
            $('#nextSlide').click(() => {
                goToSlide(index + 1);
                resetAutoSlide();
            });

            $('#prevSlide').click(() => {
                goToSlide(index - 1);
                resetAutoSlide();
            });

            // Indicators
            $('.indicator').click(function() {
                const i = parseInt($(this).attr('data-index'));
                goToSlide(i);
                resetAutoSlide();
            });

            function resetAutoSlide() {
                clearInterval(autoSlide);
                autoSlide = setInterval(() => {
                    goToSlide(index + 1);
                }, 3000);
            }

            goToSlide(0); // Init
        });
    </script>
    <script>
        $(document).ready(function() {
            const $menu = $('#dropdownMenu');
            const $icon = $('#menuIcon');
            const $mainMenu = $('#mainMenu');
            let isOpen = false;

            function openMenu() {
                $('#dropdownMenu').addClass('show'); /* Mostrar el menú */
                $('#menuIcon').removeClass('bi-list').addClass('bi-x');
                $('#mainMenu').removeClass('bg-transparent text-white').addClass('bg-white text-black shadow-lg');
                isOpen = true;
            }

            function closeMenu() {
                $('#dropdownMenu').removeClass('show'); /* Ocultar el menú */
                $('#menuIcon').removeClass('bi-x').addClass('bi-list');
                $('#mainMenu').removeClass('bg-white text-black shadow-lg').addClass('bg-transparent text-white');
                isOpen = false;
            }

            // Alternar el menú al hacer clic en el icono
            $('#menuToggle').click(function() {
                if (!isOpen) {
                    openMenu();
                } else {
                    closeMenu();
                }
            });

            // Cerrar el menú al hacer clic fuera del área del menú
            $('#closeMenu').click(function() {
                closeMenu();
            });
        });
    </script>
</head>

<body class="bg-white text-black">
    <div>
        <nav id="mainMenu"
            class="p-6 pl-40 pr-40 flex justify-between items-center fixed top-0 left-0 w-full bg-transparent text-white z-50 transition-all duration-300 ease-in-out">
            <img src="{{ asset('storage/img/eldorado.png') }}" alt="Logo" class="bg-white w-20 h-20 rounded-full" />
            <!-- Botón de menú en el navbar -->
            <button id="menuToggle" class="text-3xl">
                <i id="menuIcon" class="bi bi-list"></i>
            </button>
        </nav>
        <div id="dropdownMenu">
            <ul class="p-6 text-5xl">
                <li><a href="{{ route('inicio') }}">Inicio <i class="bi bi-chevron-right"></i></a></li>
                <li><a href="{{ route('menu') }}">Carta <i class="bi bi-chevron-right"></i></a></li>
                <li><a href="{{ route('sobrenosotros') }}">Sobre Nosotros <i class="bi bi-chevron-right"></i></a></li>
                <li><a href="{{ route('contacto') }}">Contacto <i class="bi bi-chevron-right"></i></a></li>
            </ul>

        </div>
    </div>


    <!-- Carrusel -->
    <div class="relative overflow-hidden">
        <div class="carousel">
            @foreach ($carrusel_imagenes as $index => $imagen)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    <img src="{{ $imagen->imagen }}" alt="Imagen del carrusel" />
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
                <img src="{{ asset('storage/img/div1.webp') }}" alt="Delicias para compartir"
                    class="absolute inset-0 w-full h-full object-cover" />
                <div class="absolute inset-0 bg-black bg-opacity-40 p-6 flex flex-col justify-end text-white">
                    <h2 class="text-2xl font-bold mb-2">¡Delicias para compartir!</h2>
                    <p class="text-sm mb-4">Prueba nuestras especialidades caseras ideales para cualquier ocasión.</p>
                    <button class="bg-white text-black font-semibold px-4 py-2 rounded-full w-max">DESCUBRIR
                        MENÚ</button>
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
                        <button class="bg-yellow-300 text-black font-bold px-4 py-2 rounded-full">PEDIR AHORA</button>
                        <button class="bg-white text-black font-semibold px-4 py-2 rounded-full">CÓMO FUNCIONA</button>
                    </div>
                </div>
            </div>

            <!-- Tarjeta 3 -->
            <div class="relative md:col-span-2 rounded-2xl overflow-hidden shadow-lg h-72">
                <img src="{{ asset('storage/img/div3.webp') }}" alt="Nuestra pasión: calidad y cercanía"
                    class="absolute inset-0 w-full h-full object-cover" />
                <div class="absolute inset-0 bg-black bg-opacity-40 p-6 flex flex-col justify-end text-white">
                    <h2 class="text-3xl font-bold mb-2">Nuestra pasión: calidad y cercanía</h2>
                    <p class="text-sm mb-4">Conoce nuestro compromiso con los ingredientes frescos y el buen servicio.
                    </p>
                    <button class="bg-white text-black font-semibold px-4 py-2 rounded-full w-max">CONOCE MÁS</button>
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

                    <!-- Botones personalizados estilo que diste -->
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
        $(document).ready(function() {
            const $menu = $('#dropdownMenu');
            const $icon = $('#menuIcon');
            const $mainMenu = $('#mainMenu');
            let isOpen = false;

            function setNavbarState() {
                if (isOpen || window.scrollY > 100) {
                    $mainMenu.removeClass('bg-transparent text-white').addClass('bg-white text-black shadow-lg');
                } else {
                    $mainMenu.removeClass('bg-white text-black shadow-lg').addClass('bg-transparent text-white');
                }
            }

            function openMenu() {
                $menu.addClass('show');
                $icon.removeClass('bi-list').addClass('bi-x');
                $('body').addClass('overflow-hidden');
                isOpen = true;
                setNavbarState();
            }

            function closeMenu() {
                $menu.removeClass('show');
                $icon.removeClass('bi-x').addClass('bi-list');
                $('body').removeClass('overflow-hidden');
                isOpen = false;
                setNavbarState(); // vuelve a aplicar estilo según scroll
            }

            $('#menuToggle').click(function() {
                if (!isOpen) {
                    openMenu();
                } else {
                    closeMenu();
                }
            });

            $('#closeMenu').click(function() {
                closeMenu();
            });

            // Detectar scroll
            $(window).on('scroll', function() {
                setNavbarState();
            });

            // Estado inicial
            setNavbarState();
        });
    </script>
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
