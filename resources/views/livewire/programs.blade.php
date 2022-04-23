<div>
    <header class="flex justify-between px-6 py-4 border-b border-gray-100">
        @can('programs_create')
            <a class="bg-orange-500 font-bold py-2 px-4 border rounded hover:bg-orange-400 text-white" href="{{ route('programs.create') }}">Crear</a>           
        @endcan
        <x-jet-input type="text" wire:model.debounce.300ms="search" class="ml-4 block w-10/12 mx-auto shadow-md" placeholder="Busca aquí"/>
    </header>
    <div class="p-3">
        @if (count($programs))
            <table class="table-auto w-full">
                <thead class="rounded-t-lg text-xs font-semibold uppercase text-white bg-orange-500">
                    <tr>
                        <th class="p-3 whitespace-nowrap font-semibold text-left">Programa</th>
                        <th class="p-3 whitespace-nowrap font-semibold">Tipo</th>
                        <th class="p-3 whitespace-nowrap font-semibold">N. fichas</th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-gray-100">
                    @foreach ($programs as $program)
                        @can('programs_edit')
                            <tr class="hover:bg-orange-50">
                                <td class="whitespace-nowrap text-left font-bold text-gray-800"><a class="block p-2" href="{{ route('programs.edit', $program) }}" class="block px-4 py-2">{{ Str::limit($program->name, 50)}}</a></td>
                                <td class="px-5 whitespace-nowrap text-left font-semibold text-gray-700"><a class="block p-2" href="{{ route('programs.edit', $program) }}" class="block px-4 py-2">{{ $program->type}}</a></td>
                                <td class="whitespace-nowrap text-center font-medium text-gray-700"><a class="block p-2" href="{{ route('programs.edit', $program) }}" class="block px-4 py-2">{{ $program->fichas_count}}</a></td>
                            </tr>
                        @else
                            <tr class="hover:bg-orange-50">
                                <td class="whitespace-nowrap text-left font-bold text-gray-800 p-2">{{ Str::limit($program->name, 50)}}</td>
                                <td class="px-5 whitespace-nowrap text-left font-semibold text-gray-700 p-2">{{ $program->type}}</td>
                                <td class="whitespace-nowrap text-center font-medium text-gray-700 p-2">{{ $program->fichas_count}}</td>
                            </tr>
                        @endcan
                    @endforeach
                </tbody>
            </table> 
        @else
            <div class="bg-white px-4 py—3 border—t text-gray-500 sm:px-6">
                No hay resultados para la busqueda "{{$search}}" en la pagina {{$page}}
            </div>
        @endif
        <div class="px-4 mt-5 py—3 border—t  sm:px-6 text-center italic text-sm">
            {{ $programs->links() }}
         </div>
    </div>
</div>
