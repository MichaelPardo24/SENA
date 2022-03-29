<div>
    <x-jet-secondary-button wire:click="$set('open', true)" class="inline-block">
        Añadir Usuario
    </x-jet-secondary-button>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Añadir Usuario
        </x-slot>

        <x-slot name="content">
            <div>
                <select class="w-full seleccion" wire:model="role">
                    <option value="">-- Role --</option>
                    <option value="Aprendiz">Aprendiz</option>
                    <option value="Instructor Tecnico">Instructor Tecnico</option>
                    <option value="Instructor Seguimiento">Instructor Seguimiento</option>
                </select>
            </div>

            @if (!is_null($users))
                <div class="mt-3">
                    <select class="w-full" wire:model="selectedUser">
                        <option value="">-- Usuarios --</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->document . ' ' .$user->surnames . ' ' . $user->names }}</option>
                        @endforeach
                    </select>
                </div>
            @endif

        </x-slot>
        
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="add">
                Añadir
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="close" class="ml-2">
                Cerrar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
