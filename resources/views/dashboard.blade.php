<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                {{-- A los aprendices solamente se les muestra esta opcion  --}}
                @if (auth()->user()->hasRole('Aprendiz'))
                    <div class="p-4">
                        <h2 class="text-xl text-orange-600 font-semibold">Subir archivos</h2>
                        <p class="text-md">Por favor selecciona una ficha:</p>
                        @livewire('extra.list-apprentice-fichas')
                    </div>
                @endif

                {{-- Si es instructor --}}
                @if (auth()->user()->hasRole('Instructor Tecnico'))
                    <div class="p-4 my-3">
                        <h2 class="text-xl text-orange-600 font-semibold">Fichas asociadas</h2>
                        <p class="text-md">Estas son las fichas a las cuales ha sido asignado:</p>
                        <div class="mt-2 flex items-center">
                            <div class="inline-block h-4 w-4 mr-2 rounded bg-red-200"></div>
                            <span class="text-xs select-none text-gray-500">Ficha archivada</span>
                        </div>
                        @livewire('ins-tecnico.fichas')
                    </div>
                @endif

                {{-- Si es instructor de seguimiento --}}
                @if (auth()->user()->hasRole('Instructor Seguimiento'))
                    <div class="p-4 my-3">
                        <h2 class="text-xl text-orange-600 font-semibold">Aprendices asociados</h2>
                        <p class="text-md">Para ver los aprendices a los que debe realizar seguimiento de clic en el siguiente botón:</p>
                        <a
                            class="inline-flex items-center px-4 py-2 bg-orange-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-orange-500 active:bg-orange-600 focus:outline-none focus:border-orange-600 focus:ring focus:ring-orange-300 disabled:opacity-25 transition mt-2"
                            href="{{ route('follow-ups.index') }}">
                            Ver Aprendices
                        </a>
                        
                        {{-- Listado de fichas --}}
                        @livewire('follow-ups.index')
                    </div>
                @endif
                
            </div>
        </div>
    </div>
</x-app-layout>
