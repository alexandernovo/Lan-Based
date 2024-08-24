<?php

require_once('../config/config.php');
if (isset($_POST['login'])) {

    $users = first('users', ['username' => $_POST['username']]);

    if ($users) {
        if ($users['userstatus'] == 1) {
            if (password_verify($_POST['password'], $users['password'])) {
                setSession($users);
                setFlash('success', 'Welcome Back ' . $users['firstname']);
                redirect('../index', ['page' => 'classes']);
            } else {
                retainValue();
                returnError(['password' => "Password is incorrect"]);
                redirect('../index', ['page' => 'login']);
            }
        } else {
            retainValue();
            returnError(['username' => "User is deactivated"]);
            redirect('../index', ['page' => 'login']);
        }
    } else {
        returnError(['username' => "Username does not exist"]);
        redirect('../index', ['page' => 'login']);
    }
}


if (isset($_GET['logout'])) {
    session_destroy();
    redirect('../index', ['page' => 'login']);
    exit;
}
