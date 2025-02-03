<?php

require_once('../config/config.php');

if (isset($_GET['activities_ajax'])) {
    if ($_SESSION['usertype'] == 0) { //if student
        $activities = joinTable('activity', [['class', 'class.class_id', 'activity.class_id'], ['class_people', 'class.class_id', 'class_people.class_id']], ['class_people.user_id' => $_SESSION['user_id']]);
    } else {
        $activities = joinTable('activity', [['class', 'class.class_id', 'activity.class_id']], ['class.user_id' => $_SESSION['user_id']]);
    }
    http_response_code(200);
    echo json_encode(["status" => "success", "data" => $activities]);
}

if (isset($_GET['activities_ajax_details'])) {
    $activities = first('activity', ['activity_id' => $_GET['activity_id']]);
    http_response_code(200);
    echo json_encode(["status" => "success", "data" => $activities]);
}
