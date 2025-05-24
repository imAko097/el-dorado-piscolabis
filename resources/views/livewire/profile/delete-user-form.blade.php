<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component
{
    public string $password = '';

    /**
     * Delete the currently authenticated user.
     */
    public function deleteUser(Logout $logout): void
    {
        $this->validate([
            'password' => ['required', 'string', 'current_password'],
        ]);

        tap(Auth::user(), $logout(...))->delete();

        $this->redirect('/', navigate: true);
    }
}; ?>

<section class="space-y-6" aria-labelledby="delete-account-heading">
    <header>
        <h2 id="delete-account-heading" class="sr-only">Eliminar cuenta</h2>
        <p class="mt-1 text-sm text-[#4B5563]">
            {{ __('Una vez que se elimine tu cuenta, todos tus datos serán eliminados permanentemente. Asegúrate de descargar cualquier información que desees conservar antes de continuar.') }}
        </p>
    </header>

    <x-danger-button
        x-data="{}"
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-red-600 hover:bg-red-700 focus:ring-red-500 text-white font-semibold"
    >
        {{ __('Eliminar Cuenta') }}
    </x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->isNotEmpty()" focusable>
        <form wire:submit="deleteUser" class="p-6">
            <h2 class="text-lg font-semibold text-red-600">
                {{ __('¿Estás seguro de que deseas eliminar tu cuenta?') }}
            </h2>

            <p class="mt-2 text-sm text-[#4B5563]">
                {{ __('Una vez eliminada, todos tus datos serán borrados de forma permanente. Por favor, introduce tu contraseña para confirmar esta acción irreversible.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Contraseña') }}" class="sr-only" />

                <x-text-input
                    wire:model.defer="password"
                    id="password"
                    name="password"
                    type="password"
                    placeholder="{{ __('Contraseña') }}"
                    class="mt-1 block w-3/4 rounded-lg border-[#E2E8F0] shadow-sm focus:border-[#D97706] focus:ring-[#D97706] text-[#1F2937]"
                />

                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')" class="focus:ring-gray-400">
                    {{ __('Cancelar') }}
                </x-secondary-button>

                <x-danger-button class="bg-red-600 hover:bg-red-700 focus:ring-red-500 text-white font-semibold">
                    {{ __('Eliminar Cuenta') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>

