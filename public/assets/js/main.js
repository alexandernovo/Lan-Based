$(document).ready(function () {
  var win = navigator.platform.indexOf("Win") > -1;
  if (win && document.querySelector("#sidenav-scrollbar")) {
    var options = {
      damping: "0.5",
    };
    Scrollbar.init(document.querySelector("#sidenav-scrollbar"), options);
  }
});

$(document).ready(function () {
  const $input = $("#image-upload");
  const $preview = $("#preview-image");
  const $container = $("#image-container");

  $input.on("change", function () {
    const file = this.files[0];
    if (file) {
      const reader = new FileReader();
      reader.addEventListener("load", function () {
        $preview.attr("src", reader.result);
      });
      reader.readAsDataURL(file);
    } else {
      $preview.attr("src", "#");
    }
  });

  $container.on("dragover", function (e) {
    e.preventDefault();
    $container.addClass("dragover");
  });

  $container.on("dragleave", function (e) {
    e.preventDefault();
    $container.removeClass("dragover");
  });

  $container.on("drop", function (e) {
    e.preventDefault();
    $container.removeClass("dragover");
    const file = e.originalEvent.dataTransfer.files[0];
    if (file.type.match(/^image\//)) {
      const reader = new FileReader();
      reader.addEventListener("load", function () {
        $preview.attr("src", reader.result);
      });
      reader.readAsDataURL(file);
    }
  });
});

$(document).ready(function () {
  $("#people").on("click", "#userid_all", function () {
    $(".userid").prop("checked", this.checked);
  });
});

$("#close-broadcast").on("click", function () {
  $("#liveToast").hide();
});

$(document).ready(function () {
  document
    .getElementById("dropdownMenuLink")
    .addEventListener("click", function (event) {
      event.preventDefault();
      var dropdownMenu = this.nextElementSibling;
      if (dropdownMenu.classList.contains("show")) {
        dropdownMenu.classList.remove("show");
      } else {
        dropdownMenu.classList.add("show");
      }
    });

  // Close the dropdown if the user clicks outside of it
  window.addEventListener("click", function (event) {
    var dropdown = document.querySelector(".dropdown-menu");
    if (!event.target.matches("#dropdownMenuLink")) {
      if (dropdown.classList.contains("show")) {
        dropdown.classList.remove("show");
      }
    }
  });
});

function showPopup(id) {
  var $popup = $(`#${id}`);
  $popup.toggleClass("show");
}

$(document).ready(function () {
  $("body").on("click", function (e) {
    $(".popup").each(function () {
      if (!$(e.target).closest(this).length) {
        $(this).removeClass("show");
      }
    });
  });

  // Prevent the popup from closing when clicking inside it
  $(".popup").on("click", function (e) {
    e.stopPropagation();
  });
  $("#dropdownMenuButton").on("click", function (e) {
    e.stopPropagation();
  });
});

$("#submission_disable").on("click", function () {
  $(".submission").prop("disabled", function (_, val) {
    return !val;
  });
});

$("#activity_click").on("click", function () {
  $("#activity_now").toggleClass("d-none");
  $("#activity_edit").toggleClass("d-none");
  if ($("#activity_now").hasClass("d-none")) {
    $(this).text("Cancel Edit");
  } else {
    $(this).text("Edit Submission");
  }
});

$(document).ready(function () {
  $("#copyButton").on("click", function () {
    var buttonText = $(this).attr("class-code");
    navigator.clipboard
      .writeText(buttonText)
      .then(function () {
        alert("Class code has been copied: " + buttonText);
      })
      .catch(function (err) {
        console.error("Could not copy text: ", err);
      });
  });
});

$(".delete-class").on("click", function (e) {
  e.preventDefault();
  let $link = $(this).attr("href");
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Yes, delete this class!",
    customClass: {
      confirmButton: "red-color-confirm",
    },
  }).then((result) => {
    if (result.isConfirmed) {
      location.href = $link;
    }
  });
});

// const submissionForm = document.getElementById("submissionForm");

// submissionForm.addEventListener("change", function (event) {
//   const files = event.target.files;
//   const modifiedDates = [];

