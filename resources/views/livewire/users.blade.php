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
        <a class="bg-orange-500 font-bold py-2 px-4 border rounded hover:bg-orange-400 text-white" href="{{ route('user.create') }}">Crear</a>
        <x-jet-input type="text" wire:model.debounce.500ms="search" class="block w-10/12 mx-auto shadow-md" placeholder="Busca aquí"/>
    </header>
    <div class="p-3 overflow-x-auto">
        @if (count($users))
        <table class="table-auto w-full">
            <thead class="rounded-t-lg text-xs font-semibold uppercase text-white bg-orange-500">
                <tr>
                    <th class="p-3 whitespace-nowrap">
                        <div class="font-semibold text-left">Nombres</div>
                    </th>
                    <th class="p-3 whitespace-nowrap">
                        <div class="text-center font-semibold ">EMAIL</div>
                    </th>
                    <th class="p-3 whitespace-nowrap">
                        <div class="font-semibold text-center">Documento</div>
                    </th>
                    <th class="p-3 whitespace-nowrap">
                        <div class="font-semibold text-center mr-1 ">Tipo</div>
                    </th>
                    <th class="p-3 whitespace-nowrap">
                        <div class="text-center font-semibold ">Creación</div>
                    </th>
                    <th class="p-3 whitespace-nowrap">
                        <div class="text-center font-semibold ">Actualización</div>
                    </th>
                    @role("Coordinador|Manager")
                        <th class="p-3 whitespace-nowrap">
                            <div class="text-center font-semibold ">Rol</div>
                        </th>
                    @endrole
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-100">
                @foreach ($users as $user)
                    @if($user->id != auth()->user()->id)                            
                        <tr class="hover:bg-orange-50">
                            <td class="whitespace-nowrap flex justify-start">
                                    <div>
                                        <a class="p-2 block" href="{{ route('user.edit', $user->id) }}"><img alt="avatar" width="48" height="48" class="rounded-full w-8 h-8 shadow-lg" src="{{$user->profile_photo_url}}"></a>
                                    </div>
                                    <a href="{{ route('user.edit', $user->id) }}"><div class="font-semibold text-gray-800 pt-4 ml-2">{{Str::limit($user->profile->names." ".$user->profile->surnames, 30)}}</div></a>
                            </td>
                            <td class="whitespace-nowrap">
                                <a class="p-2 block" href="{{ route('user.edit', $user->id) }}">
                                    <div class="text-center font-medium text-gray-700">
                                        {{$user->email}}
                                    </div>
                                </a>
                            </td>
                            <td class="whitespace-nowrap">
                                <div class="text-center font-medium text-gray-700"><a class="p-2 block" href="{{ route('user.edit', $user->id) }}">{{$user->profile->document}}</a>
                                </div>
                            </td>
                            <td class="whitespace-nowrap">
                                <div class="text-center font-medium text-gray-700"><a class="p-2 block" href="{{ route('user.edit', $user->id) }}">{{$user->profile->document_type}}</a>
                                </div>
                            </td>
                            <td class="whitespace-nowrap">
                                <div class="text-center font-medium text-gray-800"><a class="p-2 block" href="{{ route('user.edit', $user->id) }}">{{$user->created_at->format('d/m/Y')}}</a>
                                </div>
                            </td>
                            <td class="whitespace-nowrap">
                                <div class="text-center font-medium text-gray-800"><a class="p-2 block" href="{{ route('user.edit', $user->id) }}">{{ $user->updated_at->format('d/m/Y') }}</a>
                                </div>
                            </td>
                            @role("Coordinador|Manager")
                                <td class="whitespace-nowrap">
                                    <div class="text-center font-medium text-gray-800"><a class="p-2 block" href="{{ route('user.edit', $user->id) }}">{{ $user->roles()->first()->name }}</a></div>
                                </td>
                            @endrole
                        </tr>
                    @endif
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