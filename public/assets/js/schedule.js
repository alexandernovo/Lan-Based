let schedule_table;
let schedule_data;
let timesched = [];
let schedule_id;
let day;
let removedtime = [];

let schedule_tableOptions = {
  paging: true,
  processing: false,
  pageLength: 10,
  lengthChange: true,
  searching: true,
  ordering: true,
  info: true,
  autoWidth: false,
  responsive: true,
  serverSide: true,
  language: {
    emptyTable: "No data available in table. (Please search above)",
  },
  columnDefs: [
    {
      title: "Class",
      targets: 0,
      className: "text-start text-sm pe-3 vertical-align-center text-break",
      orderable: false,
      render: function (data, type, row, meta) {
        return `<p class="text-truncate" style="width: 300px !important; font-size: 11px">${row.course} (${row.section}) - ${row.program}</p>`;
      },
    },
    {
      title: "Monday",
      targets: 1,
      className: "vertical-align-center",
      orderable: true,
      render: function (data, type, row, meta) {
        return `
          <div class="d-flex gap-2 align-items-center">
            <input type="checkbox" data-class_id="${row.class_id}"
            ${row.monday && row.monday == 1 ? "checked" : ""}
            data-day="monday" class="cursor-pointer check_schedule" value="1">
            <button ${
              row.monday && row.monday == 1 ? "" : "disabled"
            } data-schedule_id="${row.schedule_id}"
            data-day="monday"
            class="openScheduleTimeModal btn btn-primary mb-0 btn-sm" style="padding: 2px 5px !important">Set Time</button>
          </div>`;
      },
    },
    {
      title: "Tuesday",
      targets: 2,
      className: "vertical-align-center",
      orderable: true,
      render: function (data, type, row, meta) {
        return `
        <div class="d-flex gap-2 align-items-center">
        <input
        ${row.tuesday && row.tuesday == 1 ? "checked" : ""}
        type="checkbox" data-class_id="${
          row.class_id
        }" data-day="tuesday" class="cursor-pointer check_schedule" value="1">
        <button 
        ${row.tuesday && row.tuesday == 1 ? "" : "disabled"}
        data-schedule_id="${
          row.schedule_id
        }" data-day="tuesday" class="openScheduleTimeModal btn btn-primary mb-0 btn-sm" style="padding: 2px 5px !important">Set Time</button>
        </div>`;
      },
    },
    {
      title: "Wednesday",
      targets: 3,
      className: "vertical-align-center",
      orderable: true,
      render: function (data, type, row, meta) {
        return `<div class="d-flex gap-2 align-items-center"><input ${
          row.wednesday && row.wednesday == 1 ? "checked" : ""
        } type="checkbox" data-class_id="${
          row.class_id
        }" data-day="wednesday" class="cursor-pointer check_schedule" value="1"><button ${
          row.wednesday && row.wednesday == 1 ? "" : "disabled"
        } data-schedule_id="${
          row.schedule_id
        }" data-day="wednesday" class="openScheduleTimeModal btn btn-primary mb-0 btn-sm" style="padding: 2px 5px !important">Set Time</button></div>`;
      },
    },
    {
      title: "Thursday",
      targets: 4,
      className: "vertical-align-center",
      orderable: true,
      render: function (data, type, row, meta) {
        return `<div class="d-flex gap-2 align-items-center"><input ${
          row.thursday && row.thursday == 1 ? "checked" : ""
        } type="checkbox" data-class_id="${
          row.class_id
        }" data-day="thursday" class="cursor-pointer check_schedule" value="1"><button ${
          row.thursday && row.thursday == 1 ? "" : "disabled"
        } data-schedule_id="${
          row.schedule_id
        }" data-day="thursday" class="openScheduleTimeModal btn btn-primary mb-0 btn-sm" style="padding: 2px 5px !important">Set Time</button></div>`;
      },
    },
    {
      title: "Friday",
      targets: 5,
      className: "vertical-align-center",
      orderable: true,
      render: function (data, type, row, meta) {
        return `<div class="d-flex gap-2 align-items-center"><input ${
          row.friday && row.friday == 1 ? "checked" : ""
        } type="checkbox" data-class_id="${
          row.class_id
        }" data-day="friday" class="cursor-pointer check_schedule" value="1"><button ${
          row.friday && row.friday == 1 ? "" : "disabled"
        } data-schedule_id="${
          row.schedule_id
        }" data-day="friday" class="openScheduleTimeModal btn btn-primary mb-0 btn-sm" style="padding: 2px 5px !important">Set Time</button></div>`;
      },
    },
    {
      title: "Saturday",
      targets: 6,
      className: "vertical-align-center",
      orderable: true,
      render: function (data, type, row, meta) {
        return `<div class="d-flex gap-2 align-items-center"><input ${
          row.saturday && row.saturday == 1 ? "checked" : ""
        } type="checkbox" data-class_id="${
          row.class_id
        }" data-day="saturday" class="cursor-pointer check_schedule" value="1"><button ${
          row.saturday && row.saturday == 1 ? "" : "disabled"
        } data-schedule_id="${
          row.schedule_id
        }" data-day="saturday" class="openScheduleTimeModal btn btn-primary mb-0 btn-sm" style="padding: 2px 5px !important">Set Time</button></div>`;
      },
    },
    {
      title: "Sunday",
      targets: 7,
      className: "vertical-align-center text-center",
      orderable: true,
      render: function (data, type, row, meta) {
        return `<div class="d-flex gap-2 align-items-center"><input ${
          row.sunday && row.sunday == 1 ? "checked" : ""
        } type="checkbox" data-class_id="${
          row.class_id
        }" data-day="sunday" class="cursor-pointer check_schedule" value="1"><button ${
          row.sunday && row.sunday == 1 ? "" : "disabled"
        } data-schedule_id="${
          row.schedule_id
        }" data-day="sunday" class="openScheduleTimeModal btn btn-primary mb-0 btn-sm" style="padding: 2px 5px !important">Set Time</button></div>`;
      },
    },
  ],
  ajax: {
    url: "./ajax/getSchedules.php",
    type: "POST",
    dataType: "json",
    data: {
      table_schedule: true,
    },
    error: function (xhr, status, error) {
      $(".lds-spinner").hide();
      Swal.fire({
        title: "Error!",
        text: "An error occurred while retrieving data. Please input some more information.",
        icon: "error",
      });
    },
    dataSrc: function (json) {
      return json.data;
    },
  },
  drawCallback: function (settings) {
    let api = this.api();
    if (api.rows().count() === 0) {
      $("#schedule_table tbody").html(`
                <tr>
                    <td colspan="10" class="w-100 text-center">No Data Available</td>
                </tr>
            `);
    }
    $(".lds-spinner").hide();
    $("div#schedule_table").css("opacity", "1");
  },
  initComplete: function (settings, json) {
    $(".lds-spinner").hide();
    $("div#schedule_table").css("opacity", "1");
  },
};

