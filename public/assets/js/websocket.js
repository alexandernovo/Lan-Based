let ws; // Define the WebSocket variable

fetch('config.json')
    .then(response => response.json())
    .then(data => {
        var ipAddress = data.ip_address;
        ws = new WebSocket(`ws://${ipAddress}:8090`);
        ws.onopen = () => {
            console.log('Connected to WebSocket server');
        };

        ws.onmessage = (event) => {
            let message = JSON.parse(event.data);
            if (message.name === 'announcement') {
                console.log("announce");
                let announcementData = message.data;
                let user_id = localStorage.getItem('user_id');
                getNotifNumber();
                getNotifData();
                console.log('Received announcement:', announcementData);
                $("#title_announcement").text(announcementData.title)
                $("#description_announcement").text(announcementData.description)
                $("#liveToast").show();
                setTimeout(() => {
                    $("#liveToast").hide();
                }, 4000)
            }
            else if (message.name === 'notification') {
                console.log("notif");
                let user_id = localStorage.getItem('user_id');
                if (user_id == message.data.user_id) {
                    getNotifNumber();
                    getNotifData();
                    $("#title_announcement").text(message.data.title)
                    $("#description_announcement").text(message.data.description)
                    $("#liveToast").show();
                    setTimeout(() => {
                        $("#liveToast").hide();
                    }, 4000)
                }

            }
            else {
                console.log('Received message:', message);
            }
        };
    })
    .catch(error => {
        console.error('Error:', error);
    });

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
                success("Please wait for the teacher to accept your request");
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
                            <a class="dropdown-item border-radius-md" href="javascript:;">
                                <div class="d-flex py-1">
                                    <div class="my-auto">
                                        <i class="fa fa-bell" style="font-size:25px; margin-right:10px"></i>
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-1">
                                            <span class="font-weight-bold">${notification.notification_title}</span>
                                            </br>
                                            <span>${notification.notification_description}</span>
                                        </h6>
                                        <p class="text-xs text-secondary mb-0">
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



getNotifNumber();
getNotifData();