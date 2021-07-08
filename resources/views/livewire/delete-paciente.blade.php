<div>
    <a href="#"
        class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition'"
        wire:click="$set('openDeleteModal', true)">Eliminar</a>

    <!-- DELETE MODAL -->
    <x-jet-dialog-modal wire:model="openDeleteModal">
        <x-slot name="title">
            Eliminar Paciente
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <p>¿Estás seguro de eliminar al paciente {{$paciente->nombre_paciente}}&nbsp;{{ $paciente->ap_pat_paciente }}&nbsp;{{ $paciente->ap_mat_paciente }}?</p>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="destroyPaciente" wire:loading.attr="disabled"
                class="disabled:opacity-25">Confirmar</x-jet-secondary-button>
            <x-jet-danger-button wire:click="$set('openDeleteModal', false)" wire:loading.attr="disabled"
                class="disabled:opacity-25">Cancelar</x-jet-danger-button>
        </x-slot>

    </x-jet-dialog-modal>
</div>
