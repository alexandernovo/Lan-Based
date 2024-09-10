
function sendAnnouncement(announcementData) {
    // Create the announcement message object
    let message = {
        name: "announcement", // Specify the name of the message type
        data: announcementData // Include the announcement data
    };

    ws.send(JSON.stringify(message));
}

function sendNotif(announcementData) {
    // Create the announcement message object
    let message = {
        name: 'notification', // Specify the name of the message type
        data: announcementData // Include the announcement data
    };

    ws.send(JSON.stringify(message));
}



$("#announcement_form").on("submit", function (e) {
    e.preventDefault();

    // Check form validity
    if (!this.checkValidity()) {
        return;
    }

    let $title = $('#announcement_title').val();
    let $description = $('#announcement_description').val();

    let content = {
        title: $title,
        description: $description,
        name: "announcement"
    };

    sendAnnouncement(content);
    saveAnnouncement();
});

const saveAnnouncement = () => {
    var formData = {
        add_announcement: true,
        announcement_title: $("#announcement_title").val(),
        announcement_description: $("#announcement_description").val(),
        user_id: $("#user_id").val(),
        announcement_type: "stream",
        class_id: $("#user_id").attr('class-id')
    };

    $.ajax({
        url: "actions/manage_announcement.php",
        type: "POST",
        data: formData,
        success: function (response) {
            if (response.status == "success") {
                location.reload();
            }
        },
        error: function (xhr, status, error) {
            console.error("Error:", error);
        }
    });
}


$('#join_class').on('submit', function (e) {
    e.preventDefault();

    // Create FormData object to collect form data
    let formData = new FormData(this);

    $.ajax({
        url: "actions/manage_class.php",
        type: "POST",
        data: formData,
        processData: false,  // Prevent jQuery from processing the data
        contentType: false,  // Prevent jQuery from setting contentType
        success: function (response) {
            if (response.status == "success") {
                let $notif = response.data;
                let content = {
                    name: 'notification',
                    title: $notif.title,
                    description: $notif.description,
                    user_id: $notif.user_id
                };
                sendNotif(content);
                // success("Please wait for the teacher to accept your request");
                success("You have join the class successfully");
                // setTimeout(() => {
                //     location.reload();  // Reload the page on success
                // }, 1500);
            }
        },
        error: function (xhr, status, error) {
            console.error("Error:", error);
        }
    });
});

$("#approved").on("submit", function (e) {
    e.preventDefault();
    let formData = new FormData(this);

    $.ajax({
        url: "actions/manage_people.php",
        type: "POST",
        data: formData,
        processData: false,  // Prevent jQuery from processing the data
        contentType: false,  // Prevent jQuery from setting contentType
        success: function (response) {
            if (response.status == "success") {
                let $notif = response.data;
                let content = {
                    name: 'notification',
                    title: $notif.title,
                    description: $notif.description,
                    user_id: $notif.user_id
                };
                sendNotif(content);
                // success("Please wait for the teacher to accept your request");
                setTimeout(() => {
                    location.reload();  // Reload the page on success
                }, 1000);
            }
        },
        error: function (xhr, status, error) {
            console.error("Error:", error);
        }
    });
});

$("#add_activity").on("submit", function (e) {
    e.preventDefault();
    let formData = new FormData(this);
    formData.append("add_activity", true);

    $.ajax({
        url: "actions/manage_activity.php",
        type: "POST",
        data: formData,
        processData: false,  // Prevent jQuery from processing the data
        contentType: false,  // Prevent jQuery from setting contentType
        success: function (response) {
            if (response.status == "success") {
                let $notif = response.data;

                let content = {
                    title: $notif.title,
                    description: $notif.description,
                    name: "announcement"
                };

                sendAnnouncement(content);
                success("Activity Created Successfully");
                setTimeout(() => {
                    location.href = $notif.route;
                }, 1000);
            }
            else {
                location.href = $notif.route;
            }
        },
        error: function (xhr, status, error) {
            console.error("Error:", error);
        }
    });
});

$("#add_question").on("submit", function (e) {
    e.preventDefault();
    let formData = new FormData(this);
    formData.append("add_question", true);

    $.ajax({
        url: "actions/manage_activity.php",
        type: "POST",
        data: formData,
        processData: false,  // Prevent jQuery from processing the data
        contentType: false,  // Prevent jQuery from setting contentType
        success: function (response) {
            if (response.status == "success") {
                let $notif = response.data;

                let content = {
                    title: $notif.title,
                    description: $notif.description,
                    name: "announcement"
                };

                sendAnnouncement(content);
                success("Activity Created Successfully");
                setTimeout(() => {
                    location.href = $notif.route;
                }, 1000);
            }
            else {
                location.href = $notif.route;
            }
        },
        error: function (xhr, status, error) {
            console.error("Error:", error);
        }
    });
});

