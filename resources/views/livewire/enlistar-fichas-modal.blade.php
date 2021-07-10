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
            <div class="container mt-4 mx-auto place-items-center">
                <div class="grid grid-cols-1 md:grid-cols-1 gap-2 items-center">
                    @if ($ficha_paciente->count())
                        @foreach ($ficha_paciente as $ficha)
                            <div class="flex items-center justify-center">
                                <h1 class="font-semibold items-center mr-4">Fecha de atención:
                                    {{ $ficha->fecha_atencion_ficha }}</h1>
                                &nbsp;
                                <a href="{{ url('/fichaPdf', ['ficha_id' => $ficha->id]) }}"
                                    class="flex inline-flix mr-2 items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition>Descargar">Descargar
                                    Ficha</a>
                            </div>
                        @endforeach
                </div>

            </div>
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
