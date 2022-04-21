<div class="mt-4">
    <div class="mb-4 flex px-3 gap-3 flex-wrap">
        <x-jet-input type="text" wire:model.debounce.600ms="search" class="block w-full sm:flex-1 shadow-md" placeholder="Busca aquí..."/>
        <div class="mx-auto">
            <select name="fichaStatus" id="fichaStatus" wire:model="selectedStatus">
                <option value="" selected>- Estado -</option>
                @foreach ($this->fichaStatus as $fs)
                    <option value="{{$fs}}">{{$fs}}</option>
                @endforeach
            </select>
        </div>
    </div>

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
                @foreach ($apprentices as $apprentice)
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
                            <button class="inline-block rounded-md bg-gray-300 py-0.5 px-3 text-sm transition-colors duration-200 hover:bg-gray-400 hover:shadow">
                                Info
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

