<div class="mb-8 sm:mb-6 lg:mb-4">
    <div class="p-3">
        <h3 class="text-gray-700 text-lg tracking-wide font-bold mb-4">Información del seguimiento: </h3>
        <form wire:submit.prevent="updateFollowUpInformation" autocomplete="off" class="relative mb-7">

            {{-- Se puede ocultar esta info, se hace de esta forma para que sea mas 
                facil centrarse en las visitas --}}
            <div x-data="{ showDetails: false}" class="p-3 bg-white text-gray-700 rounded shadow-md">
                <button type="button" class="p-2 underline text-sm font-semibold" @click="showDetails = !showDetails"> Ocultar/mostrar </button>
                <p class="text-gray-500 italic text-sm mb-4">Este seguimiento de empezo el: 
                    {{ \Carbon\Carbon::createFromFormat('Y-m-d\TH:i:s.uP', $state['start_date'])->format('d-F-Y')}}
                </p>
                <div 
                    x-show="showDetails"
                    x-cloak
                    x-transition:enter="transition ease-out duration-500"
                    x-transition:enter-start="opacity-0 -translate-y-6"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0 -translate-y-8"
                    style="display: none !important">

                    <h4 class="text-gray-700 tracking-wide font-bold mb-2">Información de la empresa: </h4>
                    <div class="sm:grid sm:grid-cols-2 lg:grid-cols-3 gap-3">
                        <div class="mt-3 sm:mt-0">
                            <x-jet-label for="company_cod" value="Codigo Empresa *" />
                            <x-jet-input id="company_cod" type="text" class="mt-1 block w-full" wire:model.defer="state.company_cod" />
                            <x-jet-input-error for="followUp.company_cod" class="mt-2" />
                        </div>

                        <div class="mt-3 sm:mt-0">
                            <x-jet-label for="company_name" value="Nombre Empresa *" />
                            <x-jet-input id="company_name" type="text" class="mt-1 block w-full" wire:model.defer="state.company_name" />
                            <x-jet-input-error for="followUp.company_name" class="mt-2" />
                        </div>
                        
                        <div class="mt-3 sm:mt-0">
                            <x-jet-label for="company_address" value="Dirección Empresa *" />
                            <x-jet-input id="company_address" type="text" class="mt-1 block w-full" wire:model.defer="state.company_address" />
                            <x-jet-input-error for="followUp.company_address" class="mt-2" />
                        </div>
                    </div>
    
                    <h4 class="text-gray-700 tracking-wide font-bold mt-4 mb-2">Información del jefe: </h4>
                    <div class="sm:grid sm:grid-cols-2 lg:grid-cols-3 gap-3">
                        <div class="mt-3 sm:mt-0">
                            <x-jet-label for="boss_name" value="Nombre jefe *" />
                            <x-jet-input id="boss_name" type="text" class="mt-1 block w-full" wire:model.defer="state.boss_name" />
                            <x-jet-input-error for="state.boss_name" class="mt-2" />
                        </div>

                        <div class="mt-3 sm:mt-0">
                            <x-jet-label for="boss_phone" value="Telefono Jefe" />
                            <x-jet-input id="boss_phone" type="text" class="mt-1 block w-full" wire:model.defer="state.boss_phone" />
                            <x-jet-input-error for="followUp.boss_phone" class="mt-2" />
                        </div>
                        
                        <div class="mt-3 sm:mt-0">
                            <x-jet-label for="boss_email" value="Correo Jefe *" />
                            <x-jet-input id="boss_email" type="email" class="mt-1 block w-full" wire:model.defer="state.boss_email" />
                            <x-jet-input-error for="followUp.boss_email" class="mt-2" />
                        </div>
                    </div>
                    
                    <h4 class="text-gray-700 tracking-wide font-bold mt-4 mb-2">Información sitio: </h4>
                    <div class="sm:grid sm:grid-cols-2 lg:grid-cols-3 gap-3">
                        <div class="mt-3 sm:mt-0">
                            <x-jet-label for="dependency" value="Dependencia" />
                            <x-jet-input id="dependency" type="text" placeholder="ej. sistemas" class="mt-1 block w-full" wire:model.defer="state.dependency" />
                            <x-jet-input-error for="state.dependency" class="mt-2" />
                        </div>

                        <div class="mt-3 sm:mt-0">
                            <x-jet-label for="status" value="Estado" />
                            <select id="status" wire:model.defer="state.status" class="w-full">
                                <option value="Incompleto">Incompleto</option>
                                <option value="Completo">Completo</option>
                            </select>
                            <x-jet-input-error for="state.status" class="mt-2" />
                        </div>
                        
                        <div class="mt-3 sm:mt-0">
                            <x-jet-label for="town" value="Ciudad" />
                            <x-jet-input id="town" type="email" placeholder="ej. Ibague" class="mt-1 block w-full" wire:model.defer="state.town" />
                            <x-jet-input-error for="followUp.town" class="mt-2" />
                        </div>
                    </div>
                </div>
            </div>

            {{-- Visitas xd --}}
            <h3 class="text-gray-700 text-lg tracking-wide font-bold mt-6">Visitas: </h3>
            <h4 class="text-gray-700 tracking-wide font-bold mb-2">Primera visita: </h4>
            <div class="p-3 bg-white">
                <div class="sm:grid sm:grid-cols-2 lg:grid-cols-3 gap-3">
                    <div class="mt-3 sm:mt-0">
                        <x-jet-label for="firstVisit" value="Fecha" />
                        <input id="firstVisit" type="date" class="mt-1 block w-full" wire:model="firstVisit" />
                        <x-jet-input-error for="firstVisit" class="mt-2" />
                    </div>

                    <div class="mt-3 sm:mt-0 col-span-2">
                        <x-jet-label for="first_observation" value="Obeservaciones" />
                        <textarea  id="first_observation" rows="4" class="w-full block mt-1 resize-y rounded" wire:model.lazy="state.first_observation"></textarea>
                        <x-jet-input-error for="state.first_observation" class="mt-2" />
                    </div>
                </div>
            </div>

            @if ($firstVisit && $state['first_observation'])
                {{-- Mostramos los campos de la segunda visita solo 
                si los de la primera ya están filled --}}
                
                <h4 class="text-gray-700 tracking-wide font-bold mt-4 mb-2">Segunda visita: </h4>
                <div class="p-3 bg-white">
                    <div class="sm:grid sm:grid-cols-2 lg:grid-cols-3 gap-3">
                        <div class="mt-3 sm:mt-0">
                            <x-jet-label for="seconVisit" value="Fecha" />
                            <input id="secondVisit" type="date" class="mt-1 block w-full" wire:model="secondVisit">

                            {{-- Fecha sugerida a partir de la fecha de la primer visita --}}
                            <p class="text-xs text-gray-500">
                                Fecha sugerida: 
                                <span class="font-bold italic">
                                    {{ \Carbon\Carbon::createFromFormat('Y-m-d',$this->firstVisit)->addDays(80)->format('d-F-Y') }}
                                </span>
                            </p>
                            <x-jet-input-error for="secondVisit" class="mt-2" />
                        </div>
                        <div class="mt-3 sm:mt-0 col-span-2">
                            <x-jet-label for="second_observation" value="Obeservaciones" />
                            <textarea  id="second_observation" rows="4" class="w-full block mt-1 resize-y rounded" wire:model.lazy="state.second_observation"></textarea>
                            <x-jet-input-error for="state.second_observation" class="mt-2" />
                        </div>
                    </div>
                </div>
            @endif

            <x-jet-secondary-button type="submit" class="fixed bottom-4 right-4 shadow-gray-800/40 shadow-lg">
                Guardar Datos
            </x-jet-secondary-button>
        </form>

        <h3 class="text-gray-700 text-lg tracking-wide font-bold mt-6">Archivos: </h3>
        <div class="p-3 bg-white">
            Falta :[
        </div>
    </div>

    {{-- 'Notificaciones'. Se muestran cuando se realiza el cambio de estado a TODOS los alumnos --}}
    <div 
        x-data="{ show: false, message: '' }"
        x-cloak
        x-show="show"
        x-transition.scale.origin.right
        x-init="$wire.on('nice', ($message) => { show = true; message = $message; setTimeout(() => { show = false }, 3500) })"
        class="fixed !z-50 top-14 right-0 rounded bg-green-200 border-l-4 border-green-600 text-slate-700 p-4"
        style="display: none !important;">
            <span x-text="message"></span>
    </div>
    <div 
        x-data="{ show: false, message: '' }"
        x-cloak
        x-show="show"
        x-transition.scale.origin.right
        x-init="$wire.on('error', ($message) => { show = true; message = $message; setTimeout(() => { show = false }, 3500) })"
        class="fixed !z-50 top-14 right-0 rounded bg-red-200 border-l-4 border-red-600 text-slate-700 p-4"
        style="display: none !important;">
            <span x-text="message"></span>
</div>
