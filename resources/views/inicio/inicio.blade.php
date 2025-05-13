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
