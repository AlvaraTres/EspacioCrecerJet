<div>
    <a href="#"
        class="px-11 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition"
        wire:click="$set('open', true)">Ver</a>

    <!-- MODAL VER PACIENTE -->
    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            <div class="items-center text-center font-extrabold">Perfil Paciente:
                {{ $ver_paciente->nombre_paciente }}&nbsp;{{ $ver_paciente->ap_pat_paciente }}&nbsp;{{ $ver_paciente->ap_mat_paciente }}
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="flex items-stretch mb-4 mt-4">
                <h1 class="font-semibold">Nombre: </h1>&nbsp;<h1>
                    {{ $ver_paciente->nombre_paciente }}&nbsp;{{ $ver_paciente->ap_pat_paciente }}&nbsp;{{ $ver_paciente->ap_mat_paciente }}
                </h1>
            </div>
            <div class="flex items-stretch mb-4 mt-4">
                <h1 class="font-semibold">Rut: </h1>&nbsp;<h1>{{ $ver_paciente->rut_paciente }}</h1>
            </div>
            <div class="flex items-stretch mb-4 mt-4">
                <h1 class="font-semibold">Edad: </h1>&nbsp;<h1>{{ $edad_calculada }}</h1>&nbsp;<h1>años</h1>
            </div>
            <div class="flex items-stretch mb-4 mt-4">
                <h1 class="font-semibold">Sexo: </h1>&nbsp;<h1>{{ $ver_paciente->sexo_paciente }}</h1>
            </div>
            <div class="flex items-stretch mb-4 mt-4">
                <h1 class="font-semibold">Correo: </h1>&nbsp;<h1>{{ $ver_paciente->email }}</h1>
            </div>
            <div class="flex items-stretch mb-4 mt-4">
                <h1 class="font-semibold">Teléfono: </h1>&nbsp;<h1>{{ $ver_paciente->telefono_paciente }}</h1>
            </div>
            <div class="flex items-stretch mb-4 mt-4">
                <h1 class="font-semibold">Profesión: </h1>&nbsp;<h1>{{ $ver_paciente->profesion }}</h1>
            </div>
            @if ($ver_paciente->certificado != null)
                <div class="flex items-center mb-4 mt-4">
                    <h1 class="font-semibold items-center">Certificado Alumno Regular: </h1>&nbsp;<h1><a href="{{ url('/downloadCert', ['paciente_id' => $ver_paciente->id]) }}"
                        class="flex inline-flix mr-2 items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition>Descargar">Descargar</a></h1>
                </div>
            @endif
            <div class="flex items-stretch mb-4 mt-4">
                <h1 class="font-semibold">Alergias: </h1>&nbsp;<h1>{{ $ver_paciente->alergia }}</h1>
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex items-stretch">
                
                <x-jet-danger-button wire:click="$set('open', false)" wire:loading.attr="disabled"
                    class="disabled:opacity-25">Cerrar</x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
