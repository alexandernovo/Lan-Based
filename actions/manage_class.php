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
