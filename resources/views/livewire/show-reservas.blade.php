<div>
    @if(\Auth::user()->id_users_rol == 3)
        @if (!$datos)
            <div class="flex items-stretchmax-w-7xl mx-auto px-4 py-4 sm:px-6 lg:px-8 bg-white">
                <p class="text-justify ">Hola
                    {{ $paciente->nombre_paciente }}&nbsp;{{ $paciente->ap_pat_paciente }}&nbsp;{{ $paciente->ap_mat_paciente }},
                    para reservar tu primera hora con Espacio Crecer, por favor selecciona uno de nuestros
                    psicológos a continuación, si quieres saber más de nuestros profesionales puedes visitar la
                    sección de psicológos en la barra de navegación.</p>
                <select
                    class="ml-3 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    name="psico" id="psico" wire:model="selectedPsico">
                    <option value="#">Seleccionar psicológo</option>
                    @foreach ($filtPsico as $item)
                        <option value="{{ $item->id }}">{{ $item->psicologo }}</option>
                    @endforeach
                </select>
            </div>
        @else
            <div class="flex items-stretchmax-w-7xl mx-auto px-4 py-4 sm:px-6 lg:px-8 bg-white">
                <p class="text-justify ">Hola
                    {{ $paciente->nombre_paciente }}&nbsp;{{ $paciente->ap_pat_paciente }}&nbsp;{{ $paciente->ap_mat_paciente }},
                    para reservar otra hora con tu psicológo {{$datos->nombre_usuario}}&nbsp;{{$datos->apellido_pat_usuario}}, selecciona una fecha y horario disponible en el siguiente calendario.</p>
                
            </div>
        @endif
    @else
        @if(\Auth::user()->id_users_rol == 1)
        <div class="flex items-stretchmax-w-7xl mx-auto px-4 py-4 sm:px-6 lg:px-8 bg-white">
            <select
                class="ml-3 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                name="psico" id="psico" wire:model="selectedPsico">
                <option value="#">Seleccionar psicológo</option>
                @foreach ($filtPsico as $item)
                    <option value="{{ $item->id }}">{{ $item->psicologo }}</option>
                @endforeach
            </select>
            <select
                class="ml-3 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                name="paciente" id="paciente" wire:model="selectedPaciente">
                <option value="#">Seleccionar paciente</option>
                @foreach ($filtPaciente as $item)
                    <option value="{{ $item->id }}">{{ $item->paciente }}</option>
                @endforeach
            </select>
        </div>
        @endif
    @endif


    <!-- MODAL DE CREAR RESERVAS -->
    <x-jet-dialog-modal wire:model="open" id="reg_res">
        <x-slot name="title">
            Reservar Hora
        </x-slot>

        <x-slot name="content">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token">
            <input type="hidden" name="pid" id="pid" wire:model.defer="selectedPsico">

            <x-jet-label value="Hora Reserva:" />
            <input type="text" class="datetimepicker-input border rounded-md border-gray-300" id="datetimepicker5"
                data-toggle="datetimepicker" data-target="#datetimepicker5" />
            <x-jet-input-error for="hora_reserva" />

            <x-jet-label value="Motivo:" />
            <x-jet-input type="text" class="w-full" wire:model.defer="motivo_reserva" id="motivo_reserva" />
            <x-jet-input-error for="motivo_reserva" />


        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:loading.attr="disabled" class="disabled:opacity-25" id="btn_reserva">Reservar
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="$set('open', false)" wire:loading.attr="disabled"
                class="disabled:opacity-25">Cancelar</x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>

    <!-- MODAL DE Edit RESERVAS -->
    <x-jet-dialog-modal wire:model="openEditModal" id="edit_res">
        <x-slot name="title">
            Cambiar Reserva de Hora
        </x-slot>

        <x-slot name="content">
            <x-jet-label value="Fecha de Reserva: " />
            <input type="text" wire:model.defer="fecha_reserva"
                class="datetimepicker-input border rounded-md border-gray-300" id="datetimepickerFecha"
                data-toggle="datetimepicker" data-target="#datetimepickerFecha" />

            <x-jet-label value="Hora Reserva:" />
            <input type="text" wire:model.defer="hora_reserva"
                class="datetimepicker-input border rounded-md border-gray-300" id="datetimepickerEdit"
                data-toggle="datetimepicker" data-target="#datetimepickerEdit" />
            <x-jet-input-error for="hora_reserva" />
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:loading.attr="disabled" class="disabled:opacity-25" id="btn_delete_reserva">
                Cancelar Reserva
            </x-jet-secondary-button>
            <x-jet-secondary-button wire:loading.attr="disabled" class="disabled:opacity-25 bg-blue-500 text-white"
                id="btn_edit_reserva">Modificar Reserva
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="$set('openEditModal', false)" wire:loading.attr="disabled"
                class="disabled:opacity-25">
                Cancelar</x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>

    <!-- MODAL DE DELETE RESERVAS -->
    <x-jet-dialog-modal wire:model="openDelModal" id="del_res">
        <x-slot name="title">
            Cancelar Reserva
        </x-slot>

        <x-slot name="content">
            ¿Estás seguro de cancelar tu reserva de hora?
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:loading.attr="disabled" class="disabled:opacity-25" id="btn_destroy_reserva">
                Confirmar
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="cancelarDel" wire:loading.attr="disabled" class="disabled:opacity-25">
                Cancelar</x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>

    @push('js')
        <script>
            document.addEventListener('livewire:load', function() {
                var Calendar = FullCalendar.Calendar;
                var Draggable = FullCalendar.Draggable;
                var calendarEl = document.getElementById('calendar');
                var datos = @this.events;
                console.log(datos);
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    events: JSON.parse(datos),
                    initialView: 'dayGridMonth',
                    locale: "es",
                    selectable: true,

                    headerToolbar: {
                        left: 'prev, next, today',
                        center: 'title',
                        right: 'dayGridMonth, timeGridWeek, listWeek',
                    },
                    weekends: true,

                    dateClick: function(info, start) {
                        var pid = document.getElementById("pid").value;
                        console.log(moment(info));
                        var selectDate = info.dateStr;
                        var startDate = moment(selectDate);
                        //alert('Click: '+info.timeStr);
                        if (moment(startDate).isBefore(moment())) {
                            Swal.fire(
                                'Ooops!',
                                'No puedes reservar horas durante días que ya transcurrieron',
                                'error'
                            )
                        } else {
                            console.log(startDate.isoWeekday());
                            if (startDate.isoWeekday() == 6 || startDate.isoWeekday() == 7) {
                                Swal.fire(
                                    'Ooops!',
                                    'No puedes reservar horas durante los fines de semana',
                                    'error'
                                )
                            } else {
                                @this.set('open', true);
                                var fecha = new Date(info.dateStr + 'T00:00:00');
                                console.log(fecha);

                                var date1 = fecha.getFullYear();
                                var date2 = fecha.getMonth();
                                var date3 = fecha.getDate();
                                date2 = date2 + 1;
                                console.log(date2);

                                document.getElementById("btn_reserva").addEventListener("click",
                                    function() {
                                        var startTime = document.getElementById(
                                                'datetimepicker5')
                                            .value;

                                        if (@this.checkDate(startTime)) {
                                            var description = document.getElementById(
                                                    'motivo_reserva')
                                                .value;
                                            console.log(startTime);



                                            /*calendar.addEvent({
                                                title: "Nuevo Evento",
                                                start: date,
                                                description: description
                                            });*/

                                            var token = document.getElementById("_token").value;

                                            console.log(token);
                                            var direccion =
                                                "{{ route('payment', ['date1' => 'date1', 'date2' => 'date2', 'date3' => 'date3', 'startTime' => 'startTime', 'description' => 'description', 'pid' => 'pid']) }}"
                                            direccion = direccion.replace('date1', date1);
                                            direccion = direccion.replace('date2', date2);
                                            direccion = direccion.replace('date3', date3);
                                            direccion = direccion.replace('startTime',
                                                startTime);
                                            direccion = direccion.replace('description',
                                                description);
                                            direccion = direccion.replace('pid', pid);
                                            window.location.href = direccion;

                                            calendar.refetchEvents();
                                        } else {
                                            console.log(@this.checkDate(startTime));
                                        }

                                    }
                                );
                            }
                        }
                    },
                    eventClick: function(info) {
                        var reserva = info.event;
                        console.log(reserva);
                        @this.editReserva(reserva);
                        document.getElementById('btn_edit_reserva').addEventListener("click", function() {
                            var editFecha = document.getElementById('datetimepickerFecha').value;
                            var editHora = document.getElementById('datetimepickerEdit').value;
                            console.log(editHora);
                            @this.updateReserva(editFecha, editHora);
                            calendar.refetchEvents();
                        });
                        document.getElementById("btn_delete_reserva").addEventListener("click", function() {
                            @this.set('openEditModal', false);
                            @this.set('openDelModal', true);
                            document.getElementById("btn_destroy_reserva").addEventListener("click",
                                function() {
                                    @this.destroyReserva();
                                });
                        });
                    },
                    loading: function(isLoading) {
                        if (!isLoading) {
                            //resetear eventos
                            this.getEvents().forEach(function(e) {
                                if (e.source === null) {
                                    e.remove();
                                }
                            });
                        }
                    }
                });
                calendar.render();
                @this.on('refreshCalendar', () => {
                    calendar.refetchEvents()
                });
            });
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", () => {
                Livewire.hook('element.updated', (el, component) => {
                    var Calendar = FullCalendar.Calendar;
                    var Draggable = FullCalendar.Draggable;
                    var calendarEl = document.getElementById('calendar');
                    var datos = @this.events;
                    console.log(datos);
                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        events: JSON.parse(datos),
                        initialView: 'dayGridMonth',
                        locale: "es",
                        selectable: true,

                        headerToolbar: {
                            left: 'prev, next, today',
                            center: 'title',
                            right: 'dayGridMonth, timeGridWeek, listWeek',
                        },
                        weekends: true,

                        dateClick: function(info, start) {
                            console.log(moment(info));
                            var selectDate = info.dateStr;
                            var startDate = moment(selectDate);
                            //alert('Click: '+info.timeStr);
                            if (moment(startDate).isBefore(moment())) {
                                Swal.fire(
                                    'Ooops!',
                                    'No puedes reservar horas durante días que ya transcurrieron',
                                    'error'
                                )
                            } else {
                                console.log(startDate.isoWeekday());
                                if (startDate.isoWeekday() == 6 || startDate.isoWeekday() == 7) {
                                    Swal.fire(
                                        'Ooops!',
                                        'No puedes reservar horas durante los fines de semana',
                                        'error'
                                    )
                                } else {
                                    @this.set('open', true);
                                    var pid = document.getElementById('pid').value;
                                    pid = parseInt(pid);
                                    console.log("pid");
                                    console.log(pid);
                                    var fecha = new Date(info.dateStr + 'T00:00:00');
                                    console.log(fecha);

                                    var date1 = fecha.getFullYear();
                                    var date2 = fecha.getMonth();
                                    var date3 = fecha.getDate();
                                    date2 = date2 + 1;
                                    console.log(date2);

                                    document.getElementById("btn_reserva")
                                        .addEventListener("click",
                                            function() {
                                                var startTime = document.getElementById(
                                                        'datetimepicker5')
                                                    .value;
                                                console.log(startTime);
                                                var description = document.getElementById(
                                                        'motivo_reserva')
                                                    .value;
                                                console.log(startTime);



                                                /*calendar.addEvent({
                                                    title: "Nuevo Evento",
                                                    start: date,
                                                    description: description
                                                });*/

                                                var token = document.getElementById("_token")
                                                    .value;

                                                console.log(token);

                                                @this.checkDate(fecha, startTime, pid, date1, date2,
                                                    date3, description);
                                            }
                                        );
                                }
                            }
                        },
                        eventClick: function(info) {
                            var reserva = info.event;
                            console.log(reserva);
                            @this.editReserva(reserva);
                            document.getElementById('btn_edit_reserva').addEventListener("click",
                                function() {
                                    var editFecha = document.getElementById(
                                        'datetimepickerFecha').value;
                                    var editHora = document.getElementById('datetimepickerEdit')
                                        .value;
                                    console.log(editHora);
                                    @this.updateReserva(editFecha, editHora);
                                    calendar.refetchEvents();
                                });
                            document.getElementById("btn_delete_reserva").addEventListener("click",
                                function() {
                                    @this.set('openEditModal', false);
                                    @this.set('openDelModal', true);
                                    document.getElementById("btn_destroy_reserva")
                                        .addEventListener("click",
                                            function() {
                                                @this.destroyReserva();
                                            });
                                });
                        },
                        loading: function(isLoading) {
                            if (!isLoading) {
                                //resetear eventos
                                this.getEvents().forEach(function(e) {
                                    if (e.source === null) {
                                        e.remove();
                                    }
                                });
                            }
                        }
                    });
                    calendar.render();
                    @this.on('refreshCalendar', () => {
                        calendar.refetchEvents()
                    });
                });
            });
        </script>

        <script type="text/javascript">
            jQuery.datetimepicker.setLocale('es');
            jQuery('#datetimepicker5').datetimepicker({
                i18n: {
                    de: {
                        months: [
                            'Enero', 'Febrero', 'Marzo', 'Abril',
                            'Mayo', 'Junio', 'Julio', 'Agosto',
                            'Septiembre', 'Octubre', 'Noviembre', 'Diciembre',
                        ],
                        dayOfWeek: [
                            "So.", "Mo", "Di", "Mi",
                            "Do", "Fr", "Sa.",
                        ]
                    }
                },
                container: '#datetimepicker5',
                orientation: "auto-top",
                datepicker: false,
                timepicker: true,
                minTime: '10:00:00',
                maxTime: '20:00:00',
                format: 'H:i'
            });
        </script>
        <!-- Time picker edición -->
        <script type="text/javascript">
            jQuery.datetimepicker.setLocale('es');
            jQuery('#datetimepickerEdit').datetimepicker({
                i18n: {
                    de: {
                        months: [
                            'Enero', 'Febrero', 'Marzo', 'Abril',
                            'Mayo', 'Junio', 'Julio', 'Agosto',
                            'Septiembre', 'Octubre', 'Noviembre', 'Diciembre',
                        ],
                        dayOfWeek: [
                            "So.", "Mo", "Di", "Mi",
                            "Do", "Fr", "Sa.",
                        ]
                    }
                },
                container: '#datetimepickerEdit',
                orientation: "auto-top",
                datepicker: false,
                timepicker: true,
                minTime: '10:00:00',
                maxTime: '20:00:00',
                format: 'H:i'
            });
        </script>
        <!-- DateTimePicker cambio de fecha MODAL EDIT -->
        <script type="text/javascript">
            jQuery.datetimepicker.setLocale('es');
            jQuery('#datetimepickerFecha').datetimepicker({
                i18n: {
                    de: {
                        months: [
                            'Enero', 'Febrero', 'Marzo', 'Abril',
                            'Mayo', 'Junio', 'Julio', 'Agosto',
                            'Septiembre', 'Octubre', 'Noviembre', 'Diciembre',
                        ],
                        dayOfWeek: [
                            "So.", "Mo", "Di", "Mi",
                            "Do", "Fr", "Sa.",
                        ]
                    }
                },
                container: '#datetimepickerFecha',
                orientation: "auto-top",
                datepicker: true,
                timepicker: false,
                format: 'd-m-Y'
            });
        </script>
        <script type="text/javascript">
            $('#idPsicologo').select2()
        </script>
    @endpush
</div>
