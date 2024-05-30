<?php
// Function to check if a specific PHP script is running
function isScriptRunning($scriptPath)
{
    // Command to list all running processes and filter for the specific script
    exec("tasklist /FI \"IMAGENAME eq php.exe\" /FO LIST", $output);
    foreach ($output as $line) {
        if (strpos($line, $scriptPath) !== false) {
            return true;
        }
    }
    return false;
}

// Path to the PHP script to check
$scriptPath = "C:\\xampp\\htdocs\\LanBased\\config\\websocket_starter.php";

// Log file to capture script output and errors
$logFile = "C:\\xampp\\htdocs\\LanBased\\logs\\php-socket.log";

// Lock file to prevent multiple instances
$lockFile = "C:\\xampp\\htdocs\\LanBased\\config\\websocket_starter.lock";

// Ensure the log directory exists
if (!file_exists(dirname($logFile))) {
    mkdir(dirname($logFile), 0777, true);
}

// Check if the script is already running using a lock file
if (file_exists($lockFile)) {
    // echo "PHP script is already running.";
} else {
    // Create a lock file to indicate the script is running
    file_put_contents($lockFile, "locked");

    // Attempt to start the script and log the output
    exec("start /B php -q $scriptPath > $logFile 2>&1", $output, $result);
    if ($result === 0) {
        // echo "PHP script started successfully.";
    } else {
        echo "Failed to start PHP script. Check log for details.";
    }

    // Remove the lock file after the script starts
    unlink($lockFile);
}

// Display log file contents for debugging
if (file_exists($logFile)) {
    // echo "<pre>" . nl2br(file_get_contents($logFile)) . "</pre>";
} else {
    echo "Log file does not exist.";
}
