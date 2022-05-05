@php
    $showSearch = strlen($search) > 0;
    $areThereFiles = count($files) > 0 ? true : false;
@endphp

<div>
    {{-- Si la ficha se ha 'archivaodo' mostramos un mensaje --}}
    @if ($is_trashed)
        <div class="flex items-center bg-sky-600 text-white text-sm font-bold px-4 py-3" role="alert">
            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
            <p>A esta ficha ya NO se pueden subir archivos</p>
        </div>    
    @endif

{{--     <div class="w-full flex justify-between sm:mx-auto sm:max-w-5xl">
        @if (($areThereFiles || $showSearch) & !$is_trashed)
            <a href="#" class="inline-block mx-4 my-3 text-center rounded bg-slate-700 text-xs text-slate-200 px-4 py-2 transition-all duration-300 hover:bg-slate-900">REPORTAR</a>
        @endif
        @if (!$is_trashed)
            <a 
                href="{{ route('fichas.apprentices-files.create', $ficha)}}" 
                class="inline-block mx-4 my-3 text-center rounded bg-orange-600 text-xs text-orange-100 px-4 py-2 transition-all duration-300 hover:bg-orange-800">
                SUBIR
            </a>
        @endif
    </div> --}}


    <header class="flex justify-between px-6 py-4 border-b border-gray-100">
        @if (!$is_trashed)
            <a 
                href="{{ route('fichas.apprentices-files.create', $ficha)}}" 
                class="bg-orange-500 font-bold py-2 px-4 mr-1 border rounded hover:bg-orange-400 text-white ">
                SUBIR
            </a>
        @endif
        @if ($showSearch || $areThereFiles)
            <x-jet-input type="text" wire:model.debounce.300ms="search" class="ml-4 block w-full shadow-md" placeholder="Busca aquí"/>
        @endif
    </header>

    <div class="p-3 overflow-x-auto">
        @if ($areThereFiles)
           <table class="table-auto mx-auto my-5 shadow-lg">
                <thead class="rounded-t-lg text-xs font-semibold uppercase text-white bg-orange-500">
                    <tr>
                        <th class="p-3 whitespace-nowrap font-semibold">Nombre</thclass=>
                        <th class="p-3 whitespace-nowrap font-semibold">Fecha Subida</th>
                        <th class="p-3 whitespace-nowrap font-semibold">Fecha Actualizacion</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-gray-100">
                    @foreach ($files as $file)
                        <tr class="hover:bg-orange-50">
                            <td class="whitespace-nowrap text-center font-semibold text-gray-800"><a href="{{ route('apprentices-files.edit', $file) }}" class="block p-2"> {{ $file->name}}</a> </td>
                            <td class="whitespace-nowrap text-center font-semibold text-gray-800"><a href="{{ route('apprentices-files.edit', $file) }}" class="block p-2"> {{ $file->created_at->format('M-d-Y')}}</a> </td>
                            <td class="whitespace-nowrap text-center font-semibold text-gray-800"><a href="{{ route('apprentices-files.edit', $file) }}" class="block p-2"> {{ $file->updated_at->format('M-d-Y')}}</a> </td>

                            @can('view', $file)
                                <td class="whitespace-nowrap text-center font-bold text-gray-800"><a href="{{ route('apprentices-files.show', $file) }}" class="block p-2"> Descargar </a> </td>                        
                            @else
                                <td class="cursor-default px-4 py-2"> Nope </td>
                            @endcan
                        </trlass=>
                    @endforeach
                </tbody>
                <div class="px-4 mt-5 py—3 border—t  sm:px-6 text-center italic text-sm">
                    {{ $files->links() }}
                </div>
            </table>
        @else
            @if ($showSearch)
                <div class="bg-white mb-4 px-4 py—3 sm:max-w-lg sm:mx-auto text-center text-gray-500 text-sm italic sm:px-6">
                    No hay resultados para la busqueda "{{$search}}" en la pagina {{$page}}
                </div>
            @else
                <div class="bg-white mb-4 px-4 py—3 sm:max-w-lg sm:mx-auto text-center text-gray-500 text-sm italic sm:px-6">
                    No hay ningun archivo que mostrar :')
                </div>
            @endif
        @endif
    </div>
</div>
