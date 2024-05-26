<?php require_once "../config/config.php";

//localhost/RGU/seeder/adminUser.php?run=go

if (isset($_GET['run']) == "go") :
    $admin = [
        "Admin_Username"   => "Admin",
        "Admin_Password"   => password_hash("Admin", PASSWORD_DEFAULT),
    ];
    $save = save("admin", $admin);
    if ($save) {
        echo 'Admin Seeded Successfully';
    }
endif;
