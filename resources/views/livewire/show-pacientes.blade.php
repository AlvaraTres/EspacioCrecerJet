<div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 bg-gray-200">
        <div class="px-6 py-4 flex items-stretch bg-gray-300">
            <span
                class="flex items-center bg-blue-200 leading-normal rounded rounded-r-none border border-r-0 border-black px-3 text-grey-dark whitespace-no-wrap ">Buscar:
            </span>
            <input type="text"
                class="flex-shrink flex-grow w-px leading-normal rounded rounded-l-none px-3 relative focus:border-blue focus:shadow border border-black mr-4"
                placeholder="Buscar Paciente" wire:model="search">
            @livewire('create-paciente')
        </div>
    </div>

    @if ($pacientes->count())

        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                        wire:click="order('rut_paciente')">
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
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                        wire:click="order('nombre_paciente')">
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
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                        wire:click="order('ap_pat_paciente')">
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
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                        wire:click="order('ap_mat_paciente')">
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
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                        wire:click="order('telefono_paciente')">
                        Teléfono
                        @if ($sort == 'telefono_paciente')
                            @if ($direction == 'asc')
                                <i class="fas fa-sort-numeric-up float-right mt-1"></i>
                            @else
                                <i class="fas fa-sort-numeric-down-alt float-right mt-1"></i>
                            @endif
                        @else
                            <i class="fas fa-sort float-right mt-1"></i>
                        @endif
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer"
                        wire:click="order('email')">
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
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Acción
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @if (\Auth::user()->id_users_rol == 2)
                    <?php
                        for($i=0;$i<count($pacientesList);$i++){
                            for($j=0;$j<count($pacientes);$j++){
                                $comp = (int)$pacientesList[$i]->id;
                                $comp2 = (int)$pacientes[$j]->id;
                                if($comp == $comp2){
                                    ?><tr>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">
                                <?php echo $pacientes[$j]->rut_paciente; ?>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">
                                <?php echo $pacientes[$j]->nombre_paciente; ?>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">
                                <?php echo $pacientes[$j]->ap_pat_paciente; ?>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">
                                <?php echo $pacientes[$j]->ap_mat_paciente; ?>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">
                                <?php echo $pacientes[$j]->telefono_paciente; ?>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">
                                <?php echo $pacientes[$j]->email; ?>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center text-sm font-medium">
                            <div class="container">
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                                    @livewire('ver-paciente-info-modal', ['paciente' => $pacientes[$j]],
                                    key($pacientes[$j]->id))
                                </div>
                                <div class="">
                                    @livewire('enlistar-fichas-modal', ['paciente' => $pacientes[$j]],
                                    key($pacientes[$j]->id))
                                </div>
                                <div class="">
                                    @livewire('edit-paciente', ['paciente' => $pacientes[$j]], key($pacientes[$j]->id))
                                </div>
                                <div class="">
                                    @livewire('delete-paciente', ['paciente' => $pacientes[$j]],
                                    key($pacientes[$j]->id))
                                </div>
                            </div>
                        </td>
                    </tr> <?php
                                }
                            }
                        }
                    ?>
                @else
                    @foreach ($pacientes as $paciente)
                        <tr>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">
                                    {{ $paciente->rut_paciente }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">
                                    {{ $paciente->nombre_paciente }}
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
                            <td class="px-6 py-4 text-center text-sm font-medium">
                                <div class="container">
                                    <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-1 sm:grid-cols-1 gap-5">
                                        @if (\Auth::user()->id_users_rol == 1)
                                            @livewire('ver-paciente-info-modal', ['paciente' => $paciente],
                                            key($paciente->id))
                                        @else
                                            @if (\Auth::user()->id_users_rol == 2)
                                                @livewire('ver-paciente-info-modal', ['paciente' => $paciente],
                                                key($paciente->id))
                                            @endif
                                        @endif
                                    </div>
                                    @if (Auth::user()->id_users_rol == 2)
                                        <div class="">
                                            @livewire('enlistar-fichas-modal', ['paciente' => $paciente],
                                            key($paciente->id))
                                        </div>
                                    @endif
                                    <div class="">
                                        @livewire('edit-paciente', ['paciente' => $paciente], key($paciente->id))
                                    </div>
                                    <div class="">
                                        @livewire('delete-paciente', ['paciente' => $paciente], key($paciente->id))
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif

            </tbody>
        </table>
        @if (\Auth::user()->id_users_rol == 1)
            {{ $pacientes->links() }}
        @endif
    @else
        <div class="px-6 py-4 text-center">
            No existe ningún registro coincidente.
        </div>
    @endif
</div>
