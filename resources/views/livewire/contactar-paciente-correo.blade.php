<div>
    <a href="#" class="text-base text-blue-700 hover:text-blue-800 hover:font-bold disabled:opacity-25" wire:click="$set('open', true)" wire:loading.attr="disabled">{{$paciente->email}}</a>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            <div class="text-center">
                Enviar correo a {{$paciente->nombre_paciente}}&nbsp;{{$paciente->ap_pat_paciente}}&nbsp;{{$paciente->ap_mat_paciente}}
            </div>
        </x-slot>

        <x-slot name="content">
            <x-jet-label class="mt-4" value="Correo:" />
            <x-jet-input type="text" class="w-full" value="{{$paciente->email}}" disabled/>

            <x-jet-label class="mt-4" value="Asunto:" />
            <x-jet-input type="text" class="w-full" wire:model="asunto" />

            <x-jet-label class="mt-4" value="Cuerpo Correo:" />
            <textarea class="rounded w-full" rows="7" wire:model="cuerpo"></textarea>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="enviarMail" wire:loading.attr="disabled" class="disabled:opacity-25">Enviar Correo</x-jet-secondary-button>
            <x-jet-danger-button wire:click="$set('open', false)" wire:loading.attr="disabled" class="disabled:opacity-25">Cerrar</x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

</div>
