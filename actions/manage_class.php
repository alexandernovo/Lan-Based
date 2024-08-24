<?php
require_once('../config/config.php');
if (isset($_POST['add_class'])) {
    $image = "";
    if ($_FILES['image']['size'] != 0) {
        $image = move_file($_FILES['image'], 'class_image');
    }
    $data = [
        'user_id' => $_SESSION['user_id'],
        'class_image' => $image,
        'classname' => $_POST['classname'],
        'section' => $_POST['section'],
        'room' => $_POST['room'],
        'subject' => $_POST['subject'],
        'class_status' => 1,
        'classaddeddate' => date("Y-m-d"),
        'classcode' => generateRandomString(9)
    ];

    $save = save('class', $data);
    if ($save) {
        setFlash('success', 'Class Created Successfully');
        redirect('../index', ['page' => 'classes']);
    }
    // echoObject($data);
}


if (isset($_POST['update_class'])) {

    $image = "";
    if ($_FILES['image']['size'] != 0) {
        $image = move_file($_FILES['image'], 'class_image');
    }
    $data = [
        'user_id' => $_SESSION['user_id'],
        'classname' => $_POST['classname'],
        'section' => $_POST['section'],
        'room' => $_POST['room'],
        'subject' => $_POST['subject'],
        'class_status' => 1,
        'classaddeddate' => date("Y-m-d"),
        'classcode' => generateRandomString(9)
    ];

    if ($image != "") {
        $data['class_image'] = $image;
    }

    $save = update('class', ['class_id' => $_POST['class_id']], $data);
    if ($save) {
        setFlash('success', 'Class Updated Successfully');
        redirect('../index', ['page' => 'class settings', 'class_id' => $_POST['class_id']]);
    }
    // echoObject($data);
}

if (isset($_POST['join_class'])) {

    $data = [
        'user_id' => $_SESSION['user_id'],
        'class_id' => $_POST['class_id'],
        'added_date' => date('Y-m-d h:i:s'),
        'class_people_status' => 1
    ];

    $find_teacher = first('class', ['class_id' => $_POST['class_id']]);

    $save = save('class_people', $data);

    $notification = [
        'user_id' => $find_teacher['user_id'],
        'notification_title' => "Joining Class",
        'notification_description' => $_SESSION['firstname'] . ' asked permission to join class',
        'notification_type' => 'class',
        'included_id' =>  $_POST['class_id'],
        'notification_datetime' => date('Y-m-d')
    ];

    save('notification', $notification);

    $message = [
        'user_id' => $find_teacher['user_id'],
        'description' => $_SESSION['firstname'] . ' asked permission to join class',
        'title' => 'Joining Class'
    ];

    header('Content-Type: application/json');
    echo json_encode(['status' => 'success', 'data' => $message]);
}


if (isset($_POST['archive_class'])) {

    $data = [
        "user_id" => $_SESSION['user_id'],
        "class_id" => $_POST['class_id'],
    ];
    if ($_POST['status'] == 1) {
        $delete = delete('archive_class', $data);
    } else {
        $save = save('archive_class', $data);
    }

    $message = $_POST['status'] == 1 ? "Class Unarchived Successfully" : "Class Archived Successfully";
    setFlash('success', $message);
    redirect('../index', ['page' => 'archive classes']);
}
