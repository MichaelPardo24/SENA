<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Fichas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="m-2 p-4 bg-slate-200">
                    <h3 class="text-slate-800">Ficha: {{ $ficha->code }}</h3>
                    <ul class="list-disc list-inside mb-3">
                        <li class="text-xs text-slate-700">{{ $ficha->program_id }}</li>
                        <li class="text-xs text-slate-700">{{ $ficha->start_school_stage }}</li>
                        <li class="text-xs text-slate-700">{{ $ficha->end_school_stage }}</li>
                        <li class="text-xs text-slate-700">{{ $ficha->start_production_stage }}</li>
                        <li class="text-xs text-slate-700">{{ $ficha->end_production_stage }}</li>
                        <li class="text-xs text-slate-700">{{ $ficha->type }}</li>
                    </ul>
                    <a href="{{route('fichas.edit', $ficha)}}" class="p-2 rounded inline-block text-sm bg-sky-400 text-white hover:bg-sky-500">EDITAR</a>
                    <a href="{{route('fichas.show', $ficha)}}" class="p-2 ml-4 rounded inline-block text-sm bg-sky-400 text-white hover:bg-sky-500">VER</a>

                    <div class="inline-block">
                        <form action="{{ route('fichas.destroy', $ficha) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <x-jet-button class="ml-4 p-1 text-xs">
                                Eliminar
                            </x-jet-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>