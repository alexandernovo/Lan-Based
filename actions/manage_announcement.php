<?php

require_once('../config/config.php');
if (isset($_POST['add_announcement'])) {
    $data = [
        'announcement_title' => $_POST['announcement_title'],
        'announcement_description' => $_POST['announcement_description'],
        'user_id' => $_POST['user_id'],
        'announcement_type' => $_POST['announcement_type'],
        'announcement_date' => date('Y-m-d h:i:s'),
        'class_id' => $_POST['class_id']
    ];
    $save = save('announcement', $data);

    header('Content-Type: application/json');
    echo json_encode(['status' => 'success']);
}


// add_announcement: true,
// announcement_title: $("#announcement_title").val(),
// announcement_description: $("#announcement_description").val(),
// user_id: $("#user_id").val(),
// announcement_type: "stream"