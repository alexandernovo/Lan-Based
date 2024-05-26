<?php
require_once 'session.php';
if (isset($_SESSION['isLogin'])) {
    if (isset($_SESSION['Admin_Username'])) {
        redirect('adminDashboard', ['pages' => 'Dashboard']);
    }
}
