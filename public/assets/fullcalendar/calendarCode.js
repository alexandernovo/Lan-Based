$(document).ready(function () {
    var calendar = $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
        },
        defaultView: 'agendaWeek',
        selectable: true,
        selectHelper: true,
        slotLabelInterval: '00:30:00',
        minTime: '07:30:00',
        maxTime: '17:00:00',
        slotDuration: '00:30:00',
        contentHeight: 'auto',
        eventColor: 'red',
        allDaySlot: false,
    });
});


