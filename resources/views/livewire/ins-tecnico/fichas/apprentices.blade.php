<div class="mt-4">

    {{-- Filtros --}}
    <h3 class="text-center italic uppercase text-gray-700">Filtros</h3>
    <div class="mb-4 flex px-3 gap-3 flex-wrap">
        <x-jet-input type="text" wire:model.debounce.600ms="filters.search" class="block w-full sm:flex-1 shadow-md" placeholder="Busca aquí..."/>
        <div class="mx-auto">
            <select name="fichaStatus" id="fichaStatus" wire:model="filters.selectedStatus">
                <option value="" selected>- Buscar por Estado -</option>
                @foreach ($this->fichaStatus as $fs)
                    <option value="{{$fs}}">{{$fs}}</option>
                @endforeach
            </select>
        </div>
    </div>

    @if (! $this->ficha->trashed())
        <div class="w-11/12 rounded my-4 mx-auto border border-gray-400"></div>
        <h3 class="text-center italic uppercase text-gray-700">Acciones</h3>

        {{-- Cambiar el estado de todos los alumnos --}}
        <div class="mb-4 flex px-3 gap-3 flex-wrap items-center">

            <div class="mx-auto">
                <select name="fichaFullStatus" id="fichaFullStatus" wire:model="selectedFullStatus" class="rounded-md bg-orange-100">
                    <option value="" selected>- Modificar Estado -</option>
                    @foreach ($this->fichaStatus as $fs)
                        <option value="{{$fs}}">{{$fs}}</option>
                    @endforeach
                </select>
            </div>

            {{-- Mustra el botón solo si se ha seleccionado un estado --}}
            <div class="flex-1" x-data="{ showButton: @entangle('selectedFullStatus') }">
                <template x-if="showButton">
                    <x-jet-secondary-button @click="$wire.updateAllApprenticesStatus()">
                        Modificar Estado
                    </x-jet-secondary-button>
                </template>
                <span class="text-xs italic"> <- Modifica el estado de TODOS los alumnos</span>
            </div>

        </div>

        {{-- 
            Se muestra mientras se renderiza de nuevo luego de modificar el estado de todos
            los aprendices 
        --}}
        <div wire:loading wire:target="updateAllApprenticesStatus" class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-72 h-min bg-slate-300 rounded-md shadow-black/40 shadow-lg">
            <div class="p-4">
                <p class="text-center my-auto">Cargando...</p>
            </div>
        </div>
    @endif


    @if ($apprentices->count())
        {{-- Table --}}
        <div class="w-full mx-auto p-3 overflow-x-auto">
            <table class="table-auto w-full">
                <thead class="rounded-t-lg text-xs font-semibold uppercase text-white bg-orange-500">
                    <tr>
                        <th class="p-3 whitespace-nowrap font-semibold">Documento</th>
                        <th class="p-3 whitespace-nowrap font-semibold">Nombre Completo</th>
                        <th class="p-3 whitespace-nowrap font-semibold">Correo</th>
                        <th class="p-3 whitespace-nowrap font-semibold">Estado</th>
                        <th class="p-3 whitespace-nowrap font-semibold"></th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-gray-100">
                    @foreach ($apprentices as $key => $apprentice)
                        <tr class="hover:bg-orange-50 cursor-default">
                            <td class="text-left p-2 whitespace-nowrap font-bold text-gray-800">
                                {{ $apprentice->document }}
                            </td>
                            <td class="text-left p-2 whitespace-nowrap font-bold text-gray-800">
                                <div class="flex items-center gap-2">
                                    <img 
                                        alt="avatar" 
                                        width="48" 
                                        height="48" 
                                        class="rounded-full w-8 h-8 shadow-lg" 
                                        src="{{ $apprentice->profile_photo_url}}">
                                                                    
                                        <span>{{ $apprentice->profile->full_name }}</span>
                                </div>
                            </td>
                            <td class="text-left p-2 whitespace-nowrap font-bold text-gray-800">
                                {{ $apprentice->email }}
                            </td>
                            <td class="text-left p-2 whitespace-nowrap font-bold text-gray-800">
                                {{ $apprentice->getOriginal('pivot_status') }}
                            </td>
                            <td class="text-left p-2 whitespace-nowrap font-bold text-gray-800">
                                <button class="inline-block rounded-md bg-gray-300 py-0.5 px-3 text-sm transition-colors duration-200 hover:bg-gray-400 hover:shadow" wire:click="showModal({{$key}})">
                                    Info
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- More Info and editing modal --}}
        <x-jet-dialog-modal wire:model="openModal">
            @slot('title')
                {{ $apprentices[$this->n]->profile->full_name }} {{-- 'n' hace referencia al index que cada alumno tiene en la colección --}}
            @endslot

            @slot('content')
                <article>
                    <p>Informacion del aprendiz: </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                        <div class="flex items-center">
                            <img 
                                alt="{{ $apprentices[$this->n]->profile->full_name }}"  
                                class="rounded-full shadow-lg h-5/6 max-h-64 w-auto mx-auto" 
                                src="{{ $apprentices[$this->n]->profile_photo_url}}">
                        </div>
                        <div class="flex items-center">
                            <ul>
                                <li class="text-sm">
                                    <span class="font-bold md:text-base">Documento: </span>
                                    <span class="text-gray-700 italic">
                                        {{ $apprentices[$this->n]->profile->document_type }} {{ $apprentices[$this->n]->profile->document }}
                                    </span>
                                </li>
                                <li class="text-sm">
                                    <span class="font-bold md:text-base">Correo: </span>
                                    <span class="text-gray-700 italic">
                                        {{ $apprentices[$this->n]->email}}
                                    </span>
                                </li>
                                <li class="text-sm">
                                    <span class="font-bold md:text-base">Telefono: </span>
                                    <span class="text-gray-700 italic">
                                        {{ $apprentices[$this->n]->profile->phone ?? 'Sin telefono asociado'}}
                                    </span>
                                </li>
                                <li class="text-sm">
                                    <span class="font-bold md:text-base">Dirección: </span>
                                    <span class="text-gray-700 italic">
                                        {{ $apprentices[$this->n]->profile->direction ?? 'Sin dirección asociada'}}
                                    </span>
                                </li>
                                <li class="text-sm">
                                    <span class="font-bold md:text-base">Fecha de nacimiento: </span>
                                    <span class="text-gray-700 italic">
                                        {{ 
                                            $apprentices[$this->n]->profile->birth_at ??
                                            'Sin fecha de nacimiento asociada'
                                        }}
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </article>

                <div class="w-11/12 rounded my-4 mx-auto border border-gray-400"></div>
                {{-- Change status --}}
                <div class="flex items-center gap-3">
                    <span class="font-bold text-red-500">Cambiar estado:</span>
                    @livewire('extra.change-user-status', ['user' => $apprentices[$this->n], 'ficha' => $this->ficha->id], key($apprentices[$this->n]->id))
                </div>
            @endslot

            @slot('footer')
                <x-jet-secondary-button wire:click="$set('openModal', false)">
                    Cerrar
                </x-jet-secondary-button>
            @endslot
        </x-jet-dialog-modal>
    @else
        <div class="p-4 mx-auto my-3 rounded shadow-black/40 shadow-md max-w-lg bg-sky-200">
            <p class="text-center italic">No hay resultados para la busqueda <i class="fa-solid fa-cloud-showers-heavy"></i></p>
        </div>
    @endif


    {{-- 'Notificaciones'. Se muestran cuando se realiza el cambio de estado a TODOS los alumnos --}}
    <div 
        x-data="{ show: false }"
        x-cloak
        x-show="show"
        x-transition.scale.origin.right
        x-init="$wire.on('full-status-changed', () => { show = true; setTimeout(() => { show = false }, 2500) })"
        class="absolute top-14 right-0 rounded bg-green-200 border-l-4 border-green-600 text-slate-700 p-4"
        style="display: none !important;">
            Estado actualizado
    </div>
    <div 
        x-data="{ show: false }"
        x-cloak
        x-show="show"
        x-transition.scale.origin.right
        x-init="$wire.on('full-status-failed', () => { show = true; setTimeout(() => { show = false }, 2500) })"
        class="absolute top-14 right-0 rounded bg-red-200 border-l-4 border-red-600 text-slate-700 p-4"
        style="display: none !important;">
            Error al modificar estado :(
    </div>
</div>
