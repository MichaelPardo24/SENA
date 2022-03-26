<div>
    <x-jet-input type="text" wire:model.debounce.500ms="search" class="block w-10/12 mx-auto shadow-md" placeholder="Busca aquí"/>

    <table class="table-auto mx-auto my-5 shadow-lg">
        <thead>
            <tr class="bg-orange-100 text-gray-800 tracking-widest">
                <th class="px-4 py-2 font-sans font-normal border border-orange-300">Nombre</th>
                <th class="px-4 py-2 font-sans font-normal border border-orange-300">Fecha Subida</th>
                <th class="px-4 py-2 font-sans font-normal border border-orange-300">Fecha Actualizacion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($files as $file)
                <tr class=" odd:bg-orange-200 even:bg-orange-50 text-sm text-gray-600 border border-orange-300 hover:bg-orange-300 cursor-pointer">
                    <td class=""><a href="{{ route('files.edit', $file) }}" class="block px-4 py-2"> {{ $file->name}}</a> </td>
                    <td class=""><a href="{{ route('files.edit', $file) }}" class="block px-4 py-2"> {{ $file->created_at->format('M-d-Y')}}</a> </td>
                    <td class=""><a href="{{ route('files.edit', $file) }}" class="block px-4 py-2"> {{ $file->updated_at->format('M-d-Y')}}</a> </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6" class="p-2 text-center italic text-sm bg-orange-300 border border-orange-300 rounded-b">
                    @if (strlen($files->links()) > 20)
                        {{$files->links()}}
                    @else
                        Displaying all records
                    @endif
                </td>            
            </tr>
        </tfoot>

    </table>
</div>

