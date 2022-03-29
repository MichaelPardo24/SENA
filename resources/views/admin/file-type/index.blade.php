<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tipo de archivos') }}
        </h2>
    </x-slot>
    @if (session('success'))
        <div class="bg-green-100 border-t-4 border-green-500 rounded-b text-green-900 px-4 py-3 shadow-md" role="alert">
            <div class="flex">
                <div class="py-1"><svg class="fill-current h-6 w-6 text-green-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                <div>
                    <p class="font-bold">Nuevo Aviso...</p>
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif
    
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
                            <th class="px-4 py-2 font-sans font-normal border border-orange-300">Descargar</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-gray-100">
                        @foreach ($fileTypes as $fileType)
                            <tr class=" odd:bg-orange-200 even:bg-orange-50 text-sm text-gray-600 border border-orange-300 hover:bg-orange-300 cursor-pointer">
                                <td><a href="{{ route('file-types.edit', $fileType) }}" class="block px-4 py-2"> {{ $fileType->name}}</a> </td>
                                <td><a href="{{ route('file-types.show', $fileType) }}" class="block px-4 py-2"> Descargar </a> </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="px-4 mt-5 py—3 border—t  sm:px-6 text-center italic text-sm">
                    {{ $fileTypes->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>