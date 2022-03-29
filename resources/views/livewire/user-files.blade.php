<div>
    <header class="flex justify-between px-6 py-4 border-b border-gray-100">
        <a class="bg-orange-500 font-bold py-2 px-4 mx-4 border rounded hover:bg-orange-400 text-white" href="{{ route('users.files.create', auth()->user()) }}">Subir</a>
        <x-jet-input type="text" wire:model.debounce.300ms="search" class="ml-4 block w-10/12 mx-auto shadow-md" placeholder="Busca aquí"/>
    </header>
    @if (count($files))
        <table class="table-auto w-full">
            <thead class="rounded-t-lg text-xs font-semibold uppercase text-white bg-orange-500">
                <tr>
                    <th class="p-3 whitespace-nowrap font-semibold">Nombre</th>
                    <th class="p-3 whitespace-nowrap font-semibold">Fecha Subida</th>
                    <th class="p-3 whitespace-nowrap font-semibold">Fecha Actualizacion</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-100">
                @foreach ($files as $file)
                    <tr class="hover:bg-orange-50">
                        <td class="p-2 whitespace-nowrap text-center font-bold text-gray-800"><a class="px-1 flex-auto" href="{{ route('files.edit', $file) }}">{{ $file->name}}</a></td>
                        <td class="p-2 whitespace-nowrap text-center font-bold text-gray-800"><a class="px-1 flex-auto" href="{{ route('files.edit', $file) }}">{{ $file->created_at->format('M-d-Y')}}</a></td>
                        <td class="p-2 whitespace-nowrap text-center font-bold text-gray-800"><a class="px-1 flex-auto" href="{{ route('files.edit', $file) }}">{{ $file->updated_at->format('M-d-Y')}}</a></td>
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
        {{ $files->links() }}
    </div>
</div>

