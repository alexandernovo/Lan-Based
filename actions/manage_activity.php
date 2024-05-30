<?php

require_once('../config/config.php');
if (isset($_POST['add_activity'])) {

    $data = [
        'class_id' => $_POST['class_id'],
        'activity_title' => $_POST['activity_title'],
        'activity_description' => $_POST['activity_description'],
        'isDueDate' => $_POST['isDueDate'],
        'dueDate' => $_POST['dueDate'],
        'total_points' => $_POST['total_points'],
        'activity_type' => "activity",
        'activity_dateAdded' => date('Y-m-d'),
        'activity_status' => 1
    ];

    $fields = [
        'activity_title' => $_POST['activity_title'],
        'activity_description' => $_POST['activity_description'],
        'total_points' => $_POST['total_points'],
    ];

    $validations = [
        'activity_title' => [
            'required' => true,
        ],
        'activity_description' => [
            'required' => true,
        ],
        'total_points' => [
            'required' => true,
        ]
    ];

    if ($_POST['dueDate'] == 1) {
        $fields['dueDate'] = $_POST['dueDate'];

        $validations['dueDate'] = [
            'required' => true,
        ];
    }
    $errors = validate($fields, $validations);
    if (empty($errors)) {
        $save = save('activity', $data);
        if ($save) {
            foreach ($_FILES['attachments']['name'] as $key => $name) {
                $file = [
                    'name' => $_FILES['attachments']['name'][$key],
                    'type' => $_FILES['attachments']['type'][$key],
                    'tmp_name' => $_FILES['attachments']['tmp_name'][$key],
                    'error' => $_FILES['attachments']['error'][$key],
                    'size' => $_FILES['attachments']['size'][$key],
                ];

                if ($file['size'] != 0) {
                    $image = move_file($file, 'attachments');
                    if ($image) {
                        $data_attachments = [
                            'activity_id' => $save,
                            'attachment_file' => $image,
                            'attachment_filetype' => $file['type'],
                            'attachment_name' => $file['name'],
                            'attachment_type' => 'attachments',
                            'attachment_addeddate' => date('Y-m-d h:i:s')
                        ];
                        $save_attachment = save('attachments', $data_attachments);
                    }
                }
            }

            // foreach ($_FILES['topics']['name'] as $key => $name) {
            //     $file = [
            //         'name' => $_FILES['topics']['name'][$key],
            //         'type' => $_FILES['topics']['type'][$key],
            //         'tmp_name' => $_FILES['topics']['tmp_name'][$key],
            //         'error' => $_FILES['topics']['error'][$key],
            //         'size' => $_FILES['topics']['size'][$key],
            //     ];

            //     if ($file['size'] != 0) {
            //         $image = move_file($file, 'topics');
            //         if ($image) {
            //             $data_topics = [
            //                 'activity_id' => $save,
            //                 'attachment_file' => $image,
            //                 'attachment_filetype' => $file['type'],
            //                 'attachment_name' => $file['name'],
            //                 'attachment_type' => 'topics',
            //                 'attachment_addeddate' => date('Y-m-d h:i:s')
            //             ];
            //             $save_attachment = save('attachments', $data_topics);
            //         }
            //     }
            // }
            setFlash('success', 'Activity Created Successfully');
            redirect('../index', ['page' => 'lab activities', 'class_id' => $_POST['class_id']]);
        }
    } else {
        retainValue();
        returnError($errors);
        redirect('../index', ['page' => 'create activity', 'class_id' => $_POST['class_id']]);
    }
}


if (isset($_POST['add_question'])) {

    $data = [
        'class_id' => $_POST['class_id'],
        'activity_title' => $_POST['activity_title'],
        'activity_description' => $_POST['activity_description'],
        'isDueDate' => $_POST['isDueDate'],
        'dueDate' => $_POST['dueDate'],
        'question_type' => $_POST['question_type'],
        'total_points' => $_POST['total_points'],
        'activity_type' => "question",
        'activity_dateAdded' => date('Y-m-d'),
        'activity_status' => 1
    ];

    $fields = [
        'activity_title' => $_POST['activity_title'],
        'activity_description' => $_POST['activity_description'],
        'total_points' => $_POST['total_points'],
    ];

    $validations = [
        'activity_title' => [
            'required' => true,
        ],
        'activity_description' => [
            'required' => true,
        ],
        'total_points' => [
            'required' => true,
        ]
    ];

    if ($_POST['dueDate'] == 1) {
        $fields['dueDate'] = $_POST['dueDate'];

        $validations['dueDate'] = [
            'required' => true,
        ];
    }
    $errors = validate($fields, $validations);
    if (empty($errors)) {
        $save = save('activity', $data);
        if ($save) {
            foreach ($_FILES['attachments']['name'] as $key => $name) {
                $file = [
                    'name' => $_FILES['attachments']['name'][$key],
                    'type' => $_FILES['attachments']['type'][$key],
                    'tmp_name' => $_FILES['attachments']['tmp_name'][$key],
                    'error' => $_FILES['attachments']['error'][$key],
                    'size' => $_FILES['attachments']['size'][$key],
                ];

                if ($file['size'] != 0) {
                    $image = move_file($file, 'attachments');
                    if ($image) {
                        $data_attachments = [
                            'activity_id' => $save,
                            'attachment_file' => $image,
                            'attachment_filetype' => $file['type'],
                            'attachment_name' => $file['name'],
                            'attachment_type' => 'attachments',
                            'attachment_addeddate' => date('Y-m-d h:i:s')
                        ];
                        $save_attachment = save('attachments', $data_attachments);
                    }
                }
            }
            setFlash('success', 'Question Created Successfully');
            redirect('../index', ['page' => 'questions', 'class_id' => $_POST['class_id']]);
        }
    } else {
        retainValue();
        returnError($errors);
        redirect('../index', ['page' => 'create question', 'class_id' => $_POST['class_id']]);
    }
}
