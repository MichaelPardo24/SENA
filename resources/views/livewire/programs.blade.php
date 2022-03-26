<div>
    <x-jet-input type="text" wire:model.debounce.300ms="search" class="block w-10/12 mx-auto shadow-md" placeholder="Busca aquí"/>

    <table class="table-auto mx-auto my-5 shadow-lg">
        <thead>
            <tr class="bg-orange-100 text-gray-800 tracking-widest">
                <th class="px-4 py-2 font-sans font-normal border border-orange-300">Programa</th>
                <th class="px-4 py-2 font-sans font-normal border border-orange-300">Tipo</th>
                <th class="px-4 py-2 font-sans font-normal border border-orange-300">N. fichas</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($programs as $program)
                <tr class=" odd:bg-orange-200 even:bg-orange-50 text-sm text-gray-600 border border-orange-300 hover:bg-orange-300 cursor-pointer">
                    <td><a href="{{ route('programs.edit', $program) }}" class="block px-4 py-2"> {{ $program->name}}</a> </td>
                    <td><a href="{{ route('programs.edit', $program) }}" class="block px-4 py-2"> {{ $program->type}}</a> </td>
                    <td><a href="{{ route('programs.edit', $program) }}" class="block px-4 py-2"> {{ $program->fichas_count}}</a> </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="p-2 text-center italic text-sm bg-orange-300 border border-orange-300 rounded-b">
                    @if (strlen($programs->links()) > 20)
                        {{$programs->links()}}
                    @else
                        Displaying all records
                    @endif
                </td>            
            </tr>
        </tfoot>

    </table>
</div>
