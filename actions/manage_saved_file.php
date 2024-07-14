<?php
require_once('../config/config.php');

if (isset($_GET['save_file'])) {

    $data = [
        'user_id' => $_SESSION['user_id'],
        'attachment_id' => $_GET['attachment_id'],
        'attachment_type' => 'material',
        'saved_datetime' => date('Y-m-d h:i:s')
    ];

    $save = save('saved_file', $data);

    setFlash('success', 'Saved Successfully');
    redirect('../index', ['page' => 'learning materials', 'class_id' => $_GET['class_id'], 'material_id' => $_GET['material_id']]);
}

if (isset($_GET['remove'])) {
    if ($_GET['type'] == "material") {
        $remove = delete('saved_file', ['saved_file_id' => $_GET['saved_file_id']]);
        redirect('../index', ['page' => 'saved files']);
    }
}
