<div>
    <button 
        class="flex items-center p-2 rounded-md bg-orange-600 hover:bg-orange-500 hover:shadow-lg hover:shadow-black/40 transition-all duration-300 focus:ring-2 focus:ring-orange-700"
        wire:click="$set('open', true)"
        >
        <svg class="w-4 h-4 text-gray-100"  stroke="currentColor" stroke-linecap="round" viewBox="0 0 20 20">
            <path fill="none" d="M5.029,1.734h10.935c0.317,0,0.575-0.257,0.575-0.575s-0.258-0.576-0.575-0.576H5.029
                c-0.318,0-0.576,0.258-0.576,0.576S4.711,1.734,5.029,1.734z M1,5.188V19h18.417V5.188H1z M18.266,17.849H2.151V6.338h16.115
                V17.849z M2.727,4.036H17.69c0.317,0,0.575-0.257,0.575-0.576c0-0.318-0.258-0.575-0.575-0.575H2.727
                c-0.318,0-0.576,0.257-0.576,0.575C2.151,3.779,2.409,4.036,2.727,4.036z"></path>
        </svg>
        <span class="ml-2 text-gray-100">Ver archivos</span>
    </button>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Archivos de: {{$userName}}
        </x-slot>

        <x-slot name="content">
            <div class="flex flex-col gap-2 p-2">
                @foreach ($userFiles as $file)
                    <div class="bg-zinc-50 shadow-sm hover:shadow-md border border-zinc-300 rounded overflow-hidden flex">
                        <div class="flex-1 p-3 border-zinc-300 text-sm text-zinc-700">{{ $file->name }}</div>
                        <div class="p-3 border-zinc-300 text-sm text-zinc-700 text-right">{{ $file->updated_at->format('d-M-Y')}}</div>
                        <div class="">
                            <a class="block p-3 border-zinc-300 text-sm text-zinc-700 hover:bg-black/5 text-right" href="{{route('apprentices-files.show', $file)}}">Descargar</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </x-slot>
        
        <x-slot name="footer">
            <x-jet-danger-button wire:click="$set('open', false)" class="ml-2">
                Cerrar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
