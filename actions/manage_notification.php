<?php
require_once('../config/config.php');

if (isset($_GET['count'])) {
    // Validate and sanitize input
    $notification_id = isset($_GET['notification_id']) ? intval($_GET['notification_id']) : 0;

    if ($notification_id > 0) {
        $query = "SELECT COUNT(notification_id) as notification_count FROM notification WHERE user_id = ?";
        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param("i", $notification_id);
            $stmt->execute();
            $stmt->bind_result($notification_count);
            $stmt->fetch();
            $stmt->close();

            // Return response in JSON format
            echo json_encode(['status' => 'success', 'data' => ['number' => $notification_count]]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Query preparation failed.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid notification_id.']);
    }
}


if (isset($_GET['notif_data'])) {
    $notification_id = isset($_GET['notification_id']) ? intval($_GET['notification_id']) : 0;
    $join = joinTable('notification', [['users', 'users.user_id', 'notification.user_id']], ['users.user_id' => $notification_id]);
    echo json_encode(['status' => 'success', 'data' => $join]);
}
