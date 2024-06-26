<?php
require_once('../config/config.php');

if (isset($_POST['add_submission']) || isset($_POST['add_submission_question'])) {
    $index = last('submission', ['user_id' => $_POST['user_id'], 'activity_id' => $_POST['activity_id']], 'submission_index');
    $index_no = 0;

    if ($index) {
        $index_no = $index['submission_index'] + 1;
    } else {
        $index_no = 1;
    }

    $data = [
        'user_id' => $_POST['user_id'],
        'activity_id' => $_POST['activity_id'],
        'submission_index' =>  $index_no,
        'submission_status' => 1,
        'submission_score' => 0,
        'submission_date' => date('Y-m-d h:i:s')
    ];

    $save = save('submission', $data);

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
            $data2 = [
                'submission_id' => $save,
                'submission_file' => $image,
                'submission_fileName' => $file['name'],
            ];

            $save2 = save('submission_file', $data2);
        }
    }
    if (isset($_POST['add_submission'])) {
        setFlash('success', 'Activity Submitted Successfully');
        redirect('../index', ['page' => 'activity', 'class_id' => $_POST['class_id'], 'activity_id' => $_POST['activity_id']]);
    }
    if (isset($_POST['add_submission_question'])) {
        setFlash('success', 'Questions Activity Submitted Successfully');
        redirect('../index', ['page' => 'questions activity', 'class_id' => $_POST['class_id'], 'activity_id' => $_POST['activity_id']]);
    }
}

if (isset($_POST['edit_submission']) || isset($_POST['edit_submission_question'])) {

    $file_to_remove = find_where('submission_file', ['submission_id' => $_POST['submission_id']]);

    foreach ($file_to_remove as $remove) {
        $delete = deleteFile('../' . $remove['submission_file']);
        $delete1 = delete('submission_file', ['submission_file_id' => $remove['submission_file_id']]);
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
            $data2 = [
                'submission_id' => $_POST['submission_id'],
                'submission_file' => $image,
                'submission_fileName' => $file['name'],
            ];

            $save2 = save('submission_file', $data2);
        }
    }
    if (isset($_POST['edit_submission'])) {
        setFlash('success', 'Activity Submitted Successfully');
        redirect('../index', ['page' => 'activity', 'class_id' => $_POST['class_id'], 'activity_id' => $_POST['activity_id']]);
    }
    if (isset($_POST['edit_submission_question'])) {
        setFlash('success', 'Questions Activity Submitted Successfully');
        redirect('../index', ['page' => 'questions activity', 'class_id' => $_POST['class_id'], 'activity_id' => $_POST['activity_id']]);
    }
}


if (isset($_POST['submitted'])) {
    $data = [
        'submission_status' => 3,
        'submission_remarks' => $_POST['submission_remarks'],
        'submission_score' => $_POST['submission_score'],
    ];

    $update = update('submission', ['submission_id' => $_POST['submission_id']], $data);
    setFlash('success', 'Submission Scored Successfully');
    redirect('../index', ['page' => 'submission', 'submission_id' => $_POST['submission_id']]);
}
