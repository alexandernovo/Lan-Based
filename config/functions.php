<?php
require_once 'session.php';
function getValue($fieldName)
{
    if (isset($_SESSION['inputs'][$fieldName])) {
        return htmlspecialchars($_SESSION['inputs'][$fieldName]);
    }
    return isset($_POST[$fieldName]) ? htmlspecialchars($_POST[$fieldName]) : '';
}
function redirect($location, $data = [])
{
    $url = $location . ".php";
    if (!empty($data)) {
        $url .= "?" . http_build_query($data);
    }
    header("Location: " . $url);
    exit;
}
function removeValue()
{
    if (isset($_SESSION['inputs'])) {
        unset($_SESSION['inputs']);
    }
}
function retainValue()
{
    $_SESSION['inputs'] = $_POST;
}
function setFlash($type, $message)
{
    $_SESSION['flash'] = [
        'type' => $type,
        'message' => $message
    ];
}

function getFlash($type)
{
    if (isset($_SESSION['flash']['type']) && $_SESSION['flash']['type'] == $type) {
        $message = $_SESSION['flash']['message'];
        unset($_SESSION['flash']);
        return $message;
    }
    return false;
}

// function showError($errorName)
// {
//     if (isset($_GET[$errorName])) {
//         return $_GET[$errorName];
//     }
// }
function session()
{
    if (isset($_SESSION['isLogin'])) {
        redirect('login');
        exit;
    }
}

//return error
function returnError($error)
{
    // Store the error in the session
    if (!isset($_SESSION['errors'])) {
        $_SESSION['errors'] = array();
    }
    $_SESSION['errors'] = $error;
}

function showError($error_key)
{
    if (isset($_SESSION['errors'][$error_key])) {
        $error = $_SESSION['errors'][$error_key];
        unset($_SESSION['errors'][$error_key]);
        echo '<p class="text-danger error text-start m-0 p-0" style="font-size:12px !important;">' . $error . '</p>';
    }
    return false;
}

function generateRandomString($length = 6)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomString;
}
function move_file($file, $directory)
{
    // Check if file was uploaded
    if (!isset($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])) {
        return false;
    }
    // Get the extension of the uploaded file
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);

    // Generate a unique random name
    $newName = uniqid(rand(), true) . '.' . $extension;

    // Create the new path
    $newPath = '../public/assets/' . $directory . '/' . $newName;
    $returnPath = 'public/assets/' . $directory . '/' . $newName;

    // Move the uploaded file
    if (move_uploaded_file($file['tmp_name'], $newPath)) {
        return $returnPath;
    } else {
        return false;
    }
}

function deleteFile($filePath)
{
    // Check if the file exists and is a file (not a directory)
    if (is_file($filePath)) {
        // Attempt to delete the file
        if (unlink($filePath)) {
            return true;
        } else {
            return false;
        }
    } else {
        // The file does not exist or is not a file
        return false;
    }
}
function getPage()
{
    if (isset($_GET['pages'])) {
        echo $_GET['pages'];
    }
}

function echoObject($data)
{
    echo '<pre>' . print_r($data, true) . '</pre>';
}

function dateDue($date)
{
    // Current date
    $currentDate = new DateTime(date('Y-m-d'));
    // Provided date
    $dueDate = new DateTime($date);

    // Calculate the difference
    $interval = $currentDate->diff($dueDate);

    if ($date > date('Y-m-d')) {
        // If the date is in the future
        return "<span class='text-primary attachment_text'>" . $interval->days . " days left</span>";
    } else {
        // If the date is in the past
        return "<span class='text-danger attachment_text'>Overdue by " . $interval->days . " days</span>";
    }
}

// $randomString = generateRandomString();
// echo $randomString;


// function showError($error_key)
// {
//     if (isset($_SESSION['errors'][$error_key])) {
//         return $_SESSION['errors'][$error_key];
//     }
//     return false;
// }



// if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == true) {
//     header("Location: home.php");
//     exit;
// } else {
//     header("Location: login.php");
//     exit;
// }