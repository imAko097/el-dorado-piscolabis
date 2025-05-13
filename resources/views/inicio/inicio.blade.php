<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>El Dorado - Restaurante</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        #dropdownMenu {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background-color: white;
            z-index: 1000;
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

        .carousel {
            display: flex;
            transition: transform 0.5s ease-in-out;
            width: 300%;
        }

        .carousel-item {
            width: 100%;
            flex-shrink: 0;
            height: 750px;
        }

        .carousel-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .carousel-controls {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 100%;
            display: flex;
            justify-content: space-between;
            padding: 0 20px;
            z-index: 10;
        }

        .carousel-indicators {
            position: absolute;
            bottom: 10px;
            width: 100%;
            display: flex;
            justify-center: center;
            z-index: 10;
        }

        .indicator {
            width: 12px;
            height: 12px;
            margin: 0 5px;
            background-color: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .indicator.active {
            background-color: #f1c40f;
        }
    </style>

    <script>
        $(document).ready(function() {
            $('.menu-toggle').click(function() {
                $('#dropdownMenu').stop(true, true).slideToggle(300);
            });

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
    <!-- NAV TRANSPARENTE -->
    <nav class="p-6 pl-40 pr-40 flex justify-between items-center absolute top-0 left-0 w-full bg-transparent text-white z-50">
        <img src="{{ asset('storage/img/eldorado.png') }}" alt="Logo" class="bg-white w-20 h-20 rounded-full" />
        <button class="menu-toggle text-3xl">
            <i class="bi bi-list"></i>
        </button>
    </nav>

    <!-- Menú desplegable -->
    <div id="dropdownMenu">
        <nav class="p-6 pl-40 pr-40 flex justify-between items-center">
            <img src="{{ asset('storage/img/eldorado.png') }}" alt="Logo" class="bg-white w-20 h-20 rounded-full" />
            <button class="menu-toggle text-3xl">
                <i class="bi bi-x"></i>
            </button>
        </nav>
        <ul class="p-5">
            <li><a href="#">Carta</a></li>
            <li><a href="#">Promociones</a></li>
            <li><a href="#">Sobre Nosotros</a></li>
            <li><a href="#">Contáctanos</a></li>
        </ul>
    </div>

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
                <img src="{{ asset('storage/img/promo3.jpg') }}" alt="Promo 3" />
            </div>
        </div>

        <!-- Flechas -->
        <div class="carousel-controls">
            <button id="prevSlide"
                class="text-white text-3xl bg-black bg-opacity-50 rounded-full p-2 hover:bg-opacity-70">
                <i class="bi bi-chevron-left"></i>
            </button>
            <button id="nextSlide"
                class="text-white text-3xl bg-black bg-opacity-50 rounded-full p-2 hover:bg-opacity-70">
                <i class="bi bi-chevron-right"></i>
            </button>
        </div>

        <!-- Indicadores -->
        <div class="carousel-indicators flex justify-center mt-4">
            <div class="indicator" data-index="0"></div>
            <div class="indicator" data-index="1"></div>
            <div class="indicator" data-index="2"></div>
        </div>
    </div>
</body>

</html>
