<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Arhivos') }}
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

    <div class="py-10">
        <div class="flex flex-col justify-center">
            <div class="mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
                <header class="flex py-4 border-b border-gray-100">
                    <a href="{{route('file-types.create')}}" class="bg-orange-500 font-bold py-2 px-4 mx-4 border rounded hover:bg-orange-400 text-white">CREAR</a>
                </header>
                <table class="table-auto w-full">
                    <thead class="rounded-t-lg text-xs font-semibold uppercase text-white bg-orange-500">
                        <tr>
                            <th class="p-3 whitespace-nowrap font-semibold">Tipo de archivo</th>
                            <th class="p-3 whitespace-nowrap font-semibold">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-gray-100">
                        @foreach ($fileTypes as $fileType)
                            <tr>
                                <td class="p-2 whitespace-nowrap text-center font-bold text-gray-800">{{ $fileType->name}}</a> </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="flex items-center text-center">
                                        <a class="px-1 flex-auto" href="{{ route('file-types.edit', $fileType) }}"><i class="fa-solid fa-user-pen fa-xl" style="color:gray"></i></a>
                                    </div>
                                </td>
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