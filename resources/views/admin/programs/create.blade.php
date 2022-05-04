<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Programas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                       
            <div class="flex justify-center mb-4">
                <x-jet-authentication-card-logo class="mx-auto" />
            </div>

            <div class="bg-white p-4 overflow-hidden shadow-xl sm:max-w-md sm:mx-auto sm:rounded-lg">

                @if (\Session::has('success'))
                    <div class="bg-green-400 border-l-8 -m-4 mb-4 border-green-600 text-slate-600">
                        <p class="p-2 py-4">{{ \Session::get('success') }}</p>
                    </div>
                @endif

                <x-jet-validation-errors class="mb-4" />

                <form action="{{ route('programs.store') }}" method="post" autocomplete="off">
                    @csrf
                    <div>
                        <x-jet-label value="Nombre:" />
                        <x-jet-input class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                    </div>

                    <div class="my-4">
                        <x-jet-label value="Tipo:" />
                        <select name="type" class="block mt-1 w-full">
                            @foreach ($types as $type)
                                <option value="{{$type}}">{{$type}}</option>    
                            @endforeach
                        </select>
                    </div>

                    <div class="flex flex-row p-2 mt-4 justify-around">
                        <x-jet-button class="">
                            Crear Programa
                        </x-jet-button>

                        <a href="{{ route('programs.index') }}" class="font-semibold uppercase tracking-widest rounded bg-slate-700 text-xs text-slate-200 px-4 py-2 transition-all duration-300 hover:bg-slate-900">Regresar+-</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>