<div>
    <div class="flex gap-2 px-4">
        <x-jet-input type="text" wire:model.debounce.500ms="search" class="block flex-1 mx-auto shadow-md" placeholder="Busca aquí"/>
        <div>
            <select wire:model="role">
                <option value="Aprendiz" selected>Aprendiz</option>
                <option value="Instructor Tecnico">Instructor Tecnico</option>
                <option value="Instructor Seguimiento">Instructor Seguimiento</option>
            </select>
        </div>
    </div>

    <table class="table-auto mx-auto my-5 shadow-lg">
        <thead>
            <tr class="bg-orange-100 text-gray-800 tracking-widest">
                <th class="px-4 py-2 font-sans font-normal border border-orange-300">Documento</th>
                <th class="px-4 py-2 font-sans font-normal border border-orange-300">Nombres</th>
                <th class="px-4 py-2 font-sans font-normal border border-orange-300">Apellidos</th>
                <th class="px-4 py-2 font-sans font-normal border border-orange-300">Correo</th>
                <th class="px-4 py-2 font-sans font-normal border border-orange-300">Rol</th>
                <th class="px-4 py-2 font-sans font-normal border border-orange-300"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr class=" odd:bg-orange-200 even:bg-orange-50 text-sm text-gray-600 border border-orange-300 hover:bg-orange-300 cursor-pointer">
                    <td class=""><a href="#" class="block px-4 py-2"> {{ $user->document}}</a> </td>
                    <td class=""><a href="#" class="block px-4 py-2"> {{ $user->profile->names}}</a> </td>
                    <td class=""><a href="#" class="block px-4 py-2"> {{ $user->profile->surnames}}</a> </td>
                    <td class=""><a href="#" class="block px-4 py-2"> {{ $user->email}}</a> </td>
                    <td class=""><a href="#" class="block px-4 py-2"> {{ $role}}</a> </td>
                    <td class="p-1">
                        <x-jet-danger-button class="text-sm capitalize py-1 px-2" wire:click="detach({{$user->id}})">
                            Desvincular
                        </x-jet-danger-button>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6" class="p-2 text-center italic text-sm bg-orange-400 border border-orange-300 rounded-b">
                    @if (strlen($users->links()) > 20)
                        {{$users->links()}}
                    @else
                        Displaying all records
                    @endif
                </td>            
            </tr>
        </tfoot>

    </table>
</div>
