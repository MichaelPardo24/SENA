<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('user.store') }}">
            @csrf

            <div class="mt-4">
                <x-jet-label value="{{ __('Nombres') }}" />
                <x-jet-input class="block mt-1 w-full" type="text" name="names" value="{{old('names')}}" />
            </div>

            <div class="mt-4">
                <x-jet-label value="{{ __('Apellidos') }}" />
                <x-jet-input class="block mt-1 w-full" type="text" name="surnames" value="{{old('surnames')}}" />
            </div>

            <div class="mt-4">
                <x-jet-label value="{{ __('Tipo de documento') }}" />
                <select class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="document_type">
                    <option value="C.C" selected>C.C</option>
                    <option value="T.I">T.I</option>
                    <option value="C.E">C.E</option>
                    <option value="Pasaporte">Pasaporte</option>
                </select>
            </div>

            <div class="mt-4">
                <x-jet-label value="{{ __('Documento') }}" />
                <x-jet-input class="block mt-1 w-full" type="text" name="document" value="{{old('document')}}" />
            </div>

            <div class="mt-4">
                <x-jet-label value="{{ __('Fecha de cumpleaños') }}" />
                <x-jet-input class="block mt-1 w-full" type="text" name="birth_at" value="" />
            </div>

            <div class="mt-4">
                <x-jet-label value="{{ __('Correo Electronico') }}" />
                <x-jet-input class="block mt-1 w-full" type="email" name="email" value="{{old('email')}}" />
            </div>

            <div class="mt-4">
                <x-jet-label value="{{ __('Celular') }}" />
                <x-jet-input class="block mt-1 w-full" type="text" name="phone" value="{{old('phone')}}" />
            </div>

            <div class="mt-4">
                <x-jet-label value="{{ __('Dirección') }}" />
                <x-jet-input class="block mt-1 w-full" type="text" name="direction" value="{{old('direction')}}" />
            </div>

            <div class="mt-4">
                <x-jet-label value="{{ __('Contraseña') }}" />
                <x-jet-input class="block mt-1 w-full" type="password" name="password" />
            </div>

            <div class="mt-4">
                <x-jet-label value="{{ __('Confirmar Contraseña') }}" />
                <x-jet-input class="block mt-1 w-full" type="password" name="password_confirmation" />
            </div>

            <div class="flex justify-center mt-4">
                <x-jet-button>
                    {{ __('REGISTRAR') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-app-layout>
