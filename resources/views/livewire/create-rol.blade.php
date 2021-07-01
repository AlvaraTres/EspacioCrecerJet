<div>
    <x-jet-danger-button wire:click="$set('open', true)">
        Agregar Rol
    </x-jet-danger-button>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Crear nuevo rol
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label value="Nombre Rol:"/>
                <x-jet-input type="text" class="w-full" wire:model.defer="tipo_usuario"/>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="save">Crear Rol</x-jet-secondary-button>
            <x-jet-danger-button wire:click="$set('open', false)">Cancelar</x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
