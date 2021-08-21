<div>
    <x-jet-danger-button wire:click="$set('open', true)">
        Agregar Psicólogo
    </x-jet-danger-button>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Nuevo Psicólogo
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
            <div class="mb-4">
                <x-jet-label value="Contraseña:"/>
                <x-jet-input type="password" class="w-full" wire:model.defer="password"/>
                
                <x-jet-input-error for="password"/>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="save" wire:loading.attr="disabled" wire:target="save" class="disabled:opacity-25">Crear Psicólogo</x-jet-secondary-button>
            <x-jet-danger-button wire:click="$set('open', false)" wire:loading.attr="disabled" wire:target="save" class="disabled:opacity-25">Cancelar</x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