//   // The time zone for Manila
//   const manilaTimeZone = "Asia/Manila";

//   for (let i = 0; i < files.length; i++) {
//     const file = files[i];
//     const modifiedDate = file.lastModified || new Date(); // Use lastModified timestamp or current date

//     // Create a Date object using the lastModified timestamp
//     const dateInManila = new Date(modifiedDate);

//     // Adjust the date to Asia/Manila timezone using Intl.DateTimeFormat
//     const formattedDate = new Intl.DateTimeFormat("en-US", {
//       timeZone: manilaTimeZone,
//       year: "numeric",
//       month: "2-digit",
//       day: "2-digit",
//       hour: "2-digit",
//       minute: "2-digit",
//       second: "2-digit",
//       hour12: true,
//     }).format(dateInManila);

//     // Parse the formatted date back into a Date object with the correct time zone offset
//     const manilaDate = new Date(Date.parse(formattedDate + " GMT+0800"));

//     // Convert the date to ISO format (this will be in UTC but with the correct Manila time)
//     modifiedDates.push(manilaDate.toISOString());
//   }

//   // Set the modified dates as hidden inputs to send to the server
//   for (let i = 0; i < modifiedDates.length; i++) {
//     const inputName = `modified_date[]`;
//     const input = document.createElement("input");
//     input.type = "hidden";
//     input.name = inputName;
//     input.value = modifiedDates[i];
//     submissionForm.appendChild(input);
//   }
// });
$(document).ready(function () {
  // Use class selector for form
  $(".submissionForm").on("change", function (event) {
    const files = event.target.files;
    const modifiedDates = [];

    // The time zone for Manila
    const manilaTimeZone = "Asia/Manila";

    for (let i = 0; i < files.length; i++) {
      const file = files[i];
      const modifiedDate = file.lastModified || new Date(); // Use lastModified timestamp or current date

      // Create a Date object using the lastModified timestamp
      const dateInManila = new Date(modifiedDate);

      // Adjust the date to Asia/Manila timezone using Intl.DateTimeFormat
      const formattedDate = new Intl.DateTimeFormat("en-US", {
        timeZone: manilaTimeZone,
        year: "numeric",
        month: "2-digit",
        day: "2-digit",
        hour: "2-digit",
        minute: "2-digit",
        second: "2-digit",
        hour12: true,
      }).format(dateInManila);

      // Parse the formatted date back into a Date object with the correct time zone offset
      const manilaDate = new Date(Date.parse(formattedDate + " GMT+0800"));

      // Convert the date to ISO format (this will be in UTC but with the correct Manila time)
      modifiedDates.push(manilaDate.toISOString());
    }

    // Set the modified dates as hidden inputs to send to the server
    for (let i = 0; i < modifiedDates.length; i++) {
      const inputName = `modified_date[]`;
      const input = $("<input>", {
        type: "hidden",
        name: inputName,
        value: modifiedDates[i],
      });

      // Append the input to the form
      $(".submissionForm").append(input);
    }
  });
});

$(document).on("click", ".redirectClass", function () {
  let route = $(this).attr("href");
  window.location.href = route;
});

function getQueryParam(param) {
  const urlParams = new URLSearchParams(window.location.search);
  return urlParams.get(param);
}

const pagesRestricted = [
  "work",
  "class work",
  "people",
  "lab activities",
  "questions",
  "materials",
  "activity",
  "questions activity",
];

function getDateTimeSchedMatic(class_id) {
  $.ajax({
    url: "./ajax/getSchedules.php",
    method: "POST",
    data: {
      geTimeRedirect: true,
      class_id: class_id,
    },
    dataType: "json",
    success: function (response) {
      if (response.status == "success") {
        if (response.result == false) {
          window.location.href = "?page=classes";
        }
      }
    },
    error: function (xhr, status, error) {
      console.error("AJAX Error:", error);
    },
  });
}

function redirectIfNoAccess() {
  let page = getQueryParam("page");
  let class_id = getQueryParam("class_id");
  console.log(page);
  if (page && pagesRestricted.includes(page) && class_id) {
    getDateTimeSchedMatic(class_id);
  }
}

$(document).ready(function () {
  redirectIfNoAccess();
});
