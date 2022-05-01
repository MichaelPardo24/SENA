<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Usuarios') }}
        </h2>
    </x-slot>
    <div class="py-10">
        <div class="max-w-7xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
            {{-- table --}}
            <livewire:users :message="session('success')" />
        </div>
    </div>
</x-app-layout>