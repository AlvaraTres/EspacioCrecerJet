<div>
    <x-jet-danger-button wire:click="$set('open', true)">
        Agregar Trastorno
    </x-jet-danger-button>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Crear nuevo trastorno
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label value="Nombre Tag:"/>
                <x-jet-input type="text" class="w-full" wire:model.defer="nombre_tag"/>
                
                <x-jet-input-error for="nombre_tag"/>

            </div>
            <div class="mb-4">
                <x-jet-label value="Descripción:"/>
                <x-jet-input type="text" class="w-full" wire:model.defer="descripcion"/>
                
                <x-jet-input-error for="descripcion"/>

            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="save" wire:loading.attr="disabled" wire:target="save" class="disabled:opacity-25">Crear Tag</x-jet-secondary-button>
            <x-jet-danger-button wire:click="$set('open', false)" wire:loading.attr="disabled" wire:target="save" class="disabled:opacity-25">Cancelar</x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
