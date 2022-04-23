<div>
    <header class="flex justify-between px-6 py-4 border-b border-gray-100">
        <a class="bg-orange-500 font-bold py-2 px-4 border rounded hover:bg-orange-400 text-white" href="{{ route('fichas.create') }}">Crear</a>
        <x-jet-input type="text" wire:model.debounce.500ms="search" class="block w-10/12 mx-auto shadow-md" placeholder="Busca aquí"/>
    </header>
    <div class="p-3 overflow-x-auto">
        @if (count($fichas))
            <table class="table-auto w-full">
                <thead class="rounded-t-lg text-xs font-semibold uppercase text-white bg-orange-500">
                        <tr>
                            <th class="p-3 whitespace-nowrap font-semibold">Codigo</th>
                            <th class="p-3 whitespace-nowrap font-semibold">Programa</th>
                            <th class="p-3 whitespace-nowrap font-semibold">Inicio Lectiva</th>
                            <th class="p-3 whitespace-nowrap font-semibold">Fin Lectiva</th>
                            <th class="p-3 whitespace-nowrap font-semibold">Inicio Prod.</th>
                            <th class="p-3 whitespace-nowrap font-semibold">Fin Prod.</th>
                        </tr>
                </thead>
                <tbody class="text-sm divide-y divide-gray-100">
                    @foreach ($fichas as $ficha)
                        <tr class="hover:bg-orange-50">
                            <td class="whitespace-nowrap text-left font-bold text-gray-800"><a class="block p-2" href="{{ route('fichas.edit', $ficha) }}">{{ $ficha->code}}</a></td>
                            <td class="whitespace-nowrap text-left font-semibold text-gray-700"><a class="block p-2" class="block" href="{{ route('fichas.edit', $ficha) }}">{{ Str::limit($ficha->program->name, 50)}}</a></td>
                            <td class="whitespace-nowrap text-left font-medium text-gray-700"><a class="block p-2" href="{{ route('fichas.edit', $ficha) }}">{{ $ficha->start_school_stage->format('m-d-Y')}}</a></td>
                            <td class="whitespace-nowrap text-left font-medium text-gray-700"><a class="block p-2" href="{{ route('fichas.edit', $ficha) }}">{{ $ficha->end_school_stage->format('m-d-Y')}}</a></td>
                            <td class="whitespace-nowrap text-left font-medium text-gray-700"><a class="block p-2" href="{{ route('fichas.edit', $ficha) }}">{{ $ficha->start_production_stage->format('m-d-Y')}}</a></td>
                            <td class="whitespace-nowrap text-left font-medium text-gray-700"><a class="block p-2" href="{{ route('fichas.edit', $ficha) }}">{{ $ficha->end_production_stage->format('m-d-Y')}}</a></td>
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
            {{ $fichas->links() }}
         </div>
    </div>
</div>
