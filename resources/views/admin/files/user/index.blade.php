<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Fichas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                {{-- Messages --}}
                @if (\Session::has('success'))
                    <div class="bg-green-400 border-l-8 mb-4 border-green-600 text-slate-600 rounded-tr-md rounded-br-md">
                        <p class="p-2 py-4">{{ \Session::get('success') }}</p>
                    </div>
                @endif
                <div class="p-4">
                    <h3 class="text-lg text-orange-700">Archivos de: <span class="text-orange-500 text-xl">{{ $user->profile->names }}</span></h3>

                    <ul class="ml-4 list-disc list-inside text-sm">
                        <li>Documento: {{$user->document}}</li>
                    </ul>
                </div>

                <livewire:user-files :user="$user"/>

            </div>
        </div>
    </div>
</x-app-layout>