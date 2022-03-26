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
                
                <h3 class="block p-4 text-slate-800">Mis Archivos:</h3>

                <a href="{{ route('users.files.create', auth()->user()) }}" class="inline-block mx-4 my-3 text-center rounded bg-slate-700 text-xs text-slate-200 px-4 py-2 transition-all duration-300 hover:bg-slate-900">SUBIR</a>

                <livewire:user-files :user="$user"/>

            </div>
        </div>
    </div>
</x-app-layout>