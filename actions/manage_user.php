<?php
require_once('../config/config.php');

if (isset($_POST['register'])) {
    $data = [
        'usertype' => $_POST['usertype'],
        'firstname' => $_POST['firstname'],
        'middlename' => $_POST['middlename'],
        'lastname' => $_POST['lastname'],
        'userstatus' => 1,
        'email' => $_POST['email'],
        'username' => $_POST['username'],
        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
        "registereddate"   => date("Y-m-d"),
    ];

    $user = save('users', $data);
    if ($user) {
        setFlash('success',  $_POST['firstname'] . ' is Registered Successfully');
        redirect('../index', ['page' => 'users']);
    }
}
