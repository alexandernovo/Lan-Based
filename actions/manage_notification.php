<?php
require_once('../config/config.php');

if (isset($_GET['count'])) {
    // Validate and sanitize input
    $notification_id = isset($_GET['notification_id']) ? intval($_GET['notification_id']) : 0;

    // Check if $notification_id is greater than 0
    if ($notification_id > 0) {
        // Fetch user-specific classes from the database
        $own_class = find_where("class_people", ['user_id' => $_SESSION['user_id']]);

        if ($own_class) {
            $class_ids = array_column($own_class, 'class_id'); // Extract class IDs
        } else {
            $class_ids = []; // Empty array if no classes are found
        }

        // Construct placeholders for the SQL query
        $placeholders = !empty($class_ids) ? implode(',', array_fill(0, count($class_ids), '?')) : '';

        // Construct the SQL query based on user type
        if ($_SESSION['usertype'] == 0) {
            if (!empty($placeholders)) {
                $query = "SELECT COUNT(notification_id) AS notification_count 
                          FROM notifications 
                          WHERE (user_id = ? OR (included_id IN ($placeholders) AND notification_type = 'activity'))
                          AND is_read = 1";
                $types = str_repeat('i', count($class_ids)) . 'i'; // Type string for class_ids + user_id
            } else {
                $query = "SELECT COUNT(notification_id) AS notification_count 
                          FROM notifications 
                          WHERE user_id = ? AND is_read = 1";
                $types = 'i'; // Type string for user_id only
            }
        } else if ($_SESSION['usertype'] == 1) {
            $query = "SELECT COUNT(notification_id) AS notification_count 
                      FROM notifications 
                      WHERE user_id = ? AND NOT notification_type = 'activity'
                      AND is_read = 1";
            $types = 'i'; // Type string for user_id
        } else if ($_SESSION['usertype'] == 2) {
            $query = "SELECT COUNT(notification_id) AS notification_count 
                      FROM notifications WHERE is_read = 1";
            $types = ''; // No parameters for usertype 2
        }

        // Prepare and execute the SQL query
        if ($stmt = $conn->prepare($query)) {
            // Bind parameters dynamically
            if ($_SESSION['usertype'] == 0) {
                if (!empty($placeholders)) {
                    $params = array_merge([$notification_id], $class_ids);
                    $stmt->bind_param($types, ...$params);
                } else {
                    $stmt->bind_param($types, $notification_id);
                }
            } else if ($_SESSION['usertype'] == 1) {
                $stmt->bind_param($types, $notification_id);
            }

            // Execute the statement
            $stmt->execute();

            // Bind result variables
            $stmt->bind_result($notification_count);
            $stmt->fetch();

            // Close the statement
            $stmt->close();

            // Return the result as JSON
            echo json_encode(['status' => 'success', 'data' => ['number' => $notification_count]]);
        } else {
            // Return an error if query preparation fails
            echo json_encode(['status' => 'error', 'message' => 'Query preparation failed.']);
        }
    }
}


if (isset($_GET['notif_data'])) {
    $data = getNotifData();
    echo json_encode(['status' => 'success', 'data' => $data]);
}

function getNotifData()
{
    global $conn;
    $user_id = $_SESSION['user_id'];
    // Fetch user-specific classes from the database
    $class_ids = [];
    $sql = "SELECT class_id FROM class_people WHERE user_id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $class_ids[] = $row['class_id'];
        }
        $stmt->close();
    }

    // Format class IDs for the SQL query
    if (!empty($class_ids)) {
        $placeholders = implode(',', array_fill(0, count($class_ids), '?'));
    } else {
        $placeholders = ''; // Handle the case where there are no class IDs
    }

    // Construct the SQL query for joining tables
    if (!empty($placeholders)) {
        $query = "SELECT notifications.*, users.*
                  FROM notifications
                  JOIN users ON users.user_id = notifications.user_id
                  WHERE (users.user_id = ? OR (notifications.included_id IN ($placeholders) AND notifications.notification_type = 'activity'))";
    } else {
        if ($_SESSION['usertype'] == 1) {
            $query = "SELECT notifications.*, users.*
            FROM notifications
            JOIN users ON users.user_id = notifications.user_id
            WHERE users.user_id = ?";
        } else {
            $query = "SELECT notifications.*, users.*
            FROM notifications
            JOIN users ON users.user_id = notifications.user_id";
        }
    }

    // Prepare and execute the SQL query
    if ($stmt = $conn->prepare($query)) {
        // Bind parameters
        if (!empty($placeholders)) {
            $types = str_repeat('i', count($class_ids) + 1); // 'i' for integer type
            $params = array_merge([$user_id], $class_ids);
            $stmt->bind_param($types, ...$params);
        } else if ($_SESSION['usertype'] == 1) {
            $stmt->bind_param('i', $user_id);
        }

        // Execute the statement
        $stmt->execute();

        // Fetch results
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);

        // Close the statement
        $stmt->close();
        return $data;
        // Return the result as JSON
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Query preparation failed.']);
    }
}

if (isset($_POST['markread'])) {
    $notif_id = $_POST['notif_id'];
    $update = update("notifications", ['notification_id' => $notif_id], ['is_read' => 0]);
    echo json_encode(['status' => 'success']);
}
