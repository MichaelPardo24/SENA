@php
    $showSearch = strlen($search) > 0;
    $areThereFiles = count($files) > 0 ? true : false;
@endphp

<div>
    <div class="w-full flex justify-between sm:mx-auto sm:max-w-5xl">
        @if ($areThereFiles || $showSearch & !$is_trashed)
            <a href="#" class="inline-block mx-4 my-3 text-center rounded bg-slate-700 text-xs text-slate-200 px-4 py-2 transition-all duration-300 hover:bg-slate-900">REPORTAR</a>
        @endif
        @if (!$is_trashed)
        <a 
            href="{{ route('fichas.apprentices-files.create', $ficha)}}" 
            class="inline-block mx-4 my-3 text-center rounded bg-orange-600 text-xs text-orange-100 px-4 py-2 transition-all duration-300 hover:bg-orange-800">
            SUBIR
        </a>
        @endif
    </div>

    @if ($showSearch || $areThereFiles)
        <header class="flex justify-between px-6 py-4 border-b border-gray-100">
            <x-jet-input type="text" wire:model.debounce.300ms="search" class="ml-4 block w-full shadow-md" placeholder="Busca aquí"/>
        </header>
    @endif

    @if ($areThereFiles)
           <table class="table-auto mx-auto my-5 shadow-lg">
            <thead>
                <tr class="bg-orange-100 text-gray-800 tracking-widest">
                    <th class="px-4 py-2 font-sans font-normal border border-orange-300">Nombre</th>
                    <th class="px-4 py-2 font-sans font-normal border border-orange-300">Fecha Subida</th>
                    <th class="px-4 py-2 font-sans font-normal border border-orange-300">Fecha Actualizacion</th>
                    <th class="px-4 py-2 font-sans font-normal border border-orange-300">Descargar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($files as $file)
                    <tr class=" odd:bg-orange-200 even:bg-orange-50 text-sm text-gray-600 border border-orange-300 hover:bg-orange-300 cursor-pointer">
                        <td class=""><a href="{{ route('apprentices-files.edit', $file) }}" class="block px-4 py-2"> {{ $file->name}}</a> </td>
                        <td class=""><a href="{{ route('apprentices-files.edit', $file) }}" class="block px-4 py-2"> {{ $file->created_at->format('M-d-Y')}}</a> </td>
                        <td class=""><a href="{{ route('apprentices-files.edit', $file) }}" class="block px-4 py-2"> {{ $file->updated_at->format('M-d-Y')}}</a> </td>

                        @can('view', $file)
                            <td class=""><a href="{{ route('apprentices-files.show', $file) }}" class="block px-4 py-2 hover:bg-orange-100 text-center"> Descargar </a> </td>                        
                        @else
                            <td class="cursor-default px-4 py-2"> Nope </td>
                        @endcan
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="p-2 text-center italic text-sm bg-orange-400 border border-orange-400 rounded-b">
                        @if (strlen($files->links()) > 20)
                            {{$files->links()}}
                        @else
                            Displaying all records
                        @endif
                    </td>            
                </tr>
            </tfoot>
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
