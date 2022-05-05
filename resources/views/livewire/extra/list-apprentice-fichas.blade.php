<div>
    @if ($fichas->count() > 0)
        <div class="p-4">
            <div x-data="{ open: false}">
                <button class="rounded bg-orange-600 p-2 shadow-md text-white w-min hover:bg-orange-500 transition-colors duration-300" @click="open = !open">
                    <span class="whitespace-nowrap">Ir a archivos
                        <svg
                            aria-hidden="true"
                            focusable="false"
                            data-prefix="fas"
                            data-icon="caret-down"
                            class="w-2 ml-2 inline"
                            role="img"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 320 512"
                            >
                            <path
                                fill="currentColor"
                                d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z"
                            ></path>
                        </svg>
                    </span>
                </button>
                
                <div x-show="open" @click.away="open = false" x-cloak style=" display: none !important" class="absolute shadow-md bg-gray-100 w-min border border-gray-400 mt-0.5 rounded-sm">
                    <ul class="cursor-pointer">
                        @foreach ($fichas as $ficha)
                            @if ($ficha->pivot->status == "Aceptado")
                                <li class="whitespace-nowrap hover:bg-gray-200">
                                    <a 
                                        href="{{ route('fichas.apprentices-files.index', $ficha->code ) }}" 
                                        class="block p-2"
                                    >{{ $ficha->program->name . ' | ' . $ficha->code}} </a>
                                </li>
                            @endif
                        @endforeach 
                    </ul>
                </div>

            </div>
        </div>
    @endif
</div>
