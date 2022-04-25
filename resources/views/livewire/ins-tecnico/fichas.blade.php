<div class="mt-4">
    <div class="mb-4">
        <x-jet-input type="text" wire:model.debounce.500ms="search" class="block w-10/12 mx-auto shadow-md" placeholder="Busca aquí por codigo de ficha o nombre de programa"/>
    </div>
    <div class="w-full sm:w-5/6 mx-auto p-2 overflow-x-auto">
        <table class="table-auto w-full">
            <thead class="rounded-t-lg text-xs font-semibold uppercase text-white bg-orange-500">
                    <tr>
                        <th class="p-3 whitespace-nowrap font-semibold">Codigo</th>
                        <th class="p-3 whitespace-nowrap font-semibold">Programa</th>
                        <th class="p-3 whitespace-nowrap font-semibold">Inicio Lectiva</th>
                        <th class="p-3 whitespace-nowrap font-semibold">Fin Lectiva</th>
                        <th class="p-3 whitespace-nowrap font-semibold">Inicio Prod.</th>
                        <th class="p-3 whitespace-nowrap font-semibold">N° usuarios.</th>
                    </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-100">
                @foreach ($fichas as $ficha)
                    @if ($ficha->trashed()) <tr class="bg-red-100 hover:bg-red-200">
                    @else <tr class="hover:bg-orange-50"> @endif
    
                        <td class="text-left font-bold text-gray-800"><a class="p-2 whitespace-nowrap" href="{{ route('ins-tecnico.fichas.apprentices', $ficha) }}">{{ $ficha->code }}</a></td>
                        <td class="text-left font-semibold text-gray-700"><a class="inline-block p-2 w-full whitespace-nowrap" href="{{ route('ins-tecnico.fichas.apprentices', $ficha) }}">{{ $ficha->program->name }}</a></td>
                        <td class="text-left font-medium text-gray-700"><a class="inline-block p-2 w-full whitespace-nowrap" href="{{ route('ins-tecnico.fichas.apprentices', $ficha) }}">{{ $ficha->start_school_stage->format('M-d-Y')}}</a></td>
                        <td class="text-left font-medium text-gray-700"><a class="inline-block p-2 w-full whitespace-nowrap" href="{{ route('ins-tecnico.fichas.apprentices', $ficha) }}">{{ $ficha->end_school_stage->format('M-d-Y')}}</a></td>
                        <td class="text-left font-medium text-gray-700"><a class="inline-block p-2 w-full whitespace-nowrap" href="{{ route('ins-tecnico.fichas.apprentices', $ficha) }}">{{ $ficha->start_production_stage->format('M-d-Y')}}</a></td>
                        <td class="text-left font-medium text-gray-700"><a class="inline-block p-2 w-full whitespace-nowrap" href="{{ route('ins-tecnico.fichas.apprentices', $ficha) }}">{{ $ficha->users_count}}</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
