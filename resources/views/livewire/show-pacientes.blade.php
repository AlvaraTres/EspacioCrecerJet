<div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 bg-gray-200">
        <div class="px-6 py-4 flex items-stretch bg-gray-300">
            <span class="flex items-center bg-blue-200 leading-normal rounded rounded-r-none border border-r-0 border-black px-3 text-grey-dark whitespace-no-wrap ">Buscar: </span>
            <input type="text" class="flex-shrink flex-grow w-px leading-normal rounded rounded-l-none px-3 relative focus:border-blue focus:shadow border border-black mr-4" placeholder="Buscar Paciente" wire:model="search">
            @livewire('create-paciente')
        </div>
    </div>

    @if ($pacientes->count())

    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="order('id')">
                        ID
                        @if($sort == 'id')
                            @if($direction == 'asc')
                                <i class="fas fa-sort-numeric-up float-right mt-1"></i>
                            @else
                                <i class="fas fa-sort-numeric-down-alt float-right mt-1"></i>
                            @endif
                        @else
                            <i class="fas fa-sort float-right mt-1"></i>
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="order('rut_paciente')">
                        RUT
                        @if ($sort == 'rut_paciente')
                            @if ($direction == 'asc')
                                <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                            @else
                                <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                            @endif

                        @else
                            <i class="fas fa-sort float-right mt-1"></i>
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="order('nombre_paciente')">
                        Nombre
                        @if ($sort == 'nombre_paciente')
                            @if ($direction == 'asc')
                                <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                            @else
                                <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                            @endif

                        @else
                            <i class="fas fa-sort float-right mt-1"></i>
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="order('ap_pat_paciente')">
                        Apellido Paterno
                        @if ($sort == 'ap_pat_paciente')
                            @if ($direction == 'asc')
                                <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                            @else
                                <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                            @endif

                        @else
                            <i class="fas fa-sort float-right mt-1"></i>
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="order('ap_mat_paciente')">
                        Apellido Materno
                        @if ($sort == 'ap_mat_paciente')
                            @if ($direction == 'asc')
                                <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                            @else
                                <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                            @endif

                        @else
                            <i class="fas fa-sort float-right mt-1"></i>
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="order('telefono_paciente')">
                        Teléfono
                        @if($sort == 'telefono_paciente')
                            @if($direction == 'asc')
                                <i class="fas fa-sort-numeric-up float-right mt-1"></i>
                            @else
                                <i class="fas fa-sort-numeric-down-alt float-right mt-1"></i>
                            @endif
                        @else
                            <i class="fas fa-sort float-right mt-1"></i>
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="order('email')">
                        Email
                        @if ($sort == 'email')
                            @if ($direction == 'asc')
                                <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                            @else
                                <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                            @endif

                        @else
                            <i class="fas fa-sort float-right mt-1"></i>
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Acción
                    </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-600">
                @foreach ($pacientes as $paciente)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">
                                {{ $paciente->id }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">
                                {{ $paciente->rut_paciente }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">
                                {{ $paciente->nombre_paciente}}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">
                                {{ $paciente->ap_pat_paciente }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">
                                {{ $paciente->ap_mat_paciente }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">
                                {{ $paciente->telefono_paciente }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">
                                {{ $paciente->email }}
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center text-sm font-medium flex items-stretch">
                            <a href="#" class="inline-flex items-center justify-center px-4 py-2 mr-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 focus:outline-none focus:border-yellow-700 focus:ring focus:ring-yellow-200 active:bg-yellow-600 disabled:opacity-25 transition'" wire:click="editPaciente({{$paciente->id}})">Editar</a>
                            <a href="#" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition'" wire:click="deletePaciente({{$paciente->id}})">Eliminar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
    </table>
    
    {{ $pacientes->links() }}

    @else
        <div class="px-6 py-4 text-center">
            No existe ningún registro coincidente.
        </div>
    @endif

    <!-- DELETE MODAL -->
    <x-jet-dialog-modal wire:model="openDeletePacienteModal">
        <x-slot name="title">
            Eliminar Paciente
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <p>¿Estás seguro de eliminar al paciente seleccionado?</p>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="destroyPaciente" wire:loading.attr="disabled" class="disabled:opacity-25">Confirmar</x-jet-secondary-button>
            <x-jet-danger-button wire:click="$set('openDeletePacienteModal', false)" wire:loading.attr="disabled" class="disabled:opacity-25">Cancelar</x-jet-danger-button>
        </x-slot>

    </x-jet-dialog-modal>

    <!-- UPDATE MODAL -->
    <!-- MODAL EDITAR PSICÓLOGO -->
    <x-jet-dialog-modal wire:model="openEditPacienteModal">
        <x-slot name="title">
            Editar Paciente
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label value="Rut:"/>
                <x-jet-input type="text" class="w-full" wire:model.defer="rut_paciente"/>
                
                <x-jet-input-error for="rut_paciente"/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Nombre:"/>
                <x-jet-input type="text" class="w-full" wire:model.defer="nombre_paciente"/>
                
                <x-jet-input-error for="nombre_paciente"/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Apellido Paterno:"/>
                <x-jet-input type="text" class="w-full" wire:model.defer="ap_pat_paciente"/>
                
                <x-jet-input-error for="ap_pat_paciente"/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Apellido Materno:"/>
                <x-jet-input type="text" class="w-full" wire:model.defer="ap_mat_paciente"/>
                
                <x-jet-input-error for="ap_mat_paciente"/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Fecha Nacimiento:"/>
                <x-jet-input type="date" class="w-full" wire:model.defer="fecha_nacimiento_paciente"/>
                
                <x-jet-input-error for="fecha_nacimiento_paciente"/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Profesión:"/>
                <x-jet-input type="text" class="w-full" wire:model.defer="profesion"/>
                
                <x-jet-input-error for="profesion"/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Alergia:"/>
                <x-jet-input type="text" class="w-full" wire:model.defer="alergia"/>
                
                <x-jet-input-error for="alergia"/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Teléfono:"/>
                <x-jet-input type="text" class="w-full" wire:model.defer="telefono_paciente"/>
                
                <x-jet-input-error for="telefono_paciente"/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Email:"/>
                <x-jet-input type="email" class="w-full" wire:model.defer="email"/>
                
                <x-jet-input-error for="email"/>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="updatePaciente" wire:loading.attr="disabled" class="disabled:opacity-25">Editar Paciente</x-jet-secondary-button>
            <x-jet-danger-button wire:click="$set('openEditPacienteModal', false)" wire:loading.attr="disabled" class="disabled:opacity-25">Cancelar</x-jet-danger-button>
        </x-slot>

    </x-jet-dialog-modal>
</div>
