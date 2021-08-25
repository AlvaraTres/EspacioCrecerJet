<div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 bg-gray-200">
        <div class="px-6 py-4 flex items-stretch bg-gray-300">
            <span class="flex items-center bg-blue-200 leading-normal rounded rounded-r-none border border-r-0 border-black px-3 text-grey-dark whitespace-no-wrap ">Buscar: </span>
            <input type="text" class="flex-shrink flex-grow w-px leading-normal rounded rounded-l-none px-3 relative focus:border-blue focus:shadow border border-black mr-4" placeholder="Buscar Psicólogo" wire:model="search">
            @livewire('create-psicologo')
        </div>
    </div>

    @if ($psicologos->count())
        
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="order('rut_usuario')">
                        RUT
                        @if ($sort == 'rut_usuario')
                            @if ($direction == 'asc')
                                <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                            @else
                                <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                            @endif

                        @else
                            <i class="fas fa-sort float-right mt-1"></i>
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="order('nombre_usuario')">
                        Nombre
                        @if ($sort == 'nombre_usuario')
                            @if ($direction == 'asc')
                                <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                            @else
                                <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                            @endif

                        @else
                            <i class="fas fa-sort float-right mt-1"></i>
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="order('apellido_pat_usuario')">
                        Apellido Paterno
                        @if ($sort == 'apellido_pat_usuario')
                            @if ($direction == 'asc')
                                <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                            @else
                                <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                            @endif

                        @else
                            <i class="fas fa-sort float-right mt-1"></i>
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="order('apellido_mat_usuario')">
                        Apellido Materno
                        @if ($sort == 'apellido_mat_usuario')
                            @if ($direction == 'asc')
                                <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                            @else
                                <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
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
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="order('especialidad')">
                        Formación
                        @if ($sort == 'formacion')
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
            <tbody class="bg-white divide-y divide-gray-300">
                @foreach ($psicologos as $psicologo)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">
                                {{ $psicologo->rut_usuario }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">
                                {{ $psicologo->nombre_usuario}}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">
                                {{ $psicologo->apellido_pat_usuario }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">
                                {{ $psicologo->apellido_mat_usuario }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">
                                <a href="#" class="text-base text-blue-700 hover:text-blue-800 hover:font-bold disabled:opacity-25" wire:click="modalMail({{$psicologo->id}})" wire:loading.attr="disabled">{{ $psicologo->email }}</a>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">
                                {{ $psicologo->formacion }}
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right text-sm font-medium flex items-stretch">
                            <a href="#" class="inline-flix mr-2 items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition" wire:click="verPsicologo({{$psicologo->id}})">Ver</a>
                            <a href="#" class="inline-flex mr-2 items-center justify-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 focus:outline-none focus:border-yellow-700 focus:ring focus:ring-yellow-200 active:bg-yellow-600 disabled:opacity-25 transition'" wire:click="editPsicologo({{$psicologo->id}})">Editar</a>
                            <a href="#" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition'" wire:click="deletePsicologo({{$psicologo->id}})">Eliminar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    {{ $psicologos->links() }}

    @else
        <div class="px-6 py-4 text-center">
            No existe ningún registro coincidente.
        </div>
    @endif

    <!-- MODAL DELETE PSICÓLOGO -->
    <x-jet-dialog-modal wire:model="openDeletePsicologoModal">
        <x-slot name="title">
            Eliminar Psicólogo
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <p>¿Estás seguro de eliminar al psicólogo seleccionado?</p>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="destroyPsicologo" wire:loading.attr="disabled" class="disabled:opacity-25">Confirmar</x-jet-secondary-button>
            <x-jet-danger-button wire:click="$set('openDeletePsicologoModal', false)" wire:loading.attr="disabled" class="disabled:opacity-25">Cancelar</x-jet-danger-button>
        </x-slot>

    </x-jet-dialog-modal>

    <!-- MODAL EDITAR PSICÓLOGO -->
    <x-jet-dialog-modal wire:model="openEditPsicologoModal">
        <x-slot name="title">
            Editar Psicólogo
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label value="Rut:"/>
                <x-jet-input type="text" class="w-full" wire:model.defer="rut_usuario"/>
                
                <x-jet-input-error for="rut_usuario"/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Nombre:"/>
                <x-jet-input type="text" class="w-full" wire:model.defer="nombre_usuario"/>
                
                <x-jet-input-error for="nombre_usuario"/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Apellido Paterno:"/>
                <x-jet-input type="text" class="w-full" wire:model.defer="apellido_pat_usuario"/>
                
                <x-jet-input-error for="apellido_pat_usuario"/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Apellido Materno:"/>
                <x-jet-input type="text" class="w-full" wire:model.defer="apellido_mat_usuario"/>
                
                <x-jet-input-error for="apellido_mat_usuario"/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Fecha Nacimiento:"/>
                <x-jet-input type="date" class="w-full" wire:model.defer="fecha_nacimiento"/>
                
                <x-jet-input-error for="fecha_nacimiento"/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Formación:"/>
                <x-jet-input type="text" class="w-full" wire:model.defer="formacion"/>
                
                <x-jet-input-error for="especialidad"/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Teléfono:"/>
                <x-jet-input type="text" class="w-full" wire:model.defer="telefono"/>
                
                <x-jet-input-error for="telefono"/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Email:"/>
                <x-jet-input type="email" class="w-full" wire:model.defer="email"/>
                
                <x-jet-input-error for="email"/>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="updatePsicologo" wire:loading.attr="disabled" class="disabled:opacity-25">Editar Psicólogo</x-jet-secondary-button>
            <x-jet-danger-button wire:click="$set('openEditPsicologoModal', false)" wire:loading.attr="disabled" class="disabled:opacity-25">Cancelar</x-jet-danger-button>
        </x-slot>

    </x-jet-dialog-modal>

    <!-- MODAL VER PSICOLOGO -->
    <x-jet-dialog-modal wire:model="openVerPsicologoModal">
        <x-slot name="title">
            <div class="items-center text-center font-extrabold">Perfil Psicólogo: {{$nombre_usuario}}</div>
        </x-slot>

        <x-slot name="content">
            <div class="flex items-stretch mb-4 mt-4">
                <h1 class="font-semibold">Nombre: </h1>&nbsp;<h1>{{$nombre_usuario}} {{$apellido_pat_usuario}} {{$apellido_mat_usuario}}</h1>
            </div>
            <div class="flex items-stretch mb-4 mt-4">
                <h1 class="font-semibold">Rut: </h1>&nbsp;<h1>{{$rut_usuario}}</h1>
            </div>
            <div class="flex items-stretch mb-4 mt-4">
                <h1 class="font-semibold">Correo: </h1>&nbsp;<h1>{{$email}}</h1>
            </div>
            <div class="flex items-stretch mb-4 mt-4">
                <h1 class="font-semibold">Teléfono: </h1>&nbsp;<h1>{{$telefono}}</h1>
            </div>
            <div class="flex items-stretch mb-4 mt-4">
                <h1 class="font-semibold">Formación: </h1>&nbsp;<h1>{{$formacion}}</h1>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-danger-button wire:click="$set('openVerPsicologoModal', false)" wire:loading.attr="disabled" class="disabled:opacity-25">Cerrar</x-jet-danger-button>
        </x-slot>

    </x-jet-dialog-modal>

    <!-- MODAL ENVIAR CORREO A PSICÓLOGO -->
    <x-jet-dialog-modal wire:model="openMail">
        <x-slot name="title">
            <div class="text-center">
                Enviar correo a {{$nombre_usuario}}&nbsp;{{$apellido_pat_usuario}}&nbsp;{{$apellido_mat_usuario}}
            </div>
        </x-slot>

        <x-slot name="content">
            <x-jet-label class="mt-4" value="Correo:" />
            <x-jet-input type="text" class="w-full" value="{{$email}}" disabled/>

            <x-jet-label class="mt-4" value="Asunto:" />
            <x-jet-input type="text" class="w-full" wire:model="asunto" />

            <x-jet-label class="mt-4" value="Cuerpo Correo:" />
            <textarea class="rounded w-full" rows="7" wire:model="cuerpo"></textarea>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="enviarMail" wire:loading.attr="disabled" class="disabled:opacity-25">Enviar Correo</x-jet-secondary-button>
            <x-jet-danger-button wire:click="$set('openMail', false)" wire:loading.attr="disabled" class="disabled:opacity-25">Cerrar</x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
    
</div>
