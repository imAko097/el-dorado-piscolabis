<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component
{
    public string $name = '';
    public string $email = '';

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<section>
    <header>
        <p class="mt-1 text-sm text-[#6B4C3B]">
            {{ __('Actualiza tus datos personales y correo electrónico asociado a tu cuenta.') }}
        </p>
    </header>

    <form wire:submit="updateProfileInformation" class="mt-6 space-y-6">
        <!-- Nombre -->
        <div>
            <x-input-label for="name" :value="__('Nombre')" />
            <x-text-input wire:model="name" id="name" name="name" type="text"
                class="mt-1 block w-full rounded-lg shadow-sm border-[#D6B47C] focus:border-[#CA8A04] focus:ring-[#CA8A04]"
                required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Correo -->
        <div>
            <x-input-label for="email" :value="__('Correo electrónico')" />
            <x-text-input wire:model="email" id="email" name="email" type="email"
                class="mt-1 block w-full rounded-lg shadow-sm border-[#D6B47C] focus:border-[#CA8A04] focus:ring-[#CA8A04]"
                required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                <div class="mt-3 text-sm text-[#7C3A00]">
                    <p>
                        {{ __('Tu correo electrónico no está verificado.') }}
                        <button wire:click.prevent="sendVerification"
                            class="ml-2 underline text-[#92400E] hover:text-[#D97706] font-medium focus:outline-none focus:ring-2 focus:ring-[#FCD34D] rounded-md">
                            {{ __('Haz clic aquí para reenviar.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('Se ha enviado un nuevo enlace de verificación a tu correo.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Botones -->
        <div class="flex items-center gap-4">
            <x-primary-button class="bg-[#CA8A04] hover:bg-[#A16207] focus:ring-[#FCD34D]">
                {{ __('Guardar') }}
            </x-primary-button>

            <x-action-message class="ml-3 text-green-600" on="profile-updated">
                {{ __('Guardado.') }}
            </x-action-message>
        </div>
    </form>
</section>
