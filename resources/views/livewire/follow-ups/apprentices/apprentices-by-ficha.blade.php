<div class="mt-4 p-3 sm:p-5">

    {{-- Filtros --}}
    <h3 class="text-center italic uppercase text-gray-700">Filtros</h3>
    <div class="flex gap-2 flex-wrap items-center mb-3">
        <x-jet-input type="text" wire:model.debounce.600ms="filters.search" class="block w-full sm:flex-1 shadow-md" placeholder="Busca aquí..."/>
        <div class="block">
            <span class="text-sm text-gray-500 italic">Mostrar 'en seguimiento' -></span>
            <input class="ml-2" type="checkbox" wire:model="filters.onlyFollow">
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
                            <td class="text-left p-2 font-bold text-gray-800">
                                {{ $apprentice->document }}
                            </td>
                            <td class="text-left p-2 font-bold text-gray-800">
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
                            <td class="text-left p-2 font-bold text-gray-800">
                                {{ $apprentice->email }}
                            </td>
                            <td class="text-left p-2 font-bold text-gray-800">
                                {{ $apprentice->getOriginal('pivot_status') }}
                            </td>
                            <td class="text-left p-2 font-bold text-gray-800">
                                @if ($this->filters['onlyFollow'])
                                    <a 
                                        href="{{ route('follow-ups.ficha.apprentices.show', ['ficha' => $this->ficha, 'user' => $apprentice])}}"
                                        class="block text-center py-1 px-2 bg-orange-400 border border-transparent rounded-md font-semibold text-xs text-white hover:bg-orange-500 active:bg-orange-600 focus:outline-none focus:border-orange-600 focus:ring focus:ring-orange-300 disabled:opacity-25 transition">
                                        Ver Seguimiento
                                    </a>
                                @else
                                    <button 
                                        wire:click="setModal({{$key}}, {{$apprentice->id}})"
                                        class="block text-center py-1 px-2 bg-orange-400 border border-transparent rounded-md font-semibold text-xs text-white hover:bg-orange-500 active:bg-orange-600 focus:outline-none focus:border-orange-600 focus:ring focus:ring-orange-300 disabled:opacity-25 transition">
                                        Nuevo Seguimiento
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    @else
        <div class="p-4 mx-auto my-3 rounded shadow-black/40 shadow-md max-w-lg bg-sky-200">
            <p class="text-center italic">
                No hay resultados para la busqueda / No hay alumnos 'preparados' 
                <i class="fa-solid fa-cloud-showers-heavy"></i>
            </p>
        </div>
    @endif

    {{-- Se carga el formulario de creacion solamente cuando se muestran 
        los parendices que aun no tienen un seguimiento para la ficha en 
        cuestion  --}}
    @if (! $this->filters['onlyFollow'] && $apprentices->count() > 0)
        <x-jet-dialog-modal wire:model="openModal">
            @slot('title')
                Empezar Segumiento para {{ $apprentices[$n]->profile->full_name }}
            @endslot

            @slot('content')
                <form wire:submit.prevent="createFollowUp" id="createFollowUp" autocomplete="off">
                    {{-- <input type="hidden" wire:model="state.apprentice_id"> --}}
                    {{-- Datos empresa --}}
                    <div class="mt-2 grid grid-cols-1 gap-3 sm:grid-cols-2">
                        <div>
                            <x-jet-label for="company_cod" value="Codigo Empresa *" />
                            <x-jet-input id="company_cod" type="text" class="mt-1 block w-full" wire:model="state.company_cod" />
                            <x-jet-input-error for="state.company_cod" class="mt-2" />
                        </div>
                        <div>
                            <x-jet-label for="company_name" value="Nombre Empresa *" />
                            <x-jet-input id="company_name" type="text" class="mt-1 block w-full" wire:model.defer="state.company_name" />
                            <x-jet-input-error for="state.company_name" class="mt-2" />
                        </div>
                        <div>
                            <x-jet-label for="company_address" value="Direccion Empresa *" />
                            <x-jet-input id="company_address" type="text" class="mt-1 block w-full" wire:model.defer="state.company_address" />
                            <x-jet-input-error for="state.company_address" class="mt-2" />
                        </div>
                    </div>

                    <div class="border border-gray-300 w-4/5 mx-auto my-4"></div>

                    {{-- Datos Jefe --}}
                    <div class="mt-2 grid grid-cols-1 gap-3 sm:grid-cols-2">
                        <div>
                            <x-jet-label for="boss_name" value="Nombre del Jefe *" />
                            <x-jet-input id="boss_name" type="text" class="mt-1 block w-full" wire:model.defer="state.boss_name" />
                            <x-jet-input-error for="state.boss_name" class="mt-2" />
                        </div>
                        <div>
                            <x-jet-label for="boss_phone" value="Tel. del Jefe" />
                            <x-jet-input id="boss_phone" type="text" class="mt-1 block w-full" wire:model.defer="state.boss_phone" />
                            <x-jet-input-error for="state.boss_phone" class="mt-2" />
                        </div>
                        <div>
                            <x-jet-label for="boss_email" value="Correo del Jefe *" />
                            <x-jet-input id="boss_email" type="email" class="mt-1 block w-full" wire:model.defer="state.boss_email" />
                            <x-jet-input-error for="state.boss_email" class="mt-2" />
                        </div>
                        <div>
                            <x-jet-label for="type_id" value="Tipo de productiva *" />
                            <select id="type_id" wire:model="state.type_id" class="w-full">
                                <option value="">Selecciona tipo</option>
                                @foreach ($types as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>
                            <x-jet-input-error for="state.type_id" class="mt-2" />
                        </div>
                    </div>
                </form>
            @endslot

            @slot('footer')
                <x-jet-secondary-button type="submit" form="createFollowUp">
                    Generar seguimiento
                </x-jet-secondary-button>
                <button class="ml-3 p-3" wire:click="$set('openModal', false)">
                    Cancelar
                </button>
            @endslot
        </x-jet-dialog-modal>
    @endif

        {{-- 'Notificaciones'. Se muestran cuando se realiza el cambio de estado a TODOS los alumnos --}}
    <div 
        x-data="{ show: false, message: '' }"
        x-cloak
        x-show="show"
        x-transition.scale.origin.right
        x-init="$wire.on('nice', ($message) => { show = true; message = $message; setTimeout(() => { show = false }, 3500) })"
        class="absolute !z-50 top-14 right-0 rounded bg-green-200 border-l-4 border-green-600 text-slate-700 p-4"
        style="display: none !important;">
            <span x-text="message"></span>
    </div>
    <div 
        x-data="{ show: false, message: '' }"
        x-cloak
        x-show="show"
        x-transition.scale.origin.right
        x-init="$wire.on('error', ($message) => { show = true; message = $message; setTimeout(() => { show = false }, 3500) })"
        class="absolute !z-50 top-14 right-0 rounded bg-red-200 border-l-4 border-red-600 text-slate-700 p-4"
        style="display: none !important;">
            <span x-text="message"></span>
    </div>
</div>

