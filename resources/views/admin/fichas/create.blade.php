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



            <div class="bg-white p-4 overflow-hidden shadow-xl sm:max-w-md sm:mx-auto sm:rounded-lg">
                
                @if (\Session::has('success'))
                    <div class="bg-green-400 border-l-8 -m-4 mb-4 border-green-600 text-slate-600">
                        <p class="p-2 py-4">{{ \Session::get('success') }}</p>
                    </div>
                @endif

                <x-jet-validation-errors class="mb-4" />

                <form action="{{ route('fichas.store') }}" method="post">
                    @csrf
                    <div>
                        <x-jet-label value="Codigo de la ficha:" />
                        <x-jet-input class="block mt-1 w-full" type="number" name="code" :value="old('code')" required autofocus />
                    </div>

                    <div class="mt-4">
                        <x-jet-label value="Programa:" />
                        <select name="program_id" class="block mt-1 w-full">
                            @foreach ($programs as $id => $name)
                                <option value="{{$id}}">{{$name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-4">
                        <x-jet-label value="Inicio etapa lectiva:" />
                        <x-jet-input 
                            class="block mt-1 w-full" 
                            type="date" 
                            name="start_school_stage" 
                            :value="old('start_school_stage')" required />
                    </div>

                    <div class="mt-4">
                        <x-jet-label value="Fin etapa lectiva:" />
                        <x-jet-input 
                            class="block mt-1 w-full" 
                            type="date" 
                            name="end_school_stage" 
                            :value="old('end_school_stage')" required />
                    </div>

                    <div class="mt-4">
                        <x-jet-label value="Inicio etapa productiva:" />
                        <x-jet-input 
                            class="block mt-1 w-full" 
                            type="date" 
                            name="start_production_stage" 
                            :value="old('start_production_stage')" required />
                    </div>

                    <div class="mt-4">
                        <x-jet-label value="Fin etapa productiva:" />
                        <x-jet-input 
                            class="block mt-1 w-full" 
                            type="date" 
                            name="end_production_stage" 
                            :value="old('end_production_stage')" required />
                    </div>

                    <div class="mt-4">
                        <x-jet-label value="Municipio:" />
                        <x-jet-input 
                            class="block mt-1 w-full" 
                            type="text" 
                            name="town" 
                            :value="old('town')" required />
                    </div>

                    <div class="mt-4">
                        <x-jet-label value="Tipo:" />
                        <select name="type" class="block mt-1 w-full">
                            <option value="Auxiliar">Auxiliar</option>
                            <option value="Espc. Tecnologica">Espc. Tecnologica</option>
                            <option value="Operario">Operario</option>
                            <option value="Profundizacion Tecnica">Profundizacion Tecnica</option>
                            <option value="Tecnologo">Tecnologo</option>
                            <option value="Tecnico">Tecnico</option>
                        </select>
                    </div>

                    <div class="flex flex-row p-2 mt-4 justify-around">
                        <x-jet-button class="">
                            Crear Ficha
                        </x-jet-button>
                        <a href="{{route('fichas.index')}}" class="font-semibold uppercase tracking-widest rounded bg-slate-700 text-xs text-slate-200 px-4 py-2 transition-all duration-300 hover:bg-slate-900">Index</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>