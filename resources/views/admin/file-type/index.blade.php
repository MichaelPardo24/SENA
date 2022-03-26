<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('fileTypes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                @if (\Session::has('success'))
                    <div class="bg-green-400 border-l-8 mb-4 border-green-600 text-slate-600">
                        <p class="p-2 py-4">{{ \Session::get('success') }}</p>
                    </div>
                @endif

                <a href="{{route('file-types.create')}}" class="inline-block mx-4 my-3 text-center rounded bg-slate-700 text-xs text-slate-200 px-4 py-2 transition-all duration-300 hover:bg-slate-900">CREAR</a>

                <table class="table-auto mx-auto my-5 shadow-lg">
                    <thead>
                        <tr class="bg-orange-100 text-gray-800 tracking-widest">
                            <th class="px-4 py-2 font-sans font-normal border border-orange-300">Tipo de archivo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fileTypes as $fileType)
                            <tr class=" odd:bg-orange-200 even:bg-orange-50 text-sm text-gray-600 border border-orange-300 hover:bg-orange-300 cursor-pointer">
                                <td><a href="{{ route('file-types.edit', $fileType) }}" class="block px-4 py-2"> {{ $fileType->name}}</a> </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="p-2 text-center italic text-sm bg-orange-300 border border-orange-300 rounded-b">
                                @if (strlen($fileTypes->links()) > 20)
                                    {{$fileTypes->links()}}
                                @else
                                    Displaying all records
                                @endif
                            </td>            
                        </tr>
                    </tfoot>
            
                </table>
            </div>
        </div>
    </div>
</x-app-layout>