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

    setFlash('success', 'People is Registered Successfully');
    redirect('../index', ['page' => 'people', 'class_id' => $_POST['class_id']]);
}


if (isset($_GET['remove'])) {
    $delete = delete('class_people', ['class_people_id' => $_GET['class_people_id']]);
    redirect('../index', ['page' => 'people', 'class_id' => $_GET['class_id']]);
}
