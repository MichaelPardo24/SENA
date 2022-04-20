<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Ficha: ' . $ficha->code . ' | ' . $ficha->program->name}}
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

                <div class="flex justify-between p-4">         
                    <a 
                        href="{{route('fichas.index')}}" 
                        class="inline-block text-center rounded bg-slate-700 text-xs text-slate-200 px-4 py-2 transition-all duration-300 hover:bg-slate-900">FICHAS</a>
                </div>

                {{-- User Data --}}
                <div>
                    <div class="flex items-center p-4 gap-2">
                        <div>
                            <img class="rounded-full object-cover" src="{{ $user->profile_photo_url }}" alt="{{ $user->profile->names }}" />
                        </div>
                        <div class="flex-1">
                            <p class="text-slate-800 text-lg italic tracking-wider">
                                {{$user->profile->names . ' ' .$user->profile->surnames}}
                            </p>
                            <p class="text-slate-700 text-xs italic tracking-wider">
                                <b>Documento:</b> {{ $user->document}} | 
                                <b>Correo:</b> {{ $user->email}} | 
                                <b>Telefono:</b> {{ $user->profile->phone ?? 'no register'}}  
                            </p>
                        </div>

                        {{-- change status --}}
                        <div>
                            <livewire:extra.change-user-status /> 
                        </div>
                    </div>


                    {{-- user info  --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 bg-gray-200 bg-opacity-30">
                        <div class="p-5 border border-gray-200">
                            <h3 class="text-slate-800 text-lg mb-2 tracking-wide">Fichas asociadas:</h3>
                            <ul class="list-disc list-inside">
                                @foreach ($user->fichas()->withTrashed()->get() as $userFicha)
                                    @if ($userFicha->code == $ficha->code)
                                        <li class="text-slate-700 text-base font-bold underline underline-offset-4">{{$userFicha->code}} | {{$userFicha->program->name}}</li>
                                        @continue
                                    @endif
                                    <li class="text-slate-700 text-sm">{{$userFicha->code}} | {{$userFicha->program->name}}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="flex flex-col justify-center items-center p-5 border border-gray-200">
                            <h3 class="text-slate-800 block w-full text-lg mb-2 tracking-wide">Archivos asociados:</h3>
                                <livewire:extra.show-files :user="$user->id" :ficha="$ficha->id">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>