<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="{{ asset('css/inicio/styles.css') }}">
    <title>El Dorado - Tu pedido</title>
</head>
<body>
    <div>
        <x-menu-toggle/>
    </div>
    <livewire:pedido-confirmacion :id="$id" />

    <!-- Footer -->
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
</body>
</html>