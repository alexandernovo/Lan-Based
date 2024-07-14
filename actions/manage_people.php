<?php
require_once('../config/config.php');

if (isset($_POST['add_people'])) {
    foreach ($_POST['user_id'] as $user_id) {
        $data = [
            'user_id' => $user_id,
            'class_id' => $_POST['class_id'],
            'added_date' => date('Y-m-d'),
            'class_people_status' => 1
        ];
        $save = save('class_people', $data);
    }

    setFlash('success', 'Added Successfully');
    redirect('../index', ['page' => 'people', 'class_id' => $_POST['class_id']]);
}


if (isset($_GET['remove'])) {
    $delete = delete('class_people', ['class_people_id' => $_GET['class_people_id']]);
    redirect('../index', ['page' => 'people', 'class_id' => $_GET['class_id']]);
}

if (isset($_POST['approve'])) {
    try {

        $update = update('class_people', ['class_people_id' => $_POST['class_people_id']], ['class_people_status' => 1]);
        $find_class = first('class', ['class_id' => $_POST['class_id']]);
        $find_student = first('class_people', ['class_people_id' => $_POST['class_people_id']]);

        $notification = [
            'user_id' => $find_student['user_id'],
            'notification_title' => "Joining Class",
            'notification_description' => $_SESSION['firstname'] . ' accept your request to join class ' . $find_class['classname'],
            'notification_type' => 'people',
            'included_id' =>  $_POST['class_id'],
            'notification_datetime' => date('Y-m-d')
        ];
        save('notification', $notification);

        $message = [
            'user_id' => $find_student['user_id'],
            'description' => $_SESSION['firstname'] . ' accept your request to join class ' . $find_class['classname'],
            'title' => 'Joining Class'
        ];
        header('Content-Type: application/json');
        echo json_encode(['status' => 'success', 'data' => $message]);
    } catch (Exception $ex) {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'success', 'data' => $ex->getMessage()]);
    }
}


if (isset($_POST['remove'])) {
    try {
        $find_student = first('class_people', ['class_people_id' => $_POST['class_people_id']]);
        $delete = delete('class_people', ['class_people_id' => $_POST['class_people_id']]);
        $find_class = first('class', ['class_id' => $_POST['class_id']]);

        $notification = [
            'user_id' => $find_student['user_id'],
            'notification_title' => "Joining Class",
            'notification_description' => $_SESSION['firstname'] . ' reject your request to join class ' . $find_class['classname'],
            'notification_type' => 'people',
            'included_id' =>  $_POST['class_id'],
            'notification_datetime' => date('Y-m-d')
        ];
        save('notification', $notification);

        $message = [
            'user_id' => $find_student['user_id'],
            'description' => $_SESSION['firstname'] . ' reject your request to join class ' . $find_class['classname'],
            'title' => 'Joining Class'
        ];
        header('Content-Type: application/json');
        echo json_encode(['status' => 'success', 'data' => $message]);
    } catch (Exception $ex) {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'success', 'data' => $ex->getMessage()]);
    }
}
