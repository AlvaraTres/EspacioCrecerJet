<div>
    <div id="calendar">

    </div>

    <!-- MODAL DE CREAR RESERVAS -->
    <x-jet-dialog-modal wire:model="open" id="reg_res">
        <x-slot name="title">
            Reservar Hora
        </x-slot>

        <x-slot name="content">
            <x-jet-label value="Fecha de Reserva: " />
            <x-jet-label value="Hora Reserva:" />            
            <input type="text" class="datetimepicker-input border rounded-md border-gray-300" id="datetimepicker5" data-toggle="datetimepicker"
                data-target="#datetimepicker5" />
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
            <input type="text" wire:model.defer="fecha_reserva" class="datetimepicker-input border rounded-md border-gray-300" id="datetimepickerFecha" data-toggle="datetimepicker"
                data-target="#datetimepickerFecha" />

            <x-jet-label value="Hora Reserva:" />            
            <input type="text" wire:model.defer="hora_reserva" class="datetimepicker-input border rounded-md border-gray-300" id="datetimepickerEdit" data-toggle="datetimepicker"
                data-target="#datetimepickerEdit" />
            <x-jet-input-error for="hora_reserva" />
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:loading.attr="disabled" class="disabled:opacity-25" id="btn_delete_reserva">Cancelar Reserva
            </x-jet-secondary-button>
            <x-jet-secondary-button wire:loading.attr="disabled" class="disabled:opacity-25 bg-blue-500 text-white" id="btn_edit_reserva">Modificar Reserva
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="cancelarEdit" wire:loading.attr="disabled"
                class="disabled:opacity-25">Cancelar</x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>

    @push('js')
        <script>
            document.addEventListener('livewire:load', function() {
                var Calendar = FullCalendar.Calendar;
                var Draggable = FullCalendar.Draggable;
                var calendarEl = document.getElementById('calendar');
                var data = @this.events;
                console.log(data);
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    events: JSON.parse(data),
                    initialView: 'dayGridMonth',
                    locale: "es",

                    headerToolbar: {
                        left: 'prev, next, today',
                        center: 'title',
                        right: 'dayGridMonth, timeGridWeek, listWeek',
                    },

                    dateClick: function(info) {
                        //alert('Click: '+info.timeStr);
                        @this.set('open', true);
                        var date = new Date(info.dateStr + 'T00:00:00');
                        //alert(description);
                        document.getElementById("btn_reserva").addEventListener("click", function() {
                            var startTime = document.getElementById('datetimepicker5').value;
                            var description = document.getElementById('motivo_reserva').value;
                            console.log(startTime);
                            calendar.addEvent({
                                title: "Nuevo Evento",
                                start: date,
                                description: description
                            });

                            var eventAdd = {
                                title: "Nuevo Evento",
                                start: date,
                                description: description
                            };
                            @this.storeReserva(eventAdd, startTime);
                            calendar.refetchEvents();
                        });
                    },
                    eventClick: function(info){
                        var reserva = info.event;
                        console.log(reserva);
                        @this.editReserva(reserva);
                        @this.set('openEditModal', true);
                        document.getElementById('btn_edit_reserva').addEventListener("click", function(){
                           var editFecha = document.getElementById('datetimepickerFecha').value;
                           var editHora = document.getElementById('datetimepickerEdit').value;
                           console.log(editHora);
                           @this.updateReserva(editFecha, editHora);
                           calendar.refetchEvents();
                        });
                    },
                    loading: function(isLoading){
                        if(!isLoading){
                            //resetear eventos
                            this.getEvents().forEach(function(e){
                                if(e.source === null){
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
