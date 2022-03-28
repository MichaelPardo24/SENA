<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Subir archivos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center mb-4">
                <x-jet-authentication-card-logo class="mx-auto" />
            </div>

            <div class="bg-white p-4 overflow-hidden sm:max-w-md sm:mx-auto  shadow-xl sm:rounded-lg">
                
                @if (\Session::has('success'))
                    <div class="bg-green-400 border-l-8 -m-4 mb-4 border-green-600 text-slate-600">
                        <p class="p-2 py-4">{{ \Session::get('success') }}</p>
                    </div>
                @endif

                <x-jet-validation-errors class="mb-4" />

                <form action="{{ route('apprentices-files.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <x-jet-label value="Tipo:" />
                        <select name="type_id" class="block mt-1 w-full">
                            @foreach ($types as $id => $name)
                                <option value="{{$id}}">{{$name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="my-5">
                        <x-jet-label value="Archivo:" />
                        <input type="file" name="file" accept="application/pdf, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" class="block w-full text-sm text-slate-500 file:cursor-pointer file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-200 file:text-green-700 hover:file:bg-green-300" required>
                        
                    </div>

                    <div class="flex flex-row p-2 mt-4 justify-around">
                        <x-jet-button class="">
                            Subir archivo
                        </x-jet-button>
                        
                        <a href="{{route('apprentices-files.index')}}" class="font-semibold uppercase tracking-widest rounded bg-slate-700 text-xs text-slate-200 px-4 py-2 transition-all duration-300 hover:bg-slate-900">Index</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
