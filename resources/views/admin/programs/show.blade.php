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
                    <h3 class="text-slate-800">Programa: {{ $program->name }}</h3>
                    <a href="{{route('programs.edit', $program)}}" class="mx-4 my-3 text-center rounded bg-slate-700 text-xs text-slate-200 px-4 py-2 transition-all duration-300 hover:bg-slate-900">EDITAR</a>
                    <a href="{{route('programs.index')}}" class="mx-4 my-3 text-center rounded bg-slate-700 text-xs text-slate-200 px-4 py-2 transition-all duration-300 hover:bg-slate-900">INDEX</a>

                    <div class="inline-block">
                        <form action="{{ route('programs.destroy', $program) }}" method="POST">
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