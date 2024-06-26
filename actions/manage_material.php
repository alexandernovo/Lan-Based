<?php

require_once('../config/config.php');

if (isset($_POST['add_material'])) {
    $data = [
        'material_name' => $_POST['material_name'],
        'class_id' => $_POST['class_id'],
        'material_addedDate' => date('Y-m-d h:i:s')
    ];

    $save = save('material', $data);

    if ($save) {
        foreach ($_FILES['material_file']['name'] as $key => $name) {
            $file = [
                'name' => $_FILES['material_file']['name'][$key],
                'type' => $_FILES['material_file']['type'][$key],
                'tmp_name' => $_FILES['material_file']['tmp_name'][$key],
                'error' => $_FILES['material_file']['error'][$key],
                'size' => $_FILES['material_file']['size'][$key],
            ];

            if ($file['size'] != 0) {
                $image = move_file($file, 'material');
                if ($image) {
                    $materials = [
                        'material_id' => $save,
                        'material_fileName' => $file['name'],
                        'material_file' => $image,
                        'material_type' => $file['type'],
                        'material_dateAdded' => date('Y-m-d h:i:s')
                    ];
                    $save_attachment = save('material_attachment', $materials);
                }
            }
        }
        setFlash('success', 'Material Added Successfully');
        redirect('../index', ['page' => 'materials', 'class_id' => $_POST['class_id']]);
    }
}


if (isset($_POST['edit_material'])) {
    $data = [
        'material_name' => $_POST['material_name'],
        'class_id' => $_POST['class_id'],
        'material_addedDate' => date('Y-m-d h:i:s')
    ];

    $save = update('material', ['material_id' => $_POST['material_id']], $data);

    if ($save) {

        if ($_FILES['material_file']['size'][0] != 0) {
            $file_to_remove = find_where('material_attachment', ['material_id' => $_POST['material_id']]);
            foreach ($file_to_remove as $remove) {
                $delete = deleteFile('../' . $remove['material_file']);
                $delete1 = delete('material_attachment', ['material_attachment_id' => $remove['material_attachment_id']]);
            }
        }

        foreach ($_FILES['material_file']['name'] as $key => $name) {
            $file = [
                'name' => $_FILES['material_file']['name'][$key],
                'type' => $_FILES['material_file']['type'][$key],
                'tmp_name' => $_FILES['material_file']['tmp_name'][$key],
                'error' => $_FILES['material_file']['error'][$key],
                'size' => $_FILES['material_file']['size'][$key],
            ];

            if ($file['size'] != 0) {
                $image = move_file($file, 'material');
                if ($image) {
                    $materials = [
                        'material_id' => $_POST['material_id'],
                        'material_fileName' => $file['name'],
                        'material_file' => $image,
                        'material_type' => $file['type'],
                        'material_dateAdded' => date('Y-m-d h:i:s')
                    ];
                    $save_attachment = save('material_attachment', $materials);
                }
            }
        }
        setFlash('success', 'Material Added Successfully');
        redirect('../index', ['page' => 'materials', 'class_id' => $_POST['class_id']]);
    }
}
