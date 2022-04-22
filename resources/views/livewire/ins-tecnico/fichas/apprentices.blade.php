<div class="mt-4">
    {{-- Filters --}}
    <div class="mb-4 flex px-3 gap-3 flex-wrap">
        <x-jet-input type="text" wire:model.debounce.600ms="filters.search" class="block w-full sm:flex-1 shadow-md" placeholder="Busca aquí..."/>
        <div class="mx-auto">
            <select name="fichaStatus" id="fichaStatus" wire:model="filters.selectedStatus">
                <option value="" selected>- Estado -</option>
                @foreach ($this->fichaStatus as $fs)
                    <option value="{{$fs}}">{{$fs}}</option>
                @endforeach
            </select>
        </div>
    </div>

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
                {{ $apprentices[$this->n]->profile->full_name }}
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
</div>