$("#reject").on("submit", function (e) {
    e.preventDefault();
    let formData = new FormData(this);

    $.ajax({
        url: "actions/manage_people.php",
        type: "POST",
        data: formData,
        processData: false,  // Prevent jQuery from processing the data
        contentType: false,  // Prevent jQuery from setting contentType
        success: function (response) {
            if (response.status == "success") {
                let $notif = response.data;
                let content = {
                    name: 'notification',
                    title: $notif.title,
                    description: $notif.description,
                    user_id: $notif.user_id
                };
                sendNotif(content);
                // success("Please wait for the teacher to accept your request");
                setTimeout(() => {
                    location.reload();  // Reload the page on success
                }, 1000);
            }
        },
        error: function (xhr, status, error) {
            console.error("Error:", error);
        }
    });
});

function success(message) {
    Swal.fire({
        title: 'Success',
        text: message,
        icon: 'success',
        confirmButtonText: 'Yes',
        cancelButtonText: false
    })
}

function getNotifNumber() {
    $.ajax({
        url: `actions/manage_notification.php?notification_id=${user_id}&count`,
        type: "GET",
        success: function (response) {
            response = JSON.parse(response);
            console.log(response.status);
            if (response.status == "success") {
                let notif = response.data;
                console.log(notif.number);
                $("#notif_num").text(notif.number);
            }
        },
        error: function (xhr, status, error) {
            console.error("Error:", error);
        }
    });
}

function getNotifData() {
    $.ajax({
        url: `actions/manage_notification.php?notification_id=${user_id}&notif_data`,
        type: "GET",
        success: function (response) {
            response = JSON.parse(response);
            console.log(response.status);
            if (response.status == "success") {
                let notifications = response.data; // Assuming response.data is an array of notifications

                // Clear existing notifications in #notif container
                $('#notif').empty();

                // Map over the notifications array to generate the HTML for each notification
                let notifItems = notifications.map(notification => {
                    let date = new Date(notification.notification_datetime);
                    let formattedDate = date.toLocaleString('en-US', {
                        month: 'short',
                        day: 'numeric',
                        year: 'numeric',
                        hour: 'numeric',
                        minute: 'numeric',
                        hour12: true
                    });

                    return `
                        <li class="mb-2">
                            <button type="button" class="dropdown-item border-radius-md" style="${notification.is_read == 1 ? "background-color:lightgray" : ""}" onclick="redirectTo(${notification.included_id}, ${notification.activity_id}, '${notification.notification_type}', ${notification.notification_id})" style="color:black !important">
                                <div class="d-flex py-1">
                                    <div class="my-auto">
                                        <i class="fa fa-bell text-dark" style="font-size:25px; margin-right:10px" style="color:black !important"></i>
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-1 text-dark" style="color:black !important">
                                            <span class="font-weight-bold">${notification.notification_title}</span>
                                            </br>
                                            <span>${notification.notification_description}</span>
                                        </h6>
                                        <p class="text-xs text-secondary mb-0 ">
                                            <i class="fa fa-clock me-1"></i>
                                            ${formattedDate}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                    `;
                });

                // Append the generated HTML to the #notif container
                $('#notif').append(notifItems.join(''));
            }
        },
        error: function (xhr, status, error) {
            console.error("Error:", error);
        }
    });
}


function redirectTo(included_id, activity_id, notification_type, notification_id) {
    console.log("hello");
    let result = markRead(notification_id);
    if (result) {
        if (notification_type == "join") {
            location.href = `?page=people&class_id=${included_id}`;
        }
        else if (notification_type == "activity") {
            location.href = `?page=activity&activity_id=${activity_id}&class_id=${included_id}`;
        }
        else if (notification_type == "question") {
            location.href = `?page=activity&questions=${activity_id}&class_id=${included_id}`;
        }
    }
}

function markRead(notif_id) {
    var formData = new FormData();
    formData.append('notif_id', notif_id);
    formData.append('markread', true);

    $.ajax({
        url: "actions/manage_notification.php",
        type: "POST",
        data: formData,
        processData: false, // Prevent jQuery from processing the data
        contentType: false, // Prevent jQuery from setting the content type header
        success: function (response) {
            return true;
        },
        error: function (xhr, status, error) {
            console.error("Error updating notification status:", error);
        }
    });
    return true;
}

getNotifNumber();
getNotifData();