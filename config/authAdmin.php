<?php
require_once('../config/config.php');
if (!isset($_SESSION['isLogin'])) {
    setFlash('failed', 'Login First');
    redirect('login');
} else {
    if (!isset($_SESSION['Admin_Username'])) {
        if (isset($_SESSION['student_Username'])) {
            redirect('index'); //temporary
        }
        if (isset($_SESSION['teacher_Username'])) {
            redirect('index'); //temporary
        }
    }
}
