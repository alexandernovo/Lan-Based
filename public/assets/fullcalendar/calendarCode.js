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
        slotDuration: '01:00:00',
        contentHeight: 'auto',
        eventColor: '#198754',
        allDaySlot: false,
        events: function (start, end, timezone, callback) {
            $.ajax({
                url: 'ajax/getActivities.php?activities_ajax',
                type: "GET",
                success: function (response) {
                    response = JSON.parse(response);
                    console.log(response);
                    if (response.status == "success") {
                        var events = [];
                        $.each(response.data, function (i, item) {
                            let dueDate = new Date(item.dueDate);
                            dueDate.setMinutes(dueDate.getMinutes() + dueDate.getTimezoneOffset());
                            let isoString = dueDate.toISOString();
                            let options = {
                                year: 'numeric',
                                month: 'short',
                                day: 'numeric',
                            };
                            let dueDateFormatted = dueDate.toLocaleString('en-PH', options);
                            events.push({
                                id: item.activity_id,
                                title: `${item.activity_title}\n${dueDateFormatted}\n`,
                                start: item.dueDate,
                                allDay: false
                            });
                        });
                        callback(events);
                    } else {
                        console.log('No Avail Sched');
                    }
                },
                error: function (xhr, status, error) {
                    console.log('No Avail Sched');
                }
            });
        },
        eventClick: function (event, jsEvent, view) {
            $.ajax({
                url: `ajax/getActivities.php?activities_ajax_details&activity_id=${event.id}`,
                type: "GET",
                success: function (response) {
                    response = JSON.parse(response);
                    modalShowing(response.data);
                },
                error: function (xhr, status, error) {
                    console.log('No Avail Sched');
                }
            });
        }
    });
});



function modalShowing(data) {
    const href = data.activity_type == "activity"
        ? `index.php?page=activity&activity_id=${data.activity_id}&class_id=${data.class_id}`
        : `index.php?page=questions activity&activity_id=${data.activity_id}&class_id=${data.class_id}`;

    const modalHtml = `
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                    <i class="fa fa-cubes"></i>
                    ${data.activity_title}</h5>
                    <button type="button" class="close btn btn-transparent close-button mb-0 rounded-circle" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>${data.activity_description}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-button" data-dismiss="modal">Close</button>
                    <a href="${href}" class="btn btn-primary">
                        <i class="fa fa-arrow-right" ></i>
                         Go to Activity
                    </a>
                </div>
            </div>
        </div>
    </div>
    `;
    $('body').append(modalHtml);
    $('#myModal').modal('show');

    $('#myModal').on('hidden.bs.modal', function () {
        $(this).remove();
    });

    $('#myModal').on('click', '.close-button', function () {
        $('#myModal').modal('hide');
    });
}
