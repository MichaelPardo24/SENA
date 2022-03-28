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
                        <div class="text-center font-semibold ">Acciones</div>
                    </th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-100">
                @foreach ($users as $user)
                    <tr>
                        <td class="p-2 whitespace-nowrap">
                            <div class="text-center font-extrabold text-gray-900">
                                {{$user->id}}
                            </div>
                        </td>
                        <td class="p-2 whitespace-nowrap flex justify-start">
                            <div class="py-2">
                                <img alt="avatar" width="48" height="48" class="rounded-full w-8 h-8 shadow-lg" src="{{$user->profile_photo_url}}">
                            </div>
                            <div class="font-semibold text-gray-800 pt-4 ml-2">{{Str::limit($user->profile->names." ".$user->profile->surnames, 30)}}</div>
                        </td>
                        <td class="p-2 whitespace-nowrap">
                            <div class="text-center font-medium text-gray-700">
                                {{$user->email}}
                            </div>
                        </td>
                        <td class="p-2 whitespace-nowrap">
                            <div class="text-center font-medium text-gray-700">{{$user->profile->document}}
                            </div>
                        </td>
                        <td class="p-2 whitespace-nowrap">
                            <div class="text-center font-medium text-gray-700">{{$user->profile->document_type}}
                            </div>
                        </td>
                        <td class="p-2 whitespace-nowrap">
                            <div class="text-center font-medium text-gray-800">{{$user->created_at->format('d/M/Y')}}
                            </div>
                        </td>
                        <td class="p-2 whitespace-nowrap">
                            <div class="text-center font-medium text-gray-800">{{ $user->updated_at->format('d/M/Y') }}
                            </div>
                        </td>
                        <td class="p-2 whitespace-nowrap">
                            <div class="flex items-center">
                                <a class="px-1 flex-auto" href="{{ route('user.show', $user->id) }}"><i class="fa-solid fa-eye fa-xl" style="color:gray"></i></a>

                                <a class="px-1 flex-auto" href="{{ route('user.edit', $user->id) }}"><i class="fa-solid fa-user-pen fa-xl" style="color:gray"></i></a>
                                <button class="px-1 flex-auto" data-modal-toggle="popup-modal" data-id="{{ $user->id }}" ><i class="fa-solid fa-trash fa-xl" style="color:red"></i></button>
                                <!-- Delete Product Modal -->
                                <div class="hidden overflow-y-auto overflow-x-hidden fixed right-0 left-0 top-4 z-50 justify-center items-center md:inset-0 h-modal sm:h-full" id="popup-modal">
                                    <div class="relative px-4 w-full max-w-md h-full md:h-auto">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <!-- Modal header -->
                                            <div class="flex justify-end p-2">
                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="popup-modal">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="p-6 pt-0 text-center">
                                                <svg class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">¿Estas seguro que quieres eliminar este usuario?</h3>
                                                <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="m-3">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button data-modal-toggle="popup-modal" type="submit" class="text-white bg-gray-600 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                        Si, estoy seguro
                                                    </button>
                                                </form>
                                                <button data-modal-toggle="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600">No, cancelar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
