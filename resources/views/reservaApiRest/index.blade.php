<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <button type="button" class="py-2 px-4 bg-red-500 m-4 text-white font-semibold rounded-md"
                    id="btnShow">Show</button>
                <div id="calendar" class="p-4"></div>
            </div>
        </div>
    </div>
</x-app-layout>


<!-- MODAL CREAR RESERVA -->
<div class="min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-no-repeat bg-center bg-cover hidden"
    id="modal-id">
    <div class="absolute bg-gray-100 opacity-80 inset-0 z-0" id="overlay"></div>
    <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
        <p class="text-lg mt-2">Reservar Hora</p>
        <!--content-->
        <div class="">
            <!--body-->
            <form action="">
                {!! csrf_field() !!}
                <div class="mt-4">
                    <input type="hidden" name="pid" id="pid" value="{{ $paciente->id_psicologo }}">
                    <x-jet-label value="Hora Reserva: " />
                    <input type="text" class="datetimepicker-input border rounded-md border-gray-300"
                        id="regHoraReserva" data-toggle="datetimepicker" data-target="#regHoraReserva" readonly />
                </div>
                <div class="mt-4">
                    <x-jet-label value="Motivo: " />
                    <x-jet-input type="text" class="w-full" id="motivo_reserva" />
                </div>
            </form>

            <!--footer-->
            <div class="p-3 mt-2 text-right md:block bg-gray-200 rounded-sm">
                <button
                    class="mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-md hover:shadow-lg hover:bg-gray-100"
                    id="btn_reserva">
                    Reservar
                </button>
                <button
                    class="mb-2 md:mb-0 bg-red-500 border border-red-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-md hover:shadow-lg hover:bg-red-600"
                    id="cancelBtnReg">Cancelar</button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    let modal = document.getElementById('modal-id');
    let btn = document.getElementById('btnShow');
    let cnclBtnReg = document.getElementById('cancelBtnReg');
    let overlay = document.getElementById('overlay');

    btn.onclick = function() {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    cnclBtnReg.onclick = function() {
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }

    window.onclick = function(event) {
        if (event.target == overlay) {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            events: 'reservaApiRest/mostrar',
            initialView: 'dayGridMonth',
            locale: "es",
            selectable: true,
            eventColor: '#228795',
            eventDisplay: 'block',
            headerToolbar: {
                left: 'prev, next, today',
                center: 'title',
                right: 'dayGridMonth, timeGridWeek, listWeek',
            },
            weekends: true,
            dateClick: function(info, start) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');

                console.log(moment(info));
                var selectDate = info.dateStr;
                var startDate = moment(selectDate);
                console.log(selectDate);
                console.log(startDate);

                var pid = document.getElementById('pid').value;
                console.log(pid);

                var fecha = new Date(info.dateStr + 'T00:00:00');
                console.log(fecha);

                var anio = fecha.getFullYear();
                var mes = fecha.getMonth();
                var dia = fecha.getDate();
                mes = mes+1;
                console.log(dia);

                document.getElementById('btn_reserva').addEventListener("click", function() {
                    var startTime = document.getElementById('regHoraReserva').value;
                    console.log(startTime);
                    var description = document.getElementById('motivo_reserva').value;
                    console.log(description);
                    var token = '{{csrf_token()}}';
                    var data = {selectDate:selectDate, startTime: startTime, description: description, pid: pid, anio:anio, mes:mes, dia:dia, _token:token};
                    $.ajax({
                        type: "POST",
                        url:"{{route('reserva.reservaApiRestPost')}}",
                        data: {data:data},
                        success:function(data){
                            var direccion = "{{route('payment', ['date1' => 'date1', 'date2' => 'date2', 'date3' => 'date3' , 'startTime' => 'startTime' , 'description' => 'description', 'pid' => 'pid', 'paci' => 'paci'])}}";
                            direccion = direccion.replace('date1', data.anio);
                            direccion = direccion.replace('date2', data.mes);
                            direccion = direccion.replace('date3', data.dia);
                            direccion = direccion.replace('startTime', data.startTime);
                            direccion = direccion.replace('description', data.description);
                            direccion = direccion.replace('pid', data.pid);
                            direccion = direccion.replace('paci', data.paci);
                            window.location.href = direccion;
                        }
                    });
                });
            }
        });
        calendar.render();
    });

    jQuery.datetimepicker.setLocale('es');
    jQuery('#regHoraReserva').datetimepicker({
        datepicker: false,
        timepicker: true,
        minTime: '10:00:00',
        maxTime: '20:00:00',
        format: 'H:i'
    });
</script>
