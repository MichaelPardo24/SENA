<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Fichas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex justify-center mb-4">
                <x-jet-authentication-card-logo class="mx-auto" />
            </div>

            <div class="p-4 overflow-hidden sm:max-w-md sm:mx-auto  sm:rounded-lg">
                @if (\Session::has('success'))
                    <div class="bg-green-400 border-l-8 -m-4 mb-4 border-green-600 text-slate-600">
                        <p class="p-2 py-4">{{ \Session::get('success') }}</p>
                    </div>
                @endif

                <div class="p-3 bg-white rounded shadow-lg">
                    <x-jet-validation-errors class="mb-4" />

                    <form action="{{ route('apprentices-files.update', $file) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
    
                        <div>
                            <x-jet-label value="Tipo:" />
                            <select name="type_id" class="block mt-1 w-full">
                                @foreach ($types as $id => $name)
                                    @if ($file->type_id == $id)
                                        <option value="{{$id}}" selected>{{$name}}</option>
                                        @continue
                                    @endif
                                    <option value="{{$id}}">{{$name}}</option>
                                @endforeach
                            </select>
                        </div>
    
                        <div class="flex flex-row p-2 mt-4 justify-around">
                            <x-jet-button class="">
                                Editar Archivo
                            </x-jet-button>
    
                            <a href="{{route('fichas.apprentices-files.index', $ficha)}}" class="font-semibold uppercase tracking-widest rounded bg-slate-700 text-xs text-slate-200 px-4 py-2 transition-all duration-300 hover:bg-slate-900">Index</a>
                        </div>
                    </form>
                </div>
                <div class="mt-2 bg-red-200 p-3 rounded shadow-lg">
                    <form action="{{ route('apprentices-files.destroy', $file) }}" class="w-full" method="POST">
                        @method('DELETE')
                        @csrf

                        <button type="submit" class="block w-full items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring focus:ring-red-300 disabled:opacity-25 transition">
                            Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
