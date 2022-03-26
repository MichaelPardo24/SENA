<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Fichas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="flex justify-center mb-4">
                <x-jet-authentication-card-logo class="mx-auto" />
            </div>

            <div class="p-4 overflow-hidden sm:max-w-2xl sm:mx-auto">
                
                @if (\Session::has('success'))
                    <div class="bg-green-400 border-l-8 -m-4 mb-4 border-green-600 text-slate-600">
                        <p class="p-2 py-4">{{ \Session::get('success') }}</p>
                    </div>
                @endif
                <a href="{{route('fichas.index')}}" class="font-semibold uppercase tracking-widest rounded bg-slate-700 text-xs text-slate-200 px-4 py-2 mb-3 transition-all duration-300 hover:bg-slate-900">Index</a>

                {{-- Formulario de actializacion --}}
                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-2">
                    <div class="bg-white p-4 shadow-lg rounded-lg">
                        <x-jet-validation-errors class="mb-4" />

                        <form action="{{ route('fichas.update', $ficha) }}" method="post">
                            @method('PUT')
                            @csrf
                            <div>
                                <x-jet-label value="Codigo de la ficha:" />
                                <x-jet-input class="block mt-1 w-full" type="number" name="code" :value="old('code') ?? $ficha->code " required autofocus />
                            </div>
        
                            <div class="my-4">
                                <x-jet-label value="Programa:" />
                                <select name="program_id" class="block mt-1 w-full">
                                    @foreach ($programs as $id => $name)
                                        @if ($ficha->program_id == $id)
                                            <option value="{{$id}}" selected>{{$name}}</option>                                    
                                            @continue
                                        @endif
                                        <option value="{{$id}}">{{$name}}</option>                                    
                                    @endforeach
                                </select>
                            </div>
        
                            <div class="my-4">
                                <x-jet-label value="Inicio etapa lectiva:" />
                                <x-jet-input 
                                    class="block mt-1 w-full" 
                                    type="date" 
                                    name="start_school_stage" 
                                    :value="old('start_school_stage') ?? $ficha->start_school_stage->format('Y-m-d')" required />
                            </div>
        
                            <div class="my-4">
                                <x-jet-label value="Fin etapa lectiva:" />
                                <x-jet-input 
                                    class="block mt-1 w-full" 
                                    type="date" 
                                    name="end_school_stage" 
                                    :value="old('end_school_stage') ?? $ficha->end_school_stage->format('Y-m-d')" required />
                            </div>
        
                            <div class="my-4">
                                <x-jet-label value="Inicio etapa productiva:" />
                                <x-jet-input 
                                    class="block mt-1 w-full" 
                                    type="date" 
                                    name="start_production_stage" 
                                    :value="old('start_production_stage') ?? $ficha->start_production_stage->format('Y-m-d')" required />
                            </div>
        
                            <div class="my-4">
                                <x-jet-label value="Fin etapa productiva:" />
                                <x-jet-input 
                                    class="block mt-1 w-full" 
                                    type="date" 
                                    name="end_production_stage" 
                                    :value="old('end_production_stage') ?? $ficha->end_production_stage->format('Y-m-d')" required />
                            </div>
        
                            <div class="my-4">
                                <x-jet-label value="Municipio:" />
                                <x-jet-input 
                                    class="block mt-1 w-full" 
                                    type="text" 
                                    name="town" 
                                    :value="old('town') ?? $ficha->town" required />
                            </div>
        
                            <div class="my-4">
                                <x-jet-label value="Tipo:" />
                                <select name="type" class="block mt-1 w-full">
                                    @foreach ($types as $type)
                                        @if ($ficha->type == $type)
                                            <option value="{{$type}}" selected>{{$type}}</option>                                    
                                            @continue
                                        @endif
                                        <option value="{{$type}}">{{$type}}</option>    
                                    @endforeach
                                </select>
                            </div>
        
                            <div class="flex flex-row p-2 mt-4 justify-around">
                                <x-jet-button class="">
                                    Editar Ficha
                                </x-jet-button>
                            </div>
                        </form>
                    </div>

                    {{-- Informacion de la ficha  --}}
                    <div class="flex flex-col p-3 gap-4 relative">
                        <div class="rounded shadow-lg">
                            <div class="rounded bg-orange-200 p-4 sticky top-4">
                                Alumnos: {{$ficha->users->count()}} <br>
                                Instructor Tecnico: {{$ficha->users->count()}}
                            </div>
                        </div>
                        
                        <div class="p-3 shadow-lg bg-red-200 rounded">
                            {{-- Formulario de eliminacion --}}
                            <form action="{{ route('fichas.destroy', $ficha) }}" method="post">
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
        </div>
    </div>
</x-app-layout>