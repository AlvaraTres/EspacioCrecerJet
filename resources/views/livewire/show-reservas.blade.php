<div>
    <div id="calendar">

    </div>

    <!-- MODAL DE CREAR RESERVAS -->
    <x-jet-dialog-modal wire:model="open" id="reg_res">
        <x-slot name="title">
            Reservar Hora
        </x-slot>

        <x-slot name="content">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token">
            <x-jet-label value="Fecha de Reserva: " />
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
            <x-jet-danger-button wire:click="cancelarEdit" wire:loading.attr="disabled" class="disabled:opacity-25">
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
                        console.log(moment(info));
                        var selectDate = info.dateStr;
                        var startDate = moment(selectDate);
                        //alert('Click: '+info.timeStr);
                        if (moment(startDate).isBefore(moment())) {
                            alert('No puedes reservar hora para fechas pasadas.');
                        } else {
                            console.log(startDate.isoWeekday());
                            if (startDate.isoWeekday() == 6 || startDate.isoWeekday() == 7) {
                                alert('No puedes reservar hora durante fines de semana');
                            } else {
                                @this.set('open', true);
                                var date = new Date(info.dateStr + 'T00:00:00');
                                //alert(description);
                                document.getElementById("btn_reserva").addEventListener("click",
                                    function() {
                                        var startTime = document.getElementById('datetimepicker5')
                                            .value;
                                        var description = document.getElementById('motivo_reserva')
                                            .value;
                                        console.log(startTime);
                                        console.log(description);
                                        /*calendar.addEvent({
                                            title: "Nuevo Evento",
                                            start: date,
                                            description: description
                                        });*/

                                        var token = document.getElementById("_token").value;
                                        console.log(token);
                                        $.ajax({
                                            url: 'payment/{date}/{startTime}/{description}',
                                            method: 'POST',
                                            data: {
                                                   'date' : date, 
                                                   'startTime': startTime,
                                                   'description' : description,
                                                   '_token': token
                                            },
                                            success: function(response){
                                                console.log(description);
                                            },
                                            error: function(jqXHR, textStatus, errorThrown){
                                                console.log(JSON.stringify(jqXHR));
                                                console.log("AJAX ERROR: " + textStatus + ' : ' + errorThrown);
                                            }
                                        }).done(function(res){
                                            var direccion = "{{route('payment', ['date' => 'date' , 'startTime' => 'startTime', 'description' => 'description'])}}";
                                            direccion = direccion.replace('date', date);
                                            direccion = direccion.replace('startTime', startTime);
                                            direccion = direccion.replace('description', description);
                                            console.log(direccion);
                                            location.href = direccion;
                                        });

                                        calendar.refetchEvents();
                                    }
                                );
                            }
                        }
                    },
                    eventClick: function(info) {
                        var reserva = info.event;
                        console.log(reserva);
                        @this.editReserva(reserva);
                        @this.set('openEditModal', true);
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
    @endpush
</div>
