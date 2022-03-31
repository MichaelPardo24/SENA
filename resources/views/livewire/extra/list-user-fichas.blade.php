<div>
    @if ($fichas->count() > 0)
        <div class="p-4">
            <select wire:model="selectedFicha" aria-placeholder="Selecciona tu ficha">
                @foreach ($fichas as $ficha)
                    <option value="{{ $ficha->code }}"> {{ $ficha->program->name . ' || ' . $ficha->code}} </option>
                @endforeach
            </select>
            <a 
                href="{{ route('fichas.apprentices-files.index', $selectedFicha ?? $fichas->first()->code ) }}" 
                class="font-semibold uppercase tracking-widest rounded bg-slate-700 text-xs text-slate-200 px-4 py-2 mb-3 transition-all duration-300 hover:bg-slate-900"
                >Ir a archivos</a>
        </div>
    @endif
</div>
