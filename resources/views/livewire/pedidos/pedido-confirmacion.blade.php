<div class="min-h-screen bg-[#FFF8F0] py-10">
    <div class="max-w-2xl mx-auto px-4 mt-[105px] sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-lg p-8 text-center border border-[#FCD34D]">
            <div class="mb-1">
                <i class="bi bi-check-circle-fill text-green-600 text-6xl"></i>
            </div>

            <h1 class="text-3xl font-bold text-[#92400E] mb-3">¡Pedido Realizado con Éxito!</h1>

            <div class="mb-3">
                <span class="text-[#1C1917]">
                    Tu pedido ha sido registrado correctamente. No salgas de la página para saber el estado de tu pedido.
                </span>
            </div>

            <div class="bg-[#FFFBEB] rounded-lg p-6 mb-6 border border-[#FCD34D]">
                <h2 class="text-xl font-semibold text-[#B45309] mb-4">Detalles del Pedido</h2>
                <div class="space-y-2 text-left text-[#1C1917]">
                    <p><span class="font-bold">Número de pedido:</span> #{{ $pedido->id }}</p>
                    <p><span class="font-bold">Total:</span> {{ number_format($pedido->total, 2, ',', '.') }} €</p>
                    <p><span class="font-bold">Estado:</span> {{ ucfirst($pedido->estadoPedido->estado) }}</p>
                    @if($pedido->direccion)
                        <p><span class="font-bold">Dirección de entrega:</span> {{ $pedido->direccion }}</p>
                    @endif
                    <p><span class="font-bold">Teléfono:</span> {{ $pedido->telefono_contacto }}</p>
                    @if($pedido->direccion !== 'local')
                    <p><span class="font-bold">Forma de pago:</span> {{ ucfirst($pedido->forma_pago) }}</p>
                    @endif
                </div>
            </div>

            <div>
                <a href="{{ route('menu') }}"
                   class="block w-full bg-[#E5E7EB] text-[#1C1917] text-center py-3 rounded-lg font-semibold hover:bg-[#D1D5DB] transition-colors">
                    Volver al menú
                </a>

                @if(Auth::check())
                    <a href="{{ route('pedidos.mis-pedidos') }}"
                       class="block w-full bg-[#FBBF24] text-[#1C1917] text-center py-3 mt-2 rounded-lg font-semibold hover:bg-[#FACC15] transition-colors">
                        Ver mis pedidos
                    </a>
                @else
                    <div class="mt-3">
                        <span class="text-[#1C1917]">¿No tienes cuenta?
                            <a href="{{ route('register') }}" class="text-[#92400E] font-medium hover:underline">
                                ¡Regístrate para ver tus pedidos!
                            </a>
                            o
                            <a href="{{ route('login') }}" class="text-[#92400E] font-medium hover:underline">
                                ¡Inicia sesión!
                            </a>
                        </span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
