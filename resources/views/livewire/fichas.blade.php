<div>
    @if ($message)
        <div class="bg-green-100 rounded-b text-green-900 px-4 py-3 shadow-md" role="alert">
            <div class="flex">
                <div class="py-1"><svg class="mt-2 fill-current h-6 w-6 text-green-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                <div>
                    <p class="font-bold">Nuevo Aviso...</p>
                    <p>{{ $message }}</p>
                </div>
                <button type="button" class="ml-auto -mx-1.5 mt-2 bg-green-100 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8 dark:bg-green-200 dark:text-green-600 dark:hover:bg-green-300" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg wire:click="closeAlert" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                  </button>
            </div>
        </div>
    @endif
    <header class="flex justify-between px-6 py-4 border-b border-gray-100">
        <a class="bg-orange-500 font-bold py-2 px-4 mr-1 border rounded hover:bg-orange-400 text-white" href="{{ route('fichas.create') }}">Crear</a>
        @if ($showSoftDeletes == true)
            <button wire:click="$set('showSoftDeletes', false)" class="bg-orange-500 font-bold py-2 px-4 border rounded hover:bg-orange-400 text-white">
                Regresar
            </button>
        @else
            <button wire:click="$set('showSoftDeletes', true)" class="bg-purple-500 font-bold py-2 px-4 border rounded hover:bg-purple-400 text-white">
                Ver Archivados
            </button>
        @endif
        <x-jet-input type="text" wire:model.debounce.500ms="search" class="block w-9/12 mx-auto shadow-md" placeholder="Busca aquí"/>
    </header>
    <div class="p-3 overflow-x-auto">
        @if (count($fichas))
            <table class="table-auto w-full">
                <thead class="rounded-t-lg text-xs font-semibold uppercase text-white bg-orange-500">
                        <tr>
                            <th class="p-3 whitespace-nowrap font-semibold">Codigo</th>
                            <th class="p-3 whitespace-nowrap font-semibold">Programa</th>
                            <th class="p-3 whitespace-nowrap font-semibold">Inicio Lectiva</th>
                            <th class="p-3 whitespace-nowrap font-semibold">Fin Lectiva</th>
                            <th class="p-3 whitespace-nowrap font-semibold">Inicio Prod.</th>
                            <th class="p-3 whitespace-nowrap font-semibold">Fin Prod.</th>
                            @if ($showSoftDeletes == true)
                                <th class="p-3 whitespace-nowrap font-semibold">Acciones</th>
                            @endif
                        </tr>
                </thead>
                <tbody class="text-sm divide-y divide-gray-100">
                    @foreach ($fichas as $ficha)
                        <tr class="hover:bg-orange-50">
                            @if ($showSoftDeletes == true)
                                <td class="p-2 whitespace-nowrap text-center font-bold text-gray-800">{{ $ficha->code}}</td>
                                <td class="p-2 whitespace-nowrap text-left font-semibold text-gray-700">{{ Str::limit($ficha->program->name, 50)}}</td>
                                <td class="p-2 whitespace-nowrap text-center font-medium text-gray-700">{{ $ficha->start_school_stage->format('m-d-Y')}}</td>
                                <td class="p-2 whitespace-nowrap text-center font-medium text-gray-700">{{ $ficha->end_school_stage->format('m-d-Y')}}</td>
                                <td class="p-2 whitespace-nowrap text-center font-medium text-gray-700">{{ $ficha->start_production_stage->format('m-d-Y')}}</td>
                                <td class="p-2 whitespace-nowrap text-center font-medium text-gray-700">{{ $ficha->end_production_stage->format('m-d-Y')}}</td>
                                <td class="text-center font-medium text-gray-700">
                                    <x-jet-danger-button class="py-1" wire:click="destroy({{ $ficha->id }})">
                                        ELIMINAR
                                    </x-jet-danger-button>
                                    <button wire:click="restore({{ $ficha->id }})" class="bg-green-500 py-1 px-4 border rounded hover:bg-green-400 text-white">
                                        RECUPERAR
                                    </button>
                                </td>
                            @else
                                <td class="whitespace-nowrap text-center font-bold text-gray-800"><a class="block p-2" href="{{ route('fichas.edit', $ficha) }}">{{ $ficha->code}}</a></td>
                                <td class="whitespace-nowrap text-left font-semibold text-gray-700"><a class="block p-2" class="block" href="{{ route('fichas.edit', $ficha) }}">{{ Str::limit($ficha->program->name, 50)}}</a></td>
                                <td class="whitespace-nowrap text-center font-medium text-gray-700"><a class="block p-2" href="{{ route('fichas.edit', $ficha) }}">{{ $ficha->start_school_stage->format('m-d-Y')}}</a></td>
                                <td class="whitespace-nowrap text-center font-medium text-gray-700"><a class="block p-2" href="{{ route('fichas.edit', $ficha) }}">{{ $ficha->end_school_stage->format('m-d-Y')}}</a></td>
                                <td class="whitespace-nowrap text-center font-medium text-gray-700"><a class="block p-2" href="{{ route('fichas.edit', $ficha) }}">{{ $ficha->start_production_stage->format('m-d-Y')}}</a></td>
                                <td class="whitespace-nowrap text-center font-medium text-gray-700"><a class="block p-2" href="{{ route('fichas.edit', $ficha) }}">{{ $ficha->end_production_stage->format('m-d-Y')}}</a></td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="bg-white px-4 py—3 border—t text-gray-500 sm:px-6">
                No hay resultados para la busqueda "{{$search}}" en la pagina {{$page}}
            </div>
        @endif
        <div class="px-4 mt-5 py—3 border—t  sm:px-6 text-center italic text-sm">
            {{ $fichas->links() }}
         </div>
    </div>

    <x-jet-dialog-modal wire:model="open_destroy">
        <x-slot name="title">
            ELIMINAR FICHA
        </x-slot>
        <x-slot name="content">
            <div class="my-2">
                <x-jet-label value="¿ESTA SEGURO QUE QUIERE ELIMINAR ESTA FICHA? DESAPARECERA TOTALMENTE DE LOS REGISTROS" />
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button class="mr-4" wire:click="$set('open_destroy', false)">
                CANCELAR
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="confirmDestroy" wire:loading.attr="disabled" wire:target="confirmDestroy" class="disabled:opacity-25">
                ELIMINAR
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
