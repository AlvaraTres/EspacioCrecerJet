<div>
    <a href="#"
        class="px-8 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 focus:outline-none focus:border-yellow-700 focus:ring focus:ring-yellow-200 active:bg-yellow-600 disabled:opacity-25 transition'"
        wire:click="$set('openEditPacienteModal', true)">Editar</a>

    <!-- UPDATE MODAL -->
    <!-- MODAL EDITAR PSICÓLOGO -->
    <x-jet-dialog-modal wire:model="openEditPacienteModal">
        <x-slot name="title">
            Editar Paciente: {{$paciente->nombre_paciente}}&nbsp;{{ $paciente->ap_pat_paciente }}&nbsp;{{ $paciente->ap_mat_paciente }}
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label value="Rut:" />
                <x-jet-input type="text" class="w-full" wire:model="paciente.rut_paciente" />

                <x-jet-input-error for="rut_paciente" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Nombre:" />
                <x-jet-input type="text" class="w-full" wire:model.defer="paciente.nombre_paciente" />

                <x-jet-input-error for="nombre_paciente" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Apellido Paterno:" />
                <x-jet-input type="text" class="w-full" wire:model.defer="paciente.ap_pat_paciente" />

                <x-jet-input-error for="ap_pat_paciente" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Apellido Materno:" />
                <x-jet-input type="text" class="w-full" wire:model.defer="paciente.ap_mat_paciente" />

                <x-jet-input-error for="ap_mat_paciente" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Fecha Nacimiento:" />
                <x-jet-input type="date" class="w-full" wire:model.defer="paciente.fecha_nacimiento_paciente" />

                <x-jet-input-error for="fecha_nacimiento_paciente" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Profesión:" />
                <x-jet-input type="text" class="w-full" wire:model.defer="paciente.profesion" />

                <x-jet-input-error for="profesion" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Alergia:" />
                <x-jet-input type="text" class="w-full" wire:model.defer="paciente.alergia" />

                <x-jet-input-error for="alergia" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Teléfono:" />
                <x-jet-input type="text" class="w-full" wire:model.defer="paciente.telefono_paciente" />

                <x-jet-input-error for="telefono_paciente" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Email:" />
                <x-jet-input type="email" class="w-full" wire:model.defer="paciente.email" />

                <x-jet-input-error for="email" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="updatePaciente" wire:loading.attr="disabled"
                class="disabled:opacity-25">Editar Paciente</x-jet-secondary-button>
            <x-jet-danger-button wire:click="$set('openEditPacienteModal', false)" wire:loading.attr="disabled"
                class="disabled:opacity-25">Cancelar</x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
