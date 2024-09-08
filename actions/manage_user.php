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



if (isset($_POST['update_profile'])) {
    updateUser($_POST);
    $users = first('users', ['user_id' => $_SESSION['user_id']]);
    setSession($users);
    setFlash('success',  "Profile Updated Successfully");
    redirect('../index', ['page' => 'account settings']);
}

if (isset($_POST['update_user'])) {
    // var_dump($_POST);
    updateUser($_POST);
    setFlash('success',  "User Updated Successfully");
    redirect('../index', ['page' => 'users']);
}


function updateUser($_data)
{
    $data = [
        'firstname' => $_data['firstname'],
        'middlename' => $_data['middlename'],
        'lastname' => $_data['lastname'],
        'email' => $_data['email'],
        'username' => $_data['username'],
        'usertype' => $_data['usertype'],
    ];

    if (isset($_data['password'])  && $_data['password'] !== "") {
        $data['password'] = password_hash($_data['password'], PASSWORD_DEFAULT);
    }

    if ($_data['update_profile']) {
        update('users', ['user_id' => $_SESSION['user_id']], $data);
    } else {
        update('users', ['user_id' => $_data['user_id']], $data);
    }

    return true;
}


if (isset($_GET['activation'])) {
    if ($_GET['userstatus'] == 1) {
        $message = "User Deactivated Successfully";
        $user_status = 0;
    } else {
        $message = "User Activated Successfully";
        $user_status = 1;
    }
    $update = update('users', ['user_id' => $_GET['user_id']], ['userstatus' => $user_status]);
    setFlash('success', $message);
    redirect('../index', ['page' => 'users']);
}
