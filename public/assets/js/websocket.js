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
