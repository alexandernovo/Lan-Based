<?php
require_once('../config/config.php');
if (isset($_GET['teachers'])) {
    $teachers = find_where('users', ['usertype' => 1]);
    http_response_code(200);
    echo json_encode(["status" => "success", "data" => $teachers]);
}
