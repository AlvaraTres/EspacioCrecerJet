<div>
    @if(!$datos)
        <div class="flex items-stretchmax-w-7xl mx-auto px-4 py-4 sm:px-6 lg:px-8 bg-white">
            <p>Hola {{$paciente->nombre_paciente}}&nbsp;{{$paciente->ap_pat_paciente}}&nbsp;{{$paciente->ap_mat_paciente}}, para reservar tu primera hora con Espacio Crecer, por favor selecciona uno de nuestros psicológos a continuación, si quieres saber más de nuestros profesionales puedes visitar la sección de psicológos en la barra de navegación.</p>
            <select class="ml-3 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="psico" id="psico" wire:model="selectedPsico">
                <option value="#">Seleccionar psicológo</option>
                @foreach ($filtPsico as $item)
                    <option value="{{ $item->id }}">{{ $item->psicologo }}</option>
                @endforeach
            </select>
        </div>
    @else
        
    @endif
</div>
