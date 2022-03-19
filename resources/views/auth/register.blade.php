<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mt-4">
                <x-jet-label value="{{ __('Nombres') }}" />
                <x-jet-input class="block mt-1 w-full" type="text" name="names" :value="old('names')" required autofocus autocomplete="names" />
            </div>

            <div class="mt-4">
                <x-jet-label value="{{ __('Apellidos') }}" />
                <x-jet-input class="block mt-1 w-full" type="text" name="surnames" :value="old('surnames')" autocomplete="surnames" />
            </div>

            <div class="mt-4">
                <x-jet-label value="{{ __('Documento') }}" />
                <x-jet-input class="block mt-1 w-full" type="text" name="document" :value="old('document')" autocomplete="document" />
            </div>

            <div class="mt-4">
                <x-jet-label value="{{ __('document_type') }}" />
                <x-jet-input class="block mt-1 w-full" type="text" name="document_type" value="C.C" autocomplete="document_type" />
            </div>

            <div class="mt-4">
                <x-jet-label value="{{ __('Correo Electronico') }}" />
                <x-jet-input class="block mt-1 w-full" type="email" name="email" :value="old('email')"  />
            </div>

            <div class="mt-4">
                <x-jet-label value="{{ __('Celular') }}" />
                <x-jet-input class="block mt-1 w-full" type="text" name="phone" :value="old('phone')"  />
            </div>

            <div class="mt-4">
                <x-jet-label value="{{ __('Dirección') }}" />
                <x-jet-input class="block mt-1 w-full" type="text" name="direction" :value="old('direction')" required autofocus autocomplete="direction" />
            </div>

            <div class="mt-4">
                <x-jet-label value="{{ __('Contraseña') }}" />
                <x-jet-input class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label value="{{ __('Confirmar Contraseña') }}" />
                <x-jet-input class="block mt-1 w-full" type="password" name="password_confirmation" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('¿Ya estas registrado?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('REGISTRARME') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>