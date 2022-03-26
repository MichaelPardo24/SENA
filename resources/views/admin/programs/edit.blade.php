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

            <div class="p-4 overflow-hidden sm:max-w-md sm:mx-auto  sm:rounded-lg">
                @if (\Session::has('success'))
                    <div class="bg-green-400 border-l-8 -m-4 mb-4 border-green-600 text-slate-600">
                        <p class="p-2 py-4">{{ \Session::get('success') }}</p>
                    </div>
                @endif

                <a href="{{ route('programs.index') }}" class="inline-block font-semibold uppercase tracking-widest rounded bg-slate-700 text-xs text-slate-200 px-4 py-2 mb-4 transition-all duration-300 hover:bg-slate-900">INDEX</a>
                
                <div class="p-3 bg-white shadow-lg">
                    <x-jet-validation-errors class="m-4" />

                    <form action="{{ route('programs.update', $program) }}" method="post">
                        @method('PUT')
                        @csrf
                        <div>
                            <x-jet-label value="Nombre:" />
                            <x-jet-input class="block mt-1 w-full" type="text" name="name" :value="old('name') ?? $program->name " required autofocus />
                        </div>
    
                        <div class="my-4">
                            <x-jet-label value="Tipo:" />
                            <select name="type" class="block mt-1 w-full">
                                @foreach ($types as $type)
                                    @if ($program->type == $type)
                                        <option value="{{$type}}" selected>{{$type}}</option>                                    
                                        @continue
                                    @endif
                                    <option value="{{$type}}">{{$type}}</option>    
                                @endforeach
                            </select>
                        </div>
    
                        <div class="flex flex-row p-2 mt-4 justify-around">
                            <x-jet-button class="">
                                Editar programa
                            </x-jet-button>

                            <a href="{{route('programs.index') }}" class="font-semibold uppercase tracking-widest rounded bg-slate-700 text-xs text-slate-200 px-4 py-2 transition-all duration-300 hover:bg-slate-900">Index</a>
                        </div>
                    </form>
                </div>

                <div class="mt-2 p-2 bg-red-200">
                    <form action="{{ route('programs.destroy', $program) }}" class="w-full" method="POST">
                        @method('DELETE')
                        @csrf

                        <button type="submit" class="block w-full items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring focus:ring-red-300 disabled:opacity-25 transition">
                            Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>