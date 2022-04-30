<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Aprendices
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-4xl bg-white shadow-lg rounded-sm border border-gray-200">

            {{-- table --}}
            @livewire('follow-ups.index')
        </div>
    </div>
</x-app-layout>