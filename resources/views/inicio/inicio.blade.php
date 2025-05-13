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
    <script>
        $(document).ready(function() {
            let index = 0;
            const totalItems = $('.carousel-item').length;

            function goToSlide(i) {
                index = (i + totalItems) % totalItems;
                $('.carousel').css('transform', `translateX(-${index * 100}%)`);
                $('.indicator').removeClass('active');
                $(`.indicator[data-index="${index}"]`).addClass('active');
            }

            // Auto slide
            let autoSlide = setInterval(() => {
                goToSlide(index + 1);
            }, 3000);

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
</head>

<body class="bg-white text-black">
    <livewire:menu-dropdown />
    <!-- Carrusel -->
    <div class="relative overflow-hidden">
        <div class="carousel">
            <div class="carousel-item">
                <img src="{{ asset('storage/img/promo1.jpg') }}" alt="Promo 1" />
            </div>
            <div class="carousel-item">
                <img src="{{ asset('storage/img/promo2.jpg') }}" alt="Promo 2" />
            </div>
            <div class="carousel-item">
                <img src="{{ asset('storage/img/promo3.webp') }}" alt="Promo 3" />
            </div>
        </div>

        <!-- Indicadores -->
        <div class="carousel-indicators flex justify-center mt-4">
            <div class="indicator" data-index="0"></div>
            <div class="indicator" data-index="1"></div>
            <div class="indicator" data-index="2"></div>
        </div>
    </div>


    <section class="bg-yellow-400 py-10 px-4">
        <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-6">
            <!-- Tarjeta 1 -->
            <div class="rounded-2xl overflow-hidden shadow-lg relative h-72 bg-cover bg-center"
                style="background-image: url('/ruta/a/imagen1.jpg')">
                <div class="absolute inset-0 bg-black bg-opacity-40 p-6 flex flex-col justify-end text-white">
                    <h2 class="text-2xl font-bold mb-2">¡Delicias para compartir!</h2>
                    <p class="text-sm mb-4">Prueba nuestras especialidades caseras ideales para cualquier ocasión.</p>
                    <button class="bg-white text-black font-semibold px-4 py-2 rounded-full w-max">DESCUBRIR
                        MENÚ</button>
                </div>
            </div>

            <!-- Tarjeta 2 -->
            <div class="rounded-2xl overflow-hidden shadow-lg relative h-72 bg-cover bg-center"
                style="background-image: url('/ruta/a/imagen2.jpg')">
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
            <div class="md:col-span-2 rounded-2xl overflow-hidden shadow-lg relative h-72 bg-cover bg-center"
                style="background-image: url('/ruta/a/imagen3.jpg')">
                <div class="absolute inset-0 bg-black bg-opacity-40 p-6 flex flex-col justify-end text-white">
                    <h2 class="text-3xl font-bold mb-2">Nuestra pasión: calidad y cercanía</h2>
                    <p class="text-sm mb-4">Conoce nuestro compromiso con los ingredientes frescos y el buen servicio.
                    </p>
                    <button class="bg-white text-black font-semibold px-4 py-2 rounded-full w-max">CONOCE MÁS</button>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-12 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-8">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Descubre nuestras especialidades</h2>
                <p class="text-gray-600 mt-2">Tapas, postres caseros y bocados únicos, todos con el toque de El Dorado
                    Piscolabis.</p>
            </div>

            <!-- Productos carrusel -->
            <div class="flex overflow-x-auto gap-6 pb-4 snap-x">
                <!-- Producto 1 -->
                <div class="min-w-[240px] snap-center bg-white shadow-lg rounded-xl p-4 text-center">
                    <img src="/imagenes/tapa1.jpg" alt="Tapas" class="h-36 mx-auto object-cover rounded-md">
                    <h3 class="text-lg font-semibold mt-3">Tapas Variadas</h3>
                    <p class="text-sm text-gray-500">Delicias tradicionales reinventadas con un toque dorado.</p>
                </div>

                <!-- Producto 2 -->
                <div class="min-w-[240px] snap-center bg-white shadow-lg rounded-xl p-4 text-center">
                    <img src="/imagenes/postre.jpg" alt="Postre" class="h-36 mx-auto object-cover rounded-md">
                    <h3 class="text-lg font-semibold mt-3">Postres Caseros</h3>
                    <p class="text-sm text-gray-500">Endulza tu visita con sabores de toda la vida.</p>
                </div>

                <!-- Producto 3 -->
                <div class="min-w-[240px] snap-center bg-white shadow-lg rounded-xl p-4 text-center">
                    <img src="/imagenes/vegano.jpg" alt="Opciones Veganas" class="h-36 mx-auto object-cover rounded-md">
                    <h3 class="text-lg font-semibold mt-3">Opción Vegana</h3>
                    <p class="text-sm text-gray-500">Platos con alma verde, sabor sin límites.</p>
                </div>
            </div>

            <!-- Botón -->
            <div class="mt-8 text-center">
                <button
                    class="bg-yellow-400 hover:bg-yellow-500 text-black font-bold py-2 px-6 rounded-full shadow-md transition">
                    EXPLORAR LA CARTA
                </button>
            </div>
        </div>
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
            const menu = document.getElementById('mainMenu');

            window.addEventListener('scroll', function() {
                if (window.scrollY > 100) {
                    menu.classList.remove('bg-transparent', 'text-white');
                    menu.classList.add('bg-white', 'text-black', 'shadow-md');
                } else {
                    menu.classList.add('bg-transparent', 'text-white');
                    menu.classList.remove('bg-white', 'text-black', 'shadow-md');
                }
            });
        });
    </script>

</body>

</html>
