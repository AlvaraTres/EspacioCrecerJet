document.addEventListener('DOMContentLoaded', function () {
    var Calendar = FullCalendar.Calendar;
    var Draggable = FullCalendar.Draggable;
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale:"es",

        headerToolbar:{
            left: 'prev, next, today',
            center: 'title',
            right: 'dayGridMonth, timeGridWeek, listWeek',
        },

        dateClick:function(info){
            Livewire.on('abrirModalRegistro');
            //alert(open);
            var date = new Date(info.dateStr + 'T00:00:00');
            
        }
    });
    calendar.render();
});