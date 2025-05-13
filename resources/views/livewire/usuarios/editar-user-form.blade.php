<div>
    <!-- Botón para abrir el modal -->
    @php
        $user = auth()->user();
    @endphp

        <button wire:click="showModal"
            class="bg-yellow-500 hover:bg-yellow-600 text-white text-sm px-4 py-2 rounded-md">
            Editar
        </button>

    <!-- Modal -->
    @if ($showForm)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 px-4">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-lg sm:max-w-xl md:max-w-2xl lg:max-w-3xl">
                <div class="flex justify-between items-center border-b px-4 sm:px-6 py-4">
                    <h2 class="text-lg sm:text-xl font-semibold">Editar Usuario</h2>
                    <button wire:click="$set('showForm', false)" class="text-gray-600 hover:text-gray-900 text-xl">
                        ✕
                    </button>
                </div>

                <div class="px-4 sm:px-6 py-6">
                    <form wire:submit.prevent="storage" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Nombre -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 text-left">Nombre</label>
                                <input type="text" wire:model="name"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 text-left">Email</label>
                                <input type="text" wire:model="email"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Nueva contraseña -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 text-left">Nueva contraseña (opcional)</label>
                                <input type="password" wire:model="password"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- Confirmar contraseña -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 text-left">Confirmar contraseña</label>
                                <input type="password" wire:model="password_confirmation"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                @error('password_confirmation') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Rol -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Rol</label>
                                <select wire:model="role"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                                    <option value="">Seleccionar rol</option>
                                    <option value="admin">Administrador</option>
                                    <option value="empleado">Empleado</option>
                                    <option value="cliente">Cliente</option>
                                </select>
                                @error('role') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="flex flex-col sm:flex-row justify-end gap-2 pt-4">
                            <button type="button" wire:click="$set('showForm', false)"
                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md text-sm w-full sm:w-auto">
                                Cancelar
                            </button>
                            <button type="submit"
                                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm w-full sm:w-auto">
                                Actualizar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>