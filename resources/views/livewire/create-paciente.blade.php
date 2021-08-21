<div>
    <x-jet-danger-button wire:click="$set('open', true)">
        Agregar Paciente
    </x-jet-danger-button>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            <div class="items-center mx-auto">
                Agregar Paciente
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label value="Rut:"/>
                <x-jet-input type="text" class="w-full" wire:model.defer="rut_paciente"/>
                
                <x-jet-input-error for="rut_paciente"/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Nombre:"/>
                <x-jet-input type="text" class="w-full" wire:model.defer="nombre_paciente"/>
                
                <x-jet-input-error for="nombre_paciente"/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Apellido Paterno:"/>
                <x-jet-input type="text" class="w-full" wire:model.defer="ap_pat_paciente"/>
                
                <x-jet-input-error for="ap_pat_paciente"/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Apellido Materno:"/>
                <x-jet-input type="text" class="w-full" wire:model.defer="ap_mat_paciente"/>
                
                <x-jet-input-error for="ap_mat_paciente"/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Fecha Nacimiento:"/>
                <x-jet-input type="date" class="w-full" wire:model.defer="fecha_nacimiento_paciente"/>
                
                <x-jet-input-error for="fecha_nacimiento_paciente"/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Profesión:"/>
                <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="profesion" id="profesion" wire:model="profesion">
                    <option value="0">Selecciona tu profesión</option>
                    <option value="Abogado">Abogado(a)</option>
                    <option value="ingeniero">Ingeniero(a)</option>
                    <option value="profesor">Profesor(a)</option>
                    <option value="tecnico">Técnico</option>
                    <option value="medico">Médico</option>
                    <option value="arquitecto">Arquitecto</option>
                    <option value="estudiante">Estudiante</option>
                    <option value="otro">Otro</option>
                </select>
                
                <x-jet-input-error for="profesion"/>
            </div>
            @if ($inputCert == 1)
                <div class="mb-4">
                    <x-jet-label value="Subir Certificado Alumno Regular:"/>
                    <input type="file" name="cert" id="cert" wire:model="certificado" accept=".pdf">
                </div>
            @endif
            <div class="mb-4">
                <x-jet-label value="Patologías previas:"/>
                <x-jet-input type="text" class="w-full" wire:model.defer="patologias_previas"/>
                
                <x-jet-input-error for="patologias_previas"/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Teléfono:"/>
                <x-jet-input type="text" class="w-full" wire:model.defer="telefono_paciente"/>
                
                <x-jet-input-error for="telefono_paciente"/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Email:"/>
                <x-jet-input type="email" class="w-full" wire:model.defer="email"/>
                
                <x-jet-input-error for="email"/>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="save" wire:loading.attr="disabled" wire:target="save" class="disabled:opacity-25">Crear Paciente</x-jet-secondary-button>
            <x-jet-danger-button wire:click="$set('open', false)" wire:loading.attr="disabled" wire:target="save" class="disabled:opacity-25">Cancelar</x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
