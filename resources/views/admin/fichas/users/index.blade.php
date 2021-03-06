<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Fichas') }}
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

                <h2 class="pt-4 pl-4 text-xl tracking-widest text-slate-800"><span class="text-slate-900 font-bold">Ficha:</span> {{$ficha->code . ' -- ' . $ficha->program->name}}</h2>

                <div class="flex justify-between p-4">         
                    <a href="{{route('fichas.index')}}" class="inline-block text-center rounded bg-slate-700 text-xs text-slate-200 px-4 py-2 transition-all duration-300 hover:bg-slate-900"><- FICHAS</a>

                    @hasrole("Coordinardor|Manager")
                        <livewire:fichas.add-user :ficha="$ficha->id"/>
                    @endhasrole
                </div>

                {{-- table --}}
               {{ $slot }}

            </div>
        </div>
    </div>
</x-app-layout>