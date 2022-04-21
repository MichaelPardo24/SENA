<div class="mt-4">
    {{-- <div class="mb-4">
        <x-jet-input type="text" wire:model.debounce.500ms="search" class="block w-10/12 mx-auto shadow-md" placeholder="Busca aquí..."/>
    </div> --}}
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
                    <tr class="hover:bg-orange-50">
                        <td class="text-left p-2 whitespace-nowrap font-bold text-gray-800">
                            {{ $apprentice->document }}
                        </td>
                        <td class="text-left p-2 whitespace-nowrap font-bold text-gray-800">
                            {{ $apprentice->profile->full_name }}
                        </td>
                        <td class="text-left p-2 whitespace-nowrap font-bold text-gray-800">
                            {{ $apprentice->email }}
                        </td>
                        <td class="text-left p-2 whitespace-nowrap font-bold text-gray-800">
                            {{ $apprentice->pivot->status }}
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

