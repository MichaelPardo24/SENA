<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Fichas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex justify-center mb-4">
                <x-jet-authentication-card-logo class="mx-auto" />
            </div>

            <div class="p-4 overflow-hidden sm:max-w-2xl sm:mx-auto">

                @if (\Session::has('success'))
                    <div class="bg-green-400 border-l-8 -m-4 mb-4 border-green-600 text-slate-600">
                        <p class="p-2 py-4">{{ \Session::get('success') }}</p>
                    </div>
                @endif
                <a href="{{ route('fichas.index') }}"
                    class="font-semibold uppercase tracking-widest rounded bg-slate-700 text-xs text-slate-200 px-4 py-2 mb-3 transition-all duration-300 hover:bg-slate-900">Index</a>

                {{-- Formulario de actializacion --}}
                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-2">
                    <div class="bg-white p-4 shadow-lg rounded-lg">
                        <x-jet-validation-errors class="mb-4" />

                        <form action="{{ route('fichas.update', $ficha) }}" method="post">
                            @method('PUT')
                            @csrf
                            @hasrole('Coordinador|Manager')
                                <div>
                                    <x-jet-label value="Codigo de la ficha:" />
                                    <x-jet-input class="block mt-1 w-full" type="number" name="code" :value="old('code') ?? $ficha->code"
                                        required autofocus />
                                </div>

                                <div class="my-4">
                                    <x-jet-label value="Programa:" />
                                    <select name="program_id" class="block mt-1 w-full">
                                        @foreach ($programs as $id => $name)
                                            @if ($ficha->program_id == $id)
                                                <option value="{{ $id }}" selected>{{ $name }}</option>
                                                @continue
                                            @endif
                                            <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="my-4">
                                    <x-jet-label value="Inicio etapa lectiva:" />
                                    <x-jet-input class="block mt-1 w-full" type="date" name="start_school_stage"
                                        :value="old('start_school_stage') ??
                                            $ficha->start_school_stage->format('Y-m-d')" required />
                                </div>

                                <div class="my-4">
                                    <x-jet-label value="Fin etapa lectiva:" />
                                    <x-jet-input class="block mt-1 w-full" type="date" name="end_school_stage"
                                        :value="old('end_school_stage') ?? $ficha->end_school_stage->format('Y-m-d')" required />
                                </div>

                                <div class="my-4">
                                    <x-jet-label value="Inicio etapa productiva:" />
                                    <x-jet-input class="block mt-1 w-full" type="date" name="start_production_stage"
                                        :value="old('start_production_stage') ??
                                            $ficha->start_production_stage->format('Y-m-d')" required />
                                </div>

                                <div class="my-4">
                                    <x-jet-label value="Fin etapa productiva:" />
                                    <x-jet-input class="block mt-1 w-full" type="date" name="end_production_stage"
                                        :value="old('end_production_stage') ??
                                            $ficha->end_production_stage->format('Y-m-d')" required />
                                </div>

                                <div class="my-4">
                                    <x-jet-label value="Municipio:" />
                                    <x-jet-input class="block mt-1 w-full" type="text" name="town" :value="old('town') ?? $ficha->town"
                                        required />
                                </div>

                                <div class="my-4">
                                    <x-jet-label value="Tipo:" />
                                    <select name="type" class="block mt-1 w-full">
                                        @foreach ($types as $type)
                                            @if ($ficha->type == $type)
                                                <option value="{{ $type }}" selected>{{ $type }}</option>
                                                @continue
                                            @endif
                                            <option value="{{ $type }}">{{ $type }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="flex flex-row p-2 mt-4 justify-around">
                                    <x-jet-button class="">
                                        Editar Ficha
                                    </x-jet-button>
                                </div>
                            @else
                                <div>
                                    <x-jet-label value="Codigo de la ficha:" />
                                    <x-jet-input readonly class="block mt-1 w-full" type="number" name="code"
                                        :value="old('code') ?? $ficha->code" required autofocus />
                                </div>

                                <div class="my-4">
                                    <x-jet-label value="Programa:" />
                                    @foreach ($programs as $id => $name)
                                        @if ($ficha->program_id == $id)
                                            <x-jet-input type="text" readonly class="block mt-1 w-full" :value="$name"
                                                required></x-jet-input>
                                        @endif
                                    @endforeach
                                </div>

                                <div class="my-4">
                                    <x-jet-label value="Inicio etapa lectiva:" />
                                    <x-jet-input readonly class="block mt-1 w-full" type="date" name="start_school_stage"
                                        :value="old('start_school_stage') ??
                                            $ficha->start_school_stage->format('Y-m-d')" required />
                                </div>

                                <div class="my-4">
                                    <x-jet-label value="Fin etapa lectiva:" />
                                    <x-jet-input readonly class="block mt-1 w-full" type="date" name="end_school_stage"
                                        :value="old('end_school_stage') ?? $ficha->end_school_stage->format('Y-m-d')" required />
                                </div>

                                <div class="my-4">
                                    <x-jet-label value="Inicio etapa productiva:" />
                                    <x-jet-input readonly class="block mt-1 w-full" type="date"
                                        name="start_production_stage" :value="old('start_production_stage') ??
                                            $ficha->start_production_stage->format('Y-m-d')" required />
                                </div>

                                <div class="my-4">
                                    <x-jet-label value="Fin etapa productiva:" />
                                    <x-jet-input readonly class="block mt-1 w-full" type="date" name="end_production_stage"
                                        :value="old('end_production_stage') ??
                                            $ficha->end_production_stage->format('Y-m-d')" required />
                                </div>

                                <div class="my-4">
                                    <x-jet-label value="Municipio:" />
                                    <x-jet-input readonly class="block mt-1 w-full" type="text" name="town"
                                        :value="old('town') ?? $ficha->town" required />
                                </div>

                                <div class="my-4">
                                    <x-jet-label value="Tipo:" />
                                    @foreach ($types as $type)
                                        @if ($ficha->type == $type)
                                            <x-jet-input type="text" readonly class="block mt-1 w-full" :value="$type"
                                                required></x-jet-input>
                                        @endif
                                    @endforeach
                                </div>
                            @endhasrole

                        </form>
                    </div>

                    {{-- Informacion de la ficha --}}
                    <div class="flex flex-col p-3 gap-4 relative">
                        <div class="rounded shadow-lg">
                            <div class="rounded bg-gray-200 p-4">
                                <span
                                    class="inline-block w-full my-2 mx-1 select-none text-center rounded bg-slate-700 text-xs text-slate-200 px-4 py-2">
                                    Usuarios vinculados: {{ $ficha->users_count }}
                                </span>

                                @role("Manager|Coordinador")
                                    <a href="{{ route('fichas.users.index', $ficha) }}"
                                        class="block w-full font-semibold uppercase tracking-widest rounded bg-green-700 text-xs text-green-200 px-4 py-2 mt-4 text-center transition-all duration-300 hover:bg-green-900">
                                            Ver Usuarios Vinculados
                                    </a> 
                                @endrole
                            </div>

                        </div>

                        {{-- Formulario de eliminacion --}}
                        @role("Manager|Coordinador")
                            <div class="p-3 shadow-lg bg-purple-200 rounded">
                                <p class="italic text-purple-600 text-sm text-center">Dar de baja a una ficha</p>
                                <div class="p-3">
                                    <button data-modal-toggle="popup-modal-archivar" data-id="{{ $ficha->id }}"
                                        class="block w-full items-center px-4 py-2 bg-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-500 active:bg-purple-900 focus:outline-none focus:border-purple-900 focus:ring focus:ring-purple-300 disabled:opacity-25 transition">
                                        Archivar
                                    </button>

                                    <!-- Soft Delete Modal -->
                                    <div class="hidden overflow-y-auto overflow-x-hidden fixed right-0 left-0 top-4 z-50 justify-center items-center md:inset-0 h-modal sm:h-full"
                                        id="popup-modal-archivar">
                                        <div class="relative px-4 w-full max-w-md h-full md:h-auto">
                                            <!-- Modal content -->
                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                <!-- Modal header -->
                                                <div class="flex justify-end p-2">
                                                    <button type="button"
                                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                                                        data-modal-toggle="popup-modal-archivar">
                                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd"
                                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                clip-rule="evenodd"></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="p-6 pt-0 text-center">
                                                    <svg class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200"
                                                        fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-red-400">
                                                        ¿Esta seguro que quiere dar de baja esta ficha?</h3>
                                                    <form action="{{ route('fichas.soft-delete', $ficha) }}"
                                                        method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit"
                                                            class="items-center px-4 py-2 my-2.5 bg-purple-600 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-purple-500 active:bg-purple-900 focus:outline-none focus:border-purple-900 focus:ring focus:ring-purple-300 disabled:opacity-25 transition">
                                                            Si, estoy seguro
                                                        </button>
                                                    </form>
                                                    <button data-modal-toggle="popup-modal-archivar" type="button"
                                                        class="text-red-500 bg-white hover:bg-red-100 focus:ring-4 focus:ring-red-300 rounded-lg border border-red-200 text-sm font-medium px-5 py-2.5 hover:text-red-900 focus:z-10 dark:bg-red-700 dark:text-red-300 dark:border-red-500 dark:hover:text-white dark:hover:bg-red-600">No,
                                                        cancelar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endrole
                        

                        @hasrole('Coordinador|Manager')
                            <div class="p-3 shadow-lg bg-red-300 rounded">
                                {{-- Formulario de eliminacion --}}
                                <p class="italic text-red-600 text-sm text-center">Cuidado, la ficha se eliminará
                                    completamente</p>

                                {{-- Modal --}}
                                <div class="p-3">
                                    <x-jet-danger-button class="px-1 flex-auto w-full" data-modal-toggle="popup-modal"
                                        data-id="{{ $ficha->id }}">ELIMINAR</x-jet-danger-button>
                                    <!-- Delete Product Modal -->
                                    <div class="hidden overflow-y-auto overflow-x-hidden fixed right-0 left-0 top-4 z-50 justify-center items-center md:inset-0 h-modal sm:h-full"
                                        id="popup-modal">
                                        <div class="relative px-4 w-full max-w-md h-full md:h-auto">
                                            <!-- Modal content -->
                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                <!-- Modal header -->
                                                <div class="flex justify-end p-2">
                                                    <button type="button"
                                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                                                        data-modal-toggle="popup-modal">
                                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd"
                                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                clip-rule="evenodd"></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="p-6 pt-0 text-center">
                                                    <svg class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200"
                                                        fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-red-400">
                                                        ¿Esta seguro que quiere eliminar esta ficha?</h3>
                                                    <form action="{{ route('fichas.destroy', $ficha) }}" method="POST"
                                                        class="m-3">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button data-modal-toggle="popup-modal" type="submit"
                                                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                            Si, estoy seguro
                                                        </button>
                                                    </form>
                                                    <button data-modal-toggle="popup-modal" type="button"
                                                        class="text-red-500 bg-white hover:bg-red-100 focus:ring-4 focus:ring-red-300 rounded-lg border border-red-200 text-sm font-medium px-5 py-2.5 hover:text-red-900 focus:z-10 dark:bg-red-700 dark:text-red-300 dark:border-red-500 dark:hover:text-white dark:hover:bg-red-600">No,
                                                        cancelar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endhasrole
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
