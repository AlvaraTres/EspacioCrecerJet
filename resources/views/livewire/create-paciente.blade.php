<div>
    <x-jet-danger-button wire:click="$set('open', true)">
        Agregar Paciente
    </x-jet-danger-button>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Nuevo Psicólogo
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
            <x-jet-secondary-button wire:click="save" wire:loading.attr="disabled" wire:target="save" class="disabled:opacity-25">Crear Psicólogo</x-jet-secondary-button>
            <x-jet-danger-button wire:click="$set('open', false)" wire:loading.attr="disabled" wire:target="save" class="disabled:opacity-25">Cancelar</x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
