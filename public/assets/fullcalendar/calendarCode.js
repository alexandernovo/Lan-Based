let teacher_list = [];
let calendar;
let user_idteacher = "";

$(document).ready(function () {
  let typeCalendar = $("#calendar").data("type");
  if (typeCalendar == "notadmin") {
    notAdminCalendar();
  } else {
    adminCalendar();
  }
});

function adminCalendar() {
  calendar = $("#calendarAdmin").fullCalendar({
    header: {
      left: "title",
      center: "agendaWeek",
      right: "",
    },
    defaultView: "basicWeek",
    selectable: true,
    selectHelper: false,
    slotLabelInterval: "00:30:00",
    minTime: "07:30:00",
    slotDuration: "01:00:00",
    contentHeight: "auto",
    eventColor: "#198754",
    allDaySlot: false,
    events: function (start, end, timezone, callback) {
      $.ajax({
        url: `ajax/schedules.php?getSchedules&teacher=${user_idteacher}`,
        type: "GET",
        success: function (response) {
          response = JSON.parse(response);
          if (response.status == "success") {
            var events = [];
            $.each(response.data, function (i, item) {
              events.push({
                id: item.scheduletime_id,
                title: `${formatTime(item.timefrom)} - ${formatTime(
                  item.timeto
                )} \n${item.firstname} ${item.lastname}\n${item.course} ${
                  item.section
                } ${item.program}`,
                description: "Hello",
                start: item.timefrom,
                allDay: false,
              });
            });
            callback(events);
          } else {
            console.log("No Avail Sched");
          }
        },
        error: function (xhr, status, error) {
          console.log("No Avail Sched");
        },
      });
    },
    eventClick: function (event, jsEvent, view) {
      $.ajax({
        url: `ajax/schedules.php?schedule_details&scheduletime_id=${event.id}`,
        type: "GET",
        success: function (response) {
          response = JSON.parse(response);
          modalSchedule(response.data);
        },
        error: function (xhr, status, error) {
          console.log("No Avail Sched");
        },
      });
    },
  });
  cleanHeaderText();
}
function cleanHeaderText() {
  $(".fc-day-header").each(function () {
    var text = $(this).text();
    var cleanedText = text.replace(/[0-9\/]/g, "");
    $(this).text(cleanedText);
  });
}

function formatTime(timeString) {
  const date = new Date(timeString);
  return date.toLocaleTimeString([], { hour: "2-digit", minute: "2-digit" });
}

function notAdminCalendar() {
  calendar = $("#calendar").fullCalendar({
    header: {
      left: "prev,next today",
      center: "title",
    },
    defaultView: "agendaWeek",
    selectable: true,
    selectHelper: false,
    slotLabelInterval: "00:30:00",
    minTime: "07:30:00",
    slotDuration: "01:00:00",
    contentHeight: "auto",
    eventColor: "#198754",
    allDaySlot: false,
    events: function (start, end, timezone, callback) {
      $.ajax({
        url: "ajax/getActivities.php?activities_ajax",
        type: "GET",
        success: function (response) {
          response = JSON.parse(response);
          console.log(response);
          if (response.status == "success") {
            var events = [];
            $.each(response.data, function (i, item) {
              let dueDate = new Date(item.dueDate);
              dueDate.setMinutes(
                dueDate.getMinutes() + dueDate.getTimezoneOffset()
              );
              let isoString = dueDate.toISOString();
              let options = {
                year: "numeric",
                month: "short",
                day: "numeric",
              };
              let dueDateFormatted = dueDate.toLocaleString("en-PH", options);
              events.push({
                id: item.activity_id,
                title: `${item.activity_title}\n${dueDateFormatted}\n`,
                start: item.dueDate,
                allDay: false,
              });
            });
            callback(events);
          } else {
            console.log("No Avail Sched");
          }
        },
        error: function (xhr, status, error) {
          console.log("No Avail Sched");
        },
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
          console.log("No Avail Sched");
        },
      });
    },
  });
}
function modalShowing(data) {
  const href =
    data.activity_type == "activity"
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
  $("body").append(modalHtml);
  $("#myModal").modal("show");

  $("#myModal").on("hidden.bs.modal", function () {
    $(this).remove();
  });

  $("#myModal").on("click", ".close-button", function () {
    $("#myModal").modal("hide");
  });
}

function modalSchedule(data) {
  const modalHtml = `
    <div class="modal fade" id="scheduleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                      <i class="fa fa-calendar"></i>
                      Class Schedule
                    </h5>
                    <button type="button" class="close btn btn-transparent close-button mb-0 rounded-circle" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-capitalize mb-1"><span class="fw-bold text-normal">Teacher:</span> ${
                      data.firstname
                    } ${data.lastname}</p>
                    <p class="text-capitalize mb-1"><span class="fw-bold text-normal">Class:</span> ${
                      data.course
                    } ${data.section} ${data.program}</p>
                    <p class="text-capitalize mb-1"><span class="fw-bold text-normal">Class Day:</span> ${
                      data.day
                    }</p>
                    <p><span class="fw-bold">Class time:</span> ${formatTime(
                      data.timefrom
                    )} - ${formatTime(data.timeto)}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-button" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    `;
  $("body").append(modalHtml);
  $("#scheduleModal").modal("show");

  $("#scheduleModal").on("hidden.bs.modal", function () {
    $(this).remove();
  });

  $("#scheduleModal").on("click", ".close-button", function () {
    $("#scheduleModal").modal("hide");
  });
}

function getTeacher() {
  $.ajax({
    url: "./ajax/getTeacher.php?teachers",
    method: "GET",
    dataType: "json",
    success: function (response) {
      if (response.status == "success") {
        teacher_list = response.data;
        let optionHTML = "<option>All</option>";
        let optionHTML2 = response.data
          .map((x) => {
            return `
            <option>${x.firstname} ${x.lastname}</option>
            `;
          })
          .join("");

        console.log(optionHTML + optionHTML2);
        $(".teacher_list").html(optionHTML + optionHTML2);
      }
    },
    error: function (xhr, status, error) {
      console.error("AJAX Error:", error);
    },
  });
}
getTeacher();

$("#teacher_filter").on("input", function () {
  let data = teacher_list.find(
    (x) => `${x.firstname} ${x.lastname}` == $(this).val()
  );

  if (data || $(this).val() == "All") {
    user_idteacher = $(this).val() == "All" ? "All" : data.user_id;
    calendar.fullCalendar("refetchEvents");
  }
});
