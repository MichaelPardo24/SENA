<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Seguimiento de: {{ $apprentice->profile->full_name}} 
        </h2>
    </x-slot>

    <div class="py-5 mx-auto max-w-5xl rounded-sm sm:py-10 sm:px-6">
        {{-- Info  --}}
        <div x-data="{ showData: false }" class="mb-4">
            <button 
                type="button" 
                @click="showData = !showData" 
                class="px-2 py-1 bg-orange-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-orange-500 active:bg-orange-600 focus:outline-none focus:border-orange-600 focus:ring focus:ring-orange-300 disabled:opacity-25 transition block mx-auto">
                Ver Info extra
            </button>

            <div 
                class="mt-4 sm:grid sm:grid-cols-3 sm:gap-y-3" 
                x-cloak
                x-show="showData" 
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 -translate-y-8"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0 -translate-y-8"
                style="display: none !important">

                {{-- Info de la ficha --}}
                <div class="p-3">
                    <h3 class="tracking-wide text-gray-800 font-bold">Información de la ficha:</h3>
                </div>
                <div class="p-3 col-span-2 bg-white rounded shadow">
                    <ul class="list-disc list-inside text-sm text-gray-700">
                        <li><span class="font-bold">Código:</span> {{ $ficha->code}}</li>
                        <li><span class="font-bold">Programa:</span> {{ $ficha->program->name }}</li>
                        <li>
                            <span class="font-bold">Inicio y fin de lectiva:</span> 
                            {{ $ficha->start_school_stage->format('d-F-Y') . ' / ' . $ficha->end_school_stage->format('d-F-Y')}} 
    
                        </li>
                        <li>
                            <span class="font-bold">Inicio y fin de productiva:</span>
                            {{ $ficha->start_production_stage->format('d-F-Y') . ' / ' . $ficha->end_production_stage->format('d-F-Y') }}
                        </li>
                    </ul>
                </div>

                <div class="border col-span-3 border-gray-400 mt-4 w-4/6 mx-auto"></div>
    
                {{-- Info aprendiz --}}
                <div class="p-3 flex flex-col justify-center mt-3 sm:mt-0">
                    <h3 class="tracking-wide text-gray-800 font-bold">Información del aprendiz:</h3>
                    <img 
                        alt="{{ $apprentice->profile->full_name }}"  
                        class="rounded-full shadow-lg h-5/6 max-h-28 w-auto mx-auto" 
                        src="{{ $apprentice->profile_photo_url}}">
                </div>
                <div class="p-3 col-span-2 bg-white rounded shadow flex items-center">
                    <ul class="list-disc list-inside text-sm text-gray-700">
                        <li class="text-sm">
                            <span class="font-bold md:text-base">Documento: </span>
                            <span class="text-gray-700 italic">
                                {{ $apprentice->profile->document_type }} {{ $apprentice->profile->document }}
                            </span>
                        </li>
                        <li class="text-sm">
                            <span class="font-bold md:text-base">Correo: </span>
                            <span class="text-gray-700 italic">
                                {{ $apprentice->email}}
                            </span>
                        </li>
                        <li class="text-sm">
                            <span class="font-bold md:text-base">Telefono: </span>
                            <span class="text-gray-700 italic">
                                {{ $apprentice->profile->phone ?? 'Sin telefono asociado'}}
                            </span>
                        </li>
                        <li class="text-sm">
                            <span class="font-bold md:text-base">Dirección: </span>
                            <span class="text-gray-700 italic">
                                {{ $apprentice->profile->direction ?? 'Sin dirección asociada'}}
                            </span>
                        </li>
                        <li class="text-sm">
                            <span class="font-bold md:text-base">Fecha de nacimiento: </span>
                            <span class="text-gray-700 italic">
                                {{ 
                                    $apprentice->profile->birth_at ??
                                    'Sin fecha de nacimiento asociada'
                                }}
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="border border-gray-400 w-4/6 mx-auto"></div>

        @livewire('follow-ups.update-follow-up', ['followUp' => $followUp])

        <a href="{{ route('follow-ups.ficha.apprentices', $ficha) }}" class="inline-flex items-center px-4 py-2 bg-white border border-orange-300 rounded-md font-semibold text-xs text-orange-700 uppercase tracking-widest  hover:text-orange-500 focus:outline-none focus:border-orange-300 focus:ring focus:ring-orange-200 active:text-orange-800 active:bg-orange-50 disabled:opacity-25 transition fixed bottom-4 left-4 shadow-gray-800/40 shadow-lg">Volver</a>  
    </div>
</x-app-layout>