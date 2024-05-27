<?php

require_once('../config/config.php');
if (isset($_POST['login'])) {

    $users = first('users', ['username' => $_POST['username']]);

    if ($users) {
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
        returnError(['username' => "Username does not exist"]);
        redirect('../index', ['page' => 'login']);
    }
}
