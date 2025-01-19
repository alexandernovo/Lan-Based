<?php

require_once('../config/config.php');

if (isset($_POST['table_schedule'])) {
    $start = isset($_POST['start']) ? (int)$_POST['start'] : 0;
    $length = isset($_POST['length']) ? (int)$_POST['length'] : 10;

    $query = "SELECT schedule.*, class.* 
              FROM class 
              LEFT JOIN schedule ON class.class_id = schedule.class_id 
              LIMIT $length OFFSET $start";

    $result = mysqli_query($conn, $query);

    if ($result) {
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        $countQuery = "SELECT COUNT(*) AS total 
                       FROM class 
                       LEFT JOIN schedule ON class.class_id = schedule.class_id";
        $countResult = mysqli_query($conn, $countQuery);
        $total = mysqli_fetch_assoc($countResult)['total'];

        http_response_code(200);
        echo json_encode([
            "status" => "success",
            "data" => $data,
            "recordsTotal" => $total,
            "recordsFiltered" => $total,
        ]);
    } else {
        // Handle query failure
        http_response_code(500);
        echo json_encode(["status" => "error", "message" => "Failed to fetch data"]);
    }
}


if (isset($_POST['change_day'])) {
    $class_id = $_POST['class_id'];
    $day = $_POST['day'];
    $status = $_POST['status'];
    $check = first('schedule', ['class_id' => $class_id]);

    if ($check) {
        $save = update('schedule', ['class_id' => $class_id], [$day => $status]);
    } else {
        $data = [
            'class_id' => $class_id,
            $day => $status,
            'createdby' => $_SESSION['user_id'],
            'created_at' => date('Y-m-d h:i:s')
        ];
        $save = save('schedule', $data);
    }

    http_response_code(200);
    echo json_encode(["status" => "success", "message" => "Successfully Updated", "data" => $_POST['day']]);
}

if (isset($_POST['timesaveupdate'])) {
    if (isset($_POST['timesched'])) {
        foreach ($_POST['timesched'] as $time) {
            if ($time['scheduletime_id'] == 0) {
                $data = [
                    'timefrom' => $time['timefrom'],
                    'timeto' => $time['timeto'],
                    'day' => $time['day'],
                    'schedule_id' => $_POST['schedule_id'],
                    'createdby' => $_SESSION['user_id'],
                    'created_at' => date('Y-m-d h:i:s')
                ];
                $save = save('schedule_time', $data);
            } else {
                $data = [
                    'timefrom' => $time['timefrom'],
                    'timeto' => $time['timeto'],
                ];
                $save = update('schedule_time', ['scheduletime_id' => $time['scheduletime_id']], $data);
            }
        }
    }
    if (isset($_POST['removedtime'])) {
        foreach ($_POST['removedtime'] as $time) {
            delete('schedule_time', ['scheduletime_id' => $time['scheduletime_id']]);
        }
    }

    http_response_code(200);
    echo json_encode(["status" => "success", "message" => "Successfully Updated"]);
}

if (isset($_POST['getTimeScheds'])) {
    $schedule_id = $_POST['schedule_id'];
    $day = $_POST['day'];
    $data = find_where('schedule_time', ['schedule_id' => $schedule_id, 'day' => $day]);
    http_response_code(200);
    echo json_encode(["status" => "success", "data" => $data]);
}
