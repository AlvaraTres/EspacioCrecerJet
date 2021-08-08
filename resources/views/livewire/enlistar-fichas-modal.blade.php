<div>
    <a href="#"
        class="px-8 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 active:bg-green-600 disabled:opacity-25 transition'"
        wire:click="$set('openVerFichasModal', true)" wire:loading.attr="disabled"
        class="disabled:opacity-25">Fichas</a>

    <!-- MODAL FICHAS PACIENTES -->
    <x-jet-dialog-modal wire:model="openVerFichasModal">
        <x-slot name="title">
            <div class="items-center text-center font-extrabold">Perfil Paciente:
                {{ $paciente->nombre_paciente }}&nbsp;{{ $paciente->ap_pat_paciente }}&nbsp;{{ $paciente->ap_mat_paciente }}
            </div>
        </x-slot>
        <x-slot name="content">

            @if ($showInfoFichasModal == true)
                <div class="container mt-4 mx-auto place-items-center">
                    <div class="grid grid-cols-1 md:grid-cols-1 gap-2 items-center">
                        @foreach ($ficha_paciente as $ficha)
                            <div class="flex items-center justify-center">
                                <h1 class="font-semibold items-center mr-4">Fecha de atención:
                                    {{ $ficha->fecha_atencion_ficha }}</h1>
                                &nbsp;
                                @if ($ficha->archivo == null)
                                <a href="{{ url('/fichaPdf', ['ficha_id' => $ficha->id]) }}"
                                    class="flex inline-flix mr-2 items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition>Descargar">Descargar
                                    Ficha</a>
                                @else
                                <a href="{{ url('/downloadFile', ['ficha_id' => $ficha->id]) }}"
                                    class="flex inline-flix mr-2 items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition>Descargar">Archivo Externo</a>
                                @endif
                                
                            </div>
                        @endforeach
                    </div>
                </div>
                @if (!$ficha_paciente->count())
                    <div class="flex items-stretch mb-4 mt-4">
                        <h1 class="font-semibold">No hay registros de fichas para este paciente.</h1>
                    </div>
                @endif
            @endif


            <div class="text-left">
                @if ($openUploadFileModal == true)
                    <x-jet-label value="Fecha de atención:" />
                @endif

                <input @if ($openUploadFileModal == true) type="text" @else type="hidden" @endif
                    class="datetimepicker-input border rounded-md border-gray-300"
                    id="fechaAtencion{{ $paciente->id }}" data-toggle="datetimepicker"
                    data-target="#fechaAtencion{{ $paciente->id }}" autocomplete="off" />
                @if ($openUploadFileModal == true)
                    <x-jet-label class="mt-4" value="Subir archivo:" />
                    <input type="file" name="archivo" id="archivo" wire:model="archivo" accept=".pdf , .doc , .docx">
                    @error('archivo')<span class="error">{{$message}}</span>@enderror
                @endif
            </div>

        </x-slot>

        <x-slot name="footer">
            @if ($showInfoFichasModal == true)
                <x-jet-danger-button wire:click="showUploadFileModal"
                    class="px-8 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition">
                    Crear Ficha</x-jet-danger-button>
            @endif
            @if ($openUploadFileModal == true)
                <x-jet-danger-button wire:click="saveFileFichaPaciente"
                    class="px-8 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition">
                    Subir Ficha</x-jet-danger-button>
            @endif
            <x-jet-danger-button wire:click="$set('openVerFichasModal', false)" wire:loading.attr="disabled"
                class="disabled:opacity-25">Cerrar</x-jet-danger-button>
        </x-slot>

    </x-jet-dialog-modal>

    @push('js')
        <script type="text/javascript">
            jQuery.datetimepicker.setLocale('es');
            jQuery('#fechaAtencion{{ $paciente->id }}').datetimepicker({
                timepicker: false,
                format: 'd-m-Y',
                maxDate: '0',
            }).on('change', function(e) {
                @this.set('fecha_atencion_ficha', jQuery('#fechaAtencion{{ $paciente->id }}').val());
            });
        </script>
    @endpush
</div>
