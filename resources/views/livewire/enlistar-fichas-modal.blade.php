<div>
    <x-jet-secondary-button wire:click="$set('openVerFichasModal', true)" wire:loading.attr="disabled"
        class="disabled:opacity-25 mr-2">Ver Fichas</x-jet-secondary-button>

    <!-- MODAL FICHAS PACIENTES -->
    <x-jet-dialog-modal wire:model="openVerFichasModal">
        <x-slot name="title">
            <div class="items-center text-center font-extrabold">Perfil Paciente:
                {{ $paciente->nombre_paciente }}&nbsp;{{ $paciente->ap_pat_paciente }}&nbsp;{{ $paciente->ap_mat_paciente }}
            </div>
        </x-slot>

        <x-slot name="content">
            @if ($ficha_paciente->count())
                @foreach ($ficha_paciente as $ficha)
                    <div class="flex items-stretch mb-4 mt-4">
                        <h1 class="font-semibold">Fecha: {{$ficha->fecha_atencion_ficha}}</h1>
                        <a href="{{url('/fichaPdf')}}">Descargar</a>
                    </div>
                @endforeach
            @else
                <div class="flex items-stretch mb-4 mt-4">
                    <h1 class="font-semibold">No hay registros de fichas para este paciente.</h1>
                </div>
            @endif
        </x-slot>

        <x-slot name="footer">
            <x-jet-danger-button wire:click="$set('openVerFichasModal', false)" wire:loading.attr="disabled"
                class="disabled:opacity-25">Cerrar</x-jet-danger-button>
        </x-slot>

    </x-jet-dialog-modal>
</div>
