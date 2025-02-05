<?php

require_once('../config/config.php');
if (isset($_POST['register'])) {

    $fields = [
        'firstname' => $_POST['firstname'],
        'middlename' => $_POST['middlename'],
        'lastname' => $_POST['lastname'],
        'email' => $_POST['email'],
        'username' => $_POST['username'],
        'password' => $_POST['password'],
        'confirmpassword' => $_POST['confirmpassword'],
    ];

    $validations = [
        'firstname' => [
            'required' => true,
        ],
        'middlename' => [
            'required' => true,
        ],
        'lastname' => [
            'required' => true,
        ],
        // 'email' => [
        //     'required' => true,
        //     'email' => true,
        //     'unique' => [
        //         [
        //             'fieldName' => 'email',
        //             'tableName' => 'users'
        //         ]
        //     ]
        // ],
        'username' => [
            'required' => true,
            'unique' => [
                [
                    'fieldName' => 'username',
                    'tableName' => 'users'
                ]
            ]
        ],
        'password' => [
            'required' => true,
            'min_length' => 6
        ],
        'confirmpassword' => [
            'required' => true,
            'match' => 'password'
        ]
    ];

    $errors = validate($fields, $validations);
    if (empty($errors)) {
        $data = [
            'firstname' => $_POST['firstname'],
            'middlename' => $_POST['middlename'],
            'lastname' => $_POST['lastname'],
            // 'email' => $_POST['email'],
            'username' => $_POST['username'],
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
            'usertype' => 0,
            'registereddate' => date("Y-m-d"),
        ];
        $id = save("users", $data);
        if ($id) {
            $data['user_id'] = $id;
            $data['user_type'] = 0;
            setSession($data);
            removeValue();
            setFlash("success", "Register Successfully");
            redirect('../index', ['page' => 'classes']);
        }
    } else {
        retainValue();
        returnError($errors);
        redirect('../index', ['page' => 'signup']);
    }
}
