<x-app-layout>        
    <div class="p-4 overflow-hidden sm:max-w-2xl sm:mx-auto">
        <div class="grid place-items-center">
            <img alt="avatar" class="rounded-full w-32 shadow-lg my-10" src="{{$user->profile_photo_url}}">
            <x-jet-validation-errors class="mb-4 text-center" />
        </div>
        
        @if((!is_null($tecnicoFichas) && count($tecnicoFichas) > 0) || (!is_null($seguimientoFichas) && count($seguimientoFichas) > 0))
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                <div class="bg-white p-4 shadow-lg rounded-lg">
                    <form method="POST" action="{{ route('user.update', $user->id) }}">
                        @method('PUT')
                        @csrf
                        <div>
                            <x-jet-label value="{{ __('Nombres') }}" />
                            <x-jet-input class="block mt-1 w-full" type="text" name="names" value="{{old('names', $user->profile->names)}}" required autofocus autocomplete="names" />
                        </div>

                        <div class="mt-4">
                            <x-jet-label value="{{ __('Apellidos') }}" />
                            <x-jet-input class="block mt-1 w-full" type="text" name="surnames" value="{{old('surnames', $user->profile->surnames)}}" autocomplete="surnames" />
                        </div>
                        
                        @can('change_role')
                            <div class="mt-4">
                                <x-jet-label value="{{ __('Rol') }}" />
                                @foreach ($roles as $rol)
                                    @if ($user->hasRole($rol->name))
                                        <x-jet-input type="checkbox" class="text-orange-500" checked name="rol[]" value="{{$rol->id}}" />
                                        {{$rol->name}}
                                        <br>
                                        @continue
                                    @endif
                                        <x-jet-input type="checkbox" class="text-orange-500" name="rol[]" value="{{$rol->id}}" />
                                        {{$rol->name}}
                                        <br>
                                @endforeach
                            </div>
                        @endcan
                            
                        <div class="mt-4">
                            <x-jet-label value="{{ __('Tipo de documento') }}" />
                            <select class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="document_type">
                                <option value="C.C" {{ old('document_type', $user->profile->document_type) == 'C.C' ? 'selected' : '' }}>C.C</option>
                                <option value="T.I" {{ old('document_type', $user->profile->document_type) == 'T.I' ? 'selected' : '' }}>T.I</option>
                                <option value="C.E" {{ old('document_type', $user->profile->document_type) == 'C.E' ? 'selected' : '' }}>C.E</option>
                                <option value="Pasaporte" {{ old('document_type', $user->profile->document_type) == 'Pasaporte' ? 'selected' : '' }}>Pasaporte</option>
                            </select>
                        </div>
                        <div class="mt-4">
                            <x-jet-label value="{{ __('Documento') }}" />
                            <x-jet-input class="block mt-1 w-full" type="text" name="document" value="{{old('document', $user->document)}}" autocomplete="document" />
                        </div>

                        <div class="mt-4">
                            <x-jet-label value="{{ __('Fecha De Nacimiento') }}" />
                            <x-jet-input class="block mt-1 w-full" type="date" name="birth_at" value="{{old('birth_at', $user->profile->birth_at)}}" />
                        </div>

                        <div class="mt-4">
                            <x-jet-label value="{{ __('Correo Electronico') }}" />
                            <x-jet-input class="block mt-1 w-full" type="email" name="email" value="{{old('email', $user->email)}}"  />
                        </div>

                        <div class="mt-4">
                            <x-jet-label value="{{ __('Celular') }}" />
                            <x-jet-input class="block mt-1 w-full" type="text" name="phone" value="{{old('phone', $user->profile->phone)}}"  />
                        </div>

                        <div class="mt-4">
                            <x-jet-label value="{{ __('Dirección') }}" />
                            <x-jet-input class="block mt-1 w-full" type="text" name="direction" value="{{old('direction', $user->profile->direction)}}" autocomplete="direction" />
                        </div>

                        <div class="mt-4">
                            <x-jet-label value="{{ __('Contraseña') }}" />
                            <x-jet-input class="block mt-1 w-full" type="password" name="password" />
                        </div>

                        <div class="mt-4">
                            <x-jet-label value="{{ __('Confirmar Contraseña') }}" />
                            <x-jet-input class="block mt-1 w-full" type="password" name="password_confirmation" />
                        </div>

                        <div class="flex justify-center mt-4">
                            <x-jet-button class="m-1">
                                {{ __('ACTUALIZAR') }}
                            </x-jet-button>
                            
                        </div>
                    </form>
                </div>
                <div class="flex flex-col p-3 gap-4 relative">
                    @if (!is_null($tecnicoFichas) && count($tecnicoFichas) > 0)
                        <div class="rounded shadow-lg">
                            <div class="rounded bg-gray-200 p-4">
                                <strong>Instructor Tecnico En Fichas</strong>
                                <ul>
                                    @foreach($tecnicoFichas as $tecnicoFicha)
                                        <li>
                                            <a class="my-3 p-2 hover:text-gray-500" href="{{ route('fichas.edit', $tecnicoFicha) }}">{{ $tecnicoFicha->code }}</a>
                                        </li>
                                    @endforeach
                                </ul> 
                            </div>
                        </div>
                    @endif
                    @if (!is_null($seguimientoFichas) && count($seguimientoFichas) > 0)
                        <div class="rounded shadow-lg">
                            <div class="rounded bg-gray-200 p-4">
                                <strong>Instructor De Seguimiento En Fichas</strong>
                                <ul>
                                    @foreach($seguimientoFichas as $seguimientoFicha)
                                        <li>
                                            <a class="my-3 p-2 hover:text-gray-500" href="{{ route('fichas.edit', $seguimientoFicha) }}">{{ $seguimientoFicha->code }}</a>
                                        </li>
                                    @endforeach
                                </ul> 
                            </div>
                        </div>
                    @endif
                </div>
                @can('users_destroy')
                    <x-jet-danger-button class="w-full mt-4" data-modal-toggle="popup-modal" data-id="{{ $user->id }}" >ELIMINAR</x-jet-danger-button>
                    <!-- Delete Product Modal -->
                    <div class="hidden overflow-y-auto overflow-x-hidden fixed right-0 left-0 top-4 z-50 justify-center items-center md:inset-0 h-modal sm:h-full" id="popup-modal">
                        <div class="relative px-4 w-full max-w-md h-full md:h-auto">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <!-- Modal header -->
                                <div class="flex justify-end p-2">
                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="popup-modal">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="p-6 pt-0 text-center">
                                    <svg class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-red-400">¿Esta seguro que quiere eliminar este usuario?</h3>
                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="m-3">
                                        @method('DELETE')
                                        @csrf
                                        <button data-modal-toggle="popup-modal" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                            Si, estoy seguro
                                        </button>
                                    </form>
                                    <button data-modal-toggle="popup-modal" type="button" class="text-red-500 bg-white hover:bg-red-100 focus:ring-4 focus:ring-red-300 rounded-lg border border-red-200 text-sm font-medium px-5 py-2.5 hover:text-red-900 focus:z-10 dark:bg-red-700 dark:text-red-300 dark:border-red-500 dark:hover:text-white dark:hover:bg-red-600">No, cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div> 
                @endcan
            </div>
                       
        @else
            <div class="bg-white p-4 shadow-lg rounded-lg">
                <form method="POST" action="{{ route('user.update', $user->id) }}">
                    @method('PUT')
                    @csrf

                    @if(!is_null($apprenticeFicha) && $apprenticeFicha->count())
                        <div>
                            <x-jet-label value="{{ __('Ficha') }}" />
                            <span class="block font-medium text-xl text-gray-700">
                                {{ $apprenticeFicha->code . " - " . $apprenticeFicha->program->name}}
                            </span>
                        </div>

                        <div class="my-4">
                            <x-jet-label value="{{ __('Estado') }}" />
                            <span class="block font-medium text-xl text-gray-700">
                                {{ $user->status}}
                            </span> 
                        </div>
                    @endif                    
                    
                    <div>
                        <x-jet-label value="{{ __('Nombres') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" name="names" value="{{old('names', $user->profile->names)}}" required autofocus autocomplete="names" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label value="{{ __('Apellidos') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" name="surnames" value="{{old('surnames', $user->profile->surnames)}}" autocomplete="surnames" />
                    </div>
                    
                    @can('change_role')
                        <div class="mt-4">
                            <x-jet-label value="{{ __('Rol') }}" />
                            @foreach ($roles as $rol)
                                @if ($user->hasRole($rol->name))
                                    <x-jet-input type="checkbox" class="text-orange-500" checked name="rol[]" value="{{$rol->id}}" />
                                    {{$rol->name}}
                                    <br>
                                    @continue
                                @endif
                                    <x-jet-input type="checkbox" class="text-orange-500" name="rol[]" value="{{$rol->id}}" />
                                    {{$rol->name}}
                                    <br>
                            @endforeach
                        </div>
                    @endcan
                        
                    <div class="mt-4">
                        <x-jet-label value="{{ __('Tipo de documento') }}" />
                        <select class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="document_type">
                            <option value="C.C" {{ old('document_type', $user->profile->document_type) == 'C.C' ? 'selected' : '' }}>C.C</option>
                            <option value="T.I" {{ old('document_type', $user->profile->document_type) == 'T.I' ? 'selected' : '' }}>T.I</option>
                            <option value="C.E" {{ old('document_type', $user->profile->document_type) == 'C.E' ? 'selected' : '' }}>C.E</option>
                            <option value="Pasaporte" {{ old('document_type', $user->profile->document_type) == 'Pasaporte' ? 'selected' : '' }}>Pasaporte</option>
                        </select>
                    </div>
                    <div class="mt-4">
                        <x-jet-label value="{{ __('Documento') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" name="document" value="{{old('document', $user->document)}}" autocomplete="document" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label value="{{ __('Fecha De Nacimiento') }}" />
                        <x-jet-input class="block mt-1 w-full" type="date" name="birth_at" value="{{old('birth_at', $user->profile->birth_at)}}" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label value="{{ __('Correo Electronico') }}" />
                        <x-jet-input class="block mt-1 w-full" type="email" name="email" value="{{old('email', $user->email)}}"  />
                    </div>

                    <div class="mt-4">
                        <x-jet-label value="{{ __('Celular') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" name="phone" value="{{old('phone', $user->profile->phone)}}"  />
                    </div>

                    <div class="mt-4">
                        <x-jet-label value="{{ __('Dirección') }}" />
                        <x-jet-input class="block mt-1 w-full" type="text" name="direction" value="{{old('direction', $user->profile->direction)}}" autocomplete="direction" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label value="{{ __('Contraseña') }}" />
                        <x-jet-input class="block mt-1 w-full" type="password" name="password" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label value="{{ __('Confirmar Contraseña') }}" />
                        <x-jet-input class="block mt-1 w-full" type="password" name="password_confirmation" />
                    </div>

                    <div class="flex justify-center mt-4">
                        <x-jet-button class="w-auto m-1">
                            {{ __('ACTUALIZAR') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>
            @can('users_destroy')
                <x-jet-danger-button class="w-full mt-4" data-modal-toggle="popup-modal" data-id="{{ $user->id }}" >ELIMINAR</x-jet-danger-button>
                <!-- Delete Product Modal -->
                <div class="hidden overflow-y-auto overflow-x-hidden fixed right-0 left-0 top-4 z-50 justify-center items-center md:inset-0 h-modal sm:h-full" id="popup-modal">
                    <div class="relative px-4 w-full max-w-md h-full md:h-auto">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div class="flex justify-end p-2">
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="popup-modal">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-6 pt-0 text-center">
                                <svg class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-red-400">¿Esta seguro que quiere eliminar este usuario?</h3>
                                <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="m-3">
                                    @method('DELETE')
                                    @csrf
                                    <button data-modal-toggle="popup-modal" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                        Si, estoy seguro
                                    </button>
                                </form>
                                <button data-modal-toggle="popup-modal" type="button" class="text-red-500 bg-white hover:bg-red-100 focus:ring-4 focus:ring-red-300 rounded-lg border border-red-200 text-sm font-medium px-5 py-2.5 hover:text-red-900 focus:z-10 dark:bg-red-700 dark:text-red-300 dark:border-red-500 dark:hover:text-white dark:hover:bg-red-600">No, cancelar</button>
                            </div>
                        </div>
                    </div>
                </div> 
            @endcan
        @endif
    </div>
</x-app-layout>