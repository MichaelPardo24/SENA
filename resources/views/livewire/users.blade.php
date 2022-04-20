<div>
    <header class="flex justify-between px-6 py-4 border-b border-gray-100">
        <a class="bg-orange-500 font-bold py-2 px-4 border rounded hover:bg-orange-400 text-white" href="{{ route('user.create') }}">Crear</a>
        <x-jet-input type="text" wire:model.debounce.500ms="search" class="mx-4 block w-10/12 mx-auto shadow-md" placeholder="Busca aquí"/>
    </header>
    <div class="p-3">
        @if (count($users))
        <table class="table-auto w-full">
            <thead class="rounded-t-lg text-xs font-semibold uppercase text-white bg-orange-500">
                <tr>
                    <th class="p-3 whitespace-nowrap">
                        <div class="font-semibold text-left">id</div>
                    </th>
                    <th class="p-3 whitespace-nowrap">
                        <div class="font-semibold text-left">Nombres</div>
                    </th>
                    <th class="p-3 whitespace-nowrap">
                        <div class="text-center font-semibold ">EMAIL</div>
                    </th>
                    <th class="p-3 whitespace-nowrap">
                        <div class="text-center font-semibold text-center">Documento</div>
                    </th>
                    <th class="p-3 whitespace-nowrap">
                        <div class="text-center font-semibold text-center mr-1 ">Tipo</div>
                    </th>
                    <th class="p-3 whitespace-nowrap">
                        <div class="text-center font-semibold ">Creación</div>
                    </th>
                    <th class="p-3 whitespace-nowrap">
                        <div class="text-center font-semibold ">Actualización</div>
                    </th>
                    <th class="p-3 whitespace-nowrap">
                        <div class="text-center font-semibold ">Rol</div>
                    </th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-100">
                @foreach ($users as $user)
                    <tr class="hover:bg-orange-50">
                        <td class="p-2 whitespace-nowrap">
                            <div class="text-center font-extrabold text-gray-900">
                                <a href="{{ route('user.edit', $user->id) }}">{{$user->id}}</a>
                            </div>
                        </td>
                        <td class="p-2 whitespace-nowrap flex justify-start">
                                <div class="py-2">
                                    <a href="{{ route('user.edit', $user->id) }}"><img alt="avatar" width="48" height="48" class="rounded-full w-8 h-8 shadow-lg" src="{{$user->profile_photo_url}}"></a>
                                </div>
                                <a href="{{ route('user.edit', $user->id) }}"><div class="font-semibold text-gray-800 pt-4 ml-2">{{Str::limit($user->profile->names." ".$user->profile->surnames, 30)}}</div></a>
                        </td>
                        <td class="p-2 whitespace-nowrap">
                            <a href="{{ route('user.edit', $user->id) }}">
                                <div class="text-center font-medium text-gray-700">
                                    {{$user->email}}
                                </div>
                            </a>
                        </td>
                        <td class="p-2 whitespace-nowrap">
                            <div class="text-center font-medium text-gray-700"><a href="{{ route('user.edit', $user->id) }}">{{$user->profile->document}}</a>
                            </div>
                        </td>
                        <td class="p-2 whitespace-nowrap">
                            <div class="text-center font-medium text-gray-700"><a href="{{ route('user.edit', $user->id) }}">{{$user->profile->document_type}}</a>
                            </div>
                        </td>
                        <td class="p-2 whitespace-nowrap">
                            <div class="text-center font-medium text-gray-800"><a href="{{ route('user.edit', $user->id) }}">{{$user->created_at->format('d/M/Y')}}</a>
                            </div>
                        </td>
                        <td class="p-2 whitespace-nowrap">
                            <div class="text-center font-medium text-gray-800"><a href="{{ route('user.edit', $user->id) }}">{{ $user->updated_at->format('d/M/Y') }}</a>
                            </div>
                        </td>
                        <td class="p-2 whitespace-nowrap">
                            <div class="text-center font-medium text-gray-800"><a href="{{ route('user.edit', $user->id) }}">{{ $user->roles()->first()->name }}</a>
                            </div>
                        </td>
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
            {{ $users->links() }}
         </div>
    </div>
</div>