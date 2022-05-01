<div>
    <div class="flex justify-between px-6 py-4 border-b border-gray-100">
        <x-jet-input type="text" wire:model.debounce.500ms="search" class="block w-10/12 mx-auto shadow-md" placeholder="Busca aquí"/>
        <div>
            <select class="ml-3" wire:model="role">
                <option value="Aprendiz" selected>Aprendiz</option>
                <option value="Instructor Tecnico">Instructor Tecnico</option>
                <option value="Instructor Seguimiento">Instructor Seguimiento</option>
            </select>
        </div>
    </div>
    <div class="p-3 overflow-x-auto">
        @if (count($users))
            <table class="table-auto w-full">
                <thead class="rounded-t-lg text-xs font-semibold uppercase text-white bg-orange-500">
                    <tr>
                        <th class="p-3 text-left whitespace-nowrap font-semibold">Documento</th>
                        <th class="p-3 text-left whitespace-nowrap font-semibold">Nombres</th>
                        <th class="p-3 text-left whitespace-nowrap font-semibold">Apellidos</th>
                        <th class="p-3 text-left whitespace-nowrap font-semibold">Correo</th>
                        @hasrole("Manager|Coordinador")
                            <th></th>
                        @endhasrole
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-gray-100">
                    @foreach ($users as $user)
                        <tr class="hover:bg-orange-50">
                            @if ($areAprentices)
                                <td class="whitespace-nowrap text-left font-bold text-gray-800"><a class="block p-2" href="{{ route('fichas.users.show', [$fichaUser->code, $user]) }}">{{ $user->document}}</a> </td>
                                <td class="whitespace-nowrap text-left font-bold text-gray-800"><a class="block p-2" href="{{ route('fichas.users.show', [$fichaUser->code, $user]) }}">{{ $user->profile->names}}</a> </td>
                                <td class="whitespace-nowrap text-left font-bold text-gray-800"><a class="block p-2" href="{{ route('fichas.users.show', [$fichaUser->code, $user]) }}">{{ $user->profile->surnames}}</a> </td>
                                <td class="whitespace-nowrap text-left font-bold text-gray-800"><a class="block p-2" href="{{ route('fichas.users.show', [$fichaUser->code, $user]) }}">{{ $user->email}}</a> </td>
                            @else
                                <td class="p-2 whitespace-nowrap text-left font-bold text-gray-800">{{ $user->document}}</td>
                                <td class="p-2 whitespace-nowrap text-left font-bold text-gray-800">{{ $user->profile->names}}</td>
                                <td class="p-2 whitespace-nowrap text-left font-bold text-gray-800">{{ $user->profile->surnames}}</td>
                                <td class="p-2 whitespace-nowrap text-left font-bold text-gray-800">{{ $user->email}}</td>
                            @endif                            
                            @hasrole("Manager|Coordinador")
                                <td class="whitespace-nowrap text-center font-bold text-gray-800 p-1">
                                    <x-jet-danger-button class="text-sm capitalize py-1 px-2" wire:click="detach({{$user->id}})">
                                        Desvincular
                                    </x-jet-danger-button>
                                </td>
                            @endhasrole
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="bg-white px-4 py—3 border—t text-gray-500 sm:px-6">
                No hay resultados para la busqueda "{{$search}}"
            </div>
        @endif
        <div class="px-4 mt-5 py—3 border—t  sm:px-6 text-center italic text-sm">
            {{ $users->links() }}
        </div>
    </div>
</div>
