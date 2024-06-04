<?php

require_once('../config/config.php');
if (isset($_POST['add_submission'])) {
    $index = last('submission', ['user_id' => $_POST['user_id'], 'activity_id' => $_POST['activity_id']], 'submission_index');
    $index_no = 0;

    if ($index) {
        $index_no = $index['submission_index'] + 1;
    } else {
        $index_no = 1;
    }
    foreach ($_FILES['submission_file']['name'] as $key => $name) {
        $file = [
            'name' => $_FILES['submission_file']['name'][$key],
            'type' => $_FILES['submission_file']['type'][$key],
            'tmp_name' => $_FILES['submission_file']['tmp_name'][$key],
            'error' => $_FILES['submission_file']['error'][$key],
            'size' => $_FILES['submission_file']['size'][$key],
        ];
        if ($file['size'] != 0) {
            $image = move_file($file, 'submissions');
            $data = [
                'user_id' => $_POST['user_id'],
                'activity_id' => $_POST['activity_id'],
                'submission_file' => $image,
                'submission_fileName' => $file['name'],
                'submission_index' =>  $index_no,
                'submission_status' => 1,
                'submission_score' => 0,
                'submission_date' => date('Y-m-d h:i:s')
            ];

            $save = save('submission', $data);
        }
    }
    setFlash('success', 'Activity Submitted Successfully');
    redirect('../index', ['page' => 'activity', 'class_id' => $_POST['class_id'], 'activity_id' => $_POST['activity_id']]);
}
