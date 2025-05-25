<div>
    <h2 class="text-3xl font-bold text-yellow-500 mb-6">Envíanos un mensaje</h2>

    @if (!empty($successMessage))

    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
        {{ $successMessage }}
    </div>
    @endif

    <form wire:submit.prevent="enviarMensaje" class="space-y-6">
        <div>
            <label for="nombre" class="block text-sm font-medium">Nombre</label>
            <input type="text" id="nombre" wire:model="nombre" required
                class="mt-1 block w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-yellow-400 focus:border-yellow-400" />
            @error('nombre') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="email" class="block text-sm font-medium">Correo electrónico</label>
            <input type="email" id="email" wire:model="email" required
                class="mt-1 block w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-yellow-400 focus:border-yellow-400" />
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="mensaje" class="block text-sm font-medium">Mensaje</label>
            <textarea id="mensaje" wire:model="mensaje" rows="5" required
                class="mt-1 block w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-yellow-400 focus:border-yellow-400"></textarea>
            @error('mensaje') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <button type="submit"
            class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold px-6 py-3 rounded-full">
            Enviar Mensaje
        </button>
    </form>
</div>