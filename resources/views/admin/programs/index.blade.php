<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Programas') }}
        </h2>
    </x-slot>
    @if (\Session::has('success'))
        <div class="bg-green-400 border-l-8 mb-4 border-green-600 text-slate-600">
            <p class="p-2 py-4">{{ \Session::get('success') }}</p>
        </div>
    @endif
    <div class="py-10">
        <div class="flex flex-col justify-center">
            <div class="mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
                
                
                {{-- table --}}
                <livewire:programs />

            </div>
        </div>
    </div>
</x-app-layout>