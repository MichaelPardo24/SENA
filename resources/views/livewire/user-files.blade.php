<div>
    <header class="flex justify-between px-6 py-4 border-b border-gray-100">
        <a class="bg-orange-500 font-bold py-2 px-4 mx-4 border rounded hover:bg-orange-400 text-white" href="{{ route('users.files.create', auth()->user()) }}">Subir</a>
        <x-jet-input type="text" wire:model.debounce.300ms="search" class="ml-4 block w-10/12 mx-auto shadow-md" placeholder="Busca aquí"/>
    </header>
    @if (count($files))
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
                    <td colspan="6" class="p-2 text-center italic text-sm bg-orange-400 border border-orange-400 rounded-b">
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
        <div class="bg-white px-4 py—3 border—t text-gray-500 sm:px-6">
            No hay resultados para la busqueda "{{$search}}" en la pagina {{$page}}
        </div>
    @endif
    <div class="px-4 mt-5 py—3 border—t  sm:px-6 text-center italic text-sm">
        {{ $files->links() }}
    </div>
</div>

