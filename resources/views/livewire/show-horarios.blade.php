<div>
    <!-- MODAL CREACION DE HORARIO -->
    <x-jet-dialog-modal wire:model="open" id="reg_hor">
        <x-slot name="title">
            Registrar Horario
        </x-slot>

        <x-slot name="content">
            <x-jet-label value="Hora Inicio: " />
            <input type="text" class="datetimepicker-input border rounded-md border-gray-300" id="hora_inicio"
                data-toggle="datetimepicker" data-target="#hora_inicio" />
            <x-jet-input-error for="hora_inicio" />

            <x-jet-label class="mt-4" value="Hora Fin: " />
            <input type="text" class="datetimepicker-input border rounded-md border-gray-300" id="hora_fin"
                data-toggle="datetimepicker" data-target="#hora_fin" />
            <x-jet-input-error for="hora_fin" />
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:loading.attr="disabled" class="disabled:opacity-25" id="btn_regis">Registrar
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="$set('open', false)" wire:loading.attr="disabled"
                class="disabled:opacity-25">Cancelar</x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>

    <!-- MODAL EDICIÓN DE HORARIO -->
    <x-jet-dialog-modal wire:model="openEditModal" id="edit_hor">
        <x-slot name="title">
            Registrar Horario
        </x-slot>

        <x-slot name="content">
            <x-jet-label value="Hora Inicio: " />
            <input type="text" wire:model.defer="hora_inicio"
                class="datetimepicker-input border rounded-md border-gray-300" id="hora_inicioEdit"
                data-toggle="datetimepicker" data-target="#hora_inicioEdit" />
            <x-jet-input-error for="hora_inicio" />

            <x-jet-label class="mt-4" value="Hora Fin: " />
            <input type="text" wire:model.defer="hora_fin"
                class="datetimepicker-input border rounded-md border-gray-300" id="hora_finEdit"
                data-toggle="datetimepicker" data-target="#hora_finEdit" />
            <x-jet-input-error for="hora_fin" />
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:loading.attr="disabled" class="disabled:opacity-25 bg-blue-500 text-white"
                id="btn_del">
                Eliminar Horario
            </x-jet-secondary-button>
            <x-jet-secondary-button wire:loading.attr="disabled" class="disabled:opacity-25" id="btn_edit">Editar
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="cancelarEdit" wire:loading.attr="disabled" class="disabled:opacity-25">
                Cancelar</x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>

    <!-- MODAL DE DELETE RESERVAS -->
    <x-jet-dialog-modal wire:model="openDelModal" id="del_res">
        <x-slot name="title">
            Eliminar Horario
        </x-slot>

        <x-slot name="content">
            ¿Estás seguro de eliminar el horario seleccionado?
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:loading.attr="disabled" class="disabled:opacity-25" id="btn_destroy_horario">
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
                var CalendarEl = document.getElementById('calendar');
                var data = @this.events;
                console.log(data);

                var calendar = new FullCalendar.Calendar(CalendarEl, {
                    events: JSON.parse(data),
                    initialView: 'dayGridMonth',
                    locale: "es",
                    selectable: true,
                    eventDisplay: 'block',
                    headerToolbar: {
                        left: 'prev, next, today',
                        center: 'title',
                        right: 'dayGridMonth, timeGridWeek, listWeek',
                    },
                    weekends: true,

                    dateClick: function(info) {
                        console.log(info.dateStr);

                        var selectDate = info.dateStr;
                        var startDate = moment(selectDate);
                        console.log(startDate);
                        if (moment(startDate).isBefore(moment())) {
                            Swal.fire(
                                'Ooops!',
                                'No puedes asignar un horario a un dia que ya transcurrió.',
                                'error'
                            )
                        } else {
                            if (startDate.isoWeekday() == 6 || startDate.isoWeekday() == 7) {
                                Swal.fire(
                                    'Ooops!',
                                    'No puedes asignar un horario a un fin de semana.',
                                    'error'
                                )
                            } else {
                                @this.set('open', true);
                                var date = new Date(info.dateStr + 'T00:00:00');
                                document.getElementById('btn_regis').addEventListener("click", function() {
                                    var startTime = document.getElementById('hora_inicio').value;
                                    var endTime = document.getElementById('hora_fin').value;
                                    //console.log(endTime);
                                    @this.storeHorario(date, startTime, endTime);
                                    calendar.refetchEvents();
                                });
                            }

                        }


                    },

                    eventClick: function(info) {
                        var horario = info.event;
                        console.log(info.event.start);
                        var startevent = moment(info.event.start);
                        console.log(startevent);
                        if (moment(startevent).isBefore(moment())) {
                            Swal.fire(
                                'Ooops!',
                                'No puedes editar un horario de un día que ya transcurrió.',
                                'error'
                            )
                        } else {
                            @this.editHorario(horario);
                            @this.set('openEditModal', true);
                            document.getElementById('btn_edit').addEventListener("click", function() {
                                var editHoraIni = document.getElementById('hora_inicioEdit').value;
                                var editHoraFin = document.getElementById('hora_finEdit').value;
                                @this.updateHorario(editHoraIni, editHoraFin);
                                calendar.refetchEvents();
                            });
                            document.getElementById('btn_del').addEventListener("click", function() {
                                @this.set('openEditModal', false);
                                @this.set('openDelModal', true);
                                document.getElementById("btn_destroy_horario").addEventListener(
                                    "click",
                                    function() {
                                        @this.destroyHorario();
                                    });
                            });
                        }

                    }
                });
                @this.on('refreshCalendar', () => {
                    calendar.refetchEvents()
                });
                calendar.render();
            });
        </script>
        <script type="text/javascript">
            jQuery.datetimepicker.setLocale('es');
            jQuery('#hora_inicio').datetimepicker({
                format: 'H:i',
                allowTimes: ['10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00',
                    '20:00'
                ],
                onShow: function(ct) {
                    this.setOptions({
                        maxTime: jQuery('#hora_fin').val() ? jQuery('#hora_fin').val() : false,
                    })
                },
                datepicker: false,
            });
            jQuery('#hora_fin').datetimepicker({
                format: 'H:i',
                allowTimes: ['10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00',
                    '20:00'
                ],
                onShow: function(ct) {
                    this.setOptions({
                        minTime: jQuery('#hora_inicio').val() ? jQuery('#hora_inicio').val() : false,
                    })
                },
                datepicker: false,
            });
        </script>
        <script type="text/javascript">
            jQuery.datetimepicker.setLocale('es');
        </script>
        <script type="text/javascript">
            jQuery.datetimepicker.setLocale('es');
            jQuery('#hora_inicioEdit').datetimepicker({
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
                container: '#hora_inicioEdit',
                orientation: "auto-top",
                datepicker: false,
                timepicker: true,
                minTime: '10:00:00',
                maxTime: '20:00:00',
                format: 'H:i'
            });
        </script>
        <script type="text/javascript">
            jQuery.datetimepicker.setLocale('es');
            jQuery('#hora_finEdit').datetimepicker({
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
                container: '#hora_finEdit',
                orientation: "auto-top",
                datepicker: false,
                timepicker: true,
                minTime: '10:00:00',
                maxTime: '21:00:00',
                format: 'H:i'
            });
        </script>
    @endpush
</div>
