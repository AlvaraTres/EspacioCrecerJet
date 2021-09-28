<div>
    <a href="#"
        class="px-6 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 active:bg-green-600 disabled:opacity-25 transition'"
        wire:click="$set('openActivateModal', true)"> Activar </a>

    <!-- DELETE MODAL -->
    <x-jet-dialog-modal wire:model="openActivateModal">
        <x-slot name="title">
            Activar Cuenta Paciente
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <p>¿Estás seguro de activar la cuente del paciente {{$paciente->nombre_paciente}}&nbsp;{{ $paciente->ap_pat_paciente }}&nbsp;{{ $paciente->ap_mat_paciente }}?</p>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="activatePaciente" wire:loading.attr="disabled"
                class="disabled:opacity-25">Confirmar</x-jet-secondary-button>
            <x-jet-danger-button wire:click="$set('openActivateModal', false)" wire:loading.attr="disabled"
                class="disabled:opacity-25">Cancelar</x-jet-danger-button>
        </x-slot>

    </x-jet-dialog-modal>
</div>