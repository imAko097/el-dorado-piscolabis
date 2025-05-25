<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;

new class extends Component
{
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Update the password for the currently authenticated user.
     */
    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'],
                'password' => ['required', 'string', Password::defaults(), 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');

            throw $e;
        }

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');

        $this->dispatch('password-updated');
    }
}; ?>

<section aria-labelledby="password-form-title">
    <header>
        <h2 id="password-form-title" class="sr-only">Formulario de contraseña</h2>
        <p class="mt-1 text-sm text-[#4B5563]">
            {{ __('Asegúrate de usar una contraseña larga y aleatoria para mantener la seguridad de tu cuenta.') }}
        </p>
    </header>

    <form wire:submit="updatePassword" class="mt-6 space-y-6" novalidate>
        <!-- Contraseña actual -->
        <div>
            <x-input-label for="update_password_current_password" :value="__('Contraseña Actual')" class="text-[#1F2937]" />
            <x-text-input wire:model.defer="current_password"
                id="update_password_current_password"
                name="current_password" type="password"
                class="mt-1 block w-full rounded-lg border-[#E2E8F0] shadow-sm focus:border-[#D97706] focus:ring-[#D97706] text-[#1F2937]"
                autocomplete="current-password" />
            <x-input-error :messages="$errors->get('current_password')" class="mt-2 text-red-600" />
        </div>

        <!-- Nueva contraseña -->
        <div>
            <x-input-label for="update_password_password" :value="__('Nueva Contraseña')" class="text-[#1F2937]" />
            <x-text-input wire:model.defer="password"
                id="update_password_password"
                name="password" type="password"
                class="mt-1 block w-full rounded-lg border-[#E2E8F0] shadow-sm focus:border-[#D97706] focus:ring-[#D97706] text-[#1F2937]"
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
        </div>

        <!-- Confirmar nueva contraseña -->
        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirmar Contraseña')" class="text-[#1F2937]" />
            <x-text-input wire:model.defer="password_confirmation"
                id="update_password_password_confirmation"
                name="password_confirmation" type="password"
                class="mt-1 block w-full rounded-lg border-[#E2E8F0] shadow-sm focus:border-[#D97706] focus:ring-[#D97706] text-[#1F2937]"
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-600" />
        </div>

        <!-- Botón de guardar -->
        <div class="flex items-center gap-4">
            <x-primary-button class="bg-[#D97706] hover:bg-[#92400E] focus:ring-[#D97706] focus:outline-none focus:ring-2 focus:ring-offset-2 text-white font-semibold">
                {{ __('Guardar') }}
            </x-primary-button>

            <x-action-message class="ml-3 text-green-700" on="password-updated">
                {{ __('Contraseña actualizada.') }}
            </x-action-message>
        </div>
    </form>
</section>

