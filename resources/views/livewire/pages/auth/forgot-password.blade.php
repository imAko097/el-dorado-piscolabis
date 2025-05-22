<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $email = '';

    /**
     * Enviar un enlace para restablecer la contraseña al correo electrónico proporcionado.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        $status = Password::sendResetLink(
            $this->only('email')
        );

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', 'No pudimos enviar el enlace de restablecimiento de contraseña.');
            return;
        }

        $this->reset('email');

        session()->flash('status', 'Te hemos enviado un enlace para restablecer tu contraseña a tu correo electrónico.');
    }
};
?>

<div>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        ¿Olvidaste tu contraseña? No hay problema. Solo dinos tu dirección de correo electrónico y te enviaremos un enlace para restablecerla.
    </div>

    <!-- Estado de la sesión -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="sendPasswordResetLink">
        <!-- Dirección de correo -->
        <div>
            <x-input-label for="email" :value="'Correo electrónico'" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                Enviar enlace de restablecimiento
            </x-primary-button>
        </div>
    </form>
</div>