function renderschedule_table() {
  destroyTable("schedule_table");
  schedule_table = $("#schedule_table").DataTable(schedule_tableOptions);
}

renderschedule_table();

$(document).on("change", ".check_schedule", function () {
  let day = $(this).data("day");
  let class_id = $(this).data("class_id");
  let status = $(this).is(":checked") ? 1 : 0;
  changeStatusDay(day, class_id, status);
});

function changeStatusDay(day, class_id, status) {
  let data = {
    day: day,
    class_id: class_id,
    change_day: true,
    status: status,
  };

  $.ajax({
    url: "./ajax/getSchedules.php",
    method: "POST",
    data: data,
    success: function (response) {
      reloadTableSchedule();
    },
    error: function (xhr, status, error) {
      console.error("AJAX Error:", error);
    },
  });
}

function destroyTable(id) {
  if ($.fn.DataTable.isDataTable(`#${id}`)) {
    $(`#${id}`).DataTable().clear().destroy();
  }
}

function reloadTableSchedule() {
  if (schedule_table.rows().count() > 1) {
    schedule_table.ajax.reload(null, false);
  } else {
    renderschedule_table();
  }
}

$(document).on("click", ".openScheduleTimeModal", function () {
  schedule_id = $(this).data("schedule_id");
  day = $(this).data("day");
  $("#day_text").text(day);
  getTimeScheds();
  $("#schedule_modal").modal("show");
});

$(document).on("click", "#time_sched_btn", function () {
  timesched.unshift({
    timefrom: "",
    timeto: "",
    scheduletime_id: 0,
    day: day,
  });
  console.log(day);
  populateTime();
});

function populateTime() {
  let timeSchedHTML = "";
  if (timesched.length > 0) {
    timeSchedHTML = timesched
      .map((x, index) => {
        return `
      <div class="d-flex justify-content-between align-items-end gap-2">
        <div class="form-group pe-1 mb-0" style="width: 46%">
          <label>Time From:</label>
          <input data-index="${index}" value="${
          x.timefrom == "00:00:00" ? "" : x.timefrom
        }" class="form-control timeFrom" type="time">
        </div>
        <div class="form-group ps-1 mb-0" style="width: 46%">
          <label>Time To:</label>
          <input data-index="${index}" value="${
          x.timeto == "00:00:00" ? "" : x.timeto
        }" class="form-control timeTo" type="time">
        </div>
        <i data-index="${index}" class="removeTime fa fa-trash text-danger cursor-pointer" style="margin-bottom: 11px"></i>
      </div>  
    `;
      })
      .join("");
  } else {
    timeSchedHTML = `<p class="text-center text-secondary">No Time Available</p>`;
  }
  $("#time_sched_div").html(timeSchedHTML);
}

$(document).on("click", ".removeTime", function () {
  let index = $(this).data("index");
  let data = timesched[index];
  if (data && data.scheduletime_id != 0) {
    removedtime.push(data);
  }
  timesched.splice(index, 1);
  populateTime();
});

$(document).on("change", ".timeFrom", function () {
  let index = $(this).data("index");
  let data = timesched[index];
  if (data) {
    console.log("hello");
    data.timefrom = $(this).val();
  }
});

$(document).on("change", ".timeTo", function () {
  let index = $(this).data("index");
  let data = timesched[index];
  if (data) {
    data.timeto = $(this).val();
  }
});

$("#schedForm").on("submit", function (e) {
  e.preventDefault();
  addOrUpdateTimeSched();
});

function addOrUpdateTimeSched() {
  let data = {
    schedule_id: schedule_id,
    timesched: timesched,
    removedtime: removedtime,
    timesaveupdate: true,
  };
  $.ajax({
    url: "./ajax/getSchedules.php",
    method: "POST",
    data: data,
    dataType: "json",
    success: function (response) {
      if (response.status == "success") {
        $("#schedule_modal").modal("hide");
      }
    },
    error: function (xhr, status, error) {
      console.error("AJAX Error:", error);
    },
  });
}

function getTimeScheds() {
  $.ajax({
    url: "./ajax/getSchedules.php",
    method: "POST",
    dataType: "json",
    data: {
      getTimeScheds: true,
      schedule_id: schedule_id,
      day: day,
    },
    success: function (response) {
      console.log(response.data);
      if (response.status == "success") {
        timesched = response.data;
        populateTime();
      }
    },
    error: function (xhr, status, error) {
      console.error("AJAX Error:", error);
    },
  });
}
