<div>

    @php
    $user = auth()->user();
    @endphp

    <button wire:click="showModal" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 mb-2 rounded-md text-sm">
        Agregar Usuario
    </button>

    <!-- Modal -->
    @if ($showForm)
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 overflow-y-auto px-4">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl sm:max-w-3xl md:max-w-4xl mx-auto my-10">
            <div class="flex justify-between items-center border-b px-4 sm:px-6 py-3 sm:py-4">
                <h2 class="text-lg sm:text-xl font-semibold">Agregar Nuevo Usuario</h2>
                <button wire:click="$set('showForm', false)" class="text-gray-600 hover:text-gray-900 text-xl">
                    ✕
                </button>
            </div>

            <div class="px-4 sm:px-6 py-4">
                <form wire:submit.prevent="save" enctype="multipart/form-data" class="space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Nombre -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nombre</label>
                            <input type="text" wire:model="name"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="text" wire:model="email"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Contraseña -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Contraseña</label>
                            <input type="password" wire:model="password"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                            @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Confirmar contraseña -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Confirmar contraseña</label>
                            <input type="password" wire:model="password_confirmation"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
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
                        <button wire:click="$set('showForm', false)" type="button"
                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md text-sm w-full sm:w-auto">
                            Cancelar
                        </button>
                        <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm w-full sm:w-auto">
                            Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>