<?php
//include the config.php at the top of your views
require_once 'routes.php';
require_once 'session.php';
require_once 'functions.php';
require_once 'database.php';
require_once 'validate.php';
//include your new query files here

date_default_timezone_set('Asia/Manila');

$currentYear = date('Y');
$lastyear = date('Y-m-d', strtotime($currentYear . '-01-01 -1 year'));
$thisyear = $currentYear . '-12-31';
