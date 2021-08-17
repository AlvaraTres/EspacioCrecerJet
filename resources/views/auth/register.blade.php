<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <div>
                <x-jet-label for="rut_paciente" value="{{ __('Rut') }}" />
                <x-jet-input id="rut_paciente" class="block mt-1 w-full" type="text" name="rut_paciente" />
            </div>

            <div class="mt-4">
                <x-jet-label for="nombre_paciente" value="{{ __('Nombre') }}" />
                <x-jet-input id="nombre_paciente" class="block mt-1 w-full" type="text" name="nombre_paciente" :value="old('nombre_paciente')" required autofocus autocomplete="nombre_paciente" />
            </div>

            <div class="mt-4">
                <x-jet-label for="apellido_pat_paciente" value="{{ __('Apellido Paterno') }}" />
                <x-jet-input id="apellido_pat_paciente" class="block mt-1 w-full" type="text" name="apellido_pat_paciente" :value="old('apellido_pat_paciente')" required autofocus autocomplete="apellido_pat_paciente" />
            </div>

            <div class="mt-4">
                <x-jet-label for="apellido_mat_paciente" value="{{ __('Apellido Materno') }}" />
                <x-jet-input id="apellido_mat_paciente" class="block mt-1 w-full" type="text" name="apellido_mat_paciente" :value="old('apellido_mat_paciente')" required autofocus autocomplete="apellido_mat_paciente" />
            </div>

            <div class="mt-4">
                <x-jet-label for="sexo_paciente" value="{{ __('Sexo') }}" />
                <select name="sexo_paciente" id="sexo_paciente" :value="old(sexo_paciente)" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required autofocus>
                    <option value="0" selected disabled>Selecciona una opción</option>
                    <option value="femenino">Femenino</option>
                    <option value="masculino">Masculino</option>
                    <option value="otro">Otro</option>
                </select>
            </div>

            <div class="mt-4">
                <x-jet-label for="fecha_nacimiento_paciente" value="{{ __('Fecha Nacimiento') }}" />
                <x-jet-input id="fecha_nacimiento_paciente" class="block mt-1 w-full" type="text" name="fecha_nacimiento_paciente" :value="old('fecha_nacimiento_paciente')" required autofocus autocomplete="fecha_nacimiento_paciente" />
            </div>

            <div class="mt-4">
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
            <div class="mt-4" id="divFile">
                    <x-jet-label value="Subir Certificado Alumno Regular:"/>
                <input type="file" name="certificado" id="certificado" accept=".pdf">
            </div>

            <div class="mt-4">
                <x-jet-label for="alergia" value="{{ __('Alergia') }}" />
                <x-jet-input id="alergia" class="block mt-1 w-full" type="text" name="alergia" :value="old('alergia')" required autofocus autocomplete="alergia" />
            </div>

            <div class="mt-4">
                <x-jet-label for="telefono_paciente" value="{{ __('Teléfono') }}" />
                <div class="flex items-stretch">
                    <span class="flex items-center bg-grey-200 leading-normal rounded rounded-r-none border border-r-0 border-gray-300   px-2 text-grey-dark whitespace-no-wrap ">+56</span>
                    <input type="text" class="flex items-center leading-normal rounded rounded-l-none relative focus:border-indigo-300 focus:shadow border border-gray-300 w-full focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm" name="telefono_paciente" id="telefono_paciente" :value="old('telefono_paciente')" required autofocus autocomplete="telefono_paciente">
                </div>
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Contraseña') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('¿Ya estás registrado?') }}
                </a>

                <x-jet-button class="ml-4 bg-blue-600 hover:bg-blue-500">
                    {{ __('Registrarse') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>

    @push('js')
        <script type="text/javascript">
        
            $(function(){
                $('#divFile').hide();
                $('#profesion').change(function(){
                    var opt = $(this).val();
                    if(opt == 'estudiante'){
                        $('#divFile').show();
                    }else{
                        $('#divFile').hide();
                    }
                });
            });
            jQuery.datetimepicker.setLocale('es');
            jQuery('#fecha_nacimiento_paciente').datetimepicker({
                i18n: {
                    de: {
                        months: [
                            'Enero', 'Febrero', 'Marzo', 'Abril',
                            'Mayo', 'Junio', 'Julio', 'Agosto',
                            'Septiembre', 'Octubre', 'Noviembre', 'Diciembre',
                        ],
                        dayOfWeek: [
                            "Lu.", "Ma", "Mi", "Ju",
                            "Do", "Fr", "Sa.",
                        ]
                    }
                },
                container: '#fecha_nacimiento_paciente',
                orientation: "auto-top",
                datepicker: true,
                timepicker: false,
                format: 'd-m-Y'
            });
        </script>
    @endpush
</x-guest-layout>
