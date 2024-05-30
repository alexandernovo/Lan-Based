let ws = new WebSocket('ws://localhost:8090');

ws.onopen = () => {
    console.log('Connected to WebSocket server');
};

ws.onmessage = (event) => {
    let message = JSON.parse(event.data);

    // Check if the message is an announcement
    if (message.name === 'announcement') {
        let announcementData = message.data;
        console.log('Received announcement:', announcementData);
        $("#liveToast").show();
        setTimeout(() => {
            $("#liveToast").hide();
        }, 2000)
    } else {
        // Handle other types of messages (e.g., chat messages)
        console.log('Received message:', message);
    }
};


function sendAnnouncement(announcementData) {
    // Create the announcement message object
    let message = {
        name: 'announcement', // Specify the name of the message type
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
        description: $description
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