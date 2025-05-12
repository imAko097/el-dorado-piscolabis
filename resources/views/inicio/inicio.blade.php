<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>El Dorado - Restaurante</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap Icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <script>
        $(document).ready(function () {
            $('.menu-toggle').click(function () {
                $('#dropdownMenu').stop(true, true).slideToggle(300);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            let index = 0;
            const totalItems = $(".carousel-item").length;

            function changeSlide() {
                // Mueve el carrusel
                index = (index + 1) % totalItems;
                $(".carousel").css('transform', 'translateX(' + (-index * 100) + '%)');
            }

            // Cambia la imagen cada 3 segundos
            setInterval(changeSlide, 3000);
        });
    </script>

    <style>
        /* Menú desplegable */
        #dropdownMenu {
            display: none;
            position: fixed;
            top: 0;
            /* Empuja el menú al principio de la pantalla */
            left: 0;
            width: 100%;
            height: 100vh; /* El menú ocupará toda la pantalla */
            background-color: white;
            z-index: 1000;
            /* Asegura que el menú se muestre encima del carrusel y la navbar */
            text-align: center;
        }

        #dropdownMenu ul {
            list-style: none;
            padding: 0;
        }

        #dropdownMenu li {
            margin: 20px 0;
        }

        #dropdownMenu a {
            color: black;
            font-size: 24px;
            text-decoration: none;
            transition: color 0.3s;
        }

        #dropdownMenu a:hover {
            color: #f1c40f;
        }

        /* Animación de transición del ícono */
        .bi {
            transition: transform 0.3s ease;
        }

        /* Carrusel */
        .carousel {
            display: flex;
            transition: transform 0.5s ease;
        }

        .carousel-item {
            width: 100%;
            height: 500px;
        }

        .carousel-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Nueva clase para el fondo blanco en la barra de navegación */
        nav.bg-white {
            background-color: white !important;
        }
    </style>
</head>

<body class="bg-white text-white">
    <div class="relative">
        <!-- Carrusel -->
        <div class="carousel-wrapper w-full absolute top-0 left-0">
            <div class="carousel">
                <div class="carousel-item">
                    <img src="{{ asset('storage/img/promo1.jpg') }}" alt="Imagen 1" class="w-full h-full" />
                </div>
            </div>
        </div>

        <div class="container mx-auto">
            <!-- Menú -->
            <nav class="p-5 transition-colors">
                <div class="flex items-center justify-between">
                    <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center">
                        <a href="#" class="text-2xl font-bold text-white">El Dorado</a>
                    </div>

                    <div class="relative">
                        <!-- Botón que activa el menú desplegable -->
                        <button id="menuButton" class="menu-toggle text-white focus:outline-none text-3xl">
                            <i class="bi bi-list"></i>
                        </button>
                    </div>
                </div>
            </nav>

            <!-- Menú desplegable -->
            <div id="dropdownMenu">
                 <!-- Menú -->
                 <div class="container mx-auto">
                    <nav class="p-5 transition-colors">
                        <div class="flex items-center justify-between">
                            <a href="#" class="text-2xl font-bold text-white">El Dorado</a>
                            <div class="relative">
                                <!-- Botón que activa el menú desplegable -->
                                <button class=" menu-toggle text-black focus:outline-none text-3xl">
                                    <i class="bi bi-x"></i>
                                </button>
                            </div>
                        </div>
                    </nav>
                 </div>
                <ul class="p-5">
                    <li><a href="#">Carta</a></li>
                    <li><a href="#">Promociones</a></li>
                    <li><a href="#">Sobre Nosotros</a></li>
                    <li><a href="#">Contactanos</a></li>
                </ul>
            </div>
        </div>
    </div>
</body>

</html>
