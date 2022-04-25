<div>
    <span class="text-slate-700 text-sm italic tracking-wide font-bold">Status: </span>
    <select wire:model="selectedStatus" class="border-transparent py-1 text-slate-700 text-sm italic tracking-wide" autocomplete="off">
        @foreach ($status as $stat)
            @if ($stat != $userStatus)
                <option value="{{$stat}}">{{$stat}}</option>
                @continue
            @else
            <option selected value="{{$stat}}">{{$stat}}</option>
            @endif
        @endforeach
    </select>

    <div 
        x-data="{ show: false }"
        x-cloak
        x-show="show"
        x-transition.scale.origin.right
        x-init="$wire.on('status-changed', () => { show = true; setTimeout(() => { show = false }, 2500) })"
        class="absolute top-14 right-0 rounded bg-green-200 border-l-4 border-green-600 text-slate-700 p-4"
        style="display: none !important;">
            Estado actualizado
    </div>
    <div 
    x-data="{ show: false }"
    x-cloak
    x-show="show"
    x-transition.scale.origin.right
    x-init="$wire.on('status-failed', () => { show = true; setTimeout(() => { show = false }, 2500) })"
    class="absolute top-14 right-0 rounded bg-red-200 border-l-4 border-red-600 text-slate-700 p-4"
    style="display: none !important;">
        Error al modificar estado :(
</div>
</div>
