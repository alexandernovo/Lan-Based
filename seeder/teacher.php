<?php require_once "../config/config.php";

//localhost/LanBased/seeder/teacher.php?run=go

if (isset($_GET['run']) == "go") :
    $admin = [
        "firstname"   => "Mark",
        "middlename"   => "Villa",
        "lastname"   => "Zuckerberg",
        "username"   => "admin",
        "password"   => password_hash("admin", PASSWORD_DEFAULT),
        "usertype"   => 1,
        "userstatus"   => 1,
        "registereddate"   => date("Y-m-d"),
    ];
    $save = save("users", $admin);
    if ($save) {
        echo 'Admin Seeded Successfully';
    }
endif;
