<div>
    @php $user = auth()->user(); @endphp

    <button wire:click="showModal"
        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm transition duration-150"
        title="Agregar nuevo usuario">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
        </svg>
    </button>

    @if ($showForm)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 overflow-y-auto px-4">
            <div class="bg-white rounded-xl shadow-2xl w-full max-w-3xl mx-auto my-10 max-h-screen overflow-y-auto">
                <div class="flex justify-between items-center border-b px-6 py-4">
                    <h2 class="text-xl font-semibold text-gray-800">Agregar Nuevo Usuario</h2>
                    <button wire:click="$set('showForm', false)" class="text-gray-500 hover:text-red-600 text-2xl leading-none">×</button>
                </div>

                <div class="px-6 py-6">
                    <form wire:submit.prevent="save" enctype="multipart/form-data" class="space-y-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <!-- Nombre -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nombre</label>
                                <input type="text" wire:model="name"
                                    class="px-3 py-2 mt-1 block w-full rounded-md border-[1.5px] border-gray-400 bg-white shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 text-sm">
                                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="text" wire:model="email"
                                    class="px-3 py-2 mt-1 block w-full rounded-md border-[1.5px] border-gray-400 bg-white shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 text-sm">
                                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <!-- Contraseña -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Contraseña</label>
                                <input type="password" wire:model="password"
                                    class="px-3 py-2 mt-1 block w-full rounded-md border-[1.5px] border-gray-400 bg-white shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 text-sm">
                                @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- Confirmar contraseña -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Confirmar contraseña</label>
                                <input type="password" wire:model="password_confirmation"
                                    class="px-3 py-2 mt-1 block w-full rounded-md border-[1.5px] border-gray-400 bg-white shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 text-sm">
                                @error('password_confirmation') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            @if ($user && $user->isAdmin())
                                <!-- Rol -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Rol</label>
                                    <select wire:model="role"
                                        class="px-3 py-2 mt-1 block w-full rounded-md border-[1.5px] border-gray-400 bg-white shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 text-sm capitalize">
                                        <option value="">Seleccionar rol</option>
                                        <option value="admin">Administrador</option>
                                        <option value="empleado">Empleado</option>
                                        <option value="cliente">Cliente</option>
                                    </select>
                                    @error('role') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                            @endif
                        </div>

                        <!-- Botones -->
                        <div class="flex flex-col sm:flex-row justify-end space-y-2 sm:space-y-0 sm:space-x-3 pt-4">
                            <button wire:click="$set('showForm', false)" type="button"
                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md text-sm w-full sm:w-auto transition duration-150">
                                Cancelar
                            </button>
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm w-full sm:w-auto transition duration-150">
                                Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
